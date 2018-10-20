<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::AFRICA_CUP_OF_NATIONS);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Africa Cup of Nations Archive</title>
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
                            <p class="wb-stl-highlight text-center dark-red">Africa Cup of Nations Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2019.png" alt="Cameroon 2019">
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Cameroon 2019</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2017.png" alt="Gabon 2017"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup">Gabon 2017</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=153"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2015.png" alt="Equatorial Guinea 2015"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=153">Equatorial Guinea 2015</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=154"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2013.png" alt="South Africa 2013"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=154">South Africa 2013</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=155"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2012.png" alt="Gabon-Equatorial Guinea 2012"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=155">Gabon-Equatorial Guinea 2012</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=156"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2010.png" alt="Angola 2010"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=156">Angola 2010</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=157"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2008.png" alt="Ghana 2008"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=157">Ghana 2008</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=158"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2006.png" alt="Egypt 2006"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=158">Egypt 2006</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=159"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2004.png" alt="Tunisia 2004"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=159">Tunisia 2004</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=160"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2002.png" alt="Mali 2002"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=160">Mali 2002</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=162"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_2000.png" alt="Ghana-Nigeria 2000"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=162">Ghana-Nigeria 2000</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=164"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_1998.png" alt="Burkina Faso 1998"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=164">Burkina Faso 1998</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=165"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_1996.jpg" alt="South Africa 1996"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=165">South Africa 1996</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=166"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/Africa_Cup_of_Nations.png" alt="Tunisia 1994"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=166">Tunisia 1994</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=167"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/Africa_Cup_of_Nations.png" alt="Senegal 1992"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=167">Senegal 1992</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=168"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_1990.png" alt="Algeria 1990"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=168">Algeria 1990</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=169"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_1988.png" alt="Morocco 1988"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=169">Morocco 1988</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=170"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/Africa_Cup_of_Nations.png" alt="Egypt 1986"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=170">Egypt 1986</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=171"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_1984.png" alt="Côte d'Ivoire 1984"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=171">Ivory Coast 1984</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="AfricaCup?tid=172"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/afcon_logos/afcon_1982.png" alt="Libya 1982"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=172">Libya 1982</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=173">Nigeria 1980</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=174">Ghana 1978</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=175">Ethiopia 1976</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=176">Egypt 1974</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=177">Cameroon 1972</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=178">Sudan 1970</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=179">Ethiopia 1968</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=180">Tunisia 1965</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=181">Ghana 1963</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=182">Ethiopia 1962</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=183">United Arab Republic 1959</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="AfricaCup?tid=184">Sudan 1957</a></h5>
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
