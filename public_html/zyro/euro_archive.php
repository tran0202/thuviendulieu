<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::EURO);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Euro Archive</title>
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
                            <p class="wb-stl-highlight text-center dark-red">Euro Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_2020.png" alt="Pan-European 2020">
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Pan-European 2020</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_2016.png" alt="France 2016"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro">France 2016</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=69"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_2012.png" alt="Poland-Ukraine 2012"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=69">Poland-Ukraine 2012</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=70"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_2008.png" alt="Austria-Switzerland 2008"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=70">Austria-Switzerland 2008</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=71"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_2004.png" alt="Portugal 2004"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=71">Portugal 2004</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=72"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_2000.png" alt="Belgium-Netherlands 2000"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=72">Belgium-Netherlands 2000</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=73"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1996.png" alt="England 1996"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=73">England 1996</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=74"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1992.png" alt="Sweden 1992"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=74">Sweden 1992</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=75"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1988.png" alt="West Germany 1988"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=75">West Germany 1988</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=76"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1984.png" alt="France 1984"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=76">France 1984</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=77"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1980.png" alt="Italy 1980"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=77">Italy 1980</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=78"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1976.png" alt="Yugoslavia 1976"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=78">Yugoslavia 1976</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=79"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1972.png" alt="Belgium 1972"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=79">Belgium 1972</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=80"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1968.png" alt="Italy 1968"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=80">Italy 1968</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=81"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1964.png" alt="Spain 1964"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=81">Spain 1964</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="Euro?tid=82"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/Euro_1960.png" alt="France 1960"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="Euro?tid=82">France 1960</a></h5>
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
