<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::WORLD_CUP);
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 margin-top-lg">
                            <p class="wb-stl-highlight text-center dark-red">World Cup Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/2018.png" alt="Russia 2018"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup">Russia 2018</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=5"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/2014.png" alt="Brazil 2014"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=5">Brazil 2014</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=6"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/2010.png" alt="South Africa 2010"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=6">South Africa 2010</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=7"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/2006.png" alt="Germany 2006"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=7">Germany 2006</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=8"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/2002.png" alt="Korea-Japan 2002"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=8">Korea-Japan 2002</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=9"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1998.png" alt="France 1998"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=9">France 1998</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=10"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1994.png" alt="USA 1994"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=10">USA 1994</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=11"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1990.png" alt="Italy 1990"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=11">Italy 1990</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=12"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1986.png" alt="Mexico 1986"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=12">Mexico 1986</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=13"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1982.png" alt="Spain 1982"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=13">Spain 1982</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=14"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1978.png" alt="Argentina 1978"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=14">Argentina 1978</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=15"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1974.png" alt="Germany 1974"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=15">Germany 1974</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=16"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1970.png" alt="Mexico 1970"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=16">Mexico 1970</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=17"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1966.png" alt="England 1966"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=17">England 1966</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=18"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1962.png" alt="Chile 1962"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=18">Chile 1962</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=19"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1958.png" alt="Sweden 1958"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=19">Sweden 1958</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=20"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1954.png" alt="Switzerland 1954"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=20">Switzerland 1954</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=21"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1950.png" alt="Brazil 1950"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=21">Brazil 1950</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=22"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1938.png" alt="France 1938"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=22">France 1938</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=23"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1934.png" alt="Italy 1934"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=23">Italy 1934</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WorldCup?tid=24"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wc_logos/1930.png" alt="Uruguay 1930"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WorldCup?tid=24">Uruguay 1930</a></h5>
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
