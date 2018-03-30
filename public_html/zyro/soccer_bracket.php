<!DOCTYPE html>
<?php
    include_once('config.php');
    include_once('tpl.match.php');
    $sql = 'SELECT t.name AS home_team_name, home_team_score,
                t2.name AS away_team_name, away_team_score,
                DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
                TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, match_order,
                waiting_home_team, waiting_away_team,
                g.name AS round, g2.name AS stage,
                g3.name AS group_name, m.tournament_id
            FROM `match` m
                LEFT JOIN team t ON t.id = m.home_team_id
                LEFT JOIN team t2 ON t2.id = m.away_team_id
                LEFT JOIN `group` g ON g.id = m.round_id
                LEFT JOIN `group` g2 ON g2.id = m.stage_id
                LEFT JOIN team_tournament tt ON tt.team_id = m.home_team_id
                LEFT JOIN `group` g3 ON g3.id = tt.group_id
            WHERE m.tournament_id = 1 AND m.stage_id = 40
            ORDER BY match_order;';
    $query = $connection -> prepare($sql);
    $query -> execute();
    $count = $query -> rowCount();
    $matches = array();
    $output = '<!-- Total Count = '.$count.' -->';
    echo $output;
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
            $match = new Match($row['home_team_name'], $row['away_team_name'],
                $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'], $row['match_order'], $row['round'],
                $row['stage'], $row['group_name'], $row['waiting_home_team'], $row['waiting_away_team']);
            $matches[$row['round']][$row['match_order']] = $match;
        }
        $views = array();
        $box_height = 120;
        $gap_heights = array(array(20, 20), array(90, 160), array(230, 440), array(510, 1000), array(10, 2120));
        for ($round_start = 0; $round_start <= 0; $round_start++) {
            $output = '';
            $i = 0;
            $j = 0;
            $k = 0;
            $round_end = $round_start + 2;
            $output .= '<div class="col-sm-12 no-padding-lr" id="view-'.$round_start.'" style="display:none;">';
            foreach ($matches as $round => $_matches) {
//                $prev_view = $round_start - 1;
//                $next_view = $round_start + 1;
//                $left_arrow = '';
//                if ($round_start != 0 AND $k == $round_start) $left_arrow = '<a class="blue-double-arrow margin-right"><i class="fa fa-angle-double-left link-change-view" data-target="'.$prev_view.'"></i></a>';
//                $right_arrow = '';
//                if ($round_start != 2 AND $k == $round_end) $right_arrow = '<a class="blue-double-arrow margin-left"><i class="fa fa-angle-double-right link-change-view" data-target="'.$next_view.'"></i></a>';
//                if ($k >= $round_start AND $k <= $round_end) {
                    $gap_height = $gap_heights[$i][0];
                    $output .= '<div class="col-sm-3">';
                    $output .= '<div class="col-sm-12 margin-top">';
//                    $output .= $left_arrow.'<span class="groupTitle">'.$round.'</span>'.$right_arrow;
                    $output .= '<span class="groupTitle">'.$round.'</span>';
                    $output .= '</div>';
                    foreach ($_matches as $match_order => $_match) {
                        if ($j != 0) $gap_height = $gap_heights[$i][1];
                        $home_team_name = $_match -> home_team_name;
                        $away_team_name = $_match -> away_team_name;
                        $waiting_home_team = $_match -> waiting_home_team;
                        $waiting_away_team = $_match -> waiting_away_team;
//                        $home_team_seed = '<span class="group-row-sm-thin">('.$_match -> home_team_seed.')</span> ';
//                        $away_team_seed = '<span class="group-row-sm-thin">('.$_match -> away_team_seed.')</span> ';
//                        if ($home_win > $away_win) $away_team_seed = '<span class="group-row-sm-thin" style="color:#858585">('.$_match -> away_team_seed.')</span> ';
//                        if ($home_win < $away_win) $home_team_seed = '<span class="group-row-sm-thin" style="color:#858585">('.$_match -> home_team_seed.')</span> ';
                        $output .= '<div class="col-sm-12" style="height:'.$gap_height.'px;"></div>';
                        $output .= '<div class="col-sm-12 group-box-sm" style="height:'.$box_height.'px;">';
                        $output .= '<div class="col-sm-12 group-row-md margin-top margin-bottom">';
                        $output .= '<div class="col-sm-7" style="padding-left: 0;padding-right: 0">';
//                        if ($_match -> home_team_seed != '') $output .= $home_team_seed;
//                        $output .= $home_team_name;
                        $output .= $waiting_home_team;
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="col-sm-12 group-row-md margin-top margin-bottom">';
                        $output .= '<div class="col-sm-7" style="padding-left: 0;padding-right: 0">';
//                        if ($_match -> away_team_seed != '') $output .= $away_team_seed;
//                        $output .= $away_team_name;
                        $output .= $waiting_away_team;
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $j = $j + 1;
                    }
                    $output .= '</div>';
                    $i = $i + 1;
                    $j = 0;
//                }
//                $k++;
            }
            $output .= '</div>';
            array_push($views, $output);
        }
    }
?>
<html lang="en">
<head>
    <title>TVDL - Russia 2018 Bracket</title>
    <?php include_once('header_script.inc.php'); ?>
	<link href="css/2.css?ts=1520882525" rel="stylesheet" type="text/css" />
    <link href="css/footer.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="header" id="myHeader">
        <div class="vbox wb_container" id="wb_header">
            <div class="wb_cont_inner">
                <?php include_once('logo.inc.php'); ?>
                <?php include_once('menu2.inc.php'); ?>
            </div>
            <div class="wb_cont_outer"></div>
            <div class="wb_cont_bg"></div>
        </div>
    </div>
	<div class="root content">
		<div class="vbox wb_container" id="wb_main">
			<div class="wb_cont_inner">
				<div id="wb_element_instance37" class="wb_element" style=" line-height: normal;height: unset;">
                    <div>
                        <span class="wb-stl-heading1" style="color:#930c10;"><span class="wb_tr_ok">FIFA World Cup Russia 2018</span></span>
                        <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018/" target="_self">Groups</a></span>
                        <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018Schedule/" target="_self">Schedule</a></span>
                        <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018Bracket/" target="_self">Bracket</a></span>
                    </div>
                    <div>
                        <?php
                            for ($view = 0; $view <= 0; $view++) {
                                echo $views[$view];
                            }
                        ?>
                        <script>
                            $(function() {$("#view-0").show();});
                        </script>
                        <p> </p>
                        <p class="wb-stl-footer">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
                    </div>
				</div>
                <?php include_once('comments.inc.php'); ?>
			</div>
			<div class="wb_cont_outer"></div>
			<div class="wb_cont_bg"></div>
		</div>
        <?php include_once('footer.inc.php'); ?>
	</div>
	{{hr_out}}
</body>
</html>
