<?php

    class SoccerHtml {

        const RUSSIA_2018 = 1;
        const BRAZIL_2014 = 5;
        const SOUTH_AFRICA_2010 = 6;
        const GERMANY_2006 = 7;
        const USA_1994 = 10;
        const ITALY_1990 = 11;
        const MEXICO_1986 = 12;
        const ARGENTINA_1978 = 14;
        const GERMANY_1974 = 15;
        const MEXICO_1970 = 16;
        const ENGLAND_1966 = 17;
        const CHILE_1962 = 18;
        const SWEDEN_1958 = 19;
        const SWITZERLAND_1954 = 20;
        const ITALY_1934 = 23;
        const URUGUAY_1930 = 24;
        const CANADA_2015 = 31;
        const MENS_RIO_2016 = 32;
        const WOMENS_RIO_2016 = 33;
        const SWEDEN_1995 = 38;
        const CHINA_1991 = 39;
        const MUNICH_1972 = 50;
        const MEXICO_CITY_1968 = 51;
        const TOKYO_1964 = 52;
        const ROMA_1960 = 53;
        const BERLIN_1936 = 57;
        const PARIS_1924 = 59;
        const ANTWERP_1920 = 60;
        const STOCKHOLM_1912 = 61;
        const LONDON_1908 = 62;
        const LONDON_2012 = 63;
        const BEIJING_2008 = 64;
        const ATHENS_2004 = 65;
        const FRANCE_2016 = 68;
        const POLAND_UKRAINE_2012 = 69;
        const AUSTRIA_SWITZERLAND_2008 = 70;
        const PORTUGAL_2004 = 71;
        const BELGIUM_NETHERLANDS_2000 = 72;
        const ENGLAND_1996 = 73;
        const SWEDEN_1992 = 74;
        const WEST_GERMANY_1988 = 75;
        const FRANCE_1984 = 76;
        const ITALY_1980 = 77;
        const ITALY_1968 = 80;
        const USA_2016_CENTENARIO = 83;
        const CHILE_2015 = 84;
        const ARGENTINA_2011 = 85;
        const VENEZUELA_2007 = 86;
        const PERU_2004 = 87;
        const COLOMBIA_2001 = 88;
        const PARAGUAY_1999 = 89;
        const BOLIVIA_1997 = 90;
        const URUGUAY_1995 = 91;
        const ECUADOR_1993 = 92;
        const COPA_1983 = 96;
        const COPA_1979 = 97;
        const COPA_1975 = 98;
        const URUGUAY_1967 = 99;
        const BOLIVIA_1963 = 100;
        const ECUADOR_1959 = 101;
        const ARGENTINA_1959 = 102;
        const PERU_1957 = 103;
        const URUGUAY_1956 = 104;
        const CHILE_1955 = 105;
        const PERU_1953 = 106;
        const BRAZIL_1949 = 107;
        const ECUADOR_1947 = 108;
        const ARGENTINA_1946 = 109;
        const CHILE_1945 = 110;
        const URUGUAY_1942 = 111;
        const CHILE_1941 = 112;
        const PERU_1939 = 113;
        const ARGENTINA_1937 = 114;
        const CHILE_1926 = 118;
        const BRAZIL_1922 = 122;
        const BRAZIL_1919 = 125;
        const GOLD_CUP_2017 = 128;
        const GOLD_CUP_2015 = 129;
        const GOLD_CUP_2013 = 130;
        const GOLD_CUP_2011 = 131;
        const GOLD_CUP_2009 = 132;
        const GOLD_CUP_2007 = 133;
        const GOLD_CUP_2005 = 134;
        const GOLD_CUP_2002 = 136;
        const GOLD_CUP_2000 = 137;
        const GOLD_CUP_1996 = 139;
        const GOLD_CUP_1993 = 140;
        const CONCACAF_CHAMPIONSHIP_1989 = 142;
        const CONCACAF_CHAMPIONSHIP_1985 = 143;
        const HONDURAS_1981 = 144;
        const MEXICO_1977 = 145;
        const HAITI_1973 = 146;
        const TRINIDAD_1971 = 147;
        const COSTA_RICA_1969 = 148;
        const HONDURAS_1967 = 149;
        const GUATEMALA_1965 = 150;
        const EL_SALVADOR_1963 = 151;
        const GABON_2017 = 152;
        const EQUATORIAL_GUINEA_2015 = 153;
        const ANGOLA_2010 = 156;
        const SENEGAL_1992 = 167;
        const MOROCCO_1988 = 169;
        const GHANA_1978 = 174;
        const TUNISIA_1965 = 180;
        const GHANA_1963 = 181;
        const AUSTRALIA_2015 = 185;
        const LEBANON_2000 = 189;
        const UAE_1996 = 190;
        const IRAN_1968 = 197;
        const THAILAND_1972 = 196;
        const PAPUA_NEW_GUINEA_2016 = 201;
        const OFC_NATIONS_CUP_1996 = 208;
        const NEW_CALEDONIA_1980 = 209;
        const NEW_ZEALAND_1973 = 210;
        const RUSSIA_2017 = 211;
        const SAUDI_ARABIA_1995 = 219;

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

        const CONTENT = '-content';

        const TOURNAMENT = 1;
        const CONFEDERATION = 2;
        const ALL_TIME = 3;

        public static function getSoccerGroupHtml($tournament) {
            $teams = Team::getTeamArrayByGroup($tournament->getTeams());
            $output = self::getCollapseHtml('summary', 'Summary', self::getTournamentSummaryHtml($tournament));
            $output .= self::getStandingsHtml($tournament, $teams, null,
                self::MATCHES_LINK_MODAL);
            $tournament->concatBodyHtml($output);
        }

        public static function getSoccerScheduleHtml($tournament) {
            $matches = $tournament->getMatches();
            $bracket_spot = self::getBracketSpot($matches);
            $third_place_table_spot = self::getThirdPlaceTableSpot($matches);
            $output = '';
            $output2 = '';
            if ($bracket_spot != '') {
                $output .= self::getCollapseHtml('bracket', 'Bracket', self::getBracketHtml($tournament, $bracket_spot));
            }
            $output2 .= self::getCollapseHtml('summary', 'Summary', self::getTournamentSummaryHtml($tournament));
            if ($tournament->getTournamentId() == self::RUSSIA_2018)
                $output2 .= self::getCollapseHtml('qualification', 'Qualification', self::getQualificationSummaryHtml($tournament));
            $matches = Match::getMatchArrayByRound($matches);
            foreach ($matches as $rounds => $_round) {
                if ($rounds == $bracket_spot && $tournament->getTournamentId() != self::MUNICH_1972) $output2 .= $output;
                $output2 .= '<div class="col-sm-12 h2-ff1 margin-top-md">'.$rounds.'</div>';
                $output2 .= self::getMatchesHtml($tournament, $_round, false);
                if ($rounds == $third_place_table_spot) $output2 .= self::getThirdPlaceRankingHtml($tournament);
            }
            $tournament->concatBodyHtml($output2);
        }

        public static function getThirdPlaceRankingHtml($tournament) {
            $output = '';
            if (!self::isThirdPlaceRankingTournament($tournament)) return $output;
            $link_text = 'third';
            $group_text = 'Third';
            if (self::isSecondPlaceRankingTournament($tournament)) {
                $link_text = 'second';
                $group_text = 'Second';
            }
            $output .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                            <a class="link-modal" href="#" data-toggle="modal" data-target="#group'.$group_text.'PlaceStandingModal">
                                Ranking of '.$link_text.'-placed teams</a>
                        </div>';
            return $output;
        }

        public static function getSoccerBracketHtml($tournament) {
            $tournament->concatBodyHtml(self::getBracketHtml($tournament, ''));
        }

        public static function getBracketHtml($tournament, $bracket_spot) {
            $bracket_matches = Match::getBracketMatches($tournament->getMatches());
            $extra_height = '';
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
                if ($bracket_round == Soccer::FINAL_ && $tournament->getTournamentId() == self::FRANCE_2016) $extra_height = 'bracket-gap-height-32';

                $output .= '<div class="col-sm-3" '.$third_place_moving.'>
                            <div class="col-sm-12 bracket-gap-height-'.$i.$j.' '.$extra_height.'"></div>
                            <div class="col-sm-12 margin-top-sm" '.$prelim_style.'>
                                <span class="h2-ff1">'.$bracket_round.'</span>
                            </div>';
                foreach ($_bracket_matches as $bracket_match_order => $_bracket_match) {
                    $output .= self::getMatchHtml($tournament, $_bracket_match, self::MATCH_VIEW_4, $i, $j);
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

        public static function getQualificationSummaryHtml($tournament) {
            $teams = Team::getTeamArrayByQualificationDate($tournament->getTeams());
            $eliminated_teams = $tournament->getQualificationTeams();
            $output = '';
            $output .= '<div class="container">
                            <div class="row h3-ff3 padding-tb-md">';
            $output .= '        <div class="col-sm">';
            $output .= '            <p class="wb-stl-heading5 orange">All FIFA</p>
                                    <p>'.(sizeof($teams) + sizeof($eliminated_teams)).' teams entered</p>
                                    <p>'.sizeof($teams).' teams qualified</p>';
            for ($i = 0; $i < sizeof($teams); $i++ ) {
                $output .= '        <p class="h3-ff4 gray2">
                                        <img class="flag-sm-2 margin-top-flag" src="/images/flags/'.$teams[$i]->getFlagFilename().'">&nbsp;'
                                        .$teams[$i]->getName().'<br><span class="h6-ff4 padding-left-lg">('.$teams[$i]->getQualificationDate().')</span></p>';
            }
            $output .= '        </div>';
            $teams = Team::getQualificationTeamArrayByConfederation($tournament, Team::QUALIFIED);
            $eliminated_teams = Team::getQualificationTeamArrayByConfederation($tournament, Team::ELIMINATED);
            foreach ($teams as $confederation_name => $confederation_teams) {
                $eliminated = 0;
                if (array_key_exists($confederation_name, $eliminated_teams)) $eliminated = sizeof($eliminated_teams[$confederation_name]);
                $total_entered = sizeof($confederation_teams) + $eliminated;
                $output .= '    <div class="col-sm">';
                $output .= '        <p class="wb-stl-heading5">'.$confederation_name.'</p>
                                    <p>'.$total_entered.' teams entered</p>
                                    <p>'.sizeof($confederation_teams).' teams qualified</p>';
                foreach ($confederation_teams as $id => $team) {
                    $output .= '    <p class="h3-ff4 gray3">
                                        <img class="flag-sm-2 margin-top-flag" src="/images/flags/'.$team->getFlagFilename().'">&nbsp;'
                                        .$team->getName().'<br><span class="h6-ff4 padding-left-lg">('.$team->getQualificationDate().')</span></p>';
                }
                $output .= '    </div>';
            }
            $output .= '    </div>
                        </div>';
            return $output;
        }

        public static function getSoccerGroupModalHtml($tournament) {
            self::getGroupModalHtml($tournament, $tournament->getTeams(), Soccer::First);
            if (self::isThirdPlaceRankingTournament($tournament)) {
                $teams = self::getThirdPlaceTeams($tournament, 3);
                if (self::isSecondPlaceRankingTournament($tournament)) $teams = self::getThirdPlaceTeams($tournament, 2);
                self::getGroupModalHtml($tournament, $teams, Soccer::First);
            }
            self::getGroupModalHtml($tournament, $tournament->getSecondRoundTeams(), Soccer::Second);
        }

        public static function getSoccerMatchesModalHtml($tournament) {
            self::getGroupModalHtml($tournament, $tournament->getTeams(),Soccer::First);
        }

        public static function getSoccerMatchesMultiLeagueModalHtml($tournament) {
            self::getGroupModalHtml($tournament, $tournament->getTeams(),Soccer::First);
        }

        public static function getGroupModalHtml($tournament, $teams, $stage) {
            $league_teams = Team::getTeamArrayByParentGroup($teams);
            $_team_type = $tournament->getTeamType();
            $output = '';
            foreach ($league_teams as $league_name => $group_teams) {
                foreach ($group_teams as $group_name => $_teams) {
                    $modal_body = '';
                    if ($group_name != '') {
                        $league_name_short = str_replace('League ', '', $league_name);
                        $group_id = $league_name_short.$group_name;
                        $table_name = 'Group '.$group_name;
                        if ($_team_type == self::MULTI_LEAGUE_TEAM)
                            $table_name = '<span class="unl-league-'.$league_name_short.'">'.$league_name.'</span> - Group '.$group_name;
                        if ($group_name == Soccer::FINAL_ROUND) {
                            $group_id = 'FinalRound';
                            $table_name = $group_name;
                        }
                        elseif ($group_name == 'ThirdPlace') {
                            $table_name = 'Ranking of third-placed teams';
                        }
                        elseif ($group_name == 'SecondPlace') {
                            $table_name = 'Ranking of second-placed teams';
                        }
                        $modal_body .= self::getTeamRankingTableHtml($tournament, $_teams, $stage,
                            false, $current_best_finish, $striped_row);
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
                        $modal_body .= self::getMatchHtml($tournament, $_match, self::MATCH_VIEW_2);
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

        public static function getTeamTableHeaderHtml($tournament, $stage) {
            $output = '';
            $tournament_count_header = '<div class="col-sm-4"></div>';
            if ($tournament->getAllTime()) $tournament_count_header = '<div class="box-col-lg"></div><div class="box-col-sm">T</div>';
            $gd_header = '+/-';
            if (self::getGoalAverageStat($tournament, $stage))
                $gd_header = 'GAv';
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
                            <div class="box-col-sm">'.$gd_header.'</div>
                            <div class="box-col-sm">Pts</div>
                        </div>    
                        </div>';
            return $output;
        }

        public static function getGoalAverageStat($tournament, $stage) {
            return $stage == Soccer::First &&
                    ($tournament->getTournamentId() == self::SWEDEN_1958 || $tournament->getTournamentId() == self::CHILE_1962
                        || $tournament->getTournamentId() == self::ENGLAND_1966);
        }

        public static function isTeamAdvancedThirdPlaceMatch($_count, $_team) {
            if ($_count == 2) {
                if ($_team->getTournamentId() == self::ARGENTINA_1978 || $_team->getTournamentId() == self::GERMANY_1974
                        || $_team->getTournamentId() == self::MUNICH_1972) {
                    if ($_team->getBestFinish() == Soccer::SecondRound)
                        return true;
                }
                elseif ($_team->getTournamentId() == self::SAUDI_ARABIA_1995 || $_team->getTournamentId() == self::GHANA_1963
                        || $_team->getTournamentId() == self::TUNISIA_1965 || $_team->getTournamentId() == self::NEW_CALEDONIA_1980
                        || $_team->getTournamentId() == self::ITALY_1980)
                    return true;
            }
            elseif ($_count == 3 || $_count == 4)
                if (($_team->getTournamentId() == self::NEW_ZEALAND_1973))
                    return true;
            return false;
        }

        public static function getPodiumPosition($_count, $_team) {
            if ($_team->getBestFinish() == Soccer::Champion || $_team->getBestFinish() == Soccer::GoldMedal
                || ($_count == 1 && $_team->getBestFinish() == Soccer::FinalRound))
                return 1;
            elseif ($_team->getBestFinish() == Soccer::RunnerUp || $_team->getBestFinish() == Soccer::SilverMedal
                || ($_count == 2 && $_team->getBestFinish() == Soccer::FinalRound))
                return 2;
            elseif ($_team->getBestFinish() == Soccer::ThirdPlace || $_team->getBestFinish() == Soccer::BronzeMedal
                || ($_count == 3 && $_team->getBestFinish() == Soccer::FinalRound))
                return 3;
            return 0;
        }

        public static function getTeamHtml($tournament, $_team, $stage, $from_ranking, &$current_best_finish, &$striped) {
            $output = '';
            $_all_time = $tournament->getAllTime();
            $goal_diff = $_team->getGoalDiff();
            $_count = $_team->getCount();
            if ($_team->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;
            if (self::getGoalAverageStat($tournament, $stage))
                if ($_team->getGoalAgainst() != 0)
                    $goal_diff = round($_team->getGoalFor() / $_team->getGoalAgainst(), 2, PHP_ROUND_HALF_UP);
                else
                    $goal_diff = '-';
            if (!$from_ranking) {
                $striped = '';
                if (self::isTeamAdvancedSecondRound($tournament, $_team, $stage)) {
                    $striped = 'advanced-second-round-striped';
                    if (self::isTeamAdvancedThirdPlaceMatch($_count, $_team)) $striped = 'advanced-third-place-striped';
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
                if ($_all_time) $striped = '';
            }
            $top3_bg = '';
            if (!$_all_time) {
                if (self::getPodiumPosition($_count, $_team) == 1) $top3_bg = 'gold';
                elseif (self::getPodiumPosition($_count, $_team) == 2) $top3_bg = 'silver';
                elseif (self::getPodiumPosition($_count, $_team) == 3) $top3_bg = 'bronze';
            }
            $note = '';
            if ($stage == Soccer::First) {
                $note = self::getNote($_team);
            }
            $tc_col = '<div class="col-sm-4">'.$_team->getName().'<!--bestFinish:'.$_team->getBestFinish().'-->'.$note.'</div>';
            if ($_all_time) $tc_col = '<div class="box-col-lg">'.$_team->getName().'</div>
                                                <div class="box-col-sm"><a id="popover_'.$_team->getCode().'" data-toggle="popover"
                                                    data-container="body" data-placement="right" data-html="true"
                                                    data-trigger="focus" tabindex="0" style="cursor:pointer;">'.$_team->getTournamentCount().'</a></div>';
            if (!$_all_time || ($_all_time && $_team->getMatchPlay() != 0)) {
                $output .=     '<div class="col-sm-12 padding-tb-md team-row '.$striped.' '.$top3_bg.'">
                                <div class="row">
                                        <div class="box-col-md" style="padding-left:15px;">';
                $output .= '<span class="ranking-count"><small>'.$_team->getRanking().'&nbsp;&nbsp;</small></span>';
                if ($tournament->getTeamType() == self::CLUB) {
                    $output .= '<img height=32 class="margin-top-flag" src="/images/club_logos/'.$_team->getLogoFilename().'">';
                    $output .= '<img class="flag-sm margin-top-flag" src="/images/flags/'.$_team->getFlagFilename().'">';
                }
                else {
                    $olympic_flag = '';
                    if ($_team->getFlagFilename() == 'Olympic.png') $olympic_flag = 'flag-md-olympic';
                    $output .= '<img class="flag-md '.$olympic_flag.' margin-top-flag" src="/images/flags/'.$_team->getFlagFilename().'">';
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

        public static function getNote($_team) {
            $note = '';
            $tmp1 = '<br><span class="gray4"><small>(ahead ';
            $tmp2 = ')</small></span>';
            if ($_team->getTournamentId() == self::SWITZERLAND_1954) {
                if ($_team->getName() == 'BRAZIL' || $_team->getName() == 'URUGUAY')
                    $note = $tmp1.'on drawing lot'.$tmp2;
                elseif ($_team->getName() == 'WEST GERMANY' || $_team->getName() == 'SWITZERLAND')
                    $note = $tmp1.'by winning play-off'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::SWEDEN_1958) {
                if ($_team->getName() == 'NORTHERN IRELAND' || $_team->getName() == 'WALES' || $_team->getName() == 'SOVIET UNION')
                    $note = $tmp1.'by winning play-off'.$tmp2;
                elseif ($_team->getName() == 'FRANCE')
                    $note = $tmp1.'on goal average'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::CHILE_1962) {
                if ($_team->getName() == 'ENGLAND')
                    $note = $tmp1.'on goal average'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::ENGLAND_1966) {
                if ($_team->getName() == 'WEST GERMANY')
                    $note = $tmp1.'on goal average'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::MEXICO_1970) {
                if ($_team->getName() == 'SOVIET UNION')
                    $note = $tmp1.'on drawing lot'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::ITALY_1990) {
                if ($_team->getName() == 'REPUBLIC OF IRELAND')
                    $note = $tmp1.'on drawing lot'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::RUSSIA_2018) {
                if ($_team->getName() == 'JAPAN')
                    $note = $tmp1.'on fair play points'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::ENGLAND_1996) {
                if ($_team->getName() == 'CZECH REPUBLIC')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::BELGIUM_NETHERLANDS_2000) {
                if ($_team->getName() == 'YUGOSLAVIA')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::PORTUGAL_2004) {
                if ($_team->getName() == 'SWEDEN')
                    $note = $tmp1.'on head-to-head goals. Sweden 3-3, Denmark 2-2, Italy 1-1. Tied on head-to-head points 2 and goal difference 0'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::AUSTRIA_SWITZERLAND_2008) {
                if ($_team->getName() == 'PORTUGAL' || $_team->getName() == 'CZECH REPUBLIC')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::POLAND_UKRAINE_2012) {
                if ($_team->getName() == 'GREECE')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
                elseif ($_team->getName() == 'UKRAINE')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::FRANCE_2016) {
                if ($_team->getName() == 'ITALY')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::MOROCCO_1988) {
                if ($_team->getName() == 'ALGERIA')
                    $note = $tmp1.'on drawing lot'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::ANGOLA_2010) {
                if ($_team->getName() == 'ALGERIA')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
                elseif ($_team->getName() == 'TOGO') {
                    $note = $tmp1.'disqualified'.$tmp2;
                    $note = str_replace('ahead ', '', $note);
                }
                elseif ($_team->getName() == 'ZAMBIA')
                    $note = $tmp1.'on head-to-head goals. Zambia 4-4, Cameroon 3-3, Gabon 2-2. Tied on head-to-head points 3 and goal difference 0'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::EQUATORIAL_GUINEA_2015) {
                if ($_team->getName() == 'GUINEA')
                    $note = $tmp1.'on drawing lot'.$tmp2;
                elseif ($_team->getName() == 'GHANA')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::GOLD_CUP_2000) {
                if ($_team->getName() == 'CANADA')
                    $note = $tmp1.'on a coin toss'.$tmp2;
            }
            elseif ($_team->getTournamentId() == self::GOLD_CUP_2002) {
                if ($_team->getName() == 'CANADA') {
                    $note = $tmp1.'Canada and Haiti advanced on drawing lots'.$tmp2;
                    $note = str_replace('ahead ', '', $note);
                }
            }
            elseif ($_team->getTournamentId() == self::GOLD_CUP_2009) {
                if ($_team->getName() == 'JAMAICA')
                    $note = $tmp1.'on head-to-head match'.$tmp2;
            }
            return $note;
        }

        public static function getTeamRankingTableHtml($tournament, $_teams, $stage, $from_ranking, &$current_best_finish, &$striped) {
            $ranking = 0;
            $count = 0;
            $previous_team = null;
            $output = self::getTeamTableHeaderHtml($tournament, $stage);
            foreach ($_teams as $name => $_team) {
                self::getNextRanking($_team, $previous_team, $ranking, $count, $tournament->getAllTime());
                $output .= self::getTeamHtml($tournament, $_team, $stage, $from_ranking,
                    $current_best_finish, $striped);
                $previous_team = $_team;
            }
            return $output;
        }

        public static function getSoccerPopoverHtml($tournament) {
            $teams = $tournament->getTeams();
            $output = '';
            for ($i = 0; $i < sizeof($teams); $i++) {
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
                        <p><span class="wb-stl-heading1 dark-red">'.$teams[$i]->getTournamentCount().'</span> '.$tournament_text.'</p>';
                $team_name = $teams[$i]->getName();
                if ($teams[$i]->getParentName() != null) {
                    $team_name =  $teams[$i]->getParentName();
                }
                $tmp_finish = Soccer::Group;
                $champ_count = 0;
                $output2 = self::getFinishLiteral($teams[$i]->getTournamentId(), $tmp_finish);
                $output3 = '';
                foreach ($tt[$team_name] as $tournament_names => $_team) {
                    if ($tmp_finish < $_team->getBestFinish()) {
                        $tmp_finish = $_team->getBestFinish();
                        $output2 = self::getFinishLiteral($_team->getTournamentId(), $_team->getBestFinish());
                    }
                    if ($_team->getBestFinish() == Soccer::Champion) $champ_count++;
                    $short_tournament_name = self::getShortTournamentName($tournament_names);
                    $output3 .= '<p><b>'.$short_tournament_name.':</b> <i>'.self::getFinishLiteral($_team->getTournamentId(), $_team->getBestFinish()).'</i> ';
                    if ($_team->getParentName() != null) {
                        $output3 .= '<span class="gray4"><small>(as '.$_team->getName();
                        $output3 .= '&nbsp;<img class="flag-xs" src="/images/flags/'.$_team->getFlagFilename().'">)</small></span></p>';
                    }
                    if (self::isTeamDualConfederation($_team)) {
                        $output3 .= '<span class="gray4"><small>(as an '.$_team->getConfederationName().' member)</small></span></p>';
                    }
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

        public static function isTeamDualConfederation($_team) {
            return ($_team->getName() == 'AUSTRALIA'
                        && ($_team->getTournamentId() == self::RUSSIA_2018 || $_team->getTournamentId() == self::BRAZIL_2014
                            || $_team->getTournamentId() == self::SOUTH_AFRICA_2010 || $_team->getTournamentId() == self::GERMANY_2006
                            || $_team->getTournamentId() == self::GERMANY_1974))
                    || ($_team->getName() == 'ISRAEL' && $_team->getTournamentId() == self::MEXICO_1970);
        }

        public static function getSoccerRankingHtml($tournament) {
            $tournament->concatBodyHtml(self::getRankingHtml($tournament, $tournament->getTeams(), self::TOURNAMENT));
        }

        public static function getAllTimeSoccerRankingHtml($tournament) {
            $output = '';
            $output .= '<div class="margin-top-sm">';
            if (!self::hasConfederationFilter($tournament)) {
                $output .= self::getAllConfederationsRankingHtml($tournament);
            }
            else {
                $output .= self::getCollapseFilteringConfederationsHtml($tournament);
                $output .= '<div class="tab-content" id="filter-tabContent">';
                $output .= '<div class="tab-pane fade" id="All'.self::CONTENT.'" role="tabpanel" aria-labelledby="All-tab">';
                $output .= self::getAllConfederationsRankingHtml($tournament);
                $output .= '</div>';
                $teams = Team::getAllTimeTeamArrayByConfederation($tournament);
                $confederations = Team::getConfederationArray($tournament->getTournamentTeams());
                foreach ($confederations as $confederation_name => $_confederation) {
                    $confederation_tab = self::getValidHtmlId($confederation_name);
                    $output .= '<div class="tab-pane fade" id="'.$confederation_tab.self::CONTENT.'" role="tabpanel" aria-labelledby="'.$confederation_tab.'-tab">';
                    $output .= '<span class="margin-left-md">'.Team::getFilteringLogo($_confederation, Team::CONFEDERATION_LOGO).'</span>';
                    $output .= self::getConfederationRankingHtml($tournament, $teams[$confederation_name]);
                    $output .= '</div>';
                }
                $output .= '</div>';
            }
            $output .= '</div>';
            $tournament->concatBodyHtml($output);
        }

        public static function getAllConfederationsRankingHtml($tournament) {
            $output = self::getRankingHtml($tournament, $tournament->getTeams(), self::ALL_TIME);
            $output .= self::getAllTabScript();
            return $output;
        }

        public static function getConfederationRankingHtml($tournament, $teams) {
            $teams_tmp = array();
            foreach ($teams as $team_name => $_team) {
                array_push($teams_tmp, $_team);
            }
            $teams_tmp = Soccer::sortGroupStanding($tournament, $teams_tmp, $tournament->getMatches());
            $output = self::getRankingHtml($tournament, $teams_tmp, self::CONFEDERATION);
            return $output;
        }

        public static function getRankingHtml($tournament, $teams, $ranking_table) {
            if (sizeof($teams) == 0) return null;
            switch ($ranking_table) {
                case self::TOURNAMENT:
                    $teams = Team::getTeamArrayByBestFinish($teams);
                    $title = 'Tournament Rankings';
                    break;
                case self::CONFEDERATION:
                    $title = 'Confederation Rankings';
                    break;
                default:
                    $title = 'All Time Rankings';
                    break;
            }
            $output = '<div class="col-sm-12 h2-ff2 margin-top-md">'.$title.'</div>
                        <div class="col-sm-12 h2-ff3 box-xl">';
            $current_best_finish = $teams[0]->getBestFinish();
            $striped_row = 'ranking-striped';
            $_teams = Team::getTeamArrayById($teams);
            $output .= self::getTeamRankingTableHtml($tournament, $_teams, null,
                true, $current_best_finish, $striped_row);
            $output .= '</div>';
            return $output;
        }

        public static function getSoccerStandingsHtml($tournament) {
            $teams = Team::getTeamArrayByGroup($tournament->getTeams());
            $output = self::getStandingsHtml($tournament, $teams, null,
                self::MATCHES_LINK_COLLAPSE);
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
                    self::MATCHES_LINK_COLLAPSE);
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

        public static function getStandingsHtml($tournament, $teams, $parent_group_name, $matches_link_type) {
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
                $output .= self::getTeamRankingTableHtml($tournament, $_teams, Soccer::First,
                    false, $current_best_finish, $striped_row);
                $output .= '</div>';
                if ($matches_link_type == self::MATCHES_LINK_COLLAPSE) {
                    $output .= self::getCollapseHtml(self::getValidHtmlId($parent_group_name).$group_name.'matches', 'Matches',
                        self::getGroupMatchesCollapseHtml($tournament, $parent_group_name, $group_name));
                }
            }
            $output .= '</div>';
            return $output;
        }

        public static function getGroupMatchesCollapseHtml($tournament, $parent_group_name, $group_name) {
            $_team_type = $tournament->getTeamType();
            if ($_team_type == self::MULTI_LEAGUE_TEAM) {
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
                    if ($_team_type == self::MULTI_LEAGUE_TEAM) {
                        $output .= self::getMatchHtml($tournament, $_match, self::MATCH_VIEW_3);
                    }
                    else {
                        $output .= self::getMatchHtml($tournament, $_match, self::MATCH_VIEW_6);
                    }
                }
            }
            return $output;
        }

        public static function getSoccerMatchesOneLeagueHtml($tournament) {
            self::getSoccerMatchesHtml($tournament);
        }

        public static function getSoccerMatchesMultiLeagueHtml($tournament) {
            self::getSoccerMatchesHtml($tournament);
        }

        public static function getSoccerMatchesHtml($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $image_type = Team::FLAG;
            $_team_type = $tournament->getTeamType();
            if ($_team_type == self::CLUB) $image_type = Team::LOGO;
            $output = '';
            $output .= '<div class="margin-top-sm">';
            $output .= self::getCollapseFilteringTeamsHtml($tournament, $image_type);
            $output .= '<div class="tab-content" id="filter-tabContent">';
            $output .= '<div class="tab-pane fade" id="All'.self::CONTENT.'" role="tabpanel" aria-labelledby="All-tab">';
            $output .= self::getAllMatchesHtml($tournament);
            $output .= '</div>';
            foreach ($teams as $name => $_team) {
                $team_tab = self::getValidHtmlId($name);
                $team_flag = '<img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'">';
                $team_name = $_team->getName();
                $team_logo = '<img height="32" src="/images/club_logos/'.$_team->getLogoFilename().'">';
                $team_small_flag = '<img class="flag-sm-2" src="/images/flags/'.$_team->getFlagFilename().'">';
                $output .= '<div class="tab-pane fade" id="'.$team_tab.self::CONTENT.'" role="tabpanel" aria-labelledby="'.$team_tab.'-tab">';
                if ($_team_type == self::MULTI_LEAGUE_TEAM || $_team_type == self::TEAM) {
                    $output .= '<span class="h2-ff3" style="margin-left:30px;">'.$team_flag.'&nbsp;&nbsp;'.$team_name.'</span>';
                }
                else {
                    $output .= '<span class="h2-ff3" style="margin-left:30px;">'.$team_logo.$team_small_flag.'&nbsp;&nbsp;'.$team_name.'</span>';
                }
                $output .= self::getTeamMatchesHtml($tournament, $name);
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $tournament->concatBodyHtml($output);
        }

        public static function getAllMatchesHtml($tournament) {
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
                $output .= self::getMatchesHtml($tournament, $_round, false);
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</div>
                '.self::getDefaultTabScript($matchDay_start, $tab_array);
            return $output;
        }

        public static function getTeamMatchesHtml($tournament, $name) {
            $matches = $tournament->getMatches();
            $matches = Match::getMatchArrayByTeam($matches, $name);
            $output = '';
            $output .= '<div class="col-sm-12 margin-top-sm">';
            $output .= self::getMatchesHtml($tournament, $matches, true);
            $output .= '</div>';
            return $output;
        }

        public static function getMatchesHtml($tournament, $matches, $show_round) {
            $output = '';
            $_team_type = $tournament->getTeamType();
            foreach ($matches as $match_dates => $_matches) {
                $output .= '<div class="col-sm-12 h3-ff3 border-bottom-gray2 margin-top-md">';
                if ($show_round) $output .= $_matches[array_keys($_matches)[0]]->getRound().': ';
                $output .= $_matches[array_keys($_matches)[0]]->getMatchDateFmt().'</div>';
                foreach ($_matches as $match_order => $_match) {
                    if ($_team_type == self::MULTI_LEAGUE_TEAM || $_team_type == self::TEAM) {
                        $output .= self::getMatchHtml($tournament, $_match, self::MATCH_VIEW_1);
                    }
                    else {
                        $output .= self::getMatchHtml($tournament, $_match, self::MATCH_VIEW_5);
                    }
                }
            }
            return $output;
        }

        public static function showNoGroupText($_match) {
            return $_match->getTournamentId() == self::PERU_1953 || $_match->getTournamentId() == self::BRAZIL_1949
                || $_match->getTournamentId() == self::ARGENTINA_1937 || $_match->getTournamentId() == self::BRAZIL_1922
                || $_match->getTournamentId() == self::BRAZIL_1919
                || $_match->getRound() == Soccer::PRELIMINARY_ROUND;
        }

        public static function isSilverGoal($_match) {
            return $_match->getTournamentId() == self::PORTUGAL_2004;
        }

        public static function isThirdPlaceNoGoldenGoal($_match) {
            return $_match->getTournamentId() == self::GOLD_CUP_1993 && $_match->getRound() == Soccer::THIRD_PLACE;
        }

        public static function isGroupMatchOvertime($_match) {
            return $_match->getTournamentId() == self::SWITZERLAND_1954
                || $_match->getTournamentId() == self::THAILAND_1972
                || ($_match->getTournamentId() == self::SAUDI_ARABIA_1995
                    && $_match->getHomeTeamName() == 'DENMARK' && $_match->getAwayTeamName() == 'MEXICO');
        }

        public static function isPreliminaryRound($_match) {
            return $_match->getRound() == Soccer::PRELIMINARY_ROUND1 || $_match->getRound() == Soccer::PRELIMINARY_ROUND2
                || $_match->getRound() == Soccer::PRELIMINARY_ROUND;
        }

        public static function isShowOvertimeScore($_match) {
            return self::isPreliminaryRound($_match)
                    || ($_match->getHomeTeamScore() == $_match->getAwayTeamScore() &&
                        (($_match->getStage() != Soccer::FIRST_STAGE && $_match->getStage() != Soccer::GROUP_STAGE
                                && $_match->getStage() != Soccer::QUALIFYING_STAGE)
                            || $_match->getRound() == Soccer::PLAY_OFF
                            || $_match->getRound() == Soccer::FINAL_ROUND_PLAY_OFF
                            || self::isGroupMatchOvertime($_match)));
        }

        public static function getMatchHtml($tournament, $_match, $match_view, $i = 0, $j = 0) {
            $output = '';
            $match_date = $_match->getMatchDate();
            $match_time = $_match->getMatchTimeFmt();
            $time_zone = '';
            if ($_match->getTournamentId() == 1) $time_zone = 'CST';
            $group_text = '';
            $league_name = $_match->getParentGroupName();
            $league_name_short = str_replace('League ', '', $league_name);
            if ($tournament->getTeamType() == self::MULTI_LEAGUE_TEAM) $group_text .= '<span class="unl-league-'.$league_name_short.'">'.$league_name.'</span> - ';
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
                if (self::showNoGroupText($_match)) $group_text = '';
            }
            $home_flag = '';
            $away_flag = '';
            if ($_match->getHomeTeamCode() != '') {
                $home_olympic_flag = '';
                if ($_match->getHomeFlag() == 'Olympic.png') $home_olympic_flag = 'flag-md-olympic';
                $away_olympic_flag = '';
                if ($_match->getAwayFlag() == 'Olympic.png') $away_olympic_flag = 'flag-md-olympic';
                $home_flag = '<img class="flag-md '.$home_olympic_flag.'" style="margin-top:3px;" src="/images/flags/'.$_match->getHomeFlag().'">';
                $away_flag = '<img class="flag-md '.$away_olympic_flag.'" style="margin-top:3px;" src="/images/flags/'.$_match->getAwayFlag().'">';
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
            $_look_ahead = $tournament->getSimulationMode() == Tournament::SIMULATION_MODE_1;
            $_match_order = $_match->getMatchOrder();
            if ($_look_ahead && $_match_order > 32 && $_match_order <= 48) {
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
                if (self::isGoldenGoalRule($_match->getGoldenGoalRule()) && !Match::isFirstStage($_match)
                        && $_match->getHomeTeamPenaltyScore() == '') {
                    $aet = ' gg';
                    if (self::isSilverGoal($_match)) $aet = ' sg';
                }
                if (self::isThirdPlaceNoGoldenGoal($_match)) $aet = ' aet';
                $score = $_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore();
                if (self::isShowOvertimeScore($_match)) {
                    if ($_match->getHomeTeamExtraTimeScore() == null || self::isPreliminaryRound($_match)) $aet = '&nbsp;&nbsp;&nbsp;&nbsp;';
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
            if (self::isDuplicateCode($_match))
                $away_team_code = $_match->getAwayTeamCode().' B';
            if ($_match->getHomeTeamCode() == '') {
                $home_team_code = '['.$_match->getWaitingHomeTeam().']';
                $away_team_code = '['.$_match->getWaitingAwayTeam().']';
            }
            $short_note = '<br><span class="small">'.$_match->getShortNote().'</span>';
            $long_note = $_match->getLongNote();

            if ($match_view == self::MATCH_VIEW_1) {
                $output .= '<div class="col-sm-12 padding-tb-md">
                            <div class="row">
                                    <div class="col-sm-2">'.$match_time.' '.$time_zone.'<br>'.$group_text.'</div>
                                    <div class="col-sm-1 padding-lr-xs padding-top-xs text-right" style="padding-top:6px;">'.$home_flag.'</div>
                                    <div class="h2-ff3 padding-left-md padding-right-xs" style="width:30%;max-width:30%;">'.$home_team_name.$advance_popover.'</div>
                                    <div class="col-sm-1 h2-ff3 padding-lr-xs">'.$score.'<br>'.$penalty_score.'</div>
                                    <div class="h2-ff3 padding-lr-xs text-right" style="width:30%;max-width:30%;">'.$advance_popover2.$away_team_name.'</div>
                                    <div class="padding-lr-xs text-right" style="padding-top:6px;width:6%;max-width:6%;">'.$away_flag.'</div>
                            </div>
                            </div>';
                if ($long_note != '') {
                    $output .= '<div class="col-sm-12 padding-bottom-md border-bottom-gray5">
                            <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-5 text-center">'.$long_note.'</div>
                                        <div class="col-sm-3"></div>
                            </div>
                            </div>';
                }
                else {
                    $output .= '<div class="col-sm-12 border-bottom-gray5">
                                    </div>';
                }
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
                                <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$score.$penalty_score.$replay_score.$short_note.'</div>
                                <div class="col-sm-4 h4-ff3 margin-tb-sm text-center">'.$away_flag.$away_team_code.'</div>
                            </div>
                            </div>';
            }
            return $output;
        }

        public static function isDuplicateCode($_match) {
            return $_match->getTournamentId() == self::LONDON_1908 && $_match->getAwayTeamCode() == 'FRA'
                    && $_match->getRound() == Soccer::QUARTERFINALS;
        }

        public static function getCollapseFilteringTeamsHtml($tournament, $image_type) {
            $output = self::getCollapseFilteringHtml($tournament, $image_type, 'team-filter', 'Team');
            return $output;
        }

        public static function getCollapseFilteringConfederationsHtml($tournament) {
            $output = self::getCollapseFilteringHtml($tournament, Team::CONFEDERATION_LOGO, 'confederation-filter', 'Confederation');
            return $output;
        }

        public static function getCollapseFilteringHtml($tournament, $image_type, $id, $name) {
            $output = self::getCollapseHtml($id, $name, self::getFilteringHtml($tournament, $id, $image_type));
            return $output;
        }

        public static function getFilteringHtml($tournament, $id, $image_type) {
            if ($image_type == Team::CONFEDERATION_LOGO) {
                $tab_width = 'width: 162px;';
                $tournament_name = 'Confederation';
                $icons = Team::getConfederationArray($tournament->getTournamentTeams());
            }
            else {
                $tab_width = 'width: 110px;';
                $tournament_name = 'Tournament'.self::getValidHtmlId($tournament->getProfile()->getName());
                $icons = Team::getTeamArrayByName($tournament->getTeams());
            }
            ksort($icons);
            $output = '';
            $output .= '<style>';
            $output .= '    #'.$tournament_name.'FilterTab > li > a { '.$tab_width.' height: 90px; }';
            $output .= '    #'.$tournament_name.'FilterTab > li.active > a { border: 1px solid #dddddd; }
                        </style>';
            $output .= '<ul class="nav nav-tabs h6-ff6 padding-top-xs" id="'.$tournament_name.'FilterTab" role="tablist">';
            $output .= '<li class="nav-item text-center">
                            <a class="nav-link" id="All-tab" data-toggle="tab" href="#All'.self::CONTENT.'"
                                role="tab" aria-controls="All'.self::CONTENT.'" aria-selected="true">';
            $output .=     TournamentProfile::getTournamentLogo($tournament->getProfile(), 32);
            $output .=     '<br>'.TournamentProfile::getAllFilteringText($tournament->getProfile(), $image_type).'</a>';
            $output .= '    </li>';
            foreach ($icons as $name => $_icon) {
                if ($name != null) {
                    $show_name = $name;
                    if ($image_type == Team::CONFEDERATION_LOGO) {
                        $show_name = '';
                    }
                    $icon_tab = self::getValidHtmlId($name);
                    $output .= '<li class="nav-item text-center">
                                <a class="nav-link" id="'.$icon_tab.'-tab" data-toggle="tab" href="#'.$icon_tab.self::CONTENT.'" 
                                    role="tab" aria-controls="'.$icon_tab.self::CONTENT.'" aria-selected="true">';
                    $output .= Team::getFilteringLogo($_icon, $image_type).'<br>'.$show_name.'</a>';
                    $output .= '</li>';
                }
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

        public static function getNextRanking($team, $previous_team, &$ranking, &$count, $all_time) {
            if ($all_time) {
                if ($team->getParentName() == null) {
                    $count++;
                    if (!self::isSameRanking($team, $previous_team)) {
                        $ranking = $count;
                    }
                }
            }
            else {
                $count++;
                if (!self::isSameRanking($team, $previous_team) || !self::isSameBestFinish($team, $previous_team)) {
                    $ranking = $count;
                }
            }
            $team->setRanking($ranking);
            $team->setCount($count);
        }

        public static function isSameRanking($team, $previous_team) {
            if ($previous_team == null) return false;
            return $team->getPoint() == $previous_team->getPoint()
                && $team->getGoalFor() == $previous_team->getGoalFor()
                && $team->getGoalAgainst() == $previous_team->getGoalAgainst();
        }

        public static function isSameBestFinish($team, $previous_team) {
            if ($previous_team == null) return false;
            return $team->getBestFinish() == $previous_team->getBestFinish();
        }

        public static function getAllTabScript() {
            return '<script>
                    $(function() {
                        $("#All-tab").tab("show");
                    });
                </script>';
        }

        public static function getDefaultTabScript($week_start_date, $tab_array) {
            if (sizeof($tab_array) == 0) return '';
            $result = $tab_array[0];
            for ($i = 0; $i < sizeof($week_start_date); $i++) {
                $now = date_create('now');
                if (date_add($now, date_interval_create_from_date_string("1 day"))->format('Y-m-d') >= $week_start_date[$i]) {
                    if ($i == sizeof($week_start_date) - 1) $result = $tab_array[$i];
                    elseif ($now->format('Y-m-d') < $week_start_date[$i + 1]) $result = $tab_array[$i];
                }
            }
            $result = self::getAllTabScript().'
                <script>
                    $(function() {
                        $("#'.$result.'-tab").tab("show");
                    });
                </script>';
            return $result;
        }

        public static function getValidHtmlId($name) {
            $team_tab = str_replace(' ', '_', $name);
            $team_tab = str_replace('\'', '_', $team_tab);
            $team_tab = str_replace('.', '_', $team_tab);
            $team_tab = str_replace('/', '_', $team_tab);
            return 'T-'.$team_tab;
        }

        public static function getThirdPlaceTeams($tournament, $rank) {
            $result = array();
            $teams_tmp = array();
            $teams = $tournament->getTeams();
            $group_name = 'ThirdPlace';
            if (self::isSecondPlaceRankingTournament($tournament)) $group_name = 'SecondPlace';
            for ($i = 0; $i < sizeof($teams); $i++) {
                $team = Team::CloneSoccerTeam($teams[$i]->getId(), $teams[$i]->getName(), $teams[$i]->getCode(), $teams[$i]->getTeamType(), $group_name,
                    $teams[$i]->getGroupOrder(), $teams[$i]->getMatchPlay(), $teams[$i]->getWin(), $teams[$i]->getDraw(), $teams[$i]->getLoss(),
                    $teams[$i]->getGoalFor(), $teams[$i]->getGoalAgainst(), $teams[$i]->getGoalDiff(), $teams[$i]->getPoint());
                $team->setFlagFilename($teams[$i]->getFlagFilename());
                $teams_tmp[$teams[$i]->getGroupName()][$teams[$i]->getName()] = $team;
            }
            foreach ($teams_tmp as $group_name => $_teams) {
                $i = 1;
                foreach ($_teams as $name => $_team) {
                    if ($i == $rank) array_push( $result, $_team);
                    $i++;
                }
            }

            return Soccer::sortGroupStanding($tournament, $result, $tournament->getMatches());
        }

        public static function getBracketSpot($matches) {
            $spot = '';
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == Soccer::SECOND_STAGE) {
                    if ($matches[$i]->getRound() != Soccer::THIRD_PLACE && $matches[$i]->getRound() != Soccer::FINAL_
                        && $matches[$i]->getRound() != Soccer::FINALS) {
                        $spot = $matches[$i]->getRound();
                    }
                    break;
                }
            }
            return $spot;
        }

        public static function getThirdPlaceTableSpot($matches) {
            $spot = '';
            for ($i = sizeof($matches) - 1; $i >= 0; $i--) {
                if ($matches[$i]->getStage() == Soccer::FIRST_STAGE) {
                    $spot = $matches[$i]->getRound();
                    break;
                }
            }
            return $spot;
        }

        public static function isThirdPlaceRankingTournament($tournament) {
            return ($tournament->getProfile() != null && $tournament->getProfile()->getThirdPlaceRanking() == 1)
                    || self::isSecondPlaceRankingTournament($tournament);
        }

        public static function isSecondPlaceRankingTournament($tournament) {
            return $tournament->getTournamentId() == self::GOLD_CUP_1996;
        }

        public static function noThirdPlacePlayoff($tournament) {
            return self::noThirdPlacePlayoffById($tournament->getTournamentId());
        }

        public static function noThirdPlacePlayoffById($tournament_id) {
            return $tournament_id == self::FRANCE_2016 || $tournament_id == self::POLAND_UKRAINE_2012
                || $tournament_id == self::AUSTRIA_SWITZERLAND_2008 || $tournament_id == self::PORTUGAL_2004
                || $tournament_id == self::BELGIUM_NETHERLANDS_2000 || $tournament_id == self::ENGLAND_1996
                || $tournament_id == self::SWEDEN_1992 || $tournament_id == self::WEST_GERMANY_1988
                || $tournament_id == self::FRANCE_1984 || $tournament_id == self::COPA_1983
                || $tournament_id == self::COPA_1979 || $tournament_id == self::COPA_1975
                || $tournament_id == self::GOLD_CUP_2017 || $tournament_id == self::GOLD_CUP_2013
                || $tournament_id == self::GOLD_CUP_2011 || $tournament_id == self::GOLD_CUP_2009
                || $tournament_id == self::GOLD_CUP_2007 || $tournament_id == self::GOLD_CUP_2005
                || $tournament_id == self::GOLD_CUP_2000 || $tournament_id == self::PAPUA_NEW_GUINEA_2016
                || $tournament_id == self::OFC_NATIONS_CUP_1996;
        }

        public static function isGoldenGoalRule($golden_goal_rule) {
            return $golden_goal_rule == 1;
        }

        public static function isTeamAdvancedSecondRound($tournament, $team, $stage) {
            $result = false;
            if ($stage == Soccer::First) {
                $second_round_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::SECOND_ROUND);
                for ($i = 0; $i < sizeof($second_round_matches); $i++) {
                    if ($second_round_matches[$i]->getHomeTeamName() == $team->getName() || $second_round_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                $final_round_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::FINAL_ROUND);
                for ($i = 0; $i < sizeof($final_round_matches); $i++) {
                    if ($final_round_matches[$i]->getHomeTeamName() == $team->getName() || $final_round_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                $round16_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::ROUND16);
                for ($i = 0; $i < sizeof($round16_matches); $i++) {
                    if ($round16_matches[$i]->getHomeTeamName() == $team->getName() || $round16_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                if (!$result) {
                    $quarterfinal_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::QUARTERFINALS);
                    for ($i = 0; $i < sizeof($quarterfinal_matches); $i++) {
                        if ($quarterfinal_matches[$i]->getHomeTeamName() == $team->getName() || $quarterfinal_matches[$i]->getAwayTeamName() == $team->getName()) {
                            $result = true;
                            break;
                        }
                    }
                    if (!$result) {
                        $semifinal_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::SEMIFINALS);
                        for ($i = 0; $i < sizeof($semifinal_matches); $i++) {
                            if ($semifinal_matches[$i]->getHomeTeamName() == $team->getName() || $semifinal_matches[$i]->getAwayTeamName() == $team->getName()) {
                                $result = true;
                                break;
                            }
                        }
                    }
                    if (!$result) {
                        $final_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::FINALS);
                        for ($i = 0; $i < sizeof($final_matches); $i++) {
                            if ($final_matches[$i]->getHomeTeamName() == $team->getName() || $final_matches[$i]->getAwayTeamName() == $team->getName()) {
                                $result = true;
                                break;
                            }
                        }
                    }
                    if (!$result) {
                        $third_place_match = Match::getRoundMatch($tournament->getMatches(), Soccer::THIRD_PLACE);
                        $final_match = Match::getRoundMatch($tournament->getMatches(), Soccer::FINAL_);
                        if ($third_place_match != null && $final_match != null) {
                            if ($third_place_match->getHomeTeamName() == $team->getName() || $third_place_match->getAwayTeamName() == $team->getName() ||
                                $final_match->getHomeTeamName() == $team->getName() || $final_match->getAwayTeamName() == $team->getName()) {
                                $result = true;
                            }
                        }
                    }
                }
            }
            else {
                $semifinal_matches = Match::getRoundMatches($tournament->getMatches(), Soccer::SEMIFINALS);
                for ($i = 0; $i < sizeof($semifinal_matches); $i++) {
                    if ($semifinal_matches[$i]->getHomeTeamName() == $team->getName() || $semifinal_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                if (!$result) {
                    $third_place_match = Match::getRoundMatch($tournament->getMatches(), Soccer::THIRD_PLACE);
                    $final_match = Match::getRoundMatch($tournament->getMatches(), Soccer::FINAL_);
                    if ($third_place_match != null && $final_match != null) {
                        if ($third_place_match->getHomeTeamName() == $team->getName() || $third_place_match->getAwayTeamName() == $team->getName() ||
                            $final_match->getHomeTeamName() == $team->getName() || $final_match->getAwayTeamName() == $team->getName()) {
                            $result = true;
                        }
                    }
                }
                if (!$result) {
                    $bronze_medal_match = Match::getRoundMatch($tournament->getMatches(), Soccer::BRONZE_MEDAL_MATCH);
                    $gold_medal_match = Match::getRoundMatch($tournament->getMatches(), Soccer::GOLD_MEDAL_MATCH);
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

        public static function getFinishLiteral($tournament_id, $finish) {
            switch ($finish) {
                case Soccer::Group:
                    $best_finish = 'First Round';
                    break;
                case Soccer::SecondRound:
                    $best_finish = 'Second Round';
                    break;
                case Soccer::FinalRound:
                    $best_finish = 'Final Round';
                    break;
                case Soccer::PreliminaryRound:
                    $best_finish = 'First Round';
                    break;
                case Soccer::FirstRound:
                    $best_finish = 'First Round';
                    break;
                case Soccer::Round16:
                    $best_finish = 'Second Round';
                    break;
                case Soccer::Quarterfinal:
                    $best_finish = 'Quarterfinals';
                    break;
                case Soccer::FifthPlace:
                    $best_finish = 'Fifth Place';
                    break;
                case Soccer::Semifinal:
                    $best_finish = 'Fourth Place';
                    if (self::noThirdPlacePlayoffById($tournament_id)) $best_finish = 'Semifinals';
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
            $result = str_replace('UEFA Euro ', '', $result);
            $result = str_replace(' Copa America ', '', $result);
            $result = str_replace('Centenario ', '', $result);
            $result = str_replace(' South American Championship ', '', $result);
            $result = str_replace(' Gold Cup ', '', $result);
            $result = str_replace(' CONCACAF Championship ', '', $result);
            $result = str_replace(' Africa Cup of Nations ', '', $result);
            $result = str_replace(' African Cup of Nations ', '', $result);
            $result = str_replace(' AFC Asian Cup ', '', $result);
            $result = str_replace(' OFC Nations Cup ', '', $result);
            $result = str_replace(' FIFA Confederations Cup ', '', $result);
            $result = str_replace(' King Fahd Cup ', '', $result);
            if (!$olympic_tournament) $result = substr($result, -(strlen($result) - 4)).' '.substr($result, 0, 4);
            return $result;
        }

        public static function hasConfederationFilter($tournament) {
            return $tournament->getTournamentTypeId() == Tournament::WORLD_CUP || $tournament->getTournamentTypeId() == Tournament::WOMENS_WORLD_CUP
                || $tournament->getTournamentTypeId() == Tournament::OLYMPIC || $tournament->getTournamentTypeId() == Tournament::WOMENS_OLYMPIC;
        }
    }
