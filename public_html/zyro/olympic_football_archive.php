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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 margin-top-lg">
                            <p class="wb-stl-highlight text-center russia-2018">Olympic Football Tournament Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2020.png" alt="Tokyo 2020">
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Tokyo 2020</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2016.png" alt="Rio 2016"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament">Rio 2016</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=40"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2012.png" alt="London 2012"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=40">London 2012</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=41"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2008.png" alt="Beijing 2008"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=41">Beijing 2008</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=42"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2004.png" alt="Athens 2004"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=42">Athens 2004</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=43"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2000.png" alt="Sydney 2000"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=43">Sydney 2000</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=44"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1996.png" alt="Atlanta 1996"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=44">Atlanta 1996</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=45"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1992.png" alt="Barcelona 1992"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=45">Barcelona 1992</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=46"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1988.png" alt="Seoul 1988"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=46">Seoul 1988</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=47"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1984.png" alt="Los Angeles 1984"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=47">Los Angeles 1984</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=48"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1980.png" alt="Moscow 1980"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=48">Moscow 1980</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=49"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1976.png" alt="Montreal 1976"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=49">Montreal 1976</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=50"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1972.png" alt="Munich 1972"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=50">Munich 1972</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=51"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1968.png" alt="Mexico City 1968"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=51">Mexico City 1968</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=52"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1964.png" alt="Tokyo 1964"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=52">Tokyo 1964</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=53"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1960.png" alt="Roma 1960"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=53">Roma 1960</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=54"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1956.png" alt="Melbourne 1956"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=54">Melbourne 1956</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=55"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1952.png" alt="Helsinki 1952"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=55">Helsinki 1952</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=56"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1948.png" alt="London 1948"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=56">London 1948</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=57"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1936.png" alt="Berlin 1936"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=57">Berlin 1936</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=58"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1928.jpg" alt="Amsterdam 1928"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=58">Amsterdam 1928</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=59"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1924.png" alt="Paris 1924"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=59">Paris 1924</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=60"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1920.gif" alt="Antwerp 1920"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=60">Antwerp 1920</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=61"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1912.gif" alt="Stockholm 1912"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=61">Stockholm 1912</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OlympicFootballTournament?tid=62"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1908.gif" alt="London 1908"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OlympicFootballTournament?tid=62">London 1908</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo $body_html; ?>
                            <?php echo $popover_html; ?>
                            <p class="wb-stl-normal"> </p>
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
    {{hr_out}}
</body>
</html>
