
$(document).ready(function(){

    //Larger thumbnail preview

    $("div.thumb .imgc").hover(function() {

        $(this).css({
            'z-index' : '10'
        }); /*Add a higher z-index value so this image stays on top*/
        $(this).find('img').addClass("hover").stop() /* Add class of "hover", then stop animation queue buildup*/

        .animate({
            marginTop: '-110px', /* The next 4 lines will vertically align this image */
            marginLeft: '-110px',
            top: '50%',
            left: '50%',
            width: '256px', /* Set new width */
            height: '192px', /* Set new height */
            padding: '20px'
        }, 200); /* this value of "200" is the speed of how fast/slow this hover animates */
        $(this).find('hover').append('<div id="curr"style="display:none;position:relative;left:-52px;margin-top:10px;border:0px solid black;width:256px;float:left;text-align:center;">HELLO</div>');
        $(this).find('curr').fadeIn();

    } , function() {
        console.log("junk");
        console.log($(this).find("img").attr("src"));
        $(this).css({
            'z-index' : '0'
        }); /* Set z-index back to 0 */
        $(this).find('img').removeClass("hover").stop()  /* Remove the "hover" class , then stop animation queue buildup*/
        .animate({
            marginTop: '0', /* Set alignment back to default */
            marginLeft: '0',
            top: '0',
            left: '0',
            width: '60px', /* Set width back to default */
            height: '45px', /* Set height back to default */
            padding: '5px'
        }, 400);
        $("#curr").remove();
    //$(this).attr({ src: uuid });
    });

    //Swap Image on Click
    $("div.thumb .imgc a").click(function() {

        var mainImage = $(this).attr("href"); //get the name from the href of the image clicked
        $("#main_view img").attr({
            src: mainImage
        });//change the src of id main_view to the gotten
        var uuid = mainImage.substring(32,68);
        console.log(uuid);
        $("#main_view a").attr({
            href: uuid
        });
        return false;
    });
    $("#main_view a").click(function() {

        alert();
        return false;
    });

});
