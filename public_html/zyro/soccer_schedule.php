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
                        include_once('tpl.match.php');
                        $matches = array();
                        include_once('config.php');
                        $output = '';
                        $sql = 'SELECT t.name AS home_team_name, home_team_score,
                                    t2.name AS away_team_name, away_team_score,
                                    DATE_FORMAT(match_date, "%W %M %d") as match_date_fmt, match_date, 
                                    TIME_FORMAT(match_time, "%H:%i") as match_time, match_order,
                                    g.name AS round, g2.name AS stage,
                                    g3.name AS group_name, m.tournament_id
                                FROM `match` m
                                    LEFT JOIN team t ON t.id = m.home_team_id
                                    LEFT JOIN team t2 ON t2.id = m.away_team_id
                                    LEFT JOIN `group` g ON g.id = m.round_id
                                    LEFT JOIN `group` g2 ON g2.id = m.stage_id
                                    LEFT JOIN team_tournament tt ON tt.team_id = m.home_team_id
                                    LEFT JOIN `group` g3 ON g3.id = tt.group_id
                                WHERE m.tournament_id = 1
                                ORDER BY stage_id, round_id, match_date, match_time;';
                        $query = $connection -> prepare($sql);
                        $query -> execute();
                        $count = $query -> rowCount();
                        if ($count != 0) {
                            while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
                                $match = new Match($row['home_team_name'], $row['away_team_name'],
                                    $row['match_date'], $row['match_date_fmt'], $row['match_time'], $row['match_order'],
                                    $row['round'], $row['stage'], $row['group_name']);
                                $matches[$row['round']][$row['match_date']][$row['match_order']] = $match;
                            }
                        }
                        else {
                            $output = '<h2>No result found!</h2>';
                        }
                        foreach ($matches as $rounds => $_round) {
                        $output .= '<div class="stageTitle margin-top">'.$rounds.'</div>';
                            foreach ($_round as $match_dates => $_matches) {
                                $output .= '<div class="col-sm-12 groupTitle2 margin-top-md">'
                                    .$_matches[array_keys($_matches)[0]] -> match_date_fmt.'</div>';
                                foreach ($_matches as $match_order => $_match) {
                                    $output .= '<div class="col-sm-12 margin-top margin-bottom border-bottom">'.
                                        '<div class="col-sm-2" style="margin-top: 6px;">'.$_match -> match_time.' CST<br>Group '.$_match -> group_name.'</div>'.
                                        '<div class="col-sm-3 groupRow">'.$_match -> home_team_name.'</div>'.
                                        '<div class="col-sm-2 groupRow">vs</div>'.
                                        '<div class="col-sm-3 groupRow">'.$_match -> away_team_name.'</div>'.
                                        '</div>';
                                }
                            }
                        }
                        ?>
                        <?php echo $output; ?>
                        <p class="wb-stl-normal"> </p>
                        <p class="wb-stl-normal"> </p>
                    </div>
				</div>
				<div id="wb_element_instance16" class="wb_element wb_element_picture"><!--<img alt="gallery/football-1331838_1280" src="gallery_gen/6ed42b3cb0b0176b0c634015141cc98d_450x250.jpg">--></div>
				<div id="wb_element_instance17" class="wb_element wb_element_picture"><!--<img alt="gallery/football-1276327_1280" src="gallery_gen/843428bf7f3e0f675942187cea07bff3_440x300.jpg">--></div>
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
		<div class="vbox wb_container" id="wb_footer">
			<div class="wb_cont_inner" style="height: 130px;">
				<div id="wb_element_instance13" class="wb_element" style=" line-height: normal;">
					<p class="wb-stl-footer">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
				</div>
				<div id="wb_element_instance19" class="wb_element" style="text-align: center; width: 100%;">
					<div class="wb_footer"></div>
					<script type="text/javascript">
						$(function() {
							var footer = $(".wb_footer");
							var html = (footer.html() + "").replace(/^\s+|\s+$/g, "");
							if (!html) {
								footer.parent().remove();
								footer = $("#wb_footer, #wb_footer .wb_cont_inner");
								footer.css({height: ""});
							}
						});
					</script>
				</div>
			</div>
			<div class="wb_cont_outer"></div>
			<div class="wb_cont_bg"></div>
		</div>
		<div class="wb_sbg"></div>
	</div>
	{{hr_out}}
</body>
</html>
