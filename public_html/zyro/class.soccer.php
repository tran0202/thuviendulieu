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
        const FIRST_STAGE = 'First Stage';
        const GROUP_STAGE = 'Group Stage';
        const SECOND_STAGE = 'Second Stage';

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
                self::calculatePoint($team_array, $matches[$i], Stage::First);
            }
            foreach ($team_array as $name => $_team) {
                $tmp_array[$_team->getGroupName()][$_team->getName()] = $_team;
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

        public static function calculateGroupStanding($group_teams, $t1, $t1_gf, $t1_ga, $t2, $t3, $t3_gf, $t3_ga, $t4, $matches) {
            $tmp_group_teams = array();
            foreach ($group_teams as $team_name => $team) {
                $tmp_group_teams[$team_name] = Team::CloneSoccerTeam($team->getId(), $team->getName(), $team->getCode(), $team->getGroupName(),
                    $team->getGroupOrder(), $team->getMatchPlay(), $team->getWin(), $team->getDraw(), $team->getLoss(),
                    $team->getGoalFor(), $team->getGoalAgainst(), $team->getGoalDiff(), $team->getPoint());
            }

            $tmp_matches = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                array_push($tmp_matches, Match::CloneSoccerMatch($matches[$i]->getHomeTeamId(), $matches[$i]->getHomeTeamName(),
                    $matches[$i]->getHomeTeamCode(), $matches[$i]->getAwayTeamId(), $matches[$i]->getAwayTeamName(), $matches[$i]->getAwayTeamCode(),
                    $matches[$i]->getHomeTeamScore(), $matches[$i]->getAwayTeamScore()));
            }
            for ($i = 0; $i < sizeof($tmp_matches); $i++) {
                if ($tmp_matches[$i]->getHomeTeamName() == $t1 && $tmp_matches[$i]->getAwayTeamName() == $t2) {
                    $tmp_matches[$i]->setHomeTeamScore($t1_gf);
                    $tmp_matches[$i]->setAwayTeamScore($t1_ga);
                }
                if ($tmp_matches[$i]->getHomeTeamName() == $t2 && $tmp_matches[$i]->getAwayTeamName() == $t1) {
                    $tmp_matches[$i]->setHomeTeamScore($t1_ga);
                    $tmp_matches[$i]->setAwayTeamScore($t1_gf);
                }
                if ($tmp_matches[$i]->getHomeTeamName() == $t3 && $tmp_matches[$i]->getAwayTeamName() == $t4) {
                    $tmp_matches[$i]->setHomeTeamScore($t3_gf);
                    $tmp_matches[$i]->setAwayTeamScore($t3_ga);
                }
                if ($tmp_matches[$i]->getHomeTeamName() == $t4 && $tmp_matches[$i]->getAwayTeamName() == $t3) {
                    $tmp_matches[$i]->setHomeTeamScore($t3_ga);
                    $tmp_matches[$i]->setAwayTeamScore($t3_gf);
                }
            }
            $tmp_m1 = Match::CloneSoccerMatch(0, $t1, 'T1', 0, $t2, 'T2', $t1_gf, $t1_ga);
            $tmp_m3 = Match::CloneSoccerMatch(0, $t3, 'T3', 0, $t4, 'T4', $t3_gf, $t3_ga);
            self::calculatePoint($tmp_group_teams, $tmp_m1, Stage::First);
            self::calculatePoint($tmp_group_teams, $tmp_m3, Stage::First);
            $team_array = array();
            foreach ($tmp_group_teams as $team_name => $team) {
                array_push($team_array, $team);
            }
            $team_array = self::sortGroupStanding($team_array, $tmp_matches);
            $team_array2 = array();
            for ($i = 0; $i < sizeof($team_array); $i++) {
                $team_array[$i]->setGroupOrder($i + 1);
                $team_array2[$team_array[$i]->getName()] = $team_array[$i];
            }
            $t1_g_diff = $team_array2[$t1]->getGoalDiff();
            if ($team_array2[$t1]->getGoalDiff() > 0) $t1_g_diff = '+'.$t1_g_diff;
            $t2_g_diff = $team_array2[$t2]->getGoalDiff();
            if ($team_array2[$t2]->getGoalDiff() > 0) $t2_g_diff = '+'.$t2_g_diff;
            $t3_g_diff = $team_array2[$t3]->getGoalDiff();
            if ($team_array2[$t3]->getGoalDiff() > 0) $t3_g_diff = '+'.$t3_g_diff;
            $t4_g_diff = $team_array2[$t4]->getGoalDiff();
            if ($team_array2[$t4]->getGoalDiff() > 0) $t4_g_diff = '+'.$t4_g_diff;
            $team1_match_result = 'W';
            $team2_match_result = 'L';
            $team3_match_result = 'W';
            $team4_match_result = 'L';
            if ($t1_gf == $t1_ga) {
                $team1_match_result = 'D';
                $team2_match_result = 'D';
            }
            elseif ($t1_gf < $t1_ga) {
                $team1_match_result = 'L';
                $team2_match_result = 'W';
            }
            if ($t3_gf == $t3_ga) {
                $team3_match_result = 'D';
                $team4_match_result = 'D';
            }
            elseif ($t3_gf < $t3_ga) {
                $team3_match_result = 'L';
                $team4_match_result = 'W';
            }
            $tmp_s = Scenario::CreateScenario($team_array2[$t1]->getCode(), $team_array2[$t1]->getGroupOrder(), $team_array2[$t1]->getPoint(), $t1_g_diff, $team_array2[$t1]->getGoalFor(), $t1_gf, $t1_ga,
                '', $team1_match_result, $team_array2[$t2]->getCode(), $team_array2[$t2]->getGroupOrder(), $team_array2[$t2]->getPoint(), $t2_g_diff, $team_array2[$t2]->getGoalFor(), '', $team2_match_result,
                $team_array2[$t3]->getCode(), $team_array2[$t3]->getGroupOrder(), $team_array2[$t3]->getPoint(), $t3_g_diff, $team_array2[$t3]->getGoalFor(), $t3_gf, $t3_ga, '', $team3_match_result,
                $team_array2[$t4]->getCode(), $team_array2[$t4]->getGroupOrder(), $team_array2[$t4]->getPoint(), $t4_g_diff, $team_array2[$t4]->getGoalFor(), '', $team4_match_result, '');
            return $tmp_s;
        }

        public static function getTournamentCount($tournament) {
            $teams = $tournament->getTeams();
            $teams_copy = Team::getTeamArrayByName($teams);

            for ($i = 0; $i < sizeof($teams); $i++ ) {
                $parent_team_name = $teams[$i]->getParentName();
                if ($parent_team_name != null) {
                    $tc = $teams_copy[$parent_team_name]->getTournamentCount();
                    $teams_copy[$parent_team_name]->setTournamentCount($tc + $teams[$i]->getTournamentCount());
                }
            }
        }

        public static function getFirstStageMatchesRanking($tournament) {
            Soccer::getGroupMatchesRanking($tournament);
            Soccer::getSecondRoundMatchesRanking($tournament);
            Soccer::getFinalRoundMatchesRanking($tournament);
        }

        public static function getGroupMatchesRanking($tournament) {
            $group_matches = Match::getGroupMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $group_matches, Stage::First);
            $tournament->setTeams($teams);
        }

        public static function getSecondRoundMatchesRanking($tournament) {
            $second_round_matches = Match::getSecondRoundMatches($tournament->getMatches());
            if (sizeof($second_round_matches) > 0) {
                self::updateSecondRoundTeams($tournament);
                $teams = self::getGroupRanking($tournament->getSecondRoundTeams(), $second_round_matches, Stage::First);
                $tournament->setSecondRoundTeams($teams);
            }
        }

        public static function getFinalRoundMatchesRanking($tournament) {
            $final_round_matches = Match::getFinalRoundMatches($tournament->getMatches());
            if (sizeof($final_round_matches) > 0) {
                self::updateFinalRoundTeams($tournament);
                $teams = self::getGroupRanking($tournament->getSecondRoundTeams(), $final_round_matches, Stage::First);
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
                $teams = self::getGroupRanking($tournament->getTeams(), $second_round_matches, Stage::First);
                $tournament->setTeams($teams);
            }
        }

        public static function updateFinalRoundMatchesRanking($tournament) {
            $final_round_matches = Match::getFinalRoundMatches($tournament->getMatches());
            if (sizeof($final_round_matches) > 0) {
                $teams = self::getGroupRanking($tournament->getTeams(), $final_round_matches, Stage::First);
                $teams = Team::getTeamArrayByName($teams);
                $final_round_teams = $tournament->getSecondRoundTeams();
                $teams[$final_round_teams[0]->getName()]->setBestFinish(Finish::Champion);
                $teams[$final_round_teams[1]->getName()]->setBestFinish(Finish::RunnerUp);
                $teams[$final_round_teams[2]->getName()]->setBestFinish(Finish::ThirdPlace);
                $teams[$final_round_teams[3]->getName()]->setBestFinish(Finish::Semifinal);
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
                $teams = self::getGroupRanking($tournament->getTeams(), $play_off_matches, Stage::First);
                $tournament->setTeams($teams);
            }
        }

        public static function getSecondStageMatchesRanking($tournament) {
            Soccer::getPreliminaryRoundMatchesRanking($tournament);
            Soccer::getFirstRoundMatchesRanking($tournament);
            Soccer::getReplayFirstRoundMatchesRanking($tournament);
            Soccer::getRound16MatchesRanking($tournament);
            Soccer::getQuarterfinalMatchesRanking($tournament);
            Soccer::getReplayQuarterfinalMatchesRanking($tournament);
            Soccer::getSemifinalMatchesRanking($tournament);
            Soccer::getBronzeMedalMatchRanking($tournament);
            Soccer::getGoldMedalMatchRanking($tournament);
            Soccer::getThirdPlaceMatchRanking($tournament);
            Soccer::getFinalMatchRanking($tournament);
            Soccer::sortTournamentStanding($tournament);
        }

        public static function getPreliminaryRoundMatchesRanking($tournament) {
            $preliminary_round_matches = Match::getPreliminaryRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $preliminary_round_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getFirstRoundMatchesRanking($tournament) {
            $first_round_matches = Match::getFirstRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $first_round_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getReplayFirstRoundMatchesRanking($tournament) {
            $replay_first_round_matches = Match::getReplayFirstRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $replay_first_round_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getRound16MatchesRanking($tournament) {
            $round16_matches = Match::getRound16Matches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $round16_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getQuarterfinalMatchesRanking($tournament) {
            $quarterfinal_matches = Match::getQuarterfinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $quarterfinal_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getReplayQuarterfinalMatchesRanking($tournament) {
            $replay_quarterfinal_matches = Match::getReplayQuarterfinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $replay_quarterfinal_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getSemifinalMatchesRanking($tournament) {
            $semifinal_matches = Match::getSemifinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $semifinal_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getBronzeMedalMatchRanking($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $bronze_medal_match = Match::getBronzeMedalMatch($tournament->getMatches());
            if ($bronze_medal_match != null) {
                self::calculatePoint($teams, $bronze_medal_match, Stage::Second);
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
                self::calculatePoint($teams, $gold_medal_match, Stage::Second);
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
                self::calculatePoint($teams, $third_place_match, Stage::Second);
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
                self::calculatePoint($teams, $champion_match, Stage::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getAllTimeRanking($tournament) {
            $teams = self::getGroupRanking($tournament->getTeams(), $tournament->getMatches(), Stage::AllStages);
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
            $all_time_ranking = $stage == Stage::AllStages;
            $points_for_win = 3;
            if ($match->getPointsForWin() == 2 && !$all_time_ranking) $points_for_win = 2;
            $no_extra_time = $stage == Stage::First && $match->getRound() != self::PLAY_OFF;
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
                if ($still_tie) self::fairPlayRule($team1, $team2);
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
            if (array_key_exists(Finish::Champion, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Champion] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::RunnerUp, $teams_tmp)) {
                foreach ($teams_tmp[Finish::RunnerUp] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::ThirdPlace, $teams_tmp)) {
                foreach ($teams_tmp[Finish::ThirdPlace] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::GoldMedal, $teams_tmp)) {
                foreach ($teams_tmp[Finish::GoldMedal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::SilverMedal, $teams_tmp)) {
                foreach ($teams_tmp[Finish::SilverMedal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::BronzeMedal, $teams_tmp)) {
                foreach ($teams_tmp[Finish::BronzeMedal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Semifinal, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Semifinal] as $name => $_team) {
                    if ($name == 'USA') {
                        $_team->setBestFinish(Finish::ThirdPlace);
                    }
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::ReplayQuarterfinal, $teams_tmp)) {
                foreach ($teams_tmp[Finish::ReplayQuarterfinal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Quarterfinal, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Quarterfinal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Round16, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Round16] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::ReplayFirstRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::ReplayFirstRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::FirstRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::FirstRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::PreliminaryRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::PreliminaryRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::FinalRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::FinalRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::SecondRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::SecondRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Playoff, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Playoff] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Group, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Group] as $name => $_team) {
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
            if ($match->getRound() == self::BRONZE_MEDAL_MATCH) {
                $team->setBestFinish(Finish::Semifinal);
            }
            if ($match->getRound() == self::GOLD_MEDAL_MATCH) {
                $team->setBestFinish(Finish::SilverMedal);
            }
            if ($match->getRound() == self::THIRD_PLACE) {
                $team->setBestFinish(Finish::Semifinal);
            }
            if ($match->getRound() == self::FINAL_) {
                $team->setBestFinish(Finish::RunnerUp);
            }
        }

        public static function getFinish($match) {
            switch($match->getRound())
            {
                case self::GROUP_MATCHES:
                    $best_finish = Finish::Group;
                    break;
                case self::PLAY_OFF:
                    $best_finish = Finish::Playoff;
                    break;
                case self::SECOND_ROUND:
                    $best_finish = Finish::SecondRound;
                    break;
                case self::FINAL_ROUND:
                    $best_finish = Finish::FinalRound;
                    break;
                case self::PRELIMINARY_ROUND:
                    $best_finish = Finish::PreliminaryRound;
                    break;
                case self::FIRST_ROUND:
                    $best_finish = Finish::FirstRound;
                    break;
                case self::REPLAY_FIRST_ROUND:
                    $best_finish = Finish::ReplayFirstRound;
                    break;
                case self::ROUND16:
                    $best_finish = Finish::Round16;
                    break;
                case self::QUARTERFINALS:
                    $best_finish = Finish::Quarterfinal;
                    break;
                case self::REPLAY_QUARTERFINALS:
                    $best_finish = Finish::ReplayQuarterfinal;
                    break;
                case self::SEMIFINALS:
                    $best_finish = Finish::Semifinal;
                    break;
                case self::BRONZE_MEDAL_MATCH:
                    $best_finish = Finish::BronzeMedal;
                    break;
                case self::GOLD_MEDAL_MATCH:
                    $best_finish = Finish::GoldMedal;
                    break;
                case self::THIRD_PLACE:
                    $best_finish = Finish::ThirdPlace;
                    break;
                default:
                    $best_finish = Finish::Champion;
                    break;
            }
            return $best_finish;
        }

        public static function getFinishLiteral($finish) {
            switch($finish)
            {
                case Finish::Group:
                    $best_finish = 'First Round';
                    break;
                case Finish::Playoff:
                    $best_finish = 'First Round';
                    break;
                case Finish::SecondRound:
                    $best_finish = 'Second Round';
                    break;
                case Finish::FinalRound:
                    $best_finish = 'Second Round';
                    break;
                case Finish::PreliminaryRound:
                    $best_finish = 'First Round';
                    break;
                case Finish::FirstRound:
                    $best_finish = 'First Round';
                    break;
                case Finish::ReplayFirstRound:
                    $best_finish = 'First Round';
                    break;
                case Finish::Round16:
                    $best_finish = 'Second Round';
                    break;
                case Finish::Quarterfinal:
                    $best_finish = 'Quarterfinals';
                    break;
                case Finish::ReplayQuarterfinal:
                    $best_finish = 'Quarterfinals';
                    break;
                case Finish::Semifinal:
                    $best_finish = 'Fourth Place';
                    break;
                case Finish::BronzeMedal:
                    $best_finish = 'Bronze Medal';
                    break;
                case Finish::SilverMedal:
                    $best_finish = 'Silver Medal';
                    break;
                case Finish::GoldMedal:
                    $best_finish = 'Gold Medal';
                    break;
                case Finish::ThirdPlace:
                    $best_finish = 'Third Place';
                    break;
                case Finish::RunnerUp:
                    $best_finish = 'Runner-Up';
                    break;
                default:
                    $best_finish = 'Champion';
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

        public static function getShortTournamentName($name) {
            $olympic_tournament = false;
            if (strpos($name, 'Olympic') !== false) {
                $olympic_tournament = true;
            }
            $result = str_replace(' FIFA World Cup ', '', $name);
            $result = str_replace(' FIFA Women\'s World Cup ', '', $result);
            $result = str_replace('Women\'s Olympic Football Tournament ', '', $result);
            $result = str_replace('Olympic Football Tournament ', '', $result);
            if (!$olympic_tournament) $result = substr($result, -(strlen($result) - 4)).' '.substr($result, 0, 4);
            return $result;
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

    abstract class Stage {
        const First = 1;
        const Second = 2;
        const AllStages = 3;
    }

    abstract class QualifyStatus {
        const Advanced = 'Advanced';
        const NeedHelp = 'NeedHelp';
        const Eliminated = 'Eliminated';
    }

    abstract class Finish {
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
        const Semifinal = 11;
        const ThirdPlace = 12;
        const RunnerUp = 13;
        const Champion = 14;
        const BronzeMedal = 15;
        const SilverMedal = 16;
        const GoldMedal = 17;
    }
