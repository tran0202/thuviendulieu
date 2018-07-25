<?php
    include_once('class.match.php');
    include_once('class.team.php');

    class Soccer {

        const GROUP_MATCHES = 'Group Matches';
        const WITHDREW = 'Withdrew';
        const SECOND_ROUND = 'Second Round';
        const FINAL_ROUND = 'Final Round';
        const PLAY_OFF = 'Play-off';
        const PRELIMINARY_ROUND = 'Preliminary Round';
        const FIRST_ROUND = 'First Round';
        const REPLAY_FIRST_ROUND = 'Replay First Round';
        const ROUND16 = 'Round of 16';
        const QUARTERFINALS = 'Quarterfinals';
        const REPLAY_QUARTERFINALS = 'Replay Quarterfinals';
        const SEMIFINALS = 'Semifinals';
        const THIRD_PLACE = 'Third place';
        const FINAL_ = 'Final';
        const FIRST_STAGE = 'First Stage';
        const SECOND_STAGE = 'Second Stage';

        private $id;

        protected function __construct() { }

        public static function CreateSoccer($id) {
            $s = new Soccer();
            $s->id = $id;
            return $s;
        }

        public static function getStanding($tournament) {
            $numberOfMatches = 48;
            if ($tournament->getFantasy() == Fantasy::Half) $numberOfMatches = 32;
            elseif ($tournament->getFantasy() == Fantasy::None) $numberOfMatches = self::getNumberOfCompletedMatches($tournament);
            $matches = $tournament->getMatches();
            $team_array = self::getTeamArrayByName($tournament->getTeams());
            $tmp_array = array();
            $result = array();
            for ($i = 0; $i < $numberOfMatches; $i++ ) {
                self::calculatePoint($team_array, $matches[$i], Stage::First);
            }
            foreach ($team_array as $name => $_team) {
                $tmp_array[$_team->getGroupName()][$_team->getName()] = $_team;
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
                    array_push($result, $_team);
                }
            }
            $tournament->setTeams($result);
            if ($tournament->getFantasy() == Fantasy::All) {
                self::round16Qualifiers($tournament);
                self::quarterfinalQualifiers($tournament);
                self::semifinalQualifiers($tournament);
                self::finalQualifiers($tournament);
            }
            elseif ($tournament->getFantasy() == Fantasy::Half) {
                self::calculateScenarios($tournament);
            }
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

        public static function round16Qualifiers($tournament) {
            $teams = self::getTeamArrayByGroup($tournament->getTeams());
            $round16_teams = array();
            $matches = $tournament->getMatches();
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
            $tournament->setMatches($matches);
        }

        public static function quarterfinalQualifiers($tournament) {
            $teams = self::getTeamArrayByName($tournament->getTeams());
            $quarterfinal_teams = array();
            $matches = $tournament->getMatches();
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
            $tournament->setMatches($matches);
        }

        public static function semifinalQualifiers($tournament) {
            $teams = self::getTeamArrayByName($tournament->getTeams());
            $semifinal_teams = array();
            $matches = $tournament->getMatches();
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
            $tournament->setMatches($matches);
        }

        public static function finalQualifiers($tournament) {
            $teams = self::getTeamArrayByName($tournament->getTeams());
            $final_teams = array();
            $matches = $tournament->getMatches();
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
            $tournament->setMatches($matches);
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

        public static function calculateScenarios($tournament) {
            $team_array = self::getTeamArrayByName($tournament->getTeams());
            $matches = self::getMatchArrayByGroup($tournament->getMatches());
            foreach ($matches as $group_name => $_matches) {
                $group_team_names = array();
                $group_teams = array();
                foreach ($_matches as $group_order => $_match) {
                    if ($_match->getMatchOrder() > 32 && $_match->getMatchOrder() <= 48) {
                        array_push($group_team_names, $_match->getHomeTeamName());
                        array_push($group_team_names, $_match->getAwayTeamName());
                        $group_teams[$_match->getHomeTeamName()] = $team_array[$_match->getHomeTeamName()];
                        $group_teams[$_match->getAwayTeamName()] = $team_array[$_match->getAwayTeamName()];
                    }
                }
                if (sizeof($group_teams) > 0) {
                    self::calculateGroupScenarios($group_team_names, $group_teams, $tournament->getMatches());
                }
            }
        }

        public static function calculateGroupScenarios($group_team_names, $group_teams, $matches) {
            $scenario_array = array();
            $tmp_scenarios1 = array();
            $tmp_scenarios2 = array();
            $tmp_scenarios3 = array();
            $tmp_scenarios4 = array();
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $matches));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $matches));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 1, 0, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $matches));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $matches));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $matches));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 0, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $matches));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 1, 0, $group_team_names[3], $matches));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 0, 0, $group_team_names[3], $matches));
            array_push($scenario_array, self::calculateGroupStanding($group_teams, $group_team_names[0], 0, 1, $group_team_names[1],
                $group_team_names[2], 0, 1, $group_team_names[3], $matches));
            for ($i = 0; $i < 9; $i++) {
                array_push($tmp_scenarios1, $scenario_array[$i]);
                self::calculateTeamScenarios($tmp_scenarios1);
            }
            for ($i = 0; $i < 9; $i++) {
                array_push($tmp_scenarios2, Scenario::CreateScenario($tmp_scenarios1[8 - $i]->getTeam2(), $tmp_scenarios1[8 - $i]->getTeam2Result(),
                    $tmp_scenarios1[8 - $i]->getTeam2Point(), $tmp_scenarios1[8 - $i]->getTeam2GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam2GoalFor(), $tmp_scenarios1[8 - $i]->getMatch1ResultGoalAgainst(), $tmp_scenarios1[8 - $i]->getMatch1ResultGoalFor(),
                    $tmp_scenarios1[8 - $i]->getTeam2Status(), $tmp_scenarios1[8 - $i]->getTeam2MatchResult(), $tmp_scenarios1[8 - $i]->getTeam1(), $tmp_scenarios1[8 - $i]->getTeam1Result(), $tmp_scenarios1[8 - $i]->getTeam1Point(), $tmp_scenarios1[8 - $i]->getTeam1GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam1GoalFor(), $tmp_scenarios1[8 - $i]->getTeam1Status(), $tmp_scenarios1[8 - $i]->getTeam1MatchResult(),
                    $tmp_scenarios1[8 - $i]->getTeam4(), $tmp_scenarios1[8 - $i]->getTeam4Result(), $tmp_scenarios1[8 - $i]->getTeam4Point(), $tmp_scenarios1[8 - $i]->getTeam4GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam4GoalFor(), $tmp_scenarios1[8 - $i]->getMatch2ResultGoalAgainst(), $tmp_scenarios1[8 - $i]->getMatch2ResultGoalFor(),
                    $tmp_scenarios1[8 - $i]->getTeam4Status(), $tmp_scenarios1[8 - $i]->getTeam4MatchResult(), $tmp_scenarios1[8 - $i]->getTeam3(), $tmp_scenarios1[8 - $i]->getTeam3Result(), $tmp_scenarios1[8 - $i]->getTeam3Point(), $tmp_scenarios1[8 - $i]->getTeam3GoalDiff(), $tmp_scenarios1[8 - $i]->getTeam3GoalFor(), $tmp_scenarios1[8 - $i]->getTeam3Status(), $tmp_scenarios1[8 - $i]->getTeam3MatchResult(), ''));
                self::calculateTeamScenarios($tmp_scenarios2);
            }
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    array_push($tmp_scenarios3, Scenario::CreateScenario($tmp_scenarios1[$i + 3 * $j]->getTeam3(), $tmp_scenarios1[$i + 3 * $j]->getTeam3Result(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam3Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam3GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam3GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch2ResultGoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch2ResultGoalAgainst(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam3Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam3MatchResult(), $tmp_scenarios1[$i + 3 * $j]->getTeam4(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam4GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam4GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getTeam4Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam4MatchResult(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam1(), $tmp_scenarios1[$i + 3 * $j]->getTeam1Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam1Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam1GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam1GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch1ResultGoalFor(), $tmp_scenarios1[$i + 3 * $j]->getMatch1ResultGoalAgainst(),
                        $tmp_scenarios1[$i + 3 * $j]->getTeam1Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam1MatchResult(), $tmp_scenarios1[$i + 3 * $j]->getTeam2(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Result(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Point(), $tmp_scenarios1[$i + 3 * $j]->getTeam2GoalDiff(), $tmp_scenarios1[$i + 3 * $j]->getTeam2GoalFor(), $tmp_scenarios1[$i + 3 * $j]->getTeam2Status(), $tmp_scenarios1[$i + 3 * $j]->getTeam2MatchResult(), ''));
                    self::calculateTeamScenarios($tmp_scenarios3);
                }
            }
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    array_push($tmp_scenarios4, Scenario::CreateScenario($tmp_scenarios1[8 - $i - 3 * $j]->getTeam4(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Result(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Point(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4GoalDiff(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4GoalFor(), $tmp_scenarios1[8 - $i - 3 * $j]->getMatch2ResultGoalAgainst(), $tmp_scenarios1[8 - $i - 3 * $j]->getMatch2ResultGoalFor(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam4MatchResult(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3Result(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3Point(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3GoalDiff(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3GoalFor(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam3MatchResult(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2Result(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2Point(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2GoalDiff(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2GoalFor(), $tmp_scenarios1[8 - $i - 3 * $j]->getMatch1ResultGoalAgainst(), $tmp_scenarios1[8 - $i - 3 * $j]->getMatch1ResultGoalFor(),
                        $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam2MatchResult(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1Result(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1Point(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1GoalDiff(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1GoalFor(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1Status(), $tmp_scenarios1[8 - $i - 3 * $j]->getTeam1MatchResult(), ''));
                    self::calculateTeamScenarios($tmp_scenarios4);
                }
            }
            $group_teams[$group_team_names[0]]->setScenarios($tmp_scenarios1);
            $group_teams[$group_team_names[1]]->setScenarios($tmp_scenarios2);
            $group_teams[$group_team_names[2]]->setScenarios($tmp_scenarios3);
            $group_teams[$group_team_names[3]]->setScenarios($tmp_scenarios4);
        }

        public static function calculateTeamScenarios($scenarios) {
            $team_array = array();
            for ($i = 0; $i < sizeof($scenarios); $i++) {
                $team_array[$scenarios[$i]->getTeam1Result()] = Team::CloneSoccerTeam(0, $scenarios[$i]->getTeam1MatchResult(), $scenarios[$i]->getTeam1(), '', $scenarios[$i]->getTeam1Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam1GoalFor(), 0, $scenarios[$i]->getTeam1GoalDiff(), $scenarios[$i]->getTeam1Point());
                $team_array[$scenarios[$i]->getTeam2Result()] = Team::CloneSoccerTeam(0, $scenarios[$i]->getTeam2MatchResult(), $scenarios[$i]->getTeam2(), '', $scenarios[$i]->getTeam2Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam2GoalFor(), 0, $scenarios[$i]->getTeam2GoalDiff(), $scenarios[$i]->getTeam2Point());
                $team_array[$scenarios[$i]->getTeam3Result()] = Team::CloneSoccerTeam(0, $scenarios[$i]->getTeam3MatchResult(), $scenarios[$i]->getTeam3(), '', $scenarios[$i]->getTeam3Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam3GoalFor(), 0, $scenarios[$i]->getTeam3GoalDiff(), $scenarios[$i]->getTeam3Point());
                $team_array[$scenarios[$i]->getTeam4Result()] = Team::CloneSoccerTeam(0, $scenarios[$i]->getTeam4MatchResult(), $scenarios[$i]->getTeam4(), '', $scenarios[$i]->getTeam4Result(),
                    3, 0, 0, 0, $scenarios[$i]->getTeam4GoalFor(), 0, $scenarios[$i]->getTeam4GoalDiff(), $scenarios[$i]->getTeam4Point());
                $qualify_status = QualifyStatus::Eliminated;
                $note = '';
                if ($team_array[1]->getPoint() == $team_array[2]->getPoint() && $team_array[1]->getPoint() == $team_array[3]->getPoint() &&
                    $team_array[1]->getPoint() == $team_array[4]->getPoint()) {
                    $passing_gd = $team_array[1]->getGoalDiff() - $team_array[2]->getGoalDiff() + 1;
                    $passing_gf = $team_array[1]->getGoalFor() - $team_array[2]->getGoalFor() + 1;
                    $passing_gd2 = $team_array[1]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                    $passing_gf2 = $team_array[1]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                    $passing_gd3 = $team_array[1]->getGoalDiff() - $team_array[4]->getGoalDiff() + 1;
                    $passing_gf3 = $team_array[1]->getGoalFor() - $team_array[4]->getGoalFor() + 1;
                    $passing_gd4 = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                    $passing_gf4 = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                    $passing_gd5 = $team_array[2]->getGoalDiff() - $team_array[4]->getGoalDiff() + 1;
                    $passing_gf5 = $team_array[2]->getGoalFor() - $team_array[4]->getGoalFor() + 1;
                    $passing_gd6 = $team_array[3]->getGoalDiff() - $team_array[4]->getGoalDiff() + 1;
                    $passing_gf6 = $team_array[3]->getGoalFor() - $team_array[4]->getGoalFor() + 1;
                    if ($scenarios[$i]->getTeam1Result() == 1) {
                        if ($team_array[1]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            if ($team_array[3]->getName() == 'W') { echo '<script>alert("No#11");</script>';
                                $note = '*** If both '.$team_array[2]->getCode().' and '.$team_array[3]->getCode().' catch up the goal-diff by '.($passing_gd - 1).' and '.($passing_gd2 - 1).
                                    ' respectively, and pass the goal-for by '.$passing_gf.' and '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If both '.$team_array[2]->getCode().' and '.$team_array[3]->getCode().' pass the goal-diff by '.$passing_gd.' and '.$passing_gd2.
                                    ' respectively, '.$team_array[1]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[4]->getName() == 'W') {
                                $note = '*** If both '.$team_array[2]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd.'-0 and '.$passing_gd3.'-0 (or win goal-diff by '.($passing_gd - 1).' and '.($passing_gd3 - 1).
                                    ') respectively, and score '.($passing_gf + 1).' and '.($passing_gf3 + 1).' (or win goal-for by '.($passing_gf + 1).' and '.($passing_gf3 + 1).'), '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If both '.$team_array[2]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd + 1).'-0 and '.($passing_gd3 + 1).'-0 (or win goal-diff by '.$passing_gd.' and '.$passing_gd3.
                                    ') respectively, '.$team_array[1]->getCode().' will be eliminated. ***';
                            }
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd2.'-0 and '.$passing_gd3.'-0 (or win the goal-diff by '.($passing_gd2 - 1).' and '.($passing_gd3 - 1).
                                ') respectively, and score '.($passing_gf2 + 1).' and '.($passing_gf3 + 1).' (or win goal-for by '.($passing_gf2 + 1).' and '.($passing_gf3 + 1).', '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd2 + 1).'-0 and '.($passing_gd3 + 1).'-0 (or win the goal-diff by '.$passing_gd2.' and '.$passing_gd3.
                                ') respectively, '.$team_array[1]->getCode().' will be eliminated. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 2) {
                        if ($team_array[2]->getName() == 'W' && $team_array[1]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[1]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[1]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[2]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.$passing_gf.' (or wins goal-for by '.$passing_gf.'), '.$team_array[2]->getCode().' will advance for sure. *** Or Else:<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' wins '.($passing_gd + 1).'-0 (or wins the goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will advance for sure. *** Or Else:<br>';
                            if ($team_array[3]->getName() == 'W') { echo '<script>alert("No#12");</script>';
                                $note .= '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[4]->getName() == 'W') {
                                $note .= '*** If '.$team_array[4]->getCode().' wins '.$passing_gd5.'-0 (or wins goal-diff by '.($passing_gd5 - 1).') and scores '.($passing_gf5 + 1).' (or wins goal-for by '.$passing_gf5.'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd5 + 1).'-0 (or wins the goal-diff by '.$passing_gd5.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[1]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[1]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[1]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[1]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            if ($team_array[3]->getName() == 'W') {
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd4.'-0 (or wins goal-diff by '.($passing_gd4 - 1).') and scores '.($passing_gf4 + 1).' (or wins goal-for by '.($passing_gf4 + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd4 + 1).'-0 (or wins goal-diff by '.$passing_gd4.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[4]->getName() == 'W') { echo '<script>alert("No#14");</script>';
                                $note = '*** If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd5 - 1).' and passes the goal-for by '.$passing_gf5.', '.$team_array[2]->getCode().' will be eliminated.<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd5.', '.$team_array[2]->getCode().' will be eliminated.';
                            }
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[1]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[1]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd4.'-0 and '.$passing_gd5.'-0 (or win goal-diff by '.($passing_gd4 - 1).' and '.($passing_gd5 - 1).
                                ') respectively, and score '.($passing_gf4 + 1).' and '.($passing_gf5 + 1).' (or win goal-for by '.($passing_gf4 + 1).' and '.($passing_gf5 + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd4 + 1).'-0 and '.($passing_gd5 + 1).'-0 (or win goal-diff by '.$passing_gd4.' and '.$passing_gd5.
                                ') respectively, '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 3) {
                        if ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#15");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd2 - 1).' and passes the goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#16");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd2 - 1).' and passes the goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd2.'-0 (or wins goal-diff by '.($passing_gd2 - 1).') and scores '.($passing_gf2 + 1).' (or wins goal-for by '.($passing_gf2 + 1).'), '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd2 + 1).'-0 (or wins goal-diff by '.$passing_gd2.'), '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[3]->getCode().' wins '.$passing_gd4.'-0 (or wins goal-diff by '.($passing_gd4 - 1).') and scores '.($passing_gf4 + 1).' (or wins goal-for by '.($passing_gf4 + 1).'), '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd4 + 1).'-0 (or wins goal-diff by '.$passing_gd4.'), '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[4]->getCode().' wins '.$passing_gd6.'-0 (or wins goal-diff by '.($passing_gd6 - 1).') and scores '.($passing_gf6 + 1).' (or wins goal-for by '.$passing_gf6.'), '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd6 + 1).'-0 (or wins goal-diff by '.$passing_gd6.'), '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance.<br>';
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                            if ($team_array[1]->getName() == 'L') { echo '<script>alert("No#17");</script>';
                                $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd2 - 1).' and passes the goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            }
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                            if ($team_array[1]->getName() == 'L') { echo '<script>alert("No#18");</script>';
                                $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd2 - 1).' and passes the goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                                $note .= '*** Or If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd6 - 1).' and passes the goal-for by '.$passing_gf6.', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd6.', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance.<br>';
                            }
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            if ($team_array[1]->getName() == 'W') { echo '<script>alert("No#19");</script>';
                                $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                            }
                            elseif ($team_array[1]->getName() == 'D') { echo '<script>alert("No#20");</script>';
                                $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and passes the goal-for by '.$passing_gf4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd4.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                                $note .= '*** Or If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd6 - 1).' and passes the goal-for by '.$passing_gf6.', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd6.', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance.<br>';
                            }
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                            if ($team_array[1]->getName() == 'L') {
                                $note = '*** If '.$team_array[1]->getCode().' loses 0-'.$passing_gd2.' (or loses goal-diff by '.($passing_gd2 - 1).') and loses goal-for by '.$passing_gf2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance<br>';
                                $note .= '*** If '.$team_array[1]->getCode().' loses 0-'.($passing_gd2 + 1).' (or loses goal-diff by '.$passing_gd2.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[3]->getCode().' will advance.<br>';
                                $note .= '*** Or If '.$team_array[4]->getCode().' wins '.$passing_gd6.'-0 (or wins goal-diff by '.($passing_gd6 - 1).') and wins the goal-for by '.($passing_gf6 + 1).', '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance<br>';
                                $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd6 + 1).'-0 (or wins goal-diff by '.$passing_gd6.'), '.$team_array[3]->getCode().' will be eliminated for sure and '.$team_array[4]->getCode().' may advance.<br>';
                            }
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#21");</script>';
                            $note = '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd4 - 1).' and '.($passing_gd5 - 1).
                                ' respectively, and passes the goal-for by '.$passing_gf4.' and '.$passing_gf5.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd4.' and '.$passing_gd5.
                                ' respectively, '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** Or If both '.$team_array[3]->getCode().' and '.$team_array[2]->getCode().' catches up the goal-diff by '.($passing_gd6 - 1).' and '.($passing_gd5 - 1).
                                ' respectively, and passes the goal-for by '.$passing_gf6.' and '.$passing_gf5.', '.$team_array[4]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[2]->getCode().' will advance.***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[2]->getCode().' passes the goal-diff by '.$passing_gd6.' and '.$passing_gd5.
                                ' respectively, '.$team_array[4]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[2]->getCode().' will advance.***<br>';
                        }
                    }
                    else {
                        if ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[4]->getCode().' wins '.$passing_gd3.'-0 (or wins goal-diff by '.($passing_gd3 - 1).') and scores '.($passing_gf3 + 1).' (or wins goal-for by '.($passing_gf3 + 1).'), '.$team_array[1]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd3 + 1).'-0 (or wins goal-diff by '.$passing_gd3.'), '.$team_array[1]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[4]->getCode().' wins '.$passing_gd5.'-0 (or wins goal-diff by '.($passing_gd5 - 1).') and scores '.($passing_gf5 + 1).' (or wins goal-for by '.$passing_gf5.'), '.$team_array[2]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd5 + 1).'-0 (or wins goal-diff by '.$passing_gd5.'), '.$team_array[2]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance.<br>';
                        }
                        elseif ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#22");</script>';
                            $note = '*** If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd3 - 1).' and passes the goal-for by '.$passing_gf3.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd3.', '.$team_array[1]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance.<br>';
                            $note .= '*** Or If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd5 - 1).' and passes the goal-for by '.$passing_gf5.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' passes the goal-diff by '.$passing_gd5.', '.$team_array[2]->getCode().' will be eliminated and '.$team_array[4]->getCode().' will advance.<br>';
                        }
                        elseif ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd2.'-0 and '.$passing_gd3.'-0 (or win goal-diff by '.($passing_gd2 - 1).' and '.($passing_gd3 - 1).
                                ') respectively, and score '.($passing_gf2 + 1).' and '.($passing_gf3 + 1).' (or win goal-for by '.($passing_gf2 + 1).' and '.($passing_gf3 + 1).'), '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd2 + 1).'-0 and '.($passing_gd3 + 1).'-0 (or win goal-diff by '.$passing_gd2.' and '.$passing_gd3.
                                ') respectively, '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** Or If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.$passing_gd4.'-0 and '.$passing_gd5.'-0 (or win goal-diff by '.($passing_gd4 - 1).' and '.($passing_gd5 - 1).
                                ') respectively, and score '.($passing_gf4 + 1).' and '.($passing_gf5 + 1).' (or win goal-for by '.($passing_gf4 + 1).' and '.($passing_gf5 + 1).'), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                            $note .= '*** If both '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' win '.($passing_gd4 + 1).'-0 and '.($passing_gd5 + 1).'-0 (or win goal-diff by '.$passing_gd4.' and '.$passing_gd5.
                                ') respectively, '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' and '.$team_array[4]->getCode().' will advance.***<br>';
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                    }
                }
                elseif ($team_array[1]->getPoint() == $team_array[2]->getPoint() && $team_array[1]->getPoint() == $team_array[3]->getPoint()) {
                    if ($scenarios[$i]->getTeam1Result() == 1) {
                        $passing_gd = $team_array[1]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[1]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[1]->getName() == 'W' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[1]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[1]->getName() == 'W' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'W' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or similar), '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'D' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins the goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[1]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[1]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[1]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[1]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                        elseif ($team_array[1]->getName() == 'L' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced; echo '<script>alert("No#1");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[1]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd.', '.$team_array[1]->getCode().' will be eliminated. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 2) {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or similar), '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced; echo '<script>alert("No#2");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd.', '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 3) {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#4");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' makes up the goal-diff by '.$passing_gd.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                }
                elseif ($team_array[2]->getPoint() == $team_array[3]->getPoint() && $team_array[2]->getPoint() == $team_array[4]->getPoint()) {
                    if ($scenarios[$i]->getTeam1Result() == 1) {
                        $qualify_status = QualifyStatus::Advanced;
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 2) {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced; echo '<script>alert("No#5");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' passes the goal-diff by '.$passing_gd.', '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced; echo '<script>alert("No#6");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' wins by '.$passing_gd.' and passes the goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins by '.($passing_gd + 1).', '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                        elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Advanced;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 3) {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                        if ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#7");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' makes up the goal-diff by '.$passing_gd.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#8");</script>';
                            $note = '*** If '.$team_array[3]->getCode().' wins by '.$passing_gd.' and passes the goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins by '.($passing_gd+ 1).', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                    else {
                        $passing_gd = $team_array[2]->getGoalDiff() - $team_array[4]->getGoalDiff() + 1;
                        $passing_gf = $team_array[2]->getGoalFor() - $team_array[4]->getGoalFor() + 1;
                        if ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#9");</script>';
                            $note = '*** If '.$team_array[4]->getCode().' catches up the goal-diff by '.($passing_gd - 1).' and passes the goal-for by '.$passing_gf.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' makes up the goal-diff by '.$passing_gd.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated; echo '<script>alert("No#10");</script>';
                            $note = '*** If '.$team_array[4]->getCode().' wins by '.$passing_gd.' and passes the goal-for by '.$passing_gf.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins by '.($passing_gd+ 1).', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[4]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[4]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.($passing_gf + 1).'), '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[4]->getCode().' wins '.($passing_gd+ 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                            $qualify_status = QualifyStatus::Eliminated;
                        }
                        elseif ($team_array[4]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                            $qualify_status = QualifyStatus::Eliminated;
                            $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                            $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[4]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                        }
                    }
                }
                else {
                    $passing_gd = $team_array[2]->getGoalDiff() - $team_array[3]->getGoalDiff() + 1;
                    $passing_gf = $team_array[2]->getGoalFor() - $team_array[3]->getGoalFor() + 1;
                    if ($scenarios[$i]->getTeam1Result() == 1) {
                        if ($team_array[1]->getPoint() > $team_array[2]->getPoint()) {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        else {
                            if ($team_array[1]->getPoint() > $team_array[3]->getPoint()) {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 2) {
                        if ($team_array[2]->getPoint() > $team_array[3]->getPoint()) {
                            $qualify_status = QualifyStatus::Advanced;
                        }
                        else {
                            // Cover both gd greater and equal
                            if ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or equals goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. *** <br>';
                            }
                            elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                            elseif ($team_array[2]->getName() == 'W' && $team_array[3]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                            elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or beats goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or similar), '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                            elseif ($team_array[2]->getName() == 'D' && $team_array[3]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Advanced;
                            }
                            elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or equals goal-diff by '.($passing_gd + 1).') and scores '.($passing_gf + 1).' (or beats goal-for by '.($passing_gf + 1).'), '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.($passing_gd + 2).'), '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                                $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                            }
                            elseif ($team_array[2]->getName() == 'L' && $team_array[3]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Advanced;
                                $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                                $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                            }
                        }
                    }
                    elseif ($scenarios[$i]->getTeam1Result() == 3) {
                        if ($team_array[3]->getPoint() == $team_array[2]->getPoint()) {
                            // Cover both gd equal and smaller
                            if ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd + 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or similar) and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[3]->getName() == 'W' && $team_array[2]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[3]->getCode().' wins '.$passing_gd.'-0 (or wins goal-diff by '.($passing_gd - 1).') and scores '.($passing_gf + 1).' (or wins goal-for by '.$passing_gf.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[3]->getCode().' wins '.($passing_gd+ 1).'-0 (or wins goal-diff by '.$passing_gd.'), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Eliminated;
                            }
                            elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Eliminated;
                            }
                            elseif ($team_array[3]->getName() == 'D' && $team_array[2]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or similar) and loses goal-for by '.$passing_gf.', '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***<br>';
                                $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or similar), '.$team_array[3]->getCode().' will advance. '.$team_array[2]->getCode().' will be eliminated. ***';
                            }
                            elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'W') {
                                $qualify_status = QualifyStatus::Eliminated;
                            }
                            elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'D') {
                                $qualify_status = QualifyStatus::Eliminated;
                            }
                            elseif ($team_array[3]->getName() == 'L' && $team_array[2]->getName() == 'L') {
                                $qualify_status = QualifyStatus::Eliminated;
                                $note = '*** If '.$team_array[2]->getCode().' loses 0-'.$passing_gd.' (or loses goal-diff by '.($passing_gd - 1).') and loses goal-for by '.$passing_gf.', '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***<br>';
                                $note .= '*** If '.$team_array[2]->getCode().' loses 0-'.($passing_gd + 1).' (or loses goal-diff by '.$passing_gd.'), '.$team_array[2]->getCode().' will be eliminated. '.$team_array[3]->getCode().' will advance. ***';
                            }
                        }
                    }
                }
                $scenarios[$i]->setTeam1Status($qualify_status);
                $scenarios[$i]->setNote($note);
            }
        }

        public static function calculateGroupStanding($group_teams, $t1, $t1_gf, $t1_ga, $t2, $t3, $t3_gf, $t3_ga, $t4, $matches) {
            $tmp_group_teams = array();
            foreach ($group_teams as $team_name => $team) {
                $tmp_group_teams[$team_name] = Team::CloneSoccerTeam($team->getId(), $team->getName(), $team->getCode(), $team->getGroupName(),
                    $team->getGroupOrder(), $team->getMatchPlay(), $team->getWin(), $team->getDraw(), $team->getLoss(),
                    $team->getGoalFor(), $team->getGoalAgainst(), $team->getGoalDiff(), $team->getPoint());
            }

            $tmp_matches = array();
            for ($i = 0; $i < sizeof($matches); $i++) {
                array_push($tmp_matches, Match::CloneSoccerMatch($matches[$i]->getHomeTeamId(), $matches[$i]->getHomeTeamName(),
                    $matches[$i]->getHomeTeamCode(), $matches[$i]->getAwayTeamId(), $matches[$i]->getAwayTeamName(), $matches[$i]->getAwayTeamCode(),
                    $matches[$i]->getHomeTeamScore(), $matches[$i]->getAwayTeamScore()));
            }
            for ($i = 0; $i < sizeof($tmp_matches); $i++) {
                if ($tmp_matches[$i]->getHomeTeamName() == $t1 && $tmp_matches[$i]->getAwayTeamName() == $t2) {
                    $tmp_matches[$i]->setHomeTeamScore($t1_gf);
                    $tmp_matches[$i]->setAwayTeamScore($t1_ga);
                }
                if ($tmp_matches[$i]->getHomeTeamName() == $t2 && $tmp_matches[$i]->getAwayTeamName() == $t1) {
                    $tmp_matches[$i]->setHomeTeamScore($t1_ga);
                    $tmp_matches[$i]->setAwayTeamScore($t1_gf);
                }
                if ($tmp_matches[$i]->getHomeTeamName() == $t3 && $tmp_matches[$i]->getAwayTeamName() == $t4) {
                    $tmp_matches[$i]->setHomeTeamScore($t3_gf);
                    $tmp_matches[$i]->setAwayTeamScore($t3_ga);
                }
                if ($tmp_matches[$i]->getHomeTeamName() == $t4 && $tmp_matches[$i]->getAwayTeamName() == $t3) {
                    $tmp_matches[$i]->setHomeTeamScore($t3_ga);
                    $tmp_matches[$i]->setAwayTeamScore($t3_gf);
                }
            }
            $tmp_m1 = Match::CloneSoccerMatch(0, $t1, 'T1', 0, $t2, 'T2', $t1_gf, $t1_ga);
            $tmp_m3 = Match::CloneSoccerMatch(0, $t3, 'T3', 0, $t4, 'T4', $t3_gf, $t3_ga);
            self::calculatePoint($tmp_group_teams, $tmp_m1, Stage::First);
            self::calculatePoint($tmp_group_teams, $tmp_m3, Stage::First);
            $team_array = array();
            foreach ($tmp_group_teams as $team_name => $team) {
                array_push($team_array, $team);
            }
            $team_array = self::sortGroupStanding($team_array, $tmp_matches);
            $team_array2 = array();
            for ($i = 0; $i < sizeof($team_array); $i++) {
                $team_array[$i]->setGroupOrder($i + 1);
                $team_array2[$team_array[$i]->getName()] = $team_array[$i];
            }
            $t1_g_diff = $team_array2[$t1]->getGoalDiff();
            if ($team_array2[$t1]->getGoalDiff() > 0) $t1_g_diff = '+'.$t1_g_diff;
            $t2_g_diff = $team_array2[$t2]->getGoalDiff();
            if ($team_array2[$t2]->getGoalDiff() > 0) $t2_g_diff = '+'.$t2_g_diff;
            $t3_g_diff = $team_array2[$t3]->getGoalDiff();
            if ($team_array2[$t3]->getGoalDiff() > 0) $t3_g_diff = '+'.$t3_g_diff;
            $t4_g_diff = $team_array2[$t4]->getGoalDiff();
            if ($team_array2[$t4]->getGoalDiff() > 0) $t4_g_diff = '+'.$t4_g_diff;
            $team1_match_result = 'W';
            $team2_match_result = 'L';
            $team3_match_result = 'W';
            $team4_match_result = 'L';
            if ($t1_gf == $t1_ga) {
                $team1_match_result = 'D';
                $team2_match_result = 'D';
            }
            elseif ($t1_gf < $t1_ga) {
                $team1_match_result = 'L';
                $team2_match_result = 'W';
            }
            if ($t3_gf == $t3_ga) {
                $team3_match_result = 'D';
                $team4_match_result = 'D';
            }
            elseif ($t3_gf < $t3_ga) {
                $team3_match_result = 'L';
                $team4_match_result = 'W';
            }
            $tmp_s = Scenario::CreateScenario($team_array2[$t1]->getCode(), $team_array2[$t1]->getGroupOrder(), $team_array2[$t1]->getPoint(), $t1_g_diff, $team_array2[$t1]->getGoalFor(), $t1_gf, $t1_ga,
                '', $team1_match_result, $team_array2[$t2]->getCode(), $team_array2[$t2]->getGroupOrder(), $team_array2[$t2]->getPoint(), $t2_g_diff, $team_array2[$t2]->getGoalFor(), '', $team2_match_result,
                $team_array2[$t3]->getCode(), $team_array2[$t3]->getGroupOrder(), $team_array2[$t3]->getPoint(), $t3_g_diff, $team_array2[$t3]->getGoalFor(), $t3_gf, $t3_ga, '', $team3_match_result,
                $team_array2[$t4]->getCode(), $team_array2[$t4]->getGroupOrder(), $team_array2[$t4]->getPoint(), $t4_g_diff, $team_array2[$t4]->getGoalFor(), '', $team4_match_result, '');
            return $tmp_s;
        }

        public static function getTournamentCount($tournament) {
            $teams = $tournament->getTeams();
            $teams_copy = self::getTeamArrayByName($teams);

            for ($i = 0; $i < sizeof($teams); $i++ ) {
                $parent_team_name = $teams[$i]->getParentName();
                if ($parent_team_name != null) {
                    $tc = $teams_copy[$parent_team_name]->getTournamentCount();
                    $teams_copy[$parent_team_name]->setTournamentCount($tc + $teams[$i]->getTournamentCount());
                }
            }
        }

        public static function getFirstStageMatchesRanking($tournament) {
            Soccer::getGroupMatchesRanking($tournament);
            Soccer::getSecondRoundMatchesRanking($tournament);
            Soccer::getFinalRoundMatchesRanking($tournament);
        }

        public static function getGroupMatchesRanking($tournament) {
            $group_matches = self::getGroupMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $group_matches, Stage::First);
            $tournament->setTeams($teams);
        }

        public static function getSecondRoundMatchesRanking($tournament) {
            $second_round_matches = self::getSecondRoundMatches($tournament->getMatches());
            if (sizeof($second_round_matches) > 0) {
                self::updateSecondRoundTeams($tournament);
                $teams = self::getGroupRanking($tournament->getSecondRoundTeams(), $second_round_matches, Stage::First);
                $tournament->setSecondRoundTeams($teams);
            }
        }

        public static function getFinalRoundMatchesRanking($tournament) {
            $final_round_matches = self::getFinalRoundMatches($tournament->getMatches());
            if (sizeof($final_round_matches) > 0) {
                self::updateFinalRoundTeams($tournament);
                $teams = self::getGroupRanking($tournament->getSecondRoundTeams(), $final_round_matches, Stage::First);
                $tournament->setSecondRoundTeams($teams);
            }
        }

        public static function updateFirstStageMatchesRanking($tournament) {
            Soccer::updateSecondRoundMatchesRanking($tournament);
            Soccer::updateFinalRoundMatchesRanking($tournament);
            Soccer::updatePlayOffMatchesRanking($tournament);
        }

        public static function updateSecondRoundMatchesRanking($tournament) {
            $second_round_matches = self::getSecondRoundMatches($tournament->getMatches());
            if (sizeof($second_round_matches) > 0) {
                $teams = self::getGroupRanking($tournament->getTeams(), $second_round_matches, Stage::First);
                $tournament->setTeams($teams);
            }
        }

        public static function updateFinalRoundMatchesRanking($tournament) {
            $final_round_matches = self::getFinalRoundMatches($tournament->getMatches());
            if (sizeof($final_round_matches) > 0) {
                $teams = self::getGroupRanking($tournament->getTeams(), $final_round_matches, Stage::First);
                $teams = self::getTeamArrayByName($teams);
                $final_round_teams = $tournament->getSecondRoundTeams();
                $teams[$final_round_teams[0]->getName()]->setBestFinish(Finish::Champion);
                $teams[$final_round_teams[1]->getName()]->setBestFinish(Finish::RunnerUp);
                $teams[$final_round_teams[2]->getName()]->setBestFinish(Finish::ThirdPlace);
                $teams[$final_round_teams[3]->getName()]->setBestFinish(Finish::Semifinal);
                $result = array();
                foreach ($teams as $name => $_team) {
                    array_push($result, $_team);
                }
                $tournament->setTeams($result);
            }
        }

        public static function updatePlayOffMatchesRanking($tournament) {
            $play_off_matches = self::getPlayOffMatches($tournament->getMatches());
            if (sizeof($play_off_matches) > 0) {
                $teams = self::getGroupRanking($tournament->getTeams(), $play_off_matches, Stage::First);
                $tournament->setTeams($teams);
            }
        }

        public static function getSecondStageMatchesRanking($tournament) {
            Soccer::getPreliminaryRoundMatchesRanking($tournament);
            Soccer::getFirstRoundMatchesRanking($tournament);
            Soccer::getReplayFirstRoundMatchesRanking($tournament);
            Soccer::getRound16MatchesRanking($tournament);
            Soccer::getQuarterfinalMatchesRanking($tournament);
            Soccer::getReplayQuarterfinalMatchesRanking($tournament);
            Soccer::getSemifinalMatchesRanking($tournament);
            Soccer::getThirdPlaceMatchRanking($tournament);
            Soccer::getFinalMatchRanking($tournament);
            Soccer::sortTournamentStanding($tournament);
        }

        public static function getPreliminaryRoundMatchesRanking($tournament) {
            $preliminary_round_matches = self::getPreliminaryRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $preliminary_round_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getFirstRoundMatchesRanking($tournament) {
            $first_round_matches = self::getFirstRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $first_round_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getReplayFirstRoundMatchesRanking($tournament) {
            $replay_first_round_matches = self::getReplayFirstRoundMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $replay_first_round_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getRound16MatchesRanking($tournament) {
            $round16_matches = self::getRound16Matches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $round16_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getQuarterfinalMatchesRanking($tournament) {
            $quarterfinal_matches = self::getQuarterfinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $quarterfinal_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getReplayQuarterfinalMatchesRanking($tournament) {
            $replay_quarterfinal_matches = self::getReplayQuarterfinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $replay_quarterfinal_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getSemifinalMatchesRanking($tournament) {
            $semifinal_matches = self::getSemifinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $semifinal_matches, Stage::Second);
            $tournament->setTeams($teams);
        }

        public static function getThirdPlaceMatchRanking($tournament) {
            $teams = self::getTeamArrayByName($tournament->getTeams());
            $third_place_match = self::getThirdPlaceMatch($tournament->getMatches());
            if ($third_place_match != null) {
                self::calculatePoint($teams, $third_place_match, Stage::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getFinalMatchRanking($tournament) {
            $teams = self::getTeamArrayByName($tournament->getTeams());
            $champion_match = self::getFinalMatch($tournament->getMatches());
            if ($champion_match != null) {
                self::calculatePoint($teams, $champion_match, Stage::Second);
                $teams_tmp = array();
                foreach ($teams as $name => $_team) {
                    array_push($teams_tmp, $_team);
                }
                $tournament->setTeams($teams_tmp);
            }
        }

        public static function getAllTimeRanking($tournament) {
            $teams = self::getGroupRanking($tournament->getTeams(), $tournament->getMatches(), Stage::AllStages);
            $tournament->setTeams($teams);
        }

        public static function getAllTimeTournamentRanking($tournament) {
            $tt = array();
            $srtt = array();
            $tm = array();
            $result = array();
            $tournament_teams = $tournament->getTournamentTeams();
            $second_round_tournament_teams = $tournament->getSecondRoundTournamentTeams();
            $tournament_matches = $tournament->getMatches();
            for ($i = 0; $i < sizeof($tournament_teams); $i++ ) {
                $tt[$tournament_teams[$i]->getTournamentName()] = array();
            }
            for ($i = 0; $i < sizeof($second_round_tournament_teams); $i++ ) {
                $srtt[$second_round_tournament_teams[$i]->getTournamentName()] = array();
            }
            for ($i = 0; $i < sizeof($tournament_matches); $i++ ) {
                $tm[$tournament_matches[$i]->getTournamentName()] = array();
            }
            for ($i = 0; $i < sizeof($tournament_teams); $i++ ) {
                array_push($tt[$tournament_teams[$i]->getTournamentName()], $tournament_teams[$i]);
            }
            for ($i = 0; $i < sizeof($second_round_tournament_teams); $i++ ) {
                array_push($srtt[$second_round_tournament_teams[$i]->getTournamentName()], $second_round_tournament_teams[$i]);
            }
            for ($i = 0; $i < sizeof($tournament_matches); $i++ ) {
                array_push($tm[$tournament_matches[$i]->getTournamentName()], $tournament_matches[$i]);
            }
            foreach ($tt as $tournament_name => $_teams) {
                $t = Tournament::CreateSoccerTournamentByTeams($tt[$tournament_name], $srtt[$tournament_name], $tm[$tournament_name]);
                self::getFirstStageMatchesRanking($t);
                Soccer::updateFirstStageMatchesRanking($t);
                Soccer::getSecondStageMatchesRanking($t);
                $tt[$tournament_name] = $t->getTeams();
            }
            foreach ($tt as $tournament_name => $_teams) {
                for ($i = 0; $i < sizeof($_teams); $i++ ) {
                    array_push($result, $_teams[$i]);
                }
            }
            $tournament->setTournamentTeams($result);
        }

        public static function getGroupRanking($teams, $matches, $stage) {
            $teams_tmp = self::getTeamArrayByName($teams);
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                self::calculatePoint($teams_tmp, $matches[$i], $stage);
            }
            foreach ($teams_tmp as $name => $_team) {
                array_push($result, $_team);
            }
            return self::sortGroupStanding($result, $matches);
        }

        public static function calculatePoint(&$teams, $match, $stage) {
            if ($match->getSecondRoundGroupName() == self::WITHDREW) return;
//            if (!$all_time_ranking && strpos($match->getRound(), 'Replay') !== false) { echo 'yes';return;}
            $all_time_ranking = $stage == Stage::AllStages;
            $points_for_win = 3;
            if ($match->getPointsForWin() == 2 && !$all_time_ranking) $points_for_win = 2;
            $no_extra_time = $stage == Stage::First && $match->getRound() != self::PLAY_OFF;
            $home_name = $match->getHomeTeamName();
            $away_name = $match->getAwayTeamName();
            if ($all_time_ranking && $match->getHomeParentTeamName() != null) {
                $home_name = $match->getHomeParentTeamName();
            }
            if ($all_time_ranking && $match->getAwayParentTeamName() != null) {
                $away_name = $match->getAwayParentTeamName();
            }
            $home_team = $teams[$home_name];
            $away_team = $teams[$away_name];
            $home_score = $match->getHomeTeamScore();
            $away_score = $match->getAwayTeamScore();
            $home_extra_time_score = $match->getHomeTeamExtraTimeScore();
            $away_extra_time_score = $match->getAwayTeamExtraTimeScore();
            $home_penalty_score = $match->getHomeTeamPenaltyScore();
            $away_penalty_score = $match->getAwayTeamPenaltyScore();
            $home_team->setMatchPlay($home_team->getMatchPlay() + 1);
            $away_team->setMatchPlay($away_team->getMatchPlay() + 1);
            $home_team->setBestFinish(self::getFinish($match));
            $away_team->setBestFinish(self::getFinish($match));
            if ($home_score > $away_score) {
                $home_team->setWin($home_team->getWin() + 1);
                $home_team->setPoint($home_team->getPoint() + $points_for_win);
                $away_team->setLoss($away_team->getLoss() + 1);
                self::resetBestFinish($match, $away_team);
            }
            elseif ($home_score < $away_score) {
                $home_team->setLoss($home_team->getLoss() + 1);
                $away_team->setWin($away_team->getWin() + 1);
                $away_team->setPoint($away_team->getPoint() + $points_for_win);
                self::resetBestFinish($match, $home_team);
            }
            else {
                if ($no_extra_time) {
                    $home_team->setDraw($home_team->getDraw() + 1);
                    $home_team->setPoint($home_team->getPoint() + 1);
                    $away_team->setDraw($away_team->getDraw() + 1);
                    $away_team->setPoint($away_team->getPoint() + 1);
                }
                else {
                    if ($home_extra_time_score > $away_extra_time_score) {
                        $home_team->setWin($home_team->getWin() + 1);
                        $home_team->setPoint($home_team->getPoint() + $points_for_win);
                        $away_team->setLoss($away_team->getLoss() + 1);
                        self::resetBestFinish($match, $away_team);
                    }
                    elseif ($home_extra_time_score < $away_extra_time_score) {
                        $home_team->setLoss($home_team->getLoss() + 1);
                        $away_team->setWin($away_team->getWin() + 1);
                        $away_team->setPoint($away_team->getPoint() + $points_for_win);
                        self::resetBestFinish($match, $home_team);
                    }
                    else {
                        $home_team->setDraw($home_team->getDraw() + 1);
                        $home_team->setPoint($home_team->getPoint() + 1);
                        $away_team->setDraw($away_team->getDraw() + 1);
                        $away_team->setPoint($away_team->getPoint() + 1);
                        if ($home_penalty_score > $away_penalty_score) {
                            self::resetBestFinish($match, $away_team);
                        }
                        else {
                            self::resetBestFinish($match, $home_team);
                        }
                    }
                }
            }
            $home_team->setGoalFor($home_team->getGoalFor() + $home_score);
            $home_team->setGoalAgainst($home_team->getGoalAgainst() + $away_score);
            $home_team->setGoalDiff($home_team->getGoalDiff() + $home_score - $away_score);
            $away_team->setGoalFor($away_team->getGoalFor() + $away_score);
            $away_team->setGoalAgainst($away_team->getGoalAgainst() + $home_score);
            $away_team->setGoalDiff($away_team->getGoalDiff() + $away_score - $home_score);
            if (!$no_extra_time && $home_score == $away_score) {
                $home_team->setGoalFor($home_team->getGoalFor() + $home_extra_time_score);
                $home_team->setGoalAgainst($home_team->getGoalAgainst() + $away_extra_time_score);
                $home_team->setGoalDiff($home_team->getGoalDiff() + $home_extra_time_score - $away_extra_time_score);
                $away_team->setGoalFor($away_team->getGoalFor() + $away_extra_time_score);
                $away_team->setGoalAgainst($away_team->getGoalAgainst() + $home_extra_time_score);
                $away_team->setGoalDiff($away_team->getGoalDiff() + $away_extra_time_score - $home_extra_time_score);
            }
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
            if (self::isEqualStanding($team1, $team2)) {
                $still_tie = self::applyTiebreaker($team1, $team2, $matches);
                if ($still_tie) self::fairPlayRule($team1, $team2);
            }
            elseif (self::isHigherStanding($team2, $team1)) {
                self::swapTeam($team1, $team2);
            }
        }

        public static function sortTournamentStanding($tournament) {
            $teams = $tournament->getTeams();
            $result = array();
            $teams_tmp = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $teams_tmp[$teams[$i]->getBestFinish()][$teams[$i]->getName()] = $teams[$i];
            }
            foreach ($teams_tmp[Finish::Champion] as $name => $_team) {
                array_push($result, $_team);
            }
            foreach ($teams_tmp[Finish::RunnerUp] as $name => $_team) {
                array_push($result, $_team);
            }
            if (array_key_exists(Finish::ThirdPlace, $teams_tmp)) {
                foreach ($teams_tmp[Finish::ThirdPlace] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            foreach ($teams_tmp[Finish::Semifinal] as $name => $_team) {
                if ($name == 'USA') {
                   $_team->setBestFinish(Finish::ThirdPlace);
                }
                array_push($result, $_team);
            }
            if (array_key_exists(Finish::ReplayQuarterfinal, $teams_tmp)) {
                foreach ($teams_tmp[Finish::ReplayQuarterfinal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Quarterfinal, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Quarterfinal] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Round16, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Round16] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::ReplayFirstRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::ReplayFirstRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::FirstRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::FirstRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::PreliminaryRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::PreliminaryRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::FinalRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::FinalRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::SecondRound, $teams_tmp)) {
                foreach ($teams_tmp[Finish::SecondRound] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Playoff, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Playoff] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            if (array_key_exists(Finish::Group, $teams_tmp)) {
                foreach ($teams_tmp[Finish::Group] as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            $tournament->setTeams($result);
        }

        public static function updateSecondRoundTeams($tournament) {
            $teams = self::getTeamArrayByName($tournament->getSecondRoundTeams());
            $matches = self::getSecondRoundMatches($tournament->getMatches());
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                $teams[$matches[$i]->getHomeTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
                $teams[$matches[$i]->getAwayTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
            }
        }

        public static function updateFinalRoundTeams($tournament) {
            $teams = self::getTeamArrayByName($tournament->getSecondRoundTeams());
            $matches = self::getFinalRoundMatches($tournament->getMatches());
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                $teams[$matches[$i]->getHomeTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
                $teams[$matches[$i]->getAwayTeamName()]->setGroupName($matches[$i]->getSecondRoundGroupName());
            }
        }

        public static function resetBestFinish($match, $team) {
            if ($match->getRound() == self::THIRD_PLACE) {
                $team->setBestFinish(Finish::Semifinal);
            }
            if ($match->getRound() == self::FINAL_) {
                $team->setBestFinish(Finish::RunnerUp);
            }
        }

        public static function getFinish($match) {
            switch($match->getRound())
            {
                case self::GROUP_MATCHES:
                    $best_finish = Finish::Group;
                    break;
                case self::PLAY_OFF:
                    $best_finish = Finish::Playoff;
                    break;
                case self::SECOND_ROUND:
                    $best_finish = Finish::SecondRound;
                    break;
                case self::FINAL_ROUND:
                    $best_finish = Finish::FinalRound;
                    break;
                case self::PRELIMINARY_ROUND:
                    $best_finish = Finish::PreliminaryRound;
                    break;
                case self::FIRST_ROUND:
                    $best_finish = Finish::FirstRound;
                    break;
                case self::REPLAY_FIRST_ROUND:
                    $best_finish = Finish::ReplayFirstRound;
                    break;
                case self::ROUND16:
                    $best_finish = Finish::Round16;
                    break;
                case self::QUARTERFINALS:
                    $best_finish = Finish::Quarterfinal;
                    break;
                case self::REPLAY_QUARTERFINALS:
                    $best_finish = Finish::ReplayQuarterfinal;
                    break;
                case self::SEMIFINALS:
                    $best_finish = Finish::Semifinal;
                    break;
                case self::THIRD_PLACE:
                    $best_finish = Finish::ThirdPlace;
                    break;
                default:
                    $best_finish = Finish::Champion;
                    break;
            }
            return $best_finish;
        }

        public static function getFinishLiteral($finish) {
            switch($finish)
            {
                case Finish::Group:
                    $best_finish = 'First Round';
                    break;
                case Finish::Playoff:
                    $best_finish = 'First Round';
                    break;
                case Finish::SecondRound:
                    $best_finish = 'Second Round';
                    break;
                case Finish::FinalRound:
                    $best_finish = 'Second Round';
                    break;
                case Finish::PreliminaryRound:
                    $best_finish = 'First Round';
                    break;
                case Finish::FirstRound:
                    $best_finish = 'First Round';
                    break;
                case Finish::ReplayFirstRound:
                    $best_finish = 'First Round';
                    break;
                case Finish::Round16:
                    $best_finish = 'Second Round';
                    break;
                case Finish::Quarterfinal:
                    $best_finish = 'Quarterfinals';
                    break;
                case Finish::ReplayQuarterfinal:
                    $best_finish = 'Quarterfinals';
                    break;
                case Finish::Semifinal:
                    $best_finish = 'Fourth Place';
                    break;
                case Finish::ThirdPlace:
                    $best_finish = 'Third Place';
                    break;
                case Finish::RunnerUp:
                    $best_finish = 'Runner-Up';
                    break;
                default:
                    $best_finish = 'Champion';
                    break;
            }
            return $best_finish;
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

        public static function getGroupMatches($matches) {
            return self::getRoundMatches($matches, self::GROUP_MATCHES);
        }

        public static function getSecondRoundMatches($matches) {
            return self::getRoundMatches($matches, self::SECOND_ROUND);
        }

        public static function getFinalRoundMatches($matches) {
            return self::getRoundMatches($matches, self::FINAL_ROUND);
        }

        public static function getPlayOffMatches($matches) {
            return self::getRoundMatches($matches, self::PLAY_OFF);
        }

        public static function getPreliminaryRoundMatches($matches) {
            return self::getRoundMatches($matches, self::PRELIMINARY_ROUND);
        }

        public static function getFirstRoundMatches($matches) {
            return self::getRoundMatches($matches, self::FIRST_ROUND);
        }

        public static function getReplayFirstRoundMatches($matches) {
            return self::getRoundMatches($matches, self::REPLAY_FIRST_ROUND);
        }

        public static function getRound16Matches($matches) {
            return self::getRoundMatches($matches, self::ROUND16);
        }

        public static function getQuarterfinalMatches($matches) {
            return self::getRoundMatches($matches, self::QUARTERFINALS);
        }

        public static function getReplayQuarterfinalMatches($matches) {
            return self::getRoundMatches($matches, self::REPLAY_QUARTERFINALS);
        }

        public static function getSemifinalMatches($matches) {
            return self::getRoundMatches($matches, self::SEMIFINALS);
        }

        public static function getThirdPlaceMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, self::THIRD_PLACE);
            if (sizeof($matches_tmp) == 0) return null;
            return $matches_tmp[0];
        }

        public static function getFinalMatch($matches) {
            $matches_tmp = self::getRoundMatches($matches, self::FINAL_);
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
                if ($matches[$i]->getStage() == self::SECOND_STAGE) {
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

        public static function getBracketSpot($matches) {
            $spot = '';
            for ($i = 0; $i < sizeof($matches); $i++) {
                if ($matches[$i]->getStage() == self::SECOND_STAGE) {
                    if ($matches[$i]->getRound() != self::THIRD_PLACE && $matches[$i]->getRound() != self::FINAL_) {
                        $spot = $matches[$i]->getRound();
                    }
                    break;
                }
            }
            return $spot;
        }

        public static function getFantasy($fantasy) {
            switch($fantasy)
            {
                case 2:
                    $f = Fantasy::Half;
                    break;
                case 3:
                    $f = Fantasy::All;
                    break;
                default:
                    $f = Fantasy::None;
                    break;
            }
            return $f;
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

        public static function getMatchArrayByDate($matches) {
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

        public static function getTeamArrayByBestFinish($teams) {
            $teams_tmp = array();
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                if ($teams[$i]->getBestFinish() == Finish::Playoff) {
                    $teams[$i]->setBestFinish(Finish::Group);
                    $teams_tmp[Finish::Group][$teams[$i]->getName()] = $teams[$i];
                }
                elseif ($teams[$i]->getBestFinish() == Finish::ReplayFirstRound) {
                    $teams[$i]->setBestFinish(Finish::FirstRound);
                    $teams_tmp[Finish::FirstRound][$teams[$i]->getName()] = $teams[$i];
                }
                elseif ($teams[$i]->getBestFinish() == Finish::ReplayQuarterfinal) {
                    $teams[$i]->setBestFinish(Finish::Quarterfinal);
                    $teams_tmp[Finish::Quarterfinal][$teams[$i]->getName()] = $teams[$i];
                }
                else {
                    $teams_tmp[$teams[$i]->getBestFinish()][$teams[$i]->getName()] = $teams[$i];
                }
            }
            foreach ($teams_tmp as $best_finish => $_teams) {
                foreach ($_teams as $name => $_team) {
                    array_push($result, $_team);
                }
            }
            return $result;
        }

        public static function getTeamArrayByName($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getName()] = $teams[$i];
            }
            return $result;
        }

        public static function getTeamArrayByGroup($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getGroupName()][$teams[$i]->getName()] = $teams[$i];
            }
            return $result;
        }

        public static function getTeamArrayByParentGroup($teams) {
            $result = array();
            for ($i = 0; $i < sizeof($teams); $i++) {
                $result[$teams[$i]->getParentGroupName()][$teams[$i]->getGroupName()][$teams[$i]->getName()] = $teams[$i];
            }
            return $result;
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

        public static function getShortTournamentName($name) {
            $result = str_replace(' FIFA World Cup ', '', $name);
            $result = substr($result, -(strlen($result) - 4)).' '.substr($result, 0, 4);
            return $result;
        }

        public static function isTeamAdvancedSecondRound($tournament, $team, $stage) {
            $result = false;
            if ($stage == Stage::First) {
                $second_round_matches = self::getSecondRoundMatches($tournament->getMatches());
                for ($i = 0; $i < sizeof($second_round_matches); $i++) {
                    if ($second_round_matches[$i]->getHomeTeamName() == $team->getName() || $second_round_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                $final_round_matches = self::getFinalRoundMatches($tournament->getMatches());
                for ($i = 0; $i < sizeof($final_round_matches); $i++) {
                    if ($final_round_matches[$i]->getHomeTeamName() == $team->getName() || $final_round_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                $round16_matches = self::getRound16Matches($tournament->getMatches());
                for ($i = 0; $i < sizeof($round16_matches); $i++) {
                    if ($round16_matches[$i]->getHomeTeamName() == $team->getName() || $round16_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                if (!$result) {
                    $quarterfinal_matches = self::getQuarterfinalMatches($tournament->getMatches());
                    for ($i = 0; $i < sizeof($quarterfinal_matches); $i++) {
                        if ($quarterfinal_matches[$i]->getHomeTeamName() == $team->getName() || $quarterfinal_matches[$i]->getAwayTeamName() == $team->getName()) {
                            $result = true;
                            break;
                        }
                    }
                    if (!$result) {
                        $semifinal_matches = self::getSemifinalMatches($tournament->getMatches());
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
                $semifinal_matches = self::getSemifinalMatches($tournament->getMatches());
                for ($i = 0; $i < sizeof($semifinal_matches); $i++) {
                    if ($semifinal_matches[$i]->getHomeTeamName() == $team->getName() || $semifinal_matches[$i]->getAwayTeamName() == $team->getName()) {
                        $result = true;
                        break;
                    }
                }
                if (!$result) {
                    $third_place_match = self::getThirdPlaceMatch($tournament->getMatches());
                    $final_match = self::getFinalMatch($tournament->getMatches());
                    if ($third_place_match != null && $final_match != null) {
                        if ($third_place_match->getHomeTeamName() == $team->getName() || $third_place_match->getAwayTeamName() == $team->getName() ||
                            $final_match->getHomeTeamName() == $team->getName() || $final_match->getAwayTeamName() == $team->getName()) {
                            $result = true;
                        }
                    }
                }
            }
            return $result;
        }

        public static function isThirdPlaceRankingTournament($tournament) {
            return $tournament->getTournamentId() >= 10 && $tournament->getTournamentId() <= 12;
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

            return self::sortGroupStanding($result, $tournament->getMatches());
        }

        public static function getArchiveSoccerScheduleHtml($tournament) {
            self::getSoccerScheduleHtml($tournament, false);
        }

        public static function getSoccerScheduleHtml($tournament, $lookAheadPopover) {
            $matches = $tournament->getMatches();
            $bracket_spot = self::getBracketSpot($matches);
            $output2 = '';
            $output = '';
            if ($bracket_spot != '') {
                $output .= self::getThirdPlaceRankingHtml($tournament);
                $output .= self::getCollapseHtml('bracket', 'Bracket', self::getBracketHtml($tournament, $bracket_spot));
            }
            $output2 .= self::getCollapseHtml('summary', 'Summary', self::getTournamentSummaryHtml($tournament));
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
                        if ($_match->getStage() == self::FIRST_STAGE) {
                            $group_name = $_match->getGroupName();
                            if ($_match->getRound() == self::SECOND_ROUND || $_match->getRound() == self::FINAL_ROUND) $group_name = $_match->getSecondRoundGroupName();
                            $group_anchor = 'Group '.$group_name;
                            if ($_match->getRound() == self::FINAL_ROUND) $group_anchor = $_match->getSecondRoundGroupName();
                            if ($_match->getRound() == self::FINAL_ROUND) $group_name = $_match->getSecondRoundGroupName();
                            $group_id = $group_name;
                            if ($group_name == self::FINAL_ROUND) $group_id = 'FinalRound';
                            $group_text = '<a class="link-modal" data-toggle="modal" data-target="#group'.$group_id.'StandingModal">'.$group_anchor.'</a>' ;
                        }
                        $score = 'vs';
                        $penalty_score = '';
                        $aet = ' aet';
                        if (self::isGoldenGoalRule($_match->getGoldenGoalRule()) && $_match->getHomeTeamPenaltyScore() == '') $aet = ' gg';
                        if ($_match->getHomeTeamScore() != -1) {
                            $score = $_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore();
                            if ($rounds != self::GROUP_MATCHES && $rounds != self::SECOND_ROUND && $rounds != self::FINAL_ROUND && $_match->getHomeTeamScore() == $_match->getAwayTeamScore()) {
                                $score = ($_match->getHomeTeamScore()+$_match->getHomeTeamExtraTimeScore()).
                                    '-'.($_match->getAwayTeamScore()+$_match->getAwayTeamExtraTimeScore()).$aet;
                                if ($_match->getHomeTeamExtraTimeScore() == $_match->getAwayTeamExtraTimeScore()) {
                                    if ($_match->getHomeTeamPenaltyScore() != 0 || $_match->getAwayTeamPenaltyScore() != 0) {
                                        $penalty_score = ' '.$_match->getHomeTeamPenaltyScore().'-'.$_match->getAwayTeamPenaltyScore().' pen';
                                    }
                                }
                            }
                        }
                        if ($_match->getSecondRoundGroupName() == self::WITHDREW) $score = 'w/o';
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
                            <div class="col-sm-3 h3-ff3 font-bold text-right" style="padding-top:9px">Total matches played:</div>
                            <div class="col-sm-9 wb-stl-heading1 green">'.$count.'</div>
                        </div>
                        <div class="col-sm-12 padding-tb-sm">
                            <div class="col-sm-3 h3-ff3 font-bold text-right" style="padding-top:9px">Total goals scored:</div>
                            <div class="col-sm-9 wb-stl-heading1 green">'.$total_goals.'</div>
                        </div>
                        <div class="col-sm-12 padding-tb-sm">
                            <div class="col-sm-3 h3-ff3 font-bold text-right" style="padding-top:9px">Average goals per game:</div>
                            <div class="col-sm-9 wb-stl-heading1 green">'.$gpg.'</div>
                        </div>';
            return $output;
        }

        public static function getCollapseHtml($id, $name, $body) {
            $output = '<div id="accordion-'.$id.'">
                            <div class="card col-sm-12 padding-tb-md border-bottom-gray5">
                                <div class="card-header" id="heading-'.$id.'" style="width:100%;padding-left:0;">
                                    <button class="btn btn-link collapsed h2-ff1 no-padding-left" data-toggle="collapse"
                                        data-target="#collapse-'.$id.'" aria-expanded="false" aria-controls="collapse-'.$id.'">
                                            '.$name.' <i id="'.$id.'-down-arrow" class="fa fa-angle-double-down font-custom1"></i>
                                            <i id="'.$id.'-up-arrow" class="fa fa-angle-double-up font-custom1 no-display"></i>
                                    </button>
                                </div>
                                <div id="collapse-'.$id.'" class="collapse" aria-labelledby="heading-'.$id.'" data-parent="#accordion-'.$id.'">
                                    <div class="card-body">
                                        ';
            $output .= $body;
            $output .=         '
                                    </div>
                                </div>
                            </div>
                        </div>';
            $output .= '<script>
                        $(function() {
                            $("#collapse-'.$id.'").on("shown.bs.collapse", function () {
                                $("#'.$id.'-down-arrow").hide();
                                $("#'.$id.'-up-arrow").show();
                            })
                            $("#collapse-'.$id.'").on("hidden.bs.collapse", function () {
                                $("#'.$id.'-down-arrow").show();
                                $("#'.$id.'-up-arrow").hide();
                            })
                        });
                        </script>';
            return $output;
        }

        public static function getThirdPlaceRankingHtml($tournament) {
            $output = '';
            if (!self::isThirdPlaceRankingTournament($tournament)) return $output;
            $output .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                            <a class="link-modal" data-toggle="modal" data-target="#groupThirdPlaceStandingModal">Ranking of third-placed teams</a>
                        </div>';
            return $output;
        }

        public static function getBracketHtml($tournament, $bracket_spot) {
            $bracket_matches = self::getBracketMatches($tournament->getMatches());
            $output = '';
            $box_height = 120;
            $gap_heights = array(array(10, 20), array(80, 160), array(220, 440), array(410, 1000), array(610, 2120), array(610, 2120));
            $i = 0;
            $j = 0;
            foreach ($bracket_matches as $bracket_round => $_bracket_matches) {
                $gap_height = $gap_heights[$i][0];
                $third_place_moving = '';
                if ($bracket_round == self::THIRD_PLACE) {
                    $third_place_moving = 'style="margin-left:-25%"';
                    if ($bracket_spot == self::SEMIFINALS) $third_place_moving = 'style="margin-left:-25%;margin-top:60px;"';
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
                    if ($_bracket_match->getSecondRoundGroupName() == self::WITHDREW) $score = 'w/o';

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

        public static function getSoccerBracketHtml($tournament) {
            $tournament->concatBodyHtml(self::getBracketHtml($tournament, ''));
        }

        public static function getSoccerGroupHtml($tournament) {
            $teams = self::getTeamArrayByGroup($tournament->getTeams());
            $output = self::getCollapseHtml('summary', 'Summary', self::getTournamentSummaryHtml($tournament));
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
                foreach ($_teams as $name => $_team) {
                    $goal_diff = $_team->getGoalDiff();
                    if ($_team->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;
                    $striped = '';
                    if (self::isTeamAdvancedSecondRound($tournament, $_team, Stage::First)) $striped = 'advanced-second-round-striped';
                    $output .= '<div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md '.$striped.'">
                                <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'"></div>
                                <div class="col-sm-3" style="padding-top: 3px;">'.$_team->getName().'</div>
                                <div class="col-sm-1">'.$_team->getMatchPlay().'</div>
                                <div class="col-sm-1">'.$_team->getWin().'</div>
                                <div class="col-sm-1">'.$_team->getDraw().'</div>
                                <div class="col-sm-1">'.$_team->getLoss().'</div>
                                <div class="col-sm-1">'.$_team->getGoalFor().'</div>
                                <div class="col-sm-1">'.$_team->getGoalAgainst().'</div>
                                <div class="col-sm-1">'.$goal_diff.'</div>
                                <div class="col-sm-1">'.$_team->getPoint().'</div>
                            </div>';
                }
                $output .= '</div>';
            }
            $tournament->concatBodyHtml($output);
        }

        public static function getSoccerScheduleModalHtml($tournament) {
            $group_matches = self::getMatchArrayByGroup($tournament->getMatches());
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
            $tournament->setModalHtml($output);
        }

        public static function getSoccerGroupModalHtml($tournament) {
            self::getGroupModalHtml($tournament, $tournament->getTeams(), Stage::First);
            if (self::isThirdPlaceRankingTournament($tournament)) {
                self::getGroupModalHtml($tournament, self::getThirdPlaceTeams($tournament), Stage::First);
            }
            self::getGroupModalHtml($tournament, $tournament->getSecondRoundTeams(), Stage::Second);
        }

        public static function getGroupModalHtml($tournament, $teams, $stage) {
            $teams = self::getTeamArrayByGroup($teams);
            $output = '';
            foreach ($teams as $group_name => $_teams) {
                $group_id = $group_name;
                $table_name = 'Group '.$group_name;
                if ($group_name == self::FINAL_ROUND) {
                    $group_id = 'FinalRound';
                    $table_name = $group_name;
                }
                elseif ($group_name == 'ThirdPlace') {
                    $table_name = 'Ranking of third-placed teams';
                }
                $output .= '<div class="modal fade" id="group'.$group_id.'StandingModal" tabindex="-1" role="dialog" 
                    aria-labelledby="group'.$group_id.'StandingModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="width:800px;">
                        <div class="modal-content">
                            <div class="col-sm-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="modal-X" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-header col-sm-12 padding-lr-lg" style="border-bottom:none;">
                                <div class="col-sm-12 h3-ff3 border-bottom-gray2" id="group'.$group_id.'StandingModalLabel">'.$table_name.'</div>
                            </div>
                            <div class="modal-body col-sm-12 padding-lr-lg" id="group'.$group_id.'StandingModalBody">
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
                foreach ($_teams as $name => $_team) {
                    $goal_diff = $_team->getGoalDiff();
                    if ($_team->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;
                    $striped = '';
                    if (self::isTeamAdvancedSecondRound($tournament, $_team, $stage)) $striped = 'advanced-second-round-striped';
                    $output .=     '<div class="col-sm-12 h3-ff3 row padding-tb-md '.$striped.'">
                                    <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'"></div>
                                    <div class="col-sm-3" style="padding-top: 3px;">'.$_team->getName().'</div>
                                    <div class="col-sm-1">'.$_team->getMatchPlay().'</div>
                                    <div class="col-sm-1">'.$_team->getWin().'</div>
                                    <div class="col-sm-1">'.$_team->getDraw().'</div>
                                    <div class="col-sm-1">'.$_team->getLoss().'</div>
                                    <div class="col-sm-1">'.$_team->getGoalFor().'</div>
                                    <div class="col-sm-1">'.$_team->getGoalAgainst().'</div>
                                    <div class="col-sm-1">'.$goal_diff.'</div>
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
            $tournament->concatModalHtml($output);
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
                    <div id="popover-content-'.$teams[$i]->getCode().'" class="hide">
                        <div>
                            <div class="col-sm-4" style="padding-top:5px"><img class="flag-md" src="/images/flags/'.$teams[$i]->getFlagFilename().'"></div>
                            <div class="col-sm-8"><span class="h2-ff1"><b>'.$teams[$i]->getName().'</b></span></div>
                        </div>
                        <p><span class="wb-stl-heading1 russia-2018">'.$teams[$i]->getTournamentCount().'</span> '.$tournament_text.'</p>';
                $team_name = $teams[$i]->getName();
                if ($teams[$i]->getParentName() != null) {
                    $team_name =  $teams[$i]->getParentName();
                }
                $tmp_finish = Finish::Group;
                $champ_count = 0;
                $output2 = self::getFinishLiteral($tmp_finish);
                $output3 = '';
                foreach ($tt[$team_name] as $tournament_names => $_team) {
                    if ($tmp_finish < $_team->getBestFinish()) {
                        $tmp_finish = $_team->getBestFinish();
                        $output2 = self::getFinishLiteral($_team->getBestFinish());
                    }
                    if ($_team->getBestFinish() == Finish::Champion) $champ_count++;
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

        public static function getAllTimeSoccerRankingHtml($tournament) {
            $tournament->concatBodyHtml(self::getSoccerRankingHtml($tournament->getTeams(), true));
        }

        public static function getTournamentSoccerRankingHtml($tournament) {
            $tournament->concatBodyHtml(self::getSoccerRankingHtml($tournament->getTeams(), false));
        }

        public static function getSoccerRankingHtml($teams, $all_time) {
            if (!$all_time) $teams = self::getTeamArrayByBestFinish($teams);
            $title = 'Tournament Rankings';
            $tc_header = '<div class="col-sm-3"></div>';
            if ($all_time) {
                $title = 'All Time Rankings';
                $tc_header = '<div class="col-sm-2"></div><div class="col-sm-1">T</div>';
            }

            $output = '<div class="col-sm-12 h2-ff2 margin-top-lg">'.$title.'</div>
                        <div class="col-sm-12 box-xl">
                            <div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md font-bold">
                                <div class="col-sm-1"></div>
                                '.$tc_header.'
                                <div class="col-sm-1">MP</div>
                                <div class="col-sm-1">W</div>
                                <div class="col-sm-1">D</div>
                                <div class="col-sm-1">L</div>
                                <div class="col-sm-1">GF</div>
                                <div class="col-sm-1">GA</div>
                                <div class="col-sm-1">+/-</div>
                                <div class="col-sm-1">Pts</div>
                            </div>';

            $current_best_finish = $teams[0]->getBestFinish();
            $striped_row = 'ranking-striped';

            for ($i = 0; $i < sizeof($teams); $i++) {
                $tc_col = '<div class="col-sm-3" style="padding-top: 3px;">'.$teams[$i]->getName().'</div>';
                if ($teams[$i]->getMatchPlay() != 0) {
                    if ($all_time) $tc_col = '<div class="col-sm-2" style="padding-top: 3px;">'.$teams[$i]->getName().'</div>
                                                <div class="col-sm-1"><a id="popover_'.$teams[$i]->getCode().'" data-toggle="popover" 
                                                    data-container="body" data-placement="right" type="button" data-html="true" 
                                                    data-trigger="focus" tabindex="0" style="cursor:pointer;">'.$teams[$i]->getTournamentCount().'</a></div>';

                    $goal_diff = $teams[$i]->getGoalDiff();
                    if ($teams[$i]->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;

                    if ($current_best_finish != $teams[$i]->getBestFinish()) {
                        if ($striped_row == 'ranking-striped') {
                            $striped_row = '';
                        } else {
                            $striped_row = 'ranking-striped';
                        }
                        $current_best_finish = $teams[$i]->getBestFinish();
                    }

                    if ($all_time) $striped_row = '';
                    $output .= '<div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md '.$striped_row.'">
                                <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$teams[$i]->getFlagFilename().'"></div>
                                '.$tc_col.'
                                <div class="col-sm-1">'.$teams[$i]->getMatchPlay().'</div>
                                <div class="col-sm-1">'.$teams[$i]->getWin().'</div>
                                <div class="col-sm-1">'.$teams[$i]->getDraw().'</div>
                                <div class="col-sm-1">'.$teams[$i]->getLoss().'</div>
                                <div class="col-sm-1">'.$teams[$i]->getGoalFor().'</div>
                                <div class="col-sm-1">'.$teams[$i]->getGoalAgainst().'</div>
                                <div class="col-sm-1">'.$goal_diff.'</div>
                                <div class="col-sm-1">'.$teams[$i]->getPoint().'</div>
                            </div>';
                }
            }
            $output .= '</div>';
            return $output;
        }

        public static function getUNLStandingsHtml($tournament) {
            $teams1 = self::getTeamArrayByGroup($tournament->getTeams());
            $teams = self::getTeamArrayByParentGroup($tournament->getTeams());
//            $output = self::getCollapseHtml('summary', 'Summary', self::getTournamentSummaryHtml($tournament));

            $output = '<div class="col-sm-12 margin-top-sm">
                        <ul class="nav nav-tabs nav-justified h2-ff4" id="UNLLeagueTab" role="tablist">';
            foreach ($teams as $parent_group_name => $_teams) {
                $league_name = str_replace(' ', '', $parent_group_name);
                $output .= '<li class="nav-item">
                                <a class="nav-link" id="'.$league_name.'-tab" data-toggle="tab" href="#'.$league_name.'_content" role="tab" aria-controls="'.$league_name.'_content" aria-selected="true">'.$parent_group_name.'</a>
                            </li>';
            }
            $output .= '</ul>
                        <div class="tab-content" id="myTabContent">';
            foreach ($teams as $parent_group_name => $league_teams) {
                $league_name = str_replace(' ', '', $parent_group_name);
                $output .= '<div class="tab-pane fade" id="'.$league_name.'_content" role="tabpanel" aria-labelledby="'.$league_name.'-tab">';

                foreach ($league_teams as $group_name => $_teams) {
                    $output .= '<div class="col-sm-12 margin-top-sm">
                            <span class="col-sm-2 h2-ff2">Group '.$group_name.'</span>
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
                    foreach ($_teams as $name => $_team) {
                        $goal_diff = $_team->getGoalDiff();
                        if ($_team->getGoalDiff() > 0) $goal_diff = '+'.$goal_diff;
                        $striped = '';
                        if (self::isTeamAdvancedSecondRound($tournament, $_team, Stage::First)) $striped = 'advanced-second-round-striped';
                        $output .= '<div class="col-sm-12 h2-ff3 row padding-top-md padding-bottom-md '.$striped.'">
                                <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'"></div>
                                <div class="col-sm-3" style="padding-top: 3px;">'.$_team->getName().'</div>
                                <div class="col-sm-1">'.$_team->getMatchPlay().'</div>
                                <div class="col-sm-1">'.$_team->getWin().'</div>
                                <div class="col-sm-1">'.$_team->getDraw().'</div>
                                <div class="col-sm-1">'.$_team->getLoss().'</div>
                                <div class="col-sm-1">'.$_team->getGoalFor().'</div>
                                <div class="col-sm-1">'.$_team->getGoalAgainst().'</div>
                                <div class="col-sm-1">'.$goal_diff.'</div>
                                <div class="col-sm-1">'.$_team->getPoint().'</div>
                            </div>';
                    }
                    $output .= '</div>';
                    $output .= self::getCollapseHtml($league_name.$group_name.'matches', 'Matches', $parent_group_name.$group_name.' Matches');
                }
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $tournament->concatBodyHtml($output);
        }

        public static function getSoccerMatches($tournament) {

            $sql = self::getSoccerMatchSql($tournament->getTournamentId());
            self::getSoccerMatchDb($tournament, $sql);
        }

        public static function getAllTimeSoccerMatches($tournament) {

            $sql = self::getAllTimeSoccerMatchSql();
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
                        $row['home_team_id'], $row['home_team_name'], $row['home_team_code'], $row['away_team_id'], $row['away_team_name'], $row['away_team_code'],
                        $row['home_parent_team_id'], $row['home_parent_team_name'], $row['away_parent_team_id'], $row['away_parent_team_name'],
                        $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'],
                        $row['match_order'], $row['bracket_order'], $row['round'], $row['stage'], $row['group_name'], $row['second_round_group_name'],
                        $row['tournament_id'], $row['tournament_name'],
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

        public static function getSoccerMatchSql($tournament_id) {
            $tournament_id_str = 'm.tournament_id = '.$tournament_id;
            if ($tournament_id == null) $tournament_id_str = '1 = 1'; // 'm.tournament_id <> 1'
            $sql = 'SELECT t.id AS home_team_id, UCASE(t.name) AS home_team_name, home_team_score, n.flag_filename AS home_flag, n.code AS home_team_code,
                        t2.id AS away_team_id, UCASE(t2.name) AS away_team_name, away_team_score, n2.flag_filename AS away_flag, n2.code AS away_team_code, 
                        pt.id AS home_parent_team_id, UCASE(pt.name) AS home_parent_team_name, pt2.id AS away_parent_team_id, UCASE(pt2.name) AS away_parent_team_name, 
                        home_team_extra_time_score, away_team_extra_time_score, home_team_penalty_score, away_team_penalty_score, 
                        DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
                        TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, match_order, bracket_order,
                        waiting_home_team, waiting_away_team,
                        g.name AS round, g2.name AS stage,
                        g3.name AS group_name, g4.name AS second_round_group_name, m.tournament_id, tou.name AS tournament_name, tou.points_for_win, tou.golden_goal_rule
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
                    AND '.$tournament_id_str.'
                    ORDER BY stage_id, match_order, match_date, match_time;';
            return $sql;
        }

        public static function getAllTimeSoccerMatchSql() {
            return self::getSoccerMatchSql(null);
        }

        public static function getSoccerTeams($tournament) {

            $sql = self::getSoccerTeamSql($tournament->getTournamentId());
            self::getSoccerTeamDb($tournament, $sql);
        }

        public static function getAllTimeSoccerTeams($tournament) {

            $sql = self::getAllTimeSoccerTeamSql();
            self::getAllTimeSoccerTeamDb($tournament, $sql);
        }

        public static function getAllTimeSoccerTeamTournaments($tournament) {

            $sql = self::getAllTimeSoccerTeamTournamentSql();
            self::getAllTimeSoccerTeamTournamentDb($tournament, $sql);
        }

        public static function getSoccerTeamDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $second_round_teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam(
                        $row['team_id'], $row['tournament_id'], $row['name'], $row['l_name'], $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        $row['group_name'], $row['group_order'],
                        $row['parent_group_name'], $row['parent_group_long_name'], $row['parent_group_order'],
                        $row['flag_filename'], 1);
                    array_push($teams, $team);

                    $second_round_team = Team::CreateSoccerTeam(
                        $row['team_id'], $row['tournament_id'], $row['name'], $row['l_name'], $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        '', $row['group_order'],
                        $row['parent_group_name'], $row['parent_group_long_name'], $row['parent_group_order'],
                        $row['flag_filename'], 1);
                    array_push($second_round_teams, $second_round_team);
                }
                $tournament->setTeams($teams);
                $tournament->setSecondRoundTeams($second_round_teams);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getAllTimeSoccerTeamDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $output = '<!-- Team Count = '.$count.' -->';
            $teams = array();

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam(
                        $row['id'], 0, $row['name'], '', $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        '', '',
                        '', '', 0,
                        $row['flag_filename'], $row['tournament_count']);
                    array_push($teams, $team);
                }
                $tournament->setTeams($teams);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getAllTimeSoccerTeamTournamentDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $output = '<!-- TeamTournament Count = '.$count.' -->';
            $teams = array();
            $second_round_teams = array();

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam(
                        $row['id'], $row['tournament_name'], $row['name'], '', $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        '', '',
                        '', '', 0,
                        $row['flag_filename'], 0);
                    array_push($teams, $team);

                    $second_round_team = Team::CreateSoccerTeam(
                        $row['id'], $row['tournament_name'], $row['name'], '', $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        '', '',
                        '', '', 0,
                        $row['flag_filename'], 0);
                    array_push($second_round_teams, $second_round_team);
                }
                $tournament->setTournamentTeams($teams);
                $tournament->setSecondRoundTournamentTeams($second_round_teams);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getSoccerTeamSql($tournament_id) {
            $sql = 'SELECT UCASE(t.name) AS name, t.name AS l_name, team_id, 
                        t.parent_team_id, UCASE(t2.name) AS parent_team_name, t2.name AS l_parent_team_name,
                        group_id, UCASE(g.name) AS group_name, group_order, 
                        parent_group_id, pg.name AS parent_group_name, pg.long_name AS parent_group_long_name, parent_group_order, 
                        n.flag_filename, n.code, tt.tournament_id 
                    FROM team_tournament tt 
                    LEFT JOIN team t ON t.id = tt.team_id  
                    LEFT JOIN team t2 ON t2.id = t.parent_team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id  
                    LEFT JOIN `group` pg ON pg.id = tt.parent_group_id
                    LEFT JOIN nation n ON n.id = t.nation_id 
                    WHERE tt.tournament_id = '.$tournament_id.' 
                    ORDER BY parent_group_name, group_id, group_order';
            return $sql;
        }

        public static function getAllTimeSoccerTeamSql() {
            $sql = 'SELECT DISTINCT UCASE(t.name) AS name, t.id, t.parent_team_id, UCASE(t2.name) AS parent_team_name,
                        n.flag_filename, n.code, tc.tournament_count
                    FROM team t
                    LEFT JOIN team_tournament tt ON tt.team_id = t.id
                    LEFT JOIN tournament tou ON tou.id = tt.tournament_id  
                    LEFT JOIN team t2 ON t2.id = t.parent_team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id
                    LEFT JOIN nation n ON n.id = t.nation_id
                    LEFT JOIN (SELECT team_id, COUNT(team_id) AS tournament_count
                                FROM team_tournament 
                                WHERE (group_id <> 63 OR group_id is null) -- AND tournament_id <> 1
                                GROUP BY team_id) tc ON tc.team_id = t.id
                    WHERE tou.tournament_type_id = 1  -- AND tt.tournament_id <> 1
                    UNION
                    SELECT DISTINCT UCASE(t.name) AS name, t.id, null, null,
                        n.flag_filename, n.code, tc.tournament_count
                    FROM team t  
                    LEFT OUTER JOIN team t2 ON t2.parent_team_id = t.id
                    LEFT JOIN team_tournament tt ON tt.team_id = t2.id
                    LEFT JOIN tournament tou ON tou.id = tt.tournament_id
                    LEFT JOIN `group` g ON g.id = tt.group_id  
                    LEFT JOIN nation n ON n.id = t.nation_id 
                    LEFT JOIN (SELECT team_id, COUNT(team_id) AS tournament_count
                                FROM team_tournament 
                                WHERE (group_id <> 63 OR group_id is null) -- AND tournament_id <> 1
                                GROUP BY team_id) tc ON tc.team_id = t.id
                    WHERE tou.tournament_type_id = 1  -- AND tt.tournament_id <> 1';
            return $sql;
        }

        public static function getAllTimeSoccerTeamTournamentSql() {
            $sql = 'SELECT UCASE(t.name) AS name, t.id, tou.name AS tournament_name, t.parent_team_id, UCASE(t2.name) AS parent_team_name,
                        n.flag_filename, n.code
                    FROM team t
                    LEFT JOIN team_tournament tt ON tt.team_id = t.id
                    LEFT JOIN tournament tou ON tou.id = tt.tournament_id  
                    LEFT JOIN team t2 ON t2.id = t.parent_team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id
                    LEFT JOIN nation n ON n.id = t.nation_id
                    WHERE tou.tournament_type_id = 1'; // AND tt.tournament_id <> 1'
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

    abstract class Fantasy {
        const None = 1;
        const Half = 2;
        const All = 3;
    }

    abstract class Stage {
        const First = 1;
        const Second = 2;
        const AllStages = 3;
    }

    abstract class QualifyStatus {
        const Advanced = 'Advanced';
        const NeedHelp = 'NeedHelp';
        const Eliminated = 'Eliminated';
    }

    abstract class Finish {
        const Group = 1;
        const Playoff = 2;
        const SecondRound = 3;
        const FinalRound = 4;
        const PreliminaryRound = 5;
        const FirstRound = 6;
        const ReplayFirstRound = 7;
        const Round16 = 8;
        const Quarterfinal = 9;
        const ReplayQuarterfinal = 10;
        const Semifinal = 11;
        const ThirdPlace = 12;
        const RunnerUp = 13;
        const Champion = 14;
    }
