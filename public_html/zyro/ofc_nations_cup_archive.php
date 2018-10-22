<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::OFC_NATIONS_CUP);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - OFC Nations Cup Archive</title>
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
                            <p class="wb-stl-highlight text-center dark-red">OFC Nations Cup Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OFCNationsCup"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/OFCcup.png" alt="Papua New Guinea 2016"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup">Papua New Guinea 2016</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OFCNationsCup?tid=202"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/OFCcup.png" alt="Solomon Islands 2012"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=202">Solomon Islands 2012</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OFCNationsCup?tid=203"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/OFCcup.png" alt="Pan-Oceania 2008"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=203">Pan-Oceania 2008</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OFCNationsCup?tid=204"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/OFCcup.png" alt="Australia 2004"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=204">Australia 2004</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="OFCNationsCup?tid=205"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/OFCcup.png" alt="New Zealand 2002"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=205">New Zealand 2002</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=206">Tahiti 2000</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=207">Australia 1998</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=208">Pan-Oceania 1996</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=209">New Caledonia 1980</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="OFCNationsCup?tid=210">New Zealand 1973</a></h5>
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
