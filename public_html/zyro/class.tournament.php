<?php
    include_once('class.match.php');
    include_once('class.team.php');
    include_once('class.soccer.php');
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

        public static function getSoccerTournamentByGroup($tournament_id, $fantasy) {

            $ft = new FantasyType();
            $fantasy = $ft->getFantasyType($fantasy);
            $tournament_dto = TournamentDTO::CreateTournamentDTO($tournament_id, $fantasy);

            $team_dto = Team::getSoccerTeams($tournament_dto);
            $match_dto = Match::getSoccerMatches($tournament_dto);
            $body_html = $team_dto->getHtml();
            $modal_html = $match_dto->getHtml();

            if ($fantasy == $ft->getFantasyType('AllMatches')) Soccer::calculateStanding($team_dto, $match_dto);
            if ($fantasy == $ft->getFantasyType('First2Matches')) Soccer::calculateStanding($team_dto, $match_dto, true);
            $body_html .= Team::getSoccerHtml($team_dto);

            $body_html .= Match::getSoccerBracketHtml($match_dto);

            $modal_html .= Match::getSoccerGroupHtml($match_dto);

            return TournamentDTO::CreateSoccerTournamentDTO($body_html, $modal_html);
        }

        public static function getSoccerTournamentBySchedule($tournament_id, $fantasy) {

            $ft = new FantasyType();
            $fantasy = $ft->getFantasyType($fantasy);
            $tournament_dto = TournamentDTO::CreateTournamentDTO($tournament_id, $fantasy);

            $team_dto = Team::getSoccerTeams($tournament_dto);
            $match_dto = Match::getSoccerMatches($tournament_dto);
            $body_html = $team_dto->getHtml();
            $modal_html = $match_dto->getHtml();

            if ($fantasy == $ft->getFantasyType('AllMatches')) Soccer::calculateStanding($team_dto, $match_dto);
            if ($fantasy == $ft->getFantasyType('First2Matches')) Soccer::calculateStanding($team_dto, $match_dto, true);
            $body_html .= Match::getSoccerScheduleHtml($match_dto);

            $modal_html .= Team::getSoccerModalHtml($team_dto);

            return TournamentDTO::CreateSoccerTournamentDTO($body_html, $modal_html);
        }

        public static function getFootballTournament($tournament_id, $fantasy = false) {

            $tournament_dto = TournamentDTO::CreateTournamentDTO($tournament_id, $fantasy);

            $team_dto = Team::getFootballTeams($tournament_dto);
            $body_html = $team_dto->getHtml();

            $body_html .= Team::getFootballHtml($team_dto);

            return TournamentDTO::CreateFootballTournamentDTO($body_html, null);
        }

        public static function getTennisTournament($tournament_id, $fantasy = false) {

            $tournament_dto = TournamentDTO::CreateTournamentDTO($tournament_id, $fantasy);

            $match_dto = Match::getTennisMatches($tournament_dto);
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
        private $tournament_id;
        private $fantasy;
        private $body_html;
        private $modal_html;

        protected function __construct() { }

        public static function CreateTournamentDTO($tournament_id, $fantasy)
        {
            $tournament_dto = new TournamentDTO();
            $tournament_dto->tournament_id = $tournament_id;
            $tournament_dto->fantasy = $fantasy;
            return $tournament_dto;
        }

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
    }

    class FantasyType {

        public $fantasy_type = array(
            'AllMatches'=>1,
            'First2Matches'=>2
        );

        public function __construct() { }

        public function getFantasyType($type) {
            return $this->fantasy_type[$type];
        }
    }

    abstract class Fantasy {
        const AllMatches = 1;
        const First2Matches = 2;
    }
