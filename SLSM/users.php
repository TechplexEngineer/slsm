<?
session_start();

if (empty($_SESSION['user']))
{
    header("location:login.php");
}
include("lib/_mysql.php");
?>
<?

function confirm($msg)
{
    echo "<script langauge=\"javascript\">alert(\"" . $msg . "\");</script>";
}

//end function
if ($_GET['cmd'] == "del")
{
    $idtodelete = $_GET['id'];
    $getsql = "DELETE FROM `" .$userstable. "` WHERE id=$idtodelete";
    $getqry = mysql_query($getsql) or die(mysql_error());
} else if ($_GET['cmd'] == "Update")
{
    if ($_GET['id'] == "")
    {
        //return confirm("No information submitted.");
    } else
    {
        echo "id is not blank";
        $idtoupdate = $_GET['id'];
        $user = $_GET['username'];
        $pass = $_GET['password'];
        $getsql = "REPLACE INTO `" .$userstable. "` (id,username,password) VALUES ('$idtoupdate','$user','$pass')";
        $getqry = mysql_query($getsql) or die(mysql_error());
    }
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
                        <h1> Admin Management</h1>
                        <p>
                            <?
                            $getsql = "SELECT * FROM `" .$userstable. "`";
                            $getqry = mysql_query($getsql) or die(mysql_error());
                            if (mysql_num_rows($getqry) > 0)
                            {
                                echo "<table width='100%' border='1'>";
                                echo "<th>ID</th>";
                                echo "<th>Username</th>";
                                echo "<th>Password</th>";
                                echo "<th>Select</th>";
                                if($_SESSION['id'] == 1)
                                    echo "<th>Delete</th>";

                                while ($row = mysql_fetch_assoc($getqry))
                                {
                                    $slsusername = $row['username'];
                                    $slspassword = $row['password'];
                                    $slsid = $row['id'];

                                    echo "<tr>\n";
                                    echo "<td>$slsid</td>\n";
                                    echo "<td>$slsusername</td>";
                                    echo "<td>-hidden-</td>";
                                    echo "<td><a href=\"#\" onClick=\"javascript:FillForm('" . $slsid . "', '" . $slsusername . "');return false;\"><img src=\"img/tick.gif\" border=\"0\"></a></td>\n";
                                    if($slsid != 1)
                                        echo "<td><a href=\"manageadmins.php?cmd=del&id=$slsid\" OnClick=\"return confirm('Are you sure you want to delete $slsusername ?');\"><img src=\"img/cross.gif\" border\"0\"></a></td>";
                                    else if($_SESSION['id'] != 1)
                                        echo "<td>You can't delete yourself '" . $myusername . "'</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else
                            {
                                echo "No admins.";
                            }
                            ?>


                        </p>

                        <form action="" method="get" enctype="application/x-www-form-urlencoded" name="form1" id="form1">
                            <script type="text/javascript" src="jquery-1.4.min.js"></script>
                            <script type="text/javascript">
                                function FillForm(ids,usernames ) {
                                    $("#id").val(ids);
                                    $("#username").val(usernames);
                                    
                                    console.log(usernames);

                                }
                                function notEmpty(elem, helperMsg){
                                    if(elem.value.length == 0)
                                    {
                                        alert(helperMsg);
                                        elem.focus(); // set the focus to this input
                                        return false;
                                    }
                                    else
                                        return true;
                            
                                }
                            </script>

                            <p>Edit User Information</p>
                            <table>
                                <tr>
                                    <td><label for="id">ID</label></td>
                                    <td><input name="id" type="text" id="id" /></td>
                                </tr>
                                <tr>
                                    <td><label for="username">Username</label></td>
                                    <td><input type="text" name="username" id="username" /></td>
                                </tr>
                                <tr>
                                    <td><label for="password">Password</label></td>
                                    <td><input type="password" name="password" id="password" /></td>
                                </tr>
                            </table>
                            <p>
                                <label for="submit"></label>
                                <input type="submit" name="cmd" id="cmd" value="Update" onclick="notEmpty(document.getElementById('id'), 'Please Enter a Value')" />
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