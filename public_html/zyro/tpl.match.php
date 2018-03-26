<?php
    class Match {
        public $home_team_name;
        public $home_team_score;
        public $away_team_name;
        public $away_team_score;
        public $match_date;
        public $match_date_fmt;
        public $match_time;
        public $match_order;
        public $round;
        public $stage;
        public $tournament_id;
        public $group_name;
        function __construct($home_team_name, $away_team_name,
                             $match_date, $match_date_fmt, $match_time, $match_order,
                             $round, $stage, $group_name,
                             $home_team_score = 0, $away_team_score = 0) {
            $this -> home_team_name = $home_team_name;
            $this -> home_team_score = $home_team_score;
            $this -> away_team_name = $away_team_name;
            $this -> away_team_score = $away_team_score;
            $this -> match_date = $match_date;
            $this -> match_date_fmt = $match_date_fmt;
            $this -> match_time = $match_time;
            $this -> match_order = $match_order;
            $this -> round = $round;
            $this -> stage = $stage;
            $this -> group_name = $group_name;
        }
    }