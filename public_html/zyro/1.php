<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>TVDL - Home</title>
	<base href="{{base_url}}" />
		<meta name="viewport" content="width=1200" />
		<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!-- Facebook Open Graph -->
	<meta name="og:title" content="Home" />
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
	<link href="css/1.css?ts=1520882525" rel="stylesheet" type="text/css" />
	{{ga_code}}
	<link rel="shortcut icon" href="/gallery/tvdl_favicon-ts1520881176.png" type="image/png" />
	<script type="text/javascript">var currLang = '';</script>	
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<![endif]-->
</head>


<body>
	<div class="root">
		<div class="vbox wb_container" id="wb_header">
			<div class="wb_cont_inner">
                <div id="wb_element_instance2" class="wb_element wb_element_picture">
                    <a href=""><img alt="gallery/football" src="gallery_gen/8cd979f289c541d79d7ea74cf4b31f3e.png"></a>
                </div>
                <div id="wb_element_instance1" class="wb_element" style=" line-height: normal;">
                    <h4 class="wb-stl-pagetitle"><span class="wb_tr_ok">We Call It Soccer</span></h4>
                </div>
				<div id="wb_element_instance0" class="wb_element wb-menu">
					<ul class="hmenu">
						<li class="active"><a href="" target="_self">Home</a></li>
						<li><a href="Russia2018/" target="_self">Russia 2018</a></li>
						<li><a href="NFL/" target="_self">NFL</a></li>
						<li><a href="2017-US-Open-Mens-Singles/" target="_self">2017 US Open Men's Singles</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div id="wb_element_instance4" class="wb_element wb_element_picture">
					<img alt="gallery/ball_1" src="gallery_gen/740438132c8336073d625b0136159e8e_300x310.png">
				</div>
			</div>
			<div class="wb_cont_outer"></div>
			<div class="wb_cont_bg"></div>
		</div>
		<div class="vbox wb_container" id="wb_main">
			<div class="wb_cont_inner">
                <div id="wb_element_instance6" class="wb_element" style=" line-height: normal;">
                    <p class="wb-stl-normal" style="text-align: center;">
                        <span class="wb-stl-highlight"><span class="wb_tr_ok">Soccer</span></span>
                    </p>
                    <p class="wb-stl-normal"> </p>
                </div>
				<div id="wb_element_instance5" class="wb_element" style=" line-height: normal;">
					<h5 class="wb-stl-subtitle" style="text-align: center;"><span class="wb_tr_ok">More than a game</span></h5>
				</div>
				<div id="wb_element_instance7" class="wb_element" style="width:470px;">
					<a class="wb_button" href="Russia2018/" style="display:inline-block;"><span>FIFA World Cup Russia 2018</span></a>
					<a class="wb_button" href="NFL/" style="display:inline-block;"><span>NFL</span></a>
					<a class="wb_button" href="2017-US-Open-Mens-Singles/" style="display:inline-block;"><span>2017 US Open Men's Singles</span></a>
				</div>
				<div id="wb_element_instance8" class="wb_element" style="width: 100%;">
					<?php
						global $show_comments;
						if (isset($show_comments) && $show_comments) {
							renderComments(1);
					?>
					<script type="text/javascript">
						$(function() {
							var block = $("#wb_element_instance8");
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
							$("#wb_element_instance8").hide();
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
				<div id="wb_element_instance3" class="wb_element" style=" line-height: normal;">
					<p class="wb-stl-footer">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p>
				</div>
				<div id="wb_element_instance9" class="wb_element" style="text-align: center; width: 100%;">
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
