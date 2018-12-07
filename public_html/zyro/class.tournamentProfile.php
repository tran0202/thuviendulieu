<?php

    class TournamentProfile {

        private $id;
        private $name;
        private $logo_filename;
        private $start_date;
        private $end_date;
        private $tournament_type_id;
        private $parent_tournament_id;
        private $points_for_win;
        private $golden_goal_rule;
        private $head_to_head_tiebreaker;
        private $third_place_ranking;

        protected function __construct() { }

        public static function CreateTournamentProfile($id, $name, $logo_filename, $start_date, $end_date,
            $tournament_type_id, $parent_tournament_id, $points_for_win, $golden_goal_rule, $head_to_head_tiebreaker,
                                                       $third_place_ranking)
        {
            $tp = new TournamentProfile();
            $tp->id = $id;
            $tp->name = $name;
            $tp->logo_filename = $logo_filename;
            $tp->start_date = $start_date;
            $tp->end_date = $end_date;
            $tp->tournament_type_id = $tournament_type_id;
            $tp->parent_tournament_id = $parent_tournament_id;
            $tp->points_for_win = $points_for_win;
            $tp->golden_goal_rule = $golden_goal_rule;
            $tp->head_to_head_tiebreaker = $head_to_head_tiebreaker;
            $tp->third_place_ranking = $third_place_ranking;
            return $tp;
        }

        public static function getTournamentLogo($tournament, $logo_height = 0) {
            $profile = $tournament->getProfile();
            if ($profile == null) return '<img class="logo-lg" src="/images/logos/FIFA.png">';
            $default_logo_height = 100;
            $logo_dir = 'logos/';
            $logo_filename = $profile->getLogoFilename();
            switch ($profile->getTournamentTypeId()) {
                case Tournament::WORLD_CUP:
                    $logo_dir = 'wc_logos/';
                    break;
                case Tournament::FOOTBALL:
                    $logo_dir = 'nfl_logos/';
                    $logo_filename = 'NFL.svg';
                    break;
                case Tournament::MENS_TENNIS:
                    $default_logo_height = 40;
                    break;
                case Tournament::NATIONS_LEAGUE:
                    $logo_dir = 'unl_logos/';
                    break;
                case Tournament::WOMENS_TENNIS:
                    $default_logo_height = 40;
                    break;
                case Tournament::CHAMPIONS_LEAGUE:
                    $logo_dir = 'club_logos/';
                    break;
                case Tournament::EUROPA_LEAGUE:
                    $logo_dir = 'club_logos/';
                    break;
                case Tournament::WOMENS_WORLD_CUP:
                    $logo_dir = 'wwc_logos/';
                    break;
                case Tournament::OLYMPIC:
                    $logo_dir = 'olympic_logos/';
                    break;
                case Tournament::WOMENS_OLYMPIC:
                    $logo_dir = 'olympic_logos/';
                    break;
                case Tournament::COPA_AMERICA:
                    $logo_dir = 'copa_logos/';
                    break;
                case Tournament::GOLD_CUP:
                    $logo_dir = 'gc_logos/';
                    break;
                case Tournament::AFRICA_CUP_OF_NATIONS:
                    $logo_dir = 'afcon_logos/';
                    break;
                case Tournament::ASIAN_CUP:
                    $logo_dir = 'aac_logos/';
                    break;
                case Tournament::CONFEDERATIONS_CUP:
                    $logo_dir = 'cc_logos/';
                    break;
                default:
                    break;
            }
            if ($logo_height == 0) $logo_height = $default_logo_height;
            $output = '<img height="'.$logo_height.'" src="/images/'.$logo_dir.$logo_filename.'">';
            return $output;
        }

        public static function getTournamentLogoLink($tournament, $logo_height = 0) {
            $profile = $tournament->getProfile();
            if ($profile == null) return '<a href="/Soccer"><img class="logo-lg" src="/images/logos/FIFA.png"></a>';
            $link = 'WorldCup';
            switch ($profile->getTournamentTypeId()) {
                case Tournament::WORLD_CUP:
                    $link = 'WorldCup';
                    break;
                case Tournament::NATIONS_LEAGUE:
                    $link = 'UEFANationsLeague';
                    break;
                case Tournament::CHAMPIONS_LEAGUE:
                    $link = 'UEFAChampionsLeague';
                    break;
                case Tournament::EUROPA_LEAGUE:
                    $link = 'UEFAEuropaLeague';
                    break;
                case Tournament::WOMENS_WORLD_CUP:
                    $link = 'WomenWorldCup';
                    break;
                case Tournament::OLYMPIC:
                    $link = 'OlympicFootballTournament';
                    break;
                case Tournament::WOMENS_OLYMPIC:
                    $link = 'WomenOlympicFootballTournament';
                    break;
                case Tournament::EURO:
                    $link = 'Euro';
                    break;
                case Tournament::COPA_AMERICA:
                    $link = 'CopaAmerica';
                    break;
                case Tournament::GOLD_CUP:
                    $link = 'GoldCup';
                    break;
                case Tournament::AFRICA_CUP_OF_NATIONS:
                    $link = 'AfricaCup';
                    break;
                case Tournament::ASIAN_CUP:
                    $link = 'AsianCup';
                    break;
                case Tournament::OFC_NATIONS_CUP:
                    $link = 'OFCNationsCup';
                    break;
                default:
                    break;
            }
            parse_str($_SERVER['QUERY_STRING'], $query_string);
            if (isset($query_string['tid'])) $link .= '?tid='.$query_string['tid'];
            $link = '<a href="/'.$link.'">'.self::getTournamentLogo($tournament, $logo_height).'</a>';
            return $link;
        }

        public static function getTournamentHeader($tournament) {
            return self::getTournamentLogo($tournament).'&nbsp;&nbsp;'.self::getTournamentTitle($tournament->getProfile());
        }

        public static function getTournamentTitle($profile) {
            if ($profile == null) return '<span class="dark-red">FIFA World Cup</span>';
            return '<span class="'.str_replace('T-', 'class_', SoccerHtml::getValidHtmlId($profile->getName()))
                .'">'.$profile->getName().'</span>';
        }

        public static function getAllFilteringText($profile, $image_type) {
            if ($image_type == Team::CONFEDERATION_LOGO) return 'ALL CONFEDERATIONS';
            switch ($profile->getTournamentTypeId()) {
                case Tournament::NATIONS_LEAGUE:
                    $text = 'ALL NATIONS';
                    break;
                case Tournament::CHAMPIONS_LEAGUE:
                    $text = 'ALL CHAMPIONS';
                    break;
                case Tournament::EUROPA_LEAGUE:
                    $text = 'ALL EUROPA';
                    break;
                default:
                    $text = 'ALL TEAMS';
                    break;
            }
            return $text;
        }

        public static function getQualificationHeader($tournament) {
            return self::getTournamentLogoLink($tournament).'&nbsp;&nbsp;'.self::getQualificationTitle($tournament);
        }

        public static function getQualificationTitleText($tournament) {
            $output = 'FIFA World Cup Qualification';
            $profile = $tournament->getProfile();
            if ($profile == null) return $output;
            switch ($profile->getTournamentTypeId()) {
                case Tournament::WORLD_CUP:
                    $output = substr($profile->getName(), 0, strpos($profile->getName(), 'World Cup') + 9);
                    break;
                default:
                    break;
            }
            $output = $output.' Qualification - '.$tournament->getQualificationConfederation();
            return $output;
        }

        public static function getQualificationTitle($tournament) {
            $output = 'FIFA World Cup Qualification';
            $profile = $tournament->getProfile();
            if ($profile == null) return $output;
            $output = '<span class="'.str_replace('T-', 'class_', SoccerHtml::getValidHtmlId($profile->getName()))
                .'">'.self::getQualificationTitleText($tournament).'</span>';
            return $output;
        }

        public static function getTournamentProfile($tournament) {

            $sql = self::getTournamentProfileSql($tournament->getTournamentId());
            self::getTournamentProfileDb($tournament, $sql);
        }

        /*
            SELECT name, id, logo_filename,
                    start_date, end_date,
                    tournament_type_id, parent_tournament_id,
                    points_for_win, golden_goal_rule, head_to_head_tiebreaker, third_place_ranking
            FROM tournament t
            WHERE t.id = 1
         */

        public static function getTournamentProfileSql($tournament_id) {
            $sql = 'SELECT name, id, logo_filename,
                        start_date, end_date, 
                        tournament_type_id, parent_tournament_id,
                        points_for_win, golden_goal_rule, head_to_head_tiebreaker, third_place_ranking
                    FROM tournament t 
                    WHERE t.id = '.$tournament_id;
            return $sql;
        }

        public static function getTournamentProfileDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $output = '<!-- Tournament Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                $row = $query->fetch(\PDO::FETCH_ASSOC);
                $tournament_profile = TournamentProfile::CreateTournamentProfile(
                    $row['id'], $row['name'], $row['logo_filename'], $row['start_date'], $row['end_date'],
                    $row['tournament_type_id'], $row['parent_tournament_id'],
                    $row['points_for_win'], $row['golden_goal_rule'],
                    $row['head_to_head_tiebreaker'], $row['third_place_ranking']);
                $tournament->setProfile($tournament_profile);
                $tournament->concatBodyHtml($output);
            }
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
        public function getLogoFilename()
        {
            return $this->logo_filename;
        }

        /**
         * @param mixed $logo_filename
         */
        public function setLogoFilename($logo_filename)
        {
            $this->logo_filename = $logo_filename;
        }

        /**
         * @return mixed
         */
        public function getStartDate()
        {
            return $this->start_date;
        }

        /**
         * @param mixed $start_date
         */
        public function setStartDate($start_date)
        {
            $this->start_date = $start_date;
        }

        /**
         * @return mixed
         */
        public function getEndDate()
        {
            return $this->end_date;
        }

        /**
         * @param mixed $end_date
         */
        public function setEndDate($end_date)
        {
            $this->end_date = $end_date;
        }

        /**
         * @return mixed
         */
        public function getTournamentTypeId()
        {
            return $this->tournament_type_id;
        }

        /**
         * @param mixed $tournament_type_id
         */
        public function setTournamentTypeId($tournament_type_id)
        {
            $this->tournament_type_id = $tournament_type_id;
        }

        /**
         * @return mixed
         */
        public function getParentTournamentId()
        {
            return $this->parent_tournament_id;
        }

        /**
         * @param mixed $parent_tournament_id
         */
        public function setParentTournamentId($parent_tournament_id)
        {
            $this->parent_tournament_id = $parent_tournament_id;
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
        public function getHeadToHeadTiebreaker()
        {
            return $this->head_to_head_tiebreaker;
        }

        /**
         * @param mixed $head_to_head_tiebreaker
         */
        public function setHeadToHeadTiebreaker($head_to_head_tiebreaker)
        {
            $this->head_to_head_tiebreaker = $head_to_head_tiebreaker;
        }

        /**
         * @return mixed
         */
        public function getThirdPlaceRanking()
        {
            return $this->third_place_ranking;
        }

        /**
         * @param mixed $third_place_ranking
         */
        public function setThirdPlaceRanking($third_place_ranking)
        {
            $this->third_place_ranking = $third_place_ranking;
        }
    }
