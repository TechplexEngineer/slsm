<?php
session_start();
include "lib/_mysql.php";
include "lib/functions.php";

//This bit of code makes it so after login,
//the user is redirected to the page that made them login
if (!empty($_REQUEST['page']))
    $page = "?page=" . $_REQUEST['page'];
else
    $page = "";

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$myusername = $_REQUEST['myusername'];
$mypassword = $_REQUEST['mypassword'];

if (authorize($users_table, $myusername, $mypassword)) // authorize function defined in functions.php
{
    $sql = "SELECT * FROM `" . $users_table . "` WHERE username='" . $myusername . "'";
    $query = mysql_query($sql) or die(mysql_error()); //$_SESSION['id'] =
    $row = mysql_fetch_assoc($query);

    $_SESSION['user'] = $row['username'];
    $_SESSION['pass'] = $mypassword;

    $_SESSION['id'] = $row['id'];
    $_SESSION['uuid'] = $row['uuid'];
    $name = explode(".", $row['username']);
    $_SESSION['SL_first'] = $name[0];
    $_SESSION['SL_last'] = $name[1];
    $_SESSION['data_pass'] = $row['data_pass'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['usr_since'] = $row['timestamp'];

    //"location:index.old.php?page=". $_GET['page']);
    header("location:index.php" . $page);
} else
{
    if (!empty($_REQUEST['myusername']))
        echo "Wrong Username or Password";
    //else the user has not submitted the form
}
?>
<title><?php echo $version; ?></title><center><img src="img/logo.jpg" /></center>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
    <form name="form1" method="post" action="login.php<? echo $page; ?>">
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
