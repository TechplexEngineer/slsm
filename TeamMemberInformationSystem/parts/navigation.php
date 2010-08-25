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
    ?>
    <li><a href="logout.php"> Logout </a></li>
</ul>
<?
//if (!empty($_SESSION['id']) && $_SESSION['id'] >= 0 )
//{
    $str;
    $str .= "\t\t\t<br />\n";
    $str .= "\t\t\tLogged in as: \n";
    $str .= "\t\t\t<br />\n";
    $str .= "\t\t\t<a href=\"?page=profile\">" . $_SESSION['fullname'] . "</a>\n";
    //$str .= "\t\t\t<br />\n";
    echo $str;
//}
?>