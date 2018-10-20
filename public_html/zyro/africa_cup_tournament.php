<?php
    include_once('class.tournament.php');
    parse_str($_SERVER['QUERY_STRING'], $query_string);
    $tournament_id = SoccerHtml::GABON_2017;
    if (isset($query_string['tid'])) $tournament_id = $query_string['tid'];
    $tournament = Tournament::getSoccerTournament($tournament_id);
    $profile = $tournament->getProfile();
    $header = TournamentProfile::getTournamentHeader($profile);
    $tournament_name = '';
    if ($profile != null) $tournament_name = $profile->getName();
    $body_html = $tournament->getBodyHtml();
    $modal_html = $tournament->getModalHtml();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - <?php echo $tournament_name; ?></title>
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
                        <div class="col-sm-12">
                            <span class="wb-stl-heading1"><?php echo $header; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo $body_html; ?>
                            <p class="wb-stl-normal"> </p>
                        </div>
                    </div>
                    <?php include_once('footer.inc.php'); ?>
                </div>
			</div>
		</div>
	</div>
    <!-- Modal -->
    <?php echo $modal_html; ?>
	{{hr_out}}
</body>
</html>
