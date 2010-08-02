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

if ($verbose == "yes" || $verbose == "true" || $verbose == 1)
{
    $verbose = true;
} else
{
    $verbose = false;
}

if ($reverse == "yes" || $reverse == "true" || $reverse == 1)
{
    $reverse = true;
} else
{
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

if (($action == "put") && ($values == ''))
{
    die("ERROR: INSUFFICIENT VALUES");
}

//What is this?
if ($separator == '')
{
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

switch ($action)
{
    case 'put':
        echo update_data($dbtable, $key, combine_arrays($fields, $values), $verbose);
        break;
    case 'get':
        if ($reverse == true)
        {
            echo retrieve_fields($dbtable, $key, $values, $verbose, $separator);
        } else
        {
            echo retrieve_values($dbtable, $key, $fields, $verbose, $separator);
        }
        break;
    case 'del':
        if ($reverse == true)
        {
            echo delete_fields($dbtable, $key, $values, $verbose);
        } else
        {
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
					VALUES ('" . $key . "',
                                                '" . $name . "',
                                                '" . $xmlchan . "',
                                                '" . $pos . "',
                                                '" . $region . "',
                                                '" . $owneruuid . "',
                                                NOW())";
            // echo  " <br>" . $sql . "<br>\n";
            $result = mysql_query($sql) or die("ERROR: SYNTAX2 " . mysql_error());
        }
        $error = mysql_error();
        if (empty($error))
            echo "Registration Success";
        break;
    case 'tex':
//        echo "Tex" . $_REQUEST["tex"];
        $texInfo = explode(',', $_REQUEST["tex"]);
        foreach ($texInfo as $id => $value)
        {
            echo $id ."\t \t" . $value . "\n";
            $newArray[] = explode('|', $value);

            $sql = "UPDATE otms_textures SET
                name =              '" . $newArray[$id][0] . "',
                host_server_uuid =  '" . $newArray[$id][1] . "',
                owner_uuid =        '" . $owneruuid . "',
                WHERE uuid =        '" .  $key . "'";
                                //echo "\n" . $sql;
            $result = mysql_query($sql);
            echo "\n rows:" . mysql_affected_rows();
            if (!(mysql_affected_rows() >= 0))
            {
                echo " \n inserting \n ";
                if(empty($newArray[$id][1]) || empty($newArray[$id][0]))
                    echo "***ERROR: blank";
                $query = "INSERT INTO otms_textures VALUES ('" . $newArray[$id][1] . "','" . $newArray[$id][0] . "', '" . $key . "', '" . $owneruuid . "' )";
                //echo $query;
                $result = mysql_query($query); //or die("ERROR: Texture " . mysql_error());
                echo "\n Result: " . $result . "\n" . "Error:" . mysql_error();
            }
        }

        //http://techwizworld.net/OTMS/data.php?action=tex&owner=7e6aba77-bf2c-41b5-8736-30f33ea563c7&secret=t3chp73x7abs&key=153f3cce-0768-042b-08fc-9d2a0ead2eb4e6bsegrtflr128.tga|3006246d-fa34-6feb-aba5-499c7341b683,e6bsegrtflr256.tga|c304c552-a739-7a4e-e225-04d7293d2282,e6c_floor.jpg|2e4be901-ded3-0e5f-8698-5ae908e4292e,e6c_floor_b.jpg|eb6d6d32-f539-8368-4c26-48e56280cfd3,e6c_floordented.jpg|ffd2abd8-57ea-1c34-59a3-139b296dfae0,e6c_stepedge.jpg|58aaeba9-c023-7254-e962-ec987de4b53c,e6grate2_flr.tga|808ab7ad-6b26-ca66-88f3-746c803c4a28,e6grate2_flr_b.tga|43882eb1-effe-b112-e7e2-9fb836a2ff8d,e6grate_flr.tga|83fe99bc-3325-1f41-16d4-4a41171be7e9,e6grate_flr_b.tga|e92ad875-6e0a-7054-375c-5da804a45ee6,e6grtfloorceil.tga|a64a73f9-9d7c-57c1-3027-eb4c9d749501,e6grtflr2bl.tga|55e65a57-c3d9-fa7d-d8c7-305973a3d78c,e6l_floor.jpg|86afeb15-05ea-6a1b-c55e-ca461c40d0e8,e6l_stepedge.jpg|10902109-321d-abeb-ef21-46d838153ceb,e6launchcfloor.jpg|f59e224c-92f4-ee7f-6e1b-f7b900fceb0f,e6launchcfloor_fx.jpg|458b8672-35bf-8be9-290e-a19f884c9e
        print_r($newArray);


        break;
}
?>