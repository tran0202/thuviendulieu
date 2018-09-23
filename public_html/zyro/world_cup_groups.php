<?php
    include_once('class.tournament.php');
    $qs = '';
    if ($_SERVER['QUERY_STRING'] != '') $qs = '?'.$_SERVER['QUERY_STRING'];
    parse_str($_SERVER['QUERY_STRING'], $query_string);
    $tournament_id = 1;
    if (isset($query_string['tid'])) $tournament_id = $query_string['tid'];
    $simulation_mode = Tournament::SIMULATION_MODE_0;
    if (isset($query_string['smid'])) $simulation_mode = $query_string['smid'];
    $tournament = Tournament::getSoccerTournamentGroupView($tournament_id, $simulation_mode);
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
                            <span class="wb-stl-heading1 russia-2018"><?php echo $header; ?></span>
                            <span class="wb-stl-heading3 margin-left-lg"><a href="WorldCupGroups<?php echo $qs; ?>" target="_self">Groups</a></span>
                            <span class="wb-stl-heading3 margin-left-lg"><a href="WorldCupSchedule<?php echo $qs; ?>" target="_self">Schedule</a></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo $body_html; ?>
                            <p> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 margin-tb-lg">
                            <p class="wb-stl-footer">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
    <!-- Modal -->
    <?php echo $modal_html; ?>
	{{hr_out}}
</body>
</html>
