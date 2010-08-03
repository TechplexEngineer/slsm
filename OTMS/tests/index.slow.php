<?php
session_start();

//if (empty($_SESSION['user']))
//{
//    header("location:login.php");
//}
include "../lib/config.php";
include "../lib/vars.php";
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
        $getsql = "SELECT * FROM `" . $textures_table . "` WHERE owner_uuid='7e6aba77-bf2c-41b5-8736-30f33ea563c7' ";
        $getqry = mysql_query($getsql) or die(mysql_error());
//print_r($getqry);
        $omitted = 0;
        $fast = true;
        while ($row = mysql_fetch_assoc($getqry))
        {
            //$ext = substr($row['name'], -3);

            $str = file_get_contents("http://secondlife.com/app/image/" . $row['uuid'] . "/1");
            if (empty($str))
            {
                $omitted++;
                echo "<script> console.log(\" " .$row['name']." \");</script>";
            }
            else
                echo "<img src=\"http://secondlife.com/app/image/" . $row['uuid'] . "/1\" />";
                

            //echo "<img src=\"http://secondlife.com/app/image/" . $row['uuid'] . "/1\" />";

            $textures[] = $row['uuid'];
        }
//print_r($textures);
        if ($omitted > 0)
            echo "\n <br>" . $omitted . " Textures were omitted.";
        ?>
    </body>
</html>
