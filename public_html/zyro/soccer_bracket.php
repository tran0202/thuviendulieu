<!DOCTYPE html>
<?php
    include_once('class.match.php');
    $second_stage_matches = array();
    $match_dto = Match::getSoccerSecondStageMatches(1, 40);
    $count = $match_dto->getCount();
    $output = '<!-- Count = '.$count.' -->';
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        $second_stage_matches = $match_dto->getSecondStageMatches();
        $box_height = 120;
        $gap_heights = array(array(10, 20), array(80, 160), array(220, 440), array(410, 1000), array(10, 2120));
        $i = 0;
        $j = 0;
        foreach ($second_stage_matches as $round => $_matches) {
            $gap_height = $gap_heights[$i][0];
            $output .= '<div class="col-sm-3">
                            <div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                            <div class="col-sm-12 margin-top">
                                <span class="h2-ff1">'.$round.'</span>
                            </div>';
            foreach ($_matches as $match_order => $_match) {
                $gap_height = 10;
                if ($j != 0) $gap_height = $gap_heights[$i][1];
                $home_team_name = $_match->getHomeTeamName();
                $away_team_name = $_match->getAwayTeamName();
                $waiting_home_team = $_match->getWaitingHomeTeam();
                $waiting_away_team = $_match->getWaitingAwayTeam();
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
    }
?>
<html lang="en">
<head>
    <title>TVDL - Russia 2018 Bracket</title>
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
	{{hr_out}}
</body>
</html>
