<?php
    namespace v2;
    include_once('config.php');

    class Team {
        private $id;
        private $name;
        private $code;
        private $group_name;
        private $group_order;
        private $parent_id;
        private $parent_name;
        private $parent_group_name;
        private $parent_group_long_name;
        private $parent_group_order;
        private $flag_filename;
        private $logo_filename;
        private $tournament_count;
        private $match_play;
        private $win;
        private $draw;
        private $loss;
        private $goal_for;
        private $goal_against;
        private $goal_diff;
        private $point;
        private $best_finish;
        private $scenarios;

        protected function __construct() { }

        public static function CreateTeam($id, $name, $code, $group_name, $group_order,
            $parent_id, $parent_name, $parent_group_name, $parent_group_long_name, $parent_group_order,
            $flag_filename, $logo_filename,
            $tournament_count, $match_play, $win, $draw, $loss,
            $goal_for, $goal_against, $goal_diff, $point, $best_finish, $scenarios)
        {
            $t = new Team();
            $t->id = $id;
            $t->name = $name;
            $t->code = $code;
            $t->group_name = $group_name;
            $t->group_order = $group_order;
            $t->parent_id = $parent_id;
            $t->parent_name = $parent_name;
            $t->parent_group_name = $parent_group_name;
            $t->parent_group_long_name = $parent_group_long_name;
            $t->parent_group_order = $parent_group_order;
            $t->flag_filename = $flag_filename;
            $t->logo_filename = $logo_filename;
            $t->tournament_count = $tournament_count;
            $t->match_play = $match_play;
            $t->win = $win;
            $t->draw = $draw;
            $t->loss = $loss;
            $t->goal_for = $goal_for;
            $t->goal_against = $goal_against;
            $t->goal_diff = $goal_diff;
            $t->point = $point;
            $t->best_finish = $best_finish;
            $t->scenarios = $scenarios;
            return $t;
        }

        public static function CreateSoccerTeam($id, $name, $code, $parent_id, $parent_name, $group_name, $group_order, $flag_filename, $tournament_count) {
            return self::CreateTeam($id, $name, $code, $group_name, $group_order,
                $parent_id, $parent_name, '', '', 0, $flag_filename, '',
                $tournament_count, 0, 0, 0, 0, 0, 0, 0, 0, '', null);
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

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getCode()
        {
            return $this->code;
        }

        /**
         * @param mixed $code
         */
        public function setCode($code)
        {
            $this->code = $code;
        }

        /**
         * @return mixed
         */
        public function getGroupName()
        {
            return $this->group_name;
        }

        /**
         * @param mixed $group_name
         */
        public function setGroupName($group_name)
        {
            $this->group_name = $group_name;
        }

        /**
         * @return mixed
         */
        public function getGroupOrder()
        {
            return $this->group_order;
        }

        /**
         * @param mixed $group_order
         */
        public function setGroupOrder($group_order)
        {
            $this->group_order = $group_order;
        }

        /**
         * @return mixed
         */
        public function getParentId()
        {
            return $this->parent_id;
        }

        /**
         * @param mixed $parent_id
         */
        public function setParentId($parent_id)
        {
            $this->parent_id = $parent_id;
        }

        /**
         * @return mixed
         */
        public function getParentName()
        {
            return $this->parent_name;
        }

        /**
         * @param mixed $parent_name
         */
        public function setParentName($parent_name)
        {
            $this->parent_name = $parent_name;
        }

        /**
         * @return mixed
         */
        public function getParentGroupName()
        {
            return $this->parent_group_name;
        }

        /**
         * @param mixed $parent_group_name
         */
        public function setParentGroupName($parent_group_name)
        {
            $this->parent_group_name = $parent_group_name;
        }

        /**
         * @return mixed
         */
        public function getParentGroupLongName()
        {
            return $this->parent_group_long_name;
        }

        /**
         * @param mixed $parent_group_long_name
         */
        public function setParentGroupLongName($parent_group_long_name)
        {
            $this->parent_group_long_name = $parent_group_long_name;
        }

        /**
         * @return mixed
         */
        public function getParentGroupOrder()
        {
            return $this->parent_group_order;
        }

        /**
         * @param mixed $parent_group_order
         */
        public function setParentGroupOrder($parent_group_order)
        {
            $this->parent_group_order = $parent_group_order;
        }

        /**
         * @return mixed
         */
        public function getFlagFilename()
        {
            return $this->flag_filename;
        }

        /**
         * @param mixed $flag_filename
         */
        public function setFlagFilename($flag_filename)
        {
            $this->flag_filename = $flag_filename;
        }

        /**
         * @return string
         */
        public function getLogoFilename()
        {
            return $this->logo_filename;
        }

        /**
         * @param string $logo_filename
         */
        public function setLogoFilename($logo_filename)
        {
            $this->logo_filename = $logo_filename;
        }

        /**
         * @return mixed
         */
        public function getBestFinish()
        {
            return $this->best_finish;
        }

        /**
         * @param mixed $best_finish
         */
        public function setBestFinish($best_finish)
        {
            $this->best_finish = $best_finish;
        }

        /**
         * @return mixed
         */
        public function getMatchPlay()
        {
            return $this->match_play;
        }

        /**
         * @param mixed $match_play
         */
        public function setMatchPlay($match_play)
        {
            $this->match_play = $match_play;
        }

        /**
         * @return mixed
         */
        public function getWin()
        {
            return $this->win;
        }

        /**
         * @param mixed $win
         */
        public function setWin($win)
        {
            $this->win = $win;
        }

        /**
         * @return mixed
         */
        public function getDraw()
        {
            return $this->draw;
        }

        /**
         * @param mixed $draw
         */
        public function setDraw($draw)
        {
            $this->draw = $draw;
        }

        /**
         * @return mixed
         */
        public function getLoss()
        {
            return $this->loss;
        }

        /**
         * @param mixed $loss
         */
        public function setLoss($loss)
        {
            $this->loss = $loss;
        }

        /**
         * @return mixed
         */
        public function getGoalFor()
        {
            return $this->goal_for;
        }

        /**
         * @param mixed $goal_for
         */
        public function setGoalFor($goal_for)
        {
            $this->goal_for = $goal_for;
        }

        /**
         * @return mixed
         */
        public function getGoalAgainst()
        {
            return $this->goal_against;
        }

        /**
         * @param mixed $goal_against
         */
        public function setGoalAgainst($goal_against)
        {
            $this->goal_against = $goal_against;
        }

        /**
         * @return mixed
         */
        public function getGoalDiff()
        {
            return $this->goal_diff;
        }

        /**
         * @param mixed $goal_diff
         */
        public function setGoalDiff($goal_diff)
        {
            $this->goal_diff = $goal_diff;
        }

        /**
         * @return mixed
         */
        public function getPoint()
        {
            return $this->point;
        }

        /**
         * @param mixed $point
         */
        public function setPoint($point)
        {
            $this->point = $point;
        }

        /**
         * @return mixed
         */
        public function getTournamentCount()
        {
            return $this->tournament_count;
        }

        /**
         * @param mixed $tournament_count
         */
        public function setTournamentCount($tournament_count)
        {
            $this->tournament_count = $tournament_count;
        }

        /**
         * @return mixed
         */
        public function getScenarios()
        {
            return $this->scenarios;
        }

        /**
         * @param mixed $scenarios
         */
        public function setScenarios($scenarios)
        {
            $this->scenarios = $scenarios;
        }
    }

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
