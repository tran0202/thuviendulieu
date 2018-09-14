<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::OLYMPIC);
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
                        <p class="border-bottom-gray5"><img src="images/olympic_logos/2012.png"/> <a href="OlympicFootballTournament?tid=40">London 2012</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/2008.png"/> <a href="OlympicFootballTournament?tid=41">Beijing 2008</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/2004.png"/> <a href="OlympicFootballTournament?tid=42">Athens 2004</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/2000.png"/> <a href="OlympicFootballTournament?tid=43">Sydney 2000</a></p>
                        <p class="border-bottom-gray5"><img src="images/olympic_logos/1996.png"/> <a href="OlympicFootballTournament?tid=44">Atlanta 1996</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1992.png"/> <a href="OlympicFootballTournament?tid=45">Barcelona 1992</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1988.png"/> <a href="OlympicFootballTournament?tid=46">Seoul 1988</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1984.png"/> <a href="OlympicFootballTournament?tid=47">Los Angeles 1984</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1980.png"/> <a href="OlympicFootballTournament?tid=48">Moscow 1980</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1976.png"/> <a href="OlympicFootballTournament?tid=49">Montreal 1976</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1972.png"/> <a href="OlympicFootballTournament?tid=50">Munich 1972</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1968.png"/> <a href="OlympicFootballTournament?tid=51">Mexico City 1968</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1964.png"/> <a href="OlympicFootballTournament?tid=52">Tokyo 1964</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1960.png"/> <a href="OlympicFootballTournament?tid=53">Roma 1960</a></p>
                        <p class="border-bottom-gray5"><img src="images/olympic_logos/1956.png"/> <a href="OlympicFootballTournament?tid=54">Melbourne 1956</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1952.png"/> <a href="OlympicFootballTournament?tid=55">Helsinki 1952</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1948.png"/> <a href="OlympicFootballTournament?tid=56">London 1948</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1936.png"/> <a href="OlympicFootballTournament?tid=57">Berlin 1936</a></p>
                        <p class="border-bottom-gray5"><img height="100" src="images/olympic_logos/1928.jpg"/> <a href="OlympicFootballTournament?tid=58">Amsterdam 1928</a></p>
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
