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

include 'lib/config.php';
//include 'lib/vars.php';
include 'lib/functions.php';



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

$name = $_REQUEST['name'];
$xmlchan = $_REQUEST['xml'];
$pos = $_REQUEST['pos'];
$region = $_REQUEST['region'];
$owneruuid = $_REQUEST['owner'];
//uuid, name, xml, posiion, region, owner_uuid
//
//print_r($_REQUEST);
//view-source:http://techwizworld.net/OTMS/data.php?action=register&name=OTMS%20Server&region=Black%20Bear%20Island&key=153f3cce-0768-042b-08fc-9d2a0ead2eb4&xml=4dec7d89-1ffe-5bd4-440d-b951ca58bcaa&pos=<124.35130
//exit;

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
//echo "uuid: " . $owneruuid . " | pass:" . $password + "<br> \n";
//if (!authKey($user_table, $owneruuid, $password)) {
//    die("ERROR: NOT AUTHENTICATED");
//}

authKey($user_table, $owneruuid, $password);

//echo "breakpoint";
//if ($key == '' or (($fields == '') && ($reverse != true))) {
//    die("ERROR: INSUFFICIENT KEY OR FIELDS");
//}

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
    case 'register':
        $sql = "UPDATE otms_servers SET
                name        = '" . $name . "',
                xml         = '" . $xmlchan . "',
                position    = '" . $pos . "',
                region      = '" . $region . "',
                owner_uuid  = '" . $owneruuid . "',
                timestamp   = NOW()
                    WHERE uuid = '" . $key . "'";
        //echo $sql."\n";

        $result = mysql_query($sql); //or echo("ERROR: SYNTAX1 " . mysql_error());

        if (mysql_affected_rows() == 0)
        {
            //echo "insert";
            $sql = "INSERT INTO otms_servers (uuid,name,xml,position,region,owner_uuid,timestamp)
					VALUES ('" .$key.       "',
                                                '" .$name.      "',
                                                '" .$xmlchan.   "',
                                                '" .$pos.       "',
                                                '" .$region.    "',
                                                '" .$owneruuid. "',
                                                NOW())";
           // echo  " <br>" . $sql . "<br>\n";
            $result = mysql_query($sql) or die("ERROR: SYNTAX2 " . mysql_error());
        }
        $error = mysql_error();
        if(empty($error))
            echo "Registration Success";
        break;
    case 'tex':
        $texInfo = explode(',', $_REQUEST["tex"]);
        print_r($texInfo);
        break;

}
?>