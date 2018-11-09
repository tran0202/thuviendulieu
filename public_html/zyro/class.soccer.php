<?php

    class Soccer {

        const GROUP_MATCHES = 'Group Matches';
        const WITHDREW = 'Withdrew';
        const SECOND_ROUND = 'Second Round';
        const REPLAY_SECOND_ROUND = 'Replay Second Round';
        const FINAL_ROUND = 'Final Round';
        const PLAY_OFF = 'Play-off';
        const PRELIMINARY_ROUND = 'Preliminary Round';
        const FIRST_ROUND = 'First Round';
        const REPLAY_FIRST_ROUND = 'Replay First Round';
        const PRELIMINARY_ROUND1 = 'Preliminary Round 1';
        const PRELIMINARY_ROUND2 = 'Preliminary Round 2';
        const QUALIFYING_ROUND1_FIRST_LEG = 'Qualifying Round 1 - 1st Leg';
        const QUALIFYING_ROUND1_SECOND_LEG = 'Qualifying Round 1 - 2nd Leg';
        const QUALIFYING_ROUND2_FIRST_LEG = 'Qualifying Round 2 - 1st Leg';
        const QUALIFYING_ROUND2_SECOND_LEG = 'Qualifying Round 2 - 2nd Leg';
        const QUALIFYING_ROUND3_FIRST_LEG = 'Qualifying Round 3 - 1st Leg';
        const QUALIFYING_ROUND3_SECOND_LEG = 'Qualifying Round 3 - 2nd Leg';
        const PLAYOFF_ROUND_FIRST_LEG = 'Playoff Round - 1st Leg';
        const PLAYOFF_ROUND_SECOND_LEG = 'Playoff Round - 2nd Leg';
        const MATCH_DAY_1 = 'MatchDay 1';
        const MATCH_DAY_2 = 'MatchDay 2';
        const MATCH_DAY_3 = 'MatchDay 3';
        const MATCH_DAY_4 = 'MatchDay 4';
        const MATCH_DAY_5 = 'MatchDay 5';
        const MATCH_DAY_6 = 'MatchDay 6';
        const ROUND16 = 'Round of 16';
        const REPLAY_ROUND16 = 'Replay Round of 16';
        const QUARTERFINALS = 'Quarterfinals';
        const REPLAY_QUARTERFINALS = 'Replay Quarterfinals';
        const SEMIFINALS = 'Semifinals';
        const THIRD_PLACE = 'Third place';
        const FINAL_ = 'Final';
        const REPLAY_FINAL = 'Replay Final';
        const FINALS = 'Finals';
        const FINAL_PLAYOFF = 'Final Play-off';
        const BRONZE_MEDAL_MATCH = 'Bronze Medal Match';
        const GOLD_MEDAL_MATCH = 'Gold Medal Match';
        const REPLAY_GOLD_MEDAL_MATCH = 'Replay Gold Medal Match';
        const REPLAY_BRONZE_MEDAL_MATCH = 'Replay Bronze Medal Match';
        const CONSOLATION_ROUND = 'Consolation Round';
        const CONSOLATION_SEMIFINALS = 'Consolation Semifinals';
        const CONSOLATION_FINAL = 'Consolation Final';
        const FIFTH_PLACE_MATCH = 'Fifth Place Match';
        const FIRST_STAGE = 'First Stage';
        const GROUP_STAGE = 'Group Stage';
        const SECOND_STAGE = 'Second Stage';
        const CONSOLATION_STAGE = 'Consolation Stage';
        const QUALIFYING_STAGE = 'Qualifying Stage';

        const First = 1;
        const Second = 2;
        const AllStages = 3;

        const Disqualified = 0;
        const Group = 1;
        const Playoff = 2;
        const SecondRound = 3;
        const FinalRound = 4;
        const PreliminaryRound = 5;
        const FirstRound = 6;
        const ReplayFirstRound = 7;
        const Round16 = 8;
        const Quarterfinal = 9;
        const ReplayQuarterfinal = 10;
        const Consolation = 11;
        const ConsolationSemifinal = 12;
        const ConsolationFinal = 13;
        const FifthPlace = 14;
        const Semifinal = 15;
        const ThirdPlace = 16;
        const RunnerUp = 17;
        const Champion = 18;
        const BronzeMedal = 19;
        const SilverMedal = 20;
        const GoldMedal = 21;

        private $id;

        protected function __construct() { }

        public static function CreateSoccer($id) {
            $s = new Soccer();
            $s->id = $id;
            return $s;
        }

        public static function getStanding($tournament) {
            $matches = Match::getCompletedGroupMatches($tournament->getMatches());
            $team_array = Team::getTeamArrayById($tournament->getTeams());
            $tmp_array = array();
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                self::calculatePoint($team_array, $matches[$i], self::First);
            }
            foreach ($team_array as $name => $_team) {
                $tmp_array[$_team->getParentGroupName().$_team->getGroupName()][$_team->getName()] = $_team;
            }
            foreach ($tmp_array as $group_name => $_teams) {
                $tmp_array2 = array();
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array2, $_team);
                }
                $tmp_array[$group_name] = self::sortGroupStanding($tmp_array2, $matches);
            }
            foreach ($tmp_array as $group_name => $_teams) {
                foreach ($_teams as $_name => $_team) {
                    array_push($result, $_team);
                }
            }
            $tournament->setTeams($result);
            if ($tournament->getSimulationMode() == Tournament::SIMULATION_MODE_2) {
                self::round16Qualifiers($tournament);
                self::quarterfinalQualifiers($tournament);
                self::semifinalQualifiers($tournament);
                self::finalQualifiers($tournament);
            }
            elseif ($tournament->getSimulationMode() == Tournament::SIMULATION_MODE_1) {
                Scenario::calculateScenarios($tournament);
            }
        }

        public static function round16Qualifiers($tournament) {
            $teams = Team::getTeamArrayByGroup($tournament->getTeams());
            $round16_teams = array();
            $matches = $tournament->getMatches();
            foreach ($teams as $group_name => $_teams) {
                $i = 0;
                foreach ($_teams as $group_order => $_team) {
                    if ($i <= 1) {
                        $round16_teams[($i+1).$group_name] = $_team;
                    }
                    $i++;
                }
            }

            for ($i = 48; $i < 56; $i++ ) {
                $matches[$i]->setHomeTeamName($round16_teams[$matches[$i]->getWaitingHomeTeam()]->getName());
                $matches[$i]->setAwayTeamName($round16_teams[$matches[$i]->getWaitingAwayTeam()]->getName());
                $matches[$i]->setHomeTeamCode($round16_teams[$matches[$i]->getWaitingHomeTeam()]->getCode());
                $matches[$i]->setAwayTeamCode($round16_teams[$matches[$i]->getWaitingAwayTeam()]->getCode());
                $matches[$i]->setHomeFlag($round16_teams[$matches[$i]->getWaitingHomeTeam()]->getFlagFilename());
                $matches[$i]->setAwayFlag($round16_teams[$matches[$i]->getWaitingAwayTeam()]->getFlagFilename());
            }
            $tournament->setMatches($matches);
        }

        public static function quarterfinalQualifiers($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $quarterfinal_teams = array();
            $matches = $tournament->getMatches();
            for ($i = 48; $i < 56; $i++ ) {
                if (self::isHomeTeamWin($matches[$i])) {
                    $quarterfinal_teams['W'.($i+1)] = $teams[$matches[$i]->getHomeTeamName()];
                }
                else {
                    $quarterfinal_teams['W'.($i+1)] = $teams[$matches[$i]->getAwayTeamName()];
                }
            }
            for ($i = 56; $i < 60; $i++ ) {
                $matches[$i]->setHomeTeamName($quarterfinal_teams[$matches[$i]->getWaitingHomeTeam()]->getName());
                $matches[$i]->setAwayTeamName($quarterfinal_teams[$matches[$i]->getWaitingAwayTeam()]->getName());
                $matches[$i]->setHomeTeamCode($quarterfinal_teams[$matches[$i]->getWaitingHomeTeam()]->getCode());
                $matches[$i]->setAwayTeamCode($quarterfinal_teams[$matches[$i]->getWaitingAwayTeam()]->getCode());
                $matches[$i]->setHomeFlag($quarterfinal_teams[$matches[$i]->getWaitingHomeTeam()]->getFlagFilename());
                $matches[$i]->setAwayFlag($quarterfinal_teams[$matches[$i]->getWaitingAwayTeam()]->getFlagFilename());
            }
            for ($i = 48; $i <= 58 ; $i++) {
                for ($j = $i+1; $j <= 59; $j++) {
                    if ($matches[$i]->getBracketOrder() > $matches[$j]->getBracketOrder()) {
                        $tmp_m = $matches[$i];
                        $matches[$i] = $matches[$j];
                        $matches[$j] = $tmp_m;
                    }
                }
            }
            $tournament->setMatches($matches);
        }

        public static function semifinalQualifiers($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $semifinal_teams = array();
            $matches = $tournament->getMatches();
            for ($i = 56; $i < 60; $i++ ) {
                if (self::isHomeTeamWin($matches[$i])) {
                    $semifinal_teams['W'.($i+1)] = $teams[$matches[$i]->getHomeTeamName()];
                }
                else {
                    $semifinal_teams['W'.($i+1)] = $teams[$matches[$i]->getAwayTeamName()];
                }
            }
            for ($i = 60; $i < 62; $i++ ) {
                $matches[$i]->setHomeTeamName($semifinal_teams[$matches[$i]->getWaitingHomeTeam()]->getName());
                $matches[$i]->setAwayTeamName($semifinal_teams[$matches[$i]->getWaitingAwayTeam()]->getName());
                $matches[$i]->setHomeTeamCode($semifinal_teams[$matches[$i]->getWaitingHomeTeam()]->getCode());
                $matches[$i]->setAwayTeamCode($semifinal_teams[$matches[$i]->getWaitingAwayTeam()]->getCode());
                $matches[$i]->setHomeFlag($semifinal_teams[$matches[$i]->getWaitingHomeTeam()]->getFlagFilename());
                $matches[$i]->setAwayFlag($semifinal_teams[$matches[$i]->getWaitingAwayTeam()]->getFlagFilename());
            }
            $tournament->setMatches($matches);
        }

        public static function finalQualifiers($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $final_teams = array();
            $matches = $tournament->getMatches();
            if (self::isHomeTeamWin($matches[60])) {
                $final_teams['W61'] = $teams[$matches[60]->getHomeTeamName()];
                $final_teams['L61'] = $teams[$matches[60]->getAwayTeamName()];
            }
            else {
                $final_teams['W61'] = $teams[$matches[60]->getAwayTeamName()];
                $final_teams['L61'] = $teams[$matches[60]->getHomeTeamName()];
            }
            if (self::isHomeTeamWin($matches[61])) {
                $final_teams['W62'] = $teams[$matches[61]->getHomeTeamName()];
                $final_teams['L62'] = $teams[$matches[61]->getAwayTeamName()];
            }
            else {
                $final_teams['W62'] = $teams[$matches[61]->getAwayTeamName()];
                $final_teams['L62'] = $teams[$matches[61]->getHomeTeamName()];
            }
            for ($i = 62; $i < 64; $i++ ) {
                $matches[$i]->setHomeTeamName($final_teams[$matches[$i]->getWaitingHomeTeam()]->getName());
                $matches[$i]->setAwayTeamName($final_teams[$matches[$i]->getWaitingAwayTeam()]->getName());
                $matches[$i]->setHomeTeamCode($final_teams[$matches[$i]->getWaitingHomeTeam()]->getCode());
                $matches[$i]->setAwayTeamCode($final_teams[$matches[$i]->getWaitingAwayTeam()]->getCode());
                $matches[$i]->setHomeFlag($final_teams[$matches[$i]->getWaitingHomeTeam()]->getFlagFilename());
                $matches[$i]->setAwayFlag($final_teams[$matches[$i]->getWaitingAwayTeam()]->getFlagFilename());
            }
            $tournament->setMatches($matches);
        }

        public static function isHomeTeamWin($match) {
            if ($match->getHomeTeamScore() > $match->getAwayTeamScore()) {
                return true;
            }
            elseif ($match->getHomeTeamScore() == $match->getAwayTeamScore()) {
                if ($match->getHomeTeamExtraTimeScore() > $match->getAwayTeamExtraTimeScore()) {
                    return true;
                }
                elseif ($match->getHomeTeamExtraTimeScore() == $match->getAwayTeamExtraTimeScore()) {
                    if ($match->getHomeTeamPenaltyScore() > $match->getAwayTeamPenaltyScore()) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }

        public static function getFirstStageMatchesRanking($tournament) {
            $rounds = Round::getRoundArray($tournament, Soccer::FIRST_STAGE);
            foreach ($rounds as $round_id => $round) {
                switch ($round->getRoundName()) {
                    case Soccer::GROUP_MATCHES:
                        Soccer::getGroupMatchesRanking($tournament);
                        break;
                    case Soccer::SECOND_ROUND:
                        Soccer::getSecondRoundMatchesRanking($tournament);
                        break;
                    case Soccer::FINAL_ROUND:
                        Soccer::getFinalRoundMatchesRanking($tournament);
                        break;
                }
            }
        }

        public static function getGroupMatchesRanking($tournament) {
            $group_matches = Match::getGroupMatches($tournament->getMatches());
            $result = array();
            $teams_tmp = Team::getTeamArrayByGroup($tournament->getTeams());
            foreach ($teams_tmp as $group_name => $_teams) {
                $teams_tmp2 = array();
                foreach ($_teams as $team_name => $_team) {
                    array_push($teams_tmp2, $_team);
                }
                $teams = self::getGroupRanking($teams_tmp2, $group_matches, self::First);
                for ($i = 0; $i < sizeof($teams); $i++) {
                    array_push($result, $teams[$i]);
                }
            }
            $tournament->setTeams($result);
        }

        public static function getSecondRoundMatchesRanking($tournament) {
            $second_round_matches = Match::getSecondRoundMatches($tournament->getMatches());
            if (sizeof($second_round_matches) > 0) {
                self::updateSecondRoundTeams($tournament);
                $teams = self::getGroupRanking($tournament->getSecondRoundTeams(), $second_round_matches, self::First);
                $tournament->setSecondRoundTeams($teams);
            }
        }

        public static function getReplaySecondRoundMatchesRanking($tournament) {
            $replay_second_round_matches = Match::getReplaySecondRoundMatches($tournament->getMatches());
            if (sizeof($replay_second_round_matches) > 0) {
                $teams = self::getGroupRanking($tournament->getTeams(), $replay_second_round_matches, self::Second);
                $tournament->setTeams($teams);
            }
        }

        public static function getFinalRoundMatchesRanking($tournament) {
            $final_round_matches = Match::getFinalRoundMatches($tournament->getMatches());
            if (sizeof($final_round_matches) > 0) {
                self::updateFinalRoundTeams($tournament);
                $teams = self::getGroupRanking($tournament->getSecondRoundTeams(), $final_round_matches, self::First);
                $tournament->setSecondRoundTeams($teams);
            }
        }

        public static function updateFirstStageMatchesRanking($tournament) {
            $rounds = Round::getRoundArray($tournament, Soccer::FIRST_STAGE);
            foreach ($rounds as $round_id => $round) {
                switch ($round->getRoundName()) {
                    case Soccer::SECOND_ROUND:
                        Soccer::updateSecondRoundMatchesRanking($tournament);
                        break;
                    case Soccer::FINAL_ROUND:
                        Soccer::updateFinalRoundMatchesRanking($tournament);
                        break;
                    case Soccer::PLAY_OFF:
                        Soccer::updatePlayOffMatchesRanking($tournament);
                        break;
                }
            }
        }

        public static function updateSecondRoundMatchesRanking($tournament) {
            $second_round_matches = Match::getSecondRoundMatches($tournament->getMatches());
            if (sizeof($second_round_matches) > 0) {
                $teams = self::getGroupRanking($tournament->getTeams(), $second_round_matches, self::First);
                $tournament->setTeams($teams);
            }
        }

        public static function updateFinalRoundMatchesRanking($tournament) {
            $final_round_matches = Match::getFinalRoundMatches($tournament->getMatches());
            if (sizeof($final_round_matches) > 0) {
                $teams = self::getGroupRanking($tournament->getTeams(), $final_round_matches, self::First);
                $teams = Team::getTeamArrayByName($teams);
                $final_round_teams = $tournament->getSecondRoundTeams();
                $teams[$final_round_teams[0]->getName()]->setBestFinish(self::Champion);
                $teams[$final_round_teams[1]->getName()]->setBestFinish(self::RunnerUp);
                $teams[$final_round_teams[2]->getName()]->setBestFinish(self::ThirdPlace);
                if (sizeof($final_round_teams) > 3) {
                    $teams[$final_round_teams[3]->getName()]->setBestFinish(self::Semifinal);
                    if ($teams[$final_round_teams[3]->getName()]->getTournamentId() == SoccerHtml::CONCACAF_CHAMPIONSHIP_1985)
                        $teams[$final_round_teams[3]->getName()]->setBestFinish(self::Group);
                }
                $result = array();
                foreach ($teams as $name => $_team) {
                    array_push($result, $_team);
                }
                $tournament->setTeams($result);
            }
        }

        public static function updatePlayOffMatchesRanking($tournament) {
            $play_off_matches = Match::getPlayOffMatches($tournament->getMatches());
            if (sizeof($play_off_matches) > 0) {
                $teams = self::getGroupRanking($tournament->getTeams(), $play_off_matches, self::First);
                $tournament->setTeams($teams);
            }
        }

        public static function getSecondStageMatchesRanking($tournament) {
            $rounds = Round::getSecondStageRoundArray($tournament);
            foreach ($rounds as $round_id => $round) {
                switch ($round->getRoundName()) {
                    case Soccer::PRELIMINARY_ROUND:
                        Soccer::getPreliminaryRoundMatchesRanking($tournament);
                        break;
                    case Soccer::FIRST_ROUND:
                        Soccer::getFirstRoundMatchesRanking($tournament);
                        break;
                    case Soccer::REPLAY_FIRST_ROUND:
                        Soccer::getReplayFirstRoundMatchesRanking($tournament);
                        break;
                    case Soccer::ROUND16:
                        Soccer::getRound16MatchesRanking($tournament);
                        break;
                    case Soccer::REPLAY_ROUND16:
                        Soccer::getReplayRound16MatchesRanking($tournament);
                        break;
                    case Soccer::QUARTERFINALS:
                        Soccer::getAllQuarterfinalMatchesRanking($tournament);
                        break;
                    case Soccer::SEMIFINALS:
                        Soccer::getSemifinalMatchesRanking($tournament);
                        break;
                    case Soccer::CONSOLATION_ROUND:
                        Soccer::getConsolationMatchesRanking($tournament);
                        break;
                    case Soccer::CONSOLATION_SEMIFINALS:
                        Soccer::getConsolationSemifinalMatchesRanking($tournament);
                        break;
                    case Soccer::CONSOLATION_FINAL:
                        Soccer::getConsolationFinalMatchRanking($tournament);
                        break;
                    case Soccer::FIFTH_PLACE_MATCH:
                        Soccer::getFifthPlaceMatchRanking($tournament);
                        break;
                    case Soccer::BRONZE_MEDAL_MATCH:
                        Soccer::getBronzeMedalMatchRanking($tournament);
                        break;
                    case Soccer::REPLAY_BRONZE_MEDAL_MATCH:
                        Soccer::getReplayBronzeMedalMatchRanking($tournament);
                        break;
                    case Soccer::THIRD_PLACE:
                        Soccer::getThirdPlaceMatchRanking($tournament);
                        break;
                    case Soccer::GOLD_MEDAL_MATCH:
                        Soccer::getGoldMedalMatchRanking($tournament);
                        break;
                    case Soccer::REPLAY_GOLD_MEDAL_MATCH:
                        Soccer::getReplayGoldMedalMatchRanking($tournament);
                        break;
                    case Soccer::FINAL_:
                        Soccer::getFinalMatchRanking($tournament);
                        break;
                    case Soccer::REPLAY_FINAL:
                        Soccer::getReplayFinalMatchRanking($tournament);
                        break;
                    case Soccer::FINALS:
                        Soccer::getFinalMatchesRanking($tournament);
                        break;
                    case Soccer::FINAL_PLAYOFF:
                        Soccer::getFinalPlayoffMatchRanking($tournament);
                        break;
                }
            }
            Soccer::sortTournamentStanding($tournament);
        }

        public static function getPreliminaryRoundMatchesRanking($tournament) {
            $preliminary_round_matches = Match::getPreliminaryRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $preliminary_round_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getFirstRoundMatchesRanking($tournament) {
            $first_round_matches = Match::getFirstRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $first_round_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getReplayFirstRoundMatchesRanking($tournament) {
            $replay_first_round_matches = Match::getReplayFirstRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $replay_first_round_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getRound16MatchesRanking($tournament) {
            $round16_matches = Match::getRound16Matches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $round16_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getReplayRound16MatchesRanking($tournament) {
            $replay_round16_matches = Match::getReplayRound16Matches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $replay_round16_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getQuarterfinalMatchesRanking($tournament) {
            $quarterfinal_matches = Match::getQuarterfinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $quarterfinal_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getReplayQuarterfinalMatchesRanking($tournament) {
            $replay_quarterfinal_matches = Match::getReplayQuarterfinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $replay_quarterfinal_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getAllQuarterfinalMatchesRanking($tournament) {
            $all_quarterfinal_matches = Match::getAllQuarterfinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $all_quarterfinal_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getSemifinalMatchesRanking($tournament) {
            $semifinal_matches = Match::getSemifinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $semifinal_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getConsolationMatchesRanking($tournament) {
            $consolation_matches = Match::getConsolationMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $consolation_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getConsolationSemifinalMatchesRanking($tournament) {
            $consolation_semifinal_matches = Match::getConsolationSemifinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $consolation_semifinal_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getConsolationFinalMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $consolation_final_match = Match::getConsolationFinalMatch($tournament->getMatches());
            if ($consolation_final_match != null) {
                self::calculatePoint($teams, $consolation_final_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getFifthPlaceMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $fifth_place_match = Match::getFifthPlaceMatch($tournament->getMatches());
            if ($fifth_place_match != null) {
                self::calculatePoint($teams, $fifth_place_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getBronzeMedalMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $bronze_medal_match = Match::getBronzeMedalMatch($tournament->getMatches());
            if ($bronze_medal_match != null) {
                self::calculatePoint($teams, $bronze_medal_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getReplayBronzeMedalMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $replay_bronze_medal_match = Match::getReplayBronzeMedalMatch($tournament->getMatches());
            if ($replay_bronze_medal_match != null) {
                self::calculatePoint($teams, $replay_bronze_medal_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getGoldMedalMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $gold_medal_match = Match::getGoldMedalMatch($tournament->getMatches());
            if ($gold_medal_match != null) {
                self::calculatePoint($teams, $gold_medal_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getReplayGoldMedalMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $replay_gold_medal_match = Match::getReplayGoldMedalMatch($tournament->getMatches());
            if ($replay_gold_medal_match != null) {
                self::calculatePoint($teams, $replay_gold_medal_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getThirdPlaceMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $third_place_match = Match::getThirdPlaceMatch($tournament->getMatches());
            if ($third_place_match != null) {
                self::calculatePoint($teams, $third_place_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $teams_tmp = self::sortGroupStanding($teams_tmp, $tournament->getMatches());
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getFinalMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $champion_match = Match::getFinalMatch($tournament->getMatches());
            if ($champion_match != null) {
                self::calculatePoint($teams, $champion_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getReplayFinalMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $replay_final_match = Match::getReplayFinalMatch($tournament->getMatches());
            if ($replay_final_match != null) {
                self::calculatePoint($teams, $replay_final_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getFinalMatchesRanking($tournament) {
            $final_matches = Match::getFinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $final_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getFinalPlayoffMatchRanking($tournament) {
            $teams = Team::getTeamArrayById($tournament->getTeams());
            $final_playoff_match = Match::getFinalPlayoffMatch($tournament->getMatches());
            if ($final_playoff_match != null) {
                self::calculatePoint($teams, $final_playoff_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getAllTimeRanking($tournament) {
            $teams = self::getGroupRanking($tournament->getTeams(), $tournament->getMatches(), self::AllStages);
            $tournament->setTeams($teams);
        }

        public static function getAllTimeTeamTournamentRanking($tournament) {
            $tt = array();
            $srtt = array();
            $tm = array();
            $result = array();
            $tournament_teams = $tournament->getTournamentTeams();
            $second_round_tournament_teams = $tournament->getSecondRoundTournamentTeams();
            $tournament_matches = $tournament->getMatches();
            for ($i = 0; $i < sizeof($tournament_teams); $i++ ) {
                $tt[$tournament_teams[$i]->getTournamentName()] = array();
            }
            for ($i = 0; $i < sizeof($second_round_tournament_teams); $i++ ) {
                $srtt[$second_round_tournament_teams[$i]->getTournamentName()] = array();
            }
            for ($i = 0; $i < sizeof($tournament_matches); $i++ ) {
                $tm[$tournament_matches[$i]->getTournamentName()] = array();
            }
            for ($i = 0; $i < sizeof($tournament_teams); $i++ ) {
                array_push($tt[$tournament_teams[$i]->getTournamentName()], $tournament_teams[$i]);
            }
            for ($i = 0; $i < sizeof($second_round_tournament_teams); $i++ ) {
                array_push($srtt[$second_round_tournament_teams[$i]->getTournamentName()], $second_round_tournament_teams[$i]);
            }
            for ($i = 0; $i < sizeof($tournament_matches); $i++ ) {
                array_push($tm[$tournament_matches[$i]->getTournamentName()], $tournament_matches[$i]);
            }
            foreach ($tt as $tournament_name => $_teams) {
                if (array_key_exists($tournament_name, $tm)) {
                    $t = Tournament::CreateSoccerTournamentByTeams($tt[$tournament_name], $srtt[$tournament_name], $tm[$tournament_name]);
                    Round::getRounds($t);
                    self::getFirstStageMatchesRanking($t);
                    Soccer::updateFirstStageMatchesRanking($t);
                    Soccer::getSecondStageMatchesRanking($t);
                    $tt[$tournament_name] = $t->getTeams();
                }
            }
            foreach ($tt as $tournament_name => $_teams) {
                for ($i = 0; $i < sizeof($_teams); $i++ ) {
                    array_push($result, $_teams[$i]);
                }
            }
            $tournament->setTournamentTeams($result);
        }

        public static function getGroupRanking($teams, $matches, $stage) {
            $teams_tmp = Team::getTeamArrayById($teams);
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                self::calculatePoint($teams_tmp, $matches[$i], $stage);
            }
            foreach ($teams_tmp as $name => $_team) {
                array_push($result, $_team);
            }
            $result2 = self::sortGroupStanding($result, $matches);
            return $result2;
        }

        public static function calculatePoint(&$teams, $match, $stage) {
            if ($match->getSecondRoundGroupName() == self::WITHDREW) return;
            if ($match->getHomeTeamScore() == -1) return;
            $all_time_ranking = $stage == self::AllStages;
            $points_for_win = 3;
            if ($match->getPointsForWin() == 2 && !$all_time_ranking) $points_for_win = 2;
            $no_extra_time = $stage == self::First && $match->getRound() != self::PLAY_OFF && $match->getTournamentId() != SoccerHtml::SWITZERLAND_1954;
            $home_id = $match->getHomeTeamId();
            $away_id = $match->getAwayTeamId();
            if ($all_time_ranking && $match->getHomeParentTeamId() != null) {
                $home_id = $match->getHomeParentTeamId();
            }
            if ($all_time_ranking && $match->getAwayParentTeamId() != null) {
                $away_id = $match->getAwayParentTeamId();
            }
            if (!array_key_exists($home_id, $teams) || !array_key_exists($away_id, $teams)) return;
            $home_team = $teams[$home_id];
            $away_team = $teams[$away_id];
            $home_score = $match->getHomeTeamScore();
            $away_score = $match->getAwayTeamScore();
            $home_extra_time_score = $match->getHomeTeamExtraTimeScore();
            $away_extra_time_score = $match->getAwayTeamExtraTimeScore();
            $home_penalty_score = $match->getHomeTeamPenaltyScore();
            $away_penalty_score = $match->getAwayTeamPenaltyScore();
            $home_team->setMatchPlay($home_team->getMatchPlay() + 1);
            $away_team->setMatchPlay($away_team->getMatchPlay() + 1);
            $home_team->setBestFinish(self::getFinish($match));
            $away_team->setBestFinish(self::getFinish($match));
            if ($home_score > $away_score) {
                $home_team->setWin($home_team->getWin() + 1);
                $home_team->setPoint($home_team->getPoint() + $points_for_win);
                $away_team->setLoss($away_team->getLoss() + 1);
                self::resetBestFinish($match, $away_team);
            }
            elseif ($home_score < $away_score) {
                $home_team->setLoss($home_team->getLoss() + 1);
                $away_team->setWin($away_team->getWin() + 1);
                $away_team->setPoint($away_team->getPoint() + $points_for_win);
                self::resetBestFinish($match, $home_team);
            }
            else {
                if ($no_extra_time) {
                    $home_team->setDraw($home_team->getDraw() + 1);
                    $home_team->setPoint($home_team->getPoint() + 1);
                    $away_team->setDraw($away_team->getDraw() + 1);
                    $away_team->setPoint($away_team->getPoint() + 1);
                }
                else {
                    if ($home_extra_time_score > $away_extra_time_score) {
                        $home_team->setWin($home_team->getWin() + 1);
                        $home_team->setPoint($home_team->getPoint() + $points_for_win);
                        $away_team->setLoss($away_team->getLoss() + 1);
                        self::resetBestFinish($match, $away_team);
                    }
                    elseif ($home_extra_time_score < $away_extra_time_score) {
                        $home_team->setLoss($home_team->getLoss() + 1);
                        $away_team->setWin($away_team->getWin() + 1);
                        $away_team->setPoint($away_team->getPoint() + $points_for_win);
                        self::resetBestFinish($match, $home_team);
                    }
                    else {
                        $home_team->setDraw($home_team->getDraw() + 1);
                        $home_team->setPoint($home_team->getPoint() + 1);
                        $away_team->setDraw($away_team->getDraw() + 1);
                        $away_team->setPoint($away_team->getPoint() + 1);
                        if ($home_penalty_score > $away_penalty_score) {
                            self::resetBestFinish($match, $away_team);
                        }
                        else {
                            self::resetBestFinish($match, $home_team);
                        }
                        if ($match->getTournamentId() == SoccerHtml::COPA_1979 && $match->getHomeTeamName() == 'PARAGUAY') {
                            $home_team->setBestFinish(self::Champion);
                            $away_team->setBestFinish(self::RunnerUp);
                        }
                    }
                }
            }
            $home_team->setGoalFor($home_team->getGoalFor() + $home_score);
            $home_team->setGoalAgainst($home_team->getGoalAgainst() + $away_score);
            $home_team->setGoalDiff($home_team->getGoalDiff() + $home_score - $away_score);
            $away_team->setGoalFor($away_team->getGoalFor() + $away_score);
            $away_team->setGoalAgainst($away_team->getGoalAgainst() + $home_score);
            $away_team->setGoalDiff($away_team->getGoalDiff() + $away_score - $home_score);
            if (!$no_extra_time && $home_score == $away_score) {
                $home_team->setGoalFor($home_team->getGoalFor() + $home_extra_time_score);
                $home_team->setGoalAgainst($home_team->getGoalAgainst() + $away_extra_time_score);
                $home_team->setGoalDiff($home_team->getGoalDiff() + $home_extra_time_score - $away_extra_time_score);
                $away_team->setGoalFor($away_team->getGoalFor() + $away_extra_time_score);
                $away_team->setGoalAgainst($away_team->getGoalAgainst() + $home_extra_time_score);
                $away_team->setGoalDiff($away_team->getGoalDiff() + $away_extra_time_score - $home_extra_time_score);
            }
            if ($match->getTournamentId() == SoccerHtml::PERU_1953) {
                if ($match->getHomeTeamName() == 'PERU' && $match->getAwayTeamName() == 'PARAGUAY') {
                    $home_team->setWin($home_team->getWin() + 1);
                    $home_team->setDraw($home_team->getDraw() - 1);
                    $home_team->setPoint($home_team->getPoint() + 1);
                    $away_team->setDraw($away_team->getDraw() - 1);
                    $away_team->setLoss($away_team->getLoss() + 1);
                    $away_team->setPoint($away_team->getPoint() - 1);
                }
                if ($match->getHomeTeamName() == 'CHILE' && $match->getAwayTeamName() == 'BOLIVIA') {
                    $home_team->setWin($home_team->getWin() + 1);
                    $home_team->setDraw($home_team->getDraw() - 1);
                    $home_team->setPoint($home_team->getPoint() + 1);
                    $away_team->setDraw($away_team->getDraw() - 1);
                    $away_team->setLoss($away_team->getLoss() + 1);
                    $away_team->setPoint($away_team->getPoint() - 1);
                }
                if ($match->getRound() == self::PLAY_OFF) {
                    $home_team->setBestFinish(self::Champion);
                    $away_team->setBestFinish(self::RunnerUp);
                }
            }
            if ($match->getTournamentId() == SoccerHtml::BRAZIL_1949) {
                if ($match->getRound() == self::PLAY_OFF) {
                    $home_team->setBestFinish(self::Champion);
                    $away_team->setBestFinish(self::RunnerUp);
                }
            }
            if ($match->getTournamentId() == SoccerHtml::URUGUAY_1942) {
                if ($match->getHomeTeamName() == 'ARGENTINA' && $match->getAwayTeamName() == 'CHILE') {
                    $home_team->setWin($home_team->getWin() + 1);
                    $home_team->setDraw($home_team->getDraw() - 1);
                    $home_team->setPoint($home_team->getPoint() + 1);
                    $away_team->setDraw($away_team->getDraw() - 1);
                    $away_team->setLoss($away_team->getLoss() + 1);
                    $away_team->setPoint($away_team->getPoint() - 1);
                }
            }
            if ($match->getTournamentId() == SoccerHtml::ARGENTINA_1937) {
                if ($match->getRound() == self::PLAY_OFF) {
                    $home_team->setBestFinish(self::Champion);
                    $away_team->setBestFinish(self::RunnerUp);
                }
            }
            if ($match->getTournamentId() == SoccerHtml::BRAZIL_1922) {
                if ($match->getRound() == self::PLAY_OFF) {
                    $home_team->setBestFinish(self::Champion);
                    $away_team->setBestFinish(self::RunnerUp);
                }
            }
            if ($match->getTournamentId() == SoccerHtml::BRAZIL_1919) {
                if ($match->getRound() == self::PLAY_OFF) {
                    $home_team->setBestFinish(self::Champion);
                    $away_team->setBestFinish(self::RunnerUp);
                }
            }
            if ($match->getTournamentId() == SoccerHtml::URUGUAY_1930) {
                if ($match->getRound() == self::SEMIFINALS && $match->getAwayTeamName() == 'UNITED STATES') {
                    $away_team->setBestFinish(self::ThirdPlace);
                }
            }
        }

        public static function sortGroupStanding($teams, $matches) {
            $teams_copy = $teams;
            for ($i = 0; $i < sizeof($teams) - 1; $i++) {
                for ($j = $i + 1; $j < sizeof($teams); $j++) {
                    self::compareTeams($teams_copy[$i], $teams_copy[$j], $matches);
                }
            }
            return $teams_copy;
        }

        public static function compareTeams(&$team1, &$team2, $matches) {
            if (self::isEqualStanding($team1, $team2)) {
                if ($team1->getTournamentId() == SoccerHtml::GOLD_CUP_2002 &&  $team1->getName() == 'CANADA') return;
                if ($team1->getTournamentId() == SoccerHtml::ANGOLA_2010 &&  $team1->getGroupName() == 'D' &&  $team2->getGroupName() == 'D') return;
                $still_tie = self::applyTiebreaker($team1, $team2, $matches);
                if (self::isTieBreakerHead2HeadFirst($team1->getTournamentId())) {
                    if ($still_tie && self::isHigherStanding($team2, $team1)) {
                        self::swapTeam($team1, $team2);
                    }
                    if (self::isAlwaysEqualStanding($team1, $team2)) self::alphabetOrder($team1, $team2);
                }
                else {
                    if ($still_tie) $still_tie = self::fairPlayRule($team1, $team2);
                    if ($still_tie) $still_tie = self::drawingLots($team1, $team2);
                    if ($still_tie) self::alphabetOrder($team1, $team2);
                }
                if ($team1->getTournamentId() == SoccerHtml::SWEDEN_1958 &&  $team1->getName() == 'ENGLAND' &&  $team2->getName() == 'SOVIET UNION')
                    self::swapTeam($team1, $team2);
            }
            elseif (self::isHigherStanding($team2, $team1)) {
                if ($team1->getTournamentId() == SoccerHtml::SWITZERLAND_1954 &&  $team1->getName() == 'WEST GERMANY' &&  $team2->getName() == 'TURKEY') return;
                if ($team1->getTournamentId() == SoccerHtml::SWITZERLAND_1954 &&  $team1->getName() == 'SWITZERLAND' &&  $team2->getName() == 'ITALY') return;
                if ($team1->getTournamentId() == SoccerHtml::SWEDEN_1958 &&  $team1->getName() == 'NORTHERN IRELAND' &&  $team2->getName() == 'CZECHOSLOVAKIA') return;
                if ($team1->getTournamentId() == SoccerHtml::TUNISIA_1965 &&  $team1->getName() == 'TUNISIA') return;
                    self::swapTeam($team1, $team2);
            }
            else {
                if ($team1->getTournamentId() == SoccerHtml::SWEDEN_1958 &&  $team1->getName() == 'HUNGARY' &&  $team2->getName() == 'WALES')
                    self::swapTeam($team1, $team2);
                if ($team1->getTournamentId() == SoccerHtml::SWITZERLAND_1954 &&  $team1->getName() == 'TURKEY' &&  $team2->getName() == 'WEST GERMANY')
                    self::swapTeam($team1, $team2);
            }
        }

        public static function isTieBreakerHead2HeadFirst($tournament_id) {
            return ($tournament_id >= SoccerHtml::FRANCE_2016 && $tournament_id <= SoccerHtml::ENGLAND_1996)
                || $tournament_id == SoccerHtml::GOLD_CUP_2009 || $tournament_id == SoccerHtml::GOLD_CUP_2007
                || $tournament_id == SoccerHtml::EQUATORIAL_GUINEA_2015 || $tournament_id == SoccerHtml::ANGOLA_2010;
        }

        public static function sortTournamentStanding($tournament) {
            $teams = $tournament->getTeams();
            if (sizeof($tournament->getMatches()) == 0) return;
            if (sizeof($teams) == 0) return;
            $result = array();
            $teams_tmp = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $teams_tmp[$teams[$i]->getBestFinish()][$teams[$i]->getName()] = $teams[$i];
            }
            if (array_key_exists(self::Champion, $teams_tmp)) {
                foreach ($teams_tmp[self::Champion] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::RunnerUp, $teams_tmp)) {
                foreach ($teams_tmp[self::RunnerUp] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::ThirdPlace, $teams_tmp)) {
                foreach ($teams_tmp[self::ThirdPlace] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::GoldMedal, $teams_tmp)) {
                foreach ($teams_tmp[self::GoldMedal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::SilverMedal, $teams_tmp)) {
                foreach ($teams_tmp[self::SilverMedal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::BronzeMedal, $teams_tmp)) {
                foreach ($teams_tmp[self::BronzeMedal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::Semifinal, $teams_tmp)) {
                foreach ($teams_tmp[self::Semifinal] as $name => $_team) {
                    if ($name == 'USA' && $tournament->getTournamentId() == SoccerHtml::URUGUAY_1930) {
                        $_team->setBestFinish(self::ThirdPlace);
                    }
                    if ($name == 'GERMANY DR') {
                        $_team->setBestFinish(self::BronzeMedal);
                    }
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::FifthPlace, $teams_tmp)) {
                foreach ($teams_tmp[self::FifthPlace] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::ConsolationFinal, $teams_tmp)) {
                foreach ($teams_tmp[self::ConsolationFinal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::ConsolationSemifinal, $teams_tmp)) {
                foreach ($teams_tmp[self::ConsolationSemifinal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::Consolation, $teams_tmp)) {
                foreach ($teams_tmp[self::Consolation] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::ReplayQuarterfinal, $teams_tmp)) {
                foreach ($teams_tmp[self::ReplayQuarterfinal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::Quarterfinal, $teams_tmp)) {
                foreach ($teams_tmp[self::Quarterfinal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::Round16, $teams_tmp)) {
                foreach ($teams_tmp[self::Round16] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::ReplayFirstRound, $teams_tmp)) {
                foreach ($teams_tmp[self::ReplayFirstRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::FirstRound, $teams_tmp)) {
                foreach ($teams_tmp[self::FirstRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::PreliminaryRound, $teams_tmp)) {
                foreach ($teams_tmp[self::PreliminaryRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::FinalRound, $teams_tmp)) {
                foreach ($teams_tmp[self::FinalRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::SecondRound, $teams_tmp)) {
                foreach ($teams_tmp[self::SecondRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::Playoff, $teams_tmp)) {
                foreach ($teams_tmp[self::Playoff] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::Group, $teams_tmp)) {
                foreach ($teams_tmp[self::Group] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(self::Disqualified, $teams_tmp)) {
                foreach ($teams_tmp[self::Disqualified] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            $tournament->setTeams($result);
        }

        public static function updateSecondRoundTeams($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getSecondRoundTeams());
            $matches = Match::getSecondRoundMatches($tournament->getMatches());
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                $teams[$matches[$i]->getHomeTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
                $teams[$matches[$i]->getAwayTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
            }
        }

        public static function updateFinalRoundTeams($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getSecondRoundTeams());
            $matches = Match::getFinalRoundMatches($tournament->getMatches());
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                $teams[$matches[$i]->getHomeTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
                $teams[$matches[$i]->getAwayTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
            }
        }

        public static function resetBestFinish($match, $team) {
            if ($match->getRound() == self::FIFTH_PLACE_MATCH) {
                $team->setBestFinish(self::Quarterfinal);
                if ($team->getName() == 'YUGOSLAVIA' && $match->getTournamentId() == SoccerHtml::TOKYO_1964) $team->setBestFinish(self::ConsolationFinal);
            }
            if ($match->getRound() == self::BRONZE_MEDAL_MATCH) {
                $team->setBestFinish(self::Semifinal);
                if ($team->getName() == 'SWEDEN' && $match->getTournamentId() == SoccerHtml::LONDON_1908) $team->setBestFinish(self::Quarterfinal);
                if ($team->getName() == 'EAST GERMANY' && $match->getTournamentId() == SoccerHtml::MUNICH_1972) $team->setBestFinish(self::BronzeMedal);
            }
            if ($match->getRound() == self::REPLAY_BRONZE_MEDAL_MATCH) {
                $team->setBestFinish(self::Semifinal);
            }
            if ($match->getRound() == self::GOLD_MEDAL_MATCH) {
                $team->setBestFinish(self::SilverMedal);
                if ($team->getName() == 'CZECHOSLOVAKIA' && $match->getTournamentId() == SoccerHtml::ANTWERP_1920) $team->setBestFinish(self::Disqualified);
            }
            if ($match->getRound() == self::REPLAY_GOLD_MEDAL_MATCH) {
                $team->setBestFinish(self::SilverMedal);
            }
            if ($match->getRound() == self::THIRD_PLACE) {
                $team->setBestFinish(self::Semifinal);
                if ($match->getTournamentId() == SoccerHtml::GOLD_CUP_1993) $team->setBestFinish(self::ThirdPlace);
            }
            if ($match->getRound() == self::FINAL_) {
                $team->setBestFinish(self::RunnerUp);
            }
            if ($match->getRound() == self::REPLAY_FINAL) {
                $team->setBestFinish(self::RunnerUp);
            }
            if ($match->getRound() == self::FINALS) {
                $team->setBestFinish(self::RunnerUp);
            }
            if ($match->getRound() == self::FINAL_PLAYOFF) {
                $team->setBestFinish(self::RunnerUp);
            }
            if ($match->getRound() == self::CONSOLATION_FINAL) {
                $team->setBestFinish(self::ConsolationFinal);
                if ($match->getTournamentId() == SoccerHtml::ANTWERP_1920) $team->setBestFinish(self::BronzeMedal);
            }
        }

        public static function getFinish($match) {
            switch ($match->getRound()) {
                case self::GROUP_MATCHES:
                    $best_finish = self::Group;
                    break;
                case self::PLAY_OFF:
                    $best_finish = self::Playoff;
                    break;
                case self::MATCH_DAY_1:
                    $best_finish = self::Group;
                    break;
                case self::MATCH_DAY_2:
                    $best_finish = self::Group;
                    break;
                case self::MATCH_DAY_3:
                    $best_finish = self::Group;
                    break;
                case self::MATCH_DAY_4:
                    $best_finish = self::Group;
                    break;
                case self::MATCH_DAY_5:
                    $best_finish = self::Group;
                    break;
                case self::MATCH_DAY_6:
                    $best_finish = self::Group;
                    break;
                case self::SECOND_ROUND:
                    $best_finish = self::SecondRound;
                    break;
                case self::FINAL_ROUND:
                    $best_finish = self::FinalRound;
                    break;
                case self::PRELIMINARY_ROUND:
                    $best_finish = self::PreliminaryRound;
                    break;
                case self::FIRST_ROUND:
                    $best_finish = self::FirstRound;
                    break;
                case self::REPLAY_FIRST_ROUND:
                    $best_finish = self::ReplayFirstRound;
                    break;
                case self::ROUND16:
                    $best_finish = self::Round16;
                    break;
                case self::REPLAY_ROUND16:
                    $best_finish = self::Round16;
                    break;
                case self::QUARTERFINALS:
                    $best_finish = self::Quarterfinal;
                    break;
                case self::REPLAY_QUARTERFINALS:
                    $best_finish = self::Quarterfinal;
                    break;
                case self::CONSOLATION_ROUND:
                    $best_finish = self::Consolation;
                    break;
                case self::CONSOLATION_SEMIFINALS:
                    $best_finish = self::ConsolationSemifinal;
                    break;
                case self::FIFTH_PLACE_MATCH:
                    $best_finish = self::FifthPlace;
                    break;
                case self::SEMIFINALS:
                    $best_finish = self::Semifinal;
                    break;
                case self::BRONZE_MEDAL_MATCH:
                    $best_finish = self::BronzeMedal;
                    break;
                case self::REPLAY_BRONZE_MEDAL_MATCH:
                    $best_finish = self::BronzeMedal;
                    break;
                case self::GOLD_MEDAL_MATCH:
                    $best_finish = self::GoldMedal;
                    break;
                case self::REPLAY_GOLD_MEDAL_MATCH:
                    $best_finish = self::GoldMedal;
                    break;
                case self::THIRD_PLACE:
                    $best_finish = self::ThirdPlace;
                    break;
                case self::CONSOLATION_FINAL:
                    $best_finish = self::FifthPlace;
                    if ($match->getTournamentId() == SoccerHtml::ANTWERP_1920) $best_finish = self::SilverMedal;
                    break;
                case self::REPLAY_FINAL:
                    $best_finish = self::Champion;
                    break;
                case self::FINALS:
                    $best_finish = self::Champion;
                    break;
                case self::FINAL_PLAYOFF:
                    $best_finish = self::Champion;
                    break;
                default:
                    $best_finish = self::Champion;
                    break;
            }
            return $best_finish;
        }

        public static function isHigherStanding($t1, $t2) {
            if ($t1->getMatchPlay() == 0) return false;
            if ($t2->getMatchPlay() == 0) return true;
            if ($t1->getPoint() > $t2->getPoint()) {
                return true;
            }
            elseif ($t1->getPoint() == $t2->getPoint()) {
                if ($t1->getGoalDiff() > $t2->getGoalDiff()) {
                    return true;
                }
                elseif ($t1->getGoalDiff() == $t2->getGoalDiff()) {
                    if ($t1->getGoalFor() > $t2->getGoalFor()) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }

        public static function isEqualStanding($t1, $t2) {
            if (self::isTieBreakerHead2HeadFirst($t1->getTournamentId()))
                return $t1->getPoint() == $t2->getPoint();
            else
                return self::isAlwaysEqualStanding($t1, $t2);
        }

        public static function isAlwaysEqualStanding($t1, $t2) {
            return $t1->getPoint() == $t2->getPoint() && $t1->getGoalDiff() == $t2->getGoalDiff()
                && $t1->getGoalFor() == $t2->getGoalFor();
        }

        public static function applyTiebreaker(&$t1, &$t2, $matches) {
            $still_tie = true;
            $i = 0;
            while ($still_tie && $i != sizeof($matches)) {
                if ($matches[$i]->getHomeTeamName() == $t1->getName() && $matches[$i]->getAwayTeamName() == $t2->getName()) {
                    if ($matches[$i]->getHomeTeamScore() < $matches[$i]->getAwayTeamScore()) {
                        self::swapTeam($t1, $t2);
                        $still_tie = false;
                    }
                    elseif ($matches[$i]->getHomeTeamScore() > $matches[$i]->getAwayTeamScore()) {
                        $still_tie = false;
                    }
                }
                elseif ($matches[$i]->getAwayTeamName() == $t1->getName() && $matches[$i]->getHomeTeamName() == $t2->getName()) {
                    if ($matches[$i]->getAwayTeamScore() < $matches[$i]->getHomeTeamScore()) {
                        self::swapTeam($t1, $t2);
                        $still_tie = false;
                    }
                    elseif ($matches[$i]->getAwayTeamScore() > $matches[$i]->getHomeTeamScore()) {
                        $still_tie = false;
                    }
                }
                $i++;
            }
            return $still_tie;
        }

        public static function fairPlayRule(&$t1, &$t2) {
            if ($t2->getName() == 'JAPAN' && $t2->getTournamentId() == SoccerHtml::RUSSIA_2018) {
               self::swapTeam($t1, $t2);
               return false;
            }
            return true;
        }

        public static function drawingLots(&$t1, &$t2) {
            $still_tie = true;
            if ($t2->getName() == 'REPUBLIC OF IRELAND' && $t2->getTournamentId() == SoccerHtml::ITALY_1990) {
                self::swapTeam($t1, $t2);
                $still_tie = false;
            }
            elseif ($t2->getName() == 'NETHERLANDS' && $t2->getTournamentId() == SoccerHtml::ITALY_1990) {
                $still_tie = false;
            }
            return $still_tie;
        }

        public static function alphabetOrder(&$t1, &$t2) {
            if (strcasecmp(substr($t1->getName(), 0, 3) , substr($t2->getName(), 0, 3)) > 0) {
                self::swapTeam($t1, $t2);
            }
//            else {
//                self::coinToss($t1, $t2);
//            }
        }

        public static function coinToss(&$t1, &$t2) {
            $coin = mt_rand(0,1);
            if ($coin == 1) self::swapTeam($t1, $t2);
        }

        public static function swapTeam(&$t1, &$t2) {
            $tmp_t = $t1;
            $t1 = $t2;
            $t2 = $tmp_t;
        }

        public static function randomMatchScore($row) {
            $tmp_row = $row;
            $tmp_row['home_team_score'] = mt_rand(0,6);
            $tmp_row['away_team_score'] = mt_rand(0,6);
            if ($tmp_row['home_team_score'] == $tmp_row['away_team_score']) {
                $tmp_row['home_team_extra_time_score'] = mt_rand(0,3);
                $tmp_row['away_team_extra_time_score'] = mt_rand(0,3);
            }
            if ($tmp_row['home_team_extra_time_score'] == $tmp_row['away_team_extra_time_score']) {
                $rand = mt_rand(0,21);
                switch ($rand) {
                    case 0:
                        $tmp_row['home_team_penalty_score'] = 1;
                        $tmp_row['away_team_penalty_score'] = 0;
                        break;
                    case 1:
                        $tmp_row['home_team_penalty_score'] = 2;
                        $tmp_row['away_team_penalty_score'] = 0;
                        break;
                    case 2:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 0;
                        break;
                    case 3:
                        $tmp_row['home_team_penalty_score'] = 2;
                        $tmp_row['away_team_penalty_score'] = 1;
                        break;
                    case 4:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 1;
                        break;
                    case 5:
                        $tmp_row['home_team_penalty_score'] = 4;
                        $tmp_row['away_team_penalty_score'] = 1;
                        break;
                    case 6:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 2;
                        break;
                    case 7:
                        $tmp_row['home_team_penalty_score'] = 4;
                        $tmp_row['away_team_penalty_score'] = 2;
                        break;
                    case 8:
                        $tmp_row['home_team_penalty_score'] = 4;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 9:
                        $tmp_row['home_team_penalty_score'] = 5;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 10:
                        $tmp_row['home_team_penalty_score'] = 5;
                        $tmp_row['away_team_penalty_score'] = 4;
                        break;
                    case 11:
                        $tmp_row['home_team_penalty_score'] = 0;
                        $tmp_row['away_team_penalty_score'] = 1;
                        break;
                    case 12:
                        $tmp_row['home_team_penalty_score'] = 0;
                        $tmp_row['away_team_penalty_score'] = 2;
                        break;
                    case 13:
                        $tmp_row['home_team_penalty_score'] = 0;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 14:
                        $tmp_row['home_team_penalty_score'] = 1;
                        $tmp_row['away_team_penalty_score'] = 2;
                        break;
                    case 15:
                        $tmp_row['home_team_penalty_score'] = 1;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 16:
                        $tmp_row['home_team_penalty_score'] = 1;
                        $tmp_row['away_team_penalty_score'] = 4;
                        break;
                    case 17:
                        $tmp_row['home_team_penalty_score'] = 2;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 18:
                        $tmp_row['home_team_penalty_score'] = 2;
                        $tmp_row['away_team_penalty_score'] = 4;
                        break;
                    case 19:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 4;
                        break;
                    case 20:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 5;
                        break;
                    default:
                        $tmp_row['home_team_penalty_score'] = 4;
                        $tmp_row['away_team_penalty_score'] = 5;
                }
            }
            return $tmp_row;
        }

        public static function mockGroupAScore($matches) {
            $matches[0]->setHomeTeamScore(1);
            $matches[0]->setAwayTeamScore(0);
            $matches[1]->setHomeTeamScore(1);
            $matches[1]->setAwayTeamScore(0);
            $matches[16]->setHomeTeamScore(1);
            $matches[16]->setAwayTeamScore(0);
            $matches[18]->setHomeTeamScore(1);
            $matches[18]->setAwayTeamScore(0);
            $matches[32]->setHomeTeamScore(1);
            $matches[32]->setAwayTeamScore(0);
            $matches[33]->setHomeTeamScore(3);
            $matches[33]->setAwayTeamScore(3);
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }
    }
