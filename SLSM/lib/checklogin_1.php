<?php
include "lib/_mysql.php";
//$host="localhost"; // Host name 
//$username="root"; // Mysql username 
//$password="jamierocks"; // Mysql password 
//$db_name="slserver"; // Database name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

// username and password sent from form 
$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql = "SELECT * FROM `" .$userstable. "` WHERE username='" .$myusername. "' and password='" .$mypassword. "'";
$result = mysql_query($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if ($count == 1)
{
// Register $myusername, $mypassword and redirect to file "login_success.php"
    session_register("myusername");
    session_register("mypassword");
    header("location:index.php");
} else
{
    echo "Wrong Username or Password";
}
?>
<title>SLSM V1.0</title>