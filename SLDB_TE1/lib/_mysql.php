<?php
include "vars.php";
$host="localhost"; // Host name
$username="robotics"; // Mysql username
$password="Phuzzl3"; // Mysql password
$db_name="sldb"; // Database name
$sqlcon		= mysql_connect($host, $username, $password) or die(mysql_error());
$sqldb		= mysql_select_db($db_name, $sqlcon);


?>
