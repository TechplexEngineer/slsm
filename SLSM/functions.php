<?php
include "lib/_mysql.php";

function get($varID, $name, $varstable)
{
    $getsql = "SELECT * FROM `" .$varstable. "`";
    $getqry = mysql_query($getsql) or die(mysql_error());
    while ($row = mysql_fetch_assoc($getqry)) {
        $curName = $row['config_name'];
        $currValue = $row['config_value'];

        if($curName==$name)
            break;
    }
    return $row['config_value'];
}
//we don't care about its old value so do a mysql replace
function edit($varID, $name2Edit, $value2Change, $varstable)
{
    $getsql = "REPLACE INTO `" .$varstable. "` (`config_name`,`config_value`) VALUES ('$name2Edit','$value2Change')";
    $getqry = mysql_query($getsql) or die(mysql_error());
}
function create($varID, $name2Add, $value2Add, $sysvar, $varstable)
{
    $getsql = "REPLACE INTO `" .$varstable. "` (`config_name`,`config_value`) VALUES ('$name2Add','$value2Add')";
    $getqry = mysql_query($getsql) or die(mysql_error());
}

?>
