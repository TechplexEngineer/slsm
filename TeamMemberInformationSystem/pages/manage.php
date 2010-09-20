<?php

session_start();
if (!($_SESSION['type'] == "admin" || $_SESSION['type'] == "superuser" || $_SESSION['user'] == "blake.bourque"))
    echo "You are not authorized to access this page";

if (isset($_REQUEST['acceptID']))
{
    $sql = "SELECT * FROM `pending_profile` WHERE id ='" . $_REQUEST['acceptID'] . "'";
    $qry = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_assoc($qry);

    $sql = "INSERT INTO `tims`.`public_profile`"
            . "(`id`, `nickname`, `location`, `role`, `yog`, `interests`, `favMoment`, `gainThisYr`, `futurePlans`, `bio`) \n"
            . "VALUES ('" . $_SESSION['id'] . "', '" . $row['nickname'] . "', '" . $row['location'] . "', '" . $row['role'] . "', '" . $row['yog'] . "', '" . $row['interests'] . "', '" . $row['favMoment'] . "', '" . $row['gainThisYr'] . "', '" . $row['futurePlans'] . "', '" . $row['bio'] . "')\n"
            . "ON DUPLICATE KEY UPDATE nickname ='" . $row['nickname'] . "', location='" . $row['location'] . "', role= '" . $row['role'] . "', yog='" . $row['yog'] . "', interests='" . $row['interests'] . "', favMoment='" . $row['favMoment'] . "', gainThisYr='" . $row['gainThisYr'] . "', futurePlans='" . $row['futurePlans'] . "', bio='" . $row['bio'] . "'\n";
    $qry = mysql_query($sql) or die(mysql_error());

    echo "User " . $_SESSION['id'] . ", profile approved.<br><br>";
    //@todo make this a red notification box
    //@todo Id2Name
    //@todo edit fields
    //@todo reject / approve
    //@todo preview
    //exit;
}
include "vars.php";
$sql = "SELECT * FROM `pending_profile`";
$qry = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($qry) == 1)
    echo "There is " . mysql_num_rows($qry) . " profile to be moderated <br>";
else if (mysql_num_rows($qry) >= 1)
    echo "There are " . mysql_num_rows($qry) . " profiles to be moderated <br>";
//select one from the list below
//then we need manage.prfile?cmd=manage
$sql = "SELECT * FROM `public_profile`";
$qry = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($qry) == 1)
    echo "There is " . mysql_num_rows($qry) . " profile displayed <br>";
else if (mysql_num_rows($qry) >= 1)
    echo "There are " . mysql_num_rows($qry) . " profiles displayed <br>";

$sql = "SELECT * FROM `" . $login_table . "`";
$qry = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($qry) == 1)
    echo "There is " . mysql_num_rows($qry) . " profile <br>";
else if (mysql_num_rows($qry) >= 1)
    echo "There are " . mysql_num_rows($qry) . " profiles <br>";
?>
