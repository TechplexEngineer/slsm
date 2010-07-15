<?php

include("lib/_mysql.php");
if ($_REQUEST['cmd'] == "getconf")
{
    echo "conf,";
    $getsql = "SELECT * FROM `" .$varstable. "`";
    $getqry = mysql_query($getsql) or die(mysql_error());
    while ($row = mysql_fetch_assoc($getqry))
    {
        echo $row['config_name'] . "," . $row['config_value'] . ",";
    }
}
?> 