<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>TVDL - Russia 2018</title>
	<base href="{{base_url}}" />
	<meta name="viewport" content="width=1200" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!-- Facebook Open Graph -->
	<meta name="og:title" content="Soccer" />
	<meta name="og:description" content="" />
	<meta name="og:image" content="" />
	<meta name="og:type" content="article" />
	<meta name="og:url" content="{{curr_url}}" />
	<!-- Facebook Open Graph end -->
		
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/main.js?v=20180222164022" type="text/javascript"></script>

	<link href="css/font-awesome/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
	<link href="css/site.css?v=20180308163726" rel="stylesheet" type="text/css" />
	<link href="css/common.css?ts=1520882525" rel="stylesheet" type="text/css" />
	<link href="css/2.css?ts=1520882525" rel="stylesheet" type="text/css" />
	{{ga_code}}
	<link rel="shortcut icon" href="/gallery/tvdl_favicon-ts1520881176.png" type="image/png" />
	<script type="text/javascript">var currLang = '';</script>	
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<![endif]-->
    <?php include_once('header.php'); ?>
    <link href="css/footer.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="header" id="myHeader">
        <div class="vbox wb_container" id="wb_header">
            <div class="wb_cont_inner">
                <div id="wb_element_instance12" class="wb_element wb_element_picture">
                    <a href=""><img alt="gallery/football" src="gallery_gen/8cd979f289c541d79d7ea74cf4b31f3e.png"></a>
                </div>
                <div id="wb_element_instance11" class="wb_element" style=" line-height: normal;">
                    <h4 class="wb-stl-pagetitle"><span class="wb_tr_ok">We Call It Soccer</span></h4>
                </div>
                <div id="wb_element_instance10" class="wb_element wb-menu">
                    <ul class="hmenu">
                        <li><a href="" target="_self">Home</a></li>
                        <li class="active"><a href="Russia2018/" target="_self">Russia 2018</a></li>
                        <li><a href="NFL/" target="_self">NFL</a></li>
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
				<div id="wb_element_instance14" class="wb_element wb_element_shape"></div>
				<div id="wb_element_instance15" class="wb_element" style=" line-height: normal;height: unset;">
                    <div>
                        <span class="wb-stl-heading1" style="color:#930c10;"><span class="wb_tr_ok">FIFA World Cup Russia 2018</span></span>
                        <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018/" target="_self">Groups</a></span>
                        <span class="wb-stl-heading3 margin-left-lg"><a href="Russia2018Schedule/" target="_self">Schedule</a></span>
                    </div>
                    <div>
                        <?php
                        include_once('tpl.team.php');
                        $teams = array();
                        include_once('config.php');
                        $output = '';
                        $sql = 'SELECT UCASE(t.name) AS name, team_id, ' .
                            'group_id, UCASE(g.name) AS group_name, ' .
                            'group_order, tt.tournament_id ' .
                            'FROM team_tournament tt ' .
                            'LEFT JOIN team t ON t.id = tt.team_id ' .
                            'LEFT JOIN `group` g ON g.id = tt.group_id ' .
                            'WHERE tt.tournament_id = 1 ' .
                            'ORDER BY group_id, group_order';
                        $query = $connection -> prepare($sql);
                        $query -> execute();
                        $count = $query -> rowCount();
                        if ($count != 0) {
                            while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
                                $team = new Team($row['name'], $row['group_name'], $row['group_order']);
                                $teams[$row['group_name']][$row['group_order']] = $team;
                            }
                        }
                        else {
                            $output = '<h2>No result found!</h2>';
                        }
                        foreach ($teams as $group_name => $_teams) {
                            $output .= '<div class="col-sm-12 margin-top">';
                            $output .= '<span class="col-sm-2 groupTitle">Group '.$group_name.'</span>';
                            $output .= '<span class="col-sm-2 wb-stl-heading4 margin-left-md" style="margin-top: 18px;">';
                            $output .= '<a class="link-modal" data-toggle="modal" data-target="#groupMatchesModal">Matches</a>';
                            $output .= '</span>';
                            $output .= '</div>';
                            $output .= '<div class="col-sm-12 groupBox">';
                            foreach ($_teams as $group_order => $_team) {
                                $output .= '<div class="groupRow margin-top margin-bottom">'.$_team -> name.'</div>';
                            }
                            $output .= '</div>';
                        }
                        ?>
                        <?php echo $output; ?>
                        <p class="wb-stl-normal"> </p>
                        <p class="wb-stl-normal"> </p>
                    </div>
				</div>
				<div id="wb_element_instance18" class="wb_element" style="width: 100%;">
					<?php
						global $show_comments;
						if (isset($show_comments) && $show_comments) {
							renderComments(2);
					?>
					<script type="text/javascript">
						$(function() {
							var block = $("#wb_element_instance18");
							var comments = block.children(".wb_comments").eq(0);
							var contentBlock = $("#wb_main");
							contentBlock.height(contentBlock.height() + comments.height());
						});
					</script>
					<?php
						} else {
					?>
					<script type="text/javascript">
						$(function() {
							$("#wb_element_instance18").hide();
						});
					</script>
					<?php
						}
					?>
				</div>
			</div>
			<div class="wb_cont_outer"></div>
			<div class="wb_cont_bg"></div>
		</div>
        <?php include_once('footer.php'); ?>
	</div>
    <!-- Modal -->
    <div class="modal fade" id="groupMatchesModal" tabindex="-1" role="dialog" aria-labelledby="groupMatchesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupMatchesModalLabel">Matches of Group A</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="groupMatchesModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--                    <button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>
	{{hr_out}}
</body>
</html>
