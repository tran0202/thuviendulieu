<?php
    namespace v2;

    class Soccer {
        private $id;

        protected function __construct() { }

        public static function CreateSoccer($id) {
            $s = new Soccer();
            $s->id = $id;
            return $s;
        }

        public static function getTournamentCount($teams) {

            $teams_copy = Team::getTeamArrayByName($teams);

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
        }

        public static function getGroupMatchesRanking($tournament) {
            $group_matches = Match::getGroupMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $group_matches, Stage::First,false);
            $tournament->setTeams($teams);
        }

        public static function getSecondStageMatchesRanking($tournament) {
            Soccer::getRound16MatchesRanking($tournament);
            Soccer::getQuarterfinalMatchesRanking($tournament);
            Soccer::getSemifinalMatchesRanking($tournament);
            Soccer::getThirdPlaceMatchRanking($tournament);
            Soccer::getFinalMatchRanking($tournament);
            Soccer::sortTournamentStanding($tournament);
        }

        public static function getRound16MatchesRanking($tournament) {
            $round16_matches = Match::getRound16Matches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $round16_matches, Stage::Second,false);
            $tournament->setTeams($teams);
        }

        public static function getQuarterfinalMatchesRanking($tournament) {
            $quarterfinal_matches = Match::getQuarterfinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $quarterfinal_matches, Stage::Second,false);
            $tournament->setTeams($teams);
        }

        public static function getSemifinalMatchesRanking($tournament) {
            $semifinal_matches = Match::getSemifinalMatches($tournament->getMatches());
            $teams = self::getGroupRanking($tournament->getTeams(), $semifinal_matches, Stage::Second,false);
            $tournament->setTeams($teams);
        }

        public static function getThirdPlaceMatchRanking($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $third_place_match = Match::getThirdPlaceMatch($tournament->getMatches());
            self::calculatePoint($teams, $third_place_match, Stage::Second,false);
            $teams_tmp = array();
            foreach ($teams as $name => $_team) {
                array_push($teams_tmp, $_team);
            }
            $tournament->setTeams($teams_tmp);
        }

        public static function getFinalMatchRanking($tournament) {
            $teams = Team::getTeamArrayByName($tournament->getTeams());
            $champion_match = Match::getFinalMatch($tournament->getMatches());
            self::calculatePoint($teams, $champion_match, Stage::Second,false);
            $teams_tmp = array();
            foreach ($teams as $name => $_team) {
                array_push($teams_tmp, $_team);
            }
            $tournament->setTeams($teams_tmp);
        }

        public static function getAllTimeRanking($tournament) {
            $teams = self::getGroupRanking($tournament->getTeams(), $tournament->getMatches(), Stage::AllStages,true);
            $tournament->setTeams($teams);
        }

        public static function getGroupRanking($teams, $matches, $stage, $all_time_ranking) {
            $teams_tmp = Team::getTeamArrayByName($teams);
            $result = array();
            for ($i = 0; $i < sizeof($matches); $i++ ) {
                self::calculatePoint($teams_tmp, $matches[$i], $stage, $all_time_ranking);
            }
            foreach ($teams_tmp as $name => $_team) {
                array_push($result, $_team);
            }
            return self::sortGroupStanding($result, $matches);
        }

        public static function calculatePoint(&$teams, $match, $stage, $all_time_ranking) {
            if ($match->getSecondRoundGroupName() == 'Withdrew') return;
//            if (!$all_time_ranking && strpos($match->getRound(), 'Replay') !== false) { echo 'yes';return;}
            $points_for_win = 3;
            if ($match->getPointsForWin() == 2 && !$all_time_ranking) $points_for_win = 2;
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
            $home_team->setBestFinish($match->getRound());
            $away_team->setBestFinish($match->getRound());
            if ($home_score > $away_score) {
                $home_team->setWin($home_team->getWin() + 1);
                $home_team->setPoint($home_team->getPoint() + $points_for_win);
                $away_team->setLoss($away_team->getLoss() + 1);
                if ($match->getRound() == 'Third place') {
                    $away_team->setBestFinish('Semifinals');
                }
                if ($match->getRound() == 'Final') {
                    $home_team->setBestFinish('Champion');
                    $away_team->setBestFinish('Runner-up');
                }
            }
            elseif ($home_score < $away_score) {
                $home_team->setLoss($home_team->getLoss() + 1);
                $away_team->setWin($away_team->getWin() + 1);
                $away_team->setPoint($away_team->getPoint() + $points_for_win);
                if ($match->getRound() == 'Third place') {
                    $home_team->setBestFinish('Semifinals');
                }
                if ($match->getRound() == 'Final') {
                    $home_team->setBestFinish('Runner-up');
                    $away_team->setBestFinish('Champion');
                }
            }
            else {
                if ($stage == Stage::First) {
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
                        if ($match->getRound() == 'Third place') {
                            $away_team->setBestFinish('Semifinals');
                        }
                        if ($match->getRound() == 'Final') {
                            $home_team->setBestFinish('Champion');
                            $away_team->setBestFinish('Runner-up');
                        }
                    }
                    elseif ($home_extra_time_score < $away_extra_time_score) {
                        $home_team->setLoss($home_team->getLoss() + 1);
                        $away_team->setWin($away_team->getWin() + 1);
                        $away_team->setPoint($away_team->getPoint() + $points_for_win);
                        if ($match->getRound() == 'Third place') {
                            $home_team->setBestFinish('Semifinals');
                        }
                        if ($match->getRound() == 'Final') {
                            $home_team->setBestFinish('Runner-up');
                            $away_team->setBestFinish('Champion');
                        }
                    }
                    else {
                        $home_team->setDraw($home_team->getDraw() + 1);
                        $home_team->setPoint($home_team->getPoint() + 1);
                        $away_team->setDraw($away_team->getDraw() + 1);
                        $away_team->setPoint($away_team->getPoint() + 1);
                        if ($home_penalty_score > $away_penalty_score) {
                            if ($match->getRound() == 'Third place') {
                                $away_team->setBestFinish('Semifinals');
                            }
                            if ($match->getRound() == 'Final') {
                                $home_team->setBestFinish('Champion');
                                $away_team->setBestFinish('Runner-up');
                            }
                        }
                        else {
                            if ($match->getRound() == 'Third place') {
                                $home_team->setBestFinish('Semifinals');
                            }
                            if ($match->getRound() == 'Final') {
                                $home_team->setBestFinish('Runner-up');
                                $away_team->setBestFinish('Champion');
                            }
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
            if ($stage <> Stage::First && $home_score == $away_score) {
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
                if ($still_tie) self::coinToss($team1, $team2);
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
            foreach ($teams_tmp['Champion'] as $name => $_team) {
                array_push($result, $_team);
            }
            foreach ($teams_tmp['Runner-up'] as $name => $_team) {
                array_push($result, $_team);
            }
            foreach ($teams_tmp['Third place'] as $name => $_team) {
                array_push($result, $_team);
            }
            foreach ($teams_tmp['Semifinals'] as $name => $_team) {
                array_push($result, $_team);
            }
            foreach ($teams_tmp['Quarterfinals'] as $name => $_team) {
                array_push($result, $_team);
            }
            foreach ($teams_tmp['Round of 16'] as $name => $_team) {
                array_push($result, $_team);
            }
            foreach ($teams_tmp['Group Matches'] as $name => $_team) {
                array_push($result, $_team);
            }
            $tournament->setTeams($result);
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
