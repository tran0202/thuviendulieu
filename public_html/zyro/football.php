<!DOCTYPE html>
<?php
    include_once('class.team.php');
    $team_dto = Team::getFootballTeams(2);
    $output = $team_dto->getHtml();
?>
<html lang="en">
<head>
    <title>TVDL - NFL</title>
    <?php include_once('header_script.inc.php'); ?>
</head>
<body>
    <div class="header" id="page-header">
        <div class="vbox wb_container" id="wb_header">
            <div class="wb_cont_inner">
                <?php include_once('logo.inc.php'); ?>
                <?php include_once('menu3.inc.php'); ?>
            </div>
        </div>
    </div>
	<div class="root content">
		<div class="vbox wb_container" id="wb_main">
			<div class="wb_cont_inner">
                <div>
                    <h1 class="wb-stl-heading1 red">NFL</h1>
                </div>
                <div>
                    <?php echo $output; ?>
                    <p> </p>
                </div>
                <div class="col-sm-12 margin-tb-lg">
                    <p class="wb-stl-footer black">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
                </div>
			</div>
		</div>
	</div>
	{{hr_out}}
</body>
</html>
