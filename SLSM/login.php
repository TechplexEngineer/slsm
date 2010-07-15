<?php
session_start();
include "lib/_mysql.php";
// Connect to server and select databse.
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");
$userstable   = "sls_admins";

if ($_POST['myusername']) //if (the field has been filled)
{
// username and password sent from form
    $myusername = $_POST['myusername'];
    $mypassword = $_POST['mypassword'];

//write a function in _mysql to store username
// To protect MySQL injection (more detail about MySQL injection)
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);
    $myusername = mysql_real_escape_string($myusername);
    $mypassword = mysql_real_escape_string($mypassword);

    $sql = "SELECT * FROM `" . $userstable . "` WHERE username='" . $myusername . "' and password='" . $mypassword . "'";
    $result = mysql_query($sql);

// Mysql_num_row is counting table row

    $count = mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
    //echo $count;
    if ($count == 1)
    {
        // Register $myusername, $mypassword and redirect to file "login_success.php"
        //session_register("myusername");
        //session_register("mypassword");
        $_SESSION['user'] = $myusername;
        $_SESSION['pass'] = $mypassword;
        $sql = "SELECT 'id' FROM `" . $userstable . "` WHERE username='" . $myusername . "'";
        $_SESSION['id'] = mysql_query($sql);
        $sql = "SELECT 'uuid' FROM `" . $userstable . "` WHERE username='" . $myusername . "'";
        $_SESSION['uuid'] = mysql_query($sql);
        $sql = "SELECT 'SL_first' FROM `" . $userstable . "` WHERE username='" . $myusername . "'";
        $_SESSION['SL_first'] = mysql_query($sql);
        $sql = "SELECT 'SL_last' FROM `" . $userstable . "` WHERE username='" . $myusername . "'";
        $_SESSION['SL_last'] = mysql_query($sql);
        $sql = "SELECT 'perms' FROM `" . $userstable . "` WHERE username='" . $myusername . "'";
        $_SESSION['perms'] = mysql_query($sql);

        $_SESSION['serverstable'] = "sls_servers";
        $_SESSION['varstable'] = "sls_config";
        $_SESSION['userstable'] = $userstable;



        header("location:index.php"); // make the user go to the index page
        //@todo it would be nice if they could go to the page they came from.
    } else
    {
        echo "Wrong Username or Password";
    }
}
?>

<title>SLSM V1.0</title><center><img src="img/logo.jpg" /></center>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
    <form name="form1" method="post" action="login.php">
        <td>
            <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                    <td colspan="3"><strong>Login: </strong></td>
                </tr>
                <tr>
                    <td width="78">Username</td>
                    <td width="6">:</td>
                    <td width="294"><input name="myusername" type="text" id="myusername"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input name="mypassword" type="password" id="mypassword"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="Submit" value="Login"></td>
                </tr>
            </table>
        </td>
    </form>
</tr>
</table>