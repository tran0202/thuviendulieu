<?php
    include_once('class.tournament.php');
    $tournament = Tournament::getAllTimeSoccerTournament(Tournament::COPA_AMERICA);
    $body_html = $tournament->getBodyHtml();
    $popover_html = $tournament->getPopoverHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - Copa America Archive</title>
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
                            <p class="wb-stl-highlight text-center dark-red">Copa America Archive</p>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-2019.png" alt="Brazil 2019">
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Brazil 2019</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-centenario.png" alt="United States 2016 Centenario"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica">United States 2016 Centenario</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=84"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-2015.png" alt="Chile 2015"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=84">Chile 2015</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=85"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-2011.png" alt="Argentina 2011"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=85">Argentina 2011</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=86"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-2007.png" alt="Venezuela 2007"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=86">Venezuela 2007</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=87"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-2004.png" alt="Peru 2004"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=87">Peru 2004</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=88"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-2001.png" alt="Colombia 2001"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=88">Colombia 2001</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=89"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-1999.png" alt="Paraguay 1999"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=89">Paraguay 1999</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=90"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-1997.png" alt="Bolivia 1997"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=90">Bolivia 1997</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=91"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/CONMEBOL.png" alt="Uruguay 1995"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=91">Uruguay 1995</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=92"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-1993.jpg" alt="Ecuador 1993"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=92">Ecuador 1993</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=93"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-1991.png" alt="Chile 1991"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=93">Chile 1991</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=94"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/copa_logos/copa-1989.png" alt="Brazil 1989"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=94">Brazil 1989</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=95"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/CONMEBOL.png" alt="Argentina 1987"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=95">Argentina 1987</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=96"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/CONMEBOL.png" alt="Pan-America 1983"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=96">Pan-America 1983</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <span class="mx-auto">
                                        <a href="CopaAmerica?tid=97"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/CONMEBOL.png" alt="Pan-America 1979"></a>
                                    </span>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=97">Pan-America 1979</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
<!--                                    <span class="mx-auto">-->
<!--                                        <a href="CopaAmerica?tid=98"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/CONMEBOL.png" alt="Pan-America 1975"></a>-->
<!--                                    </span>-->
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=98">Pan-America 1975</a></h5>
                                    </div>
                                </div>
                                <div class="card">
<!--                                    <span class="mx-auto">-->
<!--                                        <a href="CopaAmerica?tid=99"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/CONMEBOL.png" alt="Uruguay 1967"></a>-->
<!--                                    </span>-->
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=99">Uruguay 1967</a></h5>
                                    </div>
                                </div>
                                <div class="card">
<!--                                    <span class="mx-auto">-->
<!--                                        <a href="CopaAmerica?tid=100"><img class="card-img-top card-img-top-height-100 padding-top-sm" src="images/logos/CONMEBOL.png" alt="Bolivia 1963"></a>-->
<!--                                    </span>-->
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=100">Bolivia 1963</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=101">Ecuador 1959</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=102">Argentina 1959</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=103">Peru 1957</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=104">Uruguay 1956</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=105">Chile 1955</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=106">Peru 1953</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=107">Brazil 1949</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=108">Ecuador 1947</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=109">Argentina 1946</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=110">Chile 1945</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=111">Uruguay 1942</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=112">Chile 1941</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=113">Peru 1939</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=114">Argentina 1937</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=115">Peru 1935</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=116">Argentina 1929</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=117">Peru 1927</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=118">Chile 1926</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=119">Argentina 1925</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=120">Uruguay 1924</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=121">Uruguay 1923</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=122">Brazil 1922</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=123">Argentina 1921</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=124">Chile 1920</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=125">Brazil 1919</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=126">Uruguay 1917</a></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="CopaAmerica?tid=127">Argentina 1916</a></h5>
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
