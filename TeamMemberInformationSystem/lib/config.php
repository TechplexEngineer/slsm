<?php

$dbhost = 'localhost';
$dbuser = 'tims';
$dbpass = 'aSVQDqWxDHUSbrD7';
//$dbpass = 'phuzzl3';
$dbname = 'tims';
//$datatable = 'otms_textures';
$user_table = 'tims_users';

mysql_connect($dbhost, $dbuser, $dbpass) or die('ERROR: CANNOT CONNECT TO DATABASE.');
mysql_select_db($dbname) or die('ERROR: CANNOT SELECT DATABASE. \n' . mysql_error());

?>