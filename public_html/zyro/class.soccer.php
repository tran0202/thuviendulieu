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
        const SECOND_ROUND_GROUP_MATCHES = 'Second Round - Group Matches';
        const THIRD_ROUND_GROUP_MATCHES = 'Third Round - Group Matches';
        const FOURTH_ROUND = 'Fourth Round';
        const INTER_CONFEDERATION_PLAY_OFF = 'Inter-confederation Play-off';
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
        const FINAL_ROUND_PLAY_OFF = 'Final Round Play-off';
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
        const SecondRound = 2;
        const FinalRound = 3;
        const PreliminaryRound = 4;
        const FirstRound = 5;
        const SecondRoundGroup = 6;
        const ThirdRoundGroup = 7;
        const FourthRound = 8;
        const InterConfederation = 9;
        const QualificationWinner = 10;
        const Round16 = 11;
        const Quarterfinal = 12;
        const Consolation = 13;
        const ConsolationSemifinal = 14;
        const ConsolationFinal = 15;
        const FifthPlace = 16;
        const Semifinal = 17;
        const BronzeMedal = 18;
        const SilverMedal = 19;
        const GoldMedal = 20;
        const ThirdPlace = 21;
        const RunnerUp = 22;
        const Champion = 23;

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
                self::calculatePoint($team_array, $matches[$i], false);
            }
            foreach ($team_array as $name => $_team) {
                $tmp_array[$_team->getParentGroupName().$_team->getGroupName()][$_team->getName()] = $_team;
            }
            foreach ($tmp_array as $group_name => $_teams) {
                $tmp_array2 = array();
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array2, $_team);
                }
                $tmp_array[$group_name] = self::sortGroupStanding($tournament, $tmp_array2, $matches);
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

        public static function getQualificationMatchesRanking($tournament, $round_name) {
            switch ($round_name) {
                case Soccer::FIRST_ROUND:
                    Soccer::getIntermediateRoundMatchesRanking($tournament, $round_name);
                    break;
                case Soccer::SECOND_ROUND_GROUP_MATCHES:
                    Soccer::getRoundRobinMatchesRanking($tournament, $round_name, 0);
                    break;
                case Soccer::THIRD_ROUND_GROUP_MATCHES:
                    Soccer::getRoundRobinMatchesRanking($tournament, $round_name, 2);
                    break;
                case Soccer::FOURTH_ROUND:
                    Soccer::getIntermediateRoundMatchesRanking($tournament, $round_name);
                    break;
                case Soccer::INTER_CONFEDERATION_PLAY_OFF:
                    Soccer::getIntermediateRoundMatchesRanking($tournament, $round_name);
                    break;
            }
        }

        public static function getRoundRobinMatchesRanking($tournament, $round_name, $qualification_winners) {
            $group_matches = Match::getRoundMatches($tournament->getMatches(), $round_name);
            $result = array();
            $teams_tmp = Team::getRoundRobinTeamArray($tournament, $round_name);
            foreach ($teams_tmp as $group_name => $_teams) {
                $teams_tmp2 = array();
                foreach ($_teams as $team_name => $_team) {
                    array_push($teams_tmp2, $_team);
                }
                $teams = self::getGroupRanking($tournament, $teams_tmp2, $group_matches, false);
                for ($i = 0; $i < sizeof($teams); $i++) {
                    if ($i < $qualification_winners) {
                        $teams[$i]->setBestFinish(self::QualificationWinner);
                    }
                    elseif ($i == $qualification_winners && $qualification_winners != 0) {
                        $teams[$i]->setBestFinish(self::FourthRound);
                    }
                    elseif ($i == 0 && $qualification_winners == 0) {
                        $teams[$i]->setBestFinish(self::ThirdRoundGroup);
                    }
                    array_push($result, $teams[$i]);
                }
            }
            $tournament->setTournamentTeams($result);
        }

        public static function getSpecialRoundRobinMatchesRanking($tournament, $round_name) {
            $result = array();
            $teams = $tournament->getTournamentTeams();
            $not_counted_teams = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                if ($teams[$i]->getNotCounted() == 1) {
                    array_push($not_counted_teams, $teams[$i]);
                }
            }
            $group_matches = Match::getRoundMatches($tournament->getMatches(), $round_name);
            $counted_matches = array();
            for ($i = 0; $i < sizeof($group_matches); $i++) {
                $counted = true;
                $j = 0;
                while ($counted && $j < sizeof($not_counted_teams)) {
                    if ($group_matches[$i]->getHomeTeamName() == $not_counted_teams[$j]->getName() ||
                        $group_matches[$i]->getAwayTeamName() == $not_counted_teams[$j]->getName()) {
                        $counted = false;
                    }
                    $j++;
                }
                if ($counted) array_push($counted_matches, $group_matches[$i]);
            }
            $runner_up_teams = array();
            $teams = Team::getRoundRobinTeamArray($tournament, $round_name);
            foreach ($teams as $group_name => $_teams) {
                $i = 0;
                foreach ($_teams as $team_name => $_team) {
                    if ($i == 1) {
                        array_push($runner_up_teams, $_team);
                    }
                    $i++;
                }
            }
            $counted_teams = array();
            $teams = $tournament->getSecondRoundTeams();
            for ($i = 0; $i < sizeof($teams); $i++) {
                if ($teams[$i]->getSecondRoundGroupName() != null) {
                    $counted_teams[$teams[$i]->getSecondRoundGroupName()][$teams[$i]->getName()] = $teams[$i];
                }
            }
            ksort($counted_teams);
            $teams_tmp3 = array();
            foreach ($counted_teams as $group_name => $_teams) {
                $teams_tmp2 = array();
                foreach ($_teams as $team_name => $_team) {
                    array_push($teams_tmp2, $_team);
                }
                $teams_tmp = self::getGroupRanking($tournament, $teams_tmp2, $counted_matches, false);
                for ($i = 0; $i < sizeof($teams_tmp); $i++) {
                    array_push($teams_tmp3, $teams_tmp[$i]);
                }
            }
            $teams_tmp4 = array();
            for ($i = 0; $i < sizeof($teams_tmp3); $i++) {
                $teams_tmp4[$teams_tmp3[$i]->getId()] = $teams_tmp3[$i];
            }
            for ($i = 0; $i < sizeof($runner_up_teams); $i++) {
                array_push($result, $teams_tmp4[$runner_up_teams[$i]->getId()]);
            }
            $result = self::sortGroupStanding($tournament, $result, $counted_matches);
            if (sizeof($result) == 0) return;
            for ($i = 0; $i < 4; $i++) {
                $result[$i]->setBestFinish(self::ThirdRoundGroup);
            }
            $teams = $tournament->getTournamentTeams();
            $teams = Team::getTeamArrayById($teams);
            for ($i = 0; $i < 4; $i++) {
                $teams[$result[$i]->getId()]->setBestFinish(self::ThirdRoundGroup);
            }
            SoccerHtml::getRoundRobinHtml($tournament, Soccer::QUALIFYING_STAGE, $round_name);
            $output = '<div class="col-sm-12 margin-top-md">
                        <span class="col-sm-2 h2-ff2">Ranking of runner-up teams</span>';
            $output .= '</div>
                    <div class="col-sm-12 h2-ff3 box-xl">';
            $output .= SoccerHtml::getTeamRankingTableHtml($tournament, $result, Soccer::First,
                false, $current_best_finish, $striped_row);
            $output .= '</div>';
            $output .= '<div class="col-sm-12 margin-top-md">
                        As a result of Indonesia being disqualified due to FIFA suspension, Group F contained only four 
                        teams compared to five teams in all other groups. Therefore, the results against the fifth-placed 
                        team were not counted when determining the ranking of the runner-up teams.</div>';
            $tournament->concatBodyHtml($output);
        }

        public static function getIntermediateRoundMatchesRanking($tournament, $round) {
            $teams = $tournament->getTournamentTeams();
            $rounds = self::getAllRelatedRounds($round);
            $round_matches = Match::getMultipleRoundMatches($tournament->getMatches(), $rounds);
            $teams = self::getGroupRanking($tournament, $teams, $round_matches, false);
            $tournament->setTournamentTeams($teams);
        }

        public static function getFirstStageMatchesRanking($tournament) {
            $rounds = Round::getRoundArray($tournament, Soccer::FIRST_STAGE);
            foreach ($rounds as $round_id => $round) {
                $round_name = $round->getRoundName();
                switch ($round_name) {
                    case Soccer::GROUP_MATCHES:
                        Soccer::getGroupMatchesRanking($tournament);
                        break;
                    case Soccer::SECOND_ROUND:
                        Soccer::getSecondRoundMatchesRanking($tournament, $round_name);
                        break;
                    case Soccer::FINAL_ROUND:
                        Soccer::getSecondRoundMatchesRanking($tournament, $round_name);
                        break;
                }
            }
        }

        public static function getGroupMatchesRanking($tournament) {
            $group_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::GROUP_MATCHES);
            $result = array();
            $teams_tmp = Team::getTeamArrayByGroup($tournament->getTeams());
            foreach ($teams_tmp as $group_name => $_teams) {
                $teams_tmp2 = array();
                foreach ($_teams as $team_name => $_team) {
                    array_push($teams_tmp2, $_team);
                }
                $teams = self::getGroupRanking($tournament, $teams_tmp2, $group_matches, false);
                for ($i = 0; $i < sizeof($teams); $i++) {
                    array_push($result, $teams[$i]);
                }
            }
            $tournament->setTeams($result);
        }

        public static function getSecondRoundMatchesRanking($tournament, $round) {
            $second_round_matches = Match::getRoundMatches($tournament->getMatches(), $round);
            if (sizeof($second_round_matches) > 0) {
                self::updateSecondRoundTeams($tournament, $round);
                $teams = self::getGroupRanking($tournament, $tournament->getSecondRoundTeams(), $second_round_matches, false);
                $tournament->setSecondRoundTeams($teams);
            }
        }

        public static function updateSecondRoundTeams($tournament, $round) {
            $teams = Team::getTeamArrayByName($tournament->getSecondRoundTeams());
            $matches = Match::getRoundMatches($tournament->getMatches(), $round);
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                $teams[$matches[$i]->getHomeTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
                $teams[$matches[$i]->getAwayTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
            }
        }

        public static function updateFirstStageMatchesRanking($tournament) {
            $rounds = Round::getRoundArray($tournament, Soccer::FIRST_STAGE);
            foreach ($rounds as $round_id => $round) {
                $round_name = $round->getRoundName();
                switch ($round_name) {
                    case Soccer::PRELIMINARY_ROUND:
                        Soccer::getRoundMatchesRanking($tournament, $round_name);
                        break;
                    case Soccer::SECOND_ROUND:
                        Soccer::getRoundMatchesRanking($tournament, $round_name);
                        break;
                    case Soccer::FINAL_ROUND:
                        Soccer::updateFinalRoundMatchesRanking($tournament);
                        break;
                    case Soccer::PLAY_OFF:
                        Soccer::getRoundMatchesRanking($tournament, $round_name);
                        break;
                    case Soccer::FINAL_ROUND_PLAY_OFF:
                        Soccer::getRoundMatchesRanking($tournament, $round_name);
                        break;
                }
            }
        }

        public static function updateFinalRoundMatchesRanking($tournament) {
            $final_round_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::FINAL_ROUND);
            if (sizeof($final_round_matches) > 0) {
                $teams = self::getGroupRanking($tournament, $tournament->getTeams(), $final_round_matches, false);
                $teams = Team::getTeamArrayByName($teams);
                $final_round_teams = $tournament->getSecondRoundTeams();
                $teams[$final_round_teams[0]->getName()]->setBestFinish(self::Champion);
                $teams[$final_round_teams[1]->getName()]->setBestFinish(self::RunnerUp);
                $teams[$final_round_teams[2]->getName()]->setBestFinish(self::ThirdPlace);
                if (sizeof($final_round_teams) > 3 && self::getRoundCountExcludeFinalRoundPlayoff($tournament) > 1) {
                    if (!self::isThreeTeamFinalRound($tournament)) {
                        $teams[$final_round_teams[3]->getName()]->setBestFinish(self::Semifinal);
                    }
                }
                $result = array();
                foreach ($teams as $name => $_team) {
                    array_push($result, $_team);
                }
                $tournament->setTeams($result);
            }
        }

        public static function isThreeTeamFinalRound($tournament) {
            return $tournament->getTournamentId() == SoccerHtml::CONCACAF_CHAMPIONSHIP_1985;
        }

        public static function getRoundCountExcludeFinalRoundPlayoff($tournament) {
            $rounds = Round::getRoundArray($tournament, Soccer::FIRST_STAGE);
            $count = 0;
            foreach ($rounds as $round_id => $round) {
                if ($round->getRoundName() != self::FINAL_ROUND_PLAY_OFF) $count++;
            }
            return $count;
        }

        public static function getSecondStageMatchesRanking($tournament) {
            $rounds = Round::getSecondStageRoundArray($tournament);
            foreach ($rounds as $round_id => $round) {
                Soccer::getRoundMatchesRanking($tournament, $round->getRoundName());
            }
            Soccer::sortTournamentStanding($tournament);
        }

        public static function getRoundMatchesRanking($tournament, $round) {
            $teams = $tournament->getTeams();
            $rounds = self::getAllRelatedRounds($round);
            $round_matches = Match::getMultipleRoundMatches($tournament->getMatches(), $rounds);
            $teams = self::getGroupRanking($tournament, $teams, $round_matches, false);
            $tournament->setTeams($teams);
        }

        public static function getAllRelatedRounds($round) {
            $rounds = array();
            switch ($round) {
                case Soccer::SECOND_ROUND:
                    array_push($rounds, $round);
                    break;
                case Soccer::SECOND_ROUND_GROUP_MATCHES:
                    array_push($rounds, $round);
                    break;
                case Soccer::THIRD_ROUND_GROUP_MATCHES:
                    array_push($rounds, $round);
                    break;
                case Soccer::FOURTH_ROUND:
                    array_push($rounds, $round);
                    break;
                case Soccer::INTER_CONFEDERATION_PLAY_OFF:
                    array_push($rounds, $round);
                    break;
                case Soccer::PLAY_OFF:
                    array_push($rounds, $round);
                    break;
                case Soccer::FINAL_ROUND_PLAY_OFF:
                    array_push($rounds, $round);
                    break;
                case Soccer::PRELIMINARY_ROUND:
                    array_push($rounds, $round);
                    break;
                case Soccer::FIRST_ROUND:
                    array_push($rounds, $round);
                    array_push($rounds, Soccer::REPLAY_FIRST_ROUND);
                    break;
                case Soccer::ROUND16:
                    array_push($rounds, $round);
                    array_push($rounds, Soccer::REPLAY_ROUND16);
                    break;
                case Soccer::QUARTERFINALS:
                    array_push($rounds, $round);
                    array_push($rounds, Soccer::REPLAY_QUARTERFINALS);
                    break;
                case Soccer::SEMIFINALS:
                    array_push($rounds, $round);
                    break;
                case Soccer::CONSOLATION_ROUND:
                    array_push($rounds, $round);
                    break;
                case Soccer::CONSOLATION_SEMIFINALS:
                    array_push($rounds, $round);
                    break;
                case Soccer::CONSOLATION_FINAL:
                    array_push($rounds, $round);
                    break;
                case Soccer::FIFTH_PLACE_MATCH:
                    array_push($rounds, $round);
                    break;
                case Soccer::BRONZE_MEDAL_MATCH:
                    array_push($rounds, $round);
                    array_push($rounds, Soccer::REPLAY_BRONZE_MEDAL_MATCH);
                    break;
                case Soccer::THIRD_PLACE:
                    array_push($rounds, $round);
                    break;
                case Soccer::GOLD_MEDAL_MATCH:
                    array_push($rounds, $round);
                    array_push($rounds, Soccer::REPLAY_GOLD_MEDAL_MATCH);
                    break;
                case Soccer::FINAL_:
                    array_push($rounds, $round);
                    array_push($rounds, Soccer::REPLAY_FINAL);
                    break;
                case Soccer::FINALS:
                    array_push($rounds, $round);
                    array_push($rounds, Soccer::FINAL_PLAYOFF);
                    break;
            }
            return $rounds;
        }

        public static function getAllTimeRanking($tournament) {
            $teams = self::getGroupRanking($tournament, $tournament->getTeams(), Match::getStageMatchesExcludeQualification($tournament), true);
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
                    Round::getTournamentRounds($t);
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

        public static function getGroupRanking($tournament, $teams, $matches, $all_time) {
            $teams_tmp = Team::getTeamArrayById($teams);
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                self::calculatePoint($teams_tmp, $matches[$i], $all_time);
            }
            foreach ($teams_tmp as $name => $_team) {
                array_push($result, $_team);
            }
            $result2 = self::sortGroupStanding($tournament, $result, $matches);
            return $result2;
        }

        public static function isMatchExtraTime($match) {
            $result = $match->getStage() != self::FIRST_STAGE
                || $match->getRound() == self::PLAY_OFF
                || $match->getRound() == self::FINAL_ROUND_PLAY_OFF
                || ($match->getRound() == self::GROUP_MATCHES && $match->getTournamentId() == SoccerHtml::SWITZERLAND_1954)
                || ($match->getRound() == self::PRELIMINARY_ROUND && $match->getTournamentId() == SoccerHtml::THAILAND_1972);
            return $result;
        }

        public static function calculatePoint(&$teams, $match, $all_time) {
            if ($match->getSecondRoundGroupName() == self::WITHDREW) return;
            if ($match->getHomeTeamScore() == -1) return;
            $points_for_win = 3;
            if ($match->getPointsForWin() == 2 && !$all_time) $points_for_win = 2;
            $no_extra_time = !self::isMatchExtraTime($match);
            $home_id = $match->getHomeTeamId();
            $away_id = $match->getAwayTeamId();
            if ($all_time && $match->getHomeParentTeamId() != null) {
                $home_id = $match->getHomeParentTeamId();
            }
            if ($all_time && $match->getAwayParentTeamId() != null) {
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
            self::getMatchException($match, $home_team, $away_team, $all_time);
        }

        public static function getMatchException($match, $home_team, $away_team, $all_time) {
            if ($match->getTournamentId() == SoccerHtml::URUGUAY_1930) {
                if ($match->getRound() == self::SEMIFINALS && $match->getAwayTeamName() == 'UNITED STATES') {
                    $away_team->setBestFinish(self::ThirdPlace);
                }
            }
            elseif ($match->getTournamentId() == SoccerHtml::URUGUAY_1942) {
                if ($match->getHomeTeamName() == 'ARGENTINA' && $match->getAwayTeamName() == 'CHILE') {
                    self::getAbandonedMatchException($home_team, $away_team, $all_time);
                }
            }
            elseif ($match->getTournamentId() == SoccerHtml::PERU_1953) {
                if ($match->getHomeTeamName() == 'PERU' && $match->getAwayTeamName() == 'PARAGUAY') {
                    self::getAbandonedMatchException($home_team, $away_team, $all_time);
                }
                if ($match->getHomeTeamName() == 'CHILE' && $match->getAwayTeamName() == 'BOLIVIA') {
                    self::getAbandonedMatchException($home_team, $away_team, $all_time);
                }
            }
            elseif ($match->getTournamentId() == SoccerHtml::COPA_1979 && $match->getRound() == self::FINAL_PLAYOFF) {
                $home_team->setBestFinish(self::Champion);
                $away_team->setBestFinish(self::RunnerUp);
            }
        }

        public static function getAbandonedMatchException($home_team, $away_team, $all_time) {
            $home_team->setWin($home_team->getWin() + 1);
            $home_team->setDraw($home_team->getDraw() - 1);
            $home_team->setPoint($home_team->getPoint() + 1);
            if ($all_time) $home_team->setPoint($home_team->getPoint() + 1);
            $away_team->setDraw($away_team->getDraw() - 1);
            $away_team->setLoss($away_team->getLoss() + 1);
            $away_team->setPoint($away_team->getPoint() - 1);
        }

        public static function sortGroupStanding($tournament, $teams, $matches) {
            $teams_copy = $teams;
            for ($i = 0; $i < sizeof($teams) - 1; $i++) {
                for ($j = $i + 1; $j < sizeof($teams); $j++) {
                    self::compareTeams($tournament, $teams_copy[$i], $teams_copy[$j], $matches);
                }
            }
            return $teams_copy;
        }

        public static function compareTeams($tournament, &$team1, &$team2, $matches) {
            if (self::isEqualStanding($tournament, $team1, $team2)) {
                if (self::escapeCompareTeams($team1, $team2)) return;
                $still_tie = self::applyTiebreaker($team1, $team2, $matches);
                if (self::isTieBreakerHead2HeadFirst($tournament)) {
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
                self::forceSwappingTeams($team1, $team2);
            }
            elseif (self::isHigherStanding($team2, $team1)) {
                if (self::escapeCompareTeams($team1, $team2)) return;
                self::swapTeam($team1, $team2);
            }
            else {
                self::forceSwappingTeams($team1, $team2);
            }
        }

        public static function escapeCompareTeams($team1, $team2) {
            return ($team1->getTournamentId() == SoccerHtml::GOLD_CUP_2002 &&  $team1->getName() == 'CANADA' &&  $team2->getName() == 'ECUADOR')
                || ($team1->getTournamentId() == SoccerHtml::TUNISIA_1965 &&  $team1->getName() == 'TUNISIA' &&  $team2->getName() == 'SENEGAL')
                || ($team1->getTournamentId() == SoccerHtml::ANGOLA_2010 &&  $team1->getGroupName() == 'D')
                || ($team1->getTournamentId() == SoccerHtml::SWITZERLAND_1954 &&  $team1->getName() == 'WEST GERMANY' &&  $team2->getName() == 'TURKEY')
                || ($team1->getTournamentId() == SoccerHtml::SWITZERLAND_1954 &&  $team1->getName() == 'SWITZERLAND' &&  $team2->getName() == 'ITALY')
                || ($team1->getTournamentId() == SoccerHtml::SWEDEN_1958 &&  $team1->getName() == 'NORTHERN IRELAND' &&  $team2->getName() == 'CZECHOSLOVAKIA');
        }

        public static function isTieBreakerHead2HeadFirst($tournament) {
            $head_tiebreaker = false;
            if ($tournament->getProfile() != null && $tournament->getProfile()->getHeadToHeadTiebreaker() == 1) $head_tiebreaker = true;
            return $head_tiebreaker;
        }

        public static function forceSwappingTeams(&$team1, &$team2) {
            if (($team1->getTournamentId() == SoccerHtml::SWITZERLAND_1954 &&  $team1->getName() == 'TURKEY' &&  $team2->getName() == 'WEST GERMANY')
                || ($team1->getTournamentId() == SoccerHtml::SWEDEN_1958 &&  $team1->getName() == 'ENGLAND' &&  $team2->getName() == 'SOVIET UNION')
                || ($team1->getTournamentId() == SoccerHtml::SWEDEN_1958 &&  $team1->getName() == 'HUNGARY' &&  $team2->getName() == 'WALES'))
                self::swapTeam($team1, $team2);
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
            $best_finishes = [self::Champion, self::RunnerUp, self::ThirdPlace, self::GoldMedal, self::SilverMedal, self::BronzeMedal,
                            self::Semifinal, self::FifthPlace, self::ConsolationFinal, self::ConsolationSemifinal, self::Consolation,
                            self::Quarterfinal, self::Round16, self::QualificationWinner, self::InterConfederation, self::FourthRound,
                            self::ThirdRoundGroup, self::SecondRoundGroup, self::FirstRound, self::PreliminaryRound,
                            self::FinalRound, self::SecondRound, self::Group, self::Disqualified];
            for ($i = 0; $i < sizeof($best_finishes); $i++) {
                if (array_key_exists($best_finishes[$i], $teams_tmp)) {
                    foreach ($teams_tmp[$best_finishes[$i]] as $name => $_team) {
                        array_push($result, $_team);
                    }
                }
            }
            $tournament->setTeams($result);
        }

        public static function updateRankingTeams($tournament) {
            $ranking_teams = Team::getTeamArrayById($tournament->getTeams());
            $tournament_teams = $tournament->getTournamentTeams();
            for ($i = 0; $i < sizeof($tournament_teams); $i++) {
                if ($tournament_teams[$i]->getBestFinish() == self::QualificationWinner) {
                    $ranking_teams[$tournament_teams[$i]->getId()]->setBestFinish(self::QualificationWinner);
                }
            }
        }

        public static function getFinish($match) {
            switch ($match->getRound()) {
                case self::GROUP_MATCHES:
                    $best_finish = self::Group;
                    break;
                case self::PLAY_OFF:
                    $best_finish = self::Group;
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
                case self::SECOND_ROUND_GROUP_MATCHES:
                    $best_finish = self::SecondRoundGroup;
                    break;
                case self::THIRD_ROUND_GROUP_MATCHES:
                    $best_finish = self::ThirdRoundGroup;
                    break;
                case self::FOURTH_ROUND:
                    $best_finish = self::FourthRound;
                    break;
                case self::INTER_CONFEDERATION_PLAY_OFF:
                    $best_finish = self::QualificationWinner;
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
                    $best_finish = self::FirstRound;
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
                    if ($match->getTournamentId() == SoccerHtml::ANTWERP_1920)
                        $best_finish = self::SilverMedal;
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
                case self::FINAL_ROUND_PLAY_OFF:
                    $best_finish = self::Champion;
                    break;
                default:
                    $best_finish = self::Champion;
                    break;
            }
            return $best_finish;
        }

        public static function resetBestFinish($match, $team) {
            switch ($match->getRound()) {
                case self::INTER_CONFEDERATION_PLAY_OFF:
                    $team->setBestFinish(self::InterConfederation);
                    break;
                case self::CONSOLATION_FINAL:
                    $team->setBestFinish(self::ConsolationFinal);
                    self::resetBestFinishException($match, $team);
                    break;
                case self::FIFTH_PLACE_MATCH:
                    $team->setBestFinish(self::ConsolationFinal);
                    break;
                case self::BRONZE_MEDAL_MATCH:
                    $team->setBestFinish(self::Semifinal);
                    self::resetBestFinishException($match, $team);
                    break;
                case self::REPLAY_BRONZE_MEDAL_MATCH:
                    $team->setBestFinish(self::Semifinal);
                    break;
                case self::GOLD_MEDAL_MATCH:
                    $team->setBestFinish(self::SilverMedal);
                    self::resetBestFinishException($match, $team);
                    break;
                case self::REPLAY_GOLD_MEDAL_MATCH:
                    $team->setBestFinish(self::SilverMedal);
                    break;
                case self::THIRD_PLACE:
                    $team->setBestFinish(self::Semifinal);
                    self::resetBestFinishException($match, $team);
                    break;
                case self::FINAL_:
                    $team->setBestFinish(self::RunnerUp);
                    break;
                case self::REPLAY_FINAL:
                    $team->setBestFinish(self::RunnerUp);
                    break;
                case self::FINALS:
                    $team->setBestFinish(self::RunnerUp);
                    break;
                case self::FINAL_PLAYOFF:
                    $team->setBestFinish(self::RunnerUp);
                    break;
                case self::FINAL_ROUND_PLAY_OFF:
                    $team->setBestFinish(self::RunnerUp);
                    break;
                default:
                    break;
            }
        }

        public static function resetBestFinishException($match, $team) {
            if ($match->getTournamentId() == SoccerHtml::LONDON_1908 && $team->getName() == 'SWEDEN')
                $team->setBestFinish(self::Quarterfinal);
            elseif ($match->getTournamentId() == SoccerHtml::ANTWERP_1920 && $team->getName() == 'CZECHOSLOVAKIA')
                $team->setBestFinish(self::Disqualified);
            elseif ($match->getTournamentId() == SoccerHtml::ANTWERP_1920 && $team->getName() == 'NETHERLANDS')
                $team->setBestFinish(self::BronzeMedal);
            elseif ($match->getTournamentId() == SoccerHtml::MUNICH_1972 && $team->getName() == 'EAST GERMANY')
                $team->setBestFinish(self::BronzeMedal);
            elseif ($match->getTournamentId() == SoccerHtml::GOLD_CUP_1993 && $team->getName() == 'COSTA RICA')
                $team->setBestFinish(self::ThirdPlace);
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

        public static function isEqualStanding($tournament, $t1, $t2) {
            if (self::isTieBreakerHead2HeadFirst($tournament))
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
            if ($t2->getTournamentId() == SoccerHtml::RUSSIA_2018 && $t2->getName() == 'JAPAN') {
               self::swapTeam($t1, $t2);
               return false;
            }
            return true;
        }

        public static function drawingLots(&$t1, &$t2) {
            $still_tie = true;
            if ($t2->getTournamentId() == SoccerHtml::ITALY_1990 && $t2->getName() == 'REPUBLIC OF IRELAND') {
                self::swapTeam($t1, $t2);
                $still_tie = false;
            }
            elseif ($t2->getTournamentId() == SoccerHtml::ITALY_1990 && $t2->getName() == 'NETHERLANDS') {
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
