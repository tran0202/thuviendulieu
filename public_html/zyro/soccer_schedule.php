<?php
    include_once('class.tournament.php');
    $qs = '';
    if ($_SERVER['QUERY_STRING'] != '') $qs = '?'.$_SERVER['QUERY_STRING'];
    parse_str($_SERVER['QUERY_STRING'], $query_string);
    $tournament_id = SoccerHtml::RUSSIA_2018;
    if (isset($query_string['tid'])) $tournament_id = $query_string['tid'];
    $simulation_mode = Tournament::SIMULATION_MODE_0;
    if (isset($query_string['smid'])) $simulation_mode = $query_string['smid'];
    $tournament = Tournament::getSoccerTournamentScheduleView($tournament_id, $simulation_mode);
    $profile = $tournament->getProfile();
    $header = TournamentProfile::getTournamentHeader($profile);
    $tournament_name = $profile->getName();
    $body_html = $tournament->getBodyHtml();
    $modal_html = $tournament->getModalHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - <?php echo $tournament_name; ?></title>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="wb-stl-heading1 dark-red"><?php echo $header; ?></span>
                            <span class="wb-stl-heading3 margin-left-lg"><a href="SoccerGroups<?php echo $qs; ?>" target="_self">Groups</a></span>
                            <span class="wb-stl-heading3 margin-left-lg"><a href="SoccerSchedule<?php echo $qs; ?>" target="_self">Schedule</a></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo $body_html; ?>
                            <?php echo $popover_html; ?>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <?php include_once('footer.inc.php'); ?>
                </div>
			</div>
		</div>
	</div>
    <!-- Modal -->
    <?php echo $modal_html; ?>
	{{hr_out}}
</body>
</html>
