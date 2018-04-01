<?php
    class Match {
        public $home_team_name;
        public $home_team_score;
        public $away_team_name;
        public $away_team_score;
        public $match_date;
        public $match_date_fmt;
        public $match_time;
        public $match_time_fmt;
        public $match_order;
        public $waiting_home_team;
        public $waiting_away_team;
        public $round;
        public $stage;
        public $tournament_id;
        public $group_name;
        public $home_team_seed;
        public $away_team_seed;
        public $home_set1_score;
        public $away_set1_score;
        public $home_set1_tiebreak;
        public $away_set1_tiebreak;
        public $home_set2_score;
        public $away_set2_score;
        public $home_set2_tiebreak;
        public $away_set2_tiebreak;
        public $home_set3_score;
        public $away_set3_score;
        public $home_set3_tiebreak;
        public $away_set3_tiebreak;
        public $home_set4_score;
        public $away_set4_score;
        public $home_set4_tiebreak;
        public $away_set4_tiebreak;
        public $home_set5_score;
        public $away_set5_score;
        public $home_set5_tiebreak;
        public $away_set5_tiebreak;
        public $home_flag;
        public $away_flag;
        public $home_alternative_flag;
        public $away_alternative_flag;
        function __construct($home_team_name, $away_team_name,
                             $match_date, $match_date_fmt, $match_time, $match_time_fmt, $match_order,
                             $round, $stage, $group_name,
                             $waiting_home_team = '', $waiting_away_team = '',
                             $home_team_seed = 0, $away_team_seed = 0,
                             $home_team_score = 0, $away_team_score = 0,
                             $home_set1_score = 0, $away_set1_score = 0, $home_set1_tiebreak = 0, $away_set1_tiebreak = 0,
                             $home_set2_score = 0, $away_set2_score = 0, $home_set2_tiebreak = 0, $away_set2_tiebreak = 0,
                             $home_set3_score = 0, $away_set3_score = 0, $home_set3_tiebreak = 0, $away_set3_tiebreak = 0,
                             $home_set4_score = 0, $away_set4_score = 0, $home_set4_tiebreak = 0, $away_set4_tiebreak = 0,
                             $home_set5_score = 0, $away_set5_score = 0, $home_set5_tiebreak = 0, $away_set5_tiebreak = 0,
                             $home_flag = '', $home_alternative_flag = '', $away_flag = '', $away_alternative_flag = '') {
            $this -> home_team_name = $home_team_name;
            $this -> home_team_score = $home_team_score;
            $this -> away_team_name = $away_team_name;
            $this -> away_team_score = $away_team_score;
            $this -> match_date = $match_date;
            $this -> match_date_fmt = $match_date_fmt;
            $this -> match_time = $match_time;
            $this -> match_time_fmt = $match_time_fmt;
            $this -> match_order = $match_order;
            $this -> round = $round;
            $this -> stage = $stage;
            $this -> group_name = $group_name;
            $this -> waiting_home_team = $waiting_home_team;
            $this -> waiting_away_team = $waiting_away_team;
            $this -> home_team_seed = $home_team_seed;
            $this -> away_team_seed = $away_team_seed;
            $this -> home_set1_score = $home_set1_score;
            $this -> away_set1_score = $away_set1_score;
            $this -> home_set1_tiebreak = $home_set1_tiebreak;
            $this -> away_set1_tiebreak = $away_set1_tiebreak;
            $this -> home_set2_score = $home_set2_score;
            $this -> away_set2_score = $away_set2_score;
            $this -> home_set2_tiebreak = $home_set2_tiebreak;
            $this -> away_set2_tiebreak = $away_set2_tiebreak;
            $this -> home_set3_score = $home_set3_score;
            $this -> away_set3_score = $away_set3_score;
            $this -> home_set3_tiebreak = $home_set3_tiebreak;
            $this -> away_set3_tiebreak = $away_set3_tiebreak;
            $this -> home_set4_score = $home_set4_score;
            $this -> away_set4_score = $away_set4_score;
            $this -> home_set4_tiebreak = $home_set4_tiebreak;
            $this -> away_set4_tiebreak = $away_set4_tiebreak;
            $this -> home_set5_score = $home_set5_score;
            $this -> away_set5_score = $away_set5_score;
            $this -> home_set5_tiebreak = $home_set5_tiebreak;
            $this -> away_set5_tiebreak = $away_set5_tiebreak;
            $this -> home_flag = $home_flag;
            $this -> away_flag = $away_flag;
            $this -> home_alternative_flag = $home_alternative_flag;
            $this -> away_alternative_flag = $away_alternative_flag;
        }
    }
