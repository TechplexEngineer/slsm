<?php
$uuid = $_REQUEST['uuid'];

if(empty($uuid))
    die ("ERROR: UUID blank");

$getsql = "SELECT * FROM `" . $textures_table . "` WHERE uuid='" .$key. "' ";
$getqry = mysql_query($getsql) or die(mysql_error());

$row = mysql_fetch_assoc($getqry);

print_r($row);

?>
