<?php
session_start();

if (empty($_SESSION['user']))
{
    header("location:login.php");
}
include "lib/config.php";
include "lib/vars.php";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        $textures = array();
        $getsql = "SELECT * FROM `" .$textures_table. "` WHERE owner_uuid='" . $_SESSION['uuid'] . "' ";
        $getqry = mysql_query($getsql) or die(mysql_error());
        //print_r($getqry);
        
        while ($row = mysql_fetch_assoc($getqry))
        {
            echo "<img src=\"http://secondlife.com/app/image/".$row['uuid']."/1\" />";

            $textures[] = $row['uuid'];/*
            $setname = $row['config_name'];
            $setvalue = $row['config_value'];
            $sysvar = $row['sys_var'];
            echo "<tr>";
            echo "<td>";
            echo "<label for='$setname'>$setname</label>";
            echo "</td>";
            echo "<td>";
            echo "<input name='$setname' type='text' id='$setname' value='$setvalue'  />";
            echo "</td>";
            echo "<td>";
            if ($sysvar)
                echo "System Varibles can not be deleted";
            else
                echo "<a href=\"varconf.php?cmd=del&name=$setname\" OnClick=\"return confirm('Are you sure you want to delete $setname? This change will not be reflected until the servers next syncronisation phase.');\"><img src=\"img/cross.gif\" border\"0\"></a><br/>";


            echo "</td>";
            echo "</tr>";*/
        }
        //print_r($textures);
        ?>
        <img src="http://secondlife.com/app/image/89556747-24cb-43ed-920b-47caed15465f/1"/>
        <img src="http://secondlife.com/app/image/77545434-15ad-bbe3-4797-ab89c26daf97/1"/> 
    </body>
</html>
