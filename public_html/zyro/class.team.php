<?php

    class Team {

        const WITHDREW = 63;

        const FLAG = 1;
        const LOGO = 2;
        const CONFEDERATION_LOGO = 3;

        private $id;
        private $name;
        private $l_name;
        private $code;
        private $group_name;
        private $group_order;
        private $parent_id;
        private $parent_name;
        private $parent_group_name;
        private $parent_group_long_name;
        private $parent_group_order;
        private $flag_filename;
        private $logo_filename;
        private $tournament_id;
        private $tournament_name;
        private $tournament_count;
        private $confederation_name;
        private $confederation_logo_filename;
        private $match_play;
        private $win;
        private $draw;
        private $loss;
        private $home_win;
        private $home_tie;
        private $home_loss;
        private $road_win;
        private $road_tie;
        private $road_loss;
        private $div_win;
        private $div_tie;
        private $div_loss;
        private $conf_win;
        private $conf_tie;
        private $conf_loss;
        private $last5_win;
        private $last5_tie;
        private $last5_loss;
        private $streak;
        private $opponents;
        private $common_opponents;
        private $goal_for;
        private $goal_against;
        private $goal_diff;
        private $point;
        private $best_finish;
        private $advanced_second_round;
        private $scenarios;

        protected function __construct() { }

        public static function CreateTeam($id, $name, $l_name, $code, $group_name, $group_order,
            $parent_id, $parent_name, $parent_group_name, $parent_group_long_name, $parent_group_order,
            $flag_filename, $logo_filename, $tournament_id, $tournament_name, $tournament_count,
                                          $confederation_name, $confederation_logo_filename,
            $match_play, $win, $draw, $loss, $home_win, $home_tie, $home_loss, $road_win, $road_tie, $road_loss,
            $div_win, $div_tie, $div_loss, $conf_win, $conf_tie, $conf_loss, $last5_win, $last5_tie, $last5_loss, $streak,
            $opponents, $common_opponents, $goal_for, $goal_against, $goal_diff, $point, $best_finish, $scenarios)
        {
            $t = new Team();
            $t->id = $id;
            $t->name = $name;
            $t->l_name = $l_name;
            $t->code = $code;
            $t->group_name = $group_name;
            $t->group_order = $group_order;
            $t->parent_id = $parent_id;
            $t->parent_name = $parent_name;
            $t->parent_group_name = $parent_group_name;
            $t->parent_group_long_name = $parent_group_long_name;
            $t->parent_group_order = $parent_group_order;
            $t->flag_filename = $flag_filename;
            $t->logo_filename = $logo_filename;
            $t->tournament_id = $tournament_id;
            $t->tournament_name = $tournament_name;
            $t->tournament_count = $tournament_count;
            $t->confederation_name = $confederation_name;
            $t->confederation_logo_filename = $confederation_logo_filename;
            $t->match_play = $match_play;
            $t->win = $win;
            $t->draw = $draw;
            $t->loss = $loss;
            $t->home_win = $home_win;
            $t->home_tie = $home_tie;
            $t->home_loss = $home_loss;
            $t->road_win = $road_win;
            $t->road_tie = $road_tie;
            $t->road_loss = $road_loss;
            $t->div_win = $div_win;
            $t->div_tie = $div_tie;
            $t->div_loss = $div_loss;
            $t->conf_win = $conf_win;
            $t->conf_tie = $conf_tie;
            $t->conf_loss = $conf_loss;
            $t->last5_win = $last5_win;
            $t->last5_tie = $last5_tie;
            $t->last5_loss = $last5_loss;
            $t->streak = $streak;
            $t->opponents = $opponents;
            $t->common_opponents = $common_opponents;
            $t->goal_for = $goal_for;
            $t->goal_against = $goal_against;
            $t->goal_diff = $goal_diff;
            $t->point = $point;
            $t->best_finish = $best_finish;
            $t->scenarios = $scenarios;
            return $t;
        }

        public static function CreateSoccerTeam($id, $name, $l_name, $code, $parent_id, $parent_name,
                $group_name, $group_order, $parent_group_name, $parent_group_long_name, $parent_group_order,
                $flag_filename, $logo_filename, $tournament_id, $tournament_name, $tournament_count, $confederation_name, $confederation_logo_filename) {
            return self::CreateTeam($id, $name, $l_name, $code, $group_name, $group_order,
                $parent_id, $parent_name, $parent_group_name, $parent_group_long_name, $parent_group_order, $flag_filename, $logo_filename,
                $tournament_id, $tournament_name, $tournament_count, $confederation_name, $confederation_logo_filename, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, array(), array(), array(),
                0, 0, 0, 0, null, null);
        }

        public static function CloneSoccerTeam($id, $name, $code, $group_name, $group_order,
                                             $match_play, $win, $draw, $loss, $goal_for, $goal_against, $goal_diff, $point) {
            return self::CreateTeam($id, $name, '', $code, $group_name, $group_order,
                0, '', '', '', 0, '', '',
                0, '', 0, '', '', $match_play, $win, $draw, $loss, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, array(), array(), array(),
                $goal_for, $goal_against, $goal_diff, $point, null, null);
        }

        public static function CreateFootballTeam(
            $id, $name, $group_name, $group_order,
            $parent_group_name, $parent_group_long_name, $parent_group_order, $logo_filename)
        {
            return self::CreateTeam($id, $name, '', '', $group_name, $group_order,
                0, '', $parent_group_name, $parent_group_long_name, $parent_group_order, '', $logo_filename,
                0, '', 0, '', '',0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, array(), array(), array(),
                0, 0, 0, 0, null, null);
        }

        public static function getSoccerTeams($tournament) {

            $sql = self::getSoccerTeamSql($tournament->getTournamentId());
            self::getSoccerTeamDb($tournament, $sql);
        }

        /*
            SELECT UCASE(t.name) AS name, t.name AS l_name, tt.team_id,
                UCASE(t2.name) AS parent_team_name, t2.name AS l_parent_team_name, t.parent_team_id,
                group_id, UCASE(g.name) AS group_name, group_order,
                parent_group_id, pg.name AS parent_group_name, pg.long_name AS parent_group_long_name, parent_group_order,
                tl.logo_filename, n.flag_filename, n.code, tt.tournament_id
            FROM team_tournament tt
            LEFT JOIN team t ON t.id = tt.team_id
            LEFT JOIN team t2 ON t2.id = t.parent_team_id
            LEFT JOIN `group` g ON g.id = tt.group_id
            LEFT JOIN `group` pg ON pg.id = tt.parent_group_id
            LEFT JOIN nation n ON n.id = t.nation_id
            LEFT JOIN team_logo tl ON tl.team_id = t.id
            WHERE tt.tournament_id = 1
            ORDER BY parent_group_name, group_id, group_order
        */

        public static function getSoccerTeamSql($tournament_id) {

            $sql = 'SELECT UCASE(t.name) AS name, t.name AS l_name, tt.team_id, 
                        UCASE(t2.name) AS parent_team_name, t2.name AS l_parent_team_name, t.parent_team_id,
                        group_id, UCASE(g.name) AS group_name, group_order, 
                        parent_group_id, pg.name AS parent_group_name, pg.long_name AS parent_group_long_name, parent_group_order, 
                        tl.logo_filename, n.flag_filename, n.code, tt.tournament_id 
                    FROM team_tournament tt 
                    LEFT JOIN team t ON t.id = tt.team_id  
                    LEFT JOIN team t2 ON t2.id = t.parent_team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id  
                    LEFT JOIN `group` pg ON pg.id = tt.parent_group_id
                    LEFT JOIN nation n ON n.id = t.nation_id  
                    LEFT JOIN team_logo tl ON tl.team_id = t.id 
                    WHERE tt.tournament_id = '.$tournament_id.' 
                    ORDER BY parent_group_name, group_id, group_order';
            return $sql;
        }

        public static function getSoccerTeamDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $second_round_teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam(
                        $row['team_id'], $row['name'], $row['l_name'], $row['code'],
                        $row['parent_team_id'], $row['parent_team_name'],
                        $row['group_name'], $row['group_order'],
                        $row['parent_group_name'], $row['parent_group_long_name'], $row['parent_group_order'],
                        $row['flag_filename'], $row['logo_filename'], $row['tournament_id'], '', 1,
                        '', '');
                    array_push($teams, $team);

                    $second_round_team = Team::CreateSoccerTeam(
                        $row['team_id'], $row['name'], $row['l_name'], $row['code'],
                        $row['parent_team_id'], $row['parent_team_name'],
                        '', $row['group_order'],
                        $row['parent_group_name'], $row['parent_group_long_name'], $row['parent_group_order'],
                        $row['flag_filename'], $row['logo_filename'], $row['tournament_id'], '', 1,
                        '', '');
                    array_push($second_round_teams, $second_round_team);
                }
                $tournament->setTeams($teams);
                $tournament->setSecondRoundTeams($second_round_teams);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getAllTimeSoccerTeams($tournament) {

            $sql = self::getAllTimeSoccerTeamSql($tournament->getTournamentTypeId());
            self::getAllTimeSoccerTeamDb($tournament, $sql);
        }

        /*
            SELECT DISTINCT t.id, UCASE(t.name) AS name, t.parent_team_id, UCASE(t2.name) AS parent_team_name,
                        n.flag_filename, n.code, tc.tournament_count
            FROM team t
            LEFT JOIN team_tournament tt ON tt.team_id = t.id
            LEFT JOIN tournament tou ON tou.id = tt.tournament_id
            LEFT JOIN team t2 ON t2.id = t.parent_team_id
            LEFT JOIN `group` g ON g.id = tt.group_id
            LEFT JOIN nation n ON n.id = t.nation_id
            LEFT JOIN (SELECT team_id, COUNT(team_id) AS tournament_count
                        FROM team_tournament tt2
                        LEFT JOIN tournament tou2 ON tt2.tournament_id = tou2.id
                        WHERE (group_id <> 63 OR group_id is null)
                            AND tou2.tournament_type_id = 1
                        GROUP BY team_id) tc ON tc.team_id = t.id
            WHERE tou.tournament_type_id = 1
            UNION
            SELECT DISTINCT t.id, UCASE(t.name) AS name, null, null,
                n.flag_filename, n.code, tc.tournament_count
            FROM team t
            LEFT OUTER JOIN team t2 ON t2.parent_team_id = t.id
            LEFT JOIN team_tournament tt ON tt.team_id = t2.id
            LEFT JOIN tournament tou ON tou.id = tt.tournament_id
            LEFT JOIN `group` g ON g.id = tt.group_id
            LEFT JOIN nation n ON n.id = t.nation_id
            LEFT JOIN (SELECT team_id, COUNT(team_id) AS tournament_count
                        FROM team_tournament tt2
                        LEFT JOIN tournament tou2 ON tt2.tournament_id = tou2.id
                        WHERE (group_id <> 63 OR group_id is null)
                            AND tou2.tournament_type_id = 1
                        GROUP BY team_id) tc ON tc.team_id = t.id
            WHERE tou.tournament_type_id = 1
         */

        public static function getAllTimeSoccerTeamSql($tournament_type_id) {

            $sql = 'SELECT DISTINCT t.id, UCASE(t.name) AS name, t.parent_team_id, UCASE(t2.name) AS parent_team_name,
                        n.flag_filename, n.code, tc.tournament_count
                    FROM team t
                    LEFT JOIN team_tournament tt ON tt.team_id = t.id
                    LEFT JOIN tournament tou ON tou.id = tt.tournament_id  
                    LEFT JOIN team t2 ON t2.id = t.parent_team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id
                    LEFT JOIN nation n ON n.id = t.nation_id
                    LEFT JOIN (SELECT team_id, COUNT(team_id) AS tournament_count
                                FROM team_tournament tt2
                                LEFT JOIN tournament tou2 ON tt2.tournament_id = tou2.id
                                WHERE (group_id <> '.self::WITHDREW.' OR group_id is null) -- AND tournament_id <> 1
                                    AND tou2.tournament_type_id = '.$tournament_type_id.'
                                GROUP BY team_id) tc ON tc.team_id = t.id
                    WHERE tou.tournament_type_id = '.$tournament_type_id.'  -- AND tt.tournament_id <> 1
                    UNION
                    SELECT DISTINCT t.id, UCASE(t.name) AS name, null, null,
                        n.flag_filename, n.code, tc.tournament_count
                    FROM team t  
                    LEFT OUTER JOIN team t2 ON t2.parent_team_id = t.id
                    LEFT JOIN team_tournament tt ON tt.team_id = t2.id
                    LEFT JOIN tournament tou ON tou.id = tt.tournament_id
                    LEFT JOIN `group` g ON g.id = tt.group_id  
                    LEFT JOIN nation n ON n.id = t.nation_id
                    LEFT JOIN (SELECT team_id, COUNT(team_id) AS tournament_count
                                FROM team_tournament tt2
                                LEFT JOIN tournament tou2 ON tt2.tournament_id = tou2.id
                                WHERE (group_id <> '.self::WITHDREW.' OR group_id is null) -- AND tournament_id <> 1
                                    AND tou2.tournament_type_id = '.$tournament_type_id.'
                                GROUP BY team_id) tc ON tc.team_id = t.id
                    WHERE tou.tournament_type_id = '.$tournament_type_id.'  -- AND tt.tournament_id <> 1';
            return $sql;
        }

        public static function getAllTimeSoccerTeamDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $output = '<!-- Team Count = '.$count.' -->';
            $teams = array();

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam(
                        $row['id'], $row['name'], '', $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        '', '',
                        '', '', 0,
                        $row['flag_filename'], '', 0,'', $row['tournament_count'],
                        '', '');
                    array_push($teams, $team);
                }
                $tournament->setTeams($teams);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getAllTimeSoccerTeamTournaments($tournament) {

            $sql = self::getAllTimeSoccerTeamTournamentSql($tournament->getTournamentTypeId());
            self::getAllTimeSoccerTeamTournamentDb($tournament, $sql);
        }

        /*
            SELECT t.id, UCASE(t.name) AS name,
                t.parent_team_id, UCASE(t2.name) AS parent_team_name, UCASE(g.name) AS group_name,
                n.flag_filename, n2.flag_filename AS parent_flag_filename, n.code, tt.tournament_id, tou.name AS tournament_name,
                g2.name AS confederation_name, g2.group_logo AS confederation_logo_filename
            FROM team t
            LEFT JOIN team_tournament tt ON tt.team_id = t.id
            LEFT JOIN tournament tou ON tou.id = tt.tournament_id
            LEFT JOIN team t2 ON t2.id = t.parent_team_id
            LEFT JOIN `group` g ON g.id = tt.group_id
            LEFT JOIN nation n ON n.id = t.nation_id
            LEFT JOIN nation n2 ON n2.id = t2.nation_id
            LEFT JOIN `group` g2 ON g2.id = tt.confederation_id
            WHERE tou.tournament_type_id = 1
         */

        public static function getAllTimeSoccerTeamTournamentSql($tournament_type_id) {
            $sql = 'SELECT t.id, UCASE(t.name) AS name, 
                        t.parent_team_id, UCASE(t2.name) AS parent_team_name, UCASE(g.name) AS group_name,
                        n.flag_filename, n2.flag_filename AS parent_flag_filename, n.code, tt.tournament_id, tou.name AS tournament_name,
                        g2.name AS confederation_name, g2.group_logo AS confederation_logo_filename
                    FROM team t
                    LEFT JOIN team_tournament tt ON tt.team_id = t.id
                    LEFT JOIN tournament tou ON tou.id = tt.tournament_id  
                    LEFT JOIN team t2 ON t2.id = t.parent_team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id
                    LEFT JOIN nation n ON n.id = t.nation_id
                    LEFT JOIN nation n2 ON n2.id = t2.nation_id
                    LEFT JOIN `group` g2 ON g2.id = tt.confederation_id
                    WHERE tou.tournament_type_id = '.$tournament_type_id; // AND tt.tournament_id <> 1'
            return $sql;
        }

        public static function getAllTimeSoccerTeamTournamentDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $output = '<!-- TeamTournament Count = '.$count.' -->';
            $teams = array();
            $second_round_teams = array();

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam(
                        $row['id'], $row['name'], '', $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        $row['group_name'], '',
                        '', '', 0,
                        $row['flag_filename'], '', $row['tournament_id'], $row['tournament_name'], 0,
                        $row['confederation_name'], $row['confederation_logo_filename']);
                    array_push($teams, $team);

                    $second_round_team = Team::CreateSoccerTeam(
                        $row['id'], $row['name'], '', $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        $row['group_name'], '',
                        '', '', 0,
                        $row['flag_filename'], '', $row['tournament_id'], $row['tournament_name'], 0,
                        $row['confederation_name'], $row['confederation_logo_filename']);
                    array_push($second_round_teams, $second_round_team);
                }
                $tournament->setTournamentTeams($teams);
                $tournament->setSecondRoundTournamentTeams($second_round_teams);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getTeamArrayByName($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getName()] = $teams[$i];
            }
            return $result;
        }

        public static function getTeamArrayById($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getId()] = $teams[$i];
            }
            return $result;
        }

        public static function getTeamArrayByGroup($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                if ($teams[$i]->getGroupName() != null) {
                    $result[$teams[$i]->getGroupName()][$teams[$i]->getName()] = $teams[$i];
                }
            }
            return $result;
        }

        public static function getTeamArrayByBestFinish($teams) {
            $teams_tmp = array();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                if ($teams[$i]->getBestFinish() == Soccer::Playoff) {
                    $teams[$i]->setBestFinish(Soccer::Group);
                    $teams_tmp[Soccer::Group][$teams[$i]->getName()] = $teams[$i];
                }
                elseif ($teams[$i]->getBestFinish() == Soccer::ReplayFirstRound) {
                    $teams[$i]->setBestFinish(Soccer::FirstRound);
                    $teams_tmp[Soccer::FirstRound][$teams[$i]->getName()] = $teams[$i];
                }
                elseif ($teams[$i]->getBestFinish() == Soccer::ReplayQuarterfinal) {
                    $teams[$i]->setBestFinish(Soccer::Quarterfinal);
                    $teams_tmp[Soccer::Quarterfinal][$teams[$i]->getName()] = $teams[$i];
                }
                else {
                    $teams_tmp[$teams[$i]->getBestFinish()][$teams[$i]->getName()] = $teams[$i];
                }
            }
            foreach ($teams_tmp as $best_finish => $_teams) {
                foreach ($_teams as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            return $result;
        }

        public static function getTeamArrayByParentGroup($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getParentGroupName()][$teams[$i]->getGroupName()][$teams[$i]->getName()] = $teams[$i];
            }
            return $result;
        }

        public static function getConfederationArray($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                if (!array_key_exists($teams[$i]->getConfederationName(), $result)
                    && $teams[$i]->getConfederationName() != null) {
                    $result[$teams[$i]->getConfederationName()] = $teams[$i];
                }
            }
            return $result;
        }

        public static function getTeamArrayByConfederation($tournament) {
            $result = array();
            $teams = self::getTeamArrayById($tournament->getTeams());
            $tournament_teams = $tournament->getTournamentTeams();
            for ($i = 0; $i < sizeof($tournament_teams); $i++) {
                if ($tournament_teams[$i]->getConfederationName() != null) {
                    $team_id = $tournament_teams[$i]->getId();
                    if ($tournament_teams[$i]->getParentId() != null) {
                        $team_id = $tournament_teams[$i]->getParentId();
                    }
                    $result[$tournament_teams[$i]->getConfederationName()][$team_id] = $teams[$team_id];
                }
            }
            return $result;
        }

        public static function getFilteringLogo($team, $image_type) {
            switch ($image_type) {
                case self::LOGO:
                    $image_class = 'logo-md';
                    $image_dir = 'club_logos';
                    $image_file = $team->getLogoFilename();
                    break;
                case self::CONFEDERATION_LOGO:
                    $image_class = 'logo-lg';
                    $image_dir = 'logos';
                    $image_file = $team->getConfederationLogoFilename();
                    break;
                default:
                    $image_class = 'flag-md';
                    $image_dir = 'flags';
                    $image_file = $team->getFlagFilename();
                    break;
            }
            $result = '<img class="'.$image_class.'" src="/images/'.$image_dir.'/'.$image_file.'">';
            return $result;
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
        public function getLName()
        {
            return $this->l_name;
        }

        /**
         * @param mixed $l_name
         */
        public function setLName($l_name)
        {
            $this->l_name = $l_name;
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
        public function getParentId()
        {
            return $this->parent_id;
        }

        /**
         * @param mixed $parent_id
         */
        public function setParentId($parent_id)
        {
            $this->parent_id = $parent_id;
        }

        /**
         * @return mixed
         */
        public function getParentName()
        {
            return $this->parent_name;
        }

        /**
         * @param mixed $parent_name
         */
        public function setParentName($parent_name)
        {
            $this->parent_name = $parent_name;
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
        public function getConfederationName()
        {
            return $this->confederation_name;
        }

        /**
         * @param mixed $confederation_name
         */
        public function setConfederationName($confederation_name)
        {
            $this->confederation_name = $confederation_name;
        }

        /**
         * @return mixed
         */
        public function getConfederationLogoFilename()
        {
            return $this->confederation_logo_filename;
        }

        /**
         * @param mixed $confederation_logo_filename
         */
        public function setConfederationLogoFilename($confederation_logo_filename)
        {
            $this->confederation_logo_filename = $confederation_logo_filename;
        }

        /**
         * @return mixed
         */
        public function getBestFinish()
        {
            return $this->best_finish;
        }

        /**
         * @param mixed $best_finish
         */
        public function setBestFinish($best_finish)
        {
            $this->best_finish = $best_finish;
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
        public function getHomeWin()
        {
            return $this->home_win;
        }

        /**
         * @param mixed $home_win
         */
        public function setHomeWin($home_win)
        {
            $this->home_win = $home_win;
        }

        /**
         * @return mixed
         */
        public function getHomeTie()
        {
            return $this->home_tie;
        }

        /**
         * @param mixed $home_tie
         */
        public function setHomeTie($home_tie)
        {
            $this->home_tie = $home_tie;
        }

        /**
         * @return mixed
         */
        public function getHomeLoss()
        {
            return $this->home_loss;
        }

        /**
         * @param mixed $home_loss
         */
        public function setHomeLoss($home_loss)
        {
            $this->home_loss = $home_loss;
        }

        /**
         * @return mixed
         */
        public function getRoadWin()
        {
            return $this->road_win;
        }

        /**
         * @param mixed $road_win
         */
        public function setRoadWin($road_win)
        {
            $this->road_win = $road_win;
        }

        /**
         * @return mixed
         */
        public function getRoadTie()
        {
            return $this->road_tie;
        }

        /**
         * @param mixed $road_tie
         */
        public function setRoadTie($road_tie)
        {
            $this->road_tie = $road_tie;
        }

        /**
         * @return mixed
         */
        public function getRoadLoss()
        {
            return $this->road_loss;
        }

        /**
         * @param mixed $road_loss
         */
        public function setRoadLoss($road_loss)
        {
            $this->road_loss = $road_loss;
        }

        /**
         * @return mixed
         */
        public function getDivWin()
        {
            return $this->div_win;
        }

        /**
         * @param mixed $div_win
         */
        public function setDivWin($div_win)
        {
            $this->div_win = $div_win;
        }

        /**
         * @return mixed
         */
        public function getDivTie()
        {
            return $this->div_tie;
        }

        /**
         * @param mixed $div_tie
         */
        public function setDivTie($div_tie)
        {
            $this->div_tie = $div_tie;
        }

        /**
         * @return mixed
         */
        public function getDivLoss()
        {
            return $this->div_loss;
        }

        /**
         * @param mixed $div_loss
         */
        public function setDivLoss($div_loss)
        {
            $this->div_loss = $div_loss;
        }

        /**
         * @return mixed
         */
        public function getConfWin()
        {
            return $this->conf_win;
        }

        /**
         * @param mixed $conf_win
         */
        public function setConfWin($conf_win)
        {
            $this->conf_win = $conf_win;
        }

        /**
         * @return mixed
         */
        public function getConfTie()
        {
            return $this->conf_tie;
        }

        /**
         * @param mixed $conf_tie
         */
        public function setConfTie($conf_tie)
        {
            $this->conf_tie = $conf_tie;
        }

        /**
         * @return mixed
         */
        public function getConfLoss()
        {
            return $this->conf_loss;
        }

        /**
         * @param mixed $conf_loss
         */
        public function setConfLoss($conf_loss)
        {
            $this->conf_loss = $conf_loss;
        }

        /**
         * @return mixed
         */
        public function getLast5Win()
        {
            return $this->last5_win;
        }

        /**
         * @param mixed $last5_win
         */
        public function setLast5Win($last5_win)
        {
            $this->last5_win = $last5_win;
        }

        /**
         * @return mixed
         */
        public function getLast5Tie()
        {
            return $this->last5_tie;
        }

        /**
         * @param mixed $last5_tie
         */
        public function setLast5Tie($last5_tie)
        {
            $this->last5_tie = $last5_tie;
        }

        /**
         * @return mixed
         */
        public function getLast5Loss()
        {
            return $this->last5_loss;
        }

        /**
         * @param mixed $last5_loss
         */
        public function setLast5Loss($last5_loss)
        {
            $this->last5_loss = $last5_loss;
        }

        /**
         * @return mixed
         */
        public function getStreak()
        {
            return $this->streak;
        }

        /**
         * @param mixed $streak
         */
        public function setStreak($streak)
        {
            $this->streak = $streak;
        }

        /**
         * @return mixed
         */
        public function getOpponents()
        {
            return $this->opponents;
        }

        /**
         * @param mixed $opponents
         */
        public function setOpponents($opponents)
        {
            $this->opponents = $opponents;
        }

        /**
         * @return mixed
         */
        public function getCommonOpponents()
        {
            return $this->common_opponents;
        }

        /**
         * @param mixed $common_opponents
         */
        public function setCommonOpponents($common_opponents)
        {
            $this->common_opponents = $common_opponents;
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
        public function getTournamentName()
        {
            return $this->tournament_name;
        }

        /**
         * @param mixed $tournament_name
         */
        public function setTournamentName($tournament_name)
        {
            $this->tournament_name = $tournament_name;
        }

        /**
         * @return mixed
         */
        public function getTournamentCount()
        {
            return $this->tournament_count;
        }

        /**
         * @param mixed $tournament_count
         */
        public function setTournamentCount($tournament_count)
        {
            $this->tournament_count = $tournament_count;
        }

        /**
         * @return mixed
         */
        public function getAdvancedSecondRound()
        {
            return $this->advanced_second_round;
        }

        /**
         * @param mixed $advanced_second_round
         */
        public function setAdvancedSecondRound($advanced_second_round)
        {
            $this->advanced_second_round = $advanced_second_round;
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
