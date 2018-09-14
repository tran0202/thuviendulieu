<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::WOMENS_OLYMPIC);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Women's Olympic Football Tournament Archive</title>
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
                    <p class="wb-stl-highlight text-center russia-2018">Women's Olympic Football Tournament Archive</p>
                    <p class="wb-stl-normal"> </p>
                </div>
                <div class="col-sm-7 col-sm-offset-2">
                    <h5 class="wb-stl-subtitle3">
                        <p class="border-bottom-gray5"><img src="images/olympic_logos/2016.png"/> <a href="WomenOlympicFootballTournament">Rio 2016</a></p>
                        <p class="border-bottom-gray5"><img src="images/olympic_logos/2012.png"/> <a href="WomenOlympicFootballTournament?tid=63">London 2012</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/2008.png"/> <a href="WomenOlympicFootballTournament?tid=64">Beijing 2008</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/2004.png"/> <a href="WomenOlympicFootballTournament?tid=65">Athens 2004</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/2000.png"/> <a href="WomenOlympicFootballTournament?tid=66">Sydney 2000</a></p>
                        <p class="border-bottom-gray5"><img src="images/olympic_logos/1996.png"/> <a href="WomenOlympicFootballTournament?tid=67">Atlanta 1996</a></p>
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
