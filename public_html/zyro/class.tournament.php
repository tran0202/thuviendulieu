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

        public static function getSoccerTournamentByGroup2($tournament_id, $stage_id) {

            $team_dto = Team::getSoccerTeams2($tournament_id);
            $match_dto = Match::getSoccerGroupMatches2($tournament_id, $stage_id);

            Team::calculateSoccerStanding2($team_dto, $match_dto);
            $teams = Team::getTeamArrayByGroup($team_dto);
            $team_dto->setHtml($team_dto->getHtml().Team::getSoccerHtml($teams));

            $matches = Match::getMatchArrayByGroup($match_dto);
            $match_dto->setHtml(Match::getSoccerGroupHtml($matches));

            $matches = Match::getMatchArraySecondStage($match_dto);
            $team_dto->setHtml($team_dto->getHtml().Match::getSoccerBracketHtml($matches));

            return TournamentDTO::CreateSoccerTournamentDTO2($team_dto, $match_dto);
        }

        public static function getSoccerTournamentByGroup($tournament_id) {

            $match_dto = Match::getSoccerGroupMatches($tournament_id);
            $team_dto = Team::getSoccerTeams($tournament_id, $match_dto);

            return TournamentDTO::CreateSoccerTournamentDTO($team_dto->getTeamHtml(), $team_dto->getMatchHtml());
        }

        public static function getSoccerTournamentBySchedule($tournament_id) {

            $match_dto = Match::getSoccerScheduleMatches($tournament_id);
            $team_dto = Team::getSoccerModalTeams($tournament_id, $match_dto);

            return TournamentDTO::CreateSoccerTournamentDTO($team_dto->getTeamHtml(), $team_dto->getMatchHtml());
        }

        public static function getSoccerTournamentByBracket($tournament_id, $stage_id) {

            $match_dto = Match::getSoccerBracketMatches($tournament_id, $stage_id);

            return TournamentDTO::CreateSoccerTournamentDTO(null, $match_dto->getHtml());
        }

        public static function getFootballTournament($tournament_id) {

            $team_dto = Team::getFootballTeams($tournament_id);

            return TournamentDTO::CreateSoccerTournamentDTO($team_dto->getTeamHtml(), null);
        }

        public static function getTennisTournament($tournament_id) {

            $match_dto = Match::getTennisMatches($tournament_id);

            return TournamentDTO::CreateSoccerTournamentDTO(null, $match_dto->getHtml());
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

        private $team_dto;
        private $match_dto;
        private $team_html;
        private $match_html;

        protected function __construct() { }

        public static function CreateSoccerTournamentDTO2($team_dto, $match_dto)
        {
            $tournament_dto = new TournamentDTO();
            $tournament_dto->team_dto = $team_dto;
            $tournament_dto->match_dto = $match_dto;
            return $tournament_dto;
        }

        public static function CreateSoccerTournamentDTO($team_html, $match_html)
        {
            $tournament_dto = new TournamentDTO();
            $tournament_dto->team_html = $team_html;
            $tournament_dto->match_html = $match_html;
            return $tournament_dto;
        }

        /**
         * @return mixed
         */
        public function getTeamDto()
        {
            return $this->team_dto;
        }

        /**
         * @param mixed $team_dto
         */
        public function setTeamDto($team_dto)
        {
            $this->team_dto = $team_dto;
        }

        /**
         * @return mixed
         */
        public function getMatchDto()
        {
            return $this->match_dto;
        }

        /**
         * @param mixed $match_dto
         */
        public function setMatchDto($match_dto)
        {
            $this->match_dto = $match_dto;
        }

        /**
         * @return mixed
         */
        public function getTeamHtml()
        {
            return $this->team_html;
        }

        /**
         * @param mixed $team_html
         */
        public function setTeamHtml($team_html)
        {
            $this->team_html = $team_html;
        }

        /**
         * @return mixed
         */
        public function getMatchHtml()
        {
            return $this->match_html;
        }

        /**
         * @param mixed $match_html
         */
        public function setMatchHtml($match_html)
        {
            $this->match_html = $match_html;
        }
    }
