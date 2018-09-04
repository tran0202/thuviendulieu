<?php
    include_once('config.php');
    include_once('class.tournamentProfile.php');
    include_once('class.soccer.php');
    include_once('class.soccerTeam.php');
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

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
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

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getWorldCupMatches($tournament);

            Soccer::getStanding($tournament);
            Soccer::getSoccerGroupHtml($tournament);
            Soccer::getSoccerBracketHtml($tournament);
            Soccer::getSoccerScheduleModalHtml($tournament);

            return $tournament;
        }

        public static function getUNLTournamentStandings($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getUNLMatches($tournament);

            Soccer::getStanding($tournament);
            Soccer::getUNLStandingsHtml($tournament);

            return $tournament;
        }

        public static function getUNLTournamentMatches($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
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

        public static function getUCLTournamentStandings($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getUCLMatches($tournament);

            Soccer::getUCLStanding($tournament);
            Soccer::getUCLStandingsHtml($tournament);

            return $tournament;
        }

        public static function getUCLTournamentMatches($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getUCLMatches($tournament);

            if ($fantasy == Fantasy::All) {
                Soccer::getUCLStanding($tournament);
                Soccer::getUCLMatchesHtml($tournament, false);
            }
            elseif ($fantasy == Fantasy::Half) {
                Soccer::getUCLStanding($tournament);
                Soccer::getUCLMatchesHtml($tournament, false);
                Soccer::getSoccerPopoverHtml($tournament);
            }
            else {
                Soccer::getUCLStanding($tournament);
                Soccer::getUCLMatchesHtml($tournament, false);
            }

            Soccer::getUCLGroupModalHtml($tournament);

            return $tournament;
        }

        public static function getUELTournamentStandings($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getUELMatches($tournament);

//            Soccer::getStanding($tournament);
            Soccer::getUCLStandingsHtml($tournament);

            return $tournament;
        }

        public static function getUELTournamentMatches($tournament_id, $fantasy) {

            $tournament = Tournament::CreateSoccerTournamentByIdFantasy($tournament_id, $fantasy);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getUELMatches($tournament);

            if ($fantasy == Fantasy::All) {
//                Soccer::getStanding($tournament);
                Soccer::getUELMatchesHtml($tournament, false);
            }
            elseif ($fantasy == Fantasy::Half) {
//                Soccer::getStanding($tournament);
                Soccer::getUELMatchesHtml($tournament, false);
//                Soccer::getSoccerPopoverHtml($tournament);
            }
            else {
//                Soccer::getStanding($tournament);
                Soccer::getUELMatchesHtml($tournament, false);
            }
//
            Soccer::getUCLGroupModalHtml($tournament);

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

        public static function getAllTimeWomenSoccerTournament() {

            $tournament = Tournament::CreateSoccerTournament();

            Soccer::getAllTimeWomenSoccerTeams($tournament);
            Soccer::getAllTimeWomenSoccerMatches($tournament);
            Soccer::getAllTimeWomenSoccerTeamTournaments($tournament);

            Soccer::getTournamentCount($tournament);
            Soccer::getAllTimeRanking($tournament);
            Soccer::getAllTimeSoccerRankingHtml($tournament);
            Soccer::getAllTimeTournamentRanking($tournament);
            Soccer::getAllTimeSoccerPopoverHtml($tournament);

            return $tournament;
        }

        public static function getAllTimeOlympicSoccerTournament() {

            $tournament = Tournament::CreateSoccerTournament();

            Soccer::getAllTimeOlympicSoccerTeams($tournament);
            Soccer::getAllTimeOlympicSoccerMatches($tournament);
            Soccer::getAllTimeOlympicSoccerTeamTournaments($tournament);

            Soccer::getTournamentCount($tournament);
            Soccer::getAllTimeRanking($tournament);
            Soccer::getAllTimeSoccerRankingHtml($tournament);
            Soccer::getAllTimeTournamentRanking($tournament);
            Soccer::getAllTimeSoccerPopoverHtml($tournament);

            return $tournament;
        }

        public static function getAllTimeWomenOlympicSoccerTournament() {

            $tournament = Tournament::CreateSoccerTournament();

            Soccer::getAllTimeWomenOlympicSoccerTeams($tournament);
            Soccer::getAllTimeWomenOlympicSoccerMatches($tournament);
            Soccer::getAllTimeWomenOlympicSoccerTeamTournaments($tournament);

            Soccer::getTournamentCount($tournament);
            Soccer::getAllTimeRanking($tournament);
            Soccer::getAllTimeSoccerRankingHtml($tournament);
            Soccer::getAllTimeTournamentRanking($tournament);
            Soccer::getAllTimeSoccerPopoverHtml($tournament);

            return $tournament;
        }

        public static function getArchiveSoccerTournament($tournament_id) {

            $tournament = Tournament::CreateSoccerTournamentById($tournament_id);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getWorldCupMatches($tournament);

            Soccer::getFirstStageMatchesRanking($tournament);
            Soccer::getArchiveSoccerScheduleHtml($tournament);
            Soccer::getSoccerGroupModalHtml($tournament);
            Soccer::updateFirstStageMatchesRanking($tournament);

            Soccer::getSecondStageMatchesRanking($tournament);
            Soccer::getTournamentSoccerRankingHtml($tournament);

            return $tournament;
        }

        public static function getWomenSoccerTournament($tournament_id) {

            $tournament = Tournament::CreateSoccerTournamentById($tournament_id);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getWomenWorldCupMatches($tournament);

            Soccer::getFirstStageMatchesRanking($tournament);
            Soccer::getArchiveSoccerScheduleHtml($tournament);
            Soccer::getSoccerGroupModalHtml($tournament);
            Soccer::updateFirstStageMatchesRanking($tournament);

            Soccer::getSecondStageMatchesRanking($tournament);
            Soccer::getTournamentSoccerRankingHtml($tournament);

            return $tournament;
        }

        public static function getOlympicSoccerTournament($tournament_id) {

            $tournament = Tournament::CreateSoccerTournamentById($tournament_id);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getOlympicMatches($tournament);

            Soccer::getFirstStageMatchesRanking($tournament);
            Soccer::getArchiveSoccerScheduleHtml($tournament);
            Soccer::getSoccerGroupModalHtml($tournament);
            Soccer::updateFirstStageMatchesRanking($tournament);

            Soccer::getSecondStageMatchesRanking($tournament);
            Soccer::getTournamentSoccerRankingHtml($tournament);

            return $tournament;
        }

        public static function getWomenOlympicSoccerTournament($tournament_id) {

            $tournament = Tournament::CreateSoccerTournamentById($tournament_id);

            TournamentProfile::getTournamentProfile($tournament);
            SoccerTeam::getSoccerTeams($tournament);
            Soccer::getWomenOlympicMatches($tournament);

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
