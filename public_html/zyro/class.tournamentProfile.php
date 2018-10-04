<?php

    class TournamentProfile {

        const WORLD_CUP = 1;
        const FOOTBALL = 2;
        const ATP_MENS_SINGLES = 3;
        const NATIONS_LEAGUE = 4;
        const WTA_WOMENS_SINGLES = 5;
        const CHAMPIONS_LEAGUE = 6;
        const EUROPA_LEAGUE = 7;
        const WOMENS_WORLD_CUP = 8;
        const OLYMPIC = 9;
        const WOMENS_OLYMPIC = 10;

        private $id;
        private $name;
        private $logo_filename;
        private $start_date;
        private $end_date;
        private $tournament_type_id;
        private $parent_tournament_id;
        private $points_for_win;
        private $golden_goal_rule;

        protected function __construct() { }

        public static function CreateTournamentProfile($id, $name, $logo_filename, $start_date, $end_date,
            $tournament_type_id, $parent_tournament_id, $points_for_win, $golden_goal_rule)
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
            return $tp;
        }

        public static function getTournamentLogo($profile, $logo_height = 0) {
            if ($profile == null) return '<img class="logo-lg" src="/images/logos/FIFA.png">';
            $default_logo_height = 100;
            $logo_dir = 'logos/';
            $logo_filename = $profile->getLogoFilename();
            switch ($profile->getTournamentTypeId()) {
                case self::WORLD_CUP:
                    $logo_dir = 'wc_logos/';
                    break;
                case self::FOOTBALL:
                    $logo_dir = 'nfl_logos/';
                    $logo_filename = 'NFL.svg';
                    break;
                case self::ATP_MENS_SINGLES:
                    $default_logo_height = 40;
                    break;
                case self::NATIONS_LEAGUE:
                    $logo_dir = 'unl_logos/';
                    break;
                case self::WTA_WOMENS_SINGLES:
                    $default_logo_height = 40;
                    break;
                case self::CHAMPIONS_LEAGUE:
                    $logo_dir = 'club_logos/';
                    break;
                case self::EUROPA_LEAGUE:
                    $logo_dir = 'club_logos/';
                    break;
                case self::WOMENS_WORLD_CUP:
                    $logo_dir = 'wwc_logos/';
                    break;
                case self::OLYMPIC:
                    $logo_dir = 'olympic_logos/';
                    break;
                case self::WOMENS_OLYMPIC:
                    $logo_dir = 'olympic_logos/';
                    break;
                default:
                    break;
            }
            if ($logo_height == 0) $logo_height = $default_logo_height;
            $output = '<img height="'.$logo_height.'" src="/images/'.$logo_dir.$logo_filename.'">';
            return $output;
        }

        public static function getTournamentHeader($profile) {
            return self::getTournamentLogo($profile).'&nbsp;&nbsp;'.self::getTournamentTitle($profile);
        }

        public static function getTournamentTitle($profile) {
            if ($profile == null) return '<span class="dark-red">FIFA World Cup</span>';
            return '<span class="'.str_replace('T-', 'class_', SoccerHtml::getValidHtmlId($profile->getName()))
                .'">'.$profile->getName().'</span>';
        }

        public static function getAllFilteringText($profile, $image_type) {
            if ($image_type == Team::CONFEDERATION_LOGO) return 'ALL CONFEDERATIONS';
            switch ($profile->getTournamentTypeId()) {
                case self::NATIONS_LEAGUE:
                    $text = 'ALL NATIONS';
                    break;
                case self::CHAMPIONS_LEAGUE:
                    $text = 'ALL CHAMPIONS';
                    break;
                case self::EUROPA_LEAGUE:
                    $text = 'ALL EUROPA';
                    break;
                default:
                    $text = 'ALL TEAMS';
                    break;
            }
            return $text;
        }

        public static function getTournamentProfile($tournament) {

            $sql = self::getTournamentProfileSql($tournament->getTournamentId());
            self::getTournamentProfileDb($tournament, $sql);
        }

        /*
            SELECT name, id, logo_filename,
                    start_date, end_date,
                    tournament_type_id, parent_tournament_id,
                    points_for_win, golden_goal_rule
            FROM tournament t
            WHERE t.id = 1
         */

        public static function getTournamentProfileSql($tournament_id) {
            $sql = 'SELECT name, id, logo_filename,
                        start_date, end_date, 
                        tournament_type_id, parent_tournament_id,
                        points_for_win, golden_goal_rule 
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
                    $row['tournament_type_id'], $row['parent_tournament_id'], $row['points_for_win'], $row['golden_goal_rule']);
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
    }
