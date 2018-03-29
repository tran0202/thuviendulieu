<?php
    include_once('config.php');
    include_once('tpl.match.php');
    $sql = 'SELECT t.name AS home_team_name, htt.seed AS home_team_seed,
            t2.name AS away_team_name, att.seed AS away_team_seed,
            home_set1_score, away_set1_score, home_set1_tiebreak, away_set1_tiebreak,
            home_set2_score, away_set2_score, home_set2_tiebreak, away_set2_tiebreak,
            home_set3_score, away_set3_score, home_set3_tiebreak, away_set3_tiebreak,
            home_set4_score, away_set4_score, home_set4_tiebreak, away_set4_tiebreak,
            home_set5_score, away_set5_score, home_set5_tiebreak, away_set5_tiebreak,
            match_date, match_order,
            g.name AS round,
            m.tournament_id
        FROM `match` m
            LEFT JOIN team t ON t.id = m.home_team_id
            LEFT JOIN team t2 ON t2.id = m.away_team_id
            LEFT JOIN `group` g ON g.id = m.round_id
            LEFT JOIN team_tournament htt ON (htt.team_id = m.home_team_id AND htt.tournament_id = m.tournament_id)
            LEFT JOIN team_tournament att ON (att.team_id = m.away_team_id AND att.tournament_id = m.tournament_id)
        WHERE m.tournament_id = 4
        ORDER BY match_order;';
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
                $row['match_date'], '', '', '', $row['match_order'], $row['round'],
                '', '', '', '',
                $row['home_team_seed'], $row['away_team_seed'], '', '',
                $row['home_set1_score'], $row['away_set1_score'], $row['home_set1_tiebreak'], $row['away_set1_tiebreak'],
                $row['home_set2_score'], $row['away_set2_score'], $row['home_set2_tiebreak'], $row['away_set2_tiebreak'],
                $row['home_set3_score'], $row['away_set3_score'], $row['home_set3_tiebreak'], $row['away_set3_tiebreak'],
                $row['home_set4_score'], $row['away_set4_score'], $row['home_set4_tiebreak'], $row['away_set4_tiebreak'],
                $row['home_set5_score'], $row['away_set5_score'], $row['home_set5_tiebreak'], $row['away_set5_tiebreak']);
            $matches[$row['round']][$row['match_order']] = $match;
        }
        foreach ($matches as $round => $_matches) {
            $output .= '<div class="col-sm-4">';
            $output .= '<div class="col-sm-12 margin-top">';
            $output .= '<span class="groupTitle">'.$round.'</span>';
            $output .= '</div>';
            foreach ($_matches as $match_order => $_match) {
                $home_team_name = $_match -> home_team_name;
                $away_team_name = $_match -> away_team_name;
                $home_win = 0;
                $away_win = 0;
                if ($_match -> home_set1_score > $_match -> away_set1_score) $home_win = $home_win + 1;
                if ($_match -> home_set2_score > $_match -> away_set2_score) $home_win = $home_win + 1;
                if ($_match -> home_set3_score > $_match -> away_set3_score) $home_win = $home_win + 1;
                if ($_match -> home_set4_score > $_match -> away_set4_score) $home_win = $home_win + 1;
                if ($_match -> home_set5_score > $_match -> away_set5_score) $home_win = $home_win + 1;
                if ($_match -> home_set1_score < $_match -> away_set1_score) $away_win = $away_win + 1;
                if ($_match -> home_set2_score < $_match -> away_set2_score) $away_win = $away_win + 1;
                if ($_match -> home_set3_score < $_match -> away_set3_score) $away_win = $away_win + 1;
                if ($_match -> home_set4_score < $_match -> away_set4_score) $away_win = $away_win + 1;
                if ($_match -> home_set5_score < $_match -> away_set5_score) $away_win = $away_win + 1;
                if ($home_win > $away_win) $away_team_name = '<span style="color:#858585">'.$_match -> away_team_name.'</span>';
                if ($home_win < $away_win) $home_team_name = '<span style="color:#858585">'.$_match -> home_team_name.'</span>';
                $home_team_seed = '<span class="group-row-sm-thin">('.$_match -> home_team_seed.')</span> ';
                $away_team_seed = '<span class="group-row-sm-thin">('.$_match -> away_team_seed.')</span> ';
                if ($home_win > $away_win) $away_team_seed = '<span class="group-row-sm-thin" style="color:#858585">('.$_match -> away_team_seed.')</span> ';
                if ($home_win < $away_win) $home_team_seed = '<span class="group-row-sm-thin" style="color:#858585">('.$_match -> home_team_seed.')</span> ';
                $home_set1_score = $_match -> home_set1_score;
                $home_set2_score = $_match -> home_set2_score;
                $home_set3_score = $_match -> home_set3_score;
                $home_set4_score = $_match -> home_set4_score;
                $home_set5_score = $_match -> home_set5_score;
                $away_set1_score = $_match -> away_set1_score;
                $away_set2_score = $_match -> away_set2_score;
                $away_set3_score = $_match -> away_set3_score;
                $away_set4_score = $_match -> away_set4_score;
                $away_set5_score = $_match -> away_set5_score;
                $home_set1_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> home_set1_tiebreak.'</sup></span>';
                $home_set2_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> home_set2_tiebreak.'</sup></span>';
                $home_set3_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> home_set3_tiebreak.'</sup></span>';
                $home_set4_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> home_set4_tiebreak.'</sup></span>';
                $home_set5_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> home_set5_tiebreak.'</sup></span>';
                $away_set1_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> away_set1_tiebreak.'</sup></span>';
                $away_set2_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> away_set2_tiebreak.'</sup></span>';
                $away_set3_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> away_set3_tiebreak.'</sup></span>';
                $away_set4_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> away_set4_tiebreak.'</sup></span>';
                $away_set5_tiebreak = ' <span class="group-row-sm-thin"><sup>'.$_match -> away_set5_tiebreak.'</sup></span>';
                if ($_match -> home_set1_score > $_match -> away_set1_score) $away_set1_score = '<span class="group-row-md-thin">'.$_match -> away_set1_score.'</span>';
                if ($_match -> home_set1_score < $_match -> away_set1_score) $home_set1_score = '<span class="group-row-md-thin">'.$_match -> home_set1_score.'</span>';
                if ($_match -> home_set2_score > $_match -> away_set2_score) $away_set2_score = '<span class="group-row-md-thin">'.$_match -> away_set2_score.'</span>';
                if ($_match -> home_set2_score < $_match -> away_set2_score) $home_set2_score = '<span class="group-row-md-thin">'.$_match -> home_set2_score.'</span>';
                if ($_match -> home_set3_score > $_match -> away_set3_score) $away_set3_score = '<span class="group-row-md-thin">'.$_match -> away_set3_score.'</span>';
                if ($_match -> home_set3_score < $_match -> away_set3_score) $home_set3_score = '<span class="group-row-md-thin">'.$_match -> home_set3_score.'</span>';
                if ($_match -> home_set4_score > $_match -> away_set4_score) $away_set4_score = '<span class="group-row-md-thin">'.$_match -> away_set4_score.'</span>';
                if ($_match -> home_set4_score < $_match -> away_set4_score) $home_set4_score = '<span class="group-row-md-thin">'.$_match -> home_set4_score.'</span>';
                if ($_match -> home_set5_score > $_match -> away_set5_score) $away_set5_score = '<span class="group-row-md-thin">'.$_match -> away_set5_score.'</span>';
                if ($_match -> home_set5_score < $_match -> away_set5_score) $home_set5_score = '<span class="group-row-md-thin">'.$_match -> home_set5_score.'</span>';
                if ($_match -> home_set1_tiebreak > $_match -> away_set1_tiebreak) $home_set1_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> home_set1_tiebreak.'</sup></span>';
                if ($_match -> home_set2_tiebreak > $_match -> away_set2_tiebreak) $home_set2_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> home_set2_tiebreak.'</sup></span>';
                if ($_match -> home_set3_tiebreak > $_match -> away_set3_tiebreak) $home_set3_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> home_set3_tiebreak.'</sup></span>';
                if ($_match -> home_set4_tiebreak > $_match -> away_set4_tiebreak) $home_set4_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> home_set4_tiebreak.'</sup></span>';
                if ($_match -> home_set5_tiebreak > $_match -> away_set5_tiebreak) $home_set5_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> home_set5_tiebreak.'</sup></span>';
                if ($_match -> home_set1_tiebreak < $_match -> away_set1_tiebreak) $away_set1_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> away_set1_tiebreak.'</sup></span>';
                if ($_match -> home_set2_tiebreak < $_match -> away_set2_tiebreak) $away_set2_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> away_set2_tiebreak.'</sup></span>';
                if ($_match -> home_set3_tiebreak < $_match -> away_set3_tiebreak) $away_set3_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> away_set3_tiebreak.'</sup></span>';
                if ($_match -> home_set4_tiebreak < $_match -> away_set4_tiebreak) $away_set4_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> away_set4_tiebreak.'</sup></span>';
                if ($_match -> home_set5_tiebreak < $_match -> away_set5_tiebreak) $away_set5_tiebreak = ' <span class="group-row-sm-thin" style="font-weight: 400;"><sup>'.$_match -> away_set5_tiebreak.'</sup></span>';
                $output .= '<div class="col-sm-12" style="height:20px;"></div>';
                $output .= '<div class="col-sm-12 group-box-sm" style="height:120px;">';
                $output .= '<div class="col-sm-12 group-row-md margin-top margin-bottom">';
                $output .= '<div class="col-sm-7" style="padding-left: 0;padding-right: 0">';
                if ($_match -> home_team_seed != '') $output .= $home_team_seed;
                $output .= $home_team_name;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $home_set1_score;
                if ($_match -> home_set1_tiebreak != '') $output .= $home_set1_tiebreak;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $home_set2_score;
                if ($_match -> home_set2_tiebreak != '') $output .= $home_set2_tiebreak;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $home_set3_score;
                if ($_match -> home_set3_tiebreak != '') $output .= $home_set3_tiebreak;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $home_set4_score;
                if ($_match -> home_set4_tiebreak != '') $output .= $home_set4_tiebreak;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $home_set5_score;
                if ($_match -> home_set5_tiebreak != '') $output .= $home_set5_tiebreak;
                $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="col-sm-12 group-row-md margin-top margin-bottom">';
                $output .= '<div class="col-sm-7" style="padding-left: 0;padding-right: 0">';
                if ($_match -> away_team_seed != '') $output .= $away_team_seed;
                $output .= $away_team_name;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $away_set1_score;
                if ($_match -> away_set1_tiebreak != '') $output .= $away_set1_tiebreak;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $away_set2_score;
                if ($_match -> away_set2_tiebreak != '') $output .= $away_set2_tiebreak;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $away_set3_score;
                if ($_match -> away_set3_tiebreak != '') $output .= $away_set3_tiebreak;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $away_set4_score;
                if ($_match -> away_set4_tiebreak != '') $output .= $away_set4_tiebreak;
                $output .= '</div>';
                $output .= '<div class="col-sm-1" style="padding-left: 0;padding-right: 0">';
                $output .= $away_set5_score;
                if ($_match -> away_set5_tiebreak != '') $output .= $away_set5_tiebreak;
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }
            $output .= '</div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - 2017 US Open Men's Singles</title>
    <?php include_once('header_script.inc.php'); ?>
	<link href="css/4.css?ts=1520882525" rel="stylesheet" type="text/css" />
    <link href="css/footer.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="header" id="myHeader">
        <div class="vbox wb_container" id="wb_header">
            <div class="wb_cont_inner">
                <?php include_once('logo.inc.php'); ?>
                <?php include_once('menu4.inc.php'); ?>
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
                        <h1 class="wb-stl-heading1"><span style="color:#13730f;"><span class="wb_tr_ok">2017 US Open Men's Singles</span></span></h1>
                    </div>
                    <div>
                        <?php echo $output; ?>
                        <p> </p>
                    </div>
				</div>
				<div id="wb_element_instance38" class="wb_element wb_element_picture"><!--<img alt="gallery/rush-1335365_1280" src="gallery_gen/deaceea944c1e5c8faa97dbc938638a2_330x230.jpg">--></div>
				<div id="wb_element_instance39" class="wb_element wb_element_picture"><!--<img alt="gallery/soccer-933037_1280" src="gallery_gen/9f1f8dd4b573022ccb5f58534e63c223_340x230.jpg">--></div>
				<div id="wb_element_instance40" class="wb_element wb_element_picture"><!--<img alt="gallery/football-452569_640" src="gallery_gen/02aca76cc69c5b3f26f749b67d453d64_340x230.jpg">--></div>
				<div id="wb_element_instance41" class="wb_element" style=" line-height: normal;"><!--<p class="wb-stl-normal"><span style="color:#ffffff;">You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form...</span></p>--></div>
				<div id="wb_element_instance42" class="wb_element" style=" line-height: normal;"><!--<p class="wb-stl-normal"><span style="color:#ffffff;">You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best...</span></p>--></div>
				<div id="wb_element_instance43" class="wb_element wb_element_shape"></div>
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
