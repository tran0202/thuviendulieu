<?php
    include_once('config.php');

    class Team {
        private $id;
        private $tournament_name;
        private $name;
        private $l_name;
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
        private $home_win;
        private $home_tie;
        private $home_loss;
        private $road_win;
        private $road_tie;
        private $road_loss;
        private $div_win;
        private $div_tie;
        private $div_loss;
        private $conf_win;
        private $conf_tie;
        private $conf_loss;
        private $last5_win;
        private $last5_tie;
        private $last5_loss;
        private $streak;
        private $opponents;
        private $common_opponents;
        private $goal_for;
        private $goal_against;
        private $goal_diff;
        private $point;
        private $best_finish;
        private $advanced_second_round;
        private $scenarios;

        protected function __construct() { }

        public static function CreateTeam($id, $tournament_name, $name, $l_name, $code, $group_name, $group_order,
            $parent_id, $parent_name, $parent_group_name, $parent_group_long_name, $parent_group_order,
            $flag_filename, $logo_filename,
            $tournament_count, $match_play, $win, $draw, $loss, $home_win, $home_tie, $home_loss, $road_win, $road_tie, $road_loss,
            $div_win, $div_tie, $div_loss, $conf_win, $conf_tie, $conf_loss, $last5_win, $last5_tie, $last5_loss, $streak,
            $opponents, $common_opponents, $goal_for, $goal_against, $goal_diff, $point, $best_finish, $scenarios)
        {
            $t = new Team();
            $t->id = $id;
            $t->tournament_name = $tournament_name;
            $t->name = $name;
            $t->l_name = $l_name;
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
            $t->home_win = $home_win;
            $t->home_tie = $home_tie;
            $t->home_loss = $home_loss;
            $t->road_win = $road_win;
            $t->road_tie = $road_tie;
            $t->road_loss = $road_loss;
            $t->div_win = $div_win;
            $t->div_tie = $div_tie;
            $t->div_loss = $div_loss;
            $t->conf_win = $conf_win;
            $t->conf_tie = $conf_tie;
            $t->conf_loss = $conf_loss;
            $t->last5_win = $last5_win;
            $t->last5_tie = $last5_tie;
            $t->last5_loss = $last5_loss;
            $t->streak = $streak;
            $t->opponents = $opponents;
            $t->common_opponents = $common_opponents;
            $t->goal_for = $goal_for;
            $t->goal_against = $goal_against;
            $t->goal_diff = $goal_diff;
            $t->point = $point;
            $t->best_finish = $best_finish;
            $t->scenarios = $scenarios;
            return $t;
        }

        public static function CreateSoccerTeam($id, $tournament_name, $name, $l_name, $code, $parent_id, $parent_name,
                $group_name, $group_order, $parent_group_name, $parent_group_long_name, $parent_group_order,
                $flag_filename, $logo_filename, $tournament_count) {
            return self::CreateTeam($id, $tournament_name, $name, $l_name, $code, $group_name, $group_order,
                $parent_id, $parent_name, $parent_group_name, $parent_group_long_name, $parent_group_order, $flag_filename, $logo_filename,
                $tournament_count, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, array(), array(), array(),
                0, 0, 0, 0, null, null);
        }

        public static function CloneSoccerTeam($id, $name, $code, $group_name, $group_order,
                                             $match_play, $win, $draw, $loss, $goal_for, $goal_against, $goal_diff, $point) {
            return self::CreateTeam($id, '', $name, '', $code, $group_name, $group_order,
                0, '', '', '', 0, '', '',
                0, $match_play, $win, $draw, $loss, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, array(), array(), array(),
                $goal_for, $goal_against, $goal_diff, $point, null, null);
        }

        public static function CreateFootballTeam(
            $id, $name, $group_name, $group_order,
            $parent_group_name, $parent_group_long_name, $parent_group_order, $logo_filename)
        {
            return self::CreateTeam($id, '', $name, '', '', $group_name, $group_order,
                0, '', $parent_group_name, $parent_group_long_name, $parent_group_order, '', $logo_filename,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, array(), array(), array(),
                0, 0, 0, 0, null, null);
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
        public function getTournamentName()
        {
            return $this->tournament_name;
        }

        /**
         * @param mixed $tournament_name
         */
        public function setTournamentName($tournament_name)
        {
            $this->tournament_name = $tournament_name;
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
        public function getLName()
        {
            return $this->l_name;
        }

        /**
         * @param mixed $l_name
         */
        public function setLName($l_name)
        {
            $this->l_name = $l_name;
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
        public function getHomeWin()
        {
            return $this->home_win;
        }

        /**
         * @param mixed $home_win
         */
        public function setHomeWin($home_win)
        {
            $this->home_win = $home_win;
        }

        /**
         * @return mixed
         */
        public function getHomeTie()
        {
            return $this->home_tie;
        }

        /**
         * @param mixed $home_tie
         */
        public function setHomeTie($home_tie)
        {
            $this->home_tie = $home_tie;
        }

        /**
         * @return mixed
         */
        public function getHomeLoss()
        {
            return $this->home_loss;
        }

        /**
         * @param mixed $home_loss
         */
        public function setHomeLoss($home_loss)
        {
            $this->home_loss = $home_loss;
        }

        /**
         * @return mixed
         */
        public function getRoadWin()
        {
            return $this->road_win;
        }

        /**
         * @param mixed $road_win
         */
        public function setRoadWin($road_win)
        {
            $this->road_win = $road_win;
        }

        /**
         * @return mixed
         */
        public function getRoadTie()
        {
            return $this->road_tie;
        }

        /**
         * @param mixed $road_tie
         */
        public function setRoadTie($road_tie)
        {
            $this->road_tie = $road_tie;
        }

        /**
         * @return mixed
         */
        public function getRoadLoss()
        {
            return $this->road_loss;
        }

        /**
         * @param mixed $road_loss
         */
        public function setRoadLoss($road_loss)
        {
            $this->road_loss = $road_loss;
        }

        /**
         * @return mixed
         */
        public function getDivWin()
        {
            return $this->div_win;
        }

        /**
         * @param mixed $div_win
         */
        public function setDivWin($div_win)
        {
            $this->div_win = $div_win;
        }

        /**
         * @return mixed
         */
        public function getDivTie()
        {
            return $this->div_tie;
        }

        /**
         * @param mixed $div_tie
         */
        public function setDivTie($div_tie)
        {
            $this->div_tie = $div_tie;
        }

        /**
         * @return mixed
         */
        public function getDivLoss()
        {
            return $this->div_loss;
        }

        /**
         * @param mixed $div_loss
         */
        public function setDivLoss($div_loss)
        {
            $this->div_loss = $div_loss;
        }

        /**
         * @return mixed
         */
        public function getConfWin()
        {
            return $this->conf_win;
        }

        /**
         * @param mixed $conf_win
         */
        public function setConfWin($conf_win)
        {
            $this->conf_win = $conf_win;
        }

        /**
         * @return mixed
         */
        public function getConfTie()
        {
            return $this->conf_tie;
        }

        /**
         * @param mixed $conf_tie
         */
        public function setConfTie($conf_tie)
        {
            $this->conf_tie = $conf_tie;
        }

        /**
         * @return mixed
         */
        public function getConfLoss()
        {
            return $this->conf_loss;
        }

        /**
         * @param mixed $conf_loss
         */
        public function setConfLoss($conf_loss)
        {
            $this->conf_loss = $conf_loss;
        }

        /**
         * @return mixed
         */
        public function getLast5Win()
        {
            return $this->last5_win;
        }

        /**
         * @param mixed $last5_win
         */
        public function setLast5Win($last5_win)
        {
            $this->last5_win = $last5_win;
        }

        /**
         * @return mixed
         */
        public function getLast5Tie()
        {
            return $this->last5_tie;
        }

        /**
         * @param mixed $last5_tie
         */
        public function setLast5Tie($last5_tie)
        {
            $this->last5_tie = $last5_tie;
        }

        /**
         * @return mixed
         */
        public function getLast5Loss()
        {
            return $this->last5_loss;
        }

        /**
         * @param mixed $last5_loss
         */
        public function setLast5Loss($last5_loss)
        {
            $this->last5_loss = $last5_loss;
        }

        /**
         * @return mixed
         */
        public function getStreak()
        {
            return $this->streak;
        }

        /**
         * @param mixed $streak
         */
        public function setStreak($streak)
        {
            $this->streak = $streak;
        }

        /**
         * @return mixed
         */
        public function getOpponents()
        {
            return $this->opponents;
        }

        /**
         * @param mixed $opponents
         */
        public function setOpponents($opponents)
        {
            $this->opponents = $opponents;
        }

        /**
         * @return mixed
         */
        public function getCommonOpponents()
        {
            return $this->common_opponents;
        }

        /**
         * @param mixed $common_opponents
         */
        public function setCommonOpponents($common_opponents)
        {
            $this->common_opponents = $common_opponents;
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
        public function getAdvancedSecondRound()
        {
            return $this->advanced_second_round;
        }

        /**
         * @param mixed $advanced_second_round
         */
        public function setAdvancedSecondRound($advanced_second_round)
        {
            $this->advanced_second_round = $advanced_second_round;
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
