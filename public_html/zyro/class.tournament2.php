<?php
    namespace v2;
    include_once('class.match2.php');
    include_once('class.team2.php');
    include_once('class.soccer2.php');

    class Tournament {
        private $teams;
        private $second_round_teams;
        private $matches;
        private $tournament_id;
        private $fantasy;
        private $body_html;
        private $modal_html;
        private $popover_html;
        private $profile;

        protected function __construct() { }

        public static function CreateTournament($teams, $matches, $tournament_id, $fantasy, $body_html, $modal_html, $popover_html, $profile) {
            $t = new Tournament();
            $t->teams = $teams;
            $t->matches = $matches;
            $t->tournament_id = $tournament_id;
            $t->fantasy = $fantasy;
            $t->body_html = $body_html;
            $t->modal_html = $modal_html;
            $t->popover_html = $popover_html;
            $t->profile = $profile;
            return $t;
        }

        public static function CreateSoccerTournament() {
            return self::CreateTournament(null, null, 0, null,
                '', '', '', null);
        }

        public static function getAllTimeSoccerTournament() {

            $tournament = Tournament::CreateSoccerTournament();

            Team::getAllTimeSoccerTeams($tournament);
            Match::getAllTimeSoccerMatches($tournament);

            Soccer::getTournamentCount($tournament->getTeams());
            Soccer::getAllTimeRanking($tournament);
            Team::getAllTimeSoccerRankingHtml($tournament);

            return $tournament;
        }

        public function concatBodyHtml($body_html)
        {
            $this->body_html = $this->body_html.$body_html;
        }

        /**
         * @return mixed
         */
        public function getTeams()
        {
            return $this->teams;
        }

        /**
         * @param mixed $teams
         */
        public function setTeams($teams)
        {
            $this->teams = $teams;
        }

        /**
         * @return mixed
         */
        public function getSecondRoundTeams()
        {
            return $this->second_round_teams;
        }

        /**
         * @param mixed $second_round_teams
         */
        public function setSecondRoundTeams($second_round_teams)
        {
            $this->second_round_teams = $second_round_teams;
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
        public function getFantasy()
        {
            return $this->fantasy;
        }

        /**
         * @param mixed $fantasy
         */
        public function setFantasy($fantasy)
        {
            $this->fantasy = $fantasy;
        }

        /**
         * @return mixed
         */
        public function getBodyHtml()
        {
            return $this->body_html;
        }

        /**
         * @param mixed $body_html
         */
        public function setBodyHtml($body_html)
        {
            $this->body_html = $body_html;
        }

        /**
         * @return mixed
         */
        public function getModalHtml()
        {
            return $this->modal_html;
        }

        /**
         * @param mixed $modal_html
         */
        public function setModalHtml($modal_html)
        {
            $this->modal_html = $modal_html;
        }

        /**
         * @return mixed
         */
        public function getPopoverHtml()
        {
            return $this->popover_html;
        }

        /**
         * @param mixed $popover_html
         */
        public function setPopoverHtml($popover_html)
        {
            $this->popover_html = $popover_html;
        }

        /**
         * @return mixed
         */
        public function getProfile()
        {
            return $this->profile;
        }

        /**
         * @param mixed $profile
         */
        public function setProfile($profile)
        {
            $this->profile = $profile;
        }
    }

    class TournamentProfile {

        private $name;
        private $logo_filename;
        private $points_for_win;
        private $golden_goal_rule;
        private $html;

        protected function __construct() { }

        public static function CreateTournamentProfile($name, $logo_filename, $points_for_win, $golden_goal_rule, $html)
        {
            $tp = new TournamentProfile();
            $tp->name = $name;
            $tp->logo_filename = $logo_filename;
            $tp->points_for_win = $points_for_win;
            $tp->golden_goal_rule = $golden_goal_rule;
            $tp->html = $html;
            return $tp;
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
        public function getHtml()
        {
            return $this->html;
        }

        /**
         * @param mixed $html
         */
        public function setHtml($html)
        {
            $this->html = $html;
        }
    }

    class FantasyType {

        public $fantasy_type = array(
            'AllMatches'=>1,
            'First2Matches'=>2,
            'Final'=>3
        );

        public function __construct() { }

        public function getFantasyType($type) {
            if ($type == null) return null;
            if ($type == '') return null;
            return $this->fantasy_type[$type];
        }
    }
