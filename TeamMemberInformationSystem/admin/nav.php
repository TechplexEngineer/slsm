<?php
if ($_SESSION['type'] == "superuser" || $_SESSION['type'] == "admin" )
{
    echo "<li> Management </li>";
    echo "<ul>";
    echo "<li><a href=\"?page=manage.users\"> Users </a></li>";
    echo "<li><a href=\"?page=email\"> Email </a></li>";
    echo "</ul>";
}
?>

