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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 margin-top-lg">
                            <p class="wb-stl-highlight text-center dark-red">Women's World Cup Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wwc_logos/2019.png" alt="France 2019">
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">France 2019</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenWorldCup"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wwc_logos/2015.png" alt="Canada 2015"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenWorldCup">Canada 2015</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenWorldCup?tid=34"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wwc_logos/2011.png" alt="Germany 2011"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenWorldCup?tid=34">Germany 2011</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenWorldCup?tid=35"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wwc_logos/2007.png" alt="China 2007"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenWorldCup?tid=35">China 2007</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenWorldCup?tid=36"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wwc_logos/2003.png" alt="USA 2003"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenWorldCup?tid=36">USA 2003</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenWorldCup?tid=37"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wwc_logos/1999.png" alt="USA 1999"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenWorldCup?tid=37">USA 1999</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenWorldCup?tid=38"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wwc_logos/1995.png" alt="Sweden 1995"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenWorldCup?tid=38">Sweden 1995</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="WomenWorldCup?tid=39"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/wwc_logos/1991.png" alt="China PR 1991"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="WomenWorldCup?tid=39">China PR 1991</a></h5>
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
