<?php
    include_once('config.php');
    class Match{
        private $home_team_name;
        private $home_team_score;
        private $away_team_name;
        private $away_team_score;
        private $match_date;
        private $match_date_fmt;
        private $match_time;
        private $match_time_fmt;
        private $match_order;
        private $waiting_home_team;
        private $waiting_away_team;
        private $round;
        private $stage;
        private $tournament_id;
        private $group_name;
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

        protected function __construct(){ }

        public static function CreateSoccerMatch(
            $home_team_name, $away_team_name,
            $match_date, $match_date_fmt, $match_time, $match_time_fmt,
            $match_order, $round, $stage, $group_name,
            $waiting_home_team, $waiting_away_team,
            $home_team_score, $away_team_score,
            $home_flag, $away_flag)
        {
            $m = new Match();
            $m->home_team_name = $home_team_name;
            $m->away_team_name = $away_team_name;
            $m->home_team_score = $home_team_score;
            $m->away_team_score = $away_team_score;
            $m->match_date = $match_date;
            $m->match_date_fmt = $match_date_fmt;
            $m->match_time = $match_time;
            $m->match_time_fmt = $match_time_fmt;
            $m->match_order = $match_order;
            $m->round = $round;
            $m->stage = $stage;
            $m->group_name = $group_name;
            $m->waiting_home_team = $waiting_home_team;
            $m->waiting_away_team = $waiting_away_team;
            $m->home_flag = $home_flag;
            $m->away_flag = $away_flag;
            return $m;
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

        public static function getSoccerMatches($tournament_id) {

            $sql = Match::getSoccerMatchSql($tournament_id);

            return self::getSoccerMatchDTO($sql);
        }

        public static function getSoccerSecondStageMatches($tournament_id, $stage_id) {

            $sql = Match::getSoccerSecondStageMatchSql($tournament_id, $stage_id);

            return self::getSoccerMatchDTO($sql);
        }

        public static function getTennisMatches($tournament_id) {

            $sql = Match::getTennisMatchSql($tournament_id);

            return self::getTennisMatchDTO($sql);
        }

        public static function getSoccerMatchDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $matches = array();
            $bracket_matches = array();
            $group_matches = array();
            $second_stage_matches = array();

            if ($count == 0) {
                return MatchDTO::CreateSoccerMatchDTO(null, null, null, null, $count);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $home_team_score = $row['home_team_score'];
                    if ($row['home_team_score'] == null) $home_team_score = mt_rand(0,10);
                    $away_team_score = $row['away_team_score'];
                    if ($row['away_team_score'] == null) $away_team_score = mt_rand(0,10);
                    $match = Match::CreateSoccerMatch($row['home_team_name'], $row['away_team_name'],
                        $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'],
                        $row['match_order'], $row['round'], $row['stage'], $row['group_name'], $row['waiting_home_team'], $row['waiting_away_team'],
                        $home_team_score, $away_team_score, $row['home_flag'], $row['away_flag']);
                    $matches[$row['round']][$row['match_date']][$row['match_order']] = $match;
                    if ($row['round'] != 'Group Matches') $bracket_matches[$row['round']][$row['match_order']] = $match;
                    $group_matches[$row['group_name']][$row['match_order']] = $match;
                    $second_stage_matches[$row['round']][$row['match_order']] = $match;
                }
                return MatchDTO::CreateSoccerMatchDTO($matches, $bracket_matches, $group_matches, $second_stage_matches, $count);
            }
        }

        public static function getTennisMatchDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $matches = array();

            if ($count == 0) {
                return MatchDTO::CreateTennisMatchDTO(null, $count);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $match = Match::CreateTennisMatch($row['home_team_name'], $row['away_team_name'],
                        $row['match_date'], $row['match_order'], $row['round'],
                        $row['home_team_seed'], $row['away_team_seed'],
                        $row['home_set1_score'], $row['away_set1_score'], $row['home_set1_tiebreak'], $row['away_set1_tiebreak'],
                        $row['home_set2_score'], $row['away_set2_score'], $row['home_set2_tiebreak'], $row['away_set2_tiebreak'],
                        $row['home_set3_score'], $row['away_set3_score'], $row['home_set3_tiebreak'], $row['away_set3_tiebreak'],
                        $row['home_set4_score'], $row['away_set4_score'], $row['home_set4_tiebreak'], $row['away_set4_tiebreak'],
                        $row['home_set5_score'], $row['away_set5_score'], $row['home_set5_tiebreak'], $row['away_set5_tiebreak'],
                        $row['home_flag_filename'], $row['home_alternative_flag_filename'], $row['away_flag_filename'], $row['away_alternative_flag_filename']);
                    $matches[$row['round']][$row['match_order']] = $match;
                }
                return MatchDTO::CreateTennisMatchDTO($matches, $count);
            }
        }

        public static function getSoccerMatchSql($tournament_id) {
            $sql = 'SELECT t.name AS home_team_name, home_team_score, n.flag_filename AS home_flag, 
                    t2.name AS away_team_name, away_team_score, n2.flag_filename AS away_flag, 
                    DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
                    TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, match_order,
                    waiting_home_team, waiting_away_team,
                    g.name AS round, g2.name AS stage,
                    g3.name AS group_name, m.tournament_id
                FROM `match` m
                    LEFT JOIN team t ON t.id = m.home_team_id
                    LEFT JOIN team t2 ON t2.id = m.away_team_id
                    LEFT JOIN `group` g ON g.id = m.round_id
                    LEFT JOIN `group` g2 ON g2.id = m.stage_id
                    LEFT JOIN team_tournament tt ON tt.team_id = m.home_team_id
                    LEFT JOIN `group` g3 ON g3.id = tt.group_id 
                    LEFT JOIN nation n ON n.id = t.nation_id  
                    LEFT JOIN nation n2 ON n2.id = t2.nation_id 
                WHERE m.tournament_id = '.$tournament_id.'
                ORDER BY stage_id, round_id, match_date, match_time;';
            return $sql;
        }

        public static function getSoccerSecondStageMatchSql($tournament_id, $stage_id) {
            $sql = 'SELECT t.name AS home_team_name, home_team_score, n.flag_filename AS home_flag,
                t2.name AS away_team_name, away_team_score, n2.flag_filename AS away_flag,
                DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date,
                TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, match_order,
                waiting_home_team, waiting_away_team,
                g.name AS round, g2.name AS stage,
                g3.name AS group_name, m.tournament_id
            FROM `match` m
                LEFT JOIN team t ON t.id = m.home_team_id
                LEFT JOIN team t2 ON t2.id = m.away_team_id
                LEFT JOIN `group` g ON g.id = m.round_id
                LEFT JOIN `group` g2 ON g2.id = m.stage_id
                LEFT JOIN team_tournament tt ON tt.team_id = m.home_team_id
                LEFT JOIN `group` g3 ON g3.id = tt.group_id
                LEFT JOIN nation n ON n.id = t.nation_id
                LEFT JOIN nation n2 ON n2.id = t2.nation_id
            WHERE m.tournament_id = '.$tournament_id.' AND m.stage_id = '.$stage_id.'
            ORDER BY match_order;';
            return $sql;
        }

        public static function getTennisMatchSql($tournament_id) {
            $sql = 'SELECT t.id AS home_id, t.name AS home_team_name, htt.seed AS home_team_seed, 
                n.flag_filename AS home_flag_filename, n.alternative_flag_filename AS home_alternative_flag_filename,
                t2.id AS away_id, t2.name AS away_team_name, att.seed AS away_team_seed, 
                n2.flag_filename AS away_flag_filename, n2.alternative_flag_filename AS away_alternative_flag_filename,
                home_set1_score, away_set1_score, home_set1_tiebreak, away_set1_tiebreak,
                home_set2_score, away_set2_score, home_set2_tiebreak, away_set2_tiebreak,
                home_set3_score, away_set3_score, home_set3_tiebreak, away_set3_tiebreak,
                home_set4_score, away_set4_score, home_set4_tiebreak, away_set4_tiebreak,
                home_set5_score, away_set5_score, home_set5_tiebreak, away_set5_tiebreak,
                match_date, match_order,
                g.name AS round,
                m.tournament_id
            FROM `match` m
                LEFT JOIN team t ON t.id = m.home_team_id
                LEFT JOIN team t2 ON t2.id = m.away_team_id
                LEFT JOIN `group` g ON g.id = m.round_id
                LEFT JOIN team_tournament htt ON (htt.team_id = m.home_team_id AND htt.tournament_id = m.tournament_id)
                LEFT JOIN team_tournament att ON (att.team_id = m.away_team_id AND att.tournament_id = m.tournament_id)  
                LEFT JOIN team_player tp ON tp.team_id = t.id  
                LEFT JOIN player p ON p.id = tp.player_id 
                LEFT JOIN nation n ON n.id = p.nation_id  
                LEFT JOIN team_player tp2 ON tp2.team_id = t2.id  
                LEFT JOIN player p2 ON p2.id = tp2.player_id 
                LEFT JOIN nation n2 ON n2.id = p2.nation_id 
            WHERE m.tournament_id = '.$tournament_id.'
            ORDER BY match_order;';
            return $sql;
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
    }

    class MatchDTO {
        private $matches;
        private $bracket_matches;
        private $group_matches;
        private $second_stage_matches;
        private $count;

        protected function __construct(){ }

        public static function CreateSoccerMatchDTO($matches, $bracket_matches, $group_matches, $second_stage_matches, $count) {
            $match_dto = new MatchDTO();
            $match_dto->matches = $matches;
            $match_dto->bracket_matches = $bracket_matches;
            $match_dto->group_matches = $group_matches;
            $match_dto->second_stage_matches = $second_stage_matches;
            $match_dto->count = $count;
            return $match_dto;
        }

        public static function CreateTennisMatchDTO($matches, $count) {
            $match_dto = new MatchDTO();
            $match_dto->matches = $matches;
            $match_dto->count = $count;
            return $match_dto;
        }

        /**
         * @return mixed
         */
        public function getMatches()
        {
            return $this->matches;
        }

        /**
         * @param mixed $matches
         */
        public function setMatches($matches)
        {
            $this->matches = $matches;
        }

        /**
         * @return mixed
         */
        public function getBracketMatches()
        {
            return $this->bracket_matches;
        }

        /**
         * @param mixed $bracket_matches
         */
        public function setBracketMatches($bracket_matches)
        {
            $this->bracket_matches = $bracket_matches;
        }

        /**
         * @return mixed
         */
        public function getGroupMatches()
        {
            return $this->group_matches;
        }

        /**
         * @param mixed $group_matches
         */
        public function setGroupMatches($group_matches)
        {
            $this->group_matches = $group_matches;
        }

        /**
         * @return mixed
         */
        public function getSecondStageMatches()
        {
            return $this->second_stage_matches;
        }

        /**
         * @param mixed $second_stage_matches
         */
        public function setSecondStageMatches($second_stage_matches)
        {
            $this->second_stage_matches = $second_stage_matches;
        }

        /**
         * @return mixed
         */
        public function getCount()
        {
            return $this->count;
        }

        /**
         * @param mixed $count
         */
        public function setCount($count)
        {
            $this->count = $count;
        }
    }
