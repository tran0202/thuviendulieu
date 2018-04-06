<!DOCTYPE html>
<?php
    include_once('config.php');
    include_once('class.match.php');
    $matches = array();
    $bracket_matches = array();
    $match_dto = Match::getSoccerMatches(1);
    $count = $match_dto->getCount();
    $output = '<!-- Count = '.$count.' -->';
    $output2 = '';
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        $matches = $match_dto->getMatches();
        $bracket_matches = $match_dto->getBracketMatches();
        $output .= '
                        <div id="accordion" class="">
                            <div class="card col-sm-12 padding-tb-md border-bottom">
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
        $gap_heights = array(array(10, 20), array(80, 160), array(220, 440), array(410, 1000), array(10, 2120));
        $i = 0;
        $j = 0;
        foreach ($bracket_matches as $bracket_round => $_bracket_matches) {
            $gap_height = $gap_heights[$i][0];
            $output .= '<div class="col-sm-3">
                            <div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                            <div class="col-sm-12 margin-top-sm">
                                <span class="h2-ff1">'.$bracket_round.'</span>
                            </div>';
            foreach ($_bracket_matches as $bracket_match_order => $_bracket_match) {
                $gap_height = 10;
                if ($j != 0) $gap_height = $gap_heights[$i][1];
                $home_team_name = $_bracket_match->getHomeTeamName();
                $away_team_name = $_bracket_match->getAwayTeamName();
                $waiting_home_team = $_bracket_match->getWaitingHomeTeam();
                $waiting_away_team = $_bracket_match->getWaitingAwayTeam();
                $output .= '<div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                            <div class="col-sm-12 box-sm" style="height:'.$box_height.'px;">
                                <div class="col-sm-12 h4-ff3 margin-tb-sm">
                                    <div class="col-sm-7 no-padding-lr">'.
                    $waiting_home_team.
                    '</div>
                                </div>
                                <div class="col-sm-12 h4-ff3 margin-tb-sm">
                                    <div class="col-sm-7 no-padding-lr">'.
                    $waiting_away_team.
                    '</div>
                                </div>
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
        foreach ($matches as $rounds => $_round) {
            if ($rounds == 'Round of 16') $output2 .= $output;
            $output2 .= '<div class="col-sm-12 h2-ff1 margin-top-md">'.$rounds.'</div>';
            foreach ($_round as $match_dates => $_matches) {
                $output2 .= '<div class="col-sm-12 h3-ff3 border-bottom-gray2 margin-top-md">'
                    .$_matches[array_keys($_matches)[0]]->getMatchDateFmt().'</div>';
                foreach ($_matches as $match_order => $_match) {
                    $home_team_tmp = $_match->getHomeTeamName();
                    if ($home_team_tmp == null) $home_team_tmp = '['.$_match->getWaitingHomeTeam().']';
                    $away_team_tmp = $_match->getAwayTeamName();
                    if ($away_team_tmp == null) $away_team_tmp = '['.$_match->getWaitingAwayTeam().']';
                    $group_text = '';
                    $home_flag_tmp = '<div class="col-sm-1 padding-lr-xs text-right" style="padding-top:6px;">
                                            <img class="flag-md" src="/images/flags/'.$_match->getHomeFlag().'">
                                        </div>';
                    if ($_match->getHomeFlag() == '') $home_flag_tmp = '<div class="col-sm-1 padding-lr-xs text-right" style="padding-top:6px;"></div>';
                    $away_flag_tmp = '<div class="col-sm-1 padding-lr-xs text-right" style="padding-top:6px;">
                                            <img class="flag-md" src="/images/flags/'.$_match->getAwayFlag().'">
                                        </div>';
                    if ($_match->getAwayFlag() == '') $away_flag_tmp = '<div class="col-sm-1 padding-lr-xs text-right" style="padding-top:6px;"></div>';
                    if ($_match->getGroupName() != null) $group_text = '<a class="link-modal" data-toggle="modal" data-target="#group'.$_match->getGroupName().'StandingModal">
                                                                        Group '.$_match->getGroupName().'</a>' ;
                    $output2 .= '<div class="col-sm-12 padding-tb-md border-bottom-gray5">
                                    <div class="col-sm-2 padding-lr-xs">'.$_match->getMatchTimeFmt().' CST<br>'.$group_text.'</div>'.
                        $home_flag_tmp.
                        '<div class="col-sm-3 h2-ff3 padding-left-lg padding-right-xs">'.$home_team_tmp.'</div>
                                    <div class="col-sm-1 h2-ff3 padding-lr-xs">'.$_match->getHomeTeamScore().'-'.$_match->getAwayTeamScore().'</div>
                                    <div class="col-sm-3 h2-ff3 padding-lr-xs text-right">'.$away_team_tmp.'</div>'.
                        $away_flag_tmp.
                        '</div>';
                }
            }
        }
    }

    include_once('class.team.php');
    $teams = array();
    $team_dto = Team::getSoccerTeams(1);
    $count = $team_dto->getCount();
    $output3 = '<!-- Count2 = '.$count.' -->';
    if ($count == 0) {
        $output3 = '<h2>No result found!</h2>';
    }
    else {
        $teams = $team_dto->getTeams();
        foreach ($teams as $group_name => $_teams) {
            $output3 .= '<div class="modal fade" id="group'.$group_name.'StandingModal" tabindex="-1" role="dialog" aria-labelledby="group'.$group_name.'StandingModalLabel" aria-hidden="true">
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
                $output3 .=     '<div class="col-sm-12 h3-ff3 row padding-tb-md">
                                    <div class="col-sm-1"><img class="flag-md" src="/images/flags/'.$_team->getFlagFilename().'"></div>
                                    <div class="col-sm-3" style="padding-top: 3px;">'.$_team->getName().'</div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-1"></div>
                                </div>';
            }
            $output3 .= '
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
?>
<html lang="en">
<head>
    <title>TVDL - Russia 2018</title>
    <?php include_once('header_script.inc.php'); ?>
</head>

<body>
    <div class="header" id="page-header">
        <div class="vbox wb_container" id="wb_header">
            <div class="wb_cont_inner">
                <?php include_once('logo.inc.php'); ?>
                <?php include_once('menu2.inc.php'); ?>
            </div>
        </div>
    </div>
	<div class="root content">
		<div class="vbox wb_container" id="wb_main">
			<div class="wb_cont_inner">
                <div>
                    <span class="wb-stl-heading1 russia-2018">FIFA World Cup Russia 2018</span>
                    <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018/" target="_self">Groups</a></span>
                    <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018Schedule/" target="_self">Schedule</a></span>
                    <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018Bracket/" target="_self">Bracket</a></span>
                </div>
                <div>
                    <?php echo $output2; ?>
                    <p class="wb-stl-normal"> </p>
                    <p class="wb-stl-normal"> </p>
                </div>
                <div class="col-sm-12 margin-tb-lg">
                    <p class="wb-stl-footer black">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
                </div>
			</div>
		</div>
	</div>
    <!-- Modal -->
    <?php echo $output3; ?>
	{{hr_out}}
</body>
</html>
