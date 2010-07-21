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
//include 'lib/vars.php';
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

if (authKey($user_table, $key, $password)) {
    die("ERROR: NOT AUTHENTICATED");
}

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
echo "functions";
######################################################################
# FUNCTIONS
#
# These do all the dirty work.
######################################################################


// This function takes the two arrays taken in as parameters, and makes a new 2D array,
// With each element in $varfields as the key for the corresponding element in $varvalues 
function combine_arrays($varfields, $varvalues) {
    if (count($varfields) != count($varvalues)) {
        die("ERROR: UNMATCHED PARAMETERS");
    }

    $result = array();
    while (($key = each($varfields)) && ($val = each($varvalues))) {
        $result[$key[1]] = $val[1];
    }
    return($result);
}
// $table   = MYSQL table to change
// $varkey  = owner's UUID
// $data    = A 2D array with Field => Value
// $varverb = output verbose text or not
function update_data($table, $varkey, $data, $varverb) {
    foreach ($data as $f => $v) {

        $sql = "UPDATE $table SET
				value = '$v',
				timestamp = NOW()
				WHERE uuid = '$varkey' AND field = '$f'";
        $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());

        if (mysql_affected_rows() == 0) {
            $sql = "INSERT INTO $table (uuid,field,value,timestamp) 
					VALUES ('$varkey', '$f','$v',NOW())";
            $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
        }
    }
    if ($varverb == true) {
        return "SUCCESS: UPDATED " . count($data) . " RECORDS.";
    }
    else
        return "SUCCESS: " . count($data);
}

// Delete values based on fields
// $table   = MYSQL table to change
// $varkey  = owner's UUID
// $data    = array of fields
// $varverb = output verbose text or not
// $varsep  = value to put between outputed data

//'ALL_DATA'
function retrieve_values($table, $varkey, $data, $varverb, $varsep) {
    $return = array();

    if (in_array('ALL_DATA', $data)) {
        $sql = "SELECT * FROM $table 
				WHERE uuid = '$varkey'";
        $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            if ($row['value'] == '') {
                $row['value'] = 'NO_DATA';
            }
            if ($varverb) {
                $return[] = $row['field'];
            }
            $return[] = $row['value'];
        }
    } else {
        foreach ($data as $f) {

            $sql = "SELECT * FROM $table 
					WHERE uuid = '$varkey' AND field = '$f'";
            $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
            $row = mysql_fetch_assoc($result);
            if (empty($row)) {
                $row['value'] = "NO_DATA";
            }
            if ($varverb) {
                $return[] = $f;
            }
            $return[] = $row['value'];
        }
    }
    if (count($return) < 1) {
        return "NO_DATA";
    } else {
        //returns a string that is "glued" togather by $varsep
        return implode($varsep, $return);
    }
}

// Retrieve fileds based on values
// $table   = MYSQL table to change
// $varkey  = owner's UUID
// $data    = array of values
// $varverb = output verbose text or not
// $varsep  = value to put between outputed data

//'ALL_DATA'
function retrieve_fields($table, $varkey, $data, $varverb, $varsep) {
    $return = array();

    if (in_array('ALL_DATA', $data)) {
        $sql = "SELECT * FROM $table 
				WHERE uuid = '$varkey'";
        $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            if ($row['field'] == '') {
                $row['field'] = 'NO_DATA';
            }
            if ($varverb) {
                $return[] = $row['value'];
            }
            $return[] = $row['field'];
        }
    } else {
        foreach ($data as $f) {

            $sql = "SELECT * FROM $table 
					WHERE uuid = '$varkey' AND value = '$f'";
            $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
            $row = mysql_fetch_assoc($result);
            if (empty($row)) {
                $row['field'] = "NO_DATA";
            }
            if ($varverb) {
                $return[] = $f;
            }
            $return[] = $row['field'];
        }
    }
    if (count($return) < 1) {
        return "NO_DATA";
    } else {
        return implode($varsep, $return);
    }
}

// Delete values based on fields
// $table   = MYSQL table to change
// $varkey  = owner's UUID
// $data    = array of values //'ALL_DATA'
// $varverb = output verbose text or not
function delete_values($table, $varkey, $data, $varverb) {
    $rows;
    if (in_array('ALL_DATA', $data)) {
        $sql = "DELETE FROM $table 
				WHERE uuid = '$varkey'";
        $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
        $rows += mysql_affected_rows();
    } else {
        foreach ($data as $f) {
            $sql = "DELETE FROM $table 
					WHERE uuid = '$varkey' AND field = '$f'";
            $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
            $rows += mysql_affected_rows();
        }
    }
    if ($varverb == true) {
        return "SUCCESS: DELETED " . $rows . " RECORDS.";
    }
    else
        return "SUCCESS: " . $rows;
}

// Delete fileds based on values
// $table   = MYSQL table to change
// $varkey  = owner's UUID
// $data    = array of fields //'ALL_DATA'
// $varverb = output verbose text or not
// $varsep  = value to put between outputed data
function delete_fields($table, $varkey, $data, $varverb) {
    $rows;
    if (in_array('ALL_DATA', $data)) {
        $sql = "DELETE FROM $table 
				WHERE uuid = '$varkey'";
        $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
        $rows += mysql_affected_rows();
    } else {
        foreach ($data as $f) {
            $sql = "DELETE FROM $table 
					WHERE uuid = '$varkey' AND value = '$f'";
            $result = mysql_query($sql) or die("ERROR: SYNTAX " . mysql_error());
            $rows += mysql_affected_rows();
        }
    }
    if ($varverb == true) {
        return "SUCCESS: DELETED " . $rows . " RECORDS.";
    }
    else
        return "SUCCESS: " . $rows;
}

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