<?php

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

        $sql = "UPDATE " . $table . " SET
				value = '" . $v . "',
				timestamp = NOW()
				WHERE uuid = '" . $varkey . "' AND field = '" . $f . "'";
        //echo $sql."<br>\n";

        $result = mysql_query($sql) or die("ERROR: SYNTAX1 " . mysql_error());

        if (mysql_affected_rows() == 0) {
            $sql = "INSERT INTO " . $table . " (uuid,field,value,timestamp)
					VALUES ('" . $varkey . "', '" . $f . "','" . $v . "',NOW())";
            $result = mysql_query($sql) or die("ERROR: SYNTAX2 " . mysql_error());
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

function authorized($userstable, $user, $pass) {
    if ($user) { //if (the field has been filled)
// username and password sent from form
        $myusername = $user;
        $mypassword = $pass;

// To protect MySQL from injection
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        $myusername = mysql_real_escape_string($myusername);
        $mypassword = mysql_real_escape_string($mypassword);

        $sql = "SELECT * FROM `" . $userstable . "` WHERE user='" . $myusername . "' and pass='" . sha1($mypassword) . "'";
        $result = mysql_query($sql) or die(mysql_error());

// If result matched $myusername and $mypassword,
// one row would have been returned
        if (mysql_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }
    }
}

//do an authorization based on key rather than username
//pass is the data_pass
function authKey($usertable, $uuid, $pass) {
    //echo "uuid: " . $uuid . " | pass:" . $pass;
    if (empty($uuid) || $uuid == "" || $uuid == " " || $uuid == null) {
        die("1Authentication Failed");
    }
    if (empty($pass) || $pass == "" || $pass == " " || $pass == null) {
        die("2Authentication Failed");
    }
    $getsql = "SELECT * FROM `" . $usertable . "` WHERE uuid='" . $uuid . "'";
    $getqry = mysql_query($getsql) or die(mysql_error());
    while ($row = mysql_fetch_assoc($getqry)) {
        $curUUID = $row['uuid'];
        $currValue = $row['data_pass'];

        if ($curUUID == $uuid)
            break;
    }
    if ($pass == $currValue) {
        //echo "Auth Success";
        return true; //Yea authorized :)
    } else {
        //return false;
        die("Authentication Failed");
    }
}
?>
