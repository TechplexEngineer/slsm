
$(document).ready(function(){

    //Larger thumbnail preview

    $("div.imgcont").hover(function() {
        $(this).addClass("curr");
        $(this).css({
            'z-index' : '10'
        }); /*Add a higher z-index value so this image stays on top*/
        $(this).find('img').addClass("hover").stop() /* Add class of "hover", then stop animation queue buildup*/
        .animate({
            marginTop: '-0px', /* The next 4 lines will vertically align this image */
            marginLeft: '-55px',
            top: '50%',
            left: '50%',
            width: '256px', /* Set new width */
            height: '192px', /* Set new height */
            padding: '10px'
        }, 200); /* this value of "200" is the speed of how fast/slow this hover animates */
        $(this).addClass("curr"); //THis is so we can ref the curr hovered element
        //changes the image to a larger version for clarity
        var mainImage = $(this).find("img").attr("src");
        var uuid = mainImage.substring(32,68);
        var size = 2;
        $(this).find('img').attr({
            src: "http://secondlife.com/app/image/" +uuid+ "/" +size 
        });
    } , function() {
        
        $(this).find('img').removeClass("hover").stop()  /* Remove the "hover" class , then stop animation queue buildup*/
        .animate({
            marginTop: '0', /* Set alignment back to default */
            marginLeft: '0',
            top: '0',
            left: '0',
            width: '60px', /* Set width back to default */
            height: '45px', /* Set height back to default */
            padding: '5px'
        }, 400, function(){
            $(this).parent().parent().css({'z-index' : '0'})
        });
        //Put back the small image
        var mainImage = $(this).find("img").attr("src");
        var uuid = mainImage.substring(32,68);
        var size = 3;
        $(this).find('img').attr({
            src: "http://secondlife.com/app/image/" +uuid+ "/" +size
        });
        $(this).removeClass("curr");
    });

    //Swap preview image on Click

    $("div.imgcont a").click(function() {
        console.log("click");
        var mainImage = $(this).find("img").attr("src");
        var uuid = mainImage.substring(32,68);
        var size = 2;
        document.getElementById("preview").innerHTML
            = $(this).find("img").attr("alt")
            + "<img alt=\"\"  src=\"http://secondlife.com/app/image/" +uuid+ "/" +size+ "\"/>"
            + "<a href=\"send.php?uuid="+uuid+"\"> Send Me this texture </a>"
            + "<br> UUID: " + uuid;
        console.log($("#preview"));
        return false;
    });


});
