<?php

######################################################################
# DATA FILE
#
# This is the file you'll actually send your requests to.
######################################################################
######################################################################
# DATABASE CONNECTION
#
# If we've configured correctly, the config.php file should have our
# database information.  Create a connection to the database server
# and select the database.
######################################################################
//if(file_exists('install.php')) die ("ERROR: INSTALL FILE NOT DELETED");

include 'lib/_mysql.php';
include 'lib/config.php';
include 'lib/vars.php';
include 'lib/functions.php';

//mysql_connect($dbhost, $dbuser, $dbpass) or die('ERROR: CANNOT CONNECT TO DATABASE.');
//mysql_select_db($dbname) or die('ERROR: CANNOT SELECT DATABASE.');

######################################################################
# POST AND GET VARIABLES
#
# Surely there's a better way to do this, but at the moment, I'm 
# grabbing GET variables if they exist, and resorting to POST ones if
# they do not.  You MUST have a key value and field values; if you
# don't, you'll get an error from the server. Separate field variables
# using the pipe ("|") so we can break them up into an array.  Also,
# this script won't run if you haven't deleted install.php.
######################################################################

$key = $_REQUEST['key'];
$action = strtolower($_REQUEST['action']);
$fields = $_REQUEST['fields'];
$values = $_REQUEST['values'];
$verbose = strtolower($_REQUEST['verbose']);
$reverse = strtolower($_REQUEST['reverse']);
$separator = $_REQUEST['separator'];
$password = $_REQUEST['secret'];
$dtable = $_REQUEST['dbtable'];

$action = strtolower($action);
$verbose = strtolower($verbose);
$reverse = strtolower($reverse);

if ($verbose == "yes" || $verbose == "true" || $verbose == 1) {
    $verbose = true;
} else {
    $verbose = false;
}

if ($reverse == "yes" || $reverse == "true" || $reverse == 1) {
    $reverse = true;
} else {
    $reverse = false;
}

//echo $dtable . " junk ";
if(empty($dtable))
{
    $dbtable = $data_table;
}
else
{
    $dbtable = $dtable;
}

//// here we need to request the password associated with the key
//$getsql = "SELECT * FROM `" . $user_table . "` WHERE uuid='" .$key. "'";
//
//$getqry = mysql_query($getsql) or die(mysql_error());
//while ($row = mysql_fetch_assoc($getqry)) {
//    $curUUID = $row['uuid'];
//    $currValue = $row['password'];
//
//    if ($curUUID == $key)
//        break;
//}

if (authKey($users_table, $key, $password)) {
    die("ERROR: NOT AUTHENTICATED");
}
//echo "breakpoint";
if ($key == '' or (($fields == '') && ($reverse != true))) {
    die("ERROR: INSUFFICIENT KEY OR FIELDS");
}

if (($action == "put") && ($values == '')) {
    die("ERROR: INSUFFICIENT VALUES");
}

//What is this?
if ($separator == '') {
    $separator = '|';
}

$fields = explode($separator, $fields);
$values = explode($separator, $values);
//echo "functions";
######################################################################

include "functions.data.php";


######################################################################
# ACTIONS
#
# This section parses the "action" parameter and decides what to do.
######################################################################

switch ($action) {
    case 'put':
        echo update_data($dbtable, $key, combine_arrays($fields, $values), $verbose);
        break;
    case 'get':
        if ($reverse == true) {
            echo retrieve_fields($dbtable, $key, $values, $verbose, $separator);
        } else {
            echo retrieve_values($dbtable, $key, $fields, $verbose, $separator);
        }
        break;
    case 'del':
        if ($reverse == true) {
            echo delete_fields($dbtable, $key, $values, $verbose);
        } else {
            echo delete_values($dbtable, $key, $fields, $verbose);
        }
        break;
}
?>