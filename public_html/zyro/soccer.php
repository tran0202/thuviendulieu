<!DOCTYPE html>
<?php
    include_once('config.php');
    include_once('tpl.team.php');
    $sql = 'SELECT UCASE(t.name) AS name, team_id, ' .
            'group_id, UCASE(g.name) AS group_name, ' .
            'group_order, tt.tournament_id ' .
        'FROM team_tournament tt ' .
        'LEFT JOIN team t ON t.id = tt.team_id ' .
        'LEFT JOIN `group` g ON g.id = tt.group_id ' .
        'WHERE tt.tournament_id = 1 ' .
        'ORDER BY group_id, group_order';
    $query = $connection -> prepare($sql);
    $query -> execute();
    $count = $query -> rowCount();
    $teams = array();
    $output = '<!-- Count = '.$count.' -->';
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
            $team = new Team($row['name'], $row['group_name'], $row['group_order']);
            $teams[$row['group_name']][$row['group_order']] = $team;
        }
        foreach ($teams as $group_name => $_teams) {
            $output .= '<div class="col-sm-12 margin-top">';
            $output .= '<span class="col-sm-2 groupTitle">Group '.$group_name.'</span>';
            $output .= '<span class="col-sm-2 wb-stl-heading4 margin-left-md" style="margin-top: 18px;">';
            $output .= '<a class="link-modal" data-toggle="modal" data-target="#group'.$group_name.'MatchesModal">Matches</a>';
            $output .= '</span>';
            $output .= '</div>';
            $output .= '<div class="col-sm-12 groupBox">';
            foreach ($_teams as $group_order => $_team) {
                $output .= '<div class="groupRow margin-top margin-bottom">'.$_team -> name.'</div>';
            }
            $output .= '</div>';
        }
    }

    include_once('tpl.match.php');
    $sql = 'SELECT t.name AS home_team_name, home_team_score,
            t2.name AS away_team_name, away_team_score,
            DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
            TIME_FORMAT(match_time, "%H:%i") as match_time_fmt, match_time, match_order,
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
    $output2 = '<!-- Count = '.$count.' -->';
    if ($count == 0) {
        $output2 = '<h2>No result found!</h2>';
    }
    else {
        while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
            $match = new Match($row['home_team_name'], $row['away_team_name'],
                $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'], $row['match_order'],
                $row['round'], $row['stage'], $row['group_name']);
            $matches[$row['group_name']][$row['match_order']] = $match;
        }
        foreach ($matches as $group_name => $_matches) {
            $output2 .= '<div class="modal fade" id="group'.$group_name.'MatchesModal" tabindex="-1" role="dialog" aria-labelledby="group'.$group_name.'MatchesModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="width:700px;">
                        <div class="modal-content">
                            <div class="col-sm-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span style="font-size:48px;" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-header col-sm-12 padding-left-lg padding-right-lg" style="border-bottom:none;">
                                <div class="col-sm-12 groupTitle2" id="group'.$group_name.'MatchesModalLabel">Group '.$group_name.'</div>
                            </div>
                            <div class="modal-body col-sm-12 padding-left-lg padding-right-lg" id="group'.$group_name.'MatchesModalBody">';
            foreach ($_matches as $match_order => $_match) {
                $output2 .= '<div class="col-sm-12 margin-top margin-bottom border-bottom">'.
                    '<div class="col-sm-4 groupRow">'.$_match -> home_team_name.'</div>'.
                    '<div class="col-sm-2 groupRow">vs</div>'.
                    '<div class="col-sm-4 groupRow">'.$_match -> away_team_name.'</div>'.
                    '</div>';
            }
            $output2 .= '
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span style="font-size:26px;" aria-hidden="true">Close</span>
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
    <!-- Modal -->
    <?php echo $output2; ?>
	{{hr_out}}
</body>
</html>
