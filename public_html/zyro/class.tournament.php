<?php
    include_once('class.football.php');
    include_once('class.match.php');
    include_once('class.soccer.php');
    include_once('class.soccerHtml.php');
    include_once('class.team.php');
    include_once('class.tennis.php');
    include_once('class.tournamentProfile.php');
    include_once('config.php');
    include_once('class.scenario.php');

    class Tournament {

        const WORLD_CUP = 1;
        const FOOTBALL = 2;
        const MENS_TENNIS = 3;
        const NATIONS_LEAGUE = 4;
        const WOMENS_TENNIS = 5;
        const CHAMPIONS_LEAGUE = 6;
        const EUROPA_LEAGUE = 7;
        const WOMENS_WORLD_CUP = 8;
        const OLYMPIC = 9;
        const WOMENS_OLYMPIC = 10;
        const EURO = 11;

        const SIMULATION_MODE_0 = 0;
        const SIMULATION_MODE_1 = 1;
        const SIMULATION_MODE_2 = 2;

        private $teams;
        private $second_round_teams;
        private $tournament_teams;
        private $second_round_tournament_teams;
        private $preseason_teams;
        private $matches;
        private $tournament_id;
        private $tournament_type_id;
        private $simulation_mode;
        private $body_html;
        private $modal_html;
        private $popover_html;
        private $profile;

        protected function __construct() { }

        public static function CreateTournament($teams, $second_round_teams, $tournament_teams, $matches,
                                                $tournament_id, $tournament_type_id, $simulation_mode,
                                                $body_html, $modal_html, $popover_html, $profile) {
            $t = new Tournament();
            $t->teams = $teams;
            $t->second_round_teams = $second_round_teams;
            $t->tournament_teams = $tournament_teams;
            $t->matches = $matches;
            $t->tournament_id = $tournament_id;
            $t->tournament_type_id = $tournament_type_id;
            $t->simulation_mode = $simulation_mode;
            $t->body_html = $body_html;
            $t->modal_html = $modal_html;
            $t->popover_html = $popover_html;
            $t->profile = $profile;
            return $t;
        }

        public static function CreateSoccerTournament() {
            return self::CreateTournament(null, null, null, null, 0, 0, null,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentById($tournament_id) {
            return self::CreateTournament(null, null, null, null, $tournament_id, 0, null,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentByType($tournament_type_id) {
            return self::CreateTournament(null, null, null, null, 0, $tournament_type_id, null,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentByIdType($tournament_id, $tournament_type_id) {
            return self::CreateTournament(null, null, null, null, $tournament_id, $tournament_type_id, null,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentByIdSimMode($tournament_id, $simulation_mode) {
            return self::CreateTournament(null, null, null, null, $tournament_id, 0, $simulation_mode,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentByIdTypeSimMode($tournament_id, $tournament_type_id, $simulation_mode) {
            return self::CreateTournament(null, null, null, null, $tournament_id, $tournament_type_id, $simulation_mode,
                '', '', '', null);
        }

        public static function CreateSoccerTournamentByTeams($teams, $second_round_teams, $matches) {
            return self::CreateTournament($teams, $second_round_teams, null, $matches, 0, 0, null,
                '', '', '', null);
        }

        public static function CreateTennisTournamentById($tournament_id) {
            return self::CreateTournament(null, null, null, null, $tournament_id, 0, null,
                '', '', '', null);
        }

        public static function CreateFootballTournamentById($tournament_id) {
            return self::CreateTournament(null, null, null, null, $tournament_id, 0, null,
                '', '', '', null);
        }

        public static function getSoccerTournament($tournament_id) {

            $tournament = Tournament::CreateSoccerTournamentById($tournament_id);

            TournamentProfile::getTournamentProfile($tournament);
            Team::getSoccerTeams($tournament);
            Match::getSoccerMatches($tournament);

            Soccer::getFirstStageMatchesRanking($tournament);
            SoccerHtml::getSoccerScheduleHtml($tournament);
            SoccerHtml::getSoccerGroupModalHtml($tournament);
            Soccer::updateFirstStageMatchesRanking($tournament);

            Soccer::getSecondStageMatchesRanking($tournament);
            SoccerHtml::getSoccerRankingHtml($tournament);

            return $tournament;
        }

        public static function getSoccerTournamentGroupView($tournament_id, $simulation_mode) {

            $tournament = Tournament::CreateSoccerTournamentByIdSimMode($tournament_id, $simulation_mode);

            TournamentProfile::getTournamentProfile($tournament);
            Team::getSoccerTeams($tournament);
            Match::getSoccerMatches($tournament);

            Soccer::getStanding($tournament);
            SoccerHtml::getSoccerGroupHtml($tournament);
            SoccerHtml::getSoccerBracketHtml($tournament);
            SoccerHtml::getSoccerScheduleModalHtml($tournament);

            return $tournament;
        }

        public static function getSoccerTournamentScheduleView($tournament_id, $simulation_mode) {

            $tournament = Tournament::CreateSoccerTournamentByIdSimMode($tournament_id, $simulation_mode);

            TournamentProfile::getTournamentProfile($tournament);
            Team::getSoccerTeams($tournament);
            Match::getSoccerMatches($tournament);

            Soccer::getStanding($tournament);
            SoccerHtml::getSoccerScheduleHtml($tournament);
            SoccerHtml::getSoccerPopoverHtml($tournament);
            SoccerHtml::getSoccerGroupModalHtml($tournament);

            return $tournament;
        }

        public static function getSoccerTournamentStandingsView($tournament_id, $simulation_mode) {

            $tournament = Tournament::CreateSoccerTournamentByIdSimMode($tournament_id, $simulation_mode);

            TournamentProfile::getTournamentProfile($tournament);
            Team::getSoccerTeams($tournament);
            Match::getSoccerMatches($tournament);

            Soccer::getStanding($tournament);
            SoccerHtml::getSoccerStandingsHtml($tournament);

            return $tournament;
        }

        public static function getSoccerTournamentStandingsMultiLeagueView($tournament_id, $simulation_mode) {

            $tournament = Tournament::CreateSoccerTournamentByIdSimMode($tournament_id, $simulation_mode);

            TournamentProfile::getTournamentProfile($tournament);
            Team::getSoccerTeams($tournament);
            Match::getSoccerMatches($tournament);

            Soccer::getStanding($tournament);
            SoccerHtml::getSoccerStandingsMultiLeagueHtml($tournament);

            return $tournament;
        }

        public static function getSoccerTournamentMatchesView($tournament_id, $simulation_mode) {

            $tournament = Tournament::CreateSoccerTournamentByIdSimMode($tournament_id, $simulation_mode);

            TournamentProfile::getTournamentProfile($tournament);
            Team::getSoccerTeams($tournament);
            Match::getSoccerMatches($tournament);

            Soccer::getStanding($tournament);
            SoccerHtml::getSoccerMatchesOneLeagueHtml($tournament);
            SoccerHtml::getSoccerPopoverHtml($tournament);
            SoccerHtml::getSoccerMatchesModalHtml($tournament);
            return $tournament;
        }

        public static function getSoccerTournamentMatchesMultiLeagueView($tournament_id, $simulation_mode) {

            $tournament = Tournament::CreateSoccerTournamentByIdSimMode($tournament_id, $simulation_mode);

            TournamentProfile::getTournamentProfile($tournament);
            Team::getSoccerTeams($tournament);
            Match::getSoccerMatches($tournament);

            Soccer::getStanding($tournament);
            SoccerHtml::getSoccerMatchesMultiLeagueHtml($tournament);
            SoccerHtml::getSoccerPopoverHtml($tournament);
            SoccerHtml::getSoccerMatchesMultiLeagueModalHtml($tournament);

            return $tournament;
        }

        public static function getAllTimeSoccerTournament($tournament_type_id) {

            $tournament = Tournament::CreateSoccerTournamentByType($tournament_type_id);

            Team::getAllTimeSoccerTeams($tournament);
            Match::getAllTimeSoccerMatches($tournament);
            Team::getAllTimeSoccerTeamTournaments($tournament);

            self::getTournamentCount($tournament);
            Soccer::getAllTimeRanking($tournament);
            SoccerHtml::getAllTimeSoccerRankingHtml($tournament);
            Soccer::getAllTimeTeamTournamentRanking($tournament);
            SoccerHtml::getAllTimeSoccerPopoverHtml($tournament);

            return $tournament;
        }

        public static function getFootballTournamentSchedule($tournament_id) {

            $tournament = Tournament::CreateFootballTournamentById($tournament_id);

            TournamentProfile::getTournamentProfile($tournament);
            Football::getFootballTeams($tournament);
            Football::getFootballMatches($tournament);

            Football::getFootballScheduleHtml($tournament);

            return $tournament;
        }

        public static function getFootballTournamentStandings($tournament_id) {

            $tournament = Tournament::CreateFootballTournamentById($tournament_id);

            TournamentProfile::getTournamentProfile($tournament);
            Football::getFootballTeams($tournament);
            Football::getFootballMatches($tournament);

            Football::getPreseasonRanking($tournament);
            Football::getRegularSeasonRanking($tournament);
            Football::getFootballStandingsHtml($tournament);

            return $tournament;
        }

        public static function getTennisTournament($tournament_id) {

            $tournament = Tournament::CreateTennisTournamentById($tournament_id);

            TournamentProfile::getTournamentProfile($tournament);
            Tennis::getTennisMatches($tournament);
            Tennis::getTennisHtml($tournament);

            return $tournament;
        }

        public static function getTournamentCount($tournament) {
            $teams = $tournament->getTeams();
            $teams_copy = Team::getTeamArrayByName($teams);

            for ($i = 0; $i < sizeof($teams); $i++ ) {
                $parent_team_name = $teams[$i]->getParentName();
                if ($parent_team_name != null) {
                    $tc = $teams_copy[$parent_team_name]->getTournamentCount();
                    $teams_copy[$parent_team_name]->setTournamentCount($tc + $teams[$i]->getTournamentCount());
                }
            }
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
        public function getSimulationMode()
        {
            return $this->simulation_mode;
        }

        /**
         * @param mixed $simulation_mode
         */
        public function setSimulationMode($simulation_mode)
        {
            $this->simulation_mode = $simulation_mode;
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
