<?php
    class Soccer {
        private $id;

        protected function __construct(){ }

        public static function CreateSoccer($id) {
            $s = new Soccer();
            $s->id = $id;
            return $s;
        }

        public static function calculateStanding($team_dto, $match_dto, $first2Matches = false) {
            $numberOfMatches = 48;
            if ($first2Matches) $numberOfMatches = 32;
            $matches = $match_dto->getMatches();
            $team_array = Team::getTeamArrayById($team_dto);
            $tmp_array = array();
            $result = array();
            for ($i = 0; $i < $numberOfMatches; $i++ ) {
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
            for ($i = $numberOfMatches; $i < 48; $i++) {
                $tmp_scenarios = array();
                $tmp_s = Scenario::CreateScenario($matches[$i]->getHomeTeamName(), 'Win', $matches[$i]->getAwayTeamName(), 'Lose');
                array_push($tmp_scenarios, $tmp_s);
                array_push($tmp_scenarios, $tmp_s);
                array_push($tmp_scenarios, $tmp_s);
                array_push($tmp_scenarios, $tmp_s);
                array_push($tmp_scenarios, $tmp_s);
                array_push($tmp_scenarios, $tmp_s);
                array_push($tmp_scenarios, $tmp_s);
                array_push($tmp_scenarios, $tmp_s);
                array_push($tmp_scenarios, $tmp_s);
                $home_id = $matches[$i]->getHomeTeamId();
                $away_id = $matches[$i]->getAwayTeamId();
                $team_array[$home_id]->setScenarios($tmp_scenarios);
                $team_array[$away_id]->setScenarios($tmp_scenarios);
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
            if (!$first2Matches) {
                self::round16Qualifiers($team_dto, $match_dto);
                self::quarterfinalQualifiers($team_dto, $match_dto);
                self::semifinalQualifiers($team_dto, $match_dto);
                self::finalQualifiers($team_dto, $match_dto);
            }
        }

        public static function round16Qualifiers($team_dto, $match_dto) {
            $teams = Team::getTeamArrayByGroup($team_dto);
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
            $teams = Team::getTeamArrayByName($team_dto);
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
            $teams = Team::getTeamArrayByName($team_dto);
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
            $teams = Team::getTeamArrayByName($team_dto);
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
    }
