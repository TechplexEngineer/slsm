<?php
session_start();

if (empty($_SESSION['user']))
{
    header("location:login.php");
}
include "lib/config.php";
include "lib/vars.php";

function displayImage($uuid, $size, $name)
{
    echo "<div class=\"imgcont\">";
    echo "<a href=\"\"><img alt=\"" . $name . "\"  src=\"http://secondlife.com/app/image/" . $uuid . "/" . $size . "\"/></a>";
    echo "</div>";
    //echo "<img src=\"http://secondlife.com/app/image/" . $uuid . "/". $size ."\" />";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title> &nbsp; title &nbsp; | &nbsp; description &nbsp; </title>

        <!-- Javascript - Fix the flash of unstyled content -->
        <script type="text/javascript"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="javascript/jq.hover.js" type="text/javascript"></script>

        <!-- Stylesheets -->
        <link href="style/reset.css" rel="stylesheet" type="text/css" media="all" />
        <link href="style/default.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="style/styling.css" rel="stylesheet" type="text/css" media="screen" />
        <!-- Print Stylesheet -->
        <link href="style/print.css" rel="stylesheet" type="text/css" media="print" />

        <!-- Meta Information -->
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta http-equiv="cache-control" content="public" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="expires" content="never" />
        <meta name="language" content="en-gb" />
        <meta name="MSSmartTagsPreventParsing" content="true" />
        <meta name="robots" content="index, follow" />
        <meta name="revisit-after" content="14 days" />
        <meta name="author" content="Mitchell Bryson" />

        <meta name="keywords" content="" />
        <meta name="description" content="" />

    </head>
    <body class="fullwidth">
        <div id="container">
            <div id="header">
                <div id="header-in">
                    <h2>Metaverse Texture Management</h2>
                </div> <!-- end #header-in -->
            </div> <!-- end #header -->
            <div id="content-wrap" class="clear rlcol">
                <div class="column cleft">
                    <div class="column-in">
					File Tree
                    </div> <!-- end .column-in -->
                </div> <!-- end .column -->
                <div class="column cright">
                    <div class="column-in">
                        <h4> Preview Pane </h4>
                        <div id="preview">Click a thumbnail for more information</div>
                        <div id="omitInfo"></div>

                    </div> <!-- end .column-in -->
                </div> <!-- end .column -->
                <div class="content">
                    <div class="content-in">
                        <?php
                        $textures = array();
                        $names = array();
                        $getsql = "SELECT * FROM `" . $textures_table . "` WHERE owner_uuid='" . $_SESSION['uuid'] . "' ";
                        $getqry = mysql_query($getsql) or die(mysql_error());
//print_r($getqry);
                        $omitted = 0;
                        $size = 3;

                        while ($row = mysql_fetch_assoc($getqry))
                        {
                            if (empty($row['has_alpha_layers']))
                            {
                                $str = file_get_contents("http://secondlife.com/app/image/" . $row['uuid'] . "/" . $size);
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
                                    displayImage($row['uuid'], $size, $row['name']);
                                    $sql = "UPDATE " . $textures_table . " SET
				has_alpha_layers = 'false'
				WHERE uuid = '" . $row['uuid'] . "'";
                                    //echo "<br>\n".$sql."<br>\n";

                                    $result = mysql_query($sql) or die("ERROR:  " . mysql_error());
                                    //mark database
                                }
                            } else
                            {
                                //echo $row['has_alpha_layers'];
                                if ($row['has_alpha_layers'] == "true")
                                    $omitted++;
                                else
                                    displayImage($row['uuid'], $size, $row['name']);
                            }
                            $textures[] = $row['uuid'];
                            $names[] = $row['name'];
                        } ?>
                        <script type="text/javascript" language="javascript">
                        
                        <?php
                        if ($omitted > 0)
                        //echo" <script> document.getElementById(\"omitInfo\").innerHTML=""";
                            $omitInfo = $omitted . " of " . count($textures) . " Textures were omitted.";
                        echo "var oI =\"" . $omitInfo . "\"\n;";
                        echo "var tex =\"" . implode($names, ',<br> ') . "\";";
                        ?>
                            var displayed = false;
                            document.getElementById("omitInfo").innerHTML="<br>" + oI + "<br> <a href=\"\">List Omitted: </a><br>" ;
                            //Onclick show list
                            //                           console.log($("#omitInfo a"));
                            $("#omitInfo a").click(function() {
                                //console.log("omit link clicked");
                                if(displayed)
                                {
                                    document.getElementById("omitInfo").innerHTML="<br>" + oI + "<br> <a href=\"\">List Omitted: </a><br>" ;
                                    return false;
                                }
                                else
                                {
                                    var currHTM = document.getElementById("omitInfo").innerHTML;
                                    document.getElementById("omitInfo").innerHTML = currHTM + tex;
                                    return false;
                                }
                                
                            });
                            //+ tex
                        </script>

                    </div> <!-- end .content-in -->
                </div> <!-- end .content -->
            </div> <!-- end #content-wrap -->
            <div class="clear"></div>
            <div id="footer">
                <div id="footer-in">
				footer
                </div> <!-- end #footer-in -->
            </div> <!-- end #footer -->
        </div> <!-- end div#container -->
        <!-- common functions -->
    </body>
</html>