<?php
    namespace v2;
    include_once('config.php');

    class Match {
        private $home_team_id;
        private $home_team_name;
        private $home_team_code;
        private $home_team_score;
        private $home_team_extra_time_score;
        private $home_team_penalty_score;
        private $home_team_replay_score;
        private $home_parent_team_id;
        private $home_parent_team_name;
        private $away_team_id;
        private $away_team_name;
        private $away_team_code;
        private $away_team_score;
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
        private $points_for_win;
        private $golden_goal_rule;
        private $group_name;
        private $second_round_group_name;
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

        protected function __construct(){ }

        public static function CreateSoccerMatch(
            $home_team_id, $home_team_name, $home_team_code, $away_team_id, $away_team_name, $away_team_code,
            $home_parent_team_id, $home_parent_team_name, $away_parent_team_id, $away_parent_team_name,
            $match_date, $match_date_fmt, $match_time, $match_time_fmt,
            $match_order, $bracket_order, $round, $stage, $group_name, $second_round_group_name,
            $tournament_id, $points_for_win, $golden_goal_rule,
            $waiting_home_team, $waiting_away_team,
            $home_team_score, $away_team_score,
            $home_team_extra_time_score, $away_team_extra_time_score,
            $home_team_penalty_score, $away_team_penalty_score,
            $home_flag, $away_flag)
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
            $m->second_round_group_name = $second_round_group_name;
            $m->tournament_id = $tournament_id;
            $m->points_for_win = $points_for_win;
            $m->golden_goal_rule = $golden_goal_rule;
            $m->waiting_home_team = $waiting_home_team;
            $m->waiting_away_team = $waiting_away_team;
            $m->home_flag = $home_flag;
            $m->away_flag = $away_flag;
            return $m;
        }

