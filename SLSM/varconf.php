<?php
session_start();

if (empty($_SESSION['user']))
{
    header("location:login.php");
}
include("lib/_mysql.php");
?>
<?php
if ($_REQUEST['cmd'] == "Save Changes")
{
    foreach ($_GET as $key => $value)
    {
        if ($key != "cmd")
        {
            $getsql = "REPLACE INTO `" .$varstable. "` (`config_name`,`config_value`) VALUES ('$key','$value')";
            $getqry = mysql_query($getsql) or die(mysql_error());
        }
    }
} else if ($_GET['cmd'] == "del")
{
    $idtodelete = $_GET['name'];
    $getsql = "DELETE FROM `" .$varstable. "` WHERE `config_name`='$idtodelete'";
    $getqry = mysql_query($getsql) or die(mysql_error());
} else if ($_GET['cmd'] == "Add")
{
    $nametoadd = $_GET['confname'];
    $valtoadd = $_GET['confval'];
    $getsql = "REPLACE INTO `" .$varstable. "` (`config_name`,`config_value`) VALUES ('$nametoadd','$valtoadd')";
    $getqry = mysql_query($getsql) or die(mysql_error());
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title> SLSM &nbsp; :|: &nbsp; V1.5 </title>
        <!-- Javascript - Fix the flash of unstyled content -->
        <script type="text/javascript"></script>

        <!-- Stylesheets -->
        <link href="css/reset.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="css/styling.css" rel="stylesheet" type="text/css" media="screen" />
        <!-- Print Stylesheet -->
        <link href="css/print.css" rel="stylesheet" type="text/css" media="print" />

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
        <meta name="author" content="Techplex Engineer" />

        <meta name="keywords" content="" />
        <meta name="description" content="" />

    </head>
    <body>

        <div id="container">
            <div id="header">
                <div id="header-in">
                    <?php include "lib/header.php"; ?>
                </div> <!-- end #header-in (provides padding)-->
            </div> <!-- end #header -->

            <div id="content-wrap" class="clear lcol">
                <div class="column">
                    <div class="column-in">
                        <?php include "lib/nav.php"; ?>
                    </div> <!-- end .column-in -->
                </div> <!-- end .column -->

                <div class="content">
                    <div class="content-in">
                        <h1> Configuration</h1>
                        <form action="" method="get" name="form1" id="form1">
                            <p>Variable Management:</p>
                            <table border="1px" width="100%">
                                <tr>
                                    <th>Name:</th>
                                    <th>Value:</th>
                                    <th>Delete:</th>

                                </tr>


                                <?php
                                $getsql = "SELECT * FROM `" .$varstable. "`";
                                $getqry = mysql_query($getsql) or die(mysql_error());
                                while ($row = mysql_fetch_assoc($getqry))
                                {
                                    $setname = $row['config_name'];
                                    $setvalue = $row['config_value'];
                                    echo "<tr>";
                                        echo "<td>";
                                            echo "<label for='$setname'>$setname</label>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<input name='$setname' type='text' id='$setname' value='$setvalue'  />";
                                        echo "</td>";
                                        echo "<td>";
                                            if($setname != "checkInTime")
                                                echo "<a href=\"varconf.php?cmd=del&name=$setname\" OnClick=\"return confirm('Are you sure you want to delete $setname? This change will not be reflected until the servers next syncronisation phase.');\"><img src=\"img/cross.gif\" border\"0\"></a><br/>";
                                            else
                                                echo "System Varibles can not be deleted";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                ?>

                            </table>
                            <label for="submit"></label>
                            <input type="submit" name="cmd" id="cmd" value="Save Changes" />


                        </form>
                        <form id="form2" name="form2" method="get" action="">
                            <p>Add Variable</p>
                            <label for="confname">Name</label>
                            <input type="text" name="confname" id="confname" />
                            <label for="confval">Value</label>
                            <input type="text" name="confval" id="confval" />

                            <p>
                                <label for="Add"></label>
                                <input type="submit" name="cmd" id="cmd" value="Add" />
                            </p>
                        </form>
                        <p>&nbsp;</p>
                    </div> <!-- end .content-in -->
                </div> <!-- end .content -->
            </div> <!-- end #content-wrap
            <div class="clear"></div>-->
            <div id="footer">
                <div id="footer-in">
                    <?php include "lib/footer.php"; ?>
                </div> <!-- end #footer-in -->
            </div> <!-- end #footer -->
        </div> <!-- end div#container -->
    </body>
</html>