<!DOCTYPE html>
<?php
    include_once('class.team.php');
    $teams = array();
    $team_dto = Team::getSoccerTeams(1);
    $count = $team_dto->getCount();
    $output = '<!-- Count = '.$count.' -->';
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        $teams = $team_dto->getTeams();
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
            $output .= '</div>';
        }
    }

    include_once('class.match.php');
    $group_matches = array();
    $match_dto = Match::getSoccerMatches(1);
    $count = $match_dto->getCount();
    $output2 = '<!-- Count2 = '.$count.' -->';
    if ($count == 0) {
        $output2 = '<h2>No result found!</h2>';
    }
    else {
        $group_matches = $match_dto->getGroupMatches();
        foreach ($group_matches as $group_name => $_matches) {
            $output2 .= '<div class="modal fade" id="group'.$group_name.'MatchesModal" tabindex="-1" role="dialog" aria-labelledby="group'.$group_name.'MatchesModalLabel" aria-hidden="true">
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
                $output2 .= '<div class="col-sm-12 h2-ff3 padding-tb-md padding-lr-xs border-bottom-gray5">
                                <div class="col-sm-2 padding-lr-xs"><img class="flag-md" src="/images/flags/'.$_match->getHomeFlag().'"></div>
                                <div class="col-sm-3 padding-lr-xs" style="padding-top:3px;">'.$_match->getHomeTeamName().'</div>
                                <div class="col-sm-2 padding-lr-xs text-center" style="padding-top:3px;">vs</div>
                                <div class="col-sm-3 padding-lr-xs text-right" style="padding-top:3px;">'.$_match->getAwayTeamName().'</div>
                                <div class="col-sm-2 padding-lr-xs text-right"><img class="flag-md" src="/images/flags/'.$_match->getAwayFlag().'"></div>
                            </div>';
            }
            $output2 .= '
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
                    <?php echo $output; ?>
                    <p> </p>
                </div>
                <div class="col-sm-12 margin-tb-lg">
                    <p class="wb-stl-footer black">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
                </div>
			</div>
		</div>
	</div>
    <!-- Modal -->
    <?php echo $output2; ?>
	{{hr_out}}
</body>
</html>
