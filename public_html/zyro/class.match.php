<?php

    class Match {

        const REPLAY = 'Replay';

        private $home_team_id;
        private $home_team_name;
        private $home_team_code;
        private $home_team_score;
        private $home_team_first_leg_score;
        private $home_team_aggregate_score;
        private $home_team_extra_time_score;
        private $home_team_penalty_score;
        private $home_team_replay_score;
        private $home_parent_team_id;
        private $home_parent_team_name;
        private $away_team_id;
        private $away_team_name;
        private $away_team_code;
        private $away_team_score;
        private $away_team_first_leg_score;
        private $away_team_aggregate_score;
        private $away_team_extra_time_score;
        private $away_team_penalty_score;
        private $away_team_replay_score;
        private $away_parent_team_id;
        private $away_parent_team_name;
        private $match_date;
        private $match_date_fmt;
        private $match_time;
        private $match_time_fmt;
        private $match_order;
        private $bracket_order;
        private $waiting_home_team;
        private $waiting_away_team;
        private $round;
        private $stage;
        private $tournament_id;
        private $tournament_name;
        private $points_for_win;
        private $golden_goal_rule;
        private $group_name;
        private $parent_group_name;
        private $second_round_group_name;
        private $home_retired;
        private $away_retired;
        private $home_team_seed;
        private $away_team_seed;
        private $home_set1_score;
        private $away_set1_score;
        private $home_set1_tiebreak;
        private $away_set1_tiebreak;
        private $home_set2_score;
        private $away_set2_score;
        private $home_set2_tiebreak;
        private $away_set2_tiebreak;
        private $home_set3_score;
        private $away_set3_score;
        private $home_set3_tiebreak;
        private $away_set3_tiebreak;
        private $home_set4_score;
        private $away_set4_score;
        private $home_set4_tiebreak;
        private $away_set4_tiebreak;
        private $home_set5_score;
        private $away_set5_score;
        private $home_set5_tiebreak;
        private $away_set5_tiebreak;
        private $home_flag;
        private $away_flag;
        private $home_alternative_flag;
        private $away_alternative_flag;
        private $home_logo;
        private $away_logo;

        protected function __construct(){ }

        public static function CreateSoccerMatch(
            $home_team_id, $home_team_name, $home_team_code, $away_team_id, $away_team_name, $away_team_code,
            $home_parent_team_id, $home_parent_team_name, $away_parent_team_id, $away_parent_team_name,
            $match_date, $match_date_fmt, $match_time, $match_time_fmt,
            $match_order, $bracket_order, $round, $stage, $group_name, $parent_group_name, $second_round_group_name,
            $tournament_id, $tournament_name, $points_for_win, $golden_goal_rule,
            $waiting_home_team, $waiting_away_team,
            $home_team_score, $away_team_score, $home_team_first_leg_score, $away_team_first_leg_score,
            $home_team_extra_time_score, $away_team_extra_time_score,
            $home_team_penalty_score, $away_team_penalty_score,
            $home_flag, $away_flag, $home_logo, $away_logo)
        {
            $m = new Match();
            $m->home_team_id = $home_team_id;
            $m->home_team_name = $home_team_name;
            $m->home_team_code = $home_team_code;
            $m->away_team_id = $away_team_id;
            $m->away_team_name = $away_team_name;
            $m->away_team_code = $away_team_code;
            $m->home_team_score = $home_team_score;
            $m->away_team_score = $away_team_score;
            $m->home_team_first_leg_score = $home_team_first_leg_score;
            $m->away_team_first_leg_score = $away_team_first_leg_score;
            $m->home_team_extra_time_score = $home_team_extra_time_score;
            $m->away_team_extra_time_score = $away_team_extra_time_score;
            $m->home_team_penalty_score = $home_team_penalty_score;
            $m->away_team_penalty_score = $away_team_penalty_score;
            $m->home_parent_team_id = $home_parent_team_id;
            $m->home_parent_team_name = $home_parent_team_name;
            $m->away_parent_team_id = $away_parent_team_id;
            $m->away_parent_team_name = $away_parent_team_name;
            $m->match_date = $match_date;
            $m->match_date_fmt = $match_date_fmt;
            $m->match_time = $match_time;
            $m->match_time_fmt = $match_time_fmt;
            $m->match_order = $match_order;
            $m->bracket_order = $bracket_order;
            $m->round = $round;
            $m->stage = $stage;
            $m->group_name = $group_name;
            $m->parent_group_name = $parent_group_name;
            $m->second_round_group_name = $second_round_group_name;
            $m->tournament_id = $tournament_id;
            $m->tournament_name = $tournament_name;
            $m->points_for_win = $points_for_win;
            $m->golden_goal_rule = $golden_goal_rule;
            $m->waiting_home_team = $waiting_home_team;
            $m->waiting_away_team = $waiting_away_team;
            $m->home_flag = $home_flag;
            $m->away_flag = $away_flag;
            $m->home_logo = $home_logo;
            $m->away_logo = $away_logo;
            return $m;
        }

        public static function CloneSoccerMatch(
            $home_team_id, $home_team_name, $home_team_code, $away_team_id, $away_team_name, $away_team_code,
            $home_team_score, $away_team_score)
        {
            return self::CreateSoccerMatch(
                $home_team_id, $home_team_name, $home_team_code, $away_team_id, $away_team_name, $away_team_code,
                0, '', 0, '',
                '', '', '', '',
                0, 0, '', '',
                '', '', '',
                0, '', 0,'',
                '', '',
                $home_team_score, $away_team_score, 0, 0,
                0, 0,
                0, 0,
                '', '', '', '');
        }

        public static function CreateTennisMatch(
            $home_team_name, $away_team_name,
            $match_date, $match_order, $round, $home_team_seed, $away_team_seed,
            $home_retired, $away_retired,
            $home_set1_score, $away_set1_score, $home_set1_tiebreak, $away_set1_tiebreak,
            $home_set2_score, $away_set2_score, $home_set2_tiebreak, $away_set2_tiebreak,
            $home_set3_score, $away_set3_score, $home_set3_tiebreak, $away_set3_tiebreak,
            $home_set4_score, $away_set4_score, $home_set4_tiebreak, $away_set4_tiebreak,
            $home_set5_score, $away_set5_score, $home_set5_tiebreak, $away_set5_tiebreak,
            $home_flag, $home_alternative_flag, $away_flag, $away_alternative_flag)
        {
            $m = new Match();
            $m->home_team_name = $home_team_name;
            $m->away_team_name = $away_team_name;
            $m->match_date = $match_date;
            $m->match_order = $match_order;
            $m->round = $round;
            $m->home_retired = $home_retired;
            $m->away_retired = $away_retired;
            $m->home_team_seed = $home_team_seed;
            $m->away_team_seed = $away_team_seed;
            $m->home_set1_score = $home_set1_score;
            $m->away_set1_score = $away_set1_score;
            $m->home_set1_tiebreak = $home_set1_tiebreak;
            $m->away_set1_tiebreak = $away_set1_tiebreak;
            $m->home_set2_score = $home_set2_score;
            $m->away_set2_score = $away_set2_score;
            $m->home_set2_tiebreak = $home_set2_tiebreak;
            $m->away_set2_tiebreak = $away_set2_tiebreak;
            $m->home_set3_score = $home_set3_score;
            $m->away_set3_score = $away_set3_score;
            $m->home_set3_tiebreak = $home_set3_tiebreak;
            $m->away_set3_tiebreak = $away_set3_tiebreak;
            $m->home_set4_score = $home_set4_score;
            $m->away_set4_score = $away_set4_score;
            $m->home_set4_tiebreak = $home_set4_tiebreak;
            $m->away_set4_tiebreak = $away_set4_tiebreak;
            $m->home_set5_score = $home_set5_score;
            $m->away_set5_score = $away_set5_score;
            $m->home_set5_tiebreak = $home_set5_tiebreak;
            $m->away_set5_tiebreak = $away_set5_tiebreak;
            $m->home_flag = $home_flag;
            $m->away_flag = $away_flag;
            $m->home_alternative_flag = $home_alternative_flag;
            $m->away_alternative_flag = $away_alternative_flag;
            return $m;
        }

        public static function getSoccerMatches($tournament) {

            $sql = self::getSoccerMatchSql($tournament->getTournamentId(), null);
            self::getSoccerMatchDb($tournament, $sql);
        }

        public static function getAllTimeSoccerMatches($tournament) {

            $sql = self::getSoccerMatchSql(null, $tournament->getTournamentTypeId());
            self::getSoccerMatchDb($tournament, $sql);
        }

        /*
            SELECT t.id AS home_team_id, UCASE(t.name) AS home_team_name, home_team_score,
                n.flag_filename AS home_flag, tl.logo_filename AS home_logo, n.code AS home_team_code,
                t2.id AS away_team_id, UCASE(t2.name) AS away_team_name, away_team_score,
                n2.flag_filename AS away_flag, tl2.logo_filename AS away_logo, n2.code AS away_team_code,
                pt.id AS home_parent_team_id, UCASE(pt.name) AS home_parent_team_name,
                pt2.id AS away_parent_team_id, UCASE(pt2.name) AS away_parent_team_name,
                home_team_first_leg_score, away_team_first_leg_score,
                home_team_extra_time_score, away_team_extra_time_score, home_team_penalty_score, away_team_penalty_score,
                DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date,
                TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time,
                match_order, bracket_order,
                waiting_home_team, waiting_away_team,
                g.name AS round, g2.name AS stage,
                g3.name AS group_name, g4.name AS parent_group_name, g5.name AS second_round_group_name,
                m.tournament_id, tou.name AS tournament_name, tou.points_for_win, tou.golden_goal_rule
            FROM `match` m
            LEFT JOIN tournament tou ON tou.id = m.tournament_id
            LEFT JOIN team t ON t.id = m.home_team_id
            LEFT JOIN team t2 ON t2.id = m.away_team_id
            LEFT JOIN `group` g ON g.id = m.round_id
            LEFT JOIN `group` g2 ON g2.id = m.stage_id
            LEFT JOIN team_tournament tt ON (tt.team_id = m.home_team_id AND tt.tournament_id = m.tournament_id)
            LEFT JOIN `group` g3 ON g3.id = tt.group_id
            LEFT JOIN `group` g4 ON g4.id = tt.parent_group_id
            LEFT JOIN `group` g5 ON g5.id = m.group_id
            LEFT JOIN nation n ON n.id = t.nation_id
            LEFT JOIN nation n2 ON n2.id = t2.nation_id
            LEFT JOIN team_logo tl ON tl.team_id = t.id
            LEFT JOIN team_logo tl2 ON tl2.team_id = t2.id
            LEFT JOIN team pt ON pt.id = t.parent_team_id
            LEFT JOIN team pt2 ON pt2.id = t2.parent_team_id
            WHERE tou.tournament_type_id = 1
            AND m.tournament_id = 1
            ORDER BY match_date, match_order
         */

        public static function getSoccerMatchSql($tournament_id, $tournament_type_id) {
            $tournament_type_id_str = 'tou.tournament_type_id = '.$tournament_type_id;
            if ($tournament_type_id == null) $tournament_type_id_str = '1';
            $tournament_id_str = 'm.tournament_id = '.$tournament_id;
            if ($tournament_id == null) $tournament_id_str = '1'; // 'm.tournament_id <> 1'
            $sql = 'SELECT t.id AS home_team_id, UCASE(t.name) AS home_team_name, home_team_score, 
                        n.flag_filename AS home_flag, tl.logo_filename AS home_logo, n.code AS home_team_code,
                        t2.id AS away_team_id, UCASE(t2.name) AS away_team_name, away_team_score, 
                        n2.flag_filename AS away_flag, tl2.logo_filename AS away_logo, n2.code AS away_team_code, 
                        pt.id AS home_parent_team_id, UCASE(pt.name) AS home_parent_team_name, 
                        pt2.id AS away_parent_team_id, UCASE(pt2.name) AS away_parent_team_name, 
                        home_team_first_leg_score, away_team_first_leg_score, 
                        home_team_extra_time_score, away_team_extra_time_score, home_team_penalty_score, away_team_penalty_score, 
                        DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
                        TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, 
                        match_order, bracket_order,
                        waiting_home_team, waiting_away_team,
                        g.name AS round, g2.name AS stage,
                        g3.name AS group_name, g4.name AS parent_group_name, g5.name AS second_round_group_name, 
                        m.tournament_id, tou.name AS tournament_name, tou.points_for_win, tou.golden_goal_rule
                    FROM `match` m  
                    LEFT JOIN tournament tou ON tou.id = m.tournament_id 
                    LEFT JOIN team t ON t.id = m.home_team_id
                    LEFT JOIN team t2 ON t2.id = m.away_team_id
                    LEFT JOIN `group` g ON g.id = m.round_id
                    LEFT JOIN `group` g2 ON g2.id = m.stage_id
                    LEFT JOIN team_tournament tt ON (tt.team_id = m.home_team_id AND tt.tournament_id = m.tournament_id)
                    LEFT JOIN `group` g3 ON g3.id = tt.group_id 
                    LEFT JOIN `group` g4 ON g4.id = tt.parent_group_id 
                    LEFT JOIN `group` g5 ON g5.id = m.group_id
                    LEFT JOIN nation n ON n.id = t.nation_id  
                    LEFT JOIN nation n2 ON n2.id = t2.nation_id  
                    LEFT JOIN team_logo tl ON tl.team_id = t.id
                    LEFT JOIN team_logo tl2 ON tl2.team_id = t2.id 
                    LEFT JOIN team pt ON pt.id = t.parent_team_id 
                    LEFT JOIN team pt2 ON pt2.id = t2.parent_team_id
                    WHERE '.$tournament_type_id_str.'
                    AND '.$tournament_id_str.'
                    ORDER BY match_date, match_order';
            return $sql;
        }

        public static function getSoccerMatchDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $matches = array();
            $output = '<!-- Match Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                $i = 0;
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $home_team_score = -1;
                    $away_team_score = -1;
                    if ($row['home_team_score'] != null && $tournament->getSimulationMode() == Tournament::SIMULATION_MODE_0)
                        $home_team_score = $row['home_team_score'];
                    if ($row['away_team_score'] != null && $tournament->getSimulationMode() == Tournament::SIMULATION_MODE_0)
                        $away_team_score = $row['away_team_score'];
                    if ($tournament->getSimulationMode() == Tournament::SIMULATION_MODE_2) {
                        $row = Soccer::randomMatchScore($row);
                        $home_team_score = $row['home_team_score'];
                        $away_team_score = $row['away_team_score'];
                    }
                    elseif ($row['round'] == Soccer::GROUP_MATCHES && $tournament->getSimulationMode() == Tournament::SIMULATION_MODE_1) {
                        if ($i < 32) {
                            $row = Soccer::randomMatchScore($row);
                            $home_team_score = $row['home_team_score'];
                            $away_team_score = $row['away_team_score'];
                        }
                        $i = $i + 1;
                    }
                    $match = Match::CreateSoccerMatch(
                        $row['home_team_id'], $row['home_team_name'], $row['home_team_code'],
                        $row['away_team_id'], $row['away_team_name'], $row['away_team_code'],
                        $row['home_parent_team_id'], $row['home_parent_team_name'],
                        $row['away_parent_team_id'], $row['away_parent_team_name'],
                        $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'],
                        $row['match_order'], $row['bracket_order'], $row['round'], $row['stage'],
                        $row['group_name'], $row['parent_group_name'], $row['second_round_group_name'],
                        $row['tournament_id'], $row['tournament_name'],
                        $row['points_for_win'], $row['golden_goal_rule'], $row['waiting_home_team'], $row['waiting_away_team'],
                        $home_team_score, $away_team_score,
                        $row['home_team_first_leg_score'], $row['away_team_first_leg_score'],
                        $row['home_team_extra_time_score'], $row['away_team_extra_time_score'],
                        $row['home_team_penalty_score'], $row['away_team_penalty_score'],
                        $row['home_flag'], $row['away_flag'], $row['home_logo'], $row['away_logo']);
                    array_push($matches, $match);
                }
                $tournament->setMatches($matches);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getFinalGroupMatches($matches) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                if (self::isFirstStage($matches[$i]) && $matches[$i]->getHomeTeamScore() != -1) {
                    array_push($result, $matches[$i]);
                }
            }
            return $result;
        }

        public static function isFirstStage($match) {
            return $match->getStage() == Soccer::GROUP_STAGE || $match->getStage() == Soccer::FIRST_STAGE;
        }

        public static function getNumberOfCompletedMatches($tournament) {
            $matches = $tournament->getMatches();
            $count = 0;
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                if ($matches[$i]->getHomeTeamScore() != -1) {
                    $count++;
                }
            }
            if ($count > 48) $count = 48;
            return $count;
        }

        public static function getGroupMatches($matches) {
            return self::getRoundMatches($matches, Soccer::GROUP_MATCHES);
        }

        public static function getSecondRoundMatches($matches) {
            return self::getRoundMatches($matches, Soccer::SECOND_ROUND);
        }

        public static function getReplaySecondRoundMatches($matches) {
            return self::getRoundMatches($matches, Soccer::REPLAY_SECOND_ROUND);
        }

        public static function getFinalRoundMatches($matches) {
            return self::getRoundMatches($matches, Soccer::FINAL_ROUND);
        }

        public static function getPlayOffMatches($matches) {
            return self::getRoundMatches($matches, Soccer::PLAY_OFF);
        }

        public static function getPreliminaryRoundMatches($matches) {
            return self::getRoundMatches($matches, Soccer::PRELIMINARY_ROUND);
        }

        public static function getFirstRoundMatches($matches) {
            return self::getRoundMatches($matches, Soccer::FIRST_ROUND);
        }

        public static function getReplayFirstRoundMatches($matches) {
            return self::getRoundMatches($matches, Soccer::REPLAY_FIRST_ROUND);
        }

        public static function getRound16Matches($matches) {
            return self::getRoundMatches($matches, Soccer::ROUND16);
        }

        public static function getQuarterfinalMatches($matches) {
            return self::getRoundMatches($matches, Soccer::QUARTERFINALS);
        }

        public static function getReplayQuarterfinalMatches($matches) {
            return self::getRoundMatches($matches, Soccer::REPLAY_QUARTERFINALS);
        }

        public static function getSemifinalMatches($matches) {
            return self::getRoundMatches($matches, Soccer::SEMIFINALS);
        }

        public static function getConsolationMatches($matches) {
            return self::getRoundMatches($matches, Soccer::CONSOLATION_ROUND);
        }

        public static function getConsolationSemifinalMatches($matches) {
            return self::getRoundMatches($matches, Soccer::CONSOLATION_SEMIFINALS);
        }

        public static function getConsolationFinalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::CONSOLATION_FINAL);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getFifthPlaceMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::FIFTH_PLACE_MATCH);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getBronzeMedalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::BRONZE_MEDAL_MATCH);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getReplayBronzeMedalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::REPLAY_BRONZE_MEDAL_MATCH);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getGoldMedalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::GOLD_MEDAL_MATCH);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getReplayGoldMedalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::REPLAY_GOLD_MEDAL_MATCH);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getThirdPlaceMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::THIRD_PLACE);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getFinalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::FINAL_);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getReplayFinalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, Soccer::REPLAY_FINAL);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getRoundMatches($matches, $round) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getRound() == $round) {
                    array_push($result, $matches[$i]);
                }
            }
            return $result;
        }

        public static function getStageMatches($matches, $stage) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == $stage) {
                    array_push($result, $matches[$i]);
                }
            }
            return $result;
        }

        public static function getBracketMatches($matches) {
            self::switchLast2Matches($matches);
            $match_count = sizeof($matches);
            $result = array();
            $replay_matches = array();
            $tmp_matches = array();
            for ($i = 0; $i < $match_count; $i++) {
                if (self::isMatchReplay($matches[$i])) {
                    array_push($replay_matches, $matches[$i]);
                }
            }
            for ($i = 0; $i < $match_count; $i++) {
                if (($matches[$i]->getTournamentId() != 59 && $matches[$i]->getStage() == Soccer::SECOND_STAGE && $matches[$i]->getRound() != Soccer::CONSOLATION_ROUND
                    && $matches[$i]->getRound() != Soccer::FIFTH_PLACE_MATCH && $matches[$i]->getRound() != Soccer::PRELIMINARY_ROUND)
                    || ($matches[$i]->getTournamentId() == 59 && $matches[$i]->getRound() != Soccer::FIRST_ROUND)
                    || $matches[$i]->getTournamentId() == 23) {
                    for ($j = 0; $j < sizeof($replay_matches); $j++) {
                        if ($matches[$i]->getHomeTeamName() == $replay_matches[$j]->getHomeTeamName()
                            && $matches[$i]->getAwayTeamName() == $replay_matches[$j]->getAwayTeamName()) {
                            $matches[$i]->setHomeTeamReplayScore($replay_matches[$j]->getHomeTeamScore());
                            $matches[$i]->setAwayTeamReplayScore($replay_matches[$j]->getAwayTeamScore());
                            break;
                        }
                    }
                    if (!self::isMatchReplay($matches[$i])) {
                        array_push($tmp_matches, $matches[$i]);
                    }
                }
            }
            for ($i = 0; $i < sizeof($tmp_matches) - 1; $i++) {
                for ($j = $i + 1; $j < sizeof($tmp_matches); $j++) {
                    if ($tmp_matches[$i]->getBracketOrder() >= $tmp_matches[$j]->getBracketOrder()) {
                        $tmp_match = $tmp_matches[$i];
                        $tmp_matches[$i] = $tmp_matches[$j];
                        $tmp_matches[$j] = $tmp_match;
                    }
                }
            }
            for ($i = 0; $i < sizeof($tmp_matches); $i++) {
                $result[$tmp_matches[$i]->getRound()][$tmp_matches[$i]->getBracketOrder()] = $tmp_matches[$i];
            }
            return $result;
        }

        public static function switchLast2Matches($matches) {
            $match_count = sizeof($matches);
            $tmp_match = $matches[$match_count - 2];
            $matches[$match_count - 2] = $matches[$match_count - 1];
            $matches[$match_count - 1] = $tmp_match;
        }

        public static function isMatchReplay($match) {
            return strpos($match->getRound(), self::REPLAY) !== false;
        }

        public static function getMatchArrayByRound($matches) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                $result[$matches[$i]->getRound()][$matches[$i]->getMatchDate()][$matches[$i]->getMatchOrder()] = $matches[$i];
            }
            return $result;
        }

        public static function getMatchArrayByGroup($matches) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                $result[$matches[$i]->getGroupName()][$matches[$i]->getMatchOrder()] = $matches[$i];
            }
            return $result;
        }

        public static function getFirstStageMatchArrayByGroup($matches) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == 'First Stage' || $matches[$i]->getStage() == 'Group Stage') {
                    $result[$matches[$i]->getGroupName()][$matches[$i]->getMatchOrder()] = $matches[$i];
                }
            }
            return $result;
        }

        public static function getFirstStageMatchArrayByGroupRound($matches) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == 'First Stage' || $matches[$i]->getStage() == 'Group Stage') {
                    $result[$matches[$i]->getGroupName()][$matches[$i]->getRound()][$matches[$i]->getMatchOrder()] = $matches[$i];
                }
            }
            return $result;
        }

        public static function getFirstStageMatchArrayByParentGroupRound($matches) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == 'First Stage' || $matches[$i]->getStage() == 'Group Stage') {
                    $result[$matches[$i]->getParentGroupName()][$matches[$i]->getGroupName()][$matches[$i]->getRound()][$matches[$i]->getMatchOrder()] = $matches[$i];
                }
            }
            return $result;
        }

        public static function getMatchArrayByTeam($matches, $name) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getHomeTeamName() == $name || $matches[$i]->getAwayTeamName() == $name) {
                    $result[$matches[$i]->getMatchDate()][$matches[$i]->getMatchOrder()] = $matches[$i];
                }
            }
            return $result;
        }

        public static function getFootballPreSeasonMatches($matches) {
            return self::getMatchArrayBySeason($matches, Football::PRESEASON);
        }

        public static function getFootballRegularSeasonMatches($matches) {
            return self::getMatchArrayBySeason($matches, Football::REGULAR_SEASON);
        }

        public static function getFootballPostSeasonMatches($matches) {
            return self::getMatchArrayBySeason($matches, Football::POST_SEASON);
        }

        public static function getMatchArrayBySeason($matches, $season) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == $season) {
                    array_push($result, $matches[$i]);
                }
            }
            return $result;
        }

        public static function isFootballRegularSeasonCompleted($matches) {
            $result = true;
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getHomeTeamScore() == -1) {
                    $result = false;
                    break;
                }
            }
            return $result;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamId()
        {
            return $this->home_team_id;
        }

        /**
         * @param mixed $home_team_id
         */
        public function setHomeTeamId($home_team_id)
        {
            $this->home_team_id = $home_team_id;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamName()
        {
            return $this->home_team_name;
        }

        /**
         * @param mixed $home_team_name
         */
        public function setHomeTeamName($home_team_name)
        {
            $this->home_team_name = $home_team_name;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamCode()
        {
            return $this->home_team_code;
        }

        /**
         * @param mixed $home_team_code
         */
        public function setHomeTeamCode($home_team_code)
        {
            $this->home_team_code = $home_team_code;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamScore()
        {
            return $this->home_team_score;
        }

        /**
         * @param mixed $home_team_score
         */
        public function setHomeTeamScore($home_team_score)
        {
            $this->home_team_score = $home_team_score;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamFirstLegScore()
        {
            return $this->home_team_first_leg_score;
        }

        /**
         * @param mixed $home_team_first_leg_score
         */
        public function setHomeTeamFirstLegScore($home_team_first_leg_score)
        {
            $this->home_team_first_leg_score = $home_team_first_leg_score;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamAggregateScore()
        {
            return $this->home_team_aggregate_score;
        }

        /**
         * @param mixed $home_team_aggregate_score
         */
        public function setHomeTeamAggregateScore($home_team_aggregate_score)
        {
            $this->home_team_aggregate_score = $home_team_aggregate_score;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamExtraTimeScore()
        {
            return $this->home_team_extra_time_score;
        }

        /**
         * @param mixed $home_team_extra_time_score
         */
        public function setHomeTeamExtraTimeScore($home_team_extra_time_score)
        {
            $this->home_team_extra_time_score = $home_team_extra_time_score;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamPenaltyScore()
        {
            return $this->home_team_penalty_score;
        }

        /**
         * @param mixed $home_team_penalty_score
         */
        public function setHomeTeamPenaltyScore($home_team_penalty_score)
        {
            $this->home_team_penalty_score = $home_team_penalty_score;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamReplayScore()
        {
            return $this->home_team_replay_score;
        }

        /**
         * @param mixed $home_team_replay_score
         */
        public function setHomeTeamReplayScore($home_team_replay_score)
        {
            $this->home_team_replay_score = $home_team_replay_score;
        }

        /**
         * @return mixed
         */
        public function getHomeParentTeamId()
        {
            return $this->home_parent_team_id;
        }

        /**
         * @param mixed $home_parent_team_id
         */
        public function setHomeParentTeamId($home_parent_team_id)
        {
            $this->home_parent_team_id = $home_parent_team_id;
        }

        /**
         * @return mixed
         */
        public function getHomeParentTeamName()
        {
            return $this->home_parent_team_name;
        }

        /**
         * @param mixed $home_parent_team_name
         */
        public function setHomeParentTeamName($home_parent_team_name)
        {
            $this->home_parent_team_name = $home_parent_team_name;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamId()
        {
            return $this->away_team_id;
        }

        /**
         * @param mixed $away_team_id
         */
        public function setAwayTeamId($away_team_id)
        {
            $this->away_team_id = $away_team_id;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamName()
        {
            return $this->away_team_name;
        }

        /**
         * @param mixed $away_team_name
         */
        public function setAwayTeamName($away_team_name)
        {
            $this->away_team_name = $away_team_name;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamCode()
        {
            return $this->away_team_code;
        }

        /**
         * @param mixed $away_team_code
         */
        public function setAwayTeamCode($away_team_code)
        {
            $this->away_team_code = $away_team_code;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamScore()
        {
            return $this->away_team_score;
        }

        /**
         * @param mixed $away_team_score
         */
        public function setAwayTeamScore($away_team_score)
        {
            $this->away_team_score = $away_team_score;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamFirstLegScore()
        {
            return $this->away_team_first_leg_score;
        }

        /**
         * @param mixed $away_team_first_leg_score
         */
        public function setAwayTeamFirstLegScore($away_team_first_leg_score)
        {
            $this->away_team_first_leg_score = $away_team_first_leg_score;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamAggregateScore()
        {
            return $this->away_team_aggregate_score;
        }

        /**
         * @param mixed $away_team_aggregate_score
         */
        public function setAwayTeamAggregateScore($away_team_aggregate_score)
        {
            $this->away_team_aggregate_score = $away_team_aggregate_score;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamExtraTimeScore()
        {
            return $this->away_team_extra_time_score;
        }

        /**
         * @param mixed $away_team_extra_time_score
         */
        public function setAwayTeamExtraTimeScore($away_team_extra_time_score)
        {
            $this->away_team_extra_time_score = $away_team_extra_time_score;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamPenaltyScore()
        {
            return $this->away_team_penalty_score;
        }

        /**
         * @param mixed $away_team_penalty_score
         */
        public function setAwayTeamPenaltyScore($away_team_penalty_score)
        {
            $this->away_team_penalty_score = $away_team_penalty_score;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamReplayScore()
        {
            return $this->away_team_replay_score;
        }

        /**
         * @param mixed $away_team_replay_score
         */
        public function setAwayTeamReplayScore($away_team_replay_score)
        {
            $this->away_team_replay_score = $away_team_replay_score;
        }

        /**
         * @return mixed
         */
        public function getAwayParentTeamId()
        {
            return $this->away_parent_team_id;
        }

        /**
         * @param mixed $away_parent_team_id
         */
        public function setAwayParentTeamId($away_parent_team_id)
        {
            $this->away_parent_team_id = $away_parent_team_id;
        }

        /**
         * @return mixed
         */
        public function getAwayParentTeamName()
        {
            return $this->away_parent_team_name;
        }

        /**
         * @param mixed $away_parent_team_name
         */
        public function setAwayParentTeamName($away_parent_team_name)
        {
            $this->away_parent_team_name = $away_parent_team_name;
        }

        /**
         * @return mixed
         */
        public function getMatchDate()
        {
            return $this->match_date;
        }

        /**
         * @param mixed $match_date
         */
        public function setMatchDate($match_date)
        {
            $this->match_date = $match_date;
        }

        /**
         * @return mixed
         */
        public function getMatchDateFmt()
        {
            return $this->match_date_fmt;
        }

        /**
         * @param mixed $match_date_fmt
         */
        public function setMatchDateFmt($match_date_fmt)
        {
            $this->match_date_fmt = $match_date_fmt;
        }

        /**
         * @return mixed
         */
        public function getMatchTime()
        {
            return $this->match_time;
        }

        /**
         * @param mixed $match_time
         */
        public function setMatchTime($match_time)
        {
            $this->match_time = $match_time;
        }

        /**
         * @return mixed
         */
        public function getMatchTimeFmt()
        {
            return $this->match_time_fmt;
        }

        /**
         * @param mixed $match_time_fmt
         */
        public function setMatchTimeFmt($match_time_fmt)
        {
            $this->match_time_fmt = $match_time_fmt;
        }

        /**
         * @return mixed
         */
        public function getMatchOrder()
        {
            return $this->match_order;
        }

        /**
         * @param mixed $match_order
         */
        public function setMatchOrder($match_order)
        {
            $this->match_order = $match_order;
        }

        /**
         * @return mixed
         */
        public function getBracketOrder()
        {
            return $this->bracket_order;
        }

        /**
         * @param mixed $bracket_order
         */
        public function setBracketOrder($bracket_order)
        {
            $this->bracket_order = $bracket_order;
        }

        /**
         * @return mixed
         */
        public function getWaitingHomeTeam()
        {
            return $this->waiting_home_team;
        }

        /**
         * @param mixed $waiting_home_team
         */
        public function setWaitingHomeTeam($waiting_home_team)
        {
            $this->waiting_home_team = $waiting_home_team;
        }

        /**
         * @return mixed
         */
        public function getWaitingAwayTeam()
        {
            return $this->waiting_away_team;
        }

        /**
         * @param mixed $waiting_away_team
         */
        public function setWaitingAwayTeam($waiting_away_team)
        {
            $this->waiting_away_team = $waiting_away_team;
        }

        /**
         * @return mixed
         */
        public function getRound()
        {
            return $this->round;
        }

        /**
         * @param mixed $round
         */
        public function setRound($round)
        {
            $this->round = $round;
        }

        /**
         * @return mixed
         */
        public function getStage()
        {
            return $this->stage;
        }

        /**
         * @param mixed $stage
         */
        public function setStage($stage)
        {
            $this->stage = $stage;
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
        public function getSecondRoundGroupName()
        {
            return $this->second_round_group_name;
        }

        /**
         * @param mixed $second_round_group_name
         */
        public function setSecondRoundGroupName($second_round_group_name)
        {
            $this->second_round_group_name = $second_round_group_name;
        }

        /**
         * @return mixed
         */
        public function getHomeRetired()
        {
            return $this->home_retired;
        }

        /**
         * @param mixed $home_retired
         */
        public function setHomeRetired($home_retired)
        {
            $this->home_retired = $home_retired;
        }

        /**
         * @return mixed
         */
        public function getAwayRetired()
        {
            return $this->away_retired;
        }

        /**
         * @param mixed $away_retired
         */
        public function setAwayRetired($away_retired)
        {
            $this->away_retired = $away_retired;
        }

        /**
         * @return mixed
         */
        public function getHomeTeamSeed()
        {
            return $this->home_team_seed;
        }

        /**
         * @param mixed $home_team_seed
         */
        public function setHomeTeamSeed($home_team_seed)
        {
            $this->home_team_seed = $home_team_seed;
        }

        /**
         * @return mixed
         */
        public function getAwayTeamSeed()
        {
            return $this->away_team_seed;
        }

        /**
         * @param mixed $away_team_seed
         */
        public function setAwayTeamSeed($away_team_seed)
        {
            $this->away_team_seed = $away_team_seed;
        }

        /**
         * @return mixed
         */
        public function getHomeSet1Score()
        {
            return $this->home_set1_score;
        }

        /**
         * @param mixed $home_set1_score
         */
        public function setHomeSet1Score($home_set1_score)
        {
            $this->home_set1_score = $home_set1_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet1Score()
        {
            return $this->away_set1_score;
        }

        /**
         * @param mixed $away_set1_score
         */
        public function setAwaySet1Score($away_set1_score)
        {
            $this->away_set1_score = $away_set1_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet1Tiebreak()
        {
            return $this->home_set1_tiebreak;
        }

        /**
         * @param mixed $home_set1_tiebreak
         */
        public function setHomeSet1Tiebreak($home_set1_tiebreak)
        {
            $this->home_set1_tiebreak = $home_set1_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet1Tiebreak()
        {
            return $this->away_set1_tiebreak;
        }

        /**
         * @param mixed $away_set1_tiebreak
         */
        public function setAwaySet1Tiebreak($away_set1_tiebreak)
        {
            $this->away_set1_tiebreak = $away_set1_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeSet2Score()
        {
            return $this->home_set2_score;
        }

        /**
         * @param mixed $home_set2_score
         */
        public function setHomeSet2Score($home_set2_score)
        {
            $this->home_set2_score = $home_set2_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet2Score()
        {
            return $this->away_set2_score;
        }

        /**
         * @param mixed $away_set2_score
         */
        public function setAwaySet2Score($away_set2_score)
        {
            $this->away_set2_score = $away_set2_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet2Tiebreak()
        {
            return $this->home_set2_tiebreak;
        }

        /**
         * @param mixed $home_set2_tiebreak
         */
        public function setHomeSet2Tiebreak($home_set2_tiebreak)
        {
            $this->home_set2_tiebreak = $home_set2_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet2Tiebreak()
        {
            return $this->away_set2_tiebreak;
        }

        /**
         * @param mixed $away_set2_tiebreak
         */
        public function setAwaySet2Tiebreak($away_set2_tiebreak)
        {
            $this->away_set2_tiebreak = $away_set2_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeSet3Score()
        {
            return $this->home_set3_score;
        }

        /**
         * @param mixed $home_set3_score
         */
        public function setHomeSet3Score($home_set3_score)
        {
            $this->home_set3_score = $home_set3_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet3Score()
        {
            return $this->away_set3_score;
        }

        /**
         * @param mixed $away_set3_score
         */
        public function setAwaySet3Score($away_set3_score)
        {
            $this->away_set3_score = $away_set3_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet3Tiebreak()
        {
            return $this->home_set3_tiebreak;
        }

        /**
         * @param mixed $home_set3_tiebreak
         */
        public function setHomeSet3Tiebreak($home_set3_tiebreak)
        {
            $this->home_set3_tiebreak = $home_set3_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet3Tiebreak()
        {
            return $this->away_set3_tiebreak;
        }

        /**
         * @param mixed $away_set3_tiebreak
         */
        public function setAwaySet3Tiebreak($away_set3_tiebreak)
        {
            $this->away_set3_tiebreak = $away_set3_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeSet4Score()
        {
            return $this->home_set4_score;
        }

        /**
         * @param mixed $home_set4_score
         */
        public function setHomeSet4Score($home_set4_score)
        {
            $this->home_set4_score = $home_set4_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet4Score()
        {
            return $this->away_set4_score;
        }

        /**
         * @param mixed $away_set4_score
         */
        public function setAwaySet4Score($away_set4_score)
        {
            $this->away_set4_score = $away_set4_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet4Tiebreak()
        {
            return $this->home_set4_tiebreak;
        }

        /**
         * @param mixed $home_set4_tiebreak
         */
        public function setHomeSet4Tiebreak($home_set4_tiebreak)
        {
            $this->home_set4_tiebreak = $home_set4_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet4Tiebreak()
        {
            return $this->away_set4_tiebreak;
        }

        /**
         * @param mixed $away_set4_tiebreak
         */
        public function setAwaySet4Tiebreak($away_set4_tiebreak)
        {
            $this->away_set4_tiebreak = $away_set4_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeSet5Score()
        {
            return $this->home_set5_score;
        }

        /**
         * @param mixed $home_set5_score
         */
        public function setHomeSet5Score($home_set5_score)
        {
            $this->home_set5_score = $home_set5_score;
        }

        /**
         * @return mixed
         */
        public function getAwaySet5Score()
        {
            return $this->away_set5_score;
        }

        /**
         * @param mixed $away_set5_score
         */
        public function setAwaySet5Score($away_set5_score)
        {
            $this->away_set5_score = $away_set5_score;
        }

        /**
         * @return mixed
         */
        public function getHomeSet5Tiebreak()
        {
            return $this->home_set5_tiebreak;
        }

        /**
         * @param mixed $home_set5_tiebreak
         */
        public function setHomeSet5Tiebreak($home_set5_tiebreak)
        {
            $this->home_set5_tiebreak = $home_set5_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getAwaySet5Tiebreak()
        {
            return $this->away_set5_tiebreak;
        }

        /**
         * @param mixed $away_set5_tiebreak
         */
        public function setAwaySet5Tiebreak($away_set5_tiebreak)
        {
            $this->away_set5_tiebreak = $away_set5_tiebreak;
        }

        /**
         * @return mixed
         */
        public function getHomeFlag()
        {
            return $this->home_flag;
        }

        /**
         * @param mixed $home_flag
         */
        public function setHomeFlag($home_flag)
        {
            $this->home_flag = $home_flag;
        }

        /**
         * @return mixed
         */
        public function getAwayFlag()
        {
            return $this->away_flag;
        }

        /**
         * @param mixed $away_flag
         */
        public function setAwayFlag($away_flag)
        {
            $this->away_flag = $away_flag;
        }

        /**
         * @return mixed
         */
        public function getHomeAlternativeFlag()
        {
            return $this->home_alternative_flag;
        }

        /**
         * @param mixed $home_alternative_flag
         */
        public function setHomeAlternativeFlag($home_alternative_flag)
        {
            $this->home_alternative_flag = $home_alternative_flag;
        }

        /**
         * @return mixed
         */
        public function getAwayAlternativeFlag()
        {
            return $this->away_alternative_flag;
        }

        /**
         * @param mixed $away_alternative_flag
         */
        public function setAwayAlternativeFlag($away_alternative_flag)
        {
            $this->away_alternative_flag = $away_alternative_flag;
        }

        /**
         * @return mixed
         */
        public function getHomeLogo()
        {
            return $this->home_logo;
        }

        /**
         * @param mixed $home_logo
         */
        public function setHomeLogo($home_logo)
        {
            $this->home_logo = $home_logo;
        }

        /**
         * @return mixed
         */
        public function getAwayLogo()
        {
            return $this->away_logo;
        }

        /**
         * @param mixed $away_logo
         */
        public function setAwayLogo($away_logo)
        {
            $this->away_logo = $away_logo;
        }
    }
