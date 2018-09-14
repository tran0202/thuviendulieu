<?php

    class Soccer {

        const GROUP_MATCHES = 'Group Matches';
        const WITHDREW = 'Withdrew';
        const SECOND_ROUND = 'Second Round';
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
        const ROUND16 = 'Round of 16';
        const QUARTERFINALS = 'Quarterfinals';
        const REPLAY_QUARTERFINALS = 'Replay Quarterfinals';
        const SEMIFINALS = 'Semifinals';
        const THIRD_PLACE = 'Third place';
        const FINAL_ = 'Final';
        const BRONZE_MEDAL_MATCH = 'Bronze Medal Match';
        const GOLD_MEDAL_MATCH = 'Gold Medal Match';
        const CONSOLATION_ROUND = 'Consolation Round';
        const FIFTH_PLACE_MATCH = 'Fifth Place Match';
        const FIRST_STAGE = 'First Stage';
        const GROUP_STAGE = 'Group Stage';
        const SECOND_STAGE = 'Second Stage';

        const First = 1;
        const Second = 2;
        const AllStages = 3;

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
        const FifthPlace = 11;
        const Semifinal = 12;
        const ThirdPlace = 13;
        const RunnerUp = 14;
        const Champion = 15;
        const BronzeMedal = 16;
        const SilverMedal = 17;
        const GoldMedal = 18;

        private $id;

        protected function __construct() { }

        public static function CreateSoccer($id) {
            $s = new Soccer();
            $s->id = $id;
            return $s;
        }

        public static function getStanding($tournament) {
            $matches = Match::getFinalGroupMatches($tournament->getMatches());
            $team_array = Team::getTeamArrayByName($tournament->getTeams());
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
            Soccer::getGroupMatchesRanking($tournament);
            Soccer::getSecondRoundMatchesRanking($tournament);
            Soccer::getFinalRoundMatchesRanking($tournament);
        }

        public static function getGroupMatchesRanking($tournament) {
            $group_matches = Match::getGroupMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $group_matches, self::First);
            $tournament->setTeams($teams);
        }

        public static function getSecondRoundMatchesRanking($tournament) {
            $second_round_matches = Match::getSecondRoundMatches($tournament->getMatches());
            if (sizeof($second_round_matches) > 0) {
                self::updateSecondRoundTeams($tournament);
                $teams = self::getGroupRanking($tournament->getSecondRoundTeams(), $second_round_matches, self::First);
                $tournament->setSecondRoundTeams($teams);
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
            Soccer::updateSecondRoundMatchesRanking($tournament);
            Soccer::updateFinalRoundMatchesRanking($tournament);
            Soccer::updatePlayOffMatchesRanking($tournament);
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
                $teams[$final_round_teams[3]->getName()]->setBestFinish(self::Semifinal);
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
            Soccer::getPreliminaryRoundMatchesRanking($tournament);
            Soccer::getFirstRoundMatchesRanking($tournament);
            Soccer::getReplayFirstRoundMatchesRanking($tournament);
            Soccer::getRound16MatchesRanking($tournament);
            Soccer::getReplayQuarterfinalMatchesRanking($tournament);
            Soccer::getQuarterfinalMatchesRanking($tournament);
            Soccer::getSemifinalMatchesRanking($tournament);
            Soccer::getConsolationMatchesRanking($tournament);
            Soccer::getFifthPlaceMatchRanking($tournament);
            Soccer::getBronzeMedalMatchRanking($tournament);
            Soccer::getGoldMedalMatchRanking($tournament);
            Soccer::getThirdPlaceMatchRanking($tournament);
            Soccer::getFinalMatchRanking($tournament);
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

        public static function getSemifinalMatchesRanking($tournament) {
            $semifinal_matches = Match::getSemifinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $semifinal_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getConsolationMatchesRanking($tournament) {
            $semifinal_matches = Match::getConsolationMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $semifinal_matches, self::Second);
            $tournament->setTeams($teams);
        }

        public static function getFifthPlaceMatchRanking($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
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
            $teams = Team::getTeamArrayByName($tournament->getTeams());
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

        public static function getGoldMedalMatchRanking($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
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

        public static function getThirdPlaceMatchRanking($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $third_place_match = Match::getThirdPlaceMatch($tournament->getMatches());
            if ($third_place_match != null) {
                self::calculatePoint($teams, $third_place_match, self::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getFinalMatchRanking($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
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

        public static function getAllTimeRanking($tournament) {
            $teams = self::getGroupRanking($tournament->getTeams(), $tournament->getMatches(), self::AllStages);
            $tournament->setTeams($teams);
        }

        public static function getAllTimeTournamentRanking($tournament) {
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
                $t = Tournament::CreateSoccerTournamentByTeams($tt[$tournament_name], $srtt[$tournament_name], $tm[$tournament_name]);
                self::getFirstStageMatchesRanking($t);
                Soccer::updateFirstStageMatchesRanking($t);
                Soccer::getSecondStageMatchesRanking($t);
                $tt[$tournament_name] = $t->getTeams();
            }
            foreach ($tt as $tournament_name => $_teams) {
                for ($i = 0; $i < sizeof($_teams); $i++ ) {
                    array_push($result, $_teams[$i]);
                }
            }
            $tournament->setTournamentTeams($result);
        }

        public static function getGroupRanking($teams, $matches, $stage) {
            $teams_tmp = Team::getTeamArrayByName($teams);
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                self::calculatePoint($teams_tmp, $matches[$i], $stage);
            }
            foreach ($teams_tmp as $name => $_team) {
                array_push($result, $_team);
            }
            return self::sortGroupStanding($result, $matches);
        }

        public static function calculatePoint(&$teams, $match, $stage) {
            if ($match->getSecondRoundGroupName() == self::WITHDREW) return;
            if ($match->getHomeTeamScore() == -1) return;
//            if (!$all_time_ranking && strpos($match->getRound(), 'Replay') !== false) { echo 'yes';return;}
            $all_time_ranking = $stage == self::AllStages;
            $points_for_win = 3;
            if ($match->getPointsForWin() == 2 && !$all_time_ranking) $points_for_win = 2;
            $no_extra_time = $stage == self::First && $match->getRound() != self::PLAY_OFF;
            $home_name = $match->getHomeTeamName();
            $away_name = $match->getAwayTeamName();
            if ($all_time_ranking && $match->getHomeParentTeamName() != null) {
                $home_name = $match->getHomeParentTeamName();
            }
            if ($all_time_ranking && $match->getAwayParentTeamName() != null) {
                $away_name = $match->getAwayParentTeamName();
            }
            $home_team = $teams[$home_name];
            $away_team = $teams[$away_name];
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
                $still_tie = self::applyTiebreaker($team1, $team2, $matches);
                if ($still_tie) $still_tie = self::fairPlayRule($team1, $team2);
                if ($still_tie) self::drawingLots($team1, $team2);
            }
            elseif (self::isHigherStanding($team2, $team1)) {
                self::swapTeam($team1, $team2);
            }
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
                    if ($name == 'USA') {
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
            }
            if ($match->getRound() == self::BRONZE_MEDAL_MATCH) {
                $team->setBestFinish(self::Semifinal);
            }
            if ($match->getRound() == self::GOLD_MEDAL_MATCH) {
                $team->setBestFinish(self::SilverMedal);
            }
            if ($match->getRound() == self::THIRD_PLACE) {
                $team->setBestFinish(self::Semifinal);
            }
            if ($match->getRound() == self::FINAL_) {
                $team->setBestFinish(self::RunnerUp);
            }
        }

        public static function getFinish($match) {
            switch($match->getRound())
            {
                case self::GROUP_MATCHES:
                    $best_finish = self::Group;
                    break;
                case self::PLAY_OFF:
                    $best_finish = self::Playoff;
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
                case self::QUARTERFINALS:
                    $best_finish = self::Quarterfinal;
                    break;
                case self::REPLAY_QUARTERFINALS:
                    $best_finish = self::ReplayQuarterfinal;
                    break;
                case self::CONSOLATION_ROUND:
                    $best_finish = self::Quarterfinal;
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
                case self::GOLD_MEDAL_MATCH:
                    $best_finish = self::GoldMedal;
                    break;
                case self::THIRD_PLACE:
                    $best_finish = self::ThirdPlace;
                    break;
                default:
                    $best_finish = self::Champion;
                    break;
            }
            return $best_finish;
        }

        public static function isHigherStanding($t1, $t2) {
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
            return $t1->getPoint() == $t2->getPoint() && $t1->getGoalDiff() == $t2->getGoalDiff()
                && $t1->getGoalFor() == $t2->getGoalFor();
        }

        public static function applyTiebreaker(&$t1, &$t2, $matches) {
            $still_tie = false;
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getHomeTeamName() == $t1->getName() && $matches[$i]->getAwayTeamName() == $t2->getName()) {
                    if ($matches[$i]->getHomeTeamScore() < $matches[$i]->getAwayTeamScore()) {
                        self::swapTeam($t1, $t2);
                    }
                    elseif ($matches[$i]->getHomeTeamScore() == $matches[$i]->getAwayTeamScore()) {
                        $still_tie = true;
                    }
                    break;
                }
                elseif ($matches[$i]->getAwayTeamName() == $t1->getName() && $matches[$i]->getHomeTeamName() == $t2->getName()) {
                    if ($matches[$i]->getAwayTeamScore() < $matches[$i]->getHomeTeamScore()) {
                        self::swapTeam($t1, $t2);
                    }
                    elseif ($matches[$i]->getAwayTeamScore() == $matches[$i]->getHomeTeamScore()) {
                        $still_tie = true;
                    }
                    break;
                }
            }
            return $still_tie;
        }

        public static function fairPlayRule(&$t1, &$t2) {
            if ($t2->getName() == 'JAPAN' && $t2->getTournamentId() == 1) {
               self::swapTeam($t1, $t2);
               return false;
            }
            return true;
        }

        public static function drawingLots(&$t1, &$t2) {
            if ($t2->getName() == 'REPUBLIC OF IRELAND' && $t2->getTournamentId() == 11) {
                self::swapTeam($t1, $t2);
            }
            elseif ($t2->getName() == 'NETHERLANDS' && $t2->getTournamentId() == 11) {

            }
            else {
                self::coinToss($t1, $t2);
            }
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
//            $matches[32]->setHomeTeamScore(1);
//            $matches[32]->setAwayTeamScore(0);
//            $matches[33]->setHomeTeamScore(3);
//            $matches[33]->setAwayTeamScore(3);
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
