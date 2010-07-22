
<ul>
    <li><a href="./"> Main </a></li>
    <li><a href="logout.php"> Logout </a></li>
</ul>

<?
if (!empty($_SESSION['id'])) {
    echo "<br />";
    echo "Logged in as: ";
    echo "<br />";
    echo "<a href=\"users.php\">" . $_SESSION['user'] . "</a>";
    echo "<br />";
}


//        $getsql = "SELECT * FROM `" . $_SESSION['serverstable'] . "`";
//        $getqry = mysql_query($getsql) or die(mysql_error());
//        if (mysql_num_rows($getqry) > 1)
//            echo mysql_num_rows($getqry) . " Servers Online<br/>";
//        else
//            echo mysql_num_rows($getqry) . " Server Online<br/>";
?>

