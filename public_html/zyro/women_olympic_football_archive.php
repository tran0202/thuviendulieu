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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 margin-top-lg">
                            <p class="wb-stl-highlight text-center dark-red">Women's Olympic Football Tournament Archive</p>
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
                                        <a href="WomenOlympicFootballTournament"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2016.png" alt="Rio 2016"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenOlympicFootballTournament">Rio 2016</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenOlympicFootballTournament?tid=63"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2012.png" alt="London 2012"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenOlympicFootballTournament?tid=63">London 2012</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenOlympicFootballTournament?tid=64"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2008.png" alt="Beijing 2008"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenOlympicFootballTournament?tid=64">Beijing 2008</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenOlympicFootballTournament?tid=65"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2004.png" alt="Athens 2004"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenOlympicFootballTournament?tid=65">Athens 2004</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenOlympicFootballTournament?tid=66"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/2000.png" alt="Sydney 2000"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenOlympicFootballTournament?tid=66">Sydney 2000</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenOlympicFootballTournament?tid=67"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/olympic_logos/1996.png" alt="Atlanta 1996"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenOlympicFootballTournament?tid=67">Atlanta 1996</a></h5>
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
                    <?php include_once('footer.inc.php'); ?>
                </div>
            </div>
        </div>
    </div>
    {{hr_out}}
</body>
</html>
