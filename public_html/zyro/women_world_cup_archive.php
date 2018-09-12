<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::WOMENS_WORLD_CUP);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Women's World Cup Archive</title>
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
                    <p class="wb-stl-highlight text-center russia-2018">Women's World Cup Archive</p>
                    <p class="wb-stl-normal"> </p>
                </div>
                <div class="col-sm-7 col-sm-offset-2">
                    <h5 class="wb-stl-subtitle3">
                        <p class="border-bottom-gray5"><img src="images/wwc_logos/2015.png"/> <a href="WomenWorldCup">Canada 2015</a></p>
                        <p class="border-bottom-gray5"><img src="images/wwc_logos/2011.png"/> <a href="WomenWorldCup?tid=34">Germany 2011</a></p>
                        <p class="border-bottom-gray5"><img src="images/wwc_logos/2007.png"/> <a href="WomenWorldCup?tid=35">China 2007</a></p>
                        <p class="border-bottom-gray5"><img src="images/wwc_logos/2003.png"/> <a href="WomenWorldCup?tid=36">USA 2003</a></p>
                        <p class="border-bottom-gray5"><img src="images/wwc_logos/1999.png"/> <a href="WomenWorldCup?tid=37">USA 1999</a></p>
                        <p class="border-bottom-gray5"><img src="images/wwc_logos/1995.png"/> <a href="WomenWorldCup?tid=38">Sweden 1995</a></p>
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
