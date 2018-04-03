<!DOCTYPE html>
<?php
    include_once('config.php');
    include_once('tpl.match.php');
    $sql = 'SELECT t.name AS home_team_name, home_team_score, n.flag_filename AS home_flag, 
                t2.name AS away_team_name, away_team_score, n2.flag_filename AS away_flag, 
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
                LEFT JOIN nation n ON n.id = t.nation_id  
                LEFT JOIN nation n2 ON n2.id = t2.nation_id 
            WHERE m.tournament_id = 1
            ORDER BY stage_id, round_id, match_date, match_time;';
    $query = $connection->prepare($sql);
    $query->execute();
    $count = $query->rowCount();
    $matches = array();
    $bracket_matches = array();
    $output = '<!-- Count = '.$count.' -->';
    $output2 = '';
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $match = new Match($row['home_team_name'], $row['away_team_name'],
                $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'], $row['match_order'],
                $row['round'], $row['stage'], $row['group_name'], $row['waiting_home_team'], $row['waiting_away_team'],
                '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                $row['home_flag'], '', $row['away_flag'], '');
            $matches[$row['round']][$row['match_date']][$row['match_order']] = $match;
            if ($row['round'] != 'Group Matches') $bracket_matches[$row['round']][$row['match_order']] = $match;
        }
        $output .= '
                        <div id="accordion" class="">
                            <div class="card col-sm-12 padding-top-md padding-bottom-md border-bottom">
                                <div class="card-header" id="headingTwo" style="width:100%;padding-left:0;">
                                    
                                        <button class="btn btn-link collapsed title no-padding-left" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Bracket <i id="bracket-down-arrow" class="fa fa-angle-double-down blue-pale-xl"></i> <i id="bracket-up-arrow" class="fa fa-angle-double-up blue-pale-xl" style="display:none;"></i>
                                        </button>
                                    
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
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
                            <div class="col-sm-12 margin-top">
                                <span class="stageTitle">'.$bracket_round.'</span>
                            </div>';
            foreach ($_bracket_matches as $bracket_match_order => $_bracket_match) {
                $gap_height = 10;
                if ($j != 0) $gap_height = $gap_heights[$i][1];
                $home_team_name = $_bracket_match->home_team_name;
                $away_team_name = $_bracket_match->away_team_name;
                $waiting_home_team = $_bracket_match->waiting_home_team;
                $waiting_away_team = $_bracket_match->waiting_away_team;
                $output .= '<div class="col-sm-12" style="height:'.$gap_height.'px;"></div>
                            <div class="col-sm-12 group-box-sm" style="height:'.$box_height.'px;">
                                <div class="col-sm-12 group-row-md margin-top margin-bottom">
                                    <div class="col-sm-7" style="padding-left: 0;padding-right: 0">'.
                    $waiting_home_team.
                    '</div>
                                </div>
                                <div class="col-sm-12 group-row-md margin-top margin-bottom">
                                    <div class="col-sm-7" style="padding-left: 0;padding-right: 0">'.
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
            $output2 .= '<div class="col-sm-12 stageTitle margin-top-md">'.$rounds.'</div>';
            foreach ($_round as $match_dates => $_matches) {
                $output2 .= '<div class="col-sm-12 groupTitle2 margin-top-md">'
                    .$_matches[array_keys($_matches)[0]]->match_date_fmt.'</div>';
                foreach ($_matches as $match_order => $_match) {
                    $home_team_tmp = $_match->home_team_name;
                    if ($home_team_tmp == null) $home_team_tmp = '['.$_match->waiting_home_team.']';
                    $away_team_tmp = $_match->away_team_name;
                    if ($away_team_tmp == null) $away_team_tmp = '['.$_match->waiting_away_team.']';
                    $group_text = '';
                    $home_flag_tmp = '<div class="col-sm-1 padding-left-xs padding-right-xs padding-top text-right">
                                            <img class="flag" src="/images/flags/'.$_match->home_flag.'">
                                        </div>';
                    if ($_match->home_flag == '') $home_flag_tmp = '<div class="col-sm-1 padding-left-xs padding-right-xs padding-top text-right"></div>';
                    $away_flag_tmp = '<div class="col-sm-1 padding-left-xs padding-right-xs padding-top text-right">
                                            <img class="flag" src="/images/flags/'.$_match->away_flag.'">
                                        </div>';
                    if ($_match->away_flag == '') $away_flag_tmp = '<div class="col-sm-1 padding-left-xs padding-right-xs padding-top text-right"></div>';
                    if ($_match->group_name != null) $group_text = '<a class="link-modal" data-toggle="modal" data-target="#group'.$_match->group_name.'StandingModal">
                                                                        Group '.$_match->group_name.'</a>' ;
                    $output2 .= '<div class="col-sm-12 padding-top-md padding-bottom-md border-bottom">
                                    <div class="col-sm-2 padding-left-xs padding-right-xs margin-top">'.$_match->match_time_fmt.' CST<br>'.$group_text.'</div>'.
                                    $home_flag_tmp.
                                    '<div class="col-sm-3 groupRow padding-left-lg padding-right-xs">'.$home_team_tmp.'</div>
                                    <div class="col-sm-1 groupRow padding-left-xs padding-right-xs">vs</div>
                                    <div class="col-sm-3 groupRow padding-left-xs padding-right-xs text-right">'.$away_team_tmp.'</div>'.
                                    $away_flag_tmp.
                                '</div>';
                }
            }
        }
    }

    include_once('tpl.team.php');
    $sql = 'SELECT UCASE(t.name) AS name, team_id, 
                    group_id, UCASE(g.name) AS group_name, 
                    group_order, n.flag_filename, tt.tournament_id 
                FROM team_tournament tt 
                LEFT JOIN team t ON t.id = tt.team_id 
                LEFT JOIN `group` g ON g.id = tt.group_id  
                LEFT JOIN nation n ON n.id = t.nation_id 
                WHERE tt.tournament_id = 1 
                ORDER BY group_id, group_order';
    $query = $connection->prepare($sql);
    $query->execute();
    $count = $query->rowCount();
    $teams = array();
    $output3 = '<!-- Count2 = '.$count.' -->';
    if ($count == 0) {
        $output3 = '<h2>No result found!</h2>';
    }
    else {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $team = new Team($row['name'], $row['group_name'], $row['group_order'], '', '', $row['flag_filename']);
            $teams[$row['group_name']][$row['group_order']] = $team;
        }
        foreach ($teams as $group_name => $_teams) {
            $output3 .= '<div class="modal fade" id="group'.$group_name.'StandingModal" tabindex="-1" role="dialog" aria-labelledby="group'.$group_name.'StandingModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="width:800px;">
                        <div class="modal-content">
                            <div class="col-sm-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span style="font-size:48px;" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-header col-sm-12 padding-left-lg padding-right-lg" style="border-bottom:none;">
                                <div class="col-sm-12 groupTitle2" id="group'.$group_name.'StandingModalLabel">Group '.$group_name.'</div>
                            </div>
                            <div class="modal-body col-sm-12 padding-left-lg padding-right-lg" id="group'.$group_name.'StandingModalBody">
                                <div class="col-sm-12 group-row-lg padding-top-md padding-bottom-md" style="font-weight:bold;">
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
                $output3 .=     '<div class="col-sm-12 group-row-lg padding-top-md padding-bottom-md">
                                    <div class="col-sm-1"><img class="flag" src="/images/flags/'.$_team->flag_filename.'"></div>
                                    <div class="col-sm-3" style="padding-top: 3px;">'.$_team->name.'</div>
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
    <script>
        $(function() {
            $('#collapseTwo').on('shown.bs.collapse', function () {
                $('#bracket-down-arrow').hide();
                $('#bracket-up-arrow').show();
            })
            $('#collapseTwo').on('hidden.bs.collapse', function () {
                $('#bracket-down-arrow').show();
                $('#bracket-up-arrow').hide();
            })
        });
    </script>
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
                        <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018Bracket/" target="_self">Bracket</a></span>
                    </div>
                    <div>
                        <?php echo $output2; ?>
                        <p class="wb-stl-normal"> </p>
                        <p class="wb-stl-normal"> </p>
                    </div>
                    <div class="col-sm-12 margin-top-lg margin-bottom-lg">
                        <p class="wb-stl-footer">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
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
    <!-- Modal -->
    <?php echo $output3; ?>
	{{hr_out}}
</body>
</html>
