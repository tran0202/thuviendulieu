<?php
    include_once('config.php');
    class Team {
        private $name;
        private $group_name;
        private $group_order;
        private $parent_group_name;
        private $parent_group_long_name;
        private $parent_group_order;
        private $flag_filename;
        private $logo_filename;

        protected function __construct(){ }

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

        public static function CreateSoccerTeam($name, $group_name, $group_order, $flag_filename) {
            $t = new Team();
            $t->name = $name;
            $t->group_name = $group_name;
            $t->group_order = $group_order;
            $t->flag_filename = $flag_filename;
            return $t;
        }

        public static function getSoccerTeams($tournament_id) {

            $sql = Team::getSoccerTeamSql($tournament_id);

            return self::getSoccerTeamDTO($sql);
        }

        public static function getFootballTeams($tournament_id) {

            $sql = Team::getFootballTeamSql($tournament_id);

            return self::getFootballTeamDTO($sql);
        }

        public static function getSoccerTeamDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();

            if ($count == 0) {
                return TeamDTO::CreateSoccerTeamDTO(null, $count);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam($row['name'], $row['group_name'], $row['group_order'], $row['flag_filename']);
                    $teams[$row['group_name']][$row['group_order']] = $team;
                }
                return TeamDTO::CreateSoccerTeamDTO($teams, $count);
            }
        }

        public static function getFootballTeamDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();

            if ($count == 0) {
                return TeamDTO::CreateFootballTeamDTO(null, $count);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $team = Team::CreateFootballTeam($row['name'], $row['group_name'], $row['group_order'],
                        $row['parent_group_long_name'], $row['parent_group_order'], $row['logo_filename']);
                    $teams[$row['parent_group_long_name']][$row['parent_group_name'].' '.$row['group_name']][$row['group_order']] = $team;
                }
                return TeamDTO::CreateFootballTeamDTO($teams, $count);
            }
        }

        public static function getSoccerTeamSql($tournament_id) {
            $sql = 'SELECT UCASE(t.name) AS name, team_id, 
                    group_id, UCASE(g.name) AS group_name, 
                    group_order, n.flag_filename, tt.tournament_id 
                FROM team_tournament tt 
                LEFT JOIN team t ON t.id = tt.team_id 
                LEFT JOIN `group` g ON g.id = tt.group_id  
                LEFT JOIN nation n ON n.id = t.nation_id 
                WHERE tt.tournament_id = '.$tournament_id.' 
                ORDER BY group_id, group_order';
            return $sql;
        }

        public static function getFootballTeamSql($tournament_id) {
            $sql = 'SELECT t.name AS name, tt.team_id, 
                group_id, g.name AS group_name, group_order, 
                parent_group_id, pg.name AS parent_group_name, 
                pg.long_name AS parent_group_long_name, parent_group_order, tl.logo_filename, tt.tournament_id 
            FROM team_tournament tt 
            LEFT JOIN team t ON t.id = tt.team_id 
            LEFT JOIN `group` g ON g.id = tt.group_id 
            LEFT JOIN `group` pg ON pg.id = tt.parent_group_id 
            LEFT JOIN team_logo tl ON tl.team_id = t.id 
            WHERE tt.tournament_id = '.$tournament_id.' 
            ORDER BY parent_group_name, group_id, group_order';
            return $sql;
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
    }

    class TeamDTO {
        private $teams;
        private $count;

        protected function __construct(){ }

        public static function CreateSoccerTeamDTO($teams, $count) {
            $team_dto = new TeamDTO();
            $team_dto->teams = $teams;
            $team_dto->count = $count;
            return $team_dto;
        }

        public static function CreateFootballTeamDTO($teams, $count) {
            $team_dto = new TeamDTO();
            $team_dto->teams = $teams;
            $team_dto->count = $count;
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
    }
