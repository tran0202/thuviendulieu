<?php
    include_once('class.match.php');
    include_once('class.team.php');

    class Football {

        const PRESEASON = 'Preseason';
        const REGULAR_SEASON = 'Regular Season';
        const POST_SEASON = 'Post Season';
        const DIVISION = 'Division';
        const CONFERENCE = 'Conference';
        const LEAGUE = 'League';

        private $id;

        protected function __construct() { }

        public static function CreateFootball($id) {
            $s = new Football();
            $s->id = $id;
            return $s;
        }

        public static function getPreseasonRanking($tournament) {
            self::getStanding($tournament, self::PRESEASON);
        }

        public static function getRegularSeasonRanking($tournament) {
            self::getStanding($tournament, self::REGULAR_SEASON);
        }

        public static function getStanding($tournament, $season) {
            $start_index = 0;
            $end_index = 65;
            if ($season == self::REGULAR_SEASON) {
                $start_index = 65;
                $end_index = 321;
            }
            $matches = $tournament->getMatches();
            $team_array = self::getTeamArrayByName($tournament->getPreseasonTeams());
            if ($season == self::REGULAR_SEASON) {
                $team_array = self::getTeamArrayByName($tournament->getTeams());
            }
            for ($i = $start_index; $i < $end_index; $i++ ) {
                self::calculateStat($team_array, $matches[$i]);
            }
        }

        public static function calculateStat(&$teams, $match) {
            $home_name = $match->getHomeTeamName();
            $away_name = $match->getAwayTeamName();
            $home_team = $teams[$home_name];
            $away_team = $teams[$away_name];
            $home_score = $match->getHomeTeamScore();
            $away_score = $match->getAwayTeamScore();
            if ($home_score > $away_score) {
                $home_team->setWin($home_team->getWin() + 1);
                $away_team->setLoss($away_team->getLoss() + 1);
                $home_team->setRoadWin($home_team->getRoadWin() + 1);
                $away_team->setHomeLoss($away_team->getHomeLoss() + 1);
                if ($home_team->getParentGroupName().$home_team->getGroupName() == $away_team->getParentGroupName().$away_team->getGroupName()) {
                    $home_team->setDivWin($home_team->getDivWin() + 1);
                    $away_team->setDivLoss($away_team->getDivLoss() + 1);
                }
                if ($home_team->getParentGroupName() == $away_team->getParentGroupName()) {
                    $home_team->setConfWin($home_team->getConfWin() + 1);
                    $away_team->setConfLoss($away_team->getConfLoss() + 1);
                }
                $home_streak = $home_team->getStreak();
                array_push($home_streak, 'W');
                $home_team->setStreak($home_streak);
                $away_streak = $away_team->getStreak();
                array_push($away_streak, 'L');
                $away_team->setStreak($away_streak);
            }
            elseif ($home_score < $away_score) {
                $home_team->setLoss($home_team->getLoss() + 1);
                $away_team->setWin($away_team->getWin() + 1);
                $home_team->setRoadLoss($home_team->getRoadLoss() + 1);
                $away_team->setHomeWin($away_team->getHomeWin() + 1);
                if ($home_team->getParentGroupName().$home_team->getGroupName() == $away_team->getParentGroupName().$away_team->getGroupName()) {
                    $home_team->setDivLoss($home_team->getDivLoss() + 1);
                    $away_team->setDivWin($away_team->getDivWin() + 1);
                }
                if ($home_team->getParentGroupName() == $away_team->getParentGroupName()) {
                    $home_team->setConfLoss($home_team->getConfLoss() + 1);
                    $away_team->setConfWin($away_team->getConfWin() + 1);
                }
                $home_streak = $home_team->getStreak();
                array_push($home_streak, 'L');
                $home_team->setStreak($home_streak);
                $away_streak = $away_team->getStreak();
                array_push($away_streak, 'W');
                $away_team->setStreak($away_streak);
            }
            else {
                if ($home_score != -1) {
                    $home_team->setDraw($home_team->getDraw() + 1);
                    $away_team->setDraw($away_team->getDraw() + 1);
                    $home_team->setRoadTie($home_team->getRoadTie() + 1);
                    $away_team->setHomeTie($away_team->getHomeTie() + 1);
                    if ($home_team->getParentGroupName().$home_team->getGroupName() == $away_team->getParentGroupName().$away_team->getGroupName()) {
                        $home_team->setDivTie($home_team->getDivTie() + 1);
                        $away_team->setDivTie($away_team->getDivTie() + 1);
                    }
                    if ($home_team->getParentGroupName() == $away_team->getParentGroupName()) {
                        $home_team->setConfTie($home_team->getConfTie() + 1);
                        $away_team->setConfTie($away_team->getConfTie() + 1);
                    }
                    $home_streak = $home_team->getStreak();
                    array_push($home_streak, 'T');
                    $home_team->setStreak($home_streak);
                    $away_streak = $away_team->getStreak();
                    array_push($away_streak, 'T');
                    $away_team->setStreak($away_streak);
                }
            }
        }

        public static function getTeamStreak($streak_array) {
            $result = '';
            $streak_letter = '';
            $streak_count = 0;
            for ($i = 0; $i < sizeof($streak_array); $i++) {
                if ($streak_array[$i] != $streak_letter) {
                    $streak_letter = $streak_array[$i];
                    $streak_count = 1;
                }
                else {
                    $streak_count = $streak_count + 1;
                }
            }
            if ($streak_count > 0) $result = $streak_letter.$streak_count;
            return $result;
        }

        public static function getLast5($streak_array) {
            $win_count = 0;
            $tie_count = 0;
            $loss_count = 0;
            $start_index = 0;
            if (sizeof($streak_array) > 5) $start_index = sizeof($streak_array) - 5;
            for ($i = $start_index; $i < sizeof($streak_array); $i++) {
                if ($streak_array[$i] == 'W') {
                    $win_count = $win_count + 1;
                }
                elseif ($streak_array[$i] == 'L') {
                    $loss_count = $loss_count + 1;
                }
                else {
                    $tie_count = $tie_count + 1;
                }
            }
            return $win_count.'-'.$loss_count.'-'.$tie_count;
        }

        public static function sortGroupStanding($teams, $matches) {
            $teams_copy = $teams;
            for ($i = 0; $i < sizeof($teams) - 1; $i++) {
                for ($j = $i + 1; $j < sizeof($teams); $j++) {
                    self::compareTeams($teams_copy[$i], $teams_copy[$j], $matches);
                }
            }
            return $teams_copy;
        }

        public static function compareTeams(&$team1, &$team2, $matches) {
            if (self::isHigherStanding($team2, $team1)) {
                self::swapTeam($team1, $team2);
            }
        }

        public static function isHigherStanding($t1, $t2) {
            $match_play1 = $t1->getWin() + $t1->getLoss() + $t1->getDraw();
            $match_play2 = $t2->getWin() + $t2->getLoss() + $t2->getDraw();
            if ($match_play1 == 0 && $match_play2 == 0) return false;
            if ($match_play1 == 0) {
                return $t2->getWin() < $t2->getLoss();
            }
            if ($match_play2 == 0) {
                return $t1->getWin() >= $t1->getLoss();
            }
            $pt1 = $t1->getWin() + $t1->getDraw() * 0.5;
            $pt2 = $t2->getWin() + $t2->getDraw() * 0.5;
            $pct1 = $pt1 / $match_play1;
            $pct2 = $pt2 / $match_play2;
            if ($pct1 > $pct2) {
                return true;
            }
            elseif ($pct1 == $pct2) {
                if ($pt1 == 0 && $pt2 == 0) {
                    return $t1->getLoss() < $t2->getLoss();
                }
                return $pt1 > $pt2;
            }
            return false;
        }

        public static function isEqualStanding($t1, $t2) {
            return $t1->getWin() == $t2->getWin() && $t1->getLoss() == $t2->getLoss();
        }

        public static function applyTiebreaker(&$t1, &$t2, $matches) {
            $still_tie = false;
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getHomeTeamName() == $t1->getName() && $matches[$i]->getAwayTeamName() == $t2->getName()) {
                    if ($matches[$i]->getHomeTeamScore() < $matches[$i]->getAwayTeamScore()) {
                        self::swapTeam($t1, $t2);
                    }
                    elseif ($matches[$i]->getHomeTeamScore() == $matches[$i]->getAwayTeamScore()) {
                        $still_tie = true;
                    }
                    break;
                }
                elseif ($matches[$i]->getAwayTeamName() == $t1->getName() && $matches[$i]->getHomeTeamName() == $t2->getName()) {
                    if ($matches[$i]->getAwayTeamScore() < $matches[$i]->getHomeTeamScore()) {
                        self::swapTeam($t1, $t2);
                    }
                    elseif ($matches[$i]->getAwayTeamScore() == $matches[$i]->getHomeTeamScore()) {
                        $still_tie = true;
                    }
                    break;
                }
            }
            return $still_tie;
        }

        public static function fairPlayRule(&$t1, &$t2) {
            if ($t2->getName() == 'JAPAN' && $t2->getTournamentName() == 1) {
                self::swapTeam($t1, $t2);
            }
            else {
                self::coinToss($t1, $t2);
            }
        }

        public static function coinToss(&$t1, &$t2) {
            $coin = mt_rand(0,1);
            if ($coin == 1) self::swapTeam($t1, $t2);
        }

        public static function swapTeam(&$t1, &$t2) {
            $tmp_t = $t1;
            $t1 = $t2;
            $t2 = $tmp_t;
        }

        public static function getNumberOfCompletedMatches($tournament) {
            $matches = $tournament->getMatches();
            $count = 0;
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                if ($matches[$i]->getHomeTeamScore() != -1) {
                    $count++;
                }
            }
            if ($count > 256) $count = 256;
            return $count;
        }

        public static function getTeamArrayByName($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[strtoupper($teams[$i]->getName())] = $teams[$i];
            }
            return $result;
        }

        public static function getFootballTeamArrayByConfDiv($teams, $matches) {
            $tmp_array = array();
            $tmp_array3 = array();
            foreach ($teams as $name => $_team) {
                $tmp_array[$_team->getParentGroupName().$_team->getGroupName()][$_team->getName()] = $_team;
            }
            foreach ($tmp_array as $group_name => $_teams) {
                $tmp_array2 = array();
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array2, $_team);
                }
                $tmp_array[$group_name] = self::sortGroupStanding($tmp_array2, $matches);
            }
            foreach ($tmp_array as $group_name => $_teams) {
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array3, $_team);
                }
            }
            $result = array();
            for ($i = 0; $i < sizeof($tmp_array3); $i++) {
                $result[$tmp_array3[$i]->getParentGroupLongName()]
                [$tmp_array3[$i]->getParentGroupName().$tmp_array3[$i]->getGroupName()]
                [$tmp_array3[$i]->getGroupOrder()] = $tmp_array3[$i];
            }
            return $result;
        }

        public static function getFootballTeamArrayByConf($teams, $matches) {
            $tmp_array = array();
            $tmp_array3 = array();
            foreach ($teams as $name => $_team) {
                $tmp_array[$_team->getParentGroupLongName()][$_team->getName()] = $_team;
            }
            foreach ($tmp_array as $group_name => $_teams) {
                $tmp_array2 = array();
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array2, $_team);
                }
                $tmp_array[$group_name] = self::sortGroupStanding($tmp_array2, $matches);
            }
            foreach ($tmp_array as $group_name => $_teams) {
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array3, $_team);
                }
            }
            $result = array();
            for ($i = 0; $i < sizeof($tmp_array3); $i++) {
                $result[$tmp_array3[$i]->getParentGroupLongName()][$tmp_array3[$i]->getParentGroupOrder()] = $tmp_array3[$i];
            }
            return $result;
        }

        public static function getFootballTeamArrayById($teams, $matches) {
            $tmp_array = array();
            $tmp_array3 = array();
            foreach ($teams as $name => $_team) {
                $tmp_array['NFL'][$_team->getName()] = $_team;
            }
            foreach ($tmp_array as $group_name => $_teams) {
                $tmp_array2 = array();
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array2, $_team);
                }
                $tmp_array[$group_name] = self::sortGroupStanding($tmp_array2, $matches);
            }
            foreach ($tmp_array as $group_name => $_teams) {
                foreach ($_teams as $_name => $_team) {
                    array_push($tmp_array3, $_team);
                }
            }
            $result = array();
            for ($i = 0; $i < sizeof($tmp_array3); $i++) {
                $result[$tmp_array3[$i]->getId()] = $tmp_array3[$i];
            }
            return $result;
        }

        public static function getMatchArray($matches) {
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                $result[$matches[$i]->getStage()][$matches[$i]->getRound()][$matches[$i]->getMatchDate()][$matches[$i]->getMatchOrder()] = $matches[$i];
            }
            return $result;
        }

        public static function getMatchTimeFormat($match) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $match->getMatchDate().' '.$match->getMatchTime());
            return $date->format('h:i A');
        }

        public static function getDefaultTabScript($week_start_date, $tab_array) {
            $default_tab = self::getDefaultTab($week_start_date, $tab_array);
            if (strpos($default_tab, 'Preseason') !== false) {
                $result = '<script>
                    $("#pills-Preseason-tab").tab("show");
                    $("#pills-'.$default_tab.'-tab").tab("show");
                    $("#pills-RegularSeason-1-tab").tab("show");
                    </script>';
            }
            else {
                $result = '<script>$(function() {
                            $("#pills-Preseason-1-tab").tab("show");
                            $("#pills-RegularSeason-tab").tab("show");
                            $("#pills-'.$default_tab.'-tab").tab("show");
                        });
                    </script>';
            }
            return $result;
        }

        public static function getDefaultTab($week_start_date, $tab_array) {
            $result = $tab_array[0];
            for ($i = 0; $i < sizeof($week_start_date); $i++) {
                $now = date_create('now');
                if ($now->format('Y-m-d') >= $week_start_date[$i]) {
                    if ($i == sizeof($week_start_date) - 1) $result = $tab_array[$i];
                    elseif ($now->format('Y-m-d') < $week_start_date[$i + 1]) $result = $tab_array[$i];
                }
            }
            return $result;
        }

        public static function getFootballScheduleHtml($tournament) {
            $week_start_date = array();
            $tab_array = array();
            $matches = self::getMatchArray($tournament->getMatches());
            $output = '<ul class="nav nav-pills nfl-nav1-pills h2-ff6" id="pills-tab" role="tablist">';
            foreach ($matches as $stage_name => $stages) {
                $stage_tab = str_replace(' ', '', $stage_name);
                $output .= '                    
                    <li class="nav-item">
                        <a class="nav-link" id="pills-'.$stage_tab.'-tab" data-toggle="pill" href="#pills-'.$stage_tab.'" 
                            role="tab" aria-controls="pills-'.$stage_tab.'" aria-selected="true">'.$stage_name.'</a>
                    </li>';
            }
            $output .= '</ul>
                <div class="tab-content padding-top-xs" id="pills-tabContent">';
            foreach ($matches as $stage_name => $stages) {
                $stage_tab = str_replace(' ', '', $stage_name);
                $output .= '<div class="tab-pane fade" id="pills-'.$stage_tab.'" role="tabpanel" aria-labelledby="pills-'.$stage_tab.'-tab">
                    <ul class="nav nav-pills nfl-nav2-pills h2-ff6" id="pills-tab-for-'.$stage_tab.'" role="tablist">';
                foreach ($stages as $week_name => $weeks) {
                    $week_tab = $stage_tab.'-'.str_replace('Week ', '', $week_name);
                    $week_link = str_replace('Week ', '', $week_name);
                    $output .= '                    
                    <li class="nav-item">
                        <a class="nav-link" id="pills-'.$week_tab.'-tab" data-toggle="pill" href="#pills-'.$week_tab.'" 
                            role="tab" aria-controls="pills-'.$week_tab.'" aria-selected="true">'.$week_link.'</a>
                    </li>';
                }
                $output .= '</ul>
                    <div class="tab-content padding-top-xs" id="pills-'.$stage_tab.'-tabContent">';
                foreach ($stages as $week_name => $weeks) {
                    $week_tab = $stage_tab.'-'.str_replace('Week ', '', $week_name);
                    $start_flag = true;
                    foreach ($weeks as $match_dates => $_matches) {
                        if ($start_flag) {
                            array_push($week_start_date, $match_dates);
                            array_push($tab_array, $week_tab);
                            $start_flag = false;
                        }
                    }
                    $output .= '<div class="tab-pane fade" id="pills-'.$week_tab.'" role="tabpanel" aria-labelledby="pills-'.$week_tab.'-tab">';
                    foreach ($weeks as $match_dates => $_matches) {
                        $output .= '<div class="col-sm-12 h3-ff3 border-bottom-gray2 margin-top-md">'
                            .$_matches[array_keys($_matches)[0]]->getMatchDateFmt().'</div>';
                        foreach ($_matches as $match_order => $_match) {
                            $home_team_tmp = $_match->getHomeTeamName();
                            $away_team_tmp = $_match->getAwayTeamName();
                            $home_logo_tmp = '<img style="width:40px" src="/images/nfl_logos/'.$_match->getHomeLogo().'">';
                            $away_logo_tmp = '<img style="width:40px" src="/images/nfl_logos/'.$_match->getAwayLogo().'">';
                            if ($_match->getHomeTeamName() == '') {
                                $home_team_tmp = '['.$_match->getWaitingHomeTeam().']';
                                $away_team_tmp = '['.$_match->getWaitingAwayTeam().']';
                                $home_logo_tmp = '';
                                $away_logo_tmp = '';
                            }
                            $score = 'at';
                            if ($_match->getHomeTeamScore() != -1) {
                                $score = $_match->getHomeTeamScore().'&nbsp;&nbsp;&nbsp;&nbsp;'.$_match->getAwayTeamScore();
                            }
                            $time_zone = 'CT';
                            $output .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                                        <div class="col-sm-1 padding-lr-xs">'.self::getMatchTimeFormat($_match).' '.$time_zone.'</div>
                                        <div class="col-sm-4 h2-ff3 padding-left-xs padding-right-xs text-right">'.$home_team_tmp.'</div>
                                        <div class="col-sm-1 padding-lr-xs text-right" style="width:40px">'.$home_logo_tmp.'</div>
                                        <div class="col-sm-1 h2-ff3 padding-left-md padding-right-xs text-center">'.$score.'</div>
                                        <div class="col-sm-1 padding-lr-md text-right" style="width:40px">'.$away_logo_tmp.'</div>
                                        <div class="col-sm-4 h2-ff3 padding-right-xs" style="padding-left:30px">'.$away_team_tmp.'</div>
                                    </div>';
                        }
                    }
                    $output .= '</div>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
            $output .= '</div>
                '.self::getDefaultTabScript($week_start_date, $tab_array);
            $tournament->concatBodyHtml($output);
        }

        public static function getFootballStandingsHtml($tournament) {
            $output = '<ul class="nav nav-pills nfl-nav1-pills h2-ff6" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="pills-Division-tab" data-toggle="pill" href="#pills-Division" 
                                role="tab" aria-controls="pills-Division" aria-selected="true">Division</a>
                        </li>                    
                        <li class="nav-item">
                            <a class="nav-link" id="pills-Conference-tab" data-toggle="pill" href="#pills-Conference" 
                                role="tab" aria-controls="pills-Conference" aria-selected="true">Conference</a>
                        </li>                    
                        <li class="nav-item">
                            <a class="nav-link" id="pills-League-tab" data-toggle="pill" href="#pills-League" 
                                role="tab" aria-controls="pills-League" aria-selected="true">League</a>
                        </li>
                    </ul>
                    <div class="tab-content padding-top-xs" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-Division" role="tabpanel" aria-labelledby="pills-Division-tab">
                            <ul class="nav nav-pills nfl-nav2-pills h2-ff6" id="pills-tab-for-Division" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-Division-Preseason-tab" data-toggle="pill" href="#pills-Division-Preseason" 
                                        role="tab" aria-controls="pills-Division-Preseason" aria-selected="true">Preseason</a>
                                </li>                    
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-Division-RegularSeason-tab" data-toggle="pill" href="#pills-Division-RegularSeason" 
                                        role="tab" aria-controls="pills-Division-RegularSeason" aria-selected="true">Regular Season</a>
                                </li>
                            </ul>
                            <div class="tab-content padding-top-xs" id="pills-Division-tabContent">
                                <div class="tab-pane fade" id="pills-Division-Preseason" role="tabpanel" aria-labelledby="pills-Division-Preseason-tab">'.
                                    self::getStandingsHtml($tournament, self::DIVISION, self::PRESEASON).'
                                </div>
                                <div class="tab-pane fade" id="pills-Division-RegularSeason" role="tabpanel" aria-labelledby="pills-Division-RegularSeason-tab">'.
                                    self::getStandingsHtml($tournament, self::DIVISION, self::REGULAR_SEASON).'
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Conference" role="tabpanel" aria-labelledby="pills-Conference-tab">
                            <ul class="nav nav-pills nfl-nav2-pills h2-ff6" id="pills-tab-for-Conference" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-Conference-Preseason-tab" data-toggle="pill" href="#pills-Conference-Preseason" 
                                        role="tab" aria-controls="pills-Conference-Preseason" aria-selected="true">Preseason</a>
                                </li>                    
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-Conference-RegularSeason-tab" data-toggle="pill" href="#pills-Conference-RegularSeason" 
                                        role="tab" aria-controls="pills-Conference-RegularSeason" aria-selected="true">Regular Season</a>
                                </li>
                            </ul>
                            <div class="tab-content padding-top-xs" id="pills-Conference-tabContent">
                                <div class="tab-pane fade" id="pills-Conference-Preseason" role="tabpanel" aria-labelledby="pills-Conference-Preseason-tab">'.
                                    self::getStandingsHtml($tournament, self::CONFERENCE, self::PRESEASON).'
                                </div>
                                <div class="tab-pane fade" id="pills-Conference-RegularSeason" role="tabpanel" aria-labelledby="pills-Conference-RegularSeason-tab">'.
                                    self::getStandingsHtml($tournament, self::CONFERENCE, self::REGULAR_SEASON).'
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-League" role="tabpanel" aria-labelledby="pills-League-tab">
                            <ul class="nav nav-pills nfl-nav2-pills h2-ff6" id="pills-tab-for-League" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-League-Preseason-tab" data-toggle="pill" href="#pills-League-Preseason" 
                                        role="tab" aria-controls="pills-League-Preseason" aria-selected="true">Preseason</a>
                                </li>                    
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-League-RegularSeason-tab" data-toggle="pill" href="#pills-League-RegularSeason" 
                                        role="tab" aria-controls="pills-League-RegularSeason" aria-selected="true">Regular Season</a>
                                </li>
                            </ul>
                            <div class="tab-content padding-top-xs" id="pills-League-tabContent">
                                <div class="tab-pane fade" id="pills-League-Preseason" role="tabpanel" aria-labelledby="pills-League-Preseason-tab">'.
                                    self::getStandingsHtml($tournament, self::LEAGUE, self::PRESEASON).'
                                </div>
                                <div class="tab-pane fade" id="pills-League-RegularSeason" role="tabpanel" aria-labelledby="pills-League-RegularSeason-tab">'.
                                    self::getStandingsHtml($tournament, self::LEAGUE, self::REGULAR_SEASON).'
                                </div>
                            </div>
                        </div>
                    </div>';
            $output .= '<script>
                            $("#pills-Division-tab").tab("show");
                            $("#pills-Division-Preseason-tab").tab("show");
                            $("#pills-Conference-Preseason-tab").tab("show");
                            $("#pills-League-Preseason-tab").tab("show");
                        </script>';
            $tournament->concatBodyHtml($output);
        }

        public static function getStandingsHtml($tournament, $grouping, $season) {
            $matches = $tournament->getMatches();
            $teams1 = array();
            $teams2 = array();
            $teams3 = array();
            if ($season == self::PRESEASON) {
                $teams1 = self::getFootballTeamArrayByConfDiv($tournament->getPreseasonTeams(), $matches);
                $teams2 = self::getFootballTeamArrayByConf($tournament->getPreseasonTeams(), $matches);
                $teams3 = self::getFootballTeamArrayById($tournament->getPreseasonTeams(), $matches);
            }
            elseif ($season == self::REGULAR_SEASON) {
                $teams1 = self::getFootballTeamArrayByConfDiv($tournament->getTeams(), $matches);
                $teams2 = self::getFootballTeamArrayByConf($tournament->getTeams(), $matches);
                $teams3 = self::getFootballTeamArrayById($tournament->getTeams(), $matches);
            }
            $output = '';
            if ($grouping == self::DIVISION) {
                $output .= self::getDivisionStandingsHtml($teams1);
            }
            elseif ($grouping == self::CONFERENCE) {
                $output .= self::getConferenceStandingsHtml($teams2);
            }
            else {
                $output .= self::getLeagueStandingsHtml($teams3);
            }
            return $output;
        }

        public static function getDivisionStandingsHtml($teams) {
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
                                        <div class="col-sm-4 no-padding-lr">'.$_team->getWin().'</div>
                                        <div class="col-sm-4 no-padding-lr">'.$_team->getLoss().'</div>
                                        <div class="col-sm-4 no-padding-lr">'.$_team->getDraw().'</div>
                                    </div>
                                    <div class="col-sm-5 no-padding-lr">
                                        <div class="col-sm-3 no-padding-lr">'.$_team->getHomeWin().'-'.$_team->getHomeLoss().'-'.$_team->getHomeTie().'</div>
                                        <div class="col-sm-3 no-padding-lr">'.$_team->getRoadWin().'-'.$_team->getRoadLoss().'-'.$_team->getRoadTie().'</div>
                                        <div class="col-sm-3 no-padding-lr">'.$_team->getDivWin().'-'.$_team->getDivLoss().'-'.$_team->getDivTie().'</div>
                                        <div class="col-sm-3 no-padding-lr">'.$_team->getConfWin().'-'.$_team->getConfLoss().'-'.$_team->getConfTie().'</div>
                                    </div>
                                    <div class="col-sm-2 no-padding-lr">
                                        <div class="col-sm-6 no-padding-lr">'.self::getTeamStreak($_team->getStreak()).'</div>
                                        <div class="col-sm-6 no-padding-lr">'.self::getLast5($_team->getStreak()).'</div>
                                    </div>
                                </div>';
                    }
                    $output .= '</div>';
                }
            }
            return $output;
        }

        public static function getConferenceStandingsHtml($teams) {
            $output = '';
            foreach ($teams as $parent_group_long_name => $_conferences) {
                $output .= '<div class="col-sm-12 h2-ff1 margin-top-md">'.$parent_group_long_name.'</div>';
                $output .= '
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
                foreach ($_conferences as $group_order => $_team) {
                    $output .= '<div class="col-sm-12 no-padding-lr h3-ff4 row padding-tb-sm">
                                <div class="col-sm-3 no-padding-lr">
                                    <div class="col-sm-2 no-padding-lr">
                                        <img src="/images/nfl_logos/'.$_team->getLogoFileName().'" style="width:40px;" />
                                    </div>
                                    <div class="col-sm-10 no-padding-lr" style="padding-top:8px;">'.$_team->getName().'</div>
                                </div>
                                <div class="col-sm-2 no-padding-lr">
                                    <div class="col-sm-4 no-padding-lr">'.$_team->getWin().'</div>
                                    <div class="col-sm-4 no-padding-lr">'.$_team->getLoss().'</div>
                                    <div class="col-sm-4 no-padding-lr">'.$_team->getDraw().'</div>
                                </div>
                                <div class="col-sm-5 no-padding-lr">
                                    <div class="col-sm-3 no-padding-lr">'.$_team->getHomeWin().'-'.$_team->getHomeLoss().'-'.$_team->getHomeTie().'</div>
                                    <div class="col-sm-3 no-padding-lr">'.$_team->getRoadWin().'-'.$_team->getRoadLoss().'-'.$_team->getRoadTie().'</div>
                                    <div class="col-sm-3 no-padding-lr">'.$_team->getDivWin().'-'.$_team->getDivLoss().'-'.$_team->getDivTie().'</div>
                                    <div class="col-sm-3 no-padding-lr">'.$_team->getConfWin().'-'.$_team->getConfLoss().'-'.$_team->getConfTie().'</div>
                                </div>
                                <div class="col-sm-2 no-padding-lr">
                                    <div class="col-sm-6 no-padding-lr">'.self::getTeamStreak($_team->getStreak()).'</div>
                                    <div class="col-sm-6 no-padding-lr">'.self::getLast5($_team->getStreak()).'</div>
                                </div>
                            </div>';
                }
                $output .= '</div>';
            }
            return $output;
        }

        public static function getLeagueStandingsHtml($teams) {
            $output = '<div class="col-sm-12 box-xl margin-top-lg">
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
            foreach ($teams as $id => $_team) {
                $output .= '<div class="col-sm-12 no-padding-lr h3-ff4 row padding-tb-sm">
                            <div class="col-sm-3 no-padding-lr">
                                <div class="col-sm-2 no-padding-lr">
                                    <img src="/images/nfl_logos/'.$_team->getLogoFileName().'" style="width:40px;" />
                                </div>
                                <div class="col-sm-10 no-padding-lr" style="padding-top:8px;">'.$_team->getName().'</div>
                            </div>
                            <div class="col-sm-2 no-padding-lr">
                                <div class="col-sm-4 no-padding-lr">'.$_team->getWin().'</div>
                                <div class="col-sm-4 no-padding-lr">'.$_team->getLoss().'</div>
                                <div class="col-sm-4 no-padding-lr">'.$_team->getDraw().'</div>
                            </div>
                            <div class="col-sm-5 no-padding-lr">
                                <div class="col-sm-3 no-padding-lr">'.$_team->getHomeWin().'-'.$_team->getHomeLoss().'-'.$_team->getHomeTie().'</div>
                                <div class="col-sm-3 no-padding-lr">'.$_team->getRoadWin().'-'.$_team->getRoadLoss().'-'.$_team->getRoadTie().'</div>
                                <div class="col-sm-3 no-padding-lr">'.$_team->getDivWin().'-'.$_team->getDivLoss().'-'.$_team->getDivTie().'</div>
                                <div class="col-sm-3 no-padding-lr">'.$_team->getConfWin().'-'.$_team->getConfLoss().'-'.$_team->getConfTie().'</div>
                            </div>
                            <div class="col-sm-2 no-padding-lr">
                                <div class="col-sm-6 no-padding-lr">'.self::getTeamStreak($_team->getStreak()).'</div>
                                <div class="col-sm-6 no-padding-lr">'.self::getLast5($_team->getStreak()).'</div>
                            </div>
                        </div>';
            }
            $output .= '</div>';
            return $output;
        }

        public static function getFootballMatches($tournament) {

            $sql = self::getFootballMatchSql($tournament->getTournamentId());
            self::getFootballMatchDb($tournament, $sql);
        }

        public static function getFootballMatchDb($tournament, $sql) {

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
                    if ($row['home_team_score'] != null) $home_team_score = $row['home_team_score'];
                    if ($row['away_team_score'] != null) $away_team_score = $row['away_team_score'];
                    if ($tournament->getFantasy() == Fantasy::All) {
                        $row = self::randomMatchScore($row);
                        $home_team_score = $row['home_team_score'];
                        $away_team_score = $row['away_team_score'];
                    }
                    elseif ($tournament->getFantasy() == Fantasy::Half) {
                        if ($i < 32) {
                            $row = self::randomMatchScore($row);
                            $home_team_score = $row['home_team_score'];
                            $away_team_score = $row['away_team_score'];
                        }
                        $i = $i + 1;
                    }
                    $match = Match::CreateSoccerMatch(
                        $row['home_team_id'], $row['home_team_name'], '', $row['away_team_id'], $row['away_team_name'], '',
                        $row['home_parent_team_id'], $row['home_parent_team_name'], $row['away_parent_team_id'], $row['away_parent_team_name'],
                        $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'],
                        $row['match_order'], $row['bracket_order'], $row['round'], $row['stage'], $row['group_name'], $row['parent_group_name'], $row['second_round_group_name'],
                        $row['tournament_id'], $row['tournament_name'],
                        $row['points_for_win'], $row['golden_goal_rule'], $row['waiting_home_team'], $row['waiting_away_team'],
                        $home_team_score, $away_team_score,
                        $row['home_team_extra_time_score'], $row['away_team_extra_time_score'],
                        $row['home_team_penalty_score'], $row['away_team_penalty_score'],
                        '', '', $row['home_logo'], $row['away_logo']);
                    array_push($matches, $match);
                }
                $tournament->setMatches($matches);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getFootballMatchSql($tournament_id) {
            $tournament_id_str = 'm.tournament_id = '.$tournament_id;
            if ($tournament_id == null) $tournament_id_str = '1 = 1';
            $sql = 'SELECT t.id AS home_team_id, UCASE(t.name) AS home_team_name, home_team_score, tl.logo_filename AS home_logo,
                        t2.id AS away_team_id, UCASE(t2.name) AS away_team_name, away_team_score, tl2.logo_filename AS away_logo,
                        pt.id AS home_parent_team_id, UCASE(pt.name) AS home_parent_team_name, pt2.id AS away_parent_team_id, UCASE(pt2.name) AS away_parent_team_name, 
                        home_team_extra_time_score, away_team_extra_time_score, home_team_penalty_score, away_team_penalty_score, 
                        DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
                        TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, match_order, bracket_order,
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
                    LEFT JOIN team_logo tl ON tl.team_id = t.id
                    LEFT JOIN team_logo tl2 ON tl2.team_id = t2.id 
                    LEFT JOIN team pt ON pt.id = t.parent_team_id 
                    LEFT JOIN team pt2 ON pt2.id = t2.parent_team_id
                    WHERE tou.tournament_type_id = 2
                    AND '.$tournament_id_str.'
                    ORDER BY stage_id, match_order, match_date, match_time;';
            return $sql;
        }

        public static function getFootballTeams($tournament) {

            $sql = self::getFootballTeamSql($tournament->getTournamentId());
            self::getFootballTeamDb($tournament, $sql);
        }

        public static function getFootballTeamDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $preseason_teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateFootballTeam($row['team_id'], $row['name'], $row['group_name'], $row['group_order'],
                        $row['parent_group_name'], $row['parent_group_long_name'], $row['parent_group_order'], $row['logo_filename']);
                    array_push($teams, $team);
                    $preseason_team = Team::CreateFootballTeam($row['team_id'], $row['name'], $row['group_name'], $row['group_order'],
                        $row['parent_group_name'], $row['parent_group_long_name'], $row['parent_group_order'], $row['logo_filename']);
                    array_push($preseason_teams, $preseason_team);
                }
                $tournament->setTeams($teams);
                $tournament->setPreseasonTeams($preseason_teams);
                $tournament->concatBodyHtml($output);
            }
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
    }
