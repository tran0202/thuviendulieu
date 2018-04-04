<!DOCTYPE html>
<?php
    include_once('config.php');
    include_once('class.match.php');
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
            WHERE m.tournament_id = 1 AND m.stage_id = 40
            ORDER BY match_order;';
    $query = $connection->prepare($sql);
    $query->execute();
    $count = $query->rowCount();
    $matches = array();
    $output = '<!-- Total Count = '.$count.' -->';
    if ($count == 0) {
        $output = '<h2>No result found!</h2>';
    }
    else {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $home_team_score = $row['home_team_score'];
            if ($row['home_team_score'] == null) $home_team_score = mt_rand(0,10);
            $away_team_score = $row['away_team_score'];
            if ($row['away_team_score'] == null) $away_team_score = mt_rand(0,10);
            $match = Match::CreateSoccerMatch($row['home_team_name'], $row['away_team_name'],
                $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_time_fmt'], $row['match_order'], $row['round'],
                $row['stage'], $row['group_name'], $row['waiting_home_team'], $row['waiting_away_team'],
                $home_team_score, $away_team_score, $row['home_flag'], $row['away_flag']);
            $matches[$row['round']][$row['match_order']] = $match;
        }
        $box_height = 120;
        $gap_heights = array(array(10, 20), array(80, 160), array(220, 440), array(410, 1000), array(10, 2120));
        $i = 0;
        $j = 0;
        foreach ($matches as $round => $_matches) {
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
