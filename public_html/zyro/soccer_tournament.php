<!DOCTYPE html>
<?php
    include_once('class.tournament.php');
    $qs = '';
    if ($_SERVER['QUERY_STRING'] != '') $qs = '?'.$_SERVER['QUERY_STRING'];
    parse_str($_SERVER['QUERY_STRING'], $query_string);
    $tournament_id = 1;
    if (isset($query_string['tid'])) $tournament_id = $query_string['tid'];
    $tournament_dto = Tournament::getArchiveSoccerTournament($tournament_id);
    $header = $tournament_dto->getProfile();
    $body_html = $tournament_dto->getBodyHtml();
    $modal_html = $tournament_dto->getModalHtml();
    $popover_html = $tournament_dto->getPopoverHtml();
?>
<html lang="en">
<head>
    <title>TVDL - Russia 2018</title>
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
                    <span class="wb-stl-heading1 russia-2018"><?php echo $header; ?></span>
                </div>
                <div>
                    <?php echo $body_html; ?>
                    <?php echo $popover_html; ?>
                    <p class="wb-stl-normal"> </p>
                </div>
                <div class="col-sm-12 margin-tb-lg">
                    <p class="wb-stl-footer black">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
                </div>
			</div>
		</div>
	</div>
    <!-- Modal -->
    <?php echo $modal_html; ?>
	{{hr_out}}
</body>
</html>
