<?php

echo "Manage";
$user = $_REQUEST['user'];
$pass = $_REQUEST['pass'];

if (empty($user)) {
    $user = $_REQUEST['key'];
    if (empty($user))
        die("");//User empty
}
if (empty($pass)) {
    $user = $_REQUEST['secret'];
    if (empty($user))
        die("pass empty");
}

if (!authorize($users_table, $user, $pass)) {
    die("ERROR: NOT AUTHENTICATED");
}
?>
