<?php
session_start();

if (empty($_SESSION['user']))
{
    header("location:login.php");
}
include "lib/config.php";
include "lib/vars.php";

 function displayImage($uuid , $size){
     echo "<img src=\"http://secondlife.com/app/image/" . $uuid . "/". $size ."\" />";
 }

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
        $getsql = "SELECT * FROM `" . $textures_table . "` WHERE owner_uuid='" . $_SESSION['uuid'] . "' ";
        $getqry = mysql_query($getsql) or die(mysql_error());
//print_r($getqry);
        $omitted = 0;
        $size =1;

        while ($row = mysql_fetch_assoc($getqry))
        {
           if(empty($row['has_alpha_layers']))
            {
                $str = file_get_contents("http://secondlife.com/app/image/" . $row['uuid'] . "/" .$size);
                if (empty($str))
                { //no image present
                    $omitted++;
                    //echo "<script> console.log(\" " . $row['name'] . " \");</script>";
                    $sql = "UPDATE " . $textures_table . " SET
				has_alpha_layers = 'true'
				WHERE uuid = '" . $row['uuid'] . "'";
                    //echo "<br>\n".$sql."<br>\n";

                    $result = mysql_query($sql) or die("ERROR:  " . mysql_error());
                    //mark database
                } else // image present
                {
                    displayImage($row['uuid'],$size);
                    $sql = "UPDATE " . $textures_table . " SET
				has_alpha_layers = 'false'
				WHERE uuid = '" . $row['uuid'] . "'";
                    //echo "<br>\n".$sql."<br>\n";

                    $result = mysql_query($sql) or die("ERROR:  " . mysql_error());
                    //mark database
                }
            }else
            {
                //echo $row['has_alpha_layers'];
                if($row['has_alpha_layers'] == "true")
                    $omitted ++;
                else
                    displayImage($row['uuid'],$size);

            }



//
//
//
//
//
//            if ($row['has_alpha_layers'] == "false")
//                echo "<img src=\"http://secondlife.com/app/image/" . $row['uuid'] . "/1\" />";
//            elseif (empty($row['has_alpha_layers']))
//            {
//                $str = file_get_contents("http://secondlife.com/app/image/" . $row['uuid'] . "/1");
//                if (empty($str))
//                {
//                    $omitted++;
//                    echo "<script> console.log(\" " . $row['name'] . " \");</script>";
//                    $sql = "UPDATE " . $textures_table . " SET
//				has_alpha_layers = 'false'
//				WHERE uuid = '" . $row['uuid'] . "'";
//                    echo "<br>\n".$sql."<br>\n";
//
//                    $result = mysql_query($sql) or die("ERROR:  " . mysql_error());
//                    //mark database
//                } else
//                {
//                    echo "<img src=\"http://secondlife.com/app/image/" . $row['uuid'] . "/1\" />";
//                    //mark database
//                }
//            } else if($row['has_alpha_layers'])
//            {
//                $omitted++;
//                echo "<script> console.log(\" " . $row['name'] . " \");</script>";
//            }
//            else
//                echo "<img src=\"http://secondlife.com/app/image/" . $row['uuid'] . "/1\" />";

            $textures[] = $row['uuid'];
        }
//print_r($textures);
        if ($omitted > 0)
            echo "\n <br>" . $omitted . " of " . count($textures) . " Textures were omitted.";
        ?>
    </body>
</html>
