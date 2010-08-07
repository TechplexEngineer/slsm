<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fancy Thumbnail Hover Effect w/ jQuery - by Soh Tanaka</title>
<style type="text/css">
body {
	font: Arial, Helvetica, sans-serif normal 10px;
	margin: 0; padding: 0;
}
* {margin: 0; padding: 0;}
img {border: none;}
/*.container {
	height: 360px;
	width: 910px;
	margin: -180px 0 0 -450px;
	top: 50%; left: 50%;
	position: absolute;
}*/
ul.thumb { /*this is the img container */
	float: left;
	list-style: none;
	margin: 0; padding: 10px;
/*	width: 360px;*/
}
ul.thumb li {/*this is imgcont*/
	margin: 0; padding: 5px;
	float: left;
	position: relative;
	width: 110px;
	height: 110px;
}
ul.thumb li img { /*This si the image itself*/
	width: 100px; height: 100px;
	border: 1px solid #ddd;
	padding: 5px;
	background: #f0f0f0;
	position: absolute;
	left: 0; top: 0;
	-ms-interpolation-mode: bicubic;
}
ul.thumb li img.hover { /*This is what happens when the image is hovered*/
	background:url(thumb_bg.png) no-repeat center center;
	border: none;
}
#main_view {
	float: left;
	padding: 9px 0;
	margin-left: -10px;
}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){

//Larger thumbnail preview

$("ul.thumb li").hover(function() {
	$(this).css({'z-index' : '10'});
	$(this).find('img').addClass("hover").stop()
		.animate({
			marginTop: '-110px',
			marginLeft: '-110px',
			top: '50%',
			left: '50%',
			width: '174px',
			height: '174px',
			padding: '20px'
		}, 200);

	} , function() {
	$(this).css({'z-index' : '0'});
	$(this).find('img').removeClass("hover").stop()
		.animate({
			marginTop: '0',
			marginLeft: '0',
			top: '0',
			left: '0',
			width: '100px',
			height: '100px',
			padding: '5px'
		}, 400);
});

//Swap Image on Click
	$("ul.thumb li a").click(function() {

		var mainImage = $(this).attr("href"); //Find Image Name
		$("#main_view img").attr({ src: mainImage });
		return false;
	});

});
</script>
</head>

<body>
<div class="container">
<ul class="thumb">
	<li><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></li>
	<li><a href="main_image2.jpg"><img src="thumb2.jpg" alt="" /></a></li>
	<li><a href="main_image3.jpg"><img src="thumb3.jpg" alt="" /></a></li>
	<li><a href="main_image4.jpg"><img src="thumb4.jpg" alt="" /></a></li>
	<li><a href="main_image5.jpg"><img src="thumb5.jpg" alt="" /></a></li>
	<li><a href="main_image6.jpg"><img src="thumb6.jpg" alt="" /></a></li>
	<li><a href="main_image7.jpg"><img src="thumb7.jpg" alt="" /></a></li>
	<li><a href="main_image8.jpg"><img src="thumb8.jpg" alt="" /></a></li>
	<li><a href="main_image9.jpg"><img src="thumb9.jpg" alt="" /></a></li>
        <li><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></li>
	<li><a href="main_image2.jpg"><img src="thumb2.jpg" alt="" /></a></li>
	<li><a href="main_image3.jpg"><img src="thumb3.jpg" alt="" /></a></li>
	<li><a href="main_image4.jpg"><img src="thumb4.jpg" alt="" /></a></li>
	<li><a href="main_image5.jpg"><img src="thumb5.jpg" alt="" /></a></li>
	<li><a href="main_image6.jpg"><img src="thumb6.jpg" alt="" /></a></li>
	<li><a href="main_image7.jpg"><img src="thumb7.jpg" alt="" /></a></li>
	<li><a href="main_image8.jpg"><img src="thumb8.jpg" alt="" /></a></li>
	<li><a href="main_image9.jpg"><img src="thumb9.jpg" alt="" /></a></li>
        <li><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></li>
	<li><a href="main_image2.jpg"><img src="thumb2.jpg" alt="" /></a></li>
	<li><a href="main_image3.jpg"><img src="thumb3.jpg" alt="" /></a></li>
	<li><a href="main_image4.jpg"><img src="thumb4.jpg" alt="" /></a></li>
	<li><a href="main_image5.jpg"><img src="thumb5.jpg" alt="" /></a></li>
	<li><a href="main_image6.jpg"><img src="thumb6.jpg" alt="" /></a></li>
	<li><a href="main_image7.jpg"><img src="thumb7.jpg" alt="" /></a></li>
	<li><a href="main_image8.jpg"><img src="thumb8.jpg" alt="" /></a></li>
	<li><a href="main_image9.jpg"><img src="thumb9.jpg" alt="" /></a></li>
        <li><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></li>
	<li><a href="main_image2.jpg"><img src="thumb2.jpg" alt="" /></a></li>
	<li><a href="main_image3.jpg"><img src="thumb3.jpg" alt="" /></a></li>
	<li><a href="main_image4.jpg"><img src="thumb4.jpg" alt="" /></a></li>
	<li><a href="main_image5.jpg"><img src="thumb5.jpg" alt="" /></a></li>
	<li><a href="main_image6.jpg"><img src="thumb6.jpg" alt="" /></a></li>
	<li><a href="main_image7.jpg"><img src="thumb7.jpg" alt="" /></a></li>
	<li><a href="main_image8.jpg"><img src="thumb8.jpg" alt="" /></a></li>
	<li><a href="main_image9.jpg"><img src="thumb9.jpg" alt="" /></a></li>
        <li><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></li>
	<li><a href="main_image2.jpg"><img src="thumb2.jpg" alt="" /></a></li>
	<li><a href="main_image3.jpg"><img src="thumb3.jpg" alt="" /></a></li>
	<li><a href="main_image4.jpg"><img src="thumb4.jpg" alt="" /></a></li>
	<li><a href="main_image5.jpg"><img src="thumb5.jpg" alt="" /></a></li>
	<li><a href="main_image6.jpg"><img src="thumb6.jpg" alt="" /></a></li>
	<li><a href="main_image7.jpg"><img src="thumb7.jpg" alt="" /></a></li>
	<li><a href="main_image8.jpg"><img src="thumb8.jpg" alt="" /></a></li>
	<li><a href="main_image9.jpg"><img src="thumb9.jpg" alt="" /></a></li>
</ul>
<div id="main_view">
	<a href="http://www.DesignBombs.com" title="Design Bombs - Web Gallery" target="_blank"><img src="main_image1.jpg" alt="" /></a><br />
<!--	<small style="float: right; color: #999;">Tutorial by <a style="color: #777;" href="http://www.SohTanaka.com">Soh Tanaka</a></small>-->
</div>
</div>


</body>
</html> 