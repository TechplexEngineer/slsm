<?php

//print_r($_REQUEST);
include "vars.php";
include "config.php";

if ($_REQUEST['name'] == "cblogin")
{
    $loginsDisabled = $_REQUEST['val'];
    $sql = "UPDATE `vars` SET value='" . $loginsDisabled . "' WHERE name='LoginsDisabled' ";
    $query = mysql_query($sql) or die(mysql_error());
    exit;
}
if ($_REQUEST['name'] == "cbreg")
{
    $registrationDisabled = $_REQUEST['val'];
    $sql = "UPDATE `vars` SET value='" . $registrationDisabled . "' WHERE name='RegistrationDisabled' ";
    $query = mysql_query($sql) or die(mysql_error());
    exit;
}


$sql = "SELECT * FROM `vars`";
$query = mysql_query($sql) or die(mysql_error());

$row = mysql_fetch_assoc($query);
if ($row['value'] == "true")
    $loginsDisabled = true;
else
    $loginsDisabled = false;

$row = mysql_fetch_assoc($query);
if ($row['value'] == "true")
    $registrationDisabled = true;
else
    $registrationDisabled = false;


//$row = mysql_fetch_assoc($query);
//if($row[''])
//$registrationDisabled
//$loginsDisabled
//INSERT INTO `tims`.`vars` (`name`, `value`) VALUES ('logonsDisabled', 'false'), ('RegistrationDisabled', 'false');
//FOOLISHNESS NESS
//$file = file_get_contents("vars.php");
//if ($_REQUEST['name'] == "cblogin")
//{
//$pos = strpos($file, "loginsDisabled = ");
//}
//if ($_REQUEST['name'] == "cbregrs.php")
//{
//$pos = strpos($file, "registrationDisabled = ");
////from there to end
////find next ';'
////pos to next
//}
//$file = file_put_contents("vars.php", $data);
?>
