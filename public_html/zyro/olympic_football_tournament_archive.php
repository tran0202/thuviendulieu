<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeOlympicSoccerTournament(Tournament::OLYMPIC);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Olympic Football Tournament Archive</title>
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
                <div class="col-sm-12 margin-top-lg">
                    <p class="wb-stl-highlight text-center russia-2018">Olympic Football Tournament Archive</p>
                    <p class="wb-stl-normal"> </p>
                </div>
                <div class="col-sm-7 col-sm-offset-2">
                    <h5 class="wb-stl-subtitle3">
                        <p class="border-bottom-gray5"><img src="images/olympic_logos/2016.png"/> <a href="OlympicFootballTournament">Rio 2016</a></p>
                    </h5>
                </div>
                <div>
                    <?php echo $body_html; ?>
                    <?php echo $popover_html; ?>
                    <p class="wb-stl-normal"> </p>
                </div>
                <div class="col-sm-12 margin-tb-lg">
                    <p class="wb-stl-footer">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
                </div>
            </div>
        </div>
    </div>
    {{hr_out}}
</body>
</html>
