
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
        //$(this).append('<div id="curr">HELLO</div>');
        //$(this).find('curr').fadeIn();
        $(this).addClass("curr");
        //changes the image to a larger version for clarity
        var mainImage = $(this).find("img").attr("src");
        var uuid = mainImage.substring(32,68);
        var size = 2;
        $(this).find('img').attr({
            src: "http://secondlife.com/app/image/" +uuid+ "/" +size 
        });

        //$(this).innerHTML = "<img alt=\"\"  src=\"http://secondlife.com/app/image/" +uuid+ "/ " +size+ "\"/>";

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
        var mainImage = $(this).find("img").attr("src");
        var uuid = mainImage.substring(32,68);
        var size = 3;
        $(this).find('img').attr({
            src: "http://secondlife.com/app/image/" +uuid+ "/" +size
        });
//        var mainImage = $(this).find("img").attr("src");
//        var uuid = mainImage.substring(32,68);
//        var size = 3;
//        $(this).innerHTML = "<img alt=\"\"  src=\"http://secondlife.com/app/image/" +uuid+ "/ " +size+ "\"/>";
        $(this).removeClass("curr");
        //$("#curr").remove();
    //$(this).attr({ src: uuid });
    });

    //Swap Image on Click
//    $("div.imgcont a").click(function() {
//                console.log("click");
//		var mainImage = $(this).attr("href"); //Find Image Name
//		$("#main_view img").attr({ src: mainImage });
//		return false;
//	});

    $("div.imgcont a").click(function() {
        console.log("click");
        var mainImage = $(this).find("img").attr("src");
        var uuid = mainImage.substring(32,68);
        var size = 2;
        document.getElementById("preview").innerHTML
            = "Image name here"
            + "<img alt=\"\"  src=\"http://secondlife.com/app/image/" +uuid+ "/" +size+ "\"/>"
            + "<a href=\"send.php?uuid="+uuid+"\"> Send Me this texture </a>"
            + "<br> UUID: " + uuid;
        console.log($("#preview"));
        return false;
    });

//    $('#preview').click();
//    function(){
//
//        console.log("send.php");
//    }

    //var mainImage = $(this).attr("href"); //get the name from the href of the image clicked
//        $("#main_view img").attr({
//            src: mainImage
//        });//change the src of id main_view to the gotten
//        var uuid = mainImage.substring(32,68);
//        console.log(uuid);
//        $("#main_view a").attr({
//            href: uuid
//        });





//    $("#main_view a").click(function() {
//
//        alert();
//        return false;
//    });

});
