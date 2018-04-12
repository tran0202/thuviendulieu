<?php
    include_once('class.match.php');
    include_once('class.team.php');
    class Tournament{
        private $teams;
        private $matches;

        protected function __construct(){ }

        public static function CreateSoccerTournament($teams, $matches) {
            $t = new Tournament();
            $t->teams = $teams;
            $t->matches = $matches;
            return $t;
        }

        public static function getSoccerTournamentByGroup($tournament_id) {

            $team_dto = Team::getSoccerTeams($tournament_id);
            $match_dto = Match::getSoccerMatches($tournament_id);
            $body_html = $team_dto->getHtml();
            $modal_html = $match_dto->getHtml();

            Team::calculateSoccerStanding($team_dto, $match_dto);

            $body_html .= Team::getSoccerHtml($team_dto);

            $body_html .= Match::getSoccerBracketHtml($match_dto);

            $modal_html .= Match::getSoccerGroupHtml($match_dto);

            return TournamentDTO::CreateSoccerTournamentDTO($body_html, $modal_html);
        }

        public static function getSoccerTournamentBySchedule($tournament_id) {

            $team_dto = Team::getSoccerTeams($tournament_id);
            $match_dto = Match::getSoccerMatches($tournament_id);
            $body_html = $team_dto->getHtml();
            $modal_html = $match_dto->getHtml();

            Team::calculateSoccerStanding($team_dto, $match_dto);

            $body_html .= Match::getSoccerScheduleHtml($match_dto);

            $modal_html .= Team::getSoccerModalHtml($team_dto);

            return TournamentDTO::CreateSoccerTournamentDTO($body_html, $modal_html);
        }

        public static function getFootballTournament($tournament_id) {

            $team_dto = Team::getFootballTeams($tournament_id);
            $body_html = $team_dto->getHtml();

            $body_html .= Team::getFootballHtml($team_dto);

            return TournamentDTO::CreateFootballTournamentDTO($body_html, null);
        }

        public static function getTennisTournament($tournament_id) {

            $match_dto = Match::getTennisMatches($tournament_id);
            $body_html = $match_dto->getHtml();

            $body_html .= Match::getTennisHtml($match_dto);

            return TournamentDTO::CreateTennisTournamentDTO($body_html, null);
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
    }

    class TournamentDTO {

        private $body_html;
        private $modal_html;

        protected function __construct() { }

        public static function CreateSoccerTournamentDTO($body_html, $modal_html)
        {
            $tournament_dto = new TournamentDTO();
            $tournament_dto->body_html = $body_html;
            $tournament_dto->modal_html = $modal_html;
            return $tournament_dto;
        }

        public static function CreateFootballTournamentDTO($body_html, $modal_html)
        {
            $tournament_dto = new TournamentDTO();
            $tournament_dto->body_html = $body_html;
            $tournament_dto->modal_html = $modal_html;
            return $tournament_dto;
        }

        public static function CreateTennisTournamentDTO($body_html, $modal_html)
        {
            $tournament_dto = new TournamentDTO();
            $tournament_dto->body_html = $body_html;
            $tournament_dto->modal_html = $modal_html;
            return $tournament_dto;
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
    }
