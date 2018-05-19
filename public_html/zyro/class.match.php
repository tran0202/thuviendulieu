<?php
    include_once('config.php');
    class Match{
        private $home_team_id;
        private $home_team_name;
        private $home_team_code;
        private $home_team_score;
        private $home_team_extra_time_score;
        private $home_team_penalty_score;
        private $home_parent_team_id;
        private $home_parent_team_name;
        private $away_team_name;
        private $away_team_code;
        private $away_team_id;
        private $away_team_score;
        private $away_team_extra_time_score;
        private $away_team_penalty_score;
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
            $match_order, $bracket_order, $round, $stage, $group_name, $second_round_group_name, $tournament_id, $points_for_win, $golden_goal_rule,
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

        public static function NewSoccerMatch(
            $home_team_id, $home_team_name, $home_team_code, $away_team_id, $away_team_name, $away_team_code,
            $home_team_score, $away_team_score)
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
            return $m;
        }

        public static function CreateTennisMatch(
            $home_team_name, $away_team_name,
            $match_date, $match_order, $round, $home_team_seed, $away_team_seed,
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

        public static function getSoccerMatches($tournament_dto) {

            $sql = Match::getSoccerMatchSql($tournament_dto->getTournamentId());

            return self::getSoccerMatchDTO($sql, $tournament_dto->getFantasy());
        }

        public static function getAllTimeSoccerMatches($tournament_dto) {

            $sql = Match::getAllTimeSoccerMatchSql();

            return self::getSoccerMatchDTO($sql, $tournament_dto->getFantasy());
        }

        public static function getTennisMatches($tournament_dto) {

            $sql = Match::getTennisMatchSql($tournament_dto->getTournamentId());

            return self::getTennisMatchDTO($sql, $tournament_dto->getFantasy());
        }

        public static function getSoccerMatchDTO($sql, $fantasy) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $matches = array();
            $output = '<!-- Match Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                return MatchDTO::CreateSoccerMatchDTO(null, $count, $output);
            }
            else {
                $i = 0;
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $ft = new FantasyType();
                    $home_team_score = -1;
                    $away_team_score = -1;
                    if ($row['home_team_score'] != null) $home_team_score = $row['home_team_score'];
                    if ($row['away_team_score'] != null) $away_team_score = $row['away_team_score'];
                    if ($fantasy == $ft->getFantasyType('AllMatches')) {
                        $row = self::randomMatchScore($row);
                        $home_team_score = $row['home_team_score'];
                        $away_team_score = $row['away_team_score'];
                    }
                    elseif ($fantasy == $ft->getFantasyType('First2Matches')) {
                        if ($i < 32) {
                            $row = self::randomMatchScore($row);
                            $home_team_score = $row['home_team_score'];
                            $away_team_score = $row['away_team_score'];
                        }
                        $i = $i + 1;
                    }
                    $match = Match::CreateSoccerMatch($row['home_team_id'], $row['home_team_name'], $row['home_team_code'], $row['away_team_id'], $row['away_team_name'], $row['away_team_code'],
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
//                self::mockGroupAScore($matches);
                return MatchDTO::CreateSoccerMatchDTO($matches, $count, $output);
            }
        }

        public static function mockGroupAScore($matches) {
            $matches[0]->setHomeTeamScore(1);
            $matches[0]->setAwayTeamScore(0);
            $matches[1]->setHomeTeamScore(1);
            $matches[1]->setAwayTeamScore(0);
            $matches[16]->setHomeTeamScore(1);
            $matches[16]->setAwayTeamScore(0);
            $matches[18]->setHomeTeamScore(1);
            $matches[18]->setAwayTeamScore(0);
//            $matches[32]->setHomeTeamScore(1);
//            $matches[32]->setAwayTeamScore(0);
//            $matches[33]->setHomeTeamScore(3);
//            $matches[33]->setAwayTeamScore(3);
        }

        public static function getTennisMatchDTO($sql, $fantasy = false) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $matches = array();
            $output = '<!-- Match Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                return MatchDTO::CreateTennisMatchDTO(null, $count, $output);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $match = Match::CreateTennisMatch($row['home_team_name'], $row['away_team_name'],
                        $row['match_date'], $row['match_order'], $row['round'],
                        $row['home_team_seed'], $row['away_team_seed'],
                        $row['home_set1_score'], $row['away_set1_score'], $row['home_set1_tiebreak'], $row['away_set1_tiebreak'],
                        $row['home_set2_score'], $row['away_set2_score'], $row['home_set2_tiebreak'], $row['away_set2_tiebreak'],
                        $row['home_set3_score'], $row['away_set3_score'], $row['home_set3_tiebreak'], $row['away_set3_tiebreak'],
                        $row['home_set4_score'], $row['away_set4_score'], $row['home_set4_tiebreak'], $row['away_set4_tiebreak'],
                        $row['home_set5_score'], $row['away_set5_score'], $row['home_set5_tiebreak'], $row['away_set5_tiebreak'],
                        $row['home_flag_filename'], $row['home_alternative_flag_filename'], $row['away_flag_filename'], $row['away_alternative_flag_filename']);
                    array_push($matches, $match);
                }
                return MatchDTO::CreateTennisMatchDTO($matches, $count, $output);
            }
        }

        public static function getSoccerGroupHtml($match_dto) {
            $group_matches = Match::getMatchArrayByGroup($match_dto);
            $output = '';
            foreach ($group_matches as $group_name => $_matches) {
                if ($group_name != '') {
                    $output .= '<div class="modal fade" id="group'.$group_name.'MatchesModal" tabindex="-1" role="dialog" aria-labelledby="group'.$group_name.'MatchesModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="col-sm-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="modal-X" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-header col-sm-12 padding-lr-lg" style="border-bottom:none;">
                                <div class="col-sm-12 h3-ff3 border-bottom-gray2" id="group'.$group_name.'MatchesModalLabel">Group '.$group_name.'</div>
                            </div>
                            <div class="modal-body col-sm-12 padding-lr-lg" id="group'.$group_name.'MatchesModalBody">';
                    foreach ($_matches as $match_order => $_match) {
                        if ($_match->getStage() == 'First Stage') {
                            $score = 'vs';
                            if ($_match->getHomeTeamScore() != -1) $score = $_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore();
                            $output .= '<div class="col-sm-12 h2-ff3 padding-tb-md padding-lr-xs border-bottom-gray5">
                                <div class="col-sm-2 padding-lr-xs"><img class="flag-md" src="/images/flags/'.$_match->getHomeFlag().'"></div>
                                <div class="col-sm-3 padding-lr-xs" style="padding-top:3px;">'.$_match->getHomeTeamName().'</div>
                                <div class="col-sm-2 padding-lr-xs text-center" style="padding-top:3px;">'.$score.'</div>
                                <div class="col-sm-3 padding-lr-xs text-right" style="padding-top:3px;">'.$_match->getAwayTeamName().'</div>
                                <div class="col-sm-2 padding-lr-xs text-right"><img class="flag-md" src="/images/flags/'.$_match->getAwayFlag().'"></div>
                            </div>';
                        }
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
            }
            return $output;
        }

        public static function getSoccerBracketHtml($match_dto) {
            $second_stage_matches = self::getMatchArraySecondStage($match_dto);
            $output = '';
            $box_height = 120;
            $gap_heights = array(array(10, 20), array(80, 160), array(220, 440), array(410, 1000), array(10, 2120));
            $i = 0;
            $j = 0;
            foreach ($second_stage_matches as $round => $_matches) {
                $gap_height = $gap_heights[$i][0];
                $output .= '<div class="col-sm-3">
                            <div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                            <div class="col-sm-12 margin-top">
                                <span class="h2-ff1">'.$round.'</span>
                            </div>';
                foreach ($_matches as $match_order => $_match) {
                    $gap_height = 10;
                    if ($j != 0) $gap_height = $gap_heights[$i][1];
                    $home_team_name = $_match->getHomeTeamCode();
                    $away_team_name = $_match->getAwayTeamCode();
                    if ($_match->getHomeTeamCode() == '') $home_team_name = '['.$_match->getWaitingHomeTeam().']';
                    if ($_match->getAwayTeamCode() == '') $away_team_name = '['.$_match->getWaitingAwayTeam().']';
                    $score = 'vs';
                    $penalty_score = '';
                    $home_flag = '';
                    $away_flag = '';
                    $aet = ' aet';
                    if (self::isGoldenGoalRule($_match->getGoldenGoalRule()) && $_match->getHomeTeamPenaltyScore() == '') $aet = ' gg';
                    if ($_match->getHomeTeamCode() != '') {
                        $score = $_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore();
                        if ($_match->getHomeTeamScore() == $_match->getAwayTeamScore()) {
                            $score = ($_match->getHomeTeamScore()+$_match->getHomeTeamExtraTimeScore()).'-'.($_match->getAwayTeamScore()+$_match->getAwayTeamExtraTimeScore()).$aet;
                            if ($_match->getHomeTeamExtraTimeScore() == $_match->getAwayTeamExtraTimeScore()) {
                                $penalty_score = ' '.$_match->getHomeTeamPenaltyScore().'-'.$_match->getAwayTeamPenaltyScore().' pen';
                            }
                        }
                        $home_flag = '<img class="flag-md" src="/images/flags/'.$_match->getHomeFlag().'">';
                        $away_flag = '<img class="flag-md" src="/images/flags/'.$_match->getAwayFlag().'">';
                    }
                    $output .= '<div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                            <div class="col-sm-12 box-sm" style="height:'.$box_height.'px;">
                                <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">
                                    '.$home_flag.
                        $home_team_name.
                        '</div>
                                <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.
                        $score.'<br>'.$penalty_score.
                        '</div>
                                <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">
                                    '.$away_flag.
                        $away_team_name.
                        '</div>
                            </div>';
                    $j = $j + 1;
                }
                $output .= '</div>';
                $i = $i + 1;
                $j = 0;
            }
            return $output;
        }

        public static function getSoccerScheduleHtml($match_dto, $first2Matches = false) {
            $showBracket = self::showBracket($match_dto);
            $bracket_matches = self::getMatchArraySecondStage($match_dto);
            $output = '';
            $output2 = '';
            $output .= '
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
            $box_height = 120;
            $gap_heights = array(array(10, 20), array(80, 160), array(220, 440), array(410, 1000), array(610, 2120));
            $tmp_array = array();
            $tmp_array2 = array();
            foreach ($bracket_matches as $bracket_round => $_bracket_matches) {
                foreach ($_bracket_matches as $bracket_match_order => $_bracket_match) {
                    array_push($tmp_array, $_bracket_match);
                }
            }
            for ($i = 0; $i < sizeof($tmp_array) - 1; $i++) {
                for ($j = $i + 1; $j < sizeof($tmp_array); $j++) {
                    if ($tmp_array[$i]->getBracketOrder() >= $tmp_array[$j]->getBracketOrder()) {
                        $tmp_match = $tmp_array[$i];
                        $tmp_array[$i] = $tmp_array[$j];
                        $tmp_array[$j] = $tmp_match;
                    }
                }
            }
            for ($i = 0; $i < sizeof($tmp_array); $i++) {
                $tmp_array2[$tmp_array[$i]->getRound()][$tmp_array[$i]->getBracketOrder()] = $tmp_array[$i];
            }
            $bracket_matches = $tmp_array2;
            $i = 0;
            $j = 0;
            foreach ($bracket_matches as $bracket_round => $_bracket_matches) {
                $gap_height = $gap_heights[$i][0];
                $third_place_moving = '';
                if ($bracket_round == 'Third place') {
                    $third_place_moving = 'style="margin-left:-25%"';
                    if ($showBracket == 'Semifinals') $third_place_moving = 'style="margin-left:-25%;margin-top:60px;"';
                }
                $output .= '<div class="col-sm-3" '.$third_place_moving.'>
                            <div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                            <div class="col-sm-12 margin-top-sm">
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
                    if (self::isGoldenGoalRule($_bracket_match->getGoldenGoalRule()) && $_bracket_match->getHomeTeamPenaltyScore() == '') $aet = ' gg';
                    if ($_bracket_match->getHomeTeamScore() != -1) {
                        $score = $_bracket_match->getHomeTeamScore().'-'.$_bracket_match->getAwayTeamScore();
                        if ($_bracket_match->getHomeTeamScore() == $_bracket_match->getAwayTeamScore()) {
                            $score = ($_bracket_match->getHomeTeamScore()+$_bracket_match->getHomeTeamExtraTimeScore()).'-'.($_bracket_match->getAwayTeamScore()+$_bracket_match->getAwayTeamExtraTimeScore()).$aet;
                            if ($_bracket_match->getHomeTeamExtraTimeScore() == $_bracket_match->getAwayTeamExtraTimeScore()) {
                                $penalty_score = ' '.$_bracket_match->getHomeTeamPenaltyScore().'-'.$_bracket_match->getAwayTeamPenaltyScore().' pen';
                            }
                        }
                    }
                    $output .= '<div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                                <div class="col-sm-12 box-sm" style="height:'.$box_height.'px;">
                                    <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$home_flag_tmp.
                                        $home_team_name.
                                    '</div>
                                    <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.
                                        $score.'<br>'.$penalty_score.
                                    '</div>
                                    <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$away_flag_tmp.
                                        $away_team_name.
                                    '</div>
                                </div>';
                    $j = $j + 1;
                }
                $output .= '</div>';
                $i = $i + 1;
                $j = 0;
            }
            $output .=         '
                                    </div>
                                </div>
                            </div>
                        </div>';
            $matches = self::getMatchArrayByDate($match_dto);
            foreach ($matches as $rounds => $_round) {
                if ($rounds == $showBracket) $output2 .= $output;
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
                            if ($_match->getRound() == 'Second Round') $group_name = $_match->getSecondRoundGroupName();
                            $group_text = '<a class="link-modal" data-toggle="modal" data-target="#group'.$group_name.'StandingModal">
                                                                                Group '.$group_name.'</a>' ;
                        }
                        $score = 'vs';
                        $penalty_score = '';
                        $aet = ' aet';
                        if (self::isGoldenGoalRule($_match->getGoldenGoalRule()) && $_match->getHomeTeamPenaltyScore() == '') $aet = ' gg';
                        if ($_match->getHomeTeamScore() != -1) {
                            $score = $_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore();
                            if ($rounds != 'Group Matches' && $rounds != 'Second Round' && $_match->getHomeTeamScore() == $_match->getAwayTeamScore()) {
                                $score = ($_match->getHomeTeamScore()+$_match->getHomeTeamExtraTimeScore()).'-'.($_match->getAwayTeamScore()+$_match->getAwayTeamExtraTimeScore()).$aet;
                                if ($_match->getHomeTeamExtraTimeScore() == $_match->getAwayTeamExtraTimeScore()) {
                                    $penalty_score = ' '.$_match->getHomeTeamPenaltyScore().'-'.$_match->getAwayTeamPenaltyScore().' pen';
                                }
                            }
                        }
                        $advance_popover = '';
                        $advance_popover2 = '';
                        if ($first2Matches && $match_order > 32 && $match_order <= 48) {
                            $advance_popover = ' <a id="popover_'.$_match->getHomeTeamCode().'" data-toggle="popover" data-container="body" data-placement="right" type="button" 
                                data-html="true" tabindex="0" data-trigger="focus"><span class="fa fa-futbol-o" style="font-size:medium;vertical-align:middle;"></span></a>';
                            $advance_popover2 = '<a id="popover_'.$_match->getAwayTeamCode().'" data-toggle="popover" data-container="body" data-placement="left" type="button" 
                                data-html="true" tabindex="0" data-trigger="focus"><span class="fa fa-futbol-o" style="font-size:medium;vertical-align:middle;"></span></a> ';
                        }
                        $time_zone = 'CST';
                        if ($_match->getTournamentId() <> 1) $time_zone = 'Local time';
                        $output2 .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                                        <div class="col-sm-2 padding-lr-xs">'.$_match->getMatchTimeFmt().' '.$time_zone.'<br>'.$group_text.'</div>
                                        <div class="col-sm-1 padding-lr-xs text-right" style="padding-top:6px;">'.
                                            $home_flag_tmp.
                                        '</div>
                                        <div class="col-sm-3 h2-ff3 padding-left-lg padding-right-xs">'.$home_team_tmp.$advance_popover.'</div>
                                        <div class="col-sm-1 h2-ff3 padding-lr-xs">'.$score.'<br>'.$penalty_score.'</div>
                                        <div class="col-sm-3 h2-ff3 padding-lr-xs text-right">'.$advance_popover2.$away_team_tmp.'</div>
                                        <div class="col-sm-1 padding-lr-xs text-right" style="padding-top:6px;">'.
                                            $away_flag_tmp.
                                        '</div>
                                    </div>';
                    }
                }
            }
            return $output2;
        }

        public static function getTennisHtml($match_dto) {
            $matches = self::getTennisMatchArrayByRound($match_dto);
            $views = array();
            $box_height = 120;
            $gap_heights = array(array(20, 20), array(90, 160), array(230, 440), array(510, 1000), array(1070, 2120), array(2235, 4360), array(4475, 8840));
            for ($round_start = 0; $round_start <= 4; $round_start++) {
                $output = '';
                $i = 0;
                $j = 0;
                $k = 0;
                $round_end = $round_start + 2;
                $output .= '<div class="col-sm-12 no-padding-lr no-display" id="view-'.$round_start.'">';
                foreach ($matches as $round => $_matches) {
                    $prev_view = $round_start - 1;
                    $next_view = $round_start + 1;
                    $left_arrow = '';
                    if ($round_start != 0 AND $k == $round_start) $left_arrow = '<a class="blue font-custom1 hover-pointer margin-right-sm"><i class="fa fa-angle-double-left link-change-view" data-target="'.$prev_view.'"></i></a>';
                    $right_arrow = '';
                    if ($round_start != 4 AND $k == $round_end) $right_arrow = '<a class="blue font-custom1 hover-pointer margin-left-sm"><i class="fa fa-angle-double-right link-change-view" data-target="'.$next_view.'"></i></a>';
                    if ($k >= $round_start AND $k <= $round_end) {
                        $gap_height = $gap_heights[$i][0];
                        $output .= '<div class="col-sm-4">
                                    <div class="col-sm-12 margin-top-sm">'
                            .$left_arrow.'<span class="h2-ff2">'.$round.'</span>'.$right_arrow.
                            '</div>';
                        foreach ($_matches as $match_order => $_match) {
                            if ($j != 0) $gap_height = $gap_heights[$i][1];
                            $home_flag = $_match->getHomeFlag();
                            $home_flag = '<img class="flag-sm" src="/images/flags/'.$home_flag.'">';
                            $away_flag = $_match->getAwayFlag();
                            $away_flag = '<img class="flag-sm" src="/images/flags/'.$away_flag.'">';
                            $home_team_name = $_match->getHomeTeamName();
                            $away_team_name = $_match->getAwayTeamName();
                            $home_win = 0;
                            $away_win = 0;
                            if ($_match->getHomeSet1Score() > $_match->getAwaySet1Score()) $home_win = $home_win + 1;
                            if ($_match->getHomeSet2Score() > $_match->getAwaySet2Score()) $home_win = $home_win + 1;
                            if ($_match->getHomeSet3Score() > $_match->getAwaySet3Score()) $home_win = $home_win + 1;
                            if ($_match->getHomeSet4Score() > $_match->getAwaySet4Score()) $home_win = $home_win + 1;
                            if ($_match->getHomeSet5Score() > $_match->getAwaySet5Score()) $home_win = $home_win + 1;
                            if ($_match->getHomeSet1Score() < $_match->getAwaySet1Score()) $away_win = $away_win + 1;
                            if ($_match->getHomeSet2Score() < $_match->getAwaySet2Score()) $away_win = $away_win + 1;
                            if ($_match->getHomeSet3Score() < $_match->getAwaySet3Score()) $away_win = $away_win + 1;
                            if ($_match->getHomeSet4Score() < $_match->getAwaySet4Score()) $away_win = $away_win + 1;
                            if ($_match->getHomeSet5Score() < $_match->getAwaySet5Score()) $away_win = $away_win + 1;
                            if ($home_win > $away_win) $away_team_name = '<span style="color:#858585">'.$_match->getAwayTeamName().'</span>';
                            if ($home_win < $away_win) $home_team_name = '<span style="color:#858585">'.$_match->getHomeTeamName().'</span>';
                            $home_team_seed = '<span class="h6-ff3 weight-light">('.$_match->getHomeTeamSeed().')</span> ';
                            $away_team_seed = '<span class="h6-ff3 weight-light">('.$_match->getAwayTeamSeed().')</span> ';
                            if ($home_win > $away_win) $away_team_seed = '<span class="h6-ff3 weight-light" style="color:#858585">('.$_match->getAwayTeamSeed().')</span> ';
                            if ($home_win < $away_win) $home_team_seed = '<span class="h6-ff3 weight-light" style="color:#858585">('.$_match->getHomeTeamSeed().')</span> ';
                            $home_set1_score = $_match->getHomeSet1Score();
                            $home_set2_score = $_match->getHomeSet2Score();
                            $home_set3_score = $_match->getHomeSet3Score();
                            $home_set4_score = $_match->getHomeSet4Score();
                            $home_set5_score = $_match->getHomeSet5Score();
                            $away_set1_score = $_match->getAwaySet1Score();
                            $away_set2_score = $_match->getAwaySet2Score();
                            $away_set3_score = $_match->getAwaySet3Score();
                            $away_set4_score = $_match->getAwaySet4Score();
                            $away_set5_score = $_match->getAwaySet5Score();
                            $home_set1_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet1Tiebreak().'</sup></span>';
                            $home_set2_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet2Tiebreak().'</sup></span>';
                            $home_set3_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet3Tiebreak().'</sup></span>';
                            $home_set4_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet4Tiebreak().'</sup></span>';
                            $home_set5_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet5Tiebreak().'</sup></span>';
                            $away_set1_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet1Tiebreak().'</sup></span>';
                            $away_set2_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet2Tiebreak().'</sup></span>';
                            $away_set3_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet3Tiebreak().'</sup></span>';
                            $away_set4_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet4Tiebreak().'</sup></span>';
                            $away_set5_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet5Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet1Score() > $_match->getAwaySet1Score()) $away_set1_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet1Score().'</span>';
                            if ($_match->getHomeSet1Score() < $_match->getAwaySet1Score()) $home_set1_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet1Score().'</span>';
                            if ($_match->getHomeSet2Score() > $_match->getAwaySet2Score()) $away_set2_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet2Score().'</span>';
                            if ($_match->getHomeSet2Score() < $_match->getAwaySet2Score()) $home_set2_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet2Score().'</span>';
                            if ($_match->getHomeSet3Score() > $_match->getAwaySet3Score()) $away_set3_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet3Score().'</span>';
                            if ($_match->getHomeSet3Score() < $_match->getAwaySet3Score()) $home_set3_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet3Score().'</span>';
                            if ($_match->getHomeSet4Score() > $_match->getAwaySet4Score()) $away_set4_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet4Score().'</span>';
                            if ($_match->getHomeSet4Score() < $_match->getAwaySet4Score()) $home_set4_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet4Score().'</span>';
                            if ($_match->getHomeSet5Score() > $_match->getAwaySet5Score()) $away_set5_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet5Score().'</span>';
                            if ($_match->getHomeSet5Score() < $_match->getAwaySet5Score()) $home_set5_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet5Score().'</span>';
                            if ($_match->getHomeSet1Tiebreak() > $_match->getAwaySet1Tiebreak()) $home_set1_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet1Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet2Tiebreak() > $_match->getAwaySet2Tiebreak()) $home_set2_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet2Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet3Tiebreak() > $_match->getAwaySet3Tiebreak()) $home_set3_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet3Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet4Tiebreak() > $_match->getAwaySet4Tiebreak()) $home_set4_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet4Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet5Tiebreak() > $_match->getAwaySet5Tiebreak()) $home_set5_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet5Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet1Tiebreak() < $_match->getAwaySet1Tiebreak()) $away_set1_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet1Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet2Tiebreak() < $_match->getAwaySet2Tiebreak()) $away_set2_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet2Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet3Tiebreak() < $_match->getAwaySet3Tiebreak()) $away_set3_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet3Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet4Tiebreak() < $_match->getAwaySet4Tiebreak()) $away_set4_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet4Tiebreak().'</sup></span>';
                            if ($_match->getHomeSet5Tiebreak() < $_match->getAwaySet5Tiebreak()) $away_set5_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet5Tiebreak().'</sup></span>';
                            $output .= '<div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                                    <div class="col-sm-12 box-sm" style="height:'.$box_height.'px;">
                                        <div class="col-sm-12 h5-ff3 weight-regular margin-tb-sm no-padding-lr">
                                            <div class="col-sm-7 no-padding-lr">
                                                <div class="col-sm-2 no-padding-right padding-left-sm">'.$home_flag.'</div>
                                                <div class="col-sm-10 no-padding-right padding-left-xs" style="padding-top:2px;">';
                            if ($_match->getHomeTeamSeed() != '') $output .= $home_team_seed;
                            $output .=                  $home_team_name.
                                '</div>
                                            </div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $home_set1_score;
                            if ($_match->getHomeSet1Tiebreak() != '') $output .= $home_set1_tiebreak;
                            $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $home_set2_score;
                            if ($_match->getHomeSet2Tiebreak() != '') $output .= $home_set2_tiebreak;
                            $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $home_set3_score;
                            if ($_match->getHomeSet3Tiebreak() != '') $output .= $home_set3_tiebreak;
                            $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $home_set4_score;
                            if ($_match->getHomeSet4Tiebreak() != '') $output .= $home_set4_tiebreak;
                            $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $home_set5_score;
                            if ($_match->getHomeSet5Tiebreak() != '') $output .= $home_set5_tiebreak;
                            $output .=          '</div>
                                        </div>
                                        <div class="col-sm-12 h5-ff3 weight-regular margin-tb-sm no-padding-lr">
                                            <div class="col-sm-7 no-padding-lr">
                                                <div class="col-sm-2 no-padding-right padding-left-sm">'.$away_flag.'</div>
                                                <div class="col-sm-10 no-padding-right padding-left-xs" style="padding-top:2px;">';
                            if ($_match->getAwayTeamSeed() != '') $output .= $away_team_seed;
                            $output .=                  $away_team_name.
                                '</div>
                                            </div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $away_set1_score;
                            if ($_match->getAwaySet1Tiebreak() != '') $output .= $away_set1_tiebreak;
                            $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $away_set2_score;
                            if ($_match->getAwaySet2Tiebreak() != '') $output .= $away_set2_tiebreak;
                            $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $away_set3_score;
                            if ($_match->getAwaySet3Tiebreak() != '') $output .= $away_set3_tiebreak;
                            $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $away_set4_score;
                            if ($_match->getAwaySet4Tiebreak() != '') $output .= $away_set4_tiebreak;
                            $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                $away_set5_score;
                            if ($_match->getAwaySet5Tiebreak() != '') $output .= $away_set5_tiebreak;
                            $output .=          '</div>
                                        </div>
                                    </div>';
                            $j = $j + 1;
                        }
                        $output .= '</div>';
                        $i = $i + 1;
                        $j = 0;
                    }
                    $k++;
                }
                $output .= '</div>';
                array_push($views, $output);
            }
            $output2 = '';
            for ($view = 0; $view <= 4; $view++) {
                $output2 .= $views[$view];
            }
            return $output2;
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
                    ORDER BY stage_id, round_id, match_date, match_time;';
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

        public static function getTennisMatchSql($tournament_id) {
            $sql = 'SELECT t.id AS home_id, t.name AS home_team_name, htt.seed AS home_team_seed, 
                n.flag_filename AS home_flag_filename, n.alternative_flag_filename AS home_alternative_flag_filename,
                t2.id AS away_id, t2.name AS away_team_name, att.seed AS away_team_seed, 
                n2.flag_filename AS away_flag_filename, n2.alternative_flag_filename AS away_alternative_flag_filename,
                home_set1_score, away_set1_score, home_set1_tiebreak, away_set1_tiebreak,
                home_set2_score, away_set2_score, home_set2_tiebreak, away_set2_tiebreak,
                home_set3_score, away_set3_score, home_set3_tiebreak, away_set3_tiebreak,
                home_set4_score, away_set4_score, home_set4_tiebreak, away_set4_tiebreak,
                home_set5_score, away_set5_score, home_set5_tiebreak, away_set5_tiebreak,
                match_date, match_order,
                g.name AS round,
                m.tournament_id
            FROM `match` m
                LEFT JOIN team t ON t.id = m.home_team_id
                LEFT JOIN team t2 ON t2.id = m.away_team_id
                LEFT JOIN `group` g ON g.id = m.round_id
                LEFT JOIN team_tournament htt ON (htt.team_id = m.home_team_id AND htt.tournament_id = m.tournament_id)
                LEFT JOIN team_tournament att ON (att.team_id = m.away_team_id AND att.tournament_id = m.tournament_id)  
                LEFT JOIN team_player tp ON tp.team_id = t.id  
                LEFT JOIN player p ON p.id = tp.player_id 
                LEFT JOIN nation n ON n.id = p.nation_id  
                LEFT JOIN team_player tp2 ON tp2.team_id = t2.id  
                LEFT JOIN player p2 ON p2.id = tp2.player_id 
                LEFT JOIN nation n2 ON n2.id = p2.nation_id 
            WHERE m.tournament_id = '.$tournament_id.'
            ORDER BY match_order;';
            return $sql;
        }

        public static function getMatchArrayByGroup($match_dto) {
            $matches = $match_dto->getMatches();
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                $result[$matches[$i]->getGroupName()][$matches[$i]->getMatchOrder()] = $matches[$i];
            }
            return $result;
        }

        public static function getMatchArrayByDate($match_dto) {
            $matches = $match_dto->getMatches();
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                $result[$matches[$i]->getRound()][$matches[$i]->getMatchDate()][$matches[$i]->getMatchOrder()] = $matches[$i];
            }
            return $result;
        }

        public static function getMatchArraySecondStage($match_dto) {
            $matches = $match_dto->getMatches();
            $match_count = sizeof($matches);
            $result = array();
            $tmp_match = $matches[$match_count - 2];
            $matches[$match_count - 2] = $matches[$match_count - 1];
            $matches[$match_count - 1] = $tmp_match;
            for ($i = $match_count - 16; $i < $match_count; $i++) {
                if ($matches[$i]->getStage() == 'Second Stage') {
                    $result[$matches[$i]->getRound()][$matches[$i]->getMatchOrder()] = $matches[$i];
                }
            }
            return $result;
        }

        public static function getTennisMatchArrayByRound($match_dto) {
            $matches = $match_dto->getMatches();
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                $result[$matches[$i]->getRound()][$matches[$i]->getMatchOrder()] = $matches[$i];
            }
            return $result;
        }

        public static function randomMatchScore($row) {
            $tmp_row = $row;
            $tmp_row['home_team_score'] = mt_rand(0,6);
            $tmp_row['away_team_score'] = mt_rand(0,6);
            if ($tmp_row['home_team_score'] == $tmp_row['away_team_score']) {
                $tmp_row['home_team_extra_time_score'] = mt_rand(0,3);
                $tmp_row['away_team_extra_time_score'] = mt_rand(0,3);
            }
            if ($tmp_row['home_team_extra_time_score'] == $tmp_row['away_team_extra_time_score']) {
                $rand = mt_rand(0,21);
                switch ($rand) {
                    case 0:
                        $tmp_row['home_team_penalty_score'] = 1;
                        $tmp_row['away_team_penalty_score'] = 0;
                        break;
                    case 1:
                        $tmp_row['home_team_penalty_score'] = 2;
                        $tmp_row['away_team_penalty_score'] = 0;
                        break;
                    case 2:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 0;
                        break;
                    case 3:
                        $tmp_row['home_team_penalty_score'] = 2;
                        $tmp_row['away_team_penalty_score'] = 1;
                        break;
                    case 4:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 1;
                        break;
                    case 5:
                        $tmp_row['home_team_penalty_score'] = 4;
                        $tmp_row['away_team_penalty_score'] = 1;
                        break;
                    case 6:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 2;
                        break;
                    case 7:
                        $tmp_row['home_team_penalty_score'] = 4;
                        $tmp_row['away_team_penalty_score'] = 2;
                        break;
                    case 8:
                        $tmp_row['home_team_penalty_score'] = 4;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 9:
                        $tmp_row['home_team_penalty_score'] = 5;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 10:
                        $tmp_row['home_team_penalty_score'] = 5;
                        $tmp_row['away_team_penalty_score'] = 4;
                        break;
                    case 11:
                        $tmp_row['home_team_penalty_score'] = 0;
                        $tmp_row['away_team_penalty_score'] = 1;
                        break;
                    case 12:
                        $tmp_row['home_team_penalty_score'] = 0;
                        $tmp_row['away_team_penalty_score'] = 2;
                        break;
                    case 13:
                        $tmp_row['home_team_penalty_score'] = 0;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 14:
                        $tmp_row['home_team_penalty_score'] = 1;
                        $tmp_row['away_team_penalty_score'] = 2;
                        break;
                    case 15:
                        $tmp_row['home_team_penalty_score'] = 1;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 16:
                        $tmp_row['home_team_penalty_score'] = 1;
                        $tmp_row['away_team_penalty_score'] = 4;
                        break;
                    case 17:
                        $tmp_row['home_team_penalty_score'] = 2;
                        $tmp_row['away_team_penalty_score'] = 3;
                        break;
                    case 18:
                        $tmp_row['home_team_penalty_score'] = 2;
                        $tmp_row['away_team_penalty_score'] = 4;
                        break;
                    case 19:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 4;
                        break;
                    case 20:
                        $tmp_row['home_team_penalty_score'] = 3;
                        $tmp_row['away_team_penalty_score'] = 5;
                        break;
                    default:
                        $tmp_row['home_team_penalty_score'] = 4;
                        $tmp_row['away_team_penalty_score'] = 5;
                }
            }
            return $tmp_row;
        }

        public static function isGoldenGoalRule($golden_goal_rule) {
            return $golden_goal_rule == 1;
        }

        public static function showBracket($match_dto) {
            $matches = $match_dto->getMatches();
            $where = 'Round of 16';
            if ($matches[0]->getTournamentId() == 13) $where = 'Semifinals';
            return $where;
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

    class MatchDTO {
        private $matches;
        private $count;
        private $html;

        protected function __construct(){ }

        public static function CreateSoccerMatchDTO($matches, $count, $html) {
            $match_dto = new MatchDTO();
            $match_dto->matches = $matches;
            $match_dto->count = $count;
            $match_dto->html = $html;
            return $match_dto;
        }

        public static function CreateTennisMatchDTO($matches, $count, $html) {
            $match_dto = new MatchDTO();
            $match_dto->matches = $matches;
            $match_dto->count = $count;
            $match_dto->html = $html;
            return $match_dto;
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
