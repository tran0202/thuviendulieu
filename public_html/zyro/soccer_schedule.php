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
            WHERE m.tournament_id = 1
            ORDER BY stage_id, round_id, match_date, match_time;';
    $query = $connection -> prepare($sql);
    $query -> execute();
    $count = $query -> rowCount();
    $matches = array();
    $output = '<!-- Count = '.$count.' -->';
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
            $match = new Match($row['home_team_name'], $row['away_team_name'],
                $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'], $row['match_order'],
                $row['round'], $row['stage'], $row['group_name'], $row['waiting_home_team'], $row['waiting_away_team']);
            $matches[$row['round']][$row['match_date']][$row['match_order']] = $match;
        }
        foreach ($matches as $rounds => $_round) {
            $output .= '<div class="col-sm-12 stageTitle margin-top-md">'.$rounds.'</div>';
            foreach ($_round as $match_dates => $_matches) {
                $output .= '<div class="col-sm-12 groupTitle2 margin-top-md">'
                    .$_matches[array_keys($_matches)[0]] -> match_date_fmt.'</div>';
                foreach ($_matches as $match_order => $_match) {
                    $home_team_tmp = $_match -> home_team_name;
                    if ($home_team_tmp == null) $home_team_tmp = '['.$_match -> waiting_home_team.']';
                    $away_team_tmp = $_match -> away_team_name;
                    if ($away_team_tmp == null) $away_team_tmp = '['.$_match -> waiting_away_team.']';
                    $group_text = '';
                    if ($_match -> group_name != null) $group_text = 'Group '.$_match -> group_name;
                    $output .= '<div class="col-sm-12 margin-top margin-bottom border-bottom">'.
                        '<div class="col-sm-2 margin-top">'.$_match -> match_time_fmt.' CST<br>'.$group_text.'</div>'.
                        '<div class="col-sm-3 groupRow">'.$home_team_tmp.'</div>'.
                        '<div class="col-sm-2 groupRow">vs</div>'.
                        '<div class="col-sm-3 groupRow">'.$away_team_tmp.'</div>'.
                        '</div>';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Russia 2018</title>
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
				<div id="wb_element_instance14" class="wb_element wb_element_shape"></div>
				<div id="wb_element_instance15" class="wb_element" style=" line-height: normal;height: unset;">
                    <div>
                        <span class="wb-stl-heading1" style="color:#930c10;"><span class="wb_tr_ok">FIFA World Cup Russia 2018</span></span>
                        <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018/" target="_self">Groups</a></span>
                        <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018Schedule/" target="_self">Schedule</a></span>
                    </div>
                    <div>
                        <?php echo $output; ?>
                        <p class="wb-stl-normal"> </p>
                        <p class="wb-stl-normal"> </p>
                    </div>
				</div>
				<div id="wb_element_instance16" class="wb_element wb_element_picture"><!--<img alt="gallery/football-1331838_1280" src="gallery_gen/6ed42b3cb0b0176b0c634015141cc98d_450x250.jpg">--></div>
				<div id="wb_element_instance17" class="wb_element wb_element_picture"><!--<img alt="gallery/football-1276327_1280" src="gallery_gen/843428bf7f3e0f675942187cea07bff3_440x300.jpg">--></div>
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