//        public static function CreateSoccerMatchCount($count, $html) {
//            return self::CreateSoccerMatch(
//                0, '', '', 0, '', '',
//                0, '', 0, '',
//                '', '', '', '',
//                0, 0, '', '', '', '',
//                0, 0, '',
//                '', '',
//                0, 0,
//                0, 0,
//                0, 0,
//                '', '', null, $count, $html);
//        }

        public static function getSoccerMatches($tournament) {

            $sql = Match::getSoccerMatchSql($tournament->getTournamentId());
            self::getSoccerMatchDb($tournament, $sql);
        }

        public static function getAllTimeSoccerMatches($tournament) {

            $sql = Match::getAllTimeSoccerMatchSql();
            self::getSoccerMatchDb($tournament, $sql);
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
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $home_team_score = -1;
                    $away_team_score = -1;
                    if ($row['home_team_score'] != null) $home_team_score = $row['home_team_score'];
                    if ($row['away_team_score'] != null) $away_team_score = $row['away_team_score'];
                    $match = Match::CreateSoccerMatch(
                        $row['home_team_id'], $row['home_team_name'], $row['home_team_code'], $row['away_team_id'], $row['away_team_name'], $row['away_team_code'],
                        $row['home_parent_team_id'], $row['home_parent_team_name'], $row['away_parent_team_id'], $row['away_parent_team_name'],
                        $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'],
                        $row['match_order'], $row['bracket_order'], $row['round'], $row['stage'], $row['group_name'], $row['second_round_group_name'], $row['tournament_id'],
                        $row['points_for_win'], $row['golden_goal_rule'], $row['waiting_home_team'], $row['waiting_away_team'],
                        $home_team_score, $away_team_score,
                        $row['home_team_extra_time_score'], $row['away_team_extra_time_score'],
                        $row['home_team_penalty_score'], $row['away_team_penalty_score'],
                        $row['home_flag'], $row['away_flag']);
                    array_push($matches, $match);
                }
                $tournament->setMatches($matches);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getArchiveSoccerScheduleHtml($tournament) {
            self::getSoccerScheduleHtml($tournament, false);
        }

        public static function getSoccerScheduleHtml($tournament, $lookAheadPopover) {
            $matches = $tournament->getMatches();
            $bracket_spot = self::getBracketSpot($matches);
            $bracket_matches = self::getBracketMatches($matches);
            $output2 = '';
            $output = '
                        <div id="accordion" class="">
                            <div class="card col-sm-12 padding-tb-md border-bottom-gray5">
                                <div class="card-header" id="heading-bracket" style="width:100%;padding-left:0;">
                                    <button class="btn btn-link collapsed h2-ff1 no-padding-left" data-toggle="collapse"
                                        data-target="#collapse-bracket" aria-expanded="false" aria-controls="collapse-bracket">
                                            Bracket <i id="bracket-down-arrow" class="fa fa-angle-double-down font-custom1"></i>
                                            <i id="bracket-up-arrow" class="fa fa-angle-double-up font-custom1 no-display"></i>
                                    </button>
                                </div>
                                <div id="collapse-bracket" class="collapse" aria-labelledby="heading-bracket" data-parent="#accordion">
                                    <div class="card-body">
                                        ';
            $output .= self::getSoccerBracketHtml($bracket_matches, $bracket_spot);
            $output .=         '
                                    </div>
                                </div>
                            </div>
                        </div>';
            $matches = self::getMatchArrayByDate($matches);
            foreach ($matches as $rounds => $_round) {
                if ($rounds == $bracket_spot) $output2 .= $output;
                $output2 .= '<div class="col-sm-12 h2-ff1 margin-top-md">'.$rounds.'</div>';
                foreach ($_round as $match_dates => $_matches) {
                    $output2 .= '<div class="col-sm-12 h3-ff3 border-bottom-gray2 margin-top-md">'
                        .$_matches[array_keys($_matches)[0]]->getMatchDateFmt().'</div>';
                    foreach ($_matches as $match_order => $_match) {
                        $home_team_tmp = $_match->getHomeTeamName();
                        $away_team_tmp = $_match->getAwayTeamName();
                        $group_text = '';
                        $home_flag_tmp = '<img class="flag-md" src="/images/flags/'.$_match->getHomeFlag().'">';
                        $away_flag_tmp = '<img class="flag-md" src="/images/flags/'.$_match->getAwayFlag().'">';
                        if ($_match->getHomeTeamName() == '') {
                            $home_team_tmp = '['.$_match->getWaitingHomeTeam().']';
                            $away_team_tmp = '['.$_match->getWaitingAwayTeam().']';
                            $home_flag_tmp = '';
                            $away_flag_tmp = '';
                        }
                        if ($_match->getStage() == 'First Stage') {
                            $group_name = $_match->getGroupName();
                            if ($_match->getRound() == 'Second Round' || $_match->getRound() == 'Final Round') $group_name = $_match->getSecondRoundGroupName();
                            $group_anchor = 'Group '.$group_name;
                            if ($_match->getRound() == 'Final Round') $group_anchor = $_match->getSecondRoundGroupName();
                            if ($_match->getRound() == 'Final Round') $group_name = $_match->getSecondRoundGroupName();
                            $group_id = $group_name;
                            if ($group_name == 'Final Round') $group_id = 'FinalRound';
                            $group_text = '<a class="link-modal" data-toggle="modal" data-target="#group'.$group_id.'StandingModal">'.$group_anchor.'</a>' ;
                        }
                        $score = 'vs';
                        $penalty_score = '';
                        $aet = ' aet';
                        if (self::isGoldenGoalRule($_match->getGoldenGoalRule()) && $_match->getHomeTeamPenaltyScore() == '') $aet = ' gg';
                        if ($_match->getHomeTeamScore() != -1) {
                            $score = $_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore();
                            if ($rounds != 'Group Matches' && $rounds != 'Second Round' && $rounds != 'Final Round' && $_match->getHomeTeamScore() == $_match->getAwayTeamScore()) {
                                $score = ($_match->getHomeTeamScore()+$_match->getHomeTeamExtraTimeScore()).
                                    '-'.($_match->getAwayTeamScore()+$_match->getAwayTeamExtraTimeScore()).$aet;
                                if ($_match->getHomeTeamExtraTimeScore() == $_match->getAwayTeamExtraTimeScore()) {
                                    if ($_match->getHomeTeamPenaltyScore() != null) {
                                        $penalty_score = ' '.$_match->getHomeTeamPenaltyScore().'-'.$_match->getAwayTeamPenaltyScore().' pen';
                                    }
                                }
                            }
                        }
                        if ($_match->getSecondRoundGroupName() == 'Withdrew') $score = 'w/o';
                        $advance_popover = '';
                        $advance_popover2 = '';
                        if ($lookAheadPopover && $match_order > 32 && $match_order <= 48) {
                            $advance_popover = ' <a id="popover_'.$_match->getHomeTeamCode().'" data-toggle="popover" data-container="body" data-placement="right" type="button" 
                                data-html="true" tabindex="0" data-trigger="focus"><span class="fa fa-futbol-o" style="font-size:medium;vertical-align:middle;"></span></a>';
                            $advance_popover2 = '<a id="popover_'.$_match->getAwayTeamCode().'" data-toggle="popover" data-container="body" data-placement="left" type="button" 
                                data-html="true" tabindex="0" data-trigger="focus"><span class="fa fa-futbol-o" style="font-size:medium;vertical-align:middle;"></span></a> ';
                        }
                        $time_zone = 'CST';
                        if ($_match->getTournamentId() <> 1) $time_zone = 'Local time';
                        $output2 .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                                        <div class="col-sm-2 padding-lr-xs">'.$_match->getMatchTimeFmt().' '.$time_zone.'<br>'.$group_text.'</div>
                                        <div class="col-sm-1 padding-lr-xs text-right" style="padding-top:6px;">'.$home_flag_tmp.'</div>
                                        <div class="col-sm-3 h2-ff3 padding-left-lg padding-right-xs">'.$home_team_tmp.$advance_popover.'</div>
                                        <div class="col-sm-1 h2-ff3 padding-lr-xs">'.$score.'<br>'.$penalty_score.'</div>
                                        <div class="col-sm-3 h2-ff3 padding-lr-xs text-right">'.$advance_popover2.$away_team_tmp.'</div>
                                        <div class="col-sm-1 padding-lr-xs text-right" style="padding-top:6px;">'.$away_flag_tmp.'</div>
                                    </div>';
                    }
                }
            }
            $tournament->concatBodyHtml($output2);
        }

        public static function getSoccerBracketHtml($bracket_matches, $bracket_spot) {
            $output = '';
            $box_height = 120;
            $gap_heights = array(array(10, 20), array(80, 160), array(220, 440), array(410, 1000), array(610, 2120), array(610, 2120));
            $i = 0;
            $j = 0;
            foreach ($bracket_matches as $bracket_round => $_bracket_matches) {
                $gap_height = $gap_heights[$i][0];
                $third_place_moving = '';
                if ($bracket_round == 'Third place') {
                    $third_place_moving = 'style="margin-left:-25%"';
                    if ($bracket_spot == 'Semifinals') $third_place_moving = 'style="margin-left:-25%;margin-top:60px;"';
                }
                $prelim_style = '';
                if ($bracket_round == 'Preliminary Round') $prelim_style = 'style="padding-left:10px;padding-right:0;"';

                $output .= '<div class="col-sm-3" '.$third_place_moving.'>
                            <div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                            <div class="col-sm-12 margin-top-sm" '.$prelim_style.'>
                                <span class="h2-ff1">'.$bracket_round.'</span>
                            </div>';
                foreach ($_bracket_matches as $bracket_match_order => $_bracket_match) {
                    $gap_height = 10;
                    if ($j != 0) $gap_height = $gap_heights[$i][1];
                    $home_team_name = $_bracket_match->getHomeTeamCode();
                    $away_team_name = $_bracket_match->getAwayTeamCode();
                    $home_flag_tmp = '<img class="flag-md" src="/images/flags/'.$_bracket_match->getHomeFlag().'">';
                    $away_flag_tmp = '<img class="flag-md" src="/images/flags/'.$_bracket_match->getAwayFlag().'">';
                    if ($_bracket_match->getHomeTeamCode() == '') {
                        $home_team_name = '['.$_bracket_match->getWaitingHomeTeam().']';
                        $away_team_name = '['.$_bracket_match->getWaitingAwayTeam().']';
                        $home_flag_tmp = '';
                        $away_flag_tmp = '';
                    }
                    $score = 'vs';
                    $penalty_score = '';
                    $aet = ' aet';
                    $replay_score = '';
                    if (self::isGoldenGoalRule($_bracket_match->getGoldenGoalRule()) && $_bracket_match->getHomeTeamPenaltyScore() == '') $aet = ' gg';
                    if ($_bracket_match->getHomeTeamScore() != -1) {
                        $score = $_bracket_match->getHomeTeamScore().'-'.$_bracket_match->getAwayTeamScore();
                        if ($_bracket_match->getHomeTeamScore() == $_bracket_match->getAwayTeamScore()) {
                            $score = ($_bracket_match->getHomeTeamScore()+$_bracket_match->getHomeTeamExtraTimeScore()).
                                '-'.($_bracket_match->getAwayTeamScore()+$_bracket_match->getAwayTeamExtraTimeScore()).$aet;
                            if ($_bracket_match->getHomeTeamExtraTimeScore() == $_bracket_match->getAwayTeamExtraTimeScore()) {
                                if ($_bracket_match->getHomeTeamPenaltyScore() != null) {
                                    $penalty_score = '<br>'.$_bracket_match->getHomeTeamPenaltyScore().'-'.$_bracket_match->getAwayTeamPenaltyScore().' pen';
                                }
                                if ($_bracket_match->getHomeTeamReplayScore() != null) {
                                    $replay_score = '<br>'.$_bracket_match->getHomeTeamReplayScore().'-'.$_bracket_match->getAwayTeamReplayScore().' rep';
                                }
                            }
                        }
                    }
                    if ($_bracket_match->getSecondRoundGroupName() == 'Withdrew') $score = 'w/o';

                    $output .= '<div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                                <div class="col-sm-12 box-sm" style="height:'.$box_height.'px;">
                                    <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$home_flag_tmp.$home_team_name.'</div>
                                    <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$score.$penalty_score.$replay_score.'</div>
                                    <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$away_flag_tmp.$away_team_name.'</div>
                                </div>';
                    $j = $j + 1;
                }
                $output .= '</div>';
                $i = $i + 1;
                $j = 0;
            }
            return $output;
        }

        public static function getSoccerMatchSql($tournament_id) {
            $sql = 'SELECT t.id AS home_team_id, UCASE(t.name) AS home_team_name, home_team_score, n.flag_filename AS home_flag, n.code AS home_team_code,
                        t2.id AS away_team_id, UCASE(t2.name) AS away_team_name, away_team_score, n2.flag_filename AS away_flag, n2.code AS away_team_code, 
                        pt.id AS home_parent_team_id, UCASE(pt.name) AS home_parent_team_name, pt2.id AS away_parent_team_id, UCASE(pt2.name) AS away_parent_team_name, 
                        home_team_extra_time_score, away_team_extra_time_score, home_team_penalty_score, away_team_penalty_score, 
                        DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
                        TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, match_order, bracket_order,
                        waiting_home_team, waiting_away_team,
                        g.name AS round, g2.name AS stage,
                        g3.name AS group_name, g4.name AS second_round_group_name, m.tournament_id, tou.points_for_win, tou.golden_goal_rule
                    FROM `match` m  
                    LEFT JOIN tournament tou ON tou.id = m.tournament_id 
                    LEFT JOIN team t ON t.id = m.home_team_id
                    LEFT JOIN team t2 ON t2.id = m.away_team_id
                    LEFT JOIN `group` g ON g.id = m.round_id
                    LEFT JOIN `group` g2 ON g2.id = m.stage_id
                    LEFT JOIN team_tournament tt ON (tt.team_id = m.home_team_id AND tt.tournament_id = m.tournament_id)
                    LEFT JOIN `group` g3 ON g3.id = tt.group_id 
                    LEFT JOIN `group` g4 ON g4.id = m.group_id
                    LEFT JOIN nation n ON n.id = t.nation_id  
                    LEFT JOIN nation n2 ON n2.id = t2.nation_id  
                    LEFT JOIN team pt ON pt.id = t.parent_team_id 
                    LEFT JOIN team pt2 ON pt2.id = t2.parent_team_id
                    WHERE m.tournament_id = '.$tournament_id.'
                    ORDER BY stage_id, match_order, match_date, match_time;';
            return $sql;
        }

        public static function getAllTimeSoccerMatchSql() {
            $sql = 'SELECT t.id AS home_team_id, UCASE(t.name) AS home_team_name, home_team_score, n.flag_filename AS home_flag, n.code AS home_team_code,
                        t2.id AS away_team_id, UCASE(t2.name) AS away_team_name, away_team_score, n2.flag_filename AS away_flag, n2.code AS away_team_code, 
                        pt.id AS home_parent_team_id, UCASE(pt.name) AS home_parent_team_name, pt2.id AS away_parent_team_id, UCASE(pt2.name) AS away_parent_team_name, 
                        home_team_extra_time_score, away_team_extra_time_score, home_team_penalty_score, away_team_penalty_score, 
                        DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
                        TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, match_order, bracket_order,
                        waiting_home_team, waiting_away_team,
                        g.name AS round, g2.name AS stage,
                        g3.name AS group_name, g4.name AS second_round_group_name, m.tournament_id, tou.points_for_win, tou.golden_goal_rule
                    FROM `match` m  
                    LEFT JOIN tournament tou ON tou.id = m.tournament_id 
                    LEFT JOIN team t ON t.id = m.home_team_id
                    LEFT JOIN team t2 ON t2.id = m.away_team_id
                    LEFT JOIN `group` g ON g.id = m.round_id
                    LEFT JOIN `group` g2 ON g2.id = m.stage_id
                    LEFT JOIN team_tournament tt ON (tt.team_id = m.home_team_id AND tt.tournament_id = m.tournament_id)
                    LEFT JOIN `group` g3 ON g3.id = tt.group_id 
                    LEFT JOIN `group` g4 ON g4.id = m.group_id
                    LEFT JOIN nation n ON n.id = t.nation_id  
                    LEFT JOIN nation n2 ON n2.id = t2.nation_id  
                    LEFT JOIN team pt ON pt.id = t.parent_team_id 
                    LEFT JOIN team pt2 ON pt2.id = t2.parent_team_id
                    WHERE tou.tournament_type_id = 1
                    AND m.tournament_id <> 1;';
            return $sql;
        }

        public static function getGroupMatches($matches) {
            return self::getRoundMatches($matches, 'Group Matches');
        }

        public static function getRound16Matches($matches) {
            return self::getRoundMatches($matches, 'Round of 16');
        }

        public static function getQuarterfinalMatches($matches) {
            return self::getRoundMatches($matches, 'Quarterfinals');
        }

        public static function getSemifinalMatches($matches) {
            return self::getRoundMatches($matches, 'Semifinals');
        }

        public static function getThirdPlaceMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, 'Third place');
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getFinalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, 'Final');
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
                if ($matches[$i]->getStage() == 'Second Stage') {
                    for ($j = 0; $j < sizeof($replay_matches); $j++) {
                        if ($matches[$i]->getHomeTeamName() == $replay_matches[$j]->getHomeTeamName()) {
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
            return strpos($match->getRound(), 'Replay') !== false;
        }

        public static function isGoldenGoalRule($golden_goal_rule) {
            return $golden_goal_rule == 1;
        }

        public static function getMatchArrayByDate($matches) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                $result[$matches[$i]->getRound()][$matches[$i]->getMatchDate()][$matches[$i]->getMatchOrder()] = $matches[$i];
            }
            return $result;
        }

        public static function getBracketSpot($matches) {
            $spot = '';
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == 'Second Stage') {
                    $spot = $matches[$i]->getRound();
                    break;
                }
            }
            return $spot;
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
    }
