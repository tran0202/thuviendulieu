<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Teams</title>
	<base href="{{base_url}}" />
			<meta name="viewport" content="width=1200" />
		<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!-- Facebook Open Graph -->
	<meta name="og:title" content="Teams" />
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
	{{ga_code}}<link rel="shortcut icon" href="/gallery/tvdl_favicon-ts1520881176.png" type="image/png" />
	<script type="text/javascript">var currLang = '';</script>	
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<![endif]-->
</head>


<body><div class="root"><div class="vbox wb_container" id="wb_header">
	
<div class="wb_cont_inner"><div id="wb_element_instance10" class="wb_element wb-menu"><ul class="hmenu"><li><a href="" target="_self">Home</a></li><li class="active"><a href="Russia2018/" target="_self">Russia 2018</a></li><li><a href="Events/" target="_self">Events</a></li><li><a href="New-Content/" target="_self">New Content</a><ul><li><a href="New-Link/" target="_self">New Link</a></li></ul></li></ul><div class="clearfix"></div></div><div id="wb_element_instance11" class="wb_element" style=" line-height: normal;"><h4 class="wb-stl-pagetitle"><span class="wb_tr_ok">We Call It Soccer</span></h4></div><div id="wb_element_instance12" class="wb_element wb_element_picture"><a href=""><img alt="gallery/football" src="gallery_gen/8cd979f289c541d79d7ea74cf4b31f3e.png"></a></div></div><div class="wb_cont_outer"></div><div class="wb_cont_bg"></div></div>
<div class="vbox wb_container" id="wb_main">
	
<div class="wb_cont_inner"><div id="wb_element_instance14" class="wb_element wb_element_shape"><div class="wb_shp"></div></div><div id="wb_element_instance15" class="wb_element" style=" line-height: normal;"><h1 class="wb-stl-heading1"><span style="color:#ffffff;"><span class="wb_tr_ok">FIFA World Cup Russia 2018</span></span></h1>
<?php
	include_once('config.php');
	$output = '';
	$sql = 'SELECT * FROM `team`';
    $query = $connection->prepare($sql);
	$query->execute();
	$count = $query->rowCount();
	if ($count != 0) {
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$output .= '<h2>'.$row['id'].' '.$row['name'].'</h2><br>';
		}
	} 
	else {
		$output = '<h2>No result found!</h2>';
	}
?>
<?php echo $output; ?>
<p class="wb-stl-normal"> </p>
<p class="wb-stl-normal"><span style="color:#ffffff;">You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us...</span><a href="Teams/"><span style="color:#ffffff;">Please fill the contact form on...</span></a><span style="color:#ffffff;">Our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to...</span></p>
<p class="wb-stl-normal"> </p>
<p class="wb-stl-normal"><span style="color:#ffffff;">Contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best solution that helps everyone. If you want to contact us, please fill the contact form on our website. We wish you a good day! You will find the latest information about us on this page. Our company is constantly evolving and growing. We provide wide range of services. Our mission is to provide best...</span></p></div><div id="wb_element_instance16" class="wb_element wb_element_picture"><img alt="gallery/football-1331838_1280" src="gallery_gen/6ed42b3cb0b0176b0c634015141cc98d_450x250.jpg"></div><div id="wb_element_instance17" class="wb_element wb_element_picture"><img alt="gallery/football-1276327_1280" src="gallery_gen/843428bf7f3e0f675942187cea07bff3_440x300.jpg"></div><div id="wb_element_instance18" class="wb_element" style="width: 100%;">
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
			</div></div><div class="wb_cont_outer"></div><div class="wb_cont_bg"></div></div>
<div class="vbox wb_container" id="wb_footer">
	
<div class="wb_cont_inner" style="height: 130px;"><div id="wb_element_instance13" class="wb_element" style=" line-height: normal;"><p class="wb-stl-footer">© 2018 <a href="http://thuviendulieu.000webhostapp.com">thuviendulieu.000webhostapp.com</a></p></div><div id="wb_element_instance19" class="wb_element" style="text-align: center; width: 100%;"><div class="wb_footer"></div><script type="text/javascript">
			$(function() {
				var footer = $(".wb_footer");
				var html = (footer.html() + "").replace(/^\s+|\s+$/g, "");
				if (!html) {
					footer.parent().remove();
					footer = $("#wb_footer, #wb_footer .wb_cont_inner");
					footer.css({height: ""});
				}
			});
			</script></div></div><div class="wb_cont_outer"></div><div class="wb_cont_bg"></div></div><div class="wb_sbg"></div></div>{{hr_out}}</body>
</html>
