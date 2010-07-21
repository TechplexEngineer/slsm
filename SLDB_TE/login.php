<?php
session_start();
include "lib/_mysql.php";
include "lib/functions.php";

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

if(authorize($users_table, $_REQUEST['myusername'], $_REQUEST['mypassword'])) // authorize function defined in functions.php
{
    header("location:index.php");
}
else
{
    if(!empty($_REQUEST['myusername']))
        echo "Wrong Username or Password";
    //else the user has not submitted the form
}

?>

<title><?php echo $version; ?></title><center><img src="img/logo.jpg" /></center>
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