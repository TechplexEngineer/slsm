<?php

include("lib/_mysql.php");
include "functions.php";

function emptyVars() {
    $name2Add = null;
    $value2Add = null;
    $getsql = null;
    $getqry = null;
    $row = null;
}

if (!empty($_GET['user']) && !empty($_GET['pass'])) {
    $myusername = $_GET['user'];
    $mypassword = $_GET['pass'];

//write a function in _mysql to store username
// To protect MySQL injection (more detail about MySQL injection)
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);
    $myusername = mysql_real_escape_string($myusername);
    $mypassword = mysql_real_escape_string($mypassword);

    $sql = "SELECT * FROM `" . $userstable . "` WHERE username='" . $myusername . "' and password='" . $mypassword . "'";
    $result = mysql_query($sql);

// Mysql_num_row is counting table row

    $count = mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
    //echo $count;
    if ($count == 1)
    {
        if ($_GET['cmd'] == "create") {//will this work with $_GET
            //  /vars.php?cmd=create&name=[__]&value=[__]
            //add a new value
            create($_GET['name'], $_GET['value']);
            echo "Created";
            emptyVars();
        } elseif ($_GET['cmd'] == "edit") {
            //  /vars.php?cmd=edit&name=[__]&newVal=[__]
            edit($_GET['name'], $_GET['value']);
            echo "Edited";
            emptyVars();
        } elseif ($_GET['cmd'] == "get") {
            //mysql request for $_GET['name']
            echo get($_GET['name']);
            emptyVars();

            //echo $getqry;
        } elseif ($_GET['cmd'] == "list") {
            $getsql = "SELECT * FROM `" . $varstable . "`";
            $getqry = mysql_query($getsql) or die(mysql_error());
            while ($row = mysql_fetch_assoc($getqry)) {
                $curName = $row['config_name'];
                $curValue = $row['config_value'];
                echo $curName;
                echo " :|: ";
                echo $curValue;
                echo "<br>";
            }
        } elseif ($_GET['cmd'] == "getconf") {
            echo "conf,";
            $getsql = "SELECT * FROM `" . $varstable . "`";
            $getqry = mysql_query($getsql) or die(mysql_error());
            while ($row = mysql_fetch_assoc($getqry)) {
                echo $row['config_name'] . "," . $row['config_value'] . ",";
            }
        } else {
            echo "<html>";
            echo "<h1>This file provides for access to database varibles </h1>";
            echo "<h3>Commands you can use:</h3>";
            echo " create: &nbsp; &nbsp; /vars.php?cmd=create&name=[__]&value=[__]<br>";
            echo " edit: &nbsp; &nbsp; &nbsp; &nbsp;/vars.php?cmd=edit&name=[__]&newVal=[__]<br>";
            echo " list: &nbsp; &nbsp; &nbsp; &nbsp; /vars.php?cmd=list<br>";
            echo " getconf: &nbsp;/vars.php?cmd=getconf <br><br>";
            echo "NOTE: &nbsp; '[__]' is not part of the required syntax, but is used to show that a value must be inserted in its place";
            echo "</html>";
        }
    }
    else
        echo "Please login to see your options";
        echo "the format is:";
        echo "vars.php?user=[__]&pass=[__]";
}
?>