<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Soccer</title>
    <?php include_once('header_script.inc.php'); ?>
</head>
<body class="bg-soccer">
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
                    <div class="card-group">
                        <div class="card">
                            <img class="card-img-top card-img-top-height-200 mx-auto margin-top-sm" src="images/unl_logos/unl.jpg" alt="Russia 2018">
                            <div class="card-body">
                                <h5 class="card-title">2018/19 UEFA Nations League</h5>
                                <p class="card-text">
                                    <a href="UEFANationsLeagueStandings" class="card-link">Standings</a> <a href="UEFANationsLeagueMatches" class="card-link">Matches</a>
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top card-img-top-height-200 mx-auto margin-top-sm" src="images/club_logos/UCL.svg" alt="France 2019">
                            <div class="card-body">
                                <h5 class="card-title">2018/19 UEFA Champions League</h5>
                                <p class="card-text">
                                    <a href="UEFAChampionsLeagueStandings" class="card-link">Standings</a> <a href="UEFAChampionsLeagueMatches" class="card-link">Matches</a>
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top card-img-top-height-200 mx-auto margin-top-sm" src="images/club_logos/UEL.svg" alt="Tokyo 2020">
                            <div class="card-body">
                                <h5 class="card-title">2018/19 UEFA Europa League</h5>
                                <p class="card-text">
                                    <a href="UEFAEuropaLeagueStandings" class="card-link">Standings</a> <a href="UEFAEuropaLeagueMatches" class="card-link">Matches</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-group">
                        <div class="card">
                            <span class="mx-auto">
                                <img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/olympic_logos/2020.png" alt="Tokyo 2020">
                                <a href="OlympicFootballTournament"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/olympic_logos/2016.png" alt="Rio 2016"></a>
                                <a href="OlympicFootballTournament?tid=40"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/olympic_logos/2012.png" alt="Lndon 2012"></a>
                            </span>
                            <span class="mx-auto">
                                <a href="OlympicFootballTournament?tid=41"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/olympic_logos/2008.png" alt="Beijing 2008"></a>
                                <a href="OlympicFootballTournament?tid=42"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/olympic_logos/2004.png" alt="Athens 2004"></a>
                                <a href="OlympicFootballTournament?tid=43"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/olympic_logos/2000.png" alt="Sydney 2000"></a>
                            </span>
                            <div class="card-body">
                                <h5 class="card-title">Olympic Football Tournaments</h5>
                                <p class="card-text">
                                    <a href="OlympicFootballTournamentArchive" class="card-link">Men's Archive <span class="fa fa-futbol-o"></span></a>
                                    <a href="WomenOlympicFootballTournamentArchive" class="card-link">Women's Archive <span class="fa fa-futbol-o"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <span class="mx-auto">
                                <a href="WorldCup"><img class="card-img-top card-img-top-height-100 margin-top-sm" src="images/wc_logos/2018.png" alt="Russia 2018"></a>
                                <a href="WorldCup?tid=5"><img class="card-img-top card-img-top-height-100 margin-top-sm" src="images/wc_logos/2014.png" alt="Brazil 2014"></a>
                                <a href="WorldCup?tid=6"><img class="card-img-top card-img-top-height-100 margin-top-sm" src="images/wc_logos/2010.png" alt="South Africa 2010"></a>
                            </span>
                            <span class="mx-auto">
                                <a href="WorldCup?tid=7"><img class="card-img-top card-img-top-height-100 margin-top-sm" src="images/wc_logos/2006.png" alt="Germany 2006"></a>
                                <a href="WorldCup?tid=8"><img class="card-img-top card-img-top-height-100 margin-top-sm" src="images/wc_logos/2002.png" alt="Korea/Japan 2002"></a>
                                <a href="WorldCup?tid=9"><img class="card-img-top card-img-top-height-100 margin-top-sm" src="images/wc_logos/1998.png" alt="France 1998"></a>
                            </span>
                            <div class="card-body">
                                <h5 class="card-title">FIFA World Cup</h5>
                                <p class="card-text">
                                    <a href="WorldCupArchive" class="card-link">Archive <span class="fa fa-futbol-o"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <span class="mx-auto">
                                <img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/wwc_logos/2019.png" alt="France 2019">
                                <a href="WomenWorldCup"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/wwc_logos/2015.png" alt="Canada 2015"></a>
                                <a href="WomenWorldCup?tid=34"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/wwc_logos/2011.png" alt="Germany 2011"></a>
                            </span>
                            <span class="mx-auto">
                                <a href="WomenWorldCup?tid=35"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/wwc_logos/2007.png" alt="China 2007"></a>
                                <a href="WomenWorldCup?tid=36"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/wwc_logos/2003.png" alt="USA 2003"></a>
                                <a href="WomenWorldCup?tid=37"><img class="card-img-top card-img-top-height-100 mx-auto margin-top-sm" src="images/wwc_logos/1999.png" alt="USA 1999"></a>
                            </span>
                            <div class="card-body">
                                <h5 class="card-title">FIFA Women's World Cup</h5>
                                <p class="card-text">
                                    <a href="WomenWorldCupArchive" class="card-link">Archive <span class="fa fa-futbol-o"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--                <div class="col-sm-12 margin-top-lg padding-top-lg border-top-gray5">-->
                    <!--                    <p class="wb-stl-highlight text-center">Imagination</p>-->
                    <!--                    <p class="wb-stl-normal"> </p>-->
                    <!--                </div>-->
                    <!--                <div class="col-sm-12">-->
                    <!--                    <h5 class="wb-stl-subtitle2 text-center">-->
                    <!--                        All Matches: <a href="Russia2018Groups?fid=3">Groups</a> | <a href="Russia2018Schedule?fid=3">Schedule</a><br>-->
                    <!--                        First 2 Matches: <a href="Russia2018Groups?fid=2">Groups</a> | <a href="Russia2018Schedule?fid=2">Schedule</a>-->
                    <!--                    </h5>-->
                    <!--                </div>-->
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="wb-stl-highlight3 text-center">Women's World Cup <br>France 2019</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-8 offset-sm-2 text-center">
                                <div class="clock"></div>
                            </div>
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
