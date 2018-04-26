<?php
    class Soccer {
        private $id;

        protected function __construct(){ }

        public static function CreateSoccer($id) {
            $s = new Soccer();
            $s->id = $id;
            return $s;
        }

        public static function getStanding($team_dto, $match_dto, $first2Matches = false) {
            $numberOfMatches = 48;
            if ($first2Matches) $numberOfMatches = 32;
            $matches = $match_dto->getMatches();
            $team_array = Team::getTeamArrayByName($team_dto);
            $tmp_array = array();
            $result = array();
            for ($i = 0; $i < $numberOfMatches; $i++ ) {
                $home_name = $matches[$i]->getHomeTeamName();
                $away_name = $matches[$i]->getAwayTeamName();
                $home_score = $matches[$i]->getHomeTeamScore();
                $away_score = $matches[$i]->getAwayTeamScore();
                self::calculatePoint($team_array, $home_name, $away_name, $home_score, $away_score);
            }
            foreach ($team_array as $name => $_team) {
                $tmp_array[$_team->getGroupName()][$_team->getName()] = $_team;
            }
            foreach ($tmp_array as $group_name => $_teams) {
                $tmp_array2 = array();
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array2, $_team);
                }
                $tmp_array[$group_name] = self::sortGroupStanding($tmp_array2, $match_dto);
            }
            foreach ($tmp_array as $group_name => $_teams) {
                foreach ($_teams as $_name => $_team) {
                    array_push($result, $_team);
                }
            }
            $team_dto->setTeams($result);
            if (!$first2Matches) {
                self::round16Qualifiers($team_dto, $match_dto);
                self::quarterfinalQualifiers($team_dto, $match_dto);
                self::semifinalQualifiers($team_dto, $match_dto);
                self::finalQualifiers($team_dto, $match_dto);
            }
            else {
                self::calculateScenarios($team_dto, $match_dto);
            }
        }

        public static function calculateScenarios($team_dto, $match_dto) {
            $team_array = Team::getTeamArrayByName($team_dto);
            $matches = Match::getMatchArrayByGroup($match_dto);
            foreach ($matches as $group_name => $_matches) {
                $group_team_names = array();
                $group_teams = array();
                foreach ($_matches as $group_order => $_match) {
                    if ($_match->getMatchOrder() > 32 && $_match->getMatchOrder() <= 48) {
                        array_push($group_team_names, $_match->getHomeTeamName());
                        array_push($group_team_names, $_match->getAwayTeamName());
                        $group_teams[$_match->getHomeTeamName()] = $team_array[$_match->getHomeTeamName()];
                        $group_teams[$_match->getAwayTeamName()] = $team_array[$_match->getAwayTeamName()];
                    }
                }
                if (sizeof($group_teams) > 0) self::calculateGroupScenarios($group_team_names, $group_teams, $match_dto);
            }
        }

        public static function calculateGroupScenarios($group_team_names, $group_teams, $match_dto) {
            $scenario_array = array();
            $tmp_scenarios1 = array();
            $tmp_scenarios2 = array();
            $tmp_scenarios3 = array();
            $tmp_scenarios4 = array();
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $match_dto));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $match_dto));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $match_dto));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $match_dto));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $match_dto));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $match_dto));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $match_dto));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $match_dto));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $match_dto));
            for ($i = 0; $i < 9; $i++) {
                array_push($tmp_scenarios1, $scenario_array[$i]);
            }
            for ($i = 0; $i < 9; $i++) {
                array_push($tmp_scenarios2, Scenario::CreateScenario($tmp_scenarios1[8 - $i]->getTeam2(), $tmp_scenarios1[8 - $i]->getTeam1Result(),
                    $tmp_scenarios1[8 - $i]->getTeam1GoalAgainst(), $tmp_scenarios1[8 - $i]->getTeam1GoalFor(),
                    $tmp_scenarios1[8 - $i]->getTeam2Status(), $tmp_scenarios1[8 - $i]->getTeam1(), $tmp_scenarios1[8 - $i]->getTeam1Status(),
                    $tmp_scenarios1[8 - $i]->getTeam4(), $tmp_scenarios1[8 - $i]->getTeam3Result(), $tmp_scenarios1[8 - $i]->getTeam3GoalAgainst(), $tmp_scenarios1[8 - $i]->getTeam3GoalFor(),
                    $tmp_scenarios1[8 - $i]->getTeam4Status(), $tmp_scenarios1[8 - $i]->getTeam3(), $tmp_scenarios1[8 - $i]->getTeam3Status()));
            }
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    array_push($tmp_scenarios3, Scenario::CreateScenario($tmp_scenarios1[$i + 3 * $j]->getTeam3(), $tmp_scenarios1[$i + 3 * $j]->getTeam3Result(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam3GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getTeam3GoalAgainst(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam3Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam4(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Status(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam1(), $tmp_scenarios1[$i + 3 * $j]->getTeam1Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam1GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getTeam1GoalAgainst(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam1Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam2(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Status()));
                }
            }
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    array_push($tmp_scenarios4, Scenario::CreateScenario($tmp_scenarios1[8 - $i - 3 * $j]->getTeam4(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Result(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3GoalAgainst(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3GoalFor(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3Status(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2Result(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1GoalAgainst(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1GoalFor(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1Status()));
                }
            }
            $group_teams[$group_team_names[0]]->setScenarios($tmp_scenarios1);
            $group_teams[$group_team_names[1]]->setScenarios($tmp_scenarios2);
            $group_teams[$group_team_names[2]]->setScenarios($tmp_scenarios3);
            $group_teams[$group_team_names[3]]->setScenarios($tmp_scenarios4);
        }

        public static function calculateGroupStanding($group_teams, $t1, $t1_gf, $t1_ga, $t2, $t3, $t3_gf, $t3_ga, $t4, $match_dto) {
            $tmp_group_teams = array();
            foreach ($group_teams as $team_name => $team) {
                $tmp_group_teams[$team_name] = Team::NewSoccerTeam($team->getId(), $team->getName(), $team->getCode(), $team->getGroupName(),
                    $team->getGroupOrder(), $team->getMatchPlay(), $team->getWin(), $team->getDraw(), $team->getLoss(),
                    $team->getGoalFor(), $team->getGoalAgainst(), $team->getGoalDiff(), $team->getPoint());
            }
            $matches = $match_dto->getMatches();
            $tmp_matches = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                array_push($tmp_matches, Match::NewSoccerMatch($matches[$i]->getHomeTeamId(), $matches[$i]->getHomeTeamName(),
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
            self::calculatePoint($tmp_group_teams, $t1, $t2, $t1_gf, $t1_ga);
            self::calculatePoint($tmp_group_teams, $t3, $t4, $t3_gf, $t3_ga);
            $team_array = array();
            foreach ($tmp_group_teams as $team_name => $team) {
                array_push($team_array, $team);
            }
            $tmp_match_dto = MatchDTO::CreateSoccerMatchDTO($tmp_matches, 0, '');
            $team_array = self::sortGroupStanding($team_array, $tmp_match_dto);
            $team_array2 = array();
            for ($i = 0; $i < sizeof($team_array); $i++) {
                $team_array[$i]->setGroupOrder($i + 1);
                $team_array2[$team_array[$i]->getName()] = $team_array[$i];
            }
            $tmp_result1 = 'win';
            if ($t1_gf == $t1_ga) $tmp_result1 = 'draw';
            $tmp_result3 = 'win';
            if ($t3_gf == $t3_ga) $tmp_result3 = 'draw';
            $tmp_s = Scenario::CreateScenario($team_array2[$t1]->getCode(), $tmp_result1, $t1_gf, $t1_ga,
                $team_array2[$t1]->getGroupOrder(), $team_array2[$t2]->getCode(), $team_array2[$t2]->getGroupOrder(),
                $team_array2[$t3]->getCode(), $tmp_result3, $t3_gf, $t3_ga, $team_array2[$t3]->getGroupOrder(),
                $team_array2[$t4]->getCode(), $team_array2[$t4]->getGroupOrder());
            return $tmp_s;
        }

        public static function calculatePoint($team_array, $home_name, $away_name, $home_score, $away_score) {
            $team_array[$home_name]->setMatchPlay($team_array[$home_name]->getMatchPlay() + 1);
            $team_array[$away_name]->setMatchPlay($team_array[$away_name]->getMatchPlay() + 1);
            if ($home_score > $away_score) {
                $team_array[$home_name]->setWin($team_array[$home_name]->getWin() + 1);
                $team_array[$home_name]->setPoint($team_array[$home_name]->getPoint() + 3);
                $team_array[$away_name]->setLoss($team_array[$away_name]->getLoss() + 1);
            }
            elseif ($home_score < $away_score) {
                $team_array[$home_name]->setLoss($team_array[$home_name]->getLoss() + 1);
                $team_array[$away_name]->setWin($team_array[$away_name]->getWin() + 1);
                $team_array[$away_name]->setPoint($team_array[$away_name]->getPoint() + 3);
            }
            else {
                $team_array[$home_name]->setDraw($team_array[$home_name]->getDraw() + 1);
                $team_array[$home_name]->setPoint($team_array[$home_name]->getPoint() + 1);
                $team_array[$away_name]->setDraw($team_array[$away_name]->getDraw() + 1);
                $team_array[$away_name]->setPoint($team_array[$away_name]->getPoint() + 1);
            }
            $team_array[$home_name]->setGoalFor($team_array[$home_name]->getGoalFor() + $home_score);
            $team_array[$home_name]->setGoalAgainst($team_array[$home_name]->getGoalAgainst() + $away_score);
            $team_array[$home_name]->setGoalDiff($team_array[$home_name]->getGoalDiff() + $home_score - $away_score);
            $team_array[$away_name]->setGoalFor($team_array[$away_name]->getGoalFor() + $away_score);
            $team_array[$away_name]->setGoalAgainst($team_array[$away_name]->getGoalAgainst() + $home_score);
            $team_array[$away_name]->setGoalDiff($team_array[$away_name]->getGoalDiff() + $away_score - $home_score);
        }

        public static function sortGroupStanding($team_array, $match_dto) {
            $tmp_array2 = $team_array;
            for ($i = 0; $i <= 2; $i++) {
                for ($j = $i+1; $j <= 3; $j++) {
                    if (self::isEqualStanding($tmp_array2[$i], $tmp_array2[$j])) {
                        $still_tie = self::applyTiebreaker($tmp_array2[$i], $tmp_array2[$j], $match_dto);
                        if ($still_tie) self::coinToss($tmp_array2[$i], $tmp_array2[$j]);
                    }
                    elseif (self::isHigherStanding($tmp_array2[$j], $tmp_array2[$i])) {
                        self::swapTeam($tmp_array2[$i], $tmp_array2[$j]);
                    }
                }
            }
            return $tmp_array2;
        }

        public static function round16Qualifiers($team_dto, $match_dto) {
            $teams = Team::getTeamArrayByGroup($team_dto);
            $round16_teams = array();
            $matches = $match_dto->getMatches();
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
            $match_dto->setMatches($matches);
        }

        public static function quarterfinalQualifiers($team_dto, $match_dto) {
            $teams = Team::getTeamArrayByName($team_dto);
            $quarterfinal_teams = array();
            $matches = $match_dto->getMatches();
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
            $match_dto->setMatches($matches);
        }

        public static function semifinalQualifiers($team_dto, $match_dto) {
            $teams = Team::getTeamArrayByName($team_dto);
            $semifinal_teams = array();
            $matches = $match_dto->getMatches();
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
            $match_dto->setMatches($matches);
        }

        public static function finalQualifiers($team_dto, $match_dto) {
            $teams = Team::getTeamArrayByName($team_dto);
            $final_teams = array();
            $matches = $match_dto->getMatches();
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
            $tmp_m = $matches[62];
            $matches[62] = $matches[63];
            $matches[63] = $tmp_m;
            $match_dto->setMatches($matches);
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

        public static function applyTiebreaker(&$t1, &$t2, $match_dto) {
            $still_tie = false;
            $matches = $match_dto->getMatches();
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

        public static function coinToss(&$t1, &$t2) {
            $coin = mt_rand(0,1);
            if ($coin == 1) self::swapTeam($t1, $t2);
        }

        public static function swapTeam(&$t1, &$t2) {
            $tmp_t = $t1;
            $t1 = $t2;
            $t2 = $tmp_t;
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
