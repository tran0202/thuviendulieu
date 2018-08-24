<?php
    include_once('config.php');
    include_once('class.soccer.php');
    include_once('class.tennis.php');
    include_once('class.football.php');

    class Tournament {
        private $teams;
        private $second_round_teams;
        private $tournament_teams;
        private $second_round_tournament_teams;
        private $preseason_teams;
        private $matches;
        private $tournament_id;
        private $fantasy;
        private $body_html;
        private $modal_html;
        private $popover_html;
        private $profile;

        protected function __construct() { }

        public static function CreateTournament($teams, $second_round_teams, $tournament_teams, $matches, $tournament_id, $fantasy, $body_html, $modal_html, $popover_html, $profile) {
            $t = new Tournament();
            $t->teams = $teams;
            $t->second_round_teams = $second_round_teams;
            $t->tournament_teams = $tournament_teams;
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
            return self::CreateTournament(null, null, null, null, 0, null,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentById($tournament_id) {
            return self::CreateTournament(null, null, null, null, $tournament_id, null,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy) {
            return self::CreateTournament(null, null, null, null, $tournament_id, $fantasy,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentByTeams($teams, $second_round_teams, $matches) {
            return self::CreateTournament($teams, $second_round_teams, null, $matches, 0, null,
                '', '', '', null);
        }

        public static function CreateTennisTournamentById($tournament_id) {
            return self::CreateTournament(null, null, null, null, $tournament_id, null,
                '', '', '', null);
        }

        public static function CreateFootballTournamentById($tournament_id) {
            return self::CreateTournament(null, null, null, null, $tournament_id, null,
                '', '', '', null);
        }

        public static function getSoccerTournamentBySchedule($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            self::getTournamentProfile($tournament);
            Soccer::getSoccerTeams($tournament);
            Soccer::getWorldCupMatches($tournament);

            if ($fantasy == Fantasy::All) {
                Soccer::getStanding($tournament);
                Soccer::getSoccerScheduleHtml($tournament, false);
            }
            elseif ($fantasy == Fantasy::Half) {
                Soccer::getStanding($tournament);
                Soccer::getSoccerScheduleHtml($tournament, true);
                Soccer::getSoccerPopoverHtml($tournament);
            }
            else {
                Soccer::getStanding($tournament);
                Soccer::getSoccerScheduleHtml($tournament, false);
            }

            Soccer::getSoccerGroupModalHtml($tournament);

            return $tournament;
        }

        public static function getSoccerTournamentByGroup($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            self::getTournamentProfile($tournament);
            Soccer::getSoccerTeams($tournament);
            Soccer::getWorldCupMatches($tournament);

            Soccer::getStanding($tournament);
            Soccer::getSoccerGroupHtml($tournament);
            Soccer::getSoccerBracketHtml($tournament);
            Soccer::getSoccerScheduleModalHtml($tournament);

            return $tournament;
        }

        public static function getUNLTournamentStandings($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            self::getTournamentProfile($tournament);
            Soccer::getSoccerTeams($tournament);
            Soccer::getUNLMatches($tournament);

            Soccer::getStanding($tournament);
            Soccer::getUNLStandingsHtml($tournament);

            return $tournament;
        }

        public static function getUNLTournamentMatches($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            self::getTournamentProfile($tournament);
            Soccer::getSoccerTeams($tournament);
            Soccer::getUNLMatches($tournament);

            if ($fantasy == Fantasy::All) {
                Soccer::getStanding($tournament);
                Soccer::getUNLMatchesHtml($tournament, false);
            }
            elseif ($fantasy == Fantasy::Half) {
                Soccer::getStanding($tournament);
                Soccer::getUNLMatchesHtml($tournament, false);
                Soccer::getSoccerPopoverHtml($tournament);
            }
            else {
                Soccer::getStanding($tournament);
                Soccer::getUNLMatchesHtml($tournament, false);
            }

            Soccer::getUNLGroupModalHtml($tournament);

            return $tournament;
        }

        public static function getAllTimeSoccerTournament() {

            $tournament = Tournament::CreateSoccerTournament();

            Soccer::getAllTimeSoccerTeams($tournament);
            Soccer::getAllTimeSoccerMatches($tournament);
            Soccer::getAllTimeSoccerTeamTournaments($tournament);

            Soccer::getTournamentCount($tournament);
            Soccer::getAllTimeRanking($tournament);
            Soccer::getAllTimeSoccerRankingHtml($tournament);
            Soccer::getAllTimeTournamentRanking($tournament);
            Soccer::getAllTimeSoccerPopoverHtml($tournament);

            return $tournament;
        }

        public static function getArchiveSoccerTournament($tournament_id) {

            $tournament = Tournament::CreateSoccerTournamentById($tournament_id);

            self::getTournamentProfile($tournament);
            Soccer::getSoccerTeams($tournament);
            Soccer::getWorldCupMatches($tournament);

            Soccer::getFirstStageMatchesRanking($tournament);
            Soccer::getArchiveSoccerScheduleHtml($tournament);
            Soccer::getSoccerGroupModalHtml($tournament);
            Soccer::updateFirstStageMatchesRanking($tournament);

            Soccer::getSecondStageMatchesRanking($tournament);
            Soccer::getTournamentSoccerRankingHtml($tournament);

            return $tournament;
        }

        public static function getFootballTournamentSchedule($tournament_id) {

            $tournament = Tournament::CreateFootballTournamentById($tournament_id);

            self::getTournamentProfile($tournament);
            Football::getFootballTeams($tournament);
            Football::getFootballMatches($tournament);

            Football::getFootballScheduleHtml($tournament);

            return $tournament;
        }

        public static function getFootballTournamentStandings($tournament_id) {

            $tournament = Tournament::CreateFootballTournamentById($tournament_id);

            self::getTournamentProfile($tournament);
            Football::getFootballTeams($tournament);
            Football::getFootballMatches($tournament);

            Football::getPreseasonRanking($tournament);
            Football::getRegularSeasonRanking($tournament);
            Football::getFootballStandingsHtml($tournament);

            return $tournament;
        }

        public static function getTennisTournament($tournament_id) {

            $tournament = Tournament::CreateTennisTournamentById($tournament_id);

            self::getTournamentProfile($tournament);
            Tennis::getTennisMatches($tournament);
            Tennis::getTennisHtml($tournament);

            return $tournament;
        }

        public static function getTournamentProfile($tournament) {

            $sql = Tournament::getTournamentProfileSql($tournament->getTournamentId());
            self::getTournamentProfileDb($tournament, $sql);
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

        public static function getTournamentProfileSql($tournament_id) {
            $sql = 'SELECT name, id, logo_filename,
                        start_date, end_date, 
                        tournament_type_id, parent_tournament_id,
                        points_for_win, golden_goal_rule 
                    FROM tournament t 
                    WHERE t.id = '.$tournament_id;
            return $sql;
        }

        public function concatBodyHtml($body_html)
        {
            $this->body_html = $this->body_html.$body_html;
        }

        public function concatModalHtml($modal_html)
        {
            $this->modal_html = $this->modal_html.$modal_html;
        }

        public function concatPopoverHtml($popover_html)
        {
            $this->popover_html = $this->popover_html.$popover_html;
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
        public function getTournamentTeams()
        {
            return $this->tournament_teams;
        }

        /**
         * @param mixed $tournament_teams
         */
        public function setTournamentTeams($tournament_teams)
        {
            $this->tournament_teams = $tournament_teams;
        }

        /**
         * @return mixed
         */
        public function getSecondRoundTournamentTeams()
        {
            return $this->second_round_tournament_teams;
        }

        /**
         * @param mixed $second_round_tournament_teams
         */
        public function setSecondRoundTournamentTeams($second_round_tournament_teams)
        {
            $this->second_round_tournament_teams = $second_round_tournament_teams;
        }

        /**
         * @return mixed
         */
        public function getPreseasonTeams()
        {
            return $this->preseason_teams;
        }

        /**
         * @param mixed $preseason_teams
         */
        public function setPreseasonTeams($preseason_teams)
        {
            $this->preseason_teams = $preseason_teams;
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

        public function getTournamentHeader() {
            $output = '<img src="/images/wc_logos/'.self::getLogoFilename().'">&nbsp;&nbsp;'.self::getName();
            return $output;
        }

        public function getUNLTournamentHeader() {
            $output = '<img height="100" src="/images/unl_logos/'.self::getLogoFilename().'">&nbsp;&nbsp;'.self::getName();
            return $output;
        }

        public function getNFLTournamentHeader() {
            $output = '<img height="100" src="/images/nfl_logos/NFL.svg">&nbsp;&nbsp;'.self::getName();
            return $output;
        }

        public function getTennisTournamentHeader() {
            $output = self::getName();
            return $output;
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
