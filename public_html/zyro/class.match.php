<?php
    include_once('config.php');

    class Match {
        private $home_team_id;
        private $home_team_name;
        private $home_team_code;
        private $home_team_score;
        private $home_team_extra_time_score;
        private $home_team_penalty_score;
        private $home_team_replay_score;
        private $home_parent_team_id;
        private $home_parent_team_name;
        private $away_team_id;
        private $away_team_name;
        private $away_team_code;
        private $away_team_score;
        private $away_team_extra_time_score;
        private $away_team_penalty_score;
        private $away_team_replay_score;
        private $away_parent_team_id;
        private $away_parent_team_name;
        private $match_date;
        private $match_date_fmt;
        private $match_time;
        private $match_time_fmt;
        private $match_order;
        private $bracket_order;
        private $waiting_home_team;
        private $waiting_away_team;
        private $round;
        private $stage;
        private $tournament_id;
        private $tournament_name;
        private $points_for_win;
        private $golden_goal_rule;
        private $group_name;
        private $parent_group_name;
        private $second_round_group_name;
        private $home_team_seed;
        private $away_team_seed;
        private $home_set1_score;
        private $away_set1_score;
        private $home_set1_tiebreak;
        private $away_set1_tiebreak;
        private $home_set2_score;
        private $away_set2_score;
        private $home_set2_tiebreak;
        private $away_set2_tiebreak;
        private $home_set3_score;
        private $away_set3_score;
        private $home_set3_tiebreak;
        private $away_set3_tiebreak;
        private $home_set4_score;
        private $away_set4_score;
        private $home_set4_tiebreak;
        private $away_set4_tiebreak;
        private $home_set5_score;
        private $away_set5_score;
        private $home_set5_tiebreak;
        private $away_set5_tiebreak;
        private $home_flag;
        private $away_flag;
        private $home_alternative_flag;
        private $away_alternative_flag;
        private $home_logo;
        private $away_logo;

        protected function __construct(){ }

        public static function CreateSoccerMatch(
            $home_team_id, $home_team_name, $home_team_code, $away_team_id, $away_team_name, $away_team_code,
            $home_parent_team_id, $home_parent_team_name, $away_parent_team_id, $away_parent_team_name,
            $match_date, $match_date_fmt, $match_time, $match_time_fmt,
            $match_order, $bracket_order, $round, $stage, $group_name, $parent_group_name, $second_round_group_name,
            $tournament_id, $tournament_name, $points_for_win, $golden_goal_rule,
            $waiting_home_team, $waiting_away_team,
            $home_team_score, $away_team_score,
            $home_team_extra_time_score, $away_team_extra_time_score,
            $home_team_penalty_score, $away_team_penalty_score,
            $home_flag, $away_flag, $home_logo, $away_logo)
        {
            $m = new Match();
            $m->home_team_id = $home_team_id;
            $m->home_team_name = $home_team_name;
            $m->home_team_code = $home_team_code;
            $m->away_team_id = $away_team_id;
            $m->away_team_name = $away_team_name;
            $m->away_team_code = $away_team_code;
            $m->home_team_score = $home_team_score;
            $m->away_team_score = $away_team_score;
            $m->home_team_extra_time_score = $home_team_extra_time_score;
            $m->away_team_extra_time_score = $away_team_extra_time_score;
            $m->home_team_penalty_score = $home_team_penalty_score;
            $m->away_team_penalty_score = $away_team_penalty_score;
            $m->home_parent_team_id = $home_parent_team_id;
            $m->home_parent_team_name = $home_parent_team_name;
            $m->away_parent_team_id = $away_parent_team_id;
            $m->away_parent_team_name = $away_parent_team_name;
            $m->match_date = $match_date;
            $m->match_date_fmt = $match_date_fmt;
            $m->match_time = $match_time;
            $m->match_time_fmt = $match_time_fmt;
            $m->match_order = $match_order;
            $m->bracket_order = $bracket_order;
            $m->round = $round;
            $m->stage = $stage;
            $m->group_name = $group_name;
            $m->parent_group_name = $parent_group_name;
            $m->second_round_group_name = $second_round_group_name;
            $m->tournament_id = $tournament_id;
            $m->tournament_name = $tournament_name;
            $m->points_for_win = $points_for_win;
            $m->golden_goal_rule = $golden_goal_rule;
            $m->waiting_home_team = $waiting_home_team;
            $m->waiting_away_team = $waiting_away_team;
            $m->home_flag = $home_flag;
            $m->away_flag = $away_flag;
            $m->home_logo = $home_logo;
            $m->away_logo = $away_logo;
            return $m;
        }

        public static function CloneSoccerMatch(
            $home_team_id, $home_team_name, $home_team_code, $away_team_id, $away_team_name, $away_team_code,
            $home_team_score, $away_team_score)
        {
            return self::CreateSoccerMatch(
                $home_team_id, $home_team_name, $home_team_code, $away_team_id, $away_team_name, $away_team_code,
                0, '', 0, '',
                '', '', '', '',
                0, 0, '', '',
                '', '', '',
                0, '', 0,'',
                '', '',
                $home_team_score, $away_team_score,
                0, 0,
                0, 0,
                '', '', '', '');
        }

        public static function CreateTennisMatch(
            $home_team_name, $away_team_name,
            $match_date, $match_order, $round, $home_team_seed, $away_team_seed,
            $home_set1_score, $away_set1_score, $home_set1_tiebreak, $away_set1_tiebreak,
            $home_set2_score, $away_set2_score, $home_set2_tiebreak, $away_set2_tiebreak,
            $home_set3_score, $away_set3_score, $home_set3_tiebreak, $away_set3_tiebreak,
            $home_set4_score, $away_set4_score, $home_set4_tiebreak, $away_set4_tiebreak,
            $home_set5_score, $away_set5_score, $home_set5_tiebreak, $away_set5_tiebreak,
            $home_flag, $home_alternative_flag, $away_flag, $away_alternative_flag)
        {
            $m = new Match();
            $m->home_team_name = $home_team_name;
            $m->away_team_name = $away_team_name;
            $m->match_date = $match_date;
            $m->match_order = $match_order;
            $m->round = $round;
            $m->home_team_seed = $home_team_seed;
            $m->away_team_seed = $away_team_seed;
            $m->home_set1_score = $home_set1_score;
            $m->away_set1_score = $away_set1_score;
            $m->home_set1_tiebreak = $home_set1_tiebreak;
            $m->away_set1_tiebreak = $away_set1_tiebreak;
            $m->home_set2_score = $home_set2_score;
            $m->away_set2_score = $away_set2_score;
            $m->home_set2_tiebreak = $home_set2_tiebreak;
            $m->away_set2_tiebreak = $away_set2_tiebreak;
            $m->home_set3_score = $home_set3_score;
            $m->away_set3_score = $away_set3_score;
            $m->home_set3_tiebreak = $home_set3_tiebreak;
            $m->away_set3_tiebreak = $away_set3_tiebreak;
            $m->home_set4_score = $home_set4_score;
            $m->away_set4_score = $away_set4_score;
            $m->home_set4_tiebreak = $home_set4_tiebreak;
            $m->away_set4_tiebreak = $away_set4_tiebreak;
            $m->home_set5_score = $home_set5_score;
            $m->away_set5_score = $away_set5_score;
            $m->home_set5_tiebreak = $home_set5_tiebreak;
            $m->away_set5_tiebreak = $away_set5_tiebreak;
            $m->home_flag = $home_flag;
            $m->away_flag = $away_flag;
            $m->home_alternative_flag = $home_alternative_flag;
            $m->away_alternative_flag = $away_alternative_flag;
            return $m;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamId()
        {
            return $this->home_team_id;
        }

        /**
         * @param mixed $home_team_id
         */
        public function setHomeTeamId($home_team_id)
        {
            $this->home_team_id = $home_team_id;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamName()
        {
            return $this->home_team_name;
        }

        /**
         * @param mixed $home_team_name
         */
        public function setHomeTeamName($home_team_name)
        {
            $this->home_team_name = $home_team_name;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamCode()
        {
            return $this->home_team_code;
        }

        /**
         * @param mixed $home_team_code
         */
        public function setHomeTeamCode($home_team_code)
        {
            $this->home_team_code = $home_team_code;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamScore()
        {
            return $this->home_team_score;
        }

        /**
         * @param mixed $home_team_score
         */
        public function setHomeTeamScore($home_team_score)
        {
            $this->home_team_score = $home_team_score;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamExtraTimeScore()
        {
            return $this->home_team_extra_time_score;
        }

        /**
         * @param mixed $home_team_extra_time_score
         */
        public function setHomeTeamExtraTimeScore($home_team_extra_time_score)
        {
            $this->home_team_extra_time_score = $home_team_extra_time_score;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamPenaltyScore()
        {
            return $this->home_team_penalty_score;
        }

        /**
         * @param mixed $home_team_penalty_score
         */
        public function setHomeTeamPenaltyScore($home_team_penalty_score)
        {
            $this->home_team_penalty_score = $home_team_penalty_score;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamReplayScore()
        {
            return $this->home_team_replay_score;
        }

        /**
         * @param mixed $home_team_replay_score
         */
        public function setHomeTeamReplayScore($home_team_replay_score)
        {
            $this->home_team_replay_score = $home_team_replay_score;
        }

        /**
         * @return mixed
         */
        public function getHomeParentTeamId()
        {
            return $this->home_parent_team_id;
        }

        /**
         * @param mixed $home_parent_team_id
         */
        public function setHomeParentTeamId($home_parent_team_id)
        {
            $this->home_parent_team_id = $home_parent_team_id;
        }

        /**
         * @return mixed
         */
        public function getHomeParentTeamName()
        {
            return $this->home_parent_team_name;
        }

        /**
         * @param mixed $home_parent_team_name
         */
        public function setHomeParentTeamName($home_parent_team_name)
        {
            $this->home_parent_team_name = $home_parent_team_name;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamId()
        {
            return $this->away_team_id;
        }

        /**
         * @param mixed $away_team_id
         */
        public function setAwayTeamId($away_team_id)
        {
            $this->away_team_id = $away_team_id;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamName()
        {
            return $this->away_team_name;
        }

        /**
         * @param mixed $away_team_name
         */
        public function setAwayTeamName($away_team_name)
        {
            $this->away_team_name = $away_team_name;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamCode()
        {
            return $this->away_team_code;
        }

        /**
         * @param mixed $away_team_code
         */
        public function setAwayTeamCode($away_team_code)
        {
            $this->away_team_code = $away_team_code;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamScore()
        {
            return $this->away_team_score;
        }

        /**
         * @param mixed $away_team_score
         */
        public function setAwayTeamScore($away_team_score)
        {
            $this->away_team_score = $away_team_score;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamExtraTimeScore()
        {
            return $this->away_team_extra_time_score;
        }

        /**
         * @param mixed $away_team_extra_time_score
         */
        public function setAwayTeamExtraTimeScore($away_team_extra_time_score)
        {
            $this->away_team_extra_time_score = $away_team_extra_time_score;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamPenaltyScore()
        {
            return $this->away_team_penalty_score;
        }

        /**
         * @param mixed $away_team_penalty_score
         */
        public function setAwayTeamPenaltyScore($away_team_penalty_score)
        {
            $this->away_team_penalty_score = $away_team_penalty_score;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamReplayScore()
        {
            return $this->away_team_replay_score;
        }

        /**
         * @param mixed $away_team_replay_score
         */
        public function setAwayTeamReplayScore($away_team_replay_score)
        {
            $this->away_team_replay_score = $away_team_replay_score;
        }

        /**
         * @return mixed
         */
        public function getAwayParentTeamId()
        {
            return $this->away_parent_team_id;
        }

        /**
         * @param mixed $away_parent_team_id
         */
        public function setAwayParentTeamId($away_parent_team_id)
        {
            $this->away_parent_team_id = $away_parent_team_id;
        }

        /**
         * @return mixed
         */
        public function getAwayParentTeamName()
        {
            return $this->away_parent_team_name;
        }

        /**
         * @param mixed $away_parent_team_name
         */
        public function setAwayParentTeamName($away_parent_team_name)
        {
            $this->away_parent_team_name = $away_parent_team_name;
        }

        /**
         * @return mixed
         */
        public function getMatchDate()
        {
            return $this->match_date;
        }

        /**
         * @param mixed $match_date
         */
        public function setMatchDate($match_date)
        {
            $this->match_date = $match_date;
        }

        /**
         * @return mixed
         */
        public function getMatchDateFmt()
        {
            return $this->match_date_fmt;
        }

        /**
         * @param mixed $match_date_fmt
         */
        public function setMatchDateFmt($match_date_fmt)
        {
            $this->match_date_fmt = $match_date_fmt;
        }

        /**
         * @return mixed
         */
        public function getMatchTime()
        {
            return $this->match_time;
        }

        /**
         * @param mixed $match_time
         */
        public function setMatchTime($match_time)
        {
            $this->match_time = $match_time;
        }

        /**
         * @return mixed
         */
        public function getMatchTimeFmt()
        {
            return $this->match_time_fmt;
        }

        /**
         * @param mixed $match_time_fmt
         */
        public function setMatchTimeFmt($match_time_fmt)
        {
            $this->match_time_fmt = $match_time_fmt;
        }

        /**
         * @return mixed
         */
        public function getMatchOrder()
        {
            return $this->match_order;
        }

        /**
         * @param mixed $match_order
         */
        public function setMatchOrder($match_order)
        {
            $this->match_order = $match_order;
        }

        /**
         * @return mixed
         */
        public function getBracketOrder()
        {
            return $this->bracket_order;
        }

        /**
         * @param mixed $bracket_order
         */
        public function setBracketOrder($bracket_order)
        {
            $this->bracket_order = $bracket_order;
        }

        /**
         * @return mixed
         */
        public function getWaitingHomeTeam()
        {
            return $this->waiting_home_team;
        }

        /**
         * @param mixed $waiting_home_team
         */
        public function setWaitingHomeTeam($waiting_home_team)
        {
            $this->waiting_home_team = $waiting_home_team;
        }

        /**
         * @return mixed
         */
        public function getWaitingAwayTeam()
        {
            return $this->waiting_away_team;
        }

        /**
         * @param mixed $waiting_away_team
         */
        public function setWaitingAwayTeam($waiting_away_team)
        {
            $this->waiting_away_team = $waiting_away_team;
        }

        /**
         * @return mixed
         */
        public function getRound()
        {
            return $this->round;
        }

        /**
         * @param mixed $round
         */
        public function setRound($round)
        {
            $this->round = $round;
        }

        /**
         * @return mixed
         */
        public function getStage()
        {
            return $this->stage;
        }

        /**
         * @param mixed $stage
         */
        public function setStage($stage)
        {
            $this->stage = $stage;
        }

        /**
         * @return mixed
         */
        public function getTournamentId()
        {
            return $this->tournament_id;
        }

        /**
         * @param mixed $tournament_id
         */
        public function setTournamentId($tournament_id)
        {
            $this->tournament_id = $tournament_id;
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
        public function getPointsForWin()
        {
            return $this->points_for_win;
        }

        /**
         * @param mixed $points_for_win
         */
        public function setPointsForWin($points_for_win)
        {
            $this->points_for_win = $points_for_win;
        }

        /**
         * @return mixed
         */
        public function getGoldenGoalRule()
        {
            return $this->golden_goal_rule;
        }

        /**
         * @param mixed $golden_goal_rule
         */
        public function setGoldenGoalRule($golden_goal_rule)
        {
            $this->golden_goal_rule = $golden_goal_rule;
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
        public function getSecondRoundGroupName()
        {
            return $this->second_round_group_name;
        }

        /**
         * @param mixed $second_round_group_name
         */
        public function setSecondRoundGroupName($second_round_group_name)
        {
            $this->second_round_group_name = $second_round_group_name;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamSeed()
        {
            return $this->home_team_seed;
        }

        /**
         * @param mixed $home_team_seed
         */
        public function setHomeTeamSeed($home_team_seed)
        {
            $this->home_team_seed = $home_team_seed;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamSeed()
        {
            return $this->away_team_seed;
        }

        /**
         * @param mixed $away_team_seed
         */
        public function setAwayTeamSeed($away_team_seed)
        {
            $this->away_team_seed = $away_team_seed;
        }

        /**
         * @return mixed
         */
        public function getHomeSet1Score()
        {
            return $this->home_set1_score;
        }

        /**
         * @param mixed $home_set1_score
         */
        public function setHomeSet1Score($home_set1_score)
        {
            $this->home_set1_score = $home_set1_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet1Score()
        {
            return $this->away_set1_score;
        }

        /**
         * @param mixed $away_set1_score
         */
        public function setAwaySet1Score($away_set1_score)
        {
            $this->away_set1_score = $away_set1_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet1Tiebreak()
        {
            return $this->home_set1_tiebreak;
        }

        /**
         * @param mixed $home_set1_tiebreak
         */
        public function setHomeSet1Tiebreak($home_set1_tiebreak)
        {
            $this->home_set1_tiebreak = $home_set1_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet1Tiebreak()
        {
            return $this->away_set1_tiebreak;
        }

        /**
         * @param mixed $away_set1_tiebreak
         */
        public function setAwaySet1Tiebreak($away_set1_tiebreak)
        {
            $this->away_set1_tiebreak = $away_set1_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeSet2Score()
        {
            return $this->home_set2_score;
        }

        /**
         * @param mixed $home_set2_score
         */
        public function setHomeSet2Score($home_set2_score)
        {
            $this->home_set2_score = $home_set2_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet2Score()
        {
            return $this->away_set2_score;
        }

        /**
         * @param mixed $away_set2_score
         */
        public function setAwaySet2Score($away_set2_score)
        {
            $this->away_set2_score = $away_set2_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet2Tiebreak()
        {
            return $this->home_set2_tiebreak;
        }

        /**
         * @param mixed $home_set2_tiebreak
         */
        public function setHomeSet2Tiebreak($home_set2_tiebreak)
        {
            $this->home_set2_tiebreak = $home_set2_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet2Tiebreak()
        {
            return $this->away_set2_tiebreak;
        }

        /**
         * @param mixed $away_set2_tiebreak
         */
        public function setAwaySet2Tiebreak($away_set2_tiebreak)
        {
            $this->away_set2_tiebreak = $away_set2_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeSet3Score()
        {
            return $this->home_set3_score;
        }

        /**
         * @param mixed $home_set3_score
         */
        public function setHomeSet3Score($home_set3_score)
        {
            $this->home_set3_score = $home_set3_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet3Score()
        {
            return $this->away_set3_score;
        }

        /**
         * @param mixed $away_set3_score
         */
        public function setAwaySet3Score($away_set3_score)
        {
            $this->away_set3_score = $away_set3_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet3Tiebreak()
        {
            return $this->home_set3_tiebreak;
        }

        /**
         * @param mixed $home_set3_tiebreak
         */
        public function setHomeSet3Tiebreak($home_set3_tiebreak)
        {
            $this->home_set3_tiebreak = $home_set3_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet3Tiebreak()
        {
            return $this->away_set3_tiebreak;
        }

        /**
         * @param mixed $away_set3_tiebreak
         */
        public function setAwaySet3Tiebreak($away_set3_tiebreak)
        {
            $this->away_set3_tiebreak = $away_set3_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeSet4Score()
        {
            return $this->home_set4_score;
        }

        /**
         * @param mixed $home_set4_score
         */
        public function setHomeSet4Score($home_set4_score)
        {
            $this->home_set4_score = $home_set4_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet4Score()
        {
            return $this->away_set4_score;
        }

        /**
         * @param mixed $away_set4_score
         */
        public function setAwaySet4Score($away_set4_score)
        {
            $this->away_set4_score = $away_set4_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet4Tiebreak()
        {
            return $this->home_set4_tiebreak;
        }

        /**
         * @param mixed $home_set4_tiebreak
         */
        public function setHomeSet4Tiebreak($home_set4_tiebreak)
        {
            $this->home_set4_tiebreak = $home_set4_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet4Tiebreak()
        {
            return $this->away_set4_tiebreak;
        }

        /**
         * @param mixed $away_set4_tiebreak
         */
        public function setAwaySet4Tiebreak($away_set4_tiebreak)
        {
            $this->away_set4_tiebreak = $away_set4_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeSet5Score()
        {
            return $this->home_set5_score;
        }

        /**
         * @param mixed $home_set5_score
         */
        public function setHomeSet5Score($home_set5_score)
        {
            $this->home_set5_score = $home_set5_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet5Score()
        {
            return $this->away_set5_score;
        }

        /**
         * @param mixed $away_set5_score
         */
        public function setAwaySet5Score($away_set5_score)
        {
            $this->away_set5_score = $away_set5_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet5Tiebreak()
        {
            return $this->home_set5_tiebreak;
        }

        /**
         * @param mixed $home_set5_tiebreak
         */
        public function setHomeSet5Tiebreak($home_set5_tiebreak)
        {
            $this->home_set5_tiebreak = $home_set5_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet5Tiebreak()
        {
            return $this->away_set5_tiebreak;
        }

        /**
         * @param mixed $away_set5_tiebreak
         */
        public function setAwaySet5Tiebreak($away_set5_tiebreak)
        {
            $this->away_set5_tiebreak = $away_set5_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeFlag()
        {
            return $this->home_flag;
        }

        /**
         * @param mixed $home_flag
         */
        public function setHomeFlag($home_flag)
        {
            $this->home_flag = $home_flag;
        }

        /**
         * @return mixed
         */
        public function getAwayFlag()
        {
            return $this->away_flag;
        }

        /**
         * @param mixed $away_flag
         */
        public function setAwayFlag($away_flag)
        {
            $this->away_flag = $away_flag;
        }

        /**
         * @return mixed
         */
        public function getHomeAlternativeFlag()
        {
            return $this->home_alternative_flag;
        }

        /**
         * @param mixed $home_alternative_flag
         */
        public function setHomeAlternativeFlag($home_alternative_flag)
        {
            $this->home_alternative_flag = $home_alternative_flag;
        }

        /**
         * @return mixed
         */
        public function getAwayAlternativeFlag()
        {
            return $this->away_alternative_flag;
        }

        /**
         * @param mixed $away_alternative_flag
         */
        public function setAwayAlternativeFlag($away_alternative_flag)
        {
            $this->away_alternative_flag = $away_alternative_flag;
        }

        /**
         * @return mixed
         */
        public function getHomeLogo()
        {
            return $this->home_logo;
        }

        /**
         * @param mixed $home_logo
         */
        public function setHomeLogo($home_logo)
        {
            $this->home_logo = $home_logo;
        }

        /**
         * @return mixed
         */
        public function getAwayLogo()
        {
            return $this->away_logo;
        }

        /**
         * @param mixed $away_logo
         */
        public function setAwayLogo($away_logo)
        {
            $this->away_logo = $away_logo;
        }
    }
