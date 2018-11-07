<?php

    class Round {

        private $tournament_id;
        private $round_id;
        private $round_name;
        private $round_order;
        private $stage_id;
        private $stage_name;
        private $stage_order;

        protected function __construct() { }

        public static function CreateRound($tournament_id, $round_id, $round_name, $round_order,
                                           $stage_id, $stage_name, $stage_order)
        {
            $r = new Round();
            $r->tournament_id = $tournament_id;
            $r->round_id = $round_id;
            $r->round_name = $round_name;
            $r->round_order = $round_order;
            $r->stage_id = $stage_id;
            $r->stage_name = $stage_name;
            $r->stage_order = $stage_order;
            return $r;
        }

        public static function getRounds($tournament) {

            $sql = self::getRoundSql($tournament->getTournamentId());
            self::getRoundDb($tournament, $sql);
        }

        /*
            SELECT tournament_id, group_id AS round_id, g.name AS round_name, group_order AS round_order,
                    parent_group_id AS stage_id, pg.name AS stage_name, parent_group_order AS stage_order
            FROM tournament t
            LEFT JOIN group_tournament gt ON t.id = gt.tournament_id
            LEFT JOIN `group` g ON gt.group_id = g.id
            LEFT JOIN `group` pg ON gt.parent_group_id = pg.id
            WHERE t.id = 1
            ORDER BY stage_order, round_order
         */

        public static function getRoundSql($tournament_id) {
            $sql = 'SELECT tournament_id, group_id AS round_id, g.name AS round_name, group_order AS round_order,
                        parent_group_id AS stage_id, pg.name AS stage_name, parent_group_order AS stage_order
                    FROM tournament t
                    LEFT JOIN group_tournament gt ON t.id = gt.tournament_id
                    LEFT JOIN `group` g ON gt.group_id = g.id
                    LEFT JOIN `group` pg ON gt.parent_group_id = pg.id 
                    WHERE t.id = '.$tournament_id.'
                    ORDER BY stage_order, round_order';
            return $sql;
        }

        public static function getRoundDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $rounds = array();
            $output = '<!-- Round Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $round = Round::CreateRound(
                        $row['tournament_id'], $row['round_id'], $row['round_name'], $row['round_order'],
                        $row['stage_id'], $row['stage_name'], $row['stage_order']);
                    array_push($rounds, $round);
                }
                $tournament->setRounds($rounds);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getRoundArrayByStageRound($tournament) {
            $rounds = $tournament->getRounds();
            $result = array();
            for ($i = 0; $i < sizeof($rounds); $i++) {
                $result[$rounds[$i]->getStageId()][$rounds[$i]->getRoundId()] = $rounds[$i];
            }
            return $result;
        }

        public static function getFirstStageRoundArray($tournament) {
            $rounds = $tournament->getRounds();
            $result = array();
            for ($i = 0; $i < sizeof($rounds); $i++) {
                if ($rounds[$i]->getStageName() == Soccer::FIRST_STAGE)
                    $result[$rounds[$i]->getRoundId()] = $rounds[$i];
            }
            return $result;
        }

        public static function getSecondStageRoundArray($tournament) {
            $rounds = $tournament->getRounds();
            $result = array();
            for ($i = 0; $i < sizeof($rounds); $i++) {
                if ($rounds[$i]->getStageName() == Soccer::SECOND_STAGE || $rounds[$i]->getStageName() == Soccer::CONSOLATION_STAGE)
                    $result[$rounds[$i]->getRoundId()] = $rounds[$i];
            }
            return $result;
        }

        public static function getRoundArray($tournament, $stage) {
            $rounds = $tournament->getRounds();
            $result = array();
            for ($i = 0; $i < sizeof($rounds); $i++) {
                if ($rounds[$i]->getStageName() == $stage)
                    $result[$rounds[$i]->getRoundId()] = $rounds[$i];
            }
            return $result;
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
        public function getRoundId()
        {
            return $this->round_id;
        }

        /**
         * @param mixed $round_id
         */
        public function setRoundId($round_id)
        {
            $this->round_id = $round_id;
        }

        /**
         * @return mixed
         */
        public function getRoundName()
        {
            return $this->round_name;
        }

        /**
         * @param mixed $round_name
         */
        public function setRoundName($round_name)
        {
            $this->round_name = $round_name;
        }

        /**
         * @return mixed
         */
        public function getRoundOrder()
        {
            return $this->round_order;
        }

        /**
         * @param mixed $round_order
         */
        public function setRoundOrder($round_order)
        {
            $this->round_order = $round_order;
        }

        /**
         * @return mixed
         */
        public function getStageId()
        {
            return $this->stage_id;
        }

        /**
         * @param mixed $stage_id
         */
        public function setStageId($stage_id)
        {
            $this->stage_id = $stage_id;
        }

        /**
         * @return mixed
         */
        public function getStageName()
        {
            return $this->stage_name;
        }

        /**
         * @param mixed $stage_name
         */
        public function setStageName($stage_name)
        {
            $this->stage_name = $stage_name;
        }

        /**
         * @return mixed
         */
        public function getStageOrder()
        {
            return $this->stage_order;
        }

        /**
         * @param mixed $stage_order
         */
        public function setStageOrder($stage_order)
        {
            $this->stage_order = $stage_order;
        }
    }
