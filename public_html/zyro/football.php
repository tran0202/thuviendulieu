<!DOCTYPE html>
<html lang="en">
<head>
    <title>TVDL - NFL</title>
    <?php include_once('header.inc.php'); ?>
	<link href="css/3.css?ts=1520882525" rel="stylesheet" type="text/css" />
    <link href="css/footer.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="header" id="myHeader">
        <div class="vbox wb_container" id="wb_header">
            <div class="wb_cont_inner">
                <div id="wb_element_instance22" class="wb_element wb_element_picture">
                    <a href=""><img alt="gallery/football" src="gallery_gen/8cd979f289c541d79d7ea74cf4b31f3e.png"></a>
                </div>
                <div id="wb_element_instance21" class="wb_element" style=" line-height: normal;">
                    <h4 class="wb-stl-pagetitle"><span class="wb_tr_ok">We Call It Soccer</span></h4>
                </div>
                <div id="wb_element_instance20" class="wb_element wb-menu">
                    <ul class="hmenu">
                        <li><a href="" target="_self">Home</a></li>
                        <li><a href="Russia2018/" target="_self">Russia 2018</a></li>
                        <li class="active"><a href="NFL/" target="_self">NFL</a></li>
                        <li><a href="2017USOpenMensSingles/" target="_self">2017 US Open Men's Singles</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="wb_cont_outer"></div>
            <div class="wb_cont_bg"></div>
        </div>
    </div>
	<div class="root content">
		<div class="vbox wb_container" id="wb_main">
			<div class="wb_cont_inner">
				<div id="wb_element_instance24" class="wb_element" style=" line-height: normal;height: unset;">
                    <div>
                        <h1 class="wb-stl-heading1"><span style="color:#cc0000;"><span class="wb_tr_ok">NFL</span></span></h1>
                    </div>
                    <div>
                        <?php
                        include_once('tpl.team.php');
                        $teams = array();
                        include_once('config.php');
                        $output = '';
                        $sql = 'SELECT t.name AS name, team_id, ' .
                            'group_id, g.name AS group_name, group_order, ' .
                            'parent_group_id, pg.name AS parent_group_name, pg.long_name AS parent_group_long_name, parent_group_order, tt.tournament_id ' .
                            'FROM team_tournament tt ' .
                            'LEFT JOIN team t ON t.id = tt.team_id ' .
                            'LEFT JOIN `group` g ON g.id = tt.group_id ' .
                            'LEFT JOIN `group` pg ON pg.id = tt.parent_group_id ' .
                            'WHERE tt.tournament_id = 2 ' .
                            'ORDER BY parent_group_name, group_id, group_order';

                        $query = $connection -> prepare($sql);
                        $query -> execute();
                        $count = $query -> rowCount();
                        if ($count != 0) {
                            while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
                                $team = new Team($row['name'], $row['group_name'], $row['group_order'], $row['parent_group_long_name'], $row['parent_group_order']);
                                $teams[$row['parent_group_long_name']][$row['parent_group_name'].' '.$row['group_name']][$row['group_order']] = $team;
                            }
                        }
                        else {
                            $output = '<h2>No result found!</h2>';
                        }
                        foreach ($teams as $parent_group_long_name => $_conferences) {
                            $output .= '<div class="stageTitle margin-top">'.$parent_group_long_name.'</div>';
                            foreach ($_conferences as $group_name => $_divisions) {
                                $output .= '<div class="groupTitle margin-top">'.$group_name.'</div>';
                                $output .= '<div class="groupBox">';
                                foreach ($_divisions as $group_order => $_team) {
                                    $output .= '<div class="groupRow2 margin-top margin-bottom">' . $_team->name . '</div>';
                                }
                                $output .= '</div>';
                            }
                        }
                        ?>
                        <?php echo $output; ?>
                        <p> </p>
                    </div>
				</div>
				<div id="wb_element_instance25" class="wb_element wb_element_picture"><!--<img alt="gallery/rush-1335365_1280" src="gallery_gen/deaceea944c1e5c8faa97dbc938638a2_330x230.jpg">--></div>
				<div id="wb_element_instance26" class="wb_element wb_element_picture"><!--<img alt="gallery/soccer-933037_1280" src="gallery_gen/9f1f8dd4b573022ccb5f58534e63c223_340x230.jpg">--></div>
				<div id="wb_element_instance27" class="wb_element wb_element_picture"><!--<img alt="gallery/football-452569_640" src="gallery_gen/02aca76cc69c5b3f26f749b67d453d64_340x230.jpg">--></div>
				<div id="wb_element_instance28" class="wb_element" style=" line-height: normal;"><!--<p class="wb-stl-normal"><span style="color:#ffffff;">You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form...</span></p>--></div>
				<div id="wb_element_instance29" class="wb_element" style=" line-height: normal;"><!--<p class="wb-stl-normal"><span style="color:#ffffff;">You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best...</span></p>--></div>
				<div id="wb_element_instance30" class="wb_element wb_element_shape"></div>
                <?php include_once('comments.inc.php'); ?>
			</div>
			<div class="wb_cont_outer"></div>
			<div class="wb_cont_bg"></div>
		</div>
        <?php include_once('footer.inc.php'); ?>
	</div>
	{{hr_out}}
</body>
</html>
