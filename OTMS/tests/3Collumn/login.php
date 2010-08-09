<?php
session_start();
include "lib/config.php";
include "lib/functions.php";
include "lib/vars.php";

$myusername = $_REQUEST['myusername'];
$mypassword = $_REQUEST['mypassword'];

if (authorized($login_table, $myusername, $mypassword )) { // authorize function defined in functions.php
    $_SESSION['user'] = $myusername;
    $_SESSION['pass'] = $mypassword;

    $sql = "SELECT * FROM `" . $login_table . "` WHERE username='" . $myusername . "'";
    //echo $sql;
    $query = mysql_query($sql) or die(mysql_error());
    //echo $query;
    $row = mysql_fetch_assoc($query);
    //print_r ($row);

    $_SESSION['id'] = $row['id'];
    $_SESSION['uuid'] = $row['uuid'];
    $_SESSION['SL_first'] = $row['SL_first'];
    $_SESSION['SL_last'] = $row['SL_last'];
    $_SESSION['perms'] = $row['perms'];

    $_SESSION['datatable'] = "sldb_data";
    //print_r($_SESSION);
    header("location:index.php");
} else {
    if (!empty($_REQUEST['myusername']))
        die("Wrong Username or Password");
//    else
//        die ("Username Blank");
    //else the user has not submitted the form
}
?>

<title><?php echo $version; ?></title>
<center><img src="img/logo.jpg" /></center>
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