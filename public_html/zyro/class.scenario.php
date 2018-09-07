<?php

    class Scenario {
        private $team1;
        private $team1_result;
        private $team1_point;
        private $team1_goal_diff;
        private $team1_goal_for;
        private $team1_goal_against;
        private $team1_status;
        private $team1_match_result;
        private $team2;
        private $team2_result;
        private $team2_point;
        private $team2_goal_diff;
        private $team2_goal_for;
        private $team2_goal_against;
        private $team2_status;
        private $team2_match_result;
        private $team3;
        private $team3_result;
        private $team3_point;
        private $team3_goal_diff;
        private $team3_goal_for;
        private $team3_goal_against;
        private $team3_status;
        private $team3_match_result;
        private $team4;
        private $team4_result;
        private $team4_point;
        private $team4_goal_diff;
        private $team4_goal_for;
        private $team4_goal_against;
        private $team4_status;
        private $team4_match_result;
        private $match1_result_goal_for;
        private $match1_result_goal_against;
        private $match2_result_goal_for;
        private $match2_result_goal_against;
        private $note;

        protected function __construct() { }

        public static function CreateScenario($team1, $team1_result, $team1_point, $team1_goal_diff, $team1_goal_for, $match1_result_goal_for, $match1_result_goal_against, $team1_status, $team1_match_result,
                                              $team2, $team2_result, $team2_point, $team2_goal_diff, $team2_goal_for, $team2_status, $team2_match_result,
                                              $team3, $team3_result, $team3_point, $team3_goal_diff, $team3_goal_for, $match2_result_goal_for, $match2_result_goal_against, $team3_status, $team3_match_result,
                                              $team4, $team4_result, $team4_point, $team4_goal_diff, $team4_goal_for, $team4_status, $team4_match_result, $note) {
            $s = new Scenario();
            $s->team1 = $team1;
            $s->team1_result = $team1_result;
            $s->team1_point = $team1_point;
            $s->team1_goal_diff = $team1_goal_diff;
            $s->team1_goal_for = $team1_goal_for;
            $s->match1_result_goal_for = $match1_result_goal_for;
            $s->match1_result_goal_against = $match1_result_goal_against;
            $s->team1_status = $team1_status;
            $s->team1_match_result = $team1_match_result;
            $s->team2 = $team2;
            $s->team2_result = $team2_result;
            $s->team2_point = $team2_point;
            $s->team2_goal_diff = $team2_goal_diff;
            $s->team2_goal_for = $team2_goal_for;
            $s->team2_status = $team2_status;
            $s->team2_match_result = $team2_match_result;
            $s->team3 = $team3;
            $s->team3_result = $team3_result;
            $s->team3_point = $team3_point;
            $s->team3_goal_diff = $team3_goal_diff;
            $s->team3_goal_for = $team3_goal_for;
            $s->match2_result_goal_for = $match2_result_goal_for;
            $s->match2_result_goal_against = $match2_result_goal_against;
            $s->team3_status = $team3_status;
            $s->team3_match_result = $team3_match_result;
            $s->team4 = $team4;
            $s->team4_result = $team4_result;
            $s->team4_point = $team4_point;
            $s->team4_goal_diff = $team4_goal_diff;
            $s->team4_goal_for = $team4_goal_for;
            $s->team4_status = $team4_status;
            $s->team4_match_result = $team4_match_result;
            $s->note = $note;
            return $s;
        }

        public static function calculateScenarios($tournament) {
            $team_array = Team::getTeamArrayByName($tournament->getTeams());
            $matches = Match::getMatchArrayByGroup($tournament->getMatches());
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
                    self::calculateGroupScenarios($group_team_names, $group_teams, $tournament->getMatches());
                }
            }
        }

        public static function calculateGroupScenarios($group_team_names, $group_teams, $matches) {
            $scenario_array = array();
            $tmp_scenarios1 = array();
            $tmp_scenarios2 = array();
            $tmp_scenarios3 = array();
            $tmp_scenarios4 = array();
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $matches));
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $matches));
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $matches));
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $matches));
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $matches));
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $matches));
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $matches));
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $matches));
            array_push($scenario_array, Soccer::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $matches));
            for ($i = 0; $i < 9; $i++) {
                array_push($tmp_scenarios1, $scenario_array[$i]);
                self::calculateTeamScenarios($tmp_scenarios1);
            }
            for ($i = 0; $i < 9; $i++) {
                array_push($tmp_scenarios2, self::CreateScenario($tmp_scenarios1[8 - $i]->getTeam2(), $tmp_scenarios1[8 - $i]->getTeam2Result(),
                    $tmp_scenarios1[8 - $i]->getTeam2Point(), $tmp_scenarios1[8 - $i]->getTeam2GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam2GoalFor(), $tmp_scenarios1[8 - $i]->getMatch1ResultGoalAgainst(), $tmp_scenarios1[8 - $i]->getMatch1ResultGoalFor(),
                    $tmp_scenarios1[8 - $i]->getTeam2Status(), $tmp_scenarios1[8 - $i]->getTeam2MatchResult(), $tmp_scenarios1[8 - $i]->getTeam1(), $tmp_scenarios1[8 - $i]->getTeam1Result(), $tmp_scenarios1[8 - $i]->getTeam1Point(), $tmp_scenarios1[8 - $i]->getTeam1GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam1GoalFor(), $tmp_scenarios1[8 - $i]->getTeam1Status(), $tmp_scenarios1[8 - $i]->getTeam1MatchResult(),
                    $tmp_scenarios1[8 - $i]->getTeam4(), $tmp_scenarios1[8 - $i]->getTeam4Result(), $tmp_scenarios1[8 - $i]->getTeam4Point(), $tmp_scenarios1[8 - $i]->getTeam4GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam4GoalFor(), $tmp_scenarios1[8 - $i]->getMatch2ResultGoalAgainst(), $tmp_scenarios1[8 - $i]->getMatch2ResultGoalFor(),
                    $tmp_scenarios1[8 - $i]->getTeam4Status(), $tmp_scenarios1[8 - $i]->getTeam4MatchResult(), $tmp_scenarios1[8 - $i]->getTeam3(), $tmp_scenarios1[8 - $i]->getTeam3Result(), $tmp_scenarios1[8 - $i]->getTeam3Point(), $tmp_scenarios1[8 - $i]->getTeam3GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam3GoalFor(), $tmp_scenarios1[8 - $i]->getTeam3Status(), $tmp_scenarios1[8 - $i]->getTeam3MatchResult(), ''));
                self::calculateTeamScenarios($tmp_scenarios2);
            }
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    array_push($tmp_scenarios3, self::CreateScenario($tmp_scenarios1[$i + 3 * $j]->getTeam3(), $tmp_scenarios1[$i + 3 * $j]->getTeam3Result(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam3Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam3GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam3GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch2ResultGoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch2ResultGoalAgainst(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam3Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam3MatchResult(), $tmp_scenarios1[$i + 3 * $j]->getTeam4(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam4GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam4GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam4MatchResult(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam1(), $tmp_scenarios1[$i + 3 * $j]->getTeam1Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam1Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam1GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam1GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch1ResultGoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch1ResultGoalAgainst(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam1Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam1MatchResult(), $tmp_scenarios1[$i + 3 * $j]->getTeam2(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam2GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam2GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam2MatchResult(), ''));
                    self::calculateTeamScenarios($tmp_scenarios3);
                }
            }
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    array_push($tmp_scenarios4, self::CreateScenario($tmp_scenarios1[8 - $i - 3 * $j]->getTeam4(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Result(),
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
                $team_array[$scenarios[$i]->getTeam1Result()] = Team::CloneSoccerTeam(0, $scenarios[$i]->getTeam1MatchResult(), $scenarios[$i]->getTeam1(), '', $scenarios[$i]->getTeam1Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam1GoalFor(), 0, $scenarios[$i]->getTeam1GoalDiff(), $scenarios[$i]->getTeam1Point());
                $team_array[$scenarios[$i]->getTeam2Result()] = Team::CloneSoccerTeam(0, $scenarios[$i]->getTeam2MatchResult(), $scenarios[$i]->getTeam2(), '', $scenarios[$i]->getTeam2Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam2GoalFor(), 0, $scenarios[$i]->getTeam2GoalDiff(), $scenarios[$i]->getTeam2Point());
                $team_array[$scenarios[$i]->getTeam3Result()] = Team::CloneSoccerTeam(0, $scenarios[$i]->getTeam3MatchResult(), $scenarios[$i]->getTeam3(), '', $scenarios[$i]->getTeam3Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam3GoalFor(), 0, $scenarios[$i]->getTeam3GoalDiff(), $scenarios[$i]->getTeam3Point());
                $team_array[$scenarios[$i]->getTeam4Result()] = Team::CloneSoccerTeam(0, $scenarios[$i]->getTeam4MatchResult(), $scenarios[$i]->getTeam4(), '', $scenarios[$i]->getTeam4Result(),
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

        /**
         * @return mixed
         */
        public function getTeam1()
        {
            return $this->team1;
        }

        /**
         * @param mixed $team1
         */
        public function setTeam1($team1)
        {
            $this->team1 = $team1;
        }

        /**
         * @return mixed
         */
        public function getTeam1Result()
        {
            return $this->team1_result;
        }

        /**
         * @param mixed $team1_result
         */
        public function setTeam1Result($team1_result)
        {
            $this->team1_result = $team1_result;
        }

        /**
         * @return mixed
         */
        public function getTeam1Point()
        {
            return $this->team1_point;
        }

        /**
         * @param mixed $team1_point
         */
        public function setTeam1Point($team1_point)
        {
            $this->team1_point = $team1_point;
        }

        /**
         * @return mixed
         */
        public function getTeam1GoalDiff()
        {
            return $this->team1_goal_diff;
        }

        /**
         * @param mixed $team1_goal_diff
         */
        public function setTeam1GoalDiff($team1_goal_diff)
        {
            $this->team1_goal_diff = $team1_goal_diff;
        }

        /**
         * @return mixed
         */
        public function getTeam1GoalFor()
        {
            return $this->team1_goal_for;
        }

        /**
         * @param mixed $team1_goal_for
         */
        public function setTeam1GoalFor($team1_goal_for)
        {
            $this->team1_goal_for = $team1_goal_for;
        }

        /**
         * @return mixed
         */
        public function getTeam1GoalAgainst()
        {
            return $this->team1_goal_against;
        }

        /**
         * @param mixed $team1_goal_against
         */
        public function setTeam1GoalAgainst($team1_goal_against)
        {
            $this->team1_goal_against = $team1_goal_against;
        }

        /**
         * @return mixed
         */
        public function getTeam1Status()
        {
            return $this->team1_status;
        }

        /**
         * @param mixed $team1_status
         */
        public function setTeam1Status($team1_status)
        {
            $this->team1_status = $team1_status;
        }

        /**
         * @return mixed
         */
        public function getTeam1MatchResult()
        {
            return $this->team1_match_result;
        }

        /**
         * @param mixed $team1_match_result
         */
        public function setTeam1MatchResult($team1_match_result)
        {
            $this->team1_match_result = $team1_match_result;
        }

        /**
         * @return mixed
         */
        public function getTeam2()
        {
            return $this->team2;
        }

        /**
         * @param mixed $team2
         */
        public function setTeam2($team2)
        {
            $this->team2 = $team2;
        }

        /**
         * @return mixed
         */
        public function getTeam2Result()
        {
            return $this->team2_result;
        }

        /**
         * @param mixed $team2_result
         */
        public function setTeam2Result($team2_result)
        {
            $this->team2_result = $team2_result;
        }

        /**
         * @return mixed
         */
        public function getTeam2Point()
        {
            return $this->team2_point;
        }

        /**
         * @param mixed $team2_point
         */
        public function setTeam2Point($team2_point)
        {
            $this->team2_point = $team2_point;
        }

        /**
         * @return mixed
         */
        public function getTeam2GoalDiff()
        {
            return $this->team2_goal_diff;
        }

        /**
         * @param mixed $team2_goal_diff
         */
        public function setTeam2GoalDiff($team2_goal_diff)
        {
            $this->team2_goal_diff = $team2_goal_diff;
        }

        /**
         * @return mixed
         */
        public function getTeam2GoalFor()
        {
            return $this->team2_goal_for;
        }

        /**
         * @param mixed $team2_goal_for
         */
        public function setTeam2GoalFor($team2_goal_for)
        {
            $this->team2_goal_for = $team2_goal_for;
        }

        /**
         * @return mixed
         */
        public function getTeam2GoalAgainst()
        {
            return $this->team2_goal_against;
        }

        /**
         * @param mixed $team2_goal_against
         */
        public function setTeam2GoalAgainst($team2_goal_against)
        {
            $this->team2_goal_against = $team2_goal_against;
        }

        /**
         * @return mixed
         */
        public function getTeam2Status()
        {
            return $this->team2_status;
        }

        /**
         * @param mixed $team2_status
         */
        public function setTeam2Status($team2_status)
        {
            $this->team2_status = $team2_status;
        }

        /**
         * @return mixed
         */
        public function getTeam2MatchResult()
        {
            return $this->team2_match_result;
        }

        /**
         * @param mixed $team2_match_result
         */
        public function setTeam2MatchResult($team2_match_result)
        {
            $this->team2_match_result = $team2_match_result;
        }

        /**
         * @return mixed
         */
        public function getTeam3()
        {
            return $this->team3;
        }

        /**
         * @param mixed $team3
         */
        public function setTeam3($team3)
        {
            $this->team3 = $team3;
        }

        /**
         * @return mixed
         */
        public function getTeam3Result()
        {
            return $this->team3_result;
        }

        /**
         * @param mixed $team3_result
         */
        public function setTeam3Result($team3_result)
        {
            $this->team3_result = $team3_result;
        }

        /**
         * @return mixed
         */
        public function getTeam3Point()
        {
            return $this->team3_point;
        }

        /**
         * @param mixed $team3_point
         */
        public function setTeam3Point($team3_point)
        {
            $this->team3_point = $team3_point;
        }

        /**
         * @return mixed
         */
        public function getTeam3GoalDiff()
        {
            return $this->team3_goal_diff;
        }

        /**
         * @param mixed $team3_goal_diff
         */
        public function setTeam3GoalDiff($team3_goal_diff)
        {
            $this->team3_goal_diff = $team3_goal_diff;
        }

        /**
         * @return mixed
         */
        public function getTeam3GoalFor()
        {
            return $this->team3_goal_for;
        }

        /**
         * @param mixed $team3_goal_for
         */
        public function setTeam3GoalFor($team3_goal_for)
        {
            $this->team3_goal_for = $team3_goal_for;
        }

        /**
         * @return mixed
         */
        public function getTeam3GoalAgainst()
        {
            return $this->team3_goal_against;
        }

        /**
         * @param mixed $team3_goal_against
         */
        public function setTeam3GoalAgainst($team3_goal_against)
        {
            $this->team3_goal_against = $team3_goal_against;
        }

        /**
         * @return mixed
         */
        public function getTeam3Status()
        {
            return $this->team3_status;
        }

        /**
         * @param mixed $team3_status
         */
        public function setTeam3Status($team3_status)
        {
            $this->team3_status = $team3_status;
        }

        /**
         * @return mixed
         */
        public function getTeam3MatchResult()
        {
            return $this->team3_match_result;
        }

        /**
         * @param mixed $team3_match_result
         */
        public function setTeam3MatchResult($team3_match_result)
        {
            $this->team3_match_result = $team3_match_result;
        }

        /**
         * @return mixed
         */
        public function getTeam4()
        {
            return $this->team4;
        }

        /**
         * @param mixed $team4
         */
        public function setTeam4($team4)
        {
            $this->team4 = $team4;
        }

        /**
         * @return mixed
         */
        public function getTeam4Result()
        {
            return $this->team4_result;
        }

        /**
         * @param mixed $team4_result
         */
        public function setTeam4Result($team4_result)
        {
            $this->team4_result = $team4_result;
        }

        /**
         * @return mixed
         */
        public function getTeam4Point()
        {
            return $this->team4_point;
        }

        /**
         * @param mixed $team4_point
         */
        public function setTeam4Point($team4_point)
        {
            $this->team4_point = $team4_point;
        }

        /**
         * @return mixed
         */
        public function getTeam4GoalDiff()
        {
            return $this->team4_goal_diff;
        }

        /**
         * @param mixed $team4_goal_diff
         */
        public function setTeam4GoalDiff($team4_goal_diff)
        {
            $this->team4_goal_diff = $team4_goal_diff;
        }

        /**
         * @return mixed
         */
        public function getTeam4GoalFor()
        {
            return $this->team4_goal_for;
        }

        /**
         * @param mixed $team4_goal_for
         */
        public function setTeam4GoalFor($team4_goal_for)
        {
            $this->team4_goal_for = $team4_goal_for;
        }

        /**
         * @return mixed
         */
        public function getTeam4GoalAgainst()
        {
            return $this->team4_goal_against;
        }

        /**
         * @param mixed $team4_goal_against
         */
        public function setTeam4GoalAgainst($team4_goal_against)
        {
            $this->team4_goal_against = $team4_goal_against;
        }

        /**
         * @return mixed
         */
        public function getTeam4Status()
        {
            return $this->team4_status;
        }

        /**
         * @param mixed $team4_status
         */
        public function setTeam4Status($team4_status)
        {
            $this->team4_status = $team4_status;
        }

        /**
         * @return mixed
         */
        public function getTeam4MatchResult()
        {
            return $this->team4_match_result;
        }

        /**
         * @param mixed $team4_match_result
         */
        public function setTeam4MatchResult($team4_match_result)
        {
            $this->team4_match_result = $team4_match_result;
        }

        /**
         * @return mixed
         */
        public function getMatch1ResultGoalFor()
        {
            return $this->match1_result_goal_for;
        }

        /**
         * @param mixed $match1_result_goal_for
         */
        public function setMatch1ResultGoalFor($match1_result_goal_for)
        {
            $this->match1_result_goal_for = $match1_result_goal_for;
        }

        /**
         * @return mixed
         */
        public function getMatch1ResultGoalAgainst()
        {
            return $this->match1_result_goal_against;
        }

        /**
         * @param mixed $match1_result_goal_against
         */
        public function setMatch1ResultGoalAgainst($match1_result_goal_against)
        {
            $this->match1_result_goal_against = $match1_result_goal_against;
        }

        /**
         * @return mixed
         */
        public function getMatch2ResultGoalFor()
        {
            return $this->match2_result_goal_for;
        }

        /**
         * @param mixed $match2_result_goal_for
         */
        public function setMatch2ResultGoalFor($match2_result_goal_for)
        {
            $this->match2_result_goal_for = $match2_result_goal_for;
        }

        /**
         * @return mixed
         */
        public function getMatch2ResultGoalAgainst()
        {
            return $this->match2_result_goal_against;
        }

        /**
         * @param mixed $match2_result_goal_against
         */
        public function setMatch2ResultGoalAgainst($match2_result_goal_against)
        {
            $this->match2_result_goal_against = $match2_result_goal_against;
        }

        /**
         * @return mixed
         */
        public function getNote()
        {
            return $this->note;
        }

        /**
         * @param mixed $note
         */
        public function setNote($note)
        {
            $this->note = $note;
        }
    }
