<?php
    include_once('class.match.php');
    include_once('class.team.php');

    class Football {

        const PRESEASON = 'Preseason';
        const REGULAR_SEASON = 'Regular Season';
        const POST_SEASON = 'Post Season';

        private $id;

        protected function __construct() { }

        public static function CreateFootball($id) {
            $s = new Football();
            $s->id = $id;
            return $s;
        }

        public static function getFootballTeamArrayByConfDiv($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getParentGroupLongName()]
                [$teams[$i]->getParentGroupName().' '.$teams[$i]->getGroupName()]
                [$teams[$i]->getGroupOrder()] = $teams[$i];
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

        public static function getFootballScheduleHtml($tournament) {
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
                    $week_link = str_replace('Week ', '', $week_name);
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
                                $score = $_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore();
                            }
                            $time_zone = 'CT';
                            $output .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                                        <div class="col-sm-2 padding-lr-xs">'.self::getMatchTimeFormat($_match).' '.$time_zone.'</div>
                                        <div class="col-sm-3 h2-ff3 padding-left-lg padding-right-xs">'.$home_team_tmp.'</div>
                                        <div class="col-sm-1 padding-lr-xs text-right" style="width:40px">'.$home_logo_tmp.'</div>
                                        <div class="col-sm-1 h2-ff3 padding-lr-xs text-right">'.$score.'</div>
                                        <div class="col-sm-1 padding-lr-xs text-right">'.$away_logo_tmp.'</div>
                                        <div class="col-sm-3 h2-ff3 padding-left-xs padding-right-xs">'.$away_team_tmp.'</div>
                                    </div>';
                        }
                    }
                    $output .= '</div>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
            $output .= '</div>';
            $tournament->concatBodyHtml($output);
        }

        public static function getFootballStandingsHtml($tournament) {
            $teams = self::getFootballTeamArrayByConfDiv($tournament->getTeams());
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
            $tournament->concatBodyHtml($output);
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
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateFootballTeam($row['name'], $row['group_name'], $row['group_order'],
                        $row['parent_group_long_name'], $row['parent_group_order'], $row['logo_filename']);
                    array_push($teams, $team);
                }
                $tournament->setTeams($teams);
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
