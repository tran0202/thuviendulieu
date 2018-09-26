<?php

    class SoccerHtml {

        const USA_1990 = 10;
        const ITALY_1994 = 11;
        const MEXICO_1986 = 12;
        const CANADA_2015 = 31;
        const RIO_2016 = 33;
        const SWEDEN_1995 = 38;
        const CHINA_1991 = 39;
        const LONDON_2012 = 63;
        const BEIJING_2008 = 64;
        const ATHENS_2004 = 65;

        const TEAM = 1;
        const CLUB = 2;
        const MULTI_LEAGUE_TEAM = 3;

        const MATCHES_LINK_MODAL = 1;
        const MATCHES_LINK_COLLAPSE = 2;

        const MATCH_VIEW_1 = 1; // UNL Match & Schedule
        const MATCH_VIEW_2 = 2; // Match Modal on Group
        const MATCH_VIEW_3 = 3; // UNL Collapse on Standing
        const MATCH_VIEW_4 = 4; // Bracket
        const MATCH_VIEW_5 = 5; // UCL Match
        const MATCH_VIEW_6 = 6; // UCL Collapse on Standing

        const TEAM_VIEW_1 = 1;
        const TEAM_VIEW_2 = 2;

        const CONTENT = '_content';

        public static function getSoccerGroupHtml($tournament) {
            $teams = Team::getTeamArrayByGroup($tournament->getTeams());
            $output = self::getCollapseHtml('summary', 'Summary', self::getTournamentSummaryHtml($tournament));
            $output .= self::getStandingsHtml($tournament, $teams, null,
                self::TEAM, self::MATCHES_LINK_MODAL);
            $tournament->concatBodyHtml($output);
        }

        public static function getSoccerScheduleHtml($tournament) {
            $matches = $tournament->getMatches();
            $bracket_spot = self::getBracketSpot($matches);
            $output2 = '';
            $output = '';
            if ($bracket_spot != '') {
                $output .= self::getThirdPlaceRankingHtml($tournament);
                $output .= self::getCollapseHtml('bracket', 'Bracket', self::getBracketHtml($tournament, $bracket_spot));
            }
            $output2 .= self::getCollapseHtml('summary', 'Summary', self::getTournamentSummaryHtml($tournament));
            $matches = Match::getMatchArrayByRound($matches);
            foreach ($matches as $rounds => $_round) {
                if ($rounds == $bracket_spot && $tournament->getTournamentId() != 50) $output2 .= $output;
                $output2 .= '<div class="col-sm-12 h2-ff1 margin-top-md">'.$rounds.'</div>';
                $output2 .= self::getMatchesHtml($_round, self::TEAM,
                    $tournament->getSimulationMode() == Tournament::SIMULATION_MODE_1, false);
            }
            $tournament->concatBodyHtml($output2);
        }

        public static function getThirdPlaceRankingHtml($tournament) {
            $output = '';
            if (!self::isThirdPlaceRankingTournament($tournament)) return $output;
            $output .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                            <a class="link-modal" href="#" data-toggle="modal" data-target="#groupThirdPlaceStandingModal">
                                Ranking of third-placed teams</a>
                        </div>';
            return $output;
        }

        public static function getSoccerBracketHtml($tournament) {
            $tournament->concatBodyHtml(self::getBracketHtml($tournament, ''));
        }

        public static function getBracketHtml($tournament, $bracket_spot) {
            $bracket_matches = Match::getBracketMatches($tournament->getMatches());
            $output = '';
            $output .= '<div class="col-sm-12">';
            $output .= '<div class="row">';
            $i = 0;
            $j = 0;
            foreach ($bracket_matches as $bracket_round => $_bracket_matches) {
                $third_place_moving = '';
                if ($bracket_round == Soccer::THIRD_PLACE || $bracket_round == Soccer::BRONZE_MEDAL_MATCH) {
                    $third_place_moving = 'style="margin-left:-25%"';
                    if ($bracket_spot == Soccer::SEMIFINALS) $third_place_moving = 'style="margin-left:-25%;margin-top:60px;"';
                    if ($bracket_round == Soccer::BRONZE_MEDAL_MATCH) $third_place_moving = 'style="margin-left:-25%;margin-top:80px;"';
                }
                $prelim_style = '';
                if ($bracket_round == Soccer::PRELIMINARY_ROUND) $prelim_style = 'style="padding-left:5px;padding-right:0;"';

                $output .= '<div class="col-sm-3" '.$third_place_moving.'>
                            <div class="col-sm-12 bracket-gap-height-'.$i.$j.'"></div>
                            <div class="col-sm-12 margin-top-sm" '.$prelim_style.'>
                                <span class="h2-ff1">'.$bracket_round.'</span>
                            </div>';
                foreach ($_bracket_matches as $bracket_match_order => $_bracket_match) {
                    $output .= self::getMatchHtml($_bracket_match, self::TEAM, $bracket_match_order, false, self::MATCH_VIEW_4, $i, $j);
                    $j = $j + 1;
                }
                $output .= '</div>';
                $i = $i + 1;
                $j = 0;
            }
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        }

        public static function getTournamentSummaryHtml($tournament) {
            $matches = $tournament->getMatches();
            $output = '';
            $count = 0;
            $total_goals = 0;
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                if ($matches[$i]->getHomeTeamScore() != -1) {
                    $count++;
                    $total_goals += $matches[$i]->getHomeTeamScore() + $matches[$i]->getAwayTeamScore() +
                        $matches[$i]->getHomeTeamExtraTimeScore() + $matches[$i]->getAwayTeamExtraTimeScore();
                }
            }
            $gpg = 'NA';
            if ($count != 0) $gpg = round($total_goals / $count, 2, PHP_ROUND_HALF_UP);
            $output .= '<div class="col-sm-12 padding-tb-sm">
                        <div class="row">
                            <div class="col-sm-3 h3-ff3 font-bold text-right" style="padding-top:9px">Total matches played:</div>
                            <div class="col-sm-9 wb-stl-heading1 green">'.$count.'</div>
                        </div>
                        </div>
                        <div class="col-sm-12 padding-tb-sm">
                        <div class="row">
                            <div class="col-sm-3 h3-ff3 font-bold text-right" style="padding-top:9px">Total goals scored:</div>
                            <div class="col-sm-9 wb-stl-heading1 green">'.$total_goals.'</div>
                        </div>
                        </div>
                        <div class="col-sm-12 padding-tb-sm">
                        <div class="row">
                            <div class="col-sm-3 h3-ff3 font-bold text-right" style="padding-top:9px">Average goals per game:</div>
                            <div class="col-sm-9 wb-stl-heading1 green">'.$gpg.'</div>
                        </div>
                        </div>';
            return $output;
        }

        public static function getSoccerGroupModalHtml($tournament) {
            self::getGroupModalHtml($tournament, $tournament->getTeams(), self::TEAM, Soccer::First);
            if (self::isThirdPlaceRankingTournament($tournament)) {
                self::getGroupModalHtml($tournament, self::getThirdPlaceTeams($tournament), self::TEAM, Soccer::First);
            }
            self::getGroupModalHtml($tournament, $tournament->getSecondRoundTeams(), self::TEAM, Soccer::Second);
        }

        public static function getSoccerMatchesModalHtml($tournament) {
            self::getGroupModalHtml($tournament, $tournament->getTeams(),self::CLUB, Soccer::First);
        }

        public static function getSoccerMatchesMultiLeagueModalHtml($tournament) {
            self::getGroupModalHtml($tournament, $tournament->getTeams(),self::MULTI_LEAGUE_TEAM, Soccer::First);
        }

        public static function getGroupModalHtml($tournament, $teams, $team_type, $stage) {
            $league_teams = Team::getTeamArrayByParentGroup($teams);
            $output = '';
            foreach ($league_teams as $league_name => $group_teams) {
                foreach ($group_teams as $group_name => $_teams) {
                    $modal_body = '';
                    if ($group_name != '') {
                        $league_name_short = str_replace('League ', '', $league_name);
                        $group_id = $league_name_short.$group_name;
                        $table_name = 'Group '.$group_name;
                        if ($team_type == self::MULTI_LEAGUE_TEAM)
                            $table_name = '<span class="unl-league-'.$league_name_short.'">'.$league_name.'</span> - Group '.$group_name;
                        if ($group_name == Soccer::FINAL_ROUND) {
                            $group_id = 'FinalRound';
                            $table_name = $group_name;
                        }
                        elseif ($group_name == 'ThirdPlace') {
                            $table_name = 'Ranking of third-placed teams';
                        }
                        $modal_body .= self::getTeamTableHeaderHtml(false);
                        foreach ($_teams as $name => $_team) {
                            $modal_body .= self::getTeamHtml($tournament, $_team, $team_type, $stage, false,
                                null, $current_best_finish, $striped_row);
                        }
                        $output .= self::getModalHtml($group_id.'Standing', $table_name, $modal_body);
                    }
                }
            }
            $tournament->concatModalHtml($output);
        }

        public static function getSoccerScheduleModalHtml($tournament) {
            $group_matches = Match::getFirstStageMatchArrayByGroup($tournament->getMatches());
            $output = '';
            foreach ($group_matches as $group_name => $_matches) {
                $modal_body = '';
                if ($group_name != '') {
                    foreach ($_matches as $match_order => $_match) {
                        $modal_body .= self::getMatchHtml($_match, self::TEAM, $match_order,false, self::MATCH_VIEW_2);
                    }
                    $output .= self::getModalHtml($group_name.'Matches', 'Group '.$group_name, $modal_body);
                }
            }
            $tournament->setModalHtml($output);
        }

        public static function getModalHtml($group_name, $table_name, $modal_body) {
            if ($group_name == '') return '';
            $output = '<div class="modal fade group-modal" id="group'.$group_name.'Modal" tabindex="-1" role="dialog" 
                                    aria-labelledby="group'.$group_name.'ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content h3-ff3">
                            <div class="col-sm-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="modal-X" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-header padding-lr-lg" style="border-bottom:none;">
                                <div class="col-sm-12 border-bottom-gray2" id="group'.$group_name.'ModalLabel">'.$table_name.'</div>
                            </div>
                            <div class="modal-body padding-lr-lg" id="group'.$group_name.'ModalBody">';
            $output .= $modal_body;
            $output .= '
                            </div>
                            <div class="modal-footer no-border-top">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="modal-close" aria-hidden="true">Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
            return $output;
        }

        public static function getTeamTableHeaderHtml($all_time) {
            $output = '';
            $tournament_count_header = '<div class="col-sm-4"></div>';
            if ($all_time) $tournament_count_header = '<div class="box-col-lg"></div><div class="box-col-sm">T</div>';
            $output .= '<div class="col-sm-12 padding-top-md padding-bottom-md font-bold team-row">
                        <div class="row">
                            <div class="box-col-md" style="margin-top:-3px;padding-left:15px;"></div>';
            $output .= $tournament_count_header;
            $output .= '    <div class="box-col-sm">MP</div>
                            <div class="box-col-sm">W</div>
                            <div class="box-col-sm">D</div>
                            <div class="box-col-sm">L</div>
                            <div class="box-col-sm">GF</div>
                            <div class="box-col-sm">GA</div>
                            <div class="box-col-sm">+/-</div>
                            <div class="box-col-sm">Pts</div>
                        </div>    
                        </div>';
            return $output;
        }

        public static function getTeamHtml($tournament, $_team, $team_type, $stage, $from_ranking, $all_time, &$current_best_finish, &$striped) {
            $output = '';
            $goal_diff = $_team->getGoalDiff();
            if ($_team->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;
            if (!$from_ranking) {
                $striped = '';
                if (self::isTeamAdvancedSecondRound($tournament, $_team, $stage)) {
                    $striped = 'advanced-second-round-striped';
                }
            }
            else {
                if ($current_best_finish != $_team->getBestFinish()) {
                    if ($striped == 'ranking-striped') {
                        $striped = '';
                    } else {
                        $striped = 'ranking-striped';
                    }
                    $current_best_finish = $_team->getBestFinish();
                }
                if ($all_time) $striped = '';
            }
            $tc_col = '<div class="col-sm-4">'.$_team->getName().'</div>';
            if ($all_time) $tc_col = '<div class="box-col-lg">'.$_team->getName().'</div>
                                                <div class="box-col-sm"><a id="popover_'.$_team->getCode().'" data-toggle="popover"
                                                    data-container="body" data-placement="right" data-html="true"
                                                    data-trigger="focus" tabindex="0" style="cursor:pointer;">'.$_team->getTournamentCount().'</a></div>';
            if (!$all_time || ($all_time && $_team->getMatchPlay() != 0)) {
                $output .=     '<div class="col-sm-12 padding-tb-md team-row '.$striped.'">
                                <div class="row">
                                        <div class="box-col-md" style="margin-top:-3px;padding-left:15px;">';
                if ($team_type == self::CLUB) {
                    $output .= '<img height=32 src="/images/club_logos/'.$_team->getLogoFilename().'">';
                    $output .= '<img class="flag-sm" src="/images/flags/'.$_team->getFlagFilename().'">';
                }
                else {
                    if ($_team->getFlagFilename() == 'Olympic.png') $output .= '<img class="flag-md" style="height:25px;" src="/images/flags/Olympic.png">';
                    else $output .= '<img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'">';
                }
                $output .=     '</div>
                                        '.$tc_col.'
                                        <div class="box-col-sm">'.$_team->getMatchPlay().'</div>
                                        <div class="box-col-sm">'.$_team->getWin().'</div>
                                        <div class="box-col-sm">'.$_team->getDraw().'</div>
                                        <div class="box-col-sm">'.$_team->getLoss().'</div>
                                        <div class="box-col-sm">'.$_team->getGoalFor().'</div>
                                        <div class="box-col-sm">'.$_team->getGoalAgainst().'</div>
                                        <div class="box-col-sm">'.$goal_diff.'</div>
                                        <div class="box-col-sm">'.$_team->getPoint().'</div>
                                </div>    
                                </div>';
            }
            return $output;
        }

        public static function getSoccerPopoverHtml($tournament) {
            $teams = $tournament->getTeams();
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
            $tournament->concatPopoverHtml($output);
        }

        public static function getAllTimeSoccerPopoverHtml($tournament) {
            $tt = array();
            $tournament_teams = $tournament->getTournamentTeams();
            $teams = $tournament->getTeams();
            $output = '';
            for ($i = 0; $i < sizeof($tournament_teams); $i++) {
                $team_name = $tournament_teams[$i]->getName();
                if ($tournament_teams[$i]->getParentName() != null) {
                    $team_name =  $tournament_teams[$i]->getParentName();
                }
                $tt[$team_name][$tournament_teams[$i]->getTournamentName()] = $tournament_teams[$i];
            }
            for ($i = 0; $i < sizeof($teams); $i++) {
                $tournament_text = 'tournaments';
                if ($teams[$i]->getTournamentCount() == 1) $tournament_text = 'tournament';
                $output .= '
                    <div id="popover-content-'.$teams[$i]->getCode().'" class="d-none">
                        <div class="row">
                            <div class="col-sm-3" style="padding-top:5px"><img class="flag-md" src="/images/flags/'.$teams[$i]->getFlagFilename().'"></div>
                            <div class="col-sm-9"><span class="h2-ff1"><b>'.$teams[$i]->getName().'</b></span></div>
                        </div>
                        <p><span class="wb-stl-heading1 russia-2018">'.$teams[$i]->getTournamentCount().'</span> '.$tournament_text.'</p>';
                $team_name = $teams[$i]->getName();
                if ($teams[$i]->getParentName() != null) {
                    $team_name =  $teams[$i]->getParentName();
                }
                $tmp_finish = Soccer::Group;
                $champ_count = 0;
                $output2 = self::getFinishLiteral($tmp_finish);
                $output3 = '';
                foreach ($tt[$team_name] as $tournament_names => $_team) {
                    if ($tmp_finish < $_team->getBestFinish()) {
                        $tmp_finish = $_team->getBestFinish();
                        $output2 = self::getFinishLiteral($_team->getBestFinish());
                    }
                    if ($_team->getBestFinish() == Soccer::Champion) $champ_count++;
                    $output3 .= '<p><b>'.self::getShortTournamentName($tournament_names).':</b> <i>'.self::getFinishLiteral($_team->getBestFinish()).'</i></p>';
                }
                $champ_count_text = '';
                if ($champ_count > 1) $champ_count_text = '('.$champ_count.')';
                $output .= '
                        <p><b>Best Finish:</b> <span class="h3-ff1 blue">'.$output2.$champ_count_text.'</span></p>
                        <p><hr></p>
                        '.$output3.'
                    </div>';
            }
            $tournament->concatPopoverHtml($output);
        }

        public static function getSoccerRankingHtml($tournament) {
            $tournament->concatBodyHtml(self::getRankingHtml($tournament, $tournament->getTeams(), false));
        }

        public static function getAllTimeSoccerRankingHtml($tournament) {
            $tournament->concatBodyHtml(self::getRankingHtml($tournament, $tournament->getTeams(), true));
        }

        public static function getRankingHtml($tournament, $teams, $all_time) {
            if (sizeof($teams) == 0) return null;
            if (!$all_time) $teams = Team::getTeamArrayByBestFinish($teams);
            $title = 'Tournament Rankings';
            if ($all_time) {
                $title = 'All Time Rankings';
            }

            $output = '<div class="col-sm-12 h2-ff2 margin-top-lg">'.$title.'</div>
                        <div class="col-sm-12 h2-ff3 box-xl">';
            $output .= self::getTeamTableHeaderHtml($all_time);

            $current_best_finish = $teams[0]->getBestFinish();
            $striped_row = 'ranking-striped';

            for ($i = 0; $i < sizeof($teams); $i++) {
                $output .= self::getTeamHtml($tournament, $teams[$i], self::TEAM, null, true,
                    $all_time, $current_best_finish, $striped_row);
            }
            $output .= '</div>';
            return $output;
        }

        public static function getSoccerStandingsHtml($tournament) {
            $teams = Team::getTeamArrayByGroup($tournament->getTeams());
            $output = self::getStandingsHtml($tournament, $teams, null,
                self::CLUB, self::MATCHES_LINK_COLLAPSE);
            $tournament->concatBodyHtml($output);
        }

        public static function getSoccerStandingsMultiLeagueHtml($tournament) {
            $teams = Team::getTeamArrayByParentGroup($tournament->getTeams());
            $tournament_name = 'Tournament'.self::getValidHtmlId($tournament->getProfile()->getName());
            $output = '<div class="col-sm-12 margin-top-sm">
                        <ul class="nav nav-tabs nav-justified h2-ff6" id="'.$tournament_name.'LeagueTab" role="tablist">';
            foreach ($teams as $parent_group_name => $_teams) {
                $league_name = self::getValidHtmlId($parent_group_name);
                $output .= '<li class="nav-item">
                                <a class="nav-link" id="'.$league_name.'-tab" data-toggle="tab" href="#'.$league_name.self::CONTENT.'" 
                                    role="tab" aria-controls="'.$league_name.self::CONTENT.'" aria-selected="true">'.$parent_group_name.'</a>
                            </li>';
            }
            $output .= '</ul>
                        <div class="tab-content" id="'.$tournament_name.'LeagueTabContent">';
            foreach ($teams as $parent_group_name => $league_teams) {
                $league_name = self::getValidHtmlId($parent_group_name);
                $output .= '<div class="tab-pane fade" id="'.$league_name.self::CONTENT.'" role="tabpanel" aria-labelledby="'.$league_name.'-tab">';
                $output .= self::getStandingsHtml($tournament, $league_teams, $parent_group_name,
                    self::MULTI_LEAGUE_TEAM, self::MATCHES_LINK_COLLAPSE);
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<script>
                            $(function() {
                                $("#'.$tournament_name.'LeagueTab li:first-child a").tab("show");
                            });
                        </script>';
            $tournament->concatBodyHtml($output);
        }

        public static function getStandingsHtml($tournament, $teams, $parent_group_name, $team_type, $matches_link_type) {
            $output = '';
            $output .= '<div class="margin-top-sm">';
            foreach ($teams as $group_name => $_teams) {
                $output .= '<div class="col-sm-12 margin-top-md">
                        <span class="col-sm-2 h2-ff2">Group '.$group_name.'</span>';
                if ($matches_link_type == self::MATCHES_LINK_MODAL) {
                    $output .= '<span class="col-sm-2 wb-stl-heading4 margin-left-md" style="margin-top:15px;">
                                <a class="link-modal" data-toggle="modal" data-target="#group'.$group_name.'MatchesModal">Matches</a>
                            </span>';
                }
                $output .= '</div>
                    <div class="col-sm-12 h2-ff3 box-xl">';
                $output .= self::getTeamTableHeaderHtml(false);
                foreach ($_teams as $name => $_team) {
                    $output .= self::getTeamHtml($tournament, $_team, $team_type, Soccer::First, false,
                        false, $current_best_finish, $striped_row);
                }
                $output .= '</div>';
                if ($matches_link_type == self::MATCHES_LINK_COLLAPSE) {
                    $output .= self::getCollapseHtml(self::getValidHtmlId($parent_group_name).$group_name.'matches', 'Matches',
                        self::getGroupMatchesCollapseHtml($tournament, $team_type, $parent_group_name, $group_name));
                }
            }
            $output .= '</div>';
            return $output;
        }

        public static function getGroupMatchesCollapseHtml($tournament, $team_type, $parent_group_name, $group_name) {
            if ($team_type == self::MULTI_LEAGUE_TEAM) {
                $group_matches = Match::getFirstStageMatchArrayByParentGroupRound($tournament->getMatches());
                $group_matches = $group_matches[$parent_group_name][$group_name];
            }
            else {
                $group_matches = Match::getFirstStageMatchArrayByGroupRound($tournament->getMatches());
                $group_matches = $group_matches[$group_name];
            }
            $output = '';
            foreach ($group_matches as $round_name => $rounds) {
                $output .= '<div class="col-sm-12 h3-ff3 border-bottom-gray2 margin-top-md">'.$round_name.'</div>';
                foreach ($rounds as $match_order => $_match) {
                    if ($team_type == self::MULTI_LEAGUE_TEAM) {
                        $output .= self::getMatchHtml($_match, $team_type, $match_order, false, self::MATCH_VIEW_3);
                    }
                    else {
                        $output .= self::getMatchHtml($_match, $team_type, $match_order, false, self::MATCH_VIEW_6);
                    }
                }
            }
            return $output;
        }

        public static function getSoccerMatchesOneLeagueHtml($tournament) {
            self::getSoccerMatchesHtml($tournament, self::CLUB, false);
        }

        public static function getSoccerMatchesMultiLeagueHtml($tournament) {
            self::getSoccerMatchesHtml($tournament, self::MULTI_LEAGUE_TEAM, false);
        }

        public static function getSoccerMatchesHtml($tournament, $team_type, $look_ahead) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $image_type = Team::FLAG;
            if ($team_type == self::CLUB) $image_type = Team::LOGO;
            $output = '';
            $output .= '<div class="margin-top-sm">';
            $output .= self::getCollapseFilteringTeamsHtml($tournament, $image_type);
            $output .= '<div class="tab-content" id="filter-tabContent">';
            $output .= '<div class="tab-pane fade" id="All'.self::CONTENT.'" role="tabpanel" aria-labelledby="All-tab">';
            $output .= self::getAllMatchesHtml($tournament, $team_type, $look_ahead);
            $output .= '</div>';
            foreach ($teams as $name => $_team) {
                $team_tab = self::getValidHtmlId($name);
                $output .= '<div class="tab-pane fade" id="'.$team_tab.self::CONTENT.'" role="tabpanel" aria-labelledby="'.$team_tab.'-tab">';
                $output .= self::getTeamMatchesHtml($tournament, $name, $team_type, $look_ahead);
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $tournament->concatBodyHtml($output);
        }

        public static function getAllMatchesHtml($tournament, $team_type, $look_ahead) {
            $matchDay_start = array();
            $tab_array = array();
            $matches = $tournament->getMatches();
            $matches = Match::getMatchArrayByRound($matches);
            $tournament_name = 'Tournament'.self::getValidHtmlId($tournament->getProfile()->getName());
            $output = '';
            $output .= '<div class="col-sm-12 margin-top-sm">
                        <ul class="nav nav-tabs h4-ff6" id="'.$tournament_name.'MatchDayTab" role="tablist">';
            foreach ($matches as $rounds => $_round) {
                $round_name = self::getValidHtmlId($rounds);
                $output .= '<li class="nav-item">
                                    <a class="nav-link" id="'.$round_name.'-tab" data-toggle="tab" href="#'.$round_name.self::CONTENT.'"
                                        role="tab" aria-controls="'.$round_name.self::CONTENT.'" aria-selected="true">'.$rounds.'</a>
                                </li>';
            }
            $output .= '</ul>
                        <div class="tab-content" id="matchDay-tabContent">';
            foreach ($matches as $rounds => $_round) {
                $round_name = self::getValidHtmlId($rounds);
                $start_flag = true;
                foreach ($_round as $match_dates => $_matches) {
                    if ($start_flag) {
                        array_push($matchDay_start, $match_dates);
                        array_push($tab_array, $round_name);
                        $start_flag = false;
                    }
                }
                $output .= '<div class="tab-pane fade" id="'.$round_name.self::CONTENT.'" role="tabpanel" aria-labelledby="'.$round_name.'-tab">';
                $output .= self::getMatchesHtml($_round, $team_type, $look_ahead, false);
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</div>
                '.self::getDefaultTabScript($matchDay_start, $tab_array);
            return $output;
        }

        public static function getTeamMatchesHtml($tournament, $name, $team_type, $look_ahead) {
            $matches = $tournament->getMatches();
            $matches = Match::getMatchArrayByTeam($matches, $name);
            $output = '';
            $output .= '<div class="col-sm-12 margin-top-sm">';
            $output .= self::getMatchesHtml($matches, $team_type, $look_ahead, true);
            $output .= '</div>';
            return $output;
        }

        public static function getMatchesHtml($matches, $team_type, $look_ahead, $show_round) {
            $output = '';
            foreach ($matches as $match_dates => $_matches) {
                $output .= '<div class="col-sm-12 h3-ff3 border-bottom-gray2 margin-top-md">';
                if ($show_round) $output .= $_matches[array_keys($_matches)[0]]->getRound().': ';
                $output .= $_matches[array_keys($_matches)[0]]->getMatchDateFmt().'</div>';
                foreach ($_matches as $match_order => $_match) {
                    if ($team_type == self::MULTI_LEAGUE_TEAM || $team_type == self::TEAM) {
                        $output .= self::getMatchHtml($_match, $team_type, $match_order, $look_ahead, self::MATCH_VIEW_1);
                    }
                    else {
                        $output .= self::getMatchHtml($_match, $team_type, $match_order, $look_ahead, self::MATCH_VIEW_5);
                    }
                }
            }
            return $output;
        }

        public static function getMatchHtml($_match, $team_type, $match_order, $look_ahead, $match_view, $i = 0, $j = 0) {
            $output = '';
            $match_date = $_match->getMatchDate();
            $match_time = $_match->getMatchTimeFmt();
            $time_zone = '';
            if ($_match->getTournamentId() == 1) $time_zone = 'CST';
            $group_text = '';
            $league_name = $_match->getParentGroupName();
            $league_name_short = str_replace('League ', '', $league_name);
            if ($team_type == self::MULTI_LEAGUE_TEAM) $group_text .= '<span class="unl-league-'.$league_name_short.'">'.$league_name.'</span> - ';
            if ($_match->getStage() == Soccer::FIRST_STAGE || $_match->getStage() == Soccer::GROUP_STAGE) {
                $group_name = $_match->getGroupName();
                if ($_match->getRound() == Soccer::SECOND_ROUND || $_match->getRound() == Soccer::FINAL_ROUND)
                    $group_name = $_match->getSecondRoundGroupName();
                $group_anchor = 'Group '.$group_name;
                if ($_match->getRound() == Soccer::FINAL_ROUND) $group_anchor = $_match->getSecondRoundGroupName();
                if ($_match->getRound() == Soccer::FINAL_ROUND) $group_name = $_match->getSecondRoundGroupName();
                $group_id = str_replace('League ', '', $_match->getParentGroupName()).$group_name;
                if ($group_name == Soccer::FINAL_ROUND) $group_id = 'FinalRound';
                $group_text .= '<a class="link-modal" href="#" data-toggle="modal" data-target="#group'.$group_id.'StandingModal">'.$group_anchor.'</a>' ;
            }
            $home_flag = '';
            $away_flag = '';
            if ($_match->getHomeTeamCode() != '') {
                $home_flag = '<img class="flag-md" src="/images/flags/'.$_match->getHomeFlag().'">';
                $away_flag = '<img class="flag-md" src="/images/flags/'.$_match->getAwayFlag().'">';
            }
            $home_team_name = $_match->getHomeTeamName();
            $away_team_name = $_match->getAwayTeamName();
            $home_logo = '<img height="32" src="/images/club_logos/'.$_match->getHomeLogo().'">';
            $away_logo = '<img height="32" src="/images/club_logos/'.$_match->getAwayLogo().'">';
            if ($_match->getHomeTeamName() == '') {
                $home_team_name = '['.$_match->getWaitingHomeTeam().']';
                $away_team_name = '['.$_match->getWaitingAwayTeam().']';
                $home_logo = '';
                $away_logo = '';
            }
            $home_small_flag = '<img class="flag-sm-2" src="/images/flags/'.$_match->getHomeFlag().'">';
            $away_small_flag = '<img class="flag-sm-2" src="/images/flags/'.$_match->getAwayFlag().'">';
            $advance_popover = '';
            $advance_popover2 = '';
            if ($look_ahead && $match_order > 32 && $match_order <= 48) {
                $advance_popover = ' <a id="popover_'.$_match->getHomeTeamCode().'" data-toggle="popover" 
                                data-container="body" data-placement="right" type="button" 
                                data-html="true" tabindex="0" data-trigger="focus"><span class="fa fa-futbol-o" 
                                style="font-size:medium;vertical-align:middle;"></span></a>';
                $advance_popover2 = '<a id="popover_'.$_match->getAwayTeamCode().'" data-toggle="popover" 
                                data-container="body" data-placement="left" type="button" 
                                data-html="true" tabindex="0" data-trigger="focus"><span class="fa fa-futbol-o" 
                                style="font-size:medium;vertical-align:middle;"></span></a> ';
            }
            $score = 'vs';
            $penalty_score = '';
            $extra_time_score = '';
            $aggregate_score = '';
            $replay_score = '';
            $home_team_color = '';
            $away_team_color = '';
            if ($_match->getHomeTeamScore() != -1) {
                $aet = ' aet';
                if (self::isGoldenGoalRule($_match->getGoldenGoalRule()) && !Match::isFirstStage($_match) && $_match->getHomeTeamPenaltyScore() == '') $aet = ' gg';
                $score = $_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore();
                if ($_match->getHomeTeamScore() == $_match->getAwayTeamScore() &&
                    (($_match->getStage() != Soccer::FIRST_STAGE && $_match->getStage() != Soccer::GROUP_STAGE && $_match->getStage() != Soccer::QUALIFYING_STAGE
                     && $_match->getTournamentId() != 50 && $_match->getTournamentId() != 51) || $_match->getRound() == Soccer::PLAY_OFF)) {
                    $score = ($_match->getHomeTeamScore()+$_match->getHomeTeamExtraTimeScore()).
                        '-'.($_match->getAwayTeamScore()+$_match->getAwayTeamExtraTimeScore()).$aet;
                    if ($_match->getHomeTeamExtraTimeScore() == $_match->getAwayTeamExtraTimeScore()) {
                        if ($_match->getHomeTeamPenaltyScore() != 0 || $_match->getAwayTeamPenaltyScore() != 0) {
                            $penalty_score = ' '.$_match->getHomeTeamPenaltyScore().'-'.$_match->getAwayTeamPenaltyScore().' pen';
                        }
                        if ($_match->getHomeTeamReplayScore() != null) {
                            $replay_score = '<br>'.$_match->getHomeTeamReplayScore().'-'.$_match->getAwayTeamReplayScore().' rep';
                        }
                    }
                }
                if (self::isShowOvertimeScore($_match->getRound())) {
                    if ($_match->getHomeTeamScore() > $_match->getAwayTeamScore()) {
                        $away_team_color = 'gray3';
                    }
                    elseif ($_match->getHomeTeamScore() < $_match->getAwayTeamScore()) {
                        $home_team_color = 'gray3';
                    }
                    else {
                        if ($_match->getHomeTeamExtraTimeScore() > $_match->getAwayTeamExtraTimeScore()) {
                            $extra_time_score .= $home_team_name.' win after extra time';
                            $away_team_color = 'gray3';
                        }
                        elseif ($_match->getHomeTeamExtraTimeScore() < $_match->getAwayTeamExtraTimeScore()) {
                            $extra_time_score .= $away_team_name.' win after extra time';
                            $home_team_color = 'gray3';
                        }
                        else {
                            if ($_match->getHomeTeamPenaltyScore() != 0 || $_match->getAwayTeamPenaltyScore() != 0) {
                                if ($_match->getHomeTeamPenaltyScore() > $_match->getAwayTeamPenaltyScore()) {
                                    $extra_time_score .= $home_team_name.' win on penalties '.$_match->getHomeTeamPenaltyScore().
                                        '-'.$_match->getAwayTeamPenaltyScore();
                                    $away_team_color = 'gray3';
                                }
                                else {
                                    $extra_time_score .= $away_team_name.' win on penalties '.$_match->getHomeTeamPenaltyScore().
                                        '-'.$_match->getAwayTeamPenaltyScore();
                                    $home_team_color = 'gray3';
                                }
                            }
                        }
                    }
                }
                if ($_match->getHomeTeamFirstLegScore() != null) {
                    $home_total_score = $_match->getHomeTeamFirstLegScore() + $_match->getHomeTeamScore();
                    $away_total_score = $_match->getAwayTeamFirstLegScore() + $_match->getAwayTeamScore();
                    if ($home_total_score > $away_total_score) {
                        $aggregate_score .= 'Agg '.$home_total_score.'-'.$away_total_score;
                        $away_team_color = 'gray3';
                    }
                    elseif ($home_total_score < $away_total_score) {
                        $aggregate_score .= 'Agg '.$home_total_score.'-'.$away_total_score;
                        $home_team_color = 'gray3';
                    }
                    else {
                        if ($_match->getHomeTeamFirstLegScore() > $_match->getAwayTeamScore()) {
                            $aggregate_score .= 'Agg '.$home_total_score.'-'.$away_total_score;
                            $aggregate_score .= ' >> '.$home_team_name.' win on away goals';
                            $away_team_color = 'gray3';
                        }
                        elseif ($_match->getHomeTeamFirstLegScore() < $_match->getAwayTeamScore()) {
                            $aggregate_score .= 'Agg '.$home_total_score.'-'.$away_total_score;
                            $aggregate_score .= ' >> '.$away_team_name.' win on away goals';
                            $home_team_color = 'gray3';
                        }
                        else {
                            $score = ($_match->getHomeTeamScore()+$_match->getHomeTeamExtraTimeScore()).
                                '-'.($_match->getAwayTeamScore()+$_match->getAwayTeamExtraTimeScore());
                            $aggregate_score .= 'Agg '.($home_total_score + $_match->getHomeTeamExtraTimeScore()).
                                '-'.($away_total_score + $_match->getAwayTeamExtraTimeScore());
                            if ($_match->getHomeTeamExtraTimeScore() > $_match->getAwayTeamExtraTimeScore()) {
                                $aggregate_score .= ' >> '.$home_team_name.' win after extra time';
                                $away_team_color = 'gray3';
                            }
                            elseif ($_match->getHomeTeamExtraTimeScore() < $_match->getAwayTeamExtraTimeScore()) {
                                $aggregate_score .= ' >> '.$away_team_name.' win after extra time';
                                $home_team_color = 'gray3';
                            }
                            else {
                                if ($_match->getHomeTeamPenaltyScore() > $_match->getAwayTeamPenaltyScore()) {
                                    $aggregate_score .= ' >> '.$home_team_name.' win on penalties '.$_match->getHomeTeamPenaltyScore().
                                        '-'.$_match->getAwayTeamPenaltyScore();
                                    $away_team_color = 'gray3';
                                }
                                else {
                                    $aggregate_score .= ' >> '.$away_team_name.' win on penalties '.$_match->getHomeTeamPenaltyScore().
                                        '-'.$_match->getAwayTeamPenaltyScore();
                                    $home_team_color = 'gray3';
                                }
                            }
                        }
                    }
                }
            }
            if ($_match->getSecondRoundGroupName() == Soccer::WITHDREW) $score = 'w/o';
            $bracket_gap_height_class = 'bracket-gap-height-00';
            if ($j != 0) {
                $bracket_gap_height_class = 'bracket-gap-height-'.$i.'1';
            }
            $home_team_code = $_match->getHomeTeamCode();
            $away_team_code = $_match->getAwayTeamCode();
            if ($_match->getTournamentId() == 62 && $_match->getAwayTeamCode() == 'FRA'
                && $_match->getRound() == Soccer::QUARTERFINALS)
                $away_team_code = $_match->getAwayTeamCode().' B';
            if ($_match->getHomeTeamCode() == '') {
                $home_team_code = '['.$_match->getWaitingHomeTeam().']';
                $away_team_code = '['.$_match->getWaitingAwayTeam().']';
            }
            if ($match_view == self::MATCH_VIEW_1) {
                $output .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                            <div class="row">
                                    <div class="col-sm-2">'.$match_time.' '.$time_zone.'<br>'.$group_text.'</div>
                                    <div class="col-sm-1 padding-lr-xs padding-top-xs text-right" style="padding-top:6px;">'.$home_flag.'</div>
                                    <div class="h2-ff3 padding-left-md padding-right-xs" style="width:30%;max-width:30%;">'.$home_team_name.$advance_popover.'</div>
                                    <div class="col-sm-1 h2-ff3 padding-lr-xs">'.$score.'<br>'.$penalty_score.'</div>
                                    <div class="h2-ff3 padding-lr-xs text-right" style="width:30%;max-width:30%;">'.$advance_popover2.$away_team_name.'</div>
                                    <div class="padding-lr-xs text-right" style="padding-top:6px;width:6%;max-width:6%;">'.$away_flag.'</div>
                            </div>
                            </div>';
            }
            elseif ($match_view == self::MATCH_VIEW_2) {
                $output .= '<div class="col-sm-12 h2-ff3 padding-tb-md border-bottom-gray5">
                            <div class="row">
                            <div class="col-sm-1">'.$home_flag.'</div>
                            <div class="col-sm-4" style="padding-top:3px;">'.$home_team_name.'</div>
                            <div class="col-sm-2 padding-lr-xs text-center" style="padding-top:3px;">'.$score.'</div>
                            <div class="col-sm-4 text-right" style="padding-top:3px;">'.$away_team_name.'</div>
                            <div class="col-sm-1 text-right">'.$away_flag.'</div>
                            </div>
                        </div>';
            }
            elseif ($match_view == self::MATCH_VIEW_3) {
                $output .= '<div class="col-sm-12 h2-ff3 padding-tb-md border-bottom-gray5">
                            <div class="row">
                                    <div class="col-sm-1 h6-ff3 padding-top-sm no-padding-right">'.$match_date.'<br>'.$match_time.'</div>
                                    <div class="col-sm-4 h2-ff3 padding-left-xs padding-right-xs padding-top-xs text-right">'.$home_team_name.'</div>
                                    <div class="col-sm-1 padding-lr-xs text-right">'.$home_flag.'</div>
                                    <div class="col-sm-1 h2-ff3 padding-left-md padding-right-xs text-center">'.$score.'</div>
                                    <div class="col-sm-1 padding-lr-xs text-right">'.$away_flag.'</div>
                                    <div class="col-sm-4 h2-ff3 padding-right-xs padding-top-xs" style="padding-left:30px">'.$away_team_name.'</div>
                            </div>
                            </div>';
            }
            elseif ($match_view == self::MATCH_VIEW_5 || $match_view == self::MATCH_VIEW_6) {
                if ($match_view == self::MATCH_VIEW_5) $match_date = '';
                if ($match_view == self::MATCH_VIEW_6) $group_text = '';
                $output .= '<div class="col-sm-12 padding-tb-md">
                            <div class="row">
                                        <div class="col-sm-1 h6-ff3">'.$match_date.' '.$match_time.' '.$time_zone.'<br>'.$group_text.'</div>
                                        <div class="col-sm-4 h2-ff3 padding-left-xs padding-right-xs text-right '.$home_team_color.'">'.
                                            $home_team_name.$advance_popover.'</div>
                                        <div class="col-sm-1 padding-lr-xs padding-top-xs text-right">'.$home_logo.$home_small_flag.'</div>
                                        <div class="col-sm-1 h2-ff3 padding-left-md padding-right-xs text-center">'.$score.'</div>
                                        <div class="col-sm-1 padding-lr-xs padding-top-xs text-right">'.$away_logo.$away_small_flag.'</div>
                                        <div class="col-sm-4 h2-ff3 padding-right-xs '.$away_team_color.'" style="padding-left:30px">'.
                                            $advance_popover2.$away_team_name.'</div>
                            </div>
                            </div>';
                if ($extra_time_score != '') {
                    $output .= '<div class="col-sm-12 padding-bottom-md border-bottom-gray5">
                            <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-5 text-center">'.$extra_time_score.'</div>
                                        <div class="col-sm-3"></div>
                            </div>
                            </div>';
                }
                if ($aggregate_score != '') {
                    $output .= '<div class="col-sm-12 padding-bottom-md border-bottom-gray5">
                            <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-5 text-center">'.$aggregate_score.'</div>
                                        <div class="col-sm-3"></div>
                            </div>
                            </div>';
                }
                if ($extra_time_score == '' && $aggregate_score == '') {
                    $output .= '<div class="col-sm-12 border-bottom-gray5">
                                    </div>';
                }
            }
            else {
                $output .= '<div class="col-sm-12 '.$bracket_gap_height_class.'"></div>
                            <div class="col-sm-12 box-sm bracket-box-height">
                            <div class="row no-margin-lr">
                                <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$home_flag.$home_team_code.'</div>
                                <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$score.$penalty_score.$replay_score.'</div>
                                <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$away_flag.$away_team_code.'</div>
                            </div>
                            </div>';
            }
            return $output;
        }

        public static function getDefaultTabScript($week_start_date, $tab_array) {
            if (sizeof($tab_array) == 0) return '';
            $result = $tab_array[0];
            for ($i = 0; $i < sizeof($week_start_date); $i++) {
                $now = date_create('now');
                if ($now->format('Y-m-d') >= $week_start_date[$i]) {
                    if ($i == sizeof($week_start_date) - 1) $result = $tab_array[$i];
                    elseif ($now->format('Y-m-d') < $week_start_date[$i + 1]) $result = $tab_array[$i];
                }
            }
            $result = '<script>$(function() {
                        $("#All-tab").tab("show");
                        $("#'.$result.'-tab").tab("show");
                    });
                </script>';
            return $result;
        }

        public static function getCollapseFilteringTeamsHtml($tournament, $image_type) {
            $id = 'filter';
            $output = self::getCollapseHtml($id, 'Filter by', self::getFilteringTeams($tournament, $id, $image_type));
            return $output;
        }

        public static function getCollapseHtml($id, $name, $body) {
            $output = '<div id="accordion-'.$id.'">
                            <div class="col-sm-12 padding-tb-md">
                                <div class="card-header" id="heading-'.$id.'">';
            $output .= '            <button class="btn btn-link collapsed h2-ff1 no-padding-left btn-collapse-'.$id.'" data-toggle="collapse"
                                        data-target="#collapse-'.$id.'" aria-expanded="false" aria-controls="collapse-'.$id.'">
                                            '.$name.' <i class="fa fa-angle-double-down font-custom1"></i>
                                    </button>
                                </div>
                                <div id="collapse-'.$id.'" class="collapse" aria-labelledby="heading-'.$id.'" data-parent="#accordion-'.$id.'">
                                    <div class="">
                                        ';
            $output .= $body;
            $output .=         '
                                    </div>
                                </div>
                            </div>
                        </div>';
            $output .= '<script>
                        $(function() {
                            $("#collapse-'.$id.'").on("hide.bs.collapse", function () {
                                $(".btn-collapse-'.$id.'").html(\''.$name.' <i class="fa fa-angle-double-down font-custom1"></i>\');
                            })
                            $("#collapse-'.$id.'").on("show.bs.collapse", function () {
                                $(".btn-collapse-'.$id.'").html(\''.$name.' <i class="fa fa-angle-double-up font-custom1"></i>\');
                            })
                        });
                        </script>';
            return $output;
        }

        public static function getFilteringTeams($tournament, $id, $image_type) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $tournament_name = 'Tournament'.self::getValidHtmlId($tournament->getProfile()->getName());
            ksort($teams);
            $output = '';
            $output .= '<style>
                            #'.$tournament_name.'FilterTab > li > a { width: 110px; height: 90px; }
                            #'.$tournament_name.'FilterTab > li.active > a { border: 1px solid #dddddd; }
                        </style>';
            $output .= '<ul class="nav nav-tabs h6-ff6 padding-top-xs" id="'.$tournament_name.'FilterTab" role="tablist">';
            $output .= '<li class="nav-item">
                            <a class="nav-link" id="All-tab" data-toggle="tab" href="#All'.self::CONTENT.'"
                                role="tab" aria-controls="All'.self::CONTENT.'" aria-selected="true">'.
                                TournamentProfile::getTournamentLogo($tournament->getProfile(), 32).
                                '<br>'.TournamentProfile::getAllFilteringText($tournament->getProfile()).'</a>
                        </li>';
            foreach ($teams as $name => $_team) {
                $team_tab = self::getValidHtmlId($name);
                $output .= '<li class="nav-item">
                                <a class="nav-link" id="'.$team_tab.'-tab" data-toggle="tab" href="#'.$team_tab.self::CONTENT.'" 
                                    role="tab" aria-controls="'.$team_tab.self::CONTENT.'" aria-selected="true">'.
                                    Team::getFilteringLogo($_team, $image_type).'<br>'.$name.'</a>
                            </li>';
            }
            $output .= '</ul>';
            $output .= '<script>
                            $(function() {
                                    $(".nav-tabs a").on("shown.bs.tab", function(){
                                        $("#collapse-'.$id.'").collapse("hide");
                                    });
                            });
                        </script>';
            return $output;
        }

        public static function getValidHtmlId($name) {
            $team_tab = str_replace(' ', '_', $name);
            $team_tab = str_replace('\'', '_', $team_tab);
            $team_tab = str_replace('.', '_', $team_tab);
            $team_tab = str_replace('/', '_', $team_tab);
            return 'T-'.$team_tab;
        }

        public static function getThirdPlaceTeams($tournament) {
            $result = array();
            $teams_tmp = array();
            $teams = $tournament->getTeams();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $team = Team::CloneSoccerTeam($teams[$i]->getId(), $teams[$i]->getName(), $teams[$i]->getCode(), 'ThirdPlace',
                    $teams[$i]->getGroupOrder(), $teams[$i]->getMatchPlay(), $teams[$i]->getWin(), $teams[$i]->getDraw(), $teams[$i]->getLoss(),
                    $teams[$i]->getGoalFor(), $teams[$i]->getGoalAgainst(), $teams[$i]->getGoalDiff(), $teams[$i]->getPoint());
                $team->setFlagFilename($teams[$i]->getFlagFilename());
                $teams_tmp[$teams[$i]->getGroupName()][$teams[$i]->getName()] = $team;
            }
            foreach ($teams_tmp as $group_name => $_teams) {
                $i = 1;
                foreach ($_teams as $name => $_team) {
                    if ($i == 3) array_push( $result, $_team);
                    $i++;
                }
            }

            return Soccer::sortGroupStanding($result, $tournament->getMatches());
        }

        public static function getBracketSpot($matches) {
            $spot = '';
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == Soccer::SECOND_STAGE) {
                    if ($matches[$i]->getRound() != Soccer::THIRD_PLACE && $matches[$i]->getRound() != Soccer::FINAL_) {
                        $spot = $matches[$i]->getRound();
                    }
                    break;
                }
            }
            return $spot;
        }

        public static function isThirdPlaceRankingTournament($tournament) {
            return ($tournament->getTournamentId() >= self::USA_1990 && $tournament->getTournamentId() <= self::MEXICO_1986)
                || $tournament->getTournamentId() == self::CANADA_2015 || $tournament->getTournamentId() == self::RIO_2016
                || $tournament->getTournamentId() == self::SWEDEN_1995 || $tournament->getTournamentId() == self::CHINA_1991
                || $tournament->getTournamentId() == self::LONDON_2012 || $tournament->getTournamentId() == self::BEIJING_2008
                || $tournament->getTournamentId() == self::ATHENS_2004;
        }

        public static function isGoldenGoalRule($golden_goal_rule) {
            return $golden_goal_rule == 1;
        }

        public static function isTeamAdvancedSecondRound($tournament, $team, $stage) {
            $result = false;
            if ($stage == Soccer::First) {
                $second_round_matches = Match::getSecondRoundMatches($tournament->getMatches());
                for ($i = 0; $i < sizeof($second_round_matches); $i++) {
                    if ($second_round_matches[$i]->getHomeTeamName() == $team->getName() || $second_round_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                $final_round_matches = Match::getFinalRoundMatches($tournament->getMatches());
                for ($i = 0; $i < sizeof($final_round_matches); $i++) {
                    if ($final_round_matches[$i]->getHomeTeamName() == $team->getName() || $final_round_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                $round16_matches = Match::getRound16Matches($tournament->getMatches());
                for ($i = 0; $i < sizeof($round16_matches); $i++) {
                    if ($round16_matches[$i]->getHomeTeamName() == $team->getName() || $round16_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                if (!$result) {
                    $quarterfinal_matches = Match::getQuarterfinalMatches($tournament->getMatches());
                    for ($i = 0; $i < sizeof($quarterfinal_matches); $i++) {
                        if ($quarterfinal_matches[$i]->getHomeTeamName() == $team->getName() || $quarterfinal_matches[$i]->getAwayTeamName() == $team->getName()) {
                            $result = true;
                            break;
                        }
                    }
                    if (!$result) {
                        $semifinal_matches = Match::getSemifinalMatches($tournament->getMatches());
                        for ($i = 0; $i < sizeof($semifinal_matches); $i++) {
                            if ($semifinal_matches[$i]->getHomeTeamName() == $team->getName() || $semifinal_matches[$i]->getAwayTeamName() == $team->getName()) {
                                $result = true;
                                break;
                            }
                        }
                    }
                }
            }
            else {
                $semifinal_matches = Match::getSemifinalMatches($tournament->getMatches());
                for ($i = 0; $i < sizeof($semifinal_matches); $i++) {
                    if ($semifinal_matches[$i]->getHomeTeamName() == $team->getName() || $semifinal_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                if (!$result) {
                    $third_place_match = Match::getThirdPlaceMatch($tournament->getMatches());
                    $final_match = Match::getFinalMatch($tournament->getMatches());
                    if ($third_place_match != null && $final_match != null) {
                        if ($third_place_match->getHomeTeamName() == $team->getName() || $third_place_match->getAwayTeamName() == $team->getName() ||
                            $final_match->getHomeTeamName() == $team->getName() || $final_match->getAwayTeamName() == $team->getName()) {
                            $result = true;
                        }
                    }
                }
                if (!$result) {
                    $bronze_medal_match = Match::getBronzeMedalMatch($tournament->getMatches());
                    $gold_medal_match = Match::getGoldMedalMatch($tournament->getMatches());
                    if ($bronze_medal_match != null && $gold_medal_match != null) {
                        if ($bronze_medal_match->getHomeTeamName() == $team->getName() || $bronze_medal_match->getAwayTeamName() == $team->getName() ||
                            $gold_medal_match->getHomeTeamName() == $team->getName() || $gold_medal_match->getAwayTeamName() == $team->getName()) {
                            $result = true;
                        }
                    }
                }
            }
            return $result;
        }

        public static function isShowOvertimeScore($round) {
            return $round == Soccer::PRELIMINARY_ROUND1 || $round == Soccer::PRELIMINARY_ROUND2;
        }

        public static function getFinishLiteral($finish) {
            switch($finish)
            {
                case Soccer::Group:
                    $best_finish = 'First Round';
                    break;
                case Soccer::Playoff:
                    $best_finish = 'First Round';
                    break;
                case Soccer::SecondRound:
                    $best_finish = 'Second Round';
                    break;
                case Soccer::FinalRound:
                    $best_finish = 'Second Round';
                    break;
                case Soccer::PreliminaryRound:
                    $best_finish = 'First Round';
                    break;
                case Soccer::FirstRound:
                    $best_finish = 'First Round';
                    break;
                case Soccer::ReplayFirstRound:
                    $best_finish = 'First Round';
                    break;
                case Soccer::Round16:
                    $best_finish = 'Second Round';
                    break;
                case Soccer::Quarterfinal:
                    $best_finish = 'Quarterfinals';
                    break;
                case Soccer::ReplayQuarterfinal:
                    $best_finish = 'Quarterfinals';
                    break;
                case Soccer::FifthPlace:
                    $best_finish = 'Fifth Place';
                    break;
                case Soccer::Semifinal:
                    $best_finish = 'Fourth Place';
                    break;
                case Soccer::BronzeMedal:
                    $best_finish = 'Bronze Medal';
                    break;
                case Soccer::SilverMedal:
                    $best_finish = 'Silver Medal';
                    break;
                case Soccer::GoldMedal:
                    $best_finish = 'Gold Medal';
                    break;
                case Soccer::ThirdPlace:
                    $best_finish = 'Third Place';
                    break;
                case Soccer::RunnerUp:
                    $best_finish = 'Runner-Up';
                    break;
                default:
                    $best_finish = 'Champion';
                    break;
            }
            return $best_finish;
        }

        public static function getShortTournamentName($name) {
            $olympic_tournament = false;
            if (strpos($name, 'Olympic') !== false) {
                $olympic_tournament = true;
            }
            $result = str_replace(' FIFA World Cup ', '', $name);
            $result = str_replace(' FIFA Women\'s World Cup ', '', $result);
            $result = str_replace('Women\'s Olympic Football Tournament ', '', $result);
            $result = str_replace('Olympic Football Tournament ', '', $result);
            if (!$olympic_tournament) $result = substr($result, -(strlen($result) - 4)).' '.substr($result, 0, 4);
            return $result;
        }
    }
