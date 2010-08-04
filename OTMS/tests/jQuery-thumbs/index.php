
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Fancy Thumbnail Hover Effect w/ jQuery - by Soh Tanaka</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                //Larger thumbnail preview

                $("div.thumb .imgc").hover(function() {
                    $(this).css({'z-index' : '10'}); /*Add a higher z-index value so this image stays on top*/
                    $(this).find('img').addClass("hover").stop() /* Add class of "hover", then stop animation queue buildup*/
                    .animate({
                        marginTop: '-110px', /* The next 4 lines will vertically align this image */
                        marginLeft: '-110px',
                        top: '50%',
                        left: '50%',
                        width: '200px', /* Set new width */
                        height: '200px', /* Set new height */
                        padding: '20px'
                    }, 200); /* this value of "200" is the speed of how fast/slow this hover animates */

                } , function() {
                    $(this).css({'z-index' : '0'}); /* Set z-index back to 0 */
                    $(this).find('img').removeClass("hover").stop()  /* Remove the "hover" class , then stop animation queue buildup*/
                    .animate({
                        marginTop: '0', /* Set alignment back to default */
                        marginLeft: '0',
                        top: '0',
                        left: '0',
                        width: '100px', /* Set width back to default */
                        height: '100px', /* Set height back to default */
                        padding: '5px'
                    }, 400);
                });

                //Swap Image on Click
                $("div.thumb .imgc a").click(function() {

                    var mainImage = $(this).attr("href"); //Find Image Name
                    $("#main_view img").attr({ src: mainImage });
                    return false;
                });

            });
        </script>
    </head>

    <body>
        <div class="container">
            <div class="thumb">
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>
                <div class="imgc"><a href="main_image1.jpg"><img src="thumb1.jpg" alt="" /></a></div>


                </div>
                <div id="main_view">
                    <a href="http://www.DesignBombs.com" title="Design Bombs - Web Gallery" target="_blank"><img src="main_image1.jpg" alt="" /></a><br />
            <!--	<small style="float: right; color: #999;">Tutorial by <a style="color: #777;" href="http://www.SohTanaka.com">Soh Tanaka</a></small>-->
                </div>
            </div>
        </div>
    </body>
</html> 
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
