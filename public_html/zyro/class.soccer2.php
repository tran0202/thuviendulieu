<?php
    namespace v2;
    include_once('class.match2.php');
    include_once('class.team2.php');

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

        public static function getArchiveSoccerScheduleHtml($tournament) {
            self::getSoccerScheduleHtml($tournament, false);
        }

        public static function getSoccerScheduleHtml($tournament, $lookAheadPopover) {
            $matches = $tournament->getMatches();
            $bracket_spot = self::getBracketSpot($matches);
            $bracket_matches = self::getBracketMatches($matches);
            $output2 = '';
            $output = '';
            if ($bracket_spot != '') {
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
            }
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
                                    if ($_match->getHomeTeamPenaltyScore() != null) {
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

        public static function getSoccerBracketHtml($bracket_matches, $bracket_spot) {
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
                if ($matches[$i]->getStage() == self::SECOND_STAGE) {
                    if ($matches[$i]->getRound() != self::THIRD_PLACE && $matches[$i]->getRound() != self::FINAL_) {
                        $spot = $matches[$i]->getRound();
                    }
                    break;
                }
            }
            return $spot;
        }

        public static function getSoccerModalHtml($tournament) {
            self::getGroupModalHtml($tournament, $tournament->getTeams());
            self::getGroupModalHtml($tournament, $tournament->getSecondRoundTeams());
        }

        public static function getGroupModalHtml($tournament, $teams) {
            $teams = self::getTeamArrayByGroup($teams);
            $output = '';
            foreach ($teams as $group_name => $_teams) {
                $group_id = $group_name;
                if ($group_name == self::FINAL_ROUND) $group_id = 'FinalRound';
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
                                <div class="col-sm-12 h3-ff3 border-bottom-gray2" id="group'.$group_id.'StandingModalLabel">Group '.$group_name.'</div>
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
                    $output .=     '<div class="col-sm-12 h3-ff3 row padding-tb-md">
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
                                                <div class="col-sm-1">'.$teams[$i]->getTournamentCount().'</div>';

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

        public static function getSoccerMatchSql($tournament_id) {
            $tournament_id_str = $tournament_id;
            if ($tournament_id == null) $tournament_id_str = 'm.tournament_id';
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
                    WHERE m.tournament_id = '.$tournament_id_str.'
                    AND tou.tournament_type_id = 1
                    AND m.tournament_id <> 1
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
                        $row['team_id'], $row['name'], $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        $row['group_name'], $row['group_order'], $row['flag_filename'], 1);
                    array_push($teams, $team);

                    $second_round_team = Team::CreateSoccerTeam(
                        $row['team_id'], $row['name'], $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        '', $row['group_order'], $row['flag_filename'], 1);
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
                        $row['id'], $row['name'], $row['code'], $row['parent_team_id'], $row['parent_team_name'],
                        '', '', $row['flag_filename'], $row['tournament_count']);
                    array_push($teams, $team);
                }
                $tournament->setTeams($teams);
                $tournament->concatBodyHtml($output);
            }
        }

        public static function getSoccerTeamSql($tournament_id) {
            $sql = 'SELECT UCASE(t.name) AS name, team_id, t.parent_team_id, UCASE(t2.name) AS parent_team_name,
                        group_id, UCASE(g.name) AS group_name, group_order, 
                        n.flag_filename, n.code, tt.tournament_id 
                    FROM team_tournament tt 
                    LEFT JOIN team t ON t.id = tt.team_id  
                    LEFT JOIN team t2 ON t2.id = t.parent_team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id  
                    LEFT JOIN nation n ON n.id = t.nation_id 
                    WHERE tt.tournament_id = '.$tournament_id.' 
                    ORDER BY group_id, group_order';
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
                                WHERE tournament_id <> 1
                                AND (group_id <> 63 OR group_id is null)
                                GROUP BY team_id) tc ON tc.team_id = t.id
                    WHERE tou.tournament_type_id = 1
                    AND tt.tournament_id <> 1
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
                                WHERE tournament_id <> 1
                                AND (group_id <> 63 OR group_id is null)
                                GROUP BY team_id) tc ON tc.team_id = t.id
                    WHERE tou.tournament_type_id = 1
                    AND tt.tournament_id <> 1';
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

    class FantasyType {

        public $fantasy_type = array(
            'AllMatches'=>1,
            'First2Matches'=>2,
            'Final'=>3
        );

        public function __construct() { }

        public function getFantasyType($type) {
            if ($type == null) return null;
            if ($type == '') return null;
            return $this->fantasy_type[$type];
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
