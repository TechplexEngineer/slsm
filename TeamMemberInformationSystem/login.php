<?php
session_start();
include "lib/config.php";
include "lib/functions.php";
include "lib/vars.php";
include "lib/hours.php";

//This bit of code makes it so after login,
//the user is redirected to the page that made them login
if (empty($_REQUEST['page']))
    $page = "";
else
    $page = "?page=" . $_REQUEST['page'];

$myusername = $_REQUEST['myusername'];
$mypassword = $_REQUEST['mypassword'];

if ($myusername == "register")
{
    $_SESSION['user'] = "register";
    header("location:index.php?page=register");
}

if (authorized($login_table, $myusername, $mypassword))
{ // authorize function defined in functions.php
    $_SESSION['user'] = $myusername;
    $_SESSION['pass'] = $mypassword;

    $sql = "SELECT * FROM `" . $login_table . "` WHERE user='" . $myusername . "'";
    //echo $sql;
    $query = mysql_query($sql) or die(mysql_error());
    //echo $query;
    $row = mysql_fetch_assoc($query);
    //print_r ($row);

    $_SESSION['id'] = $row['id'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['fullname'] = $row['firstname'] . " " . $row['lastname'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['type'] = $row['type'];
    $_SESSION['bio'] = $row['bio'];
    $_SESSION['bio_pend'] = $row['bio_pend'];
//    $_SESSION['fhours'] = getHours($_SESSION['firstname'] . " " . $_SESSION['lastname'], 1);
//    $_SESSION['fdollars'] = getHours($_SESSION['firstname'] . " " . $_SESSION['lastname'], 2);
//    $_SESSION['cchours'] = getHours($_SESSION['firstname'] . " " . $_SESSION['lastname'], 3);
//    $_SESSION['bhours'] = getHours($_SESSION['firstname'] . " " . $_SESSION['lastname'], 4);

//$_SESSION['datatable'] = "sldb_data";
    //print_r($_SESSION);
    header("location:index.php" . $page);
} else
{
    if (!empty($_REQUEST['myusername']))
        die("Wrong Username or Password");
//    else
//        die ("Username Blank");
    //else the user has not submitted the form
}
if($loginsDisabled)
    die("Sorry We can't accept any logins at this time");
?>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>
<title><?php echo $title; ?></title>

<center><h2> <?php echo $sysname; ?> </h2></center>
<form name="form1" method="post" action="login.php<? echo $page; ?>">
    <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
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
                        <td> &nbsp; <a href="" onclick="passHelp()">Help</a></td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="Submit" value="Login"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>