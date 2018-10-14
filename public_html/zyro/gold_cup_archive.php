<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::GOLD_CUP);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Gold Cup Archive</title>
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
                            <p class="wb-stl-highlight text-center dark-red">Gold Cup Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2019.png" alt="Unites States 2019">
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Unites States 2019</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2017.png" alt="Unites States 2017"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup">United States 2017</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=129"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2015.png" alt="Unites States-Canada 2015"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=129">Unites States-Canada 2015</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=130"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2013.png" alt="Unites States 2013"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=130">Unites States 2013</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=131"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2011.png" alt="Unites States 2011"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=131">Unites States 2011</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=132"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2009.png" alt="Unites States 2009"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=132">United States 2009</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=133"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2007.png" alt="Unites States 2007"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=133">United States 2007</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=134"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2005.png" alt="Unites States 2005"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=134">Unites States 2005</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=135"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2003.png" alt="Unites States-Mexico 2003"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=135">Unites States-Mexico 2003</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=136"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2002.png" alt="Unites States 2002"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=136">Unites States 2002</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=137"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_2000.png" alt="Unites States 2000"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=137">United States 2000</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=138"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_1998.png" alt="Unites States 1998"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=138">United States 1998</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=139"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_1996.png" alt="Unites States 1996"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=139">Unites States 1996</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=140"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_1993.jpg" alt="Unites States-Mexico 1993"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=140">Unites States-Mexico 1993</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="GoldCup?tid=141"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/gc_logos/gc_1991.jpg" alt="Unites States 1991"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=141">Unites States 1991</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=142">CONCACAF 1989</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=143">CONCACAF 1985</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=144">Honduras 1981</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=145">Mexico 1977</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=146">Haiti 1973</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=147">Trinidad and Tobago 1971</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=148">Costa Rica 1969</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=149">Honduras 1967</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=150">Guatemala 1965</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="GoldCup?tid=151">El Salvador 1963</a></h5>
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
