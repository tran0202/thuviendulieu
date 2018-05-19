<?php
    class Soccer {
        private $id;

        protected function __construct(){ }

        public static function CreateSoccer($id) {
            $s = new Soccer();
            $s->id = $id;
            return $s;
        }

        public static function getStanding($team_dto, $match_dto, $fantasy) {
            $ft = new FantasyType();
            $numberOfMatches = 48;
            if ($fantasy == $ft->getFantasyType('First2Matches')) $numberOfMatches = 32;
            $matches = $match_dto->getMatches();
            $team_array = Team::getTeamArrayByName($team_dto);
            $tmp_array = array();
            $result = array();
            for ($i = 0; $i < $numberOfMatches; $i++ ) {
                self::calculatePoint($team_array, $matches[$i]);
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
            if ($fantasy == $ft->getFantasyType('AllMatches')) {
                self::round16Qualifiers($team_dto, $match_dto);
                self::quarterfinalQualifiers($team_dto, $match_dto);
                self::semifinalQualifiers($team_dto, $match_dto);
                self::finalQualifiers($team_dto, $match_dto);
            }
            elseif ($fantasy == $ft->getFantasyType('First2Matches')) {
                self::calculateScenarios($team_dto, $match_dto);
            }
        }

        public static function getTournamentRanking($team_dto, $match_dto, $stage = Stage::First, $all_time_ranking = false) {
            $matches = $match_dto->getMatches();
            $match_count = sizeof($matches);
            $team_array = Team::getTeamArrayByName($team_dto);
            $tmp_array = array();
            foreach ($team_array as $name => $_team) {
                $tmp_array[$_team->getName()] = Team::copySoccerTeam($_team);
            }
            $result = array();
            $start_index = 0;
            $end_index = $match_count - 16;
            if ($stage == Stage::Second) {
                $start_index = $match_count - 16;
                $end_index = $match_count;
            }
            elseif ($stage == Stage::AllStages) {
                $end_index = sizeof($matches);
            }
            for ($i = $start_index; $i < $end_index; $i++ ) {
                self::calculatePoint($tmp_array, $matches[$i], $stage, $all_time_ranking);
            }
            foreach ($tmp_array as $name => $_team) {
                array_push($result, $_team);
            }
            if ($stage <> Stage::AllStages) {
                $result = self::sortTournamentStanding($result, $match_dto, $stage);
            }
            else {
                $result = self::sortGroupStanding($result, $match_dto);
            }
            $team_dto->setTeams($result);
        }

        public static function getTournamentSecondRoundRanking($team_dto, $match_dto) {
            $matches = $match_dto->getMatches();
            $team_array = Team::getSecondRoundTeamArrayByName($team_dto);
            $tmp_array = array();
            foreach ($team_array as $name => $_team) {
                $tmp_team = Team::copySoccerTeam($_team);
                $tmp_array[$_team->getName()] = $tmp_team;
            }
            $result = array();
            $start_index = 36;
            $end_index = 48;

            for ($i = $start_index; $i < $end_index; $i++ ) {
                $tmp_array[$matches[$i]->getHomeTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
                $tmp_array[$matches[$i]->getAwayTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
                self::calculatePoint($tmp_array, $matches[$i]);
            }
            foreach ($tmp_array as $name => $_team) {
                array_push($result, $_team);
            }
            $result = self::sortGroupStanding($result, $match_dto);
//            if ($stage <> Stage::AllStages) {
//                $result = self::sortTournamentStanding($result, $match_dto, $stage);
//            }
//            else {
//                $result = self::sortGroupStanding($result, $match_dto);
//            }
            $team_dto->setSecondRoundTeams($result);
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
                if (sizeof($group_teams) > 0) {
                    self::calculateGroupScenarios($group_team_names, $group_teams, $match_dto);
                }
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
                self::calculateTeamScenarios($tmp_scenarios1);
            }
            for ($i = 0; $i < 9; $i++) {
                array_push($tmp_scenarios2, Scenario::CreateScenario($tmp_scenarios1[8 - $i]->getTeam2(), $tmp_scenarios1[8 - $i]->getTeam2Result(),
                    $tmp_scenarios1[8 - $i]->getTeam2Point(), $tmp_scenarios1[8 - $i]->getTeam2GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam2GoalFor(), $tmp_scenarios1[8 - $i]->getMatch1ResultGoalAgainst(), $tmp_scenarios1[8 - $i]->getMatch1ResultGoalFor(),
                    $tmp_scenarios1[8 - $i]->getTeam2Status(), $tmp_scenarios1[8 - $i]->getTeam2MatchResult(), $tmp_scenarios1[8 - $i]->getTeam1(), $tmp_scenarios1[8 - $i]->getTeam1Result(), $tmp_scenarios1[8 - $i]->getTeam1Point(), $tmp_scenarios1[8 - $i]->getTeam1GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam1GoalFor(), $tmp_scenarios1[8 - $i]->getTeam1Status(), $tmp_scenarios1[8 - $i]->getTeam1MatchResult(),
                    $tmp_scenarios1[8 - $i]->getTeam4(), $tmp_scenarios1[8 - $i]->getTeam4Result(), $tmp_scenarios1[8 - $i]->getTeam4Point(), $tmp_scenarios1[8 - $i]->getTeam4GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam4GoalFor(), $tmp_scenarios1[8 - $i]->getMatch2ResultGoalAgainst(), $tmp_scenarios1[8 - $i]->getMatch2ResultGoalFor(),
                    $tmp_scenarios1[8 - $i]->getTeam4Status(), $tmp_scenarios1[8 - $i]->getTeam4MatchResult(), $tmp_scenarios1[8 - $i]->getTeam3(), $tmp_scenarios1[8 - $i]->getTeam3Result(), $tmp_scenarios1[8 - $i]->getTeam3Point(), $tmp_scenarios1[8 - $i]->getTeam3GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam3GoalFor(), $tmp_scenarios1[8 - $i]->getTeam3Status(), $tmp_scenarios1[8 - $i]->getTeam3MatchResult(), ''));
                self::calculateTeamScenarios($tmp_scenarios2);
            }
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    array_push($tmp_scenarios3, Scenario::CreateScenario($tmp_scenarios1[$i + 3 * $j]->getTeam3(), $tmp_scenarios1[$i + 3 * $j]->getTeam3Result(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam3Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam3GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam3GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch2ResultGoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch2ResultGoalAgainst(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam3Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam3MatchResult(), $tmp_scenarios1[$i + 3 * $j]->getTeam4(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam4GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam4GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam4MatchResult(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam1(), $tmp_scenarios1[$i + 3 * $j]->getTeam1Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam1Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam1GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam1GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch1ResultGoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch1ResultGoalAgainst(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam1Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam1MatchResult(), $tmp_scenarios1[$i + 3 * $j]->getTeam2(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam2GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam2GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam2MatchResult(), ''));
                    self::calculateTeamScenarios($tmp_scenarios3);
                }
            }
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    array_push($tmp_scenarios4, Scenario::CreateScenario($tmp_scenarios1[8 - $i - 3 * $j]->getTeam4(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Result(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Point(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4GoalDiff(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4GoalFor(), $tmp_scenarios1[8 - $i - 3 * $j]->getMatch2ResultGoalAgainst(), $tmp_scenarios1[8 - $i - 3 * $j]->getMatch2ResultGoalFor(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4MatchResult(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3Result(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3Point(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3GoalDiff(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3GoalFor(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3MatchResult(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2Result(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2Point(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2GoalDiff(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2GoalFor(), $tmp_scenarios1[8 - $i - 3 * $j]->getMatch1ResultGoalAgainst(), $tmp_scenarios1[8 - $i - 3 * $j]->getMatch1ResultGoalFor(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2MatchResult(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1Result(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1Point(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1GoalDiff(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1GoalFor(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1MatchResult(), ''));
                    self::calculateTeamScenarios($tmp_scenarios4);
                }
            }
            $group_teams[$group_team_names[0]]->setScenarios($tmp_scenarios1);
            $group_teams[$group_team_names[1]]->setScenarios($tmp_scenarios2);
            $group_teams[$group_team_names[2]]->setScenarios($tmp_scenarios3);
            $group_teams[$group_team_names[3]]->setScenarios($tmp_scenarios4);
        }

        public static function calculateTeamScenarios($scenarios) {
            $team_array = array();
            for ($i = 0; $i < sizeof($scenarios); $i++) {
                $team_array[$scenarios[$i]->getTeam1Result()] = Team::NewSoccerTeam(0, $scenarios[$i]->getTeam1MatchResult(), $scenarios[$i]->getTeam1(), '', $scenarios[$i]->getTeam1Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam1GoalFor(), 0, $scenarios[$i]->getTeam1GoalDiff(), $scenarios[$i]->getTeam1Point());
                $team_array[$scenarios[$i]->getTeam2Result()] = Team::NewSoccerTeam(0, $scenarios[$i]->getTeam2MatchResult(), $scenarios[$i]->getTeam2(), '', $scenarios[$i]->getTeam2Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam2GoalFor(), 0, $scenarios[$i]->getTeam2GoalDiff(), $scenarios[$i]->getTeam2Point());
                $team_array[$scenarios[$i]->getTeam3Result()] = Team::NewSoccerTeam(0, $scenarios[$i]->getTeam3MatchResult(), $scenarios[$i]->getTeam3(), '', $scenarios[$i]->getTeam3Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam3GoalFor(), 0, $scenarios[$i]->getTeam3GoalDiff(), $scenarios[$i]->getTeam3Point());
                $team_array[$scenarios[$i]->getTeam4Result()] = Team::NewSoccerTeam(0, $scenarios[$i]->getTeam4MatchResult(), $scenarios[$i]->getTeam4(), '', $scenarios[$i]->getTeam4Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam4GoalFor(), 0, $scenarios[$i]->getTeam4GoalDiff(), $scenarios[$i]->getTeam4Point());
                $qualify_status = QualifyStatus::Eliminated;
                $note = '';
                if ($team_array[1]->getPoint() == $team_array[2]->getPoint() && $team_array[1]->getPoint() == $team_array[3]->getPoint() &&
                    $team_array[1]->getPoint() == $team_array[4]->getPoint()) {
                    $passing_gd = $team_array[1]->getGoalDiff() - $team_array[2]->getGoalDiff() + 1;
                    $passing_gf = $team_array[1]->getGoalFor() - $team_array[2]->getGoalFor() + 1;
                    $passing_gd2 = $team_array[1]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                    $passing_gf2 = $team_array[1]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                    $passing_gd3 = $team_array[1]->getGoalDiff() - $team_array[4]->getGoalDiff() + 1;
                    $passing_gf3 = $team_array[1]->getGoalFor() - $team_array[4]->getGoalFor() + 1;
                    $passing_gd4 = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                    $passing_gf4 = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                    $passing_gd5 = $team_array[2]->getGoalDiff() - $team_array[4]->getGoalDiff() + 1;
                    $passing_gf5 = $team_array[2]->getGoalFor() - $team_array[4]->getGoalFor() + 1;
                    $passing_gd6 = $team_array[3]->getGoalDiff() - $team_array[4]->getGoalDiff() + 1;
                    $passing_gf6 = $team_array[3]->getGoalFor() - $team_array[4]->getGoalFor() + 1;
                    if ($scenarios[$i]->getTeam1Result() == 1) {
                        if ($team_array[1]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            if ($team_array[3]->getName() == 'W') { echo '<script>alert("No#11");</script>';
                                $note = '*** If both '.$team_array[2]->getCode().' and '.$team_array[3]->getCode().' catch up the goal-diff by '.($passing_gd - 1).' and '.($passing_gd2 - 1).
                                    ' respectively, and pass the goal-for by '.$passing_gf.' and '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If both '.$team_array[2]->getCode().' and '.$team_array[3]->getCode().' pass the goal-diff by '.$passing_gd.' and '.$passing_gd2.
                                    ' respectively, '.$team_array[1]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[4]->getName() == 'W') {
                                $note = '*** If both '.$team_array[2]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd.'-0 and '.$passing_gd3.'-0 (or win goal-diff by '.($passing_gd - 1).' and '.($passing_gd3 - 1).
                                    ') respectively, and score '.($passing_gf + 1).' and '.($passing_gf3 + 1).' (or win goal-for by '.($passing_gf + 1).' and '.($passing_gf3 + 1).'), '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If both '.$team_array[2]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd + 1).'-0 and '.($passing_gd3 + 1).'-0 (or win goal-diff by '.$passing_gd.' and '.$passing_gd3.
                                    ') respectively, '.$team_array[1]->getCode().' will be eliminated. ***';
                            }
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd2.'-0 and '.$passing_gd3.'-0 (or win the goal-diff by '.($passing_gd2 - 1).' and '.($passing_gd3 - 1).
                                ') respectively, and score '.($passing_gf2 + 1).' and '.($passing_gf3 + 1).' (or win goal-for by '.($passing_gf2 + 1).' and '.($passing_gf3 + 1).', '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd2 + 1).'-0 and '.($passing_gd3 + 1).'-0 (or win the goal-diff by '.$passing_gd2.' and '.$passing_gd3.
                                ') respectively, '.$team_array[1]->getCode().' will be eliminated. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 2) {
                        if ($team_array[2]->getName() == 'W' && $team_array[1]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[1]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[1]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[2]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.$passing_gf.' (or wins goal-for by '.$passing_gf.'), '.$team_array[2]->getCode().' will advance for sure. *** Or Else:<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' wins '.($passing_gd + 1).'-0 (or wins the goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will advance for sure. *** Or Else:<br>';
                            if ($team_array[3]->getName() == 'W') { echo '<script>alert("No#12");</script>';
                                $note .= '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[4]->getName() == 'W') {
                                $note .= '*** If '.$team_array[4]->getCode().' wins '.$passing_gd5.'-0 (or wins goal-diff by '.($passing_gd5 - 1).') and scores '.($passing_gf5 + 1).' (or wins goal-for by '.$passing_gf5.'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd5 + 1).'-0 (or wins the goal-diff by '.$passing_gd5.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[1]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[1]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[1]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[1]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            if ($team_array[3]->getName() == 'W') {
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd4.'-0 (or wins goal-diff by '.($passing_gd4 - 1).') and scores '.($passing_gf4 + 1).' (or wins goal-for by '.($passing_gf4 + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd4 + 1).'-0 (or wins goal-diff by '.$passing_gd4.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[4]->getName() == 'W') { echo '<script>alert("No#14");</script>';
                                $note = '*** If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd5 - 1).' and passes the goal-for by '.$passing_gf5.', '.$team_array[2]->getCode().' will be eliminated.<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd5.', '.$team_array[2]->getCode().' will be eliminated.';
                            }
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[1]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[1]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd4.'-0 and '.$passing_gd5.'-0 (or win goal-diff by '.($passing_gd4 - 1).' and '.($passing_gd5 - 1).
                                ') respectively, and score '.($passing_gf4 + 1).' and '.($passing_gf5 + 1).' (or win goal-for by '.($passing_gf4 + 1).' and '.($passing_gf5 + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd4 + 1).'-0 and '.($passing_gd5 + 1).'-0 (or win goal-diff by '.$passing_gd4.' and '.$passing_gd5.
                                ') respectively, '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 3) {
                        if ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#15");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd2 - 1).' and passes the goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#16");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd2 - 1).' and passes the goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd2.'-0 (or wins goal-diff by '.($passing_gd2 - 1).') and scores '.($passing_gf2 + 1).' (or wins goal-for by '.($passing_gf2 + 1).'), '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd2 + 1).'-0 (or wins goal-diff by '.$passing_gd2.'), '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[3]->getCode().' wins '.$passing_gd4.'-0 (or wins goal-diff by '.($passing_gd4 - 1).') and scores '.($passing_gf4 + 1).' (or wins goal-for by '.($passing_gf4 + 1).'), '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd4 + 1).'-0 (or wins goal-diff by '.$passing_gd4.'), '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[4]->getCode().' wins '.$passing_gd6.'-0 (or wins goal-diff by '.($passing_gd6 - 1).') and scores '.($passing_gf6 + 1).' (or wins goal-for by '.$passing_gf6.'), '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd6 + 1).'-0 (or wins goal-diff by '.$passing_gd6.'), '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance.<br>';
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                            if ($team_array[1]->getName() == 'L') { echo '<script>alert("No#17");</script>';
                                $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd2 - 1).' and passes the goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            }
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                            if ($team_array[1]->getName() == 'L') { echo '<script>alert("No#18");</script>';
                                $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd2 - 1).' and passes the goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                                $note .= '*** Or If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd6 - 1).' and passes the goal-for by '.$passing_gf6.', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd6.', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance.<br>';
                            }
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            if ($team_array[1]->getName() == 'W') { echo '<script>alert("No#19");</script>';
                                $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            }
                            elseif ($team_array[1]->getName() == 'D') { echo '<script>alert("No#20");</script>';
                                $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                                $note .= '*** Or If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd6 - 1).' and passes the goal-for by '.$passing_gf6.', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd6.', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance.<br>';
                            }
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                            if ($team_array[1]->getName() == 'L') {
                                $note = '*** If '.$team_array[1]->getCode().' loses 0-'.$passing_gd2.' (or loses goal-diff by '.($passing_gd2 - 1).') and loses goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[1]->getCode().' loses 0-'.($passing_gd2 + 1).' (or loses goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                                $note .= '*** Or If '.$team_array[4]->getCode().' wins '.$passing_gd6.'-0 (or wins goal-diff by '.($passing_gd6 - 1).') and wins the goal-for by '.($passing_gf6 + 1).', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd6 + 1).'-0 (or wins goal-diff by '.$passing_gd6.'), '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance.<br>';
                            }
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#21");</script>';
                            $note = '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and '.($passing_gd5 - 1).
                                ' respectively, and passes the goal-for by '.$passing_gf4.' and '.$passing_gf5.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd4.' and '.$passing_gd5.
                                ' respectively, '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** Or If both '.$team_array[3]->getCode().' and '.$team_array[2]->getCode().' catches up the goal-diff by '.($passing_gd6 - 1).' and '.($passing_gd5 - 1).
                                ' respectively, and passes the goal-for by '.$passing_gf6.' and '.$passing_gf5.', '.$team_array[4]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[2]->getCode().' will advance.***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[2]->getCode().' passes the goal-diff by '.$passing_gd6.' and '.$passing_gd5.
                                ' respectively, '.$team_array[4]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[2]->getCode().' will advance.***<br>';
                        }
                    }
                    else {
                        if ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[4]->getCode().' wins '.$passing_gd3.'-0 (or wins goal-diff by '.($passing_gd3 - 1).') and scores '.($passing_gf3 + 1).' (or wins goal-for by '.($passing_gf3 + 1).'), '.$team_array[1]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd3 + 1).'-0 (or wins goal-diff by '.$passing_gd3.'), '.$team_array[1]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[4]->getCode().' wins '.$passing_gd5.'-0 (or wins goal-diff by '.($passing_gd5 - 1).') and scores '.($passing_gf5 + 1).' (or wins goal-for by '.$passing_gf5.'), '.$team_array[2]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd5 + 1).'-0 (or wins goal-diff by '.$passing_gd5.'), '.$team_array[2]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance.<br>';
                        }
                        elseif ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#22");</script>';
                            $note = '*** If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd3 - 1).' and passes the goal-for by '.$passing_gf3.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd3.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd5 - 1).' and passes the goal-for by '.$passing_gf5.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd5.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance.<br>';
                        }
                        elseif ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd2.'-0 and '.$passing_gd3.'-0 (or win goal-diff by '.($passing_gd2 - 1).' and '.($passing_gd3 - 1).
                                ') respectively, and score '.($passing_gf2 + 1).' and '.($passing_gf3 + 1).' (or win goal-for by '.($passing_gf2 + 1).' and '.($passing_gf3 + 1).'), '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd2 + 1).'-0 and '.($passing_gd3 + 1).'-0 (or win goal-diff by '.$passing_gd2.' and '.$passing_gd3.
                                ') respectively, '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** Or If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd4.'-0 and '.$passing_gd5.'-0 (or win goal-diff by '.($passing_gd4 - 1).' and '.($passing_gd5 - 1).
                                ') respectively, and score '.($passing_gf4 + 1).' and '.($passing_gf5 + 1).' (or win goal-for by '.($passing_gf4 + 1).' and '.($passing_gf5 + 1).'), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd4 + 1).'-0 and '.($passing_gd5 + 1).'-0 (or win goal-diff by '.$passing_gd4.' and '.$passing_gd5.
                                ') respectively, '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                    }
                }
                elseif ($team_array[1]->getPoint() == $team_array[2]->getPoint() && $team_array[1]->getPoint() == $team_array[3]->getPoint()) {
                    if ($scenarios[$i]->getTeam1Result() == 1) {
                        $passing_gd = $team_array[1]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[1]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[1]->getName() == 'W' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[1]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[1]->getName() == 'W' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'W' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or similar), '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins the goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[1]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[1]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[1]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced; echo '<script>alert("No#1");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd.', '.$team_array[1]->getCode().' will be eliminated. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 2) {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or similar), '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced; echo '<script>alert("No#2");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd.', '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 3) {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#4");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' makes up the goal-diff by '.$passing_gd.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                }
                elseif ($team_array[2]->getPoint() == $team_array[3]->getPoint() && $team_array[2]->getPoint() == $team_array[4]->getPoint()) {
                    if ($scenarios[$i]->getTeam1Result() == 1) {
                        $qualify_status = QualifyStatus::Advanced;
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 2) {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced; echo '<script>alert("No#5");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd.', '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced; echo '<script>alert("No#6");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' wins by '.$passing_gd.' and passes the goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins by '.($passing_gd + 1).', '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 3) {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#7");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' makes up the goal-diff by '.$passing_gd.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#8");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' wins by '.$passing_gd.' and passes the goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins by '.($passing_gd+ 1).', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                    else {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[4]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[4]->getGoalFor() + 1;
                        if ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#9");</script>';
                            $note = '*** If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' makes up the goal-diff by '.$passing_gd.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#10");</script>';
                            $note = '*** If '.$team_array[4]->getCode().' wins by '.$passing_gd.' and passes the goal-for by '.$passing_gf.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins by '.($passing_gd+ 1).', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[4]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd+ 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                }
                else {
                    $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                    $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                    if ($scenarios[$i]->getTeam1Result() == 1) {
                        if ($team_array[1]->getPoint() > $team_array[2]->getPoint()) {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        else {
                            if ($team_array[1]->getPoint() > $team_array[3]->getPoint()) {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 2) {
                        if ($team_array[2]->getPoint() > $team_array[3]->getPoint()) {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        else {
                            // Cover both gd greater and equal
                            if ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or equals goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. *** <br>';
                            }
                            elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                            elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                            elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or beats goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or similar), '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                            elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                            elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or equals goal-diff by '.($passing_gd + 1).') and scores '.($passing_gf + 1).' (or beats goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.($passing_gd + 2).'), '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                                $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                            }
                            elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                                $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                            }
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 3) {
                        if ($team_array[3]->getPoint() == $team_array[2]->getPoint()) {
                            // Cover both gd equal and smaller
                            if ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Eliminated;
                            }
                            elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Eliminated;
                            }
                            elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Eliminated;
                            }
                            elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Eliminated;
                            }
                            elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                                $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                            }
                        }
                    }
                }
                $scenarios[$i]->setTeam1Status($qualify_status);
                $scenarios[$i]->setNote($note);
            }
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
            $tmp_m1 = Match::NewSoccerMatch(0, $t1, 'T1', 0, $t2, 'T2', $t1_gf, $t1_ga);
            $tmp_m3 = Match::NewSoccerMatch(0, $t3, 'T3', 0, $t4, 'T4', $t3_gf, $t3_ga);
            self::calculatePoint($tmp_group_teams, $tmp_m1);
            self::calculatePoint($tmp_group_teams, $tmp_m3);
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

        public static function calculatePoint(&$team_array, $match, $stage = Stage::First, $all_time_ranking = false) {
            $points_for_win = 3;
            if ($match->getPointsForWin() == 2 && !$all_time_ranking) $points_for_win = 2;
            $home_name = $match->getHomeTeamName();
            $away_name = $match->getAwayTeamName();
            if ($all_time_ranking && $match->getHomeParentTeamName() != null) {
                $home_name = $match->getHomeParentTeamName();
                unset($team_array[$match->getHomeTeamName()]);
            }
            if ($all_time_ranking && $match->getAwayParentTeamName() != null) {
                $away_name = $match->getAwayParentTeamName();
                unset($team_array[$match->getAwayTeamName()]);
            }
            $home_team = $team_array[$home_name];
            $away_team = $team_array[$away_name];
            $home_score = $match->getHomeTeamScore();
            $away_score = $match->getAwayTeamScore();
            $home_extra_time_score = $match->getHomeTeamExtraTimeScore();
            $away_extra_time_score = $match->getAwayTeamExtraTimeScore();
            $home_team->setMatchPlay($home_team->getMatchPlay() + 1);
            $away_team->setMatchPlay($away_team->getMatchPlay() + 1);
            if ($home_score > $away_score) {
                $home_team->setWin($home_team->getWin() + 1);
                $home_team->setPoint($home_team->getPoint() + $points_for_win);
                $away_team->setLoss($away_team->getLoss() + 1);
            }
            elseif ($home_score < $away_score) {
                $home_team->setLoss($home_team->getLoss() + 1);
                $away_team->setWin($away_team->getWin() + 1);
                $away_team->setPoint($away_team->getPoint() + $points_for_win);
            }
            else {
                if ($stage == Stage::First) {
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
                    }
                    elseif ($home_extra_time_score < $away_extra_time_score) {
                        $home_team->setLoss($home_team->getLoss() + 1);
                        $away_team->setWin($away_team->getWin() + 1);
                        $away_team->setPoint($away_team->getPoint() + $points_for_win);
                    }
                    else {
                        $home_team->setDraw($home_team->getDraw() + 1);
                        $home_team->setPoint($home_team->getPoint() + 1);
                        $away_team->setDraw($away_team->getDraw() + 1);
                        $away_team->setPoint($away_team->getPoint() + 1);
                    }
                }
            }
            $home_team->setGoalFor($home_team->getGoalFor() + $home_score);
            $home_team->setGoalAgainst($home_team->getGoalAgainst() + $away_score);
            $home_team->setGoalDiff($home_team->getGoalDiff() + $home_score - $away_score);
            $away_team->setGoalFor($away_team->getGoalFor() + $away_score);
            $away_team->setGoalAgainst($away_team->getGoalAgainst() + $home_score);
            $away_team->setGoalDiff($away_team->getGoalDiff() + $away_score - $home_score);
            if ($stage <> Stage::First && $home_score == $away_score) {
                $home_team->setGoalFor($home_team->getGoalFor() + $home_extra_time_score);
                $home_team->setGoalAgainst($home_team->getGoalAgainst() + $away_extra_time_score);
                $home_team->setGoalDiff($home_team->getGoalDiff() + $home_extra_time_score - $away_extra_time_score);
                $away_team->setGoalFor($away_team->getGoalFor() + $away_extra_time_score);
                $away_team->setGoalAgainst($away_team->getGoalAgainst() + $home_extra_time_score);
                $away_team->setGoalDiff($away_team->getGoalDiff() + $away_extra_time_score - $home_extra_time_score);
            }
        }

        public static function sortTournamentStanding($team_array, $match_dto, $stage = Stage::First) {
            $match_count = sizeof($match_dto->getMatches());
            $tmp_array = array();
            if ($stage <> Stage::First) {
                $tmp_array[7] = array();
                $tmp_array[5] = array();
                $tmp_array[4] = array();
            }
            $tmp_array[3] = array();
            $tmp_array2 = array();
            for ($i = 0; $i < sizeof($team_array); $i++) {
                $tmp_array[$team_array[$i]->getMatchPlay()][$team_array[$i]->getName()] = $team_array[$i];
            }
            foreach ($tmp_array as $mp => $teams) {
                if ($mp < 7) {
                    $tmp_array3 = array();
                    foreach ($teams as $t_name => $team) {
                        array_push($tmp_array3, $team);
                    }
                    $tmp_array3 = self::sortGroupStanding($tmp_array3, $match_dto);
                    for ($i = 0; $i < sizeof($tmp_array3); $i++) {
                        array_push($tmp_array2, $tmp_array3[$i]);
                    }
                }
                else {
                    $matches = $match_dto->getMatches();
                    $champion_name = $matches[$match_count-1]->getHomeTeamName();
                    $runner_up_name = $matches[$match_count-1]->getAwayTeamName();
                    if ($matches[$match_count-1]->getHomeTeamScore() < $matches[$match_count-1]->getAwayTeamScore()) {
                        $champion_name = $matches[$match_count-1]->getAwayTeamName();
                        $runner_up_name = $matches[$match_count-1]->getHomeTeamName();
                    }
                    elseif ($matches[$match_count-1]->getHomeTeamScore() == $matches[$match_count-1]->getAwayTeamScore()) {
                        if ($matches[$match_count-1]->getHomeTeamExtraTimeScore() < $matches[$match_count-1]->getAwayTeamExtraTimeScore()) {
                            $champion_name = $matches[$match_count-1]->getAwayTeamName();
                            $runner_up_name = $matches[$match_count-1]->getHomeTeamName();
                        }
                        elseif ($matches[$match_count-1]->getHomeTeamExtraTimeScore() == $matches[$match_count-1]->getAwayTeamExtraTimeScore()) {
                            if ($matches[$match_count-1]->getHomeTeamPenaltyScore() < $matches[$match_count-1]->getAwayTeamPenaltyScore()) {
                                $champion_name = $matches[$match_count-1]->getAwayTeamName();
                                $runner_up_name = $matches[$match_count-1]->getHomeTeamName();
                            }
                        }
                    }
                    $third_place_name = $matches[$match_count-2]->getHomeTeamName();
                    $fourth_place_name = $matches[$match_count-2]->getAwayTeamName();
                    if ($matches[$match_count-2]->getHomeTeamScore() < $matches[$match_count-2]->getAwayTeamScore()) {
                        $third_place_name = $matches[$match_count-2]->getAwayTeamName();
                        $fourth_place_name = $matches[$match_count-2]->getHomeTeamName();
                    }
                    elseif ($matches[$match_count-2]->getHomeTeamScore() == $matches[$match_count-2]->getAwayTeamScore()) {
                        if ($matches[$match_count-2]->getHomeTeamExtraTimeScore() < $matches[$match_count-2]->getAwayTeamExtraTimeScore()) {
                            $third_place_name = $matches[$match_count-2]->getAwayTeamName();
                            $fourth_place_name = $matches[$match_count-2]->getHomeTeamName();
                        }
                        elseif ($matches[$match_count-2]->getHomeTeamExtraTimeScore() == $matches[$match_count-2]->getAwayTeamExtraTimeScore()) {
                            if ($matches[$match_count-2]->getHomeTeamPenaltyScore() < $matches[$match_count-2]->getAwayTeamPenaltyScore()) {
                                $third_place_name = $matches[$match_count-2]->getAwayTeamName();
                                $fourth_place_name = $matches[$match_count-2]->getHomeTeamName();
                            }
                        }
                    }
                    array_push($tmp_array2, $tmp_array[7][$champion_name]);
                    array_push($tmp_array2, $tmp_array[7][$runner_up_name]);
                    array_push($tmp_array2, $tmp_array[7][$third_place_name]);
                    array_push($tmp_array2, $tmp_array[7][$fourth_place_name]);
                }
            }
            return $tmp_array2;
        }

        public static function sortGroupStanding($team_array, $match_dto) {
            $tmp_array2 = $team_array;
            for ($i = 0; $i < sizeof($team_array) - 1; $i++) {
                for ($j = $i + 1; $j < sizeof($team_array); $j++) {
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

        public static function isTournamentFinal($match_dto) {
            $matches = $match_dto->getMatches();
            $final_result = false;
            if ($matches[48]->getHomeTeamName()) $final_result = true;
            return $final_result;
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
