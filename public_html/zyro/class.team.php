<?php
    include_once('config.php');
    class Team {
        private $id;
        private $name;
        private $code;
        private $group_name;
        private $group_order;
        private $parent_group_name;
        private $parent_group_long_name;
        private $parent_group_order;
        private $flag_filename;
        private $logo_filename;
        private $match_play;
        private $win;
        private $draw;
        private $loss;
        private $goal_for;
        private $goal_against;
        private $goal_diff;
        private $point;

        protected function __construct(){ }

        public static function CreateSoccerTeam($id, $name, $code, $group_name, $group_order, $flag_filename) {
            $t = new Team();
            $t->id = $id;
            $t->name = $name;
            $t->code = $code;
            $t->group_name = $group_name;
            $t->group_order = $group_order;
            $t->flag_filename = $flag_filename;
            $t->match_play = 0;
            $t->win = 0;
            $t->draw = 0;
            $t->loss = 0;
            $t->goal_for = 0;
            $t->goal_against = 0;
            $t->goal_diff = 0;
            $t->point = 0;
            return $t;
        }

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

        public static function getSoccerTeams($tournament_dto) {

            $sql = Team::getSoccerTeamSql($tournament_dto->getTournamentId());

            return self::getSoccerTeamDTO($sql);
        }

        public static function getFootballTeams($tournament_dto) {

            $sql = Team::getFootballTeamSql($tournament_dto->getTournamentId());

            return self::getFootballTeamDTO($sql);
        }

        public static function getSoccerTeamDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                return TeamDTO::CreateSoccerTeamDTO(null, $count, $output);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam($row['team_id'], $row['name'], $row['code'],
                        $row['group_name'], $row['group_order'], $row['flag_filename']);
                    array_push($teams, $team);
                }
                return TeamDTO::CreateSoccerTeamDTO($teams, $count, $output);
            }
        }

        public static function getFootballTeamDTO($sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                return TeamDTO::CreateFootballTeamDTO(null, $count, $output);
            }
            else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $team = Team::CreateFootballTeam($row['name'], $row['group_name'], $row['group_order'],
                        $row['parent_group_long_name'], $row['parent_group_order'], $row['logo_filename']);
                    array_push($teams, $team);
                }
                return TeamDTO::CreateFootballTeamDTO($teams, $count, $output);
            }
        }

        public static function getSoccerHtml($team_dto) {
            $teams = Team::getTeamArrayByGroup($team_dto);
            $output = '';
            foreach ($teams as $group_name => $_teams) {
                $output .= '<div class="col-sm-12 margin-top-sm">
                            <span class="col-sm-2 h2-ff2">Group '.$group_name.'</span>
                            <span class="col-sm-2 wb-stl-heading4 margin-left-md" style="margin-top:15px;">
                                <a class="link-modal" data-toggle="modal" data-target="#group'.$group_name.'MatchesModal">Matches</a>
                            </span>
                        </div>
                        <div class="col-sm-12 box-xl">
                            <div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md font-bold">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-1">MP</div>
                                <div class="col-sm-1">W</div>
                                <div class="col-sm-1">D</div>
                                <div class="col-sm-1">L</div>
                                <div class="col-sm-1">GF</div>
                                <div class="col-sm-1">GA</div>
                                <div class="col-sm-1">+/-</div>
                                <div class="col-sm-1">Pts</div>
                            </div>';
                foreach ($_teams as $group_order => $_team) {
                    $output .= '<div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md">
                                <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'"></div>
                                <div class="col-sm-3" style="padding-top: 3px;">'.$_team->getName().'</div>
                                <div class="col-sm-1">'.$_team->getMatchPlay().'</div>
                                <div class="col-sm-1">'.$_team->getWin().'</div>
                                <div class="col-sm-1">'.$_team->getDraw().'</div>
                                <div class="col-sm-1">'.$_team->getLoss().'</div>
                                <div class="col-sm-1">'.$_team->getGoalFor().'</div>
                                <div class="col-sm-1">'.$_team->getGoalAgainst().'</div>
                                <div class="col-sm-1">'.$_team->getGoalDiff().'</div>
                                <div class="col-sm-1">'.$_team->getPoint().'</div>
                            </div>';
                }
                $output .= '</div>';
            }
            return $output;
        }

        public static function getSoccerModalHtml($team_dto) {
            $teams = Team::getTeamArrayByGroup($team_dto);
            $output = '';
            foreach ($teams as $group_name => $_teams) {
                $output .= '<div class="modal fade" id="group'.$group_name.'StandingModal" tabindex="-1" role="dialog" aria-labelledby="group'.$group_name.'StandingModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="width:800px;">
                        <div class="modal-content">
                            <div class="col-sm-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="modal-X" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-header col-sm-12 padding-lr-lg" style="border-bottom:none;">
                                <div class="col-sm-12 h3-ff3 border-bottom-gray2" id="group'.$group_name.'StandingModalLabel">Group '.$group_name.'</div>
                            </div>
                            <div class="modal-body col-sm-12 padding-lr-lg" id="group'.$group_name.'StandingModalBody">
                                <div class="col-sm-12 h3-ff3 row padding-tb-md font-bold">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-1">MP</div>
                                    <div class="col-sm-1">W</div>
                                    <div class="col-sm-1">D</div>
                                    <div class="col-sm-1">L</div>
                                    <div class="col-sm-1">GF</div>
                                    <div class="col-sm-1">GA</div>
                                    <div class="col-sm-1">+/-</div>
                                    <div class="col-sm-1">Pts</div>
                                </div>';
                foreach ($_teams as $group_order => $_team) {
                    $output .=     '<div class="col-sm-12 h3-ff3 row padding-tb-md">
                                    <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'"></div>
                                    <div class="col-sm-3" style="padding-top: 3px;">'.$_team->getName().'</div>
                                    <div class="col-sm-1">'.$_team->getMatchPlay().'</div>
                                    <div class="col-sm-1">'.$_team->getWin().'</div>
                                    <div class="col-sm-1">'.$_team->getDraw().'</div>
                                    <div class="col-sm-1">'.$_team->getLoss().'</div>
                                    <div class="col-sm-1">'.$_team->getGoalFor().'</div>
                                    <div class="col-sm-1">'.$_team->getGoalAgainst().'</div>
                                    <div class="col-sm-1">'.$_team->getGoalDiff().'</div>
                                    <div class="col-sm-1">'.$_team->getPoint().'</div>
                                </div>';
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
            return $output;
        }

        public static function getFootballHtml($team_dto) {
            $teams = Team::getFootballTeamArrayByConfDiv($team_dto);
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
            return $output;
        }

        public static function getSoccerTeamSql($tournament_id) {
            $sql = 'SELECT UCASE(t.name) AS name, team_id, 
                        group_id, UCASE(g.name) AS group_name, group_order, 
                        n.flag_filename, n.code, tt.tournament_id 
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

        public static function calculateSoccerStanding($team_dto, $match_dto) {
            $matches = $match_dto->getMatches();
            $team_array = self::getTeamArrayById($team_dto);
            $tmp_array = array();
            $result = array();
            for ($i = 0; $i < 48; $i++ ) {
                $home_id = $matches[$i]->getHomeTeamId();
                $away_id = $matches[$i]->getAwayTeamId();
                $home_score = $matches[$i]->getHomeTeamScore();
                $away_score = $matches[$i]->getAwayTeamScore();
                $team_array[$home_id]->setMatchPlay($team_array[$home_id]->getMatchPlay() + 1);
                $team_array[$away_id]->setMatchPlay($team_array[$away_id]->getMatchPlay() + 1);
                if ($home_score > $away_score) {
                    $team_array[$home_id]->setWin($team_array[$home_id]->getWin() + 1);
                    $team_array[$home_id]->setPoint($team_array[$home_id]->getPoint() + 3);
                    $team_array[$away_id]->setLoss($team_array[$away_id]->getLoss() + 1);
                }
                elseif ($home_score < $away_score) {
                    $team_array[$home_id]->setLoss($team_array[$home_id]->getLoss() + 1);
                    $team_array[$away_id]->setWin($team_array[$away_id]->getWin() + 1);
                    $team_array[$away_id]->setPoint($team_array[$away_id]->getPoint() + 3);
                }
                else {
                    $team_array[$home_id]->setDraw($team_array[$home_id]->getDraw() + 1);
                    $team_array[$home_id]->setPoint($team_array[$home_id]->getPoint() + 1);
                    $team_array[$away_id]->setDraw($team_array[$away_id]->getDraw() + 1);
                    $team_array[$away_id]->setPoint($team_array[$away_id]->getPoint() + 1);
                }
                $team_array[$home_id]->setGoalFor($team_array[$home_id]->getGoalFor() + $home_score);
                $team_array[$home_id]->setGoalAgainst($team_array[$home_id]->getGoalAgainst() + $away_score);
                $team_array[$home_id]->setGoalDiff($team_array[$home_id]->getGoalDiff() + $home_score - $away_score);
                $team_array[$away_id]->setGoalFor($team_array[$away_id]->getGoalFor() + $away_score);
                $team_array[$away_id]->setGoalAgainst($team_array[$away_id]->getGoalAgainst() + $home_score);
                $team_array[$away_id]->setGoalDiff($team_array[$away_id]->getGoalDiff() + $away_score - $home_score);
            }
            foreach ($team_array as $id => $_team) {
                $tmp_array[$_team->getGroupName()][$_team->getId()] = $_team;
            }
            foreach ($tmp_array as $group_name => $_teams) {
                $tmp_array2 = array();
                foreach ($_teams as $_id => $_team) {
                    array_push($tmp_array2, $_team);
                }
                for ($i = 0; $i <= 2; $i++) {
                    for ($j = $i+1; $j <= 3; $j++) {
                        if (self::isEqualStanding($tmp_array2[$i], $tmp_array2[$j])) {
                            $still_tie = self::applyTiebreaker($tmp_array2[$i], $tmp_array2[$j], $match_dto);
                            if ($still_tie) self::coinToss($tmp_array2[$i], $tmp_array2[$j]);
                        }
                        elseif (self::isHigherStanding($tmp_array2[$j], $tmp_array2[$i])) {
                            self::swapTeam($tmp_array2[$i], $tmp_array2[$j]);
                        }
                    }
                }
                $tmp_array[$group_name] = $tmp_array2;
            }
            foreach ($tmp_array as $group_name => $_teams) {
                foreach ($_teams as $_id => $_team) {
                    array_push($result, $_team);
                }
            }
            $team_dto->setTeams($result);
            self::round16Qualifiers($team_dto, $match_dto);
            self::quarterfinalQualifiers($team_dto, $match_dto);
            self::semifinalQualifiers($team_dto, $match_dto);
            self::finalQualifiers($team_dto, $match_dto);
        }

        public static function round16Qualifiers($team_dto, $match_dto) {
            $teams = self::getTeamArrayByGroup($team_dto);
            $round16_teams = array();
            $matches = $match_dto->getMatches();
            foreach ($teams as $group_name => $_teams) {
                $i = 0;
                foreach ($_teams as $group_order => $_team) {
                    if ($i <= 1) {
                        $round16_teams[($i+1).$group_name] = $_team;
                    }
                    $i++;
                }
            }

            for ($i = 48; $i < 56; $i++ ) {
                $matches[$i]->setHomeTeamName($round16_teams[$matches[$i]->getWaitingHomeTeam()]->getName());
                $matches[$i]->setAwayTeamName($round16_teams[$matches[$i]->getWaitingAwayTeam()]->getName());
                $matches[$i]->setHomeTeamCode($round16_teams[$matches[$i]->getWaitingHomeTeam()]->getCode());
                $matches[$i]->setAwayTeamCode($round16_teams[$matches[$i]->getWaitingAwayTeam()]->getCode());
                $matches[$i]->setHomeFlag($round16_teams[$matches[$i]->getWaitingHomeTeam()]->getFlagFilename());
                $matches[$i]->setAwayFlag($round16_teams[$matches[$i]->getWaitingAwayTeam()]->getFlagFilename());
            }
            $match_dto->setMatches($matches);
        }

        public static function quarterfinalQualifiers($team_dto, $match_dto) {
            $teams = self::getTeamArrayByName($team_dto);
            $quarterfinal_teams = array();
            $matches = $match_dto->getMatches();
            for ($i = 48; $i < 56; $i++ ) {
                if (self::isHomeTeamWin($matches[$i])) {
                    $quarterfinal_teams['W'.($i+1)] = $teams[$matches[$i]->getHomeTeamName()];
                }
                else {
                    $quarterfinal_teams['W'.($i+1)] = $teams[$matches[$i]->getAwayTeamName()];
                }
            }
            for ($i = 56; $i < 60; $i++ ) {
                $matches[$i]->setHomeTeamName($quarterfinal_teams[$matches[$i]->getWaitingHomeTeam()]->getName());
                $matches[$i]->setAwayTeamName($quarterfinal_teams[$matches[$i]->getWaitingAwayTeam()]->getName());
                $matches[$i]->setHomeTeamCode($quarterfinal_teams[$matches[$i]->getWaitingHomeTeam()]->getCode());
                $matches[$i]->setAwayTeamCode($quarterfinal_teams[$matches[$i]->getWaitingAwayTeam()]->getCode());
                $matches[$i]->setHomeFlag($quarterfinal_teams[$matches[$i]->getWaitingHomeTeam()]->getFlagFilename());
                $matches[$i]->setAwayFlag($quarterfinal_teams[$matches[$i]->getWaitingAwayTeam()]->getFlagFilename());
            }
            for ($i = 48; $i <= 58 ; $i++) {
                for ($j = $i+1; $j <= 59; $j++) {
                    if ($matches[$i]->getBracketOrder() > $matches[$j]->getBracketOrder()) {
                        $tmp_m = $matches[$i];
                        $matches[$i] = $matches[$j];
                        $matches[$j] = $tmp_m;
                    }
                }
            }
            $match_dto->setMatches($matches);
        }

        public static function semifinalQualifiers($team_dto, $match_dto) {
            $teams = self::getTeamArrayByName($team_dto);
            $semifinal_teams = array();
            $matches = $match_dto->getMatches();
            for ($i = 56; $i < 60; $i++ ) {
                if (self::isHomeTeamWin($matches[$i])) {
                    $semifinal_teams['W'.($i+1)] = $teams[$matches[$i]->getHomeTeamName()];
                }
                else {
                    $semifinal_teams['W'.($i+1)] = $teams[$matches[$i]->getAwayTeamName()];
                }
            }
            for ($i = 60; $i < 62; $i++ ) {
                $matches[$i]->setHomeTeamName($semifinal_teams[$matches[$i]->getWaitingHomeTeam()]->getName());
                $matches[$i]->setAwayTeamName($semifinal_teams[$matches[$i]->getWaitingAwayTeam()]->getName());
                $matches[$i]->setHomeTeamCode($semifinal_teams[$matches[$i]->getWaitingHomeTeam()]->getCode());
                $matches[$i]->setAwayTeamCode($semifinal_teams[$matches[$i]->getWaitingAwayTeam()]->getCode());
                $matches[$i]->setHomeFlag($semifinal_teams[$matches[$i]->getWaitingHomeTeam()]->getFlagFilename());
                $matches[$i]->setAwayFlag($semifinal_teams[$matches[$i]->getWaitingAwayTeam()]->getFlagFilename());
            }
            $match_dto->setMatches($matches);
        }

        public static function finalQualifiers($team_dto, $match_dto) {
            $teams = self::getTeamArrayByName($team_dto);
            $final_teams = array();
            $matches = $match_dto->getMatches();
            if (self::isHomeTeamWin($matches[60])) {
                $final_teams['W61'] = $teams[$matches[60]->getHomeTeamName()];
                $final_teams['L61'] = $teams[$matches[60]->getAwayTeamName()];
            }
            else {
                $final_teams['W61'] = $teams[$matches[60]->getAwayTeamName()];
                $final_teams['L61'] = $teams[$matches[60]->getHomeTeamName()];
            }
            if (self::isHomeTeamWin($matches[61])) {
                $final_teams['W62'] = $teams[$matches[61]->getHomeTeamName()];
                $final_teams['L62'] = $teams[$matches[61]->getAwayTeamName()];
            }
            else {
                $final_teams['W62'] = $teams[$matches[61]->getAwayTeamName()];
                $final_teams['L62'] = $teams[$matches[61]->getHomeTeamName()];
            }
            for ($i = 62; $i < 64; $i++ ) {
                $matches[$i]->setHomeTeamName($final_teams[$matches[$i]->getWaitingHomeTeam()]->getName());
                $matches[$i]->setAwayTeamName($final_teams[$matches[$i]->getWaitingAwayTeam()]->getName());
                $matches[$i]->setHomeTeamCode($final_teams[$matches[$i]->getWaitingHomeTeam()]->getCode());
                $matches[$i]->setAwayTeamCode($final_teams[$matches[$i]->getWaitingAwayTeam()]->getCode());
                $matches[$i]->setHomeFlag($final_teams[$matches[$i]->getWaitingHomeTeam()]->getFlagFilename());
                $matches[$i]->setAwayFlag($final_teams[$matches[$i]->getWaitingAwayTeam()]->getFlagFilename());
            }
            $tmp_m = $matches[62];
            $matches[62] = $matches[63];
            $matches[63] = $tmp_m;
            $match_dto->setMatches($matches);
        }

        public static function getTeamArrayById($team_dto) {
            $result = array();
            for ($i = 0; $i < sizeof($team_dto->getTeams()); $i++) {
                $result[$team_dto->getTeams()[$i]->getId()] = $team_dto->getTeams()[$i];
            }
            return $result;
        }

        public static function getTeamArrayByName($team_dto) {
            $teams = $team_dto->getTeams();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getName()] = $teams[$i];
            }
            return $result;
        }

        public static function getTeamArrayByGroup($team_dto) {
            $teams = $team_dto->getTeams();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getGroupName()][$teams[$i]->getGroupOrder()] = $teams[$i];
            }
            return $result;
        }

        public static function getFootballTeamArrayByConfDiv($team_dto) {
            $teams = $team_dto->getTeams();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getParentGroupLongName()]
                        [$teams[$i]->getParentGroupName().' '.$teams[$i]->getGroupName()]
                        [$teams[$i]->getGroupOrder()] = $teams[$i];
            }
            return $result;
        }

        public static function isHomeTeamWin($match) {
            if ($match->getHomeTeamScore() > $match->getAwayTeamScore()) {
                return true;
            }
            elseif ($match->getHomeTeamScore() == $match->getAwayTeamScore()) {
                if ($match->getHomeTeamExtraTimeScore() > $match->getAwayTeamExtraTimeScore()) {
                    return true;
                }
                elseif ($match->getHomeTeamExtraTimeScore() == $match->getAwayTeamExtraTimeScore()) {
                    if ($match->getHomeTeamPenaltyScore() > $match->getAwayTeamPenaltyScore()) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }

        public static function isHigherStanding($t1, $t2) {
            if ($t1->getPoint() > $t2->getPoint()) {
                return true;
            }
            elseif ($t1->getPoint() == $t2->getPoint()) {
                if ($t1->getGoalDiff() > $t2->getGoalDiff()) {
                    return true;
                }
                elseif ($t1->getGoalDiff() == $t2->getGoalDiff()) {
                    if ($t1->getGoalFor() > $t2->getGoalFor()) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }

        public static function isEqualStanding($t1, $t2) {
            return $t1->getPoint() == $t2->getPoint() && $t1->getGoalDiff() == $t2->getGoalDiff()
                && $t1->getGoalFor() == $t2->getGoalFor();
        }

        public static function applyTiebreaker(&$t1, &$t2, $match_dto) {
            $still_tie = false;
            $matches = $match_dto->getMatches();
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

        public static function coinToss(&$t1, &$t2) {
            $coin = mt_rand(0,1);
            if ($coin == 1) self::swapTeam($t1, $t2);
        }

        public static function swapTeam(&$t1, &$t2) {
            $tmp_t = $t1;
            $t1 = $t2;
            $t2 = $tmp_t;
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
    }

    class TeamDTO {
        private $teams;
        private $count;
        private $html;

        protected function __construct(){ }

        public static function CreateSoccerTeamDTO($teams, $count, $html) {
            $team_dto = new TeamDTO();
            $team_dto->teams = $teams;
            $team_dto->count = $count;
            $team_dto->html = $html;
            return $team_dto;
        }

        public static function CreateFootballTeamDTO($teams, $count, $html) {
            $team_dto = new TeamDTO();
            $team_dto->teams = $teams;
            $team_dto->count = $count;
            $team_dto->html = $html;
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

    abstract class TeamView {
        const GroupView = 1;
        const ModalView = 2;
    }
