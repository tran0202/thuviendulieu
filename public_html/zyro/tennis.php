<!DOCTYPE html>
<?php
    include_once('config.php');
    include_once('class.match.php');
    $matches = array();
    $match_dto = Match::getTennisMatches(4);
    $count = $match_dto->getCount();
    $output = '<!-- Count = '.$count.' -->';
    echo $output;
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        $matches = $match_dto->getMatches();
        $views = array();
        $box_height = 120;
        $gap_heights = array(array(20, 20), array(90, 160), array(230, 440), array(510, 1000), array(1070, 2120), array(2235, 4360), array(4475, 8840));
        for ($round_start = 0; $round_start <= 4; $round_start++) {
            $output = '';
            $i = 0;
            $j = 0;
            $k = 0;
            $round_end = $round_start + 2;
            $output .= '<div class="col-sm-12 no-padding-lr no-display" id="view-'.$round_start.'">';
            foreach ($matches as $round => $_matches) {
                $prev_view = $round_start - 1;
                $next_view = $round_start + 1;
                $left_arrow = '';
                if ($round_start != 0 AND $k == $round_start) $left_arrow = '<a class="blue font-custom1 hover-pointer margin-right-sm"><i class="fa fa-angle-double-left link-change-view" data-target="'.$prev_view.'"></i></a>';
                $right_arrow = '';
                if ($round_start != 4 AND $k == $round_end) $right_arrow = '<a class="blue font-custom1 hover-pointer margin-left-sm"><i class="fa fa-angle-double-right link-change-view" data-target="'.$next_view.'"></i></a>';
                if ($k >= $round_start AND $k <= $round_end) {
                    $gap_height = $gap_heights[$i][0];
                    $output .= '<div class="col-sm-4">
                                    <div class="col-sm-12 margin-top-sm">'
                                        .$left_arrow.'<span class="h2-ff2">'.$round.'</span>'.$right_arrow.
                                    '</div>';
                    foreach ($_matches as $match_order => $_match) {
                        if ($j != 0) $gap_height = $gap_heights[$i][1];
                        $home_flag = $_match->getHomeFlag();
                        $home_flag = '<img class="flag-sm" src="/images/flags/'.$home_flag.'">';
                        $away_flag = $_match->getAwayFlag();
                        $away_flag = '<img class="flag-sm" src="/images/flags/'.$away_flag.'">';
                        $home_team_name = $_match->getHomeTeamName();
                        $away_team_name = $_match->getAwayTeamName();
                        $home_win = 0;
                        $away_win = 0;
                        if ($_match->getHomeSet1Score() > $_match->getAwaySet1Score()) $home_win = $home_win + 1;
                        if ($_match->getHomeSet2Score() > $_match->getAwaySet2Score()) $home_win = $home_win + 1;
                        if ($_match->getHomeSet3Score() > $_match->getAwaySet3Score()) $home_win = $home_win + 1;
                        if ($_match->getHomeSet4Score() > $_match->getAwaySet4Score()) $home_win = $home_win + 1;
                        if ($_match->getHomeSet5Score() > $_match->getAwaySet5Score()) $home_win = $home_win + 1;
                        if ($_match->getHomeSet1Score() < $_match->getAwaySet1Score()) $away_win = $away_win + 1;
                        if ($_match->getHomeSet2Score() < $_match->getAwaySet2Score()) $away_win = $away_win + 1;
                        if ($_match->getHomeSet3Score() < $_match->getAwaySet3Score()) $away_win = $away_win + 1;
                        if ($_match->getHomeSet4Score() < $_match->getAwaySet4Score()) $away_win = $away_win + 1;
                        if ($_match->getHomeSet5Score() < $_match->getAwaySet5Score()) $away_win = $away_win + 1;
                        if ($home_win > $away_win) $away_team_name = '<span style="color:#858585">'.$_match->getAwayTeamName().'</span>';
                        if ($home_win < $away_win) $home_team_name = '<span style="color:#858585">'.$_match->getHomeTeamName().'</span>';
                        $home_team_seed = '<span class="h6-ff3 weight-light">('.$_match->getHomeTeamSeed().')</span> ';
                        $away_team_seed = '<span class="h6-ff3 weight-light">('.$_match->getAwayTeamSeed().')</span> ';
                        if ($home_win > $away_win) $away_team_seed = '<span class="h6-ff3 weight-light" style="color:#858585">('.$_match->getAwayTeamSeed().')</span> ';
                        if ($home_win < $away_win) $home_team_seed = '<span class="h6-ff3 weight-light" style="color:#858585">('.$_match->getHomeTeamSeed().')</span> ';
                        $home_set1_score = $_match->getHomeSet1Score();
                        $home_set2_score = $_match->getHomeSet2Score();
                        $home_set3_score = $_match->getHomeSet3Score();
                        $home_set4_score = $_match->getHomeSet4Score();
                        $home_set5_score = $_match->getHomeSet5Score();
                        $away_set1_score = $_match->getAwaySet1Score();
                        $away_set2_score = $_match->getAwaySet2Score();
                        $away_set3_score = $_match->getAwaySet3Score();
                        $away_set4_score = $_match->getAwaySet4Score();
                        $away_set5_score = $_match->getAwaySet5Score();
                        $home_set1_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet1Tiebreak().'</sup></span>';
                        $home_set2_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet2Tiebreak().'</sup></span>';
                        $home_set3_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet3Tiebreak().'</sup></span>';
                        $home_set4_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet4Tiebreak().'</sup></span>';
                        $home_set5_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getHomeSet5Tiebreak().'</sup></span>';
                        $away_set1_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet1Tiebreak().'</sup></span>';
                        $away_set2_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet2Tiebreak().'</sup></span>';
                        $away_set3_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet3Tiebreak().'</sup></span>';
                        $away_set4_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet4Tiebreak().'</sup></span>';
                        $away_set5_tiebreak = ' <span class="h5-ff3 weight-light"><sup>'.$_match->getAwaySet5Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet1Score() > $_match->getAwaySet1Score()) $away_set1_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet1Score().'</span>';
                        if ($_match->getHomeSet1Score() < $_match->getAwaySet1Score()) $home_set1_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet1Score().'</span>';
                        if ($_match->getHomeSet2Score() > $_match->getAwaySet2Score()) $away_set2_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet2Score().'</span>';
                        if ($_match->getHomeSet2Score() < $_match->getAwaySet2Score()) $home_set2_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet2Score().'</span>';
                        if ($_match->getHomeSet3Score() > $_match->getAwaySet3Score()) $away_set3_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet3Score().'</span>';
                        if ($_match->getHomeSet3Score() < $_match->getAwaySet3Score()) $home_set3_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet3Score().'</span>';
                        if ($_match->getHomeSet4Score() > $_match->getAwaySet4Score()) $away_set4_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet4Score().'</span>';
                        if ($_match->getHomeSet4Score() < $_match->getAwaySet4Score()) $home_set4_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet4Score().'</span>';
                        if ($_match->getHomeSet5Score() > $_match->getAwaySet5Score()) $away_set5_score = '<span class="h5-ff3 weight-light">'.$_match->getAwaySet5Score().'</span>';
                        if ($_match->getHomeSet5Score() < $_match->getAwaySet5Score()) $home_set5_score = '<span class="h5-ff3 weight-light">'.$_match->getHomeSet5Score().'</span>';
                        if ($_match->getHomeSet1Tiebreak() > $_match->getAwaySet1Tiebreak()) $home_set1_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet1Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet2Tiebreak() > $_match->getAwaySet2Tiebreak()) $home_set2_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet2Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet3Tiebreak() > $_match->getAwaySet3Tiebreak()) $home_set3_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet3Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet4Tiebreak() > $_match->getAwaySet4Tiebreak()) $home_set4_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet4Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet5Tiebreak() > $_match->getAwaySet5Tiebreak()) $home_set5_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getHomeSet5Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet1Tiebreak() < $_match->getAwaySet1Tiebreak()) $away_set1_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet1Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet2Tiebreak() < $_match->getAwaySet2Tiebreak()) $away_set2_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet2Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet3Tiebreak() < $_match->getAwaySet3Tiebreak()) $away_set3_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet3Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet4Tiebreak() < $_match->getAwaySet4Tiebreak()) $away_set4_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet4Tiebreak().'</sup></span>';
                        if ($_match->getHomeSet5Tiebreak() < $_match->getAwaySet5Tiebreak()) $away_set5_tiebreak = ' <span class="h5-ff3 weight-light" style="font-weight: 400;"><sup>'.$_match->getAwaySet5Tiebreak().'</sup></span>';
                        $output .= '<div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                                    <div class="col-sm-12 box-sm" style="height:'.$box_height.'px;">
                                        <div class="col-sm-12 h5-ff3 weight-regular margin-tb-sm no-padding-lr">
                                            <div class="col-sm-7 no-padding-lr">
                                                <div class="col-sm-2 no-padding-right padding-left-sm">'.$home_flag.'</div>
                                                <div class="col-sm-10 no-padding-right padding-left-xs" style="padding-top:2px;">';
                        if ($_match->getHomeTeamSeed() != '') $output .= $home_team_seed;
                        $output .=                  $home_team_name.
                                                '</div>
                                            </div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $home_set1_score;
                        if ($_match->getHomeSet1Tiebreak() != '') $output .= $home_set1_tiebreak;
                        $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $home_set2_score;
                        if ($_match->getHomeSet2Tiebreak() != '') $output .= $home_set2_tiebreak;
                        $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $home_set3_score;
                        if ($_match->getHomeSet3Tiebreak() != '') $output .= $home_set3_tiebreak;
                        $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $home_set4_score;
                        if ($_match->getHomeSet4Tiebreak() != '') $output .= $home_set4_tiebreak;
                        $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $home_set5_score;
                        if ($_match->getHomeSet5Tiebreak() != '') $output .= $home_set5_tiebreak;
                        $output .=          '</div>
                                        </div>
                                        <div class="col-sm-12 h5-ff3 weight-regular margin-tb-sm no-padding-lr">
                                            <div class="col-sm-7 no-padding-lr">
                                                <div class="col-sm-2 no-padding-right padding-left-sm">'.$away_flag.'</div>
                                                <div class="col-sm-10 no-padding-right padding-left-xs" style="padding-top:2px;">';
                        if ($_match->getAwayTeamSeed() != '') $output .= $away_team_seed;
                        $output .=                  $away_team_name.
                                                '</div>
                                            </div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $away_set1_score;
                        if ($_match->getAwaySet1Tiebreak() != '') $output .= $away_set1_tiebreak;
                        $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $away_set2_score;
                        if ($_match->getAwaySet2Tiebreak() != '') $output .= $away_set2_tiebreak;
                        $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $away_set3_score;
                        if ($_match->getAwaySet3Tiebreak() != '') $output .= $away_set3_tiebreak;
                        $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $away_set4_score;
                        if ($_match->getAwaySet4Tiebreak() != '') $output .= $away_set4_tiebreak;
                        $output .=          '</div>
                                            <div class="col-sm-1 no-padding-lr" style="padding-top:2px;">'.
                                                $away_set5_score;
                        if ($_match->getAwaySet5Tiebreak() != '') $output .= $away_set5_tiebreak;
                        $output .=          '</div>
                                        </div>
                                    </div>';
                        $j = $j + 1;
                    }
                    $output .= '</div>';
                    $i = $i + 1;
                    $j = 0;
                }
                $k++;
            }
            $output .= '</div>';
            array_push($views, $output);
        }
    }
?>
<html lang="en">
<head>
    <title>TVDL - 2017 US Open Men's Singles</title>
    <?php include_once('header_script.inc.php'); ?>
</head>
<body>
    <div class="header" id="page-header">
        <div class="vbox wb_container" id="wb_header">
            <div class="wb_cont_inner">
                <?php include_once('logo.inc.php'); ?>
                <?php include_once('menu4.inc.php'); ?>
            </div>
        </div>
    </div>
	<div class="root content">
		<div class="vbox wb_container" id="wb_main">
			<div class="wb_cont_inner">
                <div>
                    <h1 class="wb-stl-heading1 green">2017 US Open Men's Singles</h1>
                </div>
                <div>
                    <?php
                        for ($view = 0; $view <= 4; $view++) {
                            echo $views[$view];
                        }
                    ?>
                    <script>
                        $(function() {$("#view-0").show();});
                    </script>
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
