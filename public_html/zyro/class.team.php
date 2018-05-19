<?php
    include_once('config.php');
    class Team {
        private $id;
        private $name;
        private $code;
        private $group_name;
        private $group_order;
        private $parent_group_name;
        private $parent_group_long_name;
        private $parent_group_order;
        private $flag_filename;
        private $logo_filename;
        private $match_play;
        private $win;
        private $draw;
        private $loss;
        private $goal_for;
        private $goal_against;
        private $goal_diff;
        private $point;
        private $scenarios;

        protected function __construct(){ }

        public static function CreateSoccerTeam($id, $name, $code, $group_name, $group_order, $flag_filename) {
            $t = new Team();
            $t->id = $id;
            $t->name = $name;
            $t->code = $code;
            $t->group_name = $group_name;
            $t->group_order = $group_order;
            $t->flag_filename = $flag_filename;
            $t->match_play = 0;
            $t->win = 0;
            $t->draw = 0;
            $t->loss = 0;
            $t->goal_for = 0;
            $t->goal_against = 0;
            $t->goal_diff = 0;
            $t->point = 0;
            return $t;
        }

        public static function NewSoccerTeam($id, $name, $code, $group_name, $group_order,
                                             $match_play, $win, $draw, $loss, $goal_for, $goal_against, $goal_diff, $point) {
            $t = new Team();
            $t->id = $id;
            $t->name = $name;
            $t->code = $code;
            $t->group_name = $group_name;
            $t->group_order = $group_order;
            $t->match_play = $match_play;
            $t->win = $win;
            $t->draw = $draw;
            $t->loss = $loss;
            $t->goal_for = $goal_for;
            $t->goal_against = $goal_against;
            $t->goal_diff = $goal_diff;
            $t->point = $point;
            return $t;
        }

        public static function CreateFootballTeam(
            $name, $group_name, $group_order,
            $parent_group_long_name, $parent_group_order, $logo_filename)
        {
            $t = new Team();
            $t->name = $name;
            $t->group_name = $group_name;
            $t->group_order = $group_order;
            $t->parent_group_long_name = $parent_group_long_name;
            $t->parent_group_order = $parent_group_order;
            $t->logo_filename = $logo_filename;
            return $t;
        }

        public static function getSoccerTeams($tournament_dto) {

            $sql = Team::getSoccerTeamSql($tournament_dto->getTournamentId());

            return self::getSoccerTeamDTO($sql);
        }

        public static function getAllTimeSoccerTeams() {

            $sql = Team::getAllTimeSoccerTeamSql();

            return self::getAllTimeSoccerTeamDTO($sql);
        }

        public static function getFootballTeams($tournament_dto) {

            $sql = Team::getFootballTeamSql($tournament_dto->getTournamentId());

            return self::getFootballTeamDTO($sql);
        }

        public static function getSoccerTeamDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $second_round_teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                return TeamDTO::CreateSoccerTeamDTO(null, null, $count, $output);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam($row['team_id'], $row['name'], $row['code'],
                        $row['group_name'], $row['group_order'], $row['flag_filename']);
                    array_push($teams, $team);
                    $second_round_team = Team::CreateSoccerTeam($row['team_id'], $row['name'], $row['code'],
                        null, $row['group_order'], $row['flag_filename']);
                    array_push($second_round_teams, $second_round_team);
                }
                return TeamDTO::CreateSoccerTeamDTO($teams, $second_round_teams, $count, $output);
            }
        }

        public static function getAllTimeSoccerTeamDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                return TeamDTO::CreateSoccerTeamDTO(null, null, $count, $output);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam($row['team_id'], $row['name'], $row['code'],
                        '', '', $row['flag_filename']);
                    array_push($teams, $team);
                }
                return TeamDTO::CreateSoccerTeamDTO($teams, null, $count, $output);
            }
        }

        public static function getFootballTeamDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                return TeamDTO::CreateFootballTeamDTO(null, $count, $output);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $team = Team::CreateFootballTeam($row['name'], $row['group_name'], $row['group_order'],
                        $row['parent_group_long_name'], $row['parent_group_order'], $row['logo_filename']);
                    array_push($teams, $team);
                }
                return TeamDTO::CreateFootballTeamDTO($teams, $count, $output);
            }
        }

        public static function getSoccerHtml($team_dto) {
            $teams = Team::getTeamArrayByGroup($team_dto);
            $output = '';
            foreach ($teams as $group_name => $_teams) {
                $output .= '<div class="col-sm-12 margin-top-sm">
                            <span class="col-sm-2 h2-ff2">Group '.$group_name.'</span>
                            <span class="col-sm-2 wb-stl-heading4 margin-left-md" style="margin-top:15px;">
                                <a class="link-modal" data-toggle="modal" data-target="#group'.$group_name.'MatchesModal">Matches</a>
                            </span>
                        </div>
                        <div class="col-sm-12 box-xl">
                            <div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md font-bold">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-1">MP</div>
                                <div class="col-sm-1">W</div>
                                <div class="col-sm-1">D</div>
                                <div class="col-sm-1">L</div>
                                <div class="col-sm-1">GF</div>
                                <div class="col-sm-1">GA</div>
                                <div class="col-sm-1">+/-</div>
                                <div class="col-sm-1">Pts</div>
                            </div>';
                foreach ($_teams as $group_order => $_team) {
                    $goal_diff = $_team->getGoalDiff();
                    if ($_team->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;
                    $output .= '<div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md">
                                <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'"></div>
                                <div class="col-sm-3" style="padding-top: 3px;">'.$_team->getName().'</div>
                                <div class="col-sm-1">'.$_team->getMatchPlay().'</div>
                                <div class="col-sm-1">'.$_team->getWin().'</div>
                                <div class="col-sm-1">'.$_team->getDraw().'</div>
                                <div class="col-sm-1">'.$_team->getLoss().'</div>
                                <div class="col-sm-1">'.$_team->getGoalFor().'</div>
                                <div class="col-sm-1">'.$_team->getGoalAgainst().'</div>
                                <div class="col-sm-1">'.$goal_diff.'</div>
                                <div class="col-sm-1">'.$_team->getPoint().'</div>
                            </div>';
                }
                $output .= '</div>';
            }
            return $output;
        }

        public static function getSoccerModalHtml($team_dto) {
            $teams = Team::getTeamArrayByGroup($team_dto);
            $output = '';
            foreach ($teams as $group_name => $_teams) {
                $output .= '<div class="modal fade" id="group'.$group_name.'StandingModal" tabindex="-1" role="dialog" aria-labelledby="group'.$group_name.'StandingModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="width:800px;">
                        <div class="modal-content">
                            <div class="col-sm-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="modal-X" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-header col-sm-12 padding-lr-lg" style="border-bottom:none;">
                                <div class="col-sm-12 h3-ff3 border-bottom-gray2" id="group'.$group_name.'StandingModalLabel">Group '.$group_name.'</div>
                            </div>
                            <div class="modal-body col-sm-12 padding-lr-lg" id="group'.$group_name.'StandingModalBody">
                                <div class="col-sm-12 h3-ff3 row padding-tb-md font-bold">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-1">MP</div>
                                    <div class="col-sm-1">W</div>
                                    <div class="col-sm-1">D</div>
                                    <div class="col-sm-1">L</div>
                                    <div class="col-sm-1">GF</div>
                                    <div class="col-sm-1">GA</div>
                                    <div class="col-sm-1">+/-</div>
                                    <div class="col-sm-1">Pts</div>
                                </div>';
                foreach ($_teams as $group_order => $_team) {
                    $goal_diff = $_team->getGoalDiff();
                    if ($_team->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;
                    $output .=     '<div class="col-sm-12 h3-ff3 row padding-tb-md">
                                    <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'"></div>
                                    <div class="col-sm-3" style="padding-top: 3px;">'.$_team->getName().'</div>
                                    <div class="col-sm-1">'.$_team->getMatchPlay().'</div>
                                    <div class="col-sm-1">'.$_team->getWin().'</div>
                                    <div class="col-sm-1">'.$_team->getDraw().'</div>
                                    <div class="col-sm-1">'.$_team->getLoss().'</div>
                                    <div class="col-sm-1">'.$_team->getGoalFor().'</div>
                                    <div class="col-sm-1">'.$_team->getGoalAgainst().'</div>
                                    <div class="col-sm-1">'.$goal_diff.'</div>
                                    <div class="col-sm-1">'.$_team->getPoint().'</div>
                                </div>';
                }
                $output .= '
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="modal-close" aria-hidden="true">Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            return $output;
        }

        public static function getSoccerPopoverHtml($team_dto) {
            $teams = $team_dto->getTeams();
            $output = '';
            for ($i = 0; $i < 32; $i++) {
                $scenarios = $teams[$i]->getScenarios();
                $output .= '
                    <div id="popover-content-'.$teams[$i]->getCode().'" class="hide">
                        <ul class="list-group">';
                for ($j = 0; $j < sizeof($scenarios); $j++) {
                    $team1Status = 'green';
                    if ($scenarios[$j]->getTeam1Status() == 'Eliminated') $team1Status = 'red';
                    $striped_row = '';
                    if ($j >= 3 && $j <= 5) $striped_row = 'scenario-striped';
                    $output .= '<li class="list-group-item '.$striped_row.'"><span class="'.$team1Status.'"><b>'.$scenarios[$j]->getTeam1Status().'</b></span> if <b>'.$scenarios[$j]->getTeam1().'</b>-'.
                        $scenarios[$j]->getTeam2().' '.$scenarios[$j]->getMatch1ResultGoalFor().'-'.$scenarios[$j]->getMatch1ResultGoalAgainst().
                        ' and '.$scenarios[$j]->getTeam3().'-'.$scenarios[$j]->getTeam4().' '.$scenarios[$j]->getMatch2ResultGoalFor().'-'.$scenarios[$j]->getMatch2ResultGoalAgainst().
                        '<br>'.$scenarios[$j]->getTeam1().':'.$scenarios[$j]->getTeam1Result().':'.$scenarios[$j]->getTeam1Point().':'.$scenarios[$j]->getTeam1GoalDiff().':'.$scenarios[$j]->getTeam1GoalFor().':'.$scenarios[$j]->getTeam1MatchResult().' '.
                        $scenarios[$j]->getTeam2().':'.$scenarios[$j]->getTeam2Result().':'.$scenarios[$j]->getTeam2Point().':'.$scenarios[$j]->getTeam2GoalDiff().':'.$scenarios[$j]->getTeam2GoalFor().':'.$scenarios[$j]->getTeam2MatchResult().' '.
                        $scenarios[$j]->getTeam3().':'.$scenarios[$j]->getTeam3Result().':'.$scenarios[$j]->getTeam3Point().':'.$scenarios[$j]->getTeam3GoalDiff().':'.$scenarios[$j]->getTeam3GoalFor().':'.$scenarios[$j]->getTeam3MatchResult().' '.
                        $scenarios[$j]->getTeam4().':'.$scenarios[$j]->getTeam4Result().':'.$scenarios[$j]->getTeam4Point().':'.$scenarios[$j]->getTeam4GoalDiff().':'.$scenarios[$j]->getTeam4GoalFor().':'.$scenarios[$j]->getTeam4MatchResult().' '.
                        '<br>'.$scenarios[$j]->getNote().'</li>';
                };
                $output .= '</ul>
                    </div>';
            }
            return $output;
        }

        public static function getSoccerRankingHtml($team_dto, $header = 'Tournament Rankings') {
            $teams = $team_dto->getTeams();
            $output = '<div class="col-sm-12 h2-ff2 margin-top-lg">'.$header.'</div>
                            <div class="col-sm-12 box-xl">
                                <div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md font-bold">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-1">MP</div>
                                    <div class="col-sm-1">W</div>
                                    <div class="col-sm-1">D</div>
                                    <div class="col-sm-1">L</div>
                                    <div class="col-sm-1">GF</div>
                                    <div class="col-sm-1">GA</div>
                                    <div class="col-sm-1">+/-</div>
                                    <div class="col-sm-1">Pts</div>
                                </div>';
            $tmp_match_play = $teams[0]->getMatchPlay();
            $striped_row = 'ranking-striped';
            for ($i = 0; $i < sizeof($teams); $i++) {
                $goal_diff = $teams[$i]->getGoalDiff();
                if ($teams[$i]->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;
                if ($tmp_match_play != $teams[$i]->getMatchPlay()) {
                    if ($striped_row == 'ranking-striped') {
                        $striped_row = '';
                    } else {
                        $striped_row = 'ranking-striped';
                    }
                    $tmp_match_play = $teams[$i]->getMatchPlay();
                }
                if ($header == 'All Time Rankings') $striped_row = '';
                    $output .= '<div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md '.$striped_row.'">
                                    <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$teams[$i]->getFlagFilename().'"></div>
                                    <div class="col-sm-3" style="padding-top: 3px;">'.$teams[$i]->getName().'</div>
                                    <div class="col-sm-1">'.$teams[$i]->getMatchPlay().'</div>
                                    <div class="col-sm-1">'.$teams[$i]->getWin().'</div>
                                    <div class="col-sm-1">'.$teams[$i]->getDraw().'</div>
                                    <div class="col-sm-1">'.$teams[$i]->getLoss().'</div>
                                    <div class="col-sm-1">'.$teams[$i]->getGoalFor().'</div>
                                    <div class="col-sm-1">'.$teams[$i]->getGoalAgainst().'</div>
                                    <div class="col-sm-1">'.$goal_diff.'</div>
                                    <div class="col-sm-1">'.$teams[$i]->getPoint().'</div>
                                </div>';
            }
            $output .= '</div>';
            return $output;
        }

        public static function getFootballHtml($team_dto) {
            $teams = Team::getFootballTeamArrayByConfDiv($team_dto);
            $output = '';
            foreach ($teams as $parent_group_long_name => $_conferences) {
                $output .= '<div class="col-sm-12 h2-ff1 margin-top-md">'.$parent_group_long_name.'</div>';
                foreach ($_conferences as $group_name => $_divisions) {
                    $output .= '<div class="col-sm-12 h2-ff2 margin-top-sm">'.$group_name.'</div>
                            <div class="col-sm-12 box-xl">
                                <div class="col-sm-12 no-padding-lr h3-ff4 row padding-tb-sm font-bold">
                                    <div class="col-sm-3 no-padding-lr"></div>
                                    <div class="col-sm-2 no-padding-lr">
                                        <div class="col-sm-4 no-padding-lr">W</div>
                                        <div class="col-sm-4 no-padding-lr">L</div>
                                        <div class="col-sm-4 no-padding-lr">T</div>
                                    </div>
                                    <div class="col-sm-5 no-padding-lr">
                                        <div class="col-sm-3 no-padding-lr">Home</div>
                                        <div class="col-sm-3 no-padding-lr">Road</div>
                                        <div class="col-sm-3 no-padding-lr">Div</div>
                                        <div class="col-sm-3 no-padding-lr">Conf</div>
                                    </div>
                                    <div class="col-sm-2 no-padding-lr">
                                        <div class="col-sm-6 no-padding-lr">Streak</div>
                                        <div class="col-sm-6 no-padding-lr">Last 5</div>
                                    </div>
                                </div>';
                    foreach ($_divisions as $group_order => $_team) {
                        $output .= '<div class="col-sm-12 no-padding-lr h3-ff4 row padding-tb-sm">
                                    <div class="col-sm-3 no-padding-lr">
                                        <div class="col-sm-2 no-padding-lr">
                                            <img src="/images/nfl_logos/'.$_team->getLogoFileName().'" style="width:40px;" />
                                        </div>
                                        <div class="col-sm-10 no-padding-lr" style="padding-top:8px;">'.$_team->getName().'</div>
                                    </div>
                                    <div class="col-sm-2 no-padding-lr">
                                    </div>
                                    <div class="col-sm-5 no-padding-lr">
                                    </div>
                                    <div class="col-sm-2 no-padding-lr">
                                    </div>
                                </div>';
                    }
                    $output .= '</div>';
                }
            }
            return $output;
        }

        public static function getSoccerTeamSql($tournament_id) {
            $sql = 'SELECT UCASE(t.name) AS name, team_id, 
                        group_id, UCASE(g.name) AS group_name, group_order, 
                        n.flag_filename, n.code, tt.tournament_id 
                    FROM team_tournament tt 
                    LEFT JOIN team t ON t.id = tt.team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id  
                    LEFT JOIN nation n ON n.id = t.nation_id 
                    WHERE tt.tournament_id = '.$tournament_id.' 
                    ORDER BY group_id, group_order';
            return $sql;
        }

        public static function getAllTimeSoccerTeamSql() {
            $sql = 'SELECT DISTINCT UCASE(t.name) AS name, team_id, 
                        n.flag_filename, n.code 
                    FROM team_tournament tt  
                    LEFT JOIN tournament tou ON tou.id = tt.tournament_id 
                    LEFT JOIN team t ON t.id = tt.team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id  
                    LEFT JOIN nation n ON n.id = t.nation_id 
                    WHERE tou.tournament_type_id = 1
                    AND tt.tournament_id <> 1';
            return $sql;
        }

        public static function getFootballTeamSql($tournament_id) {
            $sql = 'SELECT t.name AS name, tt.team_id, 
                        group_id, g.name AS group_name, group_order, 
                        parent_group_id, pg.name AS parent_group_name, pg.long_name AS parent_group_long_name, parent_group_order, 
                        tl.logo_filename, tt.tournament_id 
                    FROM team_tournament tt 
                    LEFT JOIN team t ON t.id = tt.team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id 
                    LEFT JOIN `group` pg ON pg.id = tt.parent_group_id 
                    LEFT JOIN team_logo tl ON tl.team_id = t.id 
                    WHERE tt.tournament_id = '.$tournament_id.' 
                    ORDER BY parent_group_name, group_id, group_order';
            return $sql;
        }

        public static function getTeamArrayById($team_dto) {
            $result = array();
            for ($i = 0; $i < sizeof($team_dto->getTeams()); $i++) {
                $result[$team_dto->getTeams()[$i]->getId()] = $team_dto->getTeams()[$i];
            }
            return $result;
        }

        public static function getTeamArrayByName($team_dto) {
            $teams = $team_dto->getTeams();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getName()] = $teams[$i];
            }
            return $result;
        }

        public static function getSecondRoundTeamArrayByName($team_dto) {
            $teams = $team_dto->getSecondRoundTeams();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getName()] = $teams[$i];
            }
            return $result;
        }

        public static function getTeamArrayByGroup($team_dto) {
            $teams = $team_dto->getTeams();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getGroupName()][$teams[$i]->getGroupOrder()] = $teams[$i];
            }
            $second_round_teams = $team_dto->getSecondRoundTeams();
            for ($i = 0; $i < sizeof($second_round_teams); $i++) {
                $result[$second_round_teams[$i]->getGroupName()][$second_round_teams[$i]->getName()] = $second_round_teams[$i];
            }
            return $result;
        }

        public static function getFootballTeamArrayByConfDiv($team_dto) {
            $teams = $team_dto->getTeams();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getParentGroupLongName()]
                        [$teams[$i]->getParentGroupName().' '.$teams[$i]->getGroupName()]
                        [$teams[$i]->getGroupOrder()] = $teams[$i];
            }
            return $result;
        }

        public static function copySoccerTeam($team) {
            $t = new Team();
            $t->id = $team->getId();
            $t->name = $team->getName();
            $t->code = $team->getCode();
            $t->group_name = $team->getGroupName();
            $t->group_order = $team->getGroupOrder();
            $t->flag_filename = $team->getFlagFilename();
            $t->match_play = $team->getMatchPlay();
            $t->win = $team->getWin();
            $t->draw = $team->getDraw();
            $t->loss = $team->getLoss();
            $t->goal_for = $team->getGoalFor();
            $t->goal_against = $team->getGoalAgainst();
            $t->goal_diff = $team->getGoalDiff();
            $t->point = $team->getPoint();
            return $t;
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
        public function getCode()
        {
            return $this->code;
        }

        /**
         * @param mixed $code
         */
        public function setCode($code)
        {
            $this->code = $code;
        }

        /**
         * @return mixed
         */
        public function getGroupName()
        {
            return $this->group_name;
        }

        /**
         * @param mixed $group_name
         */
        public function setGroupName($group_name)
        {
            $this->group_name = $group_name;
        }

        /**
         * @return mixed
         */
        public function getGroupOrder()
        {
            return $this->group_order;
        }

        /**
         * @param mixed $group_order
         */
        public function setGroupOrder($group_order)
        {
            $this->group_order = $group_order;
        }

        /**
         * @return mixed
         */
        public function getParentGroupName()
        {
            return $this->parent_group_name;
        }

        /**
         * @param mixed $parent_group_name
         */
        public function setParentGroupName($parent_group_name)
        {
            $this->parent_group_name = $parent_group_name;
        }

        /**
         * @return mixed
         */
        public function getParentGroupLongName()
        {
            return $this->parent_group_long_name;
        }

        /**
         * @param mixed $parent_group_long_name
         */
        public function setParentGroupLongName($parent_group_long_name)
        {
            $this->parent_group_long_name = $parent_group_long_name;
        }

        /**
         * @return mixed
         */
        public function getParentGroupOrder()
        {
            return $this->parent_group_order;
        }

        /**
         * @param mixed $parent_group_order
         */
        public function setParentGroupOrder($parent_group_order)
        {
            $this->parent_group_order = $parent_group_order;
        }

        /**
         * @return mixed
         */
        public function getFlagFilename()
        {
            return $this->flag_filename;
        }

        /**
         * @param mixed $flag_filename
         */
        public function setFlagFilename($flag_filename)
        {
            $this->flag_filename = $flag_filename;
        }

        /**
         * @return string
         */
        public function getLogoFilename()
        {
            return $this->logo_filename;
        }

        /**
         * @param string $logo_filename
         */
        public function setLogoFilename($logo_filename)
        {
            $this->logo_filename = $logo_filename;
        }

        /**
         * @return mixed
         */
        public function getMatchPlay()
        {
            return $this->match_play;
        }

        /**
         * @param mixed $match_play
         */
        public function setMatchPlay($match_play)
        {
            $this->match_play = $match_play;
        }

        /**
         * @return mixed
         */
        public function getWin()
        {
            return $this->win;
        }

        /**
         * @param mixed $win
         */
        public function setWin($win)
        {
            $this->win = $win;
        }

        /**
         * @return mixed
         */
        public function getDraw()
        {
            return $this->draw;
        }

        /**
         * @param mixed $draw
         */
        public function setDraw($draw)
        {
            $this->draw = $draw;
        }

        /**
         * @return mixed
         */
        public function getLoss()
        {
            return $this->loss;
        }

        /**
         * @param mixed $loss
         */
        public function setLoss($loss)
        {
            $this->loss = $loss;
        }

        /**
         * @return mixed
         */
        public function getGoalFor()
        {
            return $this->goal_for;
        }

        /**
         * @param mixed $goal_for
         */
        public function setGoalFor($goal_for)
        {
            $this->goal_for = $goal_for;
        }

        /**
         * @return mixed
         */
        public function getGoalAgainst()
        {
            return $this->goal_against;
        }

        /**
         * @param mixed $goal_against
         */
        public function setGoalAgainst($goal_against)
        {
            $this->goal_against = $goal_against;
        }

        /**
         * @return mixed
         */
        public function getGoalDiff()
        {
            return $this->goal_diff;
        }

        /**
         * @param mixed $goal_diff
         */
        public function setGoalDiff($goal_diff)
        {
            $this->goal_diff = $goal_diff;
        }

        /**
         * @return mixed
         */
        public function getPoint()
        {
            return $this->point;
        }

        /**
         * @param mixed $point
         */
        public function setPoint($point)
        {
            $this->point = $point;
        }

        /**
         * @return mixed
         */
        public function getScenarios()
        {
            return $this->scenarios;
        }

        /**
         * @param mixed $scenarios
         */
        public function setScenarios($scenarios)
        {
            $this->scenarios = $scenarios;
        }
    }

    class TeamDTO {
        private $teams;
        private $second_round_teams;
        private $count;
        private $html;

        protected function __construct(){ }

        public static function CreateSoccerTeamDTO($teams, $second_round_teams, $count, $html) {
            $team_dto = new TeamDTO();
            $team_dto->teams = $teams;
            $team_dto->second_round_teams = $second_round_teams;
            $team_dto->count = $count;
            $team_dto->html = $html;
            return $team_dto;
        }

        public static function CreateFootballTeamDTO($teams, $count, $html) {
            $team_dto = new TeamDTO();
            $team_dto->teams = $teams;
            $team_dto->count = $count;
            $team_dto->html = $html;
            return $team_dto;
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
        public function getCount()
        {
            return $this->count;
        }

        /**
         * @param mixed $count
         */
        public function setCount($count)
        {
            $this->count = $count;
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

    class Scenario {
        private $team1;
        private $team1_result;
        private $team1_point;
        private $team1_goal_diff;
        private $team1_goal_for;
        private $team1_goal_against;
        private $team1_status;
        private $team1_match_result;
        private $team2;
        private $team2_result;
        private $team2_point;
        private $team2_goal_diff;
        private $team2_goal_for;
        private $team2_goal_against;
        private $team2_status;
        private $team2_match_result;
        private $team3;
        private $team3_result;
        private $team3_point;
        private $team3_goal_diff;
        private $team3_goal_for;
        private $team3_goal_against;
        private $team3_status;
        private $team3_match_result;
        private $team4;
        private $team4_result;
        private $team4_point;
        private $team4_goal_diff;
        private $team4_goal_for;
        private $team4_goal_against;
        private $team4_status;
        private $team4_match_result;
        private $match1_result_goal_for;
        private $match1_result_goal_against;
        private $match2_result_goal_for;
        private $match2_result_goal_against;
        private $note;

        protected function __construct(){ }

        public static function CreateScenario($team1, $team1_result, $team1_point, $team1_goal_diff, $team1_goal_for, $match1_result_goal_for, $match1_result_goal_against, $team1_status, $team1_match_result,
                                              $team2, $team2_result, $team2_point, $team2_goal_diff, $team2_goal_for, $team2_status, $team2_match_result,
                                              $team3, $team3_result, $team3_point, $team3_goal_diff, $team3_goal_for, $match2_result_goal_for, $match2_result_goal_against, $team3_status, $team3_match_result,
                                              $team4, $team4_result, $team4_point, $team4_goal_diff, $team4_goal_for, $team4_status, $team4_match_result, $note) {
            $s = new Scenario();
            $s->team1 = $team1;
            $s->team1_result = $team1_result;
            $s->team1_point = $team1_point;
            $s->team1_goal_diff = $team1_goal_diff;
            $s->team1_goal_for = $team1_goal_for;
            $s->match1_result_goal_for = $match1_result_goal_for;
            $s->match1_result_goal_against = $match1_result_goal_against;
            $s->team1_status = $team1_status;
            $s->team1_match_result = $team1_match_result;
            $s->team2 = $team2;
            $s->team2_result = $team2_result;
            $s->team2_point = $team2_point;
            $s->team2_goal_diff = $team2_goal_diff;
            $s->team2_goal_for = $team2_goal_for;
            $s->team2_status = $team2_status;
            $s->team2_match_result = $team2_match_result;
            $s->team3 = $team3;
            $s->team3_result = $team3_result;
            $s->team3_point = $team3_point;
            $s->team3_goal_diff = $team3_goal_diff;
            $s->team3_goal_for = $team3_goal_for;
            $s->match2_result_goal_for = $match2_result_goal_for;
            $s->match2_result_goal_against = $match2_result_goal_against;
            $s->team3_status = $team3_status;
            $s->team3_match_result = $team3_match_result;
            $s->team4 = $team4;
            $s->team4_result = $team4_result;
            $s->team4_point = $team4_point;
            $s->team4_goal_diff = $team4_goal_diff;
            $s->team4_goal_for = $team4_goal_for;
            $s->team4_status = $team4_status;
            $s->team4_match_result = $team4_match_result;
            $s->note = $note;
            return $s;
        }

        /**
         * @return mixed
         */
        public function getTeam1()
        {
            return $this->team1;
        }

        /**
         * @param mixed $team1
         */
        public function setTeam1($team1)
        {
            $this->team1 = $team1;
        }

        /**
         * @return mixed
         */
        public function getTeam1Result()
        {
            return $this->team1_result;
        }

        /**
         * @param mixed $team1_result
         */
        public function setTeam1Result($team1_result)
        {
            $this->team1_result = $team1_result;
        }

        /**
         * @return mixed
         */
        public function getTeam1Point()
        {
            return $this->team1_point;
        }

        /**
         * @param mixed $team1_point
         */
        public function setTeam1Point($team1_point)
        {
            $this->team1_point = $team1_point;
        }

        /**
         * @return mixed
         */
        public function getTeam1GoalDiff()
        {
            return $this->team1_goal_diff;
        }

        /**
         * @param mixed $team1_goal_diff
         */
        public function setTeam1GoalDiff($team1_goal_diff)
        {
            $this->team1_goal_diff = $team1_goal_diff;
        }

        /**
         * @return mixed
         */
        public function getTeam1GoalFor()
        {
            return $this->team1_goal_for;
        }

        /**
         * @param mixed $team1_goal_for
         */
        public function setTeam1GoalFor($team1_goal_for)
        {
            $this->team1_goal_for = $team1_goal_for;
        }

        /**
         * @return mixed
         */
        public function getTeam1GoalAgainst()
        {
            return $this->team1_goal_against;
        }

        /**
         * @param mixed $team1_goal_against
         */
        public function setTeam1GoalAgainst($team1_goal_against)
        {
            $this->team1_goal_against = $team1_goal_against;
        }

        /**
         * @return mixed
         */
        public function getTeam1Status()
        {
            return $this->team1_status;
        }

        /**
         * @param mixed $team1_status
         */
        public function setTeam1Status($team1_status)
        {
            $this->team1_status = $team1_status;
        }

        /**
         * @return mixed
         */
        public function getTeam1MatchResult()
        {
            return $this->team1_match_result;
        }

        /**
         * @param mixed $team1_match_result
         */
        public function setTeam1MatchResult($team1_match_result)
        {
            $this->team1_match_result = $team1_match_result;
        }

        /**
         * @return mixed
         */
        public function getTeam2()
        {
            return $this->team2;
        }

        /**
         * @param mixed $team2
         */
        public function setTeam2($team2)
        {
            $this->team2 = $team2;
        }

        /**
         * @return mixed
         */
        public function getTeam2Result()
        {
            return $this->team2_result;
        }

        /**
         * @param mixed $team2_result
         */
        public function setTeam2Result($team2_result)
        {
            $this->team2_result = $team2_result;
        }

        /**
         * @return mixed
         */
        public function getTeam2Point()
        {
            return $this->team2_point;
        }

        /**
         * @param mixed $team2_point
         */
        public function setTeam2Point($team2_point)
        {
            $this->team2_point = $team2_point;
        }

        /**
         * @return mixed
         */
        public function getTeam2GoalDiff()
        {
            return $this->team2_goal_diff;
        }

        /**
         * @param mixed $team2_goal_diff
         */
        public function setTeam2GoalDiff($team2_goal_diff)
        {
            $this->team2_goal_diff = $team2_goal_diff;
        }

        /**
         * @return mixed
         */
        public function getTeam2GoalFor()
        {
            return $this->team2_goal_for;
        }

        /**
         * @param mixed $team2_goal_for
         */
        public function setTeam2GoalFor($team2_goal_for)
        {
            $this->team2_goal_for = $team2_goal_for;
        }

        /**
         * @return mixed
         */
        public function getTeam2GoalAgainst()
        {
            return $this->team2_goal_against;
        }

        /**
         * @param mixed $team2_goal_against
         */
        public function setTeam2GoalAgainst($team2_goal_against)
        {
            $this->team2_goal_against = $team2_goal_against;
        }

        /**
         * @return mixed
         */
        public function getTeam2Status()
        {
            return $this->team2_status;
        }

        /**
         * @param mixed $team2_status
         */
        public function setTeam2Status($team2_status)
        {
            $this->team2_status = $team2_status;
        }

        /**
         * @return mixed
         */
        public function getTeam2MatchResult()
        {
            return $this->team2_match_result;
        }

        /**
         * @param mixed $team2_match_result
         */
        public function setTeam2MatchResult($team2_match_result)
        {
            $this->team2_match_result = $team2_match_result;
        }

        /**
         * @return mixed
         */
        public function getTeam3()
        {
            return $this->team3;
        }

        /**
         * @param mixed $team3
         */
        public function setTeam3($team3)
        {
            $this->team3 = $team3;
        }

        /**
         * @return mixed
         */
        public function getTeam3Result()
        {
            return $this->team3_result;
        }

        /**
         * @param mixed $team3_result
         */
        public function setTeam3Result($team3_result)
        {
            $this->team3_result = $team3_result;
        }

        /**
         * @return mixed
         */
        public function getTeam3Point()
        {
            return $this->team3_point;
        }

        /**
         * @param mixed $team3_point
         */
        public function setTeam3Point($team3_point)
        {
            $this->team3_point = $team3_point;
        }

        /**
         * @return mixed
         */
        public function getTeam3GoalDiff()
        {
            return $this->team3_goal_diff;
        }

        /**
         * @param mixed $team3_goal_diff
         */
        public function setTeam3GoalDiff($team3_goal_diff)
        {
            $this->team3_goal_diff = $team3_goal_diff;
        }

        /**
         * @return mixed
         */
        public function getTeam3GoalFor()
        {
            return $this->team3_goal_for;
        }

        /**
         * @param mixed $team3_goal_for
         */
        public function setTeam3GoalFor($team3_goal_for)
        {
            $this->team3_goal_for = $team3_goal_for;
        }

        /**
         * @return mixed
         */
        public function getTeam3GoalAgainst()
        {
            return $this->team3_goal_against;
        }

        /**
         * @param mixed $team3_goal_against
         */
        public function setTeam3GoalAgainst($team3_goal_against)
        {
            $this->team3_goal_against = $team3_goal_against;
        }

        /**
         * @return mixed
         */
        public function getTeam3Status()
        {
            return $this->team3_status;
        }

        /**
         * @param mixed $team3_status
         */
        public function setTeam3Status($team3_status)
        {
            $this->team3_status = $team3_status;
        }

        /**
         * @return mixed
         */
        public function getTeam3MatchResult()
        {
            return $this->team3_match_result;
        }

        /**
         * @param mixed $team3_match_result
         */
        public function setTeam3MatchResult($team3_match_result)
        {
            $this->team3_match_result = $team3_match_result;
        }

        /**
         * @return mixed
         */
        public function getTeam4()
        {
            return $this->team4;
        }

        /**
         * @param mixed $team4
         */
        public function setTeam4($team4)
        {
            $this->team4 = $team4;
        }

        /**
         * @return mixed
         */
        public function getTeam4Result()
        {
            return $this->team4_result;
        }

        /**
         * @param mixed $team4_result
         */
        public function setTeam4Result($team4_result)
        {
            $this->team4_result = $team4_result;
        }

        /**
         * @return mixed
         */
        public function getTeam4Point()
        {
            return $this->team4_point;
        }

        /**
         * @param mixed $team4_point
         */
        public function setTeam4Point($team4_point)
        {
            $this->team4_point = $team4_point;
        }

        /**
         * @return mixed
         */
        public function getTeam4GoalDiff()
        {
            return $this->team4_goal_diff;
        }

        /**
         * @param mixed $team4_goal_diff
         */
        public function setTeam4GoalDiff($team4_goal_diff)
        {
            $this->team4_goal_diff = $team4_goal_diff;
        }

        /**
         * @return mixed
         */
        public function getTeam4GoalFor()
        {
            return $this->team4_goal_for;
        }

        /**
         * @param mixed $team4_goal_for
         */
        public function setTeam4GoalFor($team4_goal_for)
        {
            $this->team4_goal_for = $team4_goal_for;
        }

        /**
         * @return mixed
         */
        public function getTeam4GoalAgainst()
        {
            return $this->team4_goal_against;
        }

        /**
         * @param mixed $team4_goal_against
         */
        public function setTeam4GoalAgainst($team4_goal_against)
        {
            $this->team4_goal_against = $team4_goal_against;
        }

        /**
         * @return mixed
         */
        public function getTeam4Status()
        {
            return $this->team4_status;
        }

        /**
         * @param mixed $team4_status
         */
        public function setTeam4Status($team4_status)
        {
            $this->team4_status = $team4_status;
        }

        /**
         * @return mixed
         */
        public function getTeam4MatchResult()
        {
            return $this->team4_match_result;
        }

        /**
         * @param mixed $team4_match_result
         */
        public function setTeam4MatchResult($team4_match_result)
        {
            $this->team4_match_result = $team4_match_result;
        }

        /**
         * @return mixed
         */
        public function getMatch1ResultGoalFor()
        {
            return $this->match1_result_goal_for;
        }

        /**
         * @param mixed $match1_result_goal_for
         */
        public function setMatch1ResultGoalFor($match1_result_goal_for)
        {
            $this->match1_result_goal_for = $match1_result_goal_for;
        }

        /**
         * @return mixed
         */
        public function getMatch1ResultGoalAgainst()
        {
            return $this->match1_result_goal_against;
        }

        /**
         * @param mixed $match1_result_goal_against
         */
        public function setMatch1ResultGoalAgainst($match1_result_goal_against)
        {
            $this->match1_result_goal_against = $match1_result_goal_against;
        }

        /**
         * @return mixed
         */
        public function getMatch2ResultGoalFor()
        {
            return $this->match2_result_goal_for;
        }

        /**
         * @param mixed $match2_result_goal_for
         */
        public function setMatch2ResultGoalFor($match2_result_goal_for)
        {
            $this->match2_result_goal_for = $match2_result_goal_for;
        }

        /**
         * @return mixed
         */
        public function getMatch2ResultGoalAgainst()
        {
            return $this->match2_result_goal_against;
        }

        /**
         * @param mixed $match2_result_goal_against
         */
        public function setMatch2ResultGoalAgainst($match2_result_goal_against)
        {
            $this->match2_result_goal_against = $match2_result_goal_against;
        }

        /**
         * @return mixed
         */
        public function getNote()
        {
            return $this->note;
        }

        /**
         * @param mixed $note
         */
        public function setNote($note)
        {
            $this->note = $note;
        }
    }
