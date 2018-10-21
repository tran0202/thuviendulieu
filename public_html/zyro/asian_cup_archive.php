<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::ASIAN_CUP);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Asian Cup Archive</title>
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
                            <p class="wb-stl-highlight text-center dark-red">Asian Cup Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/aac_logos/aac_2019.png" alt="United Arab Emirates 2019">
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">United Arab Emirates 2019</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/aac_logos/aac_2015.png" alt="Australia 2015"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup">Australia 2015</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=186"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/aac_logos/aac_2011.png" alt="Qatar 2011"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=186">Qatar 2011</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=187"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/aac_logos/aac_2007.png" alt="Indonesia-Malaysia-Thailand-Vietnam 2007"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=187">Indonesia-Malaysia-Thailand-Vietnam 2007</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=188"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/aac_logos/aac_2004.png" alt="China 2004"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=188">China 2004</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=189"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/aac_logos/aac_2000.png" alt="Lebanon 2000"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=189">Lebanon 2000</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=190"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/aac_logos/aac_1996.png" alt="United Arab Emirates 1996"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=190">United Arab Emirates 1996</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=191"><img class="card-img-top card-img-top-height-85 padding-top-sm" style="margin-top:15px;" src="images/aac_logos/AFC.png" alt="Japan 1992"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=191">Japan 1992</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=192"><img class="card-img-top card-img-top-height-85 padding-top-sm" style="margin-top:15px;" src="images/aac_logos/AFC.png" alt="Qatar 1988"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=192">Qatar 1988</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=193"><img class="card-img-top card-img-top-height-85 padding-top-sm" style="margin-top:15px;" src="images/aac_logos/AFC.png" alt="Singapore 1984"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=193">Singapore 1984</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AsianCup?tid=194"><img class="card-img-top card-img-top-height-85 padding-top-sm" style="margin-top:15px;" src="images/aac_logos/AFC.png" alt="Kuwait 1980"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=194">Kuwait 1980</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=195">Iran 1976</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=196">Thailand 1972</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=197">Iran 1968</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=198">Israel 1964</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=199">Korea Republic 1960</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AsianCup?tid=200">Hong Kong 1956</a></h5>
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
