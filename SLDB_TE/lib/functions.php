<?php

include "lib/_mysql.php";

function getUsrVal($username, $table, $want) {
    $getsql = "SELECT * FROM `" . $table . "`";
    $getqry = mysql_query($getsql) or die(mysql_error());
    while ($row = mysql_fetch_assoc($getqry)) {
        if ($row['username'] == $username)
            return $row[$want];
    }
}

function authorize($userstable, $user, $pass) {
    if ($user) { //if (the field has been filled)
// username and password sent from form
        $myusername = $user;
        $mypassword = $pass;

// To protect MySQL from injection
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        $myusername = mysql_real_escape_string($myusername);
        $mypassword = mysql_real_escape_string($mypassword);

        $sql = "SELECT * FROM `" . $userstable . "` WHERE username='" . $myusername . "' and password='" . $mypassword . "'";
        $result = mysql_query($sql) or die(mysql_error());

// If result matched $myusername and $mypassword,
// one row would have been returned
        if (mysql_num_rows($result) == 1) {
            $_SESSION['user'] = $myusername;
            $_SESSION['pass'] = $mypassword;

            $sql = "SELECT * FROM `" . $userstable . "` WHERE username='" . $myusername . "'";
            $query = mysql_query($sql) or die(mysql_error());
            $row = mysql_fetch_assoc($query);

            $_SESSION['id'] = $row['id'];
            $_SESSION['uuid'] = $row['uuid'];
            $_SESSION['SL_first'] = $row['SL_first'];
            $_SESSION['SL_last'] = $row['SL_last'];
            $_SESSION['perms'] = $row['perms'];


            $_SESSION['datatable'] = "sldb_data";
            //$_SESSION['serverstable'] = "sls_servers";
            $_SESSION['userstable'] = $userstable;
            $_SESSION['version'] = $version;

            return true;
            //send the user to the page they should view upon successfull login
            //@todo it would be nice if they could go to the page they came from.
        } else {
            return false;
        }
    }
}

//do an authorization based on key rather than username
//pass is the data_pass
function authKey($usertable, $uuid, $pass) {
    echo "authkey";
    $getsql = "SELECT * FROM `" . $usertable . "` WHERE uuid='" . $uuid . "'";
    $getqry = mysql_query($getsql) or die(mysql_error());
    while ($row = mysql_fetch_assoc($getqry)) {
        $curUUID = $row['uuid'];
        $currValue = $row['data_pass'];

        if ($curUUID == $key)
            break;
    }
    return ($pass == $currValue);
}
?>
