<?php
session_start();
include "config.php";
include "vars.php";
$form = $_REQUEST['form'];
if (empty($form))
{
    die("I'm Sorry, Something went wrong");
}
if ($form == "profile")
{//public profile
    //print_r($_REQUEST);
    //"UPDATE `tims`.`pending_profile` SET `nickname` = 'I Don''t Have One' WHERE `pending_profile`.`id` = 1;";
    $sql = "INSERT INTO `tims`.`pending_profile`"
            . "(`id`, `nickname`, `location`, `role`, `yog`, `interests`, `favMoment`, `gainThisYr`, `futurePlans`, `bio`) \n"
            . "VALUES ('" . $_SESSION['id'] . "', '" . $_REQUEST['nickname'] . "', '" . $_REQUEST['town'] . "', '" . $_REQUEST['role'] . "', '" . $_REQUEST['yog'] . "', '" . $_REQUEST['interests'] . "', '" . $_REQUEST['fav_moment'] . "', '" . $_REQUEST['gain'] . "', '" . $_REQUEST['future'] . "', '" . $_REQUEST['bio'] . "')\n"
            . "ON DUPLICATE KEY UPDATE nickname ='" . $_REQUEST['nickname'] . "', location='" . $_REQUEST['town'] . "', role= '" . $_REQUEST['role'] . "', yog='" . $_REQUEST['yog'] . "1" . "', interests='" . $_REQUEST['interests'] . "', favMoment='" . $_REQUEST['fav_moment'] . "', gainThisYr='" . $_REQUEST['gain'] . "', futurePlans='" . $_REQUEST['future'] . "', bio='" . $_REQUEST['bio'] . "'\n";

//echo $sql . "\n\n\n";
    $qry = mysql_query($sql) or die(mysql_error());
//$row = mysql_fetch_assoc($qry);
//echo "Your changes have been saved, they will not go live until reviewed by a moderator";
//should overlay this
//http://flowplayer.org/tools/overlay/index.html

    //send mail to missluce(eventual) and me
}
?>
<link href="../css/styling.css" rel="stylesheet" type="text/css" media="screen" />
<div class ="widget" style="width:350px">
    Your changes have been saved, they will not go live until reviewed by a moderator
    <br>
    <a href="../">Click here to continue</a>
</div>