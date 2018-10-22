<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::CONFEDERATIONS_CUP);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Confederations Cup Archive</title>
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
                            <p class="wb-stl-highlight text-center dark-red">Confederations Cup Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/cc_2017.png" alt="Russia 2017"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup">Russia 2017</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=212"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/cc_2013.png" alt="Brazil 2013"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=212">Brazil 2013</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=213"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/cc_2009.png" alt="South Africa 2009"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=213">South Africa 2009</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=214"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/cc_2005.jpg" alt="Germany 2005"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=214">Germany 2005</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=215"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/cc_2003.jpg" alt="France 2003"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=215">France 2003</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=216"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/cc_2001.jpg" alt="Korea-Japan 2001"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=216">Korea-Japan 2001</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=217"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/cc_1999.jpg" alt="Mexico 1999"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=217">Mexico 1999</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=218"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/cc_1997.png" alt="Saudi Arabia 1997"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=218">Saudi Arabia 1997</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=219"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/Confederations_Cup.png" alt="Saudi Arabia 1995"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=219">Saudi Arabia 1995</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="ConfederationsCup?tid=220"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/cc_logos/Confederations_Cup.png" alt="Saudi Arabia 1992"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="ConfederationsCup?tid=220">Saudi Arabia 1992</a></h5>
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
