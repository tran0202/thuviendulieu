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

            $profile = self::getTournamentProfile($tournament_id)->getHtml();
            $team_dto = Team::getSoccerTeams($tournament_dto);
            $match_dto = Match::getSoccerMatches($tournament_dto);
            $body_html = $team_dto->getHtml();
            $modal_html = $match_dto->getHtml();

            if (Soccer::isTournamentFinal($match_dto)) $fantasy = $ft->getFantasyType('Final');

            if ($fantasy == $ft->getFantasyType('AllMatches')) {
                Soccer::getStanding($team_dto, $match_dto, $fantasy);
            }
            elseif ($fantasy == $ft->getFantasyType('First2Matches')) {
                Soccer::getStanding($team_dto, $match_dto, $fantasy);
            }
            elseif ($fantasy == $ft->getFantasyType('Final')) {
                Soccer::getStanding($team_dto, $match_dto, $fantasy);
            }
            $body_html .= Team::getSoccerHtml($team_dto);

            $body_html .= Match::getSoccerBracketHtml($match_dto);

            $modal_html .= Match::getSoccerGroupHtml($match_dto);

            return TournamentDTO::CreateSoccerTournamentDTO($body_html, $modal_html, '', $profile);
        }

        public static function getSoccerTournamentBySchedule($tournament_id, $fantasy) {

            $ft = new FantasyType();
            $fantasy = $ft->getFantasyType($fantasy);
            $tournament_dto = TournamentDTO::CreateTournamentDTO($tournament_id, $fantasy);

            $profile = self::getTournamentProfile($tournament_id)->getHtml();
            $team_dto = Team::getSoccerTeams($tournament_dto);
            $match_dto = Match::getSoccerMatches($tournament_dto);
            $body_html = $team_dto->getHtml();
            $modal_html = $match_dto->getHtml();
            $popover_html = '';

            if (Soccer::isTournamentFinal($match_dto)) $fantasy = $ft->getFantasyType('Final');

            if ($fantasy == $ft->getFantasyType('AllMatches')) {
                Soccer::getStanding($team_dto, $match_dto, $fantasy);
                $body_html .= Match::getSoccerScheduleHtml($match_dto);
            }
            elseif ($fantasy == $ft->getFantasyType('First2Matches')) {
                Soccer::getStanding($team_dto, $match_dto, $fantasy);
                $body_html .= Match::getSoccerScheduleHtml($match_dto, true);
                $popover_html = Team::getSoccerPopoverHtml($team_dto);
            }
            elseif ($fantasy == $ft->getFantasyType('Final')) {
                Soccer::getStanding($team_dto, $match_dto, $fantasy);
                $body_html .= Match::getSoccerScheduleHtml($match_dto);
            }
            else {
                $body_html .= Match::getSoccerScheduleHtml($match_dto);
            }

            $modal_html .= Team::getSoccerModalHtml($team_dto);

            return TournamentDTO::CreateSoccerTournamentDTO($body_html, $modal_html, $popover_html, $profile);
        }

        public static function getArchiveSoccerTournament($tournament_id) {

            $tournament_dto = TournamentDTO::CreateTournamentDTO($tournament_id, null);

            $profile = self::getTournamentProfile($tournament_id);
            $team_dto = Team::getSoccerTeams($tournament_dto);
            $match_dto = Match::getSoccerMatches($tournament_dto);
            $body_html = $team_dto->getHtml();
            $modal_html = $match_dto->getHtml();
            $popover_html = '';

            Soccer::getTournamentRanking($team_dto, $match_dto);
            $body_html .= Match::getSoccerScheduleHtml($match_dto);
            $modal_html .= Team::getSoccerModalHtml($team_dto);

            Soccer::getTournamentRanking($team_dto, $match_dto, Stage::Second);
            $body_html .= Team::getSoccerRankingHtml($team_dto, $tournament_id);


            return TournamentDTO::CreateSoccerTournamentDTO($body_html, $modal_html, $popover_html, $profile);
        }

        public static function getArchiveSoccerTournament2($tournament_id) {

            $tournament_dto = TournamentDTO::CreateTournamentDTO($tournament_id, null);

            $profile = self::getTournamentProfile($tournament_id);
            $team_dto = Team::getSoccerTeams($tournament_dto);
            $match_dto = Match::getSoccerMatches($tournament_dto);
            $body_html = $team_dto->getHtml();
            $modal_html = $match_dto->getHtml();
            $popover_html = '';

            Soccer::getTournamentRanking($team_dto, $match_dto);
            Soccer::getTournamentSecondRoundRanking($team_dto, $match_dto);
            $body_html .= Match::getSoccerScheduleHtml($match_dto);
            $modal_html .= Team::getSoccerModalHtml($team_dto);

            Soccer::getTournamentRanking($team_dto, $match_dto, Stage::Second);
            $body_html .= Team::getSoccerRankingHtml($team_dto, $tournament_id);

            return TournamentDTO::CreateSoccerTournamentDTO($body_html, $modal_html, $popover_html, $profile);
        }

        public static function getAllTimeSoccerTournament($tournament_id) {

            $tournament_dto = TournamentDTO::CreateTournamentDTO($tournament_id, null);

            $team_dto = Team::getAllTimeSoccerTeams();
            $match_dto = Match::getAllTimeSoccerMatches($tournament_dto);
            $body_html = $team_dto->getHtml();
            $body_html .= $match_dto->getHtml();

            Soccer::getTournamentRanking($team_dto, $match_dto, Stage::AllStages, true);
            $body_html .= Team::getSoccerRankingHtml($team_dto, $tournament_id, 'All Time Rankings');

            return TournamentDTO::CreateSoccerTournamentDTO($body_html, '', '', null);
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

        public static function getTournamentProfile($tournament_id) {

            $sql = self::getTournamentProfileSql($tournament_id);
            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $output = '<!-- Tournament Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                return TournamentProfile::CreateTournamentProfile(null, $count, 0, 0, $output);
            }
            else {
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $output .= self::getTournamentProfileHtml($row);
                return TournamentProfile::CreateTournamentProfile($row['name'], $row['logo_filename'], $row['points_for_win'], $row['golden_goal_rule'], $output);
            }
        }

        public static function getTournamentProfileHtml($tp) {
            $output = '<img src="/images/wc_logos/'.$tp['logo_filename'].'">&nbsp;&nbsp;'.$tp['name'];
            return $output;
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
        private $popover_html;
        private $profile;

        protected function __construct() { }

        public static function CreateTournamentDTO($tournament_id, $fantasy)
        {
            $tournament_dto = new TournamentDTO();
            $tournament_dto->tournament_id = $tournament_id;
            $tournament_dto->fantasy = $fantasy;
            return $tournament_dto;
        }

        public static function CreateSoccerTournamentDTO($body_html, $modal_html, $popover_html, $profile)
        {
            $tournament_dto = new TournamentDTO();
            $tournament_dto->body_html = $body_html;
            $tournament_dto->modal_html = $modal_html;
            $tournament_dto->popover_html = $popover_html;
            $tournament_dto->profile = $profile;
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
