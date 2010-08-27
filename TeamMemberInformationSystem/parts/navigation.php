<ul>
    <?php
    if($_SESSION['user'] != "register")
    {
        echo "<li><a href=\"./\"> Dashboard </a></li>";
        echo "<li><a href=\"?page=manage.profile\"> My Profile</a></li>";
        echo "<li><a href=\"?page=manage.info\"> My Info</a></li>";
        echo "<li><a href=\"?page=manage.contact\"> E Contact</a></li>";
    }
    if($_SESSION['type'] == "superuser")
    {
        echo "<li><a href=\"?page=manage.users\"> Users </a></li>";
    }
    if($_SESSION['user'] != "register")
        echo "<li><a href=\"logout.php\"> Logout </a></li>";
    else
        echo "<li><a href=\"logout.php\"> Exit </a></li>";
    ?>

    
</ul>
<?
if (!empty($_SESSION['user']) && $_SESSION['user'] != "register" )
{
    $str;
    $str .= "\t\t\t<br />\n";
    $str .= "\t\t\tLogged in as: \n";
    $str .= "\t\t\t<br />\n";
    $str .= "\t\t\t<a href=\"?page=profile\">" . $_SESSION['fullname'] . "</a>\n";
    //$str .= "\t\t\t<br />\n";
    echo $str;
}
?>