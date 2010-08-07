
$(document).ready(function(){

    //Larger thumbnail preview

    $("div.imgcont").hover(function() {

        $(this).css({
            'z-index' : '10'
        }); /*Add a higher z-index value so this image stays on top*/
        $(this).addClass("hover").stop() /* Add class of "hover", then stop animation queue buildup*/
        .animate({
            marginTop: '-55px', /* The next 4 lines will vertically align this image */
            marginLeft: '-55px',
            top: '50%',
            left: '50%',
            width: '256px', /* Set new width */
            height: '192px', /* Set new height */
            padding: '20px'
        }, 200); /* this value of "200" is the speed of how fast/slow this hover animates */
        $(this).append('<div id="curr">HELLO</div>');
        //$(this).find('curr').fadeIn();

    } , function() {
        $(this).removeClass("hover").stop()  /* Remove the "hover" class , then stop animation queue buildup*/
        .animate({
            marginTop: '0', /* Set alignment back to default */
            marginLeft: '0',
            top: '0',
            left: '0',
            width: '60px', /* Set width back to default */
            height: '45px', /* Set height back to default */
            padding: '5px'
        }, 400);
        $(this).css({
            'z-index' : '0'
        });
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
