<h3>Navigation</h3>
<ul>
    <li><a href="./">Home</a></li>
    <li><a href="servers.php">Servers</a></li>
    <li><a href="varconf.php">Variables</a></li>
    <? if($_SESSION['id'] == 1)
        echo '<li><a href="users.php">Users</a></li>';
    //else
    //    echo '<li><a href="users.php">Account</a></li>';
    ?>
    <li><a href="logout.php">Logout</a></li>
</ul>


<?
if(!empty($_SESSION['id']))
{
    echo "Logged in as: ";
    echo "<h4><a href=\"users.php\" class=\"usernameclass\">" .$_SESSION['user']. "</a></h4>";
    echo "<br />";
}


$getsql = "SELECT * FROM `" .$_SESSION['serverstable']. "`";
$getqry = mysql_query($getsql) or die(mysql_error());
if (mysql_num_rows($getqry) > 1)
    echo mysql_num_rows($getqry) . " Servers Online<br/>";
else
    echo mysql_num_rows($getqry) . " Server Online<br/>";
//$getsql = "SELECT * FROM `sls_admins`";
//$getqry = mysql_query($getsql) or die(mysql_error());
//echo mysql_num_rows($getqry) . " Admin(s) Registered";
?>