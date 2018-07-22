<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament();
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - World Cup Archive</title>
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
                    <p class="wb-stl-highlight text-center russia-2018">World Cup Archive</p>
                    <p class="wb-stl-normal"> </p>
                </div>
                <div class="col-sm-7 col-sm-offset-2">
                    <h5 class="wb-stl-subtitle3">
                        <p class="border-bottom-gray5"><img src="images/wc_logos/2018.png"/> <a href="WorldCup?tid=1">Russia 2018</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/2014.png"/> <a href="WorldCup?tid=5">Brazil 2014</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/2010.png"/> <a href="WorldCup?tid=6">South Africa 2010</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/2006.png"/> <a href="WorldCup?tid=7">Germany 2006</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/2002.png"/> <a href="WorldCup?tid=8">Korea/Japan 2002</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1998.png"/> <a href="WorldCup?tid=9">France 1998</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1994.png"/> <a href="WorldCup?tid=10">USA 1994</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1990.png"/> <a href="WorldCup?tid=11">Italy 1990</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1986.png"/> <a href="WorldCup?tid=12">Mexico 1986</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1982.png"/> <a href="WorldCup?tid=13">Spain 1982</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1978.png"/> <a href="WorldCup?tid=14">Argentina 1978</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1974.png"/> <a href="WorldCup?tid=15">Germany 1974</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1970.png"/> <a href="WorldCup?tid=16">Mexico 1970</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1966.png"/> <a href="WorldCup?tid=17">England 1966</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1962.png"/> <a href="WorldCup?tid=18">Chile 1962</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1958.png"/> <a href="WorldCup?tid=19">Sweden 1958</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1954.png"/> <a href="WorldCup?tid=20">Switzerland 1954</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1950.png"/> <a href="WorldCup?tid=21">Brazil 1950</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1938.png"/> <a href="WorldCup?tid=22">France 1938</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1934.png"/> <a href="WorldCup?tid=23">Italy 1934</a></p>
                        <p class="border-bottom-gray5"><img src="images/wc_logos/1930.png"/> <a href="WorldCup?tid=24">Uruguay 1930</a></p>
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