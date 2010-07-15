<h3>Navigation</h3>
<ul>
    <li><a href="./">Home</a></li>
    <li><a href="servers.php">Servers</a></li>
    <li><a href="varconf.php">Variables</a></li>
    <li><a href="users.php">Users</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
<?
$getsql = "SELECT * FROM `" .$serverstable. "`";
$getqry = mysql_query($getsql) or die(mysql_error());
if (mysql_num_rows($getqry) > 1)
    echo mysql_num_rows($getqry) . " Servers Online<br/>";
else
    echo mysql_num_rows($getqry) . " Server Online<br/>";
//$getsql = "SELECT * FROM `sls_admins`";
//$getqry = mysql_query($getsql) or die(mysql_error());
//echo mysql_num_rows($getqry) . " Admin(s) Registered";
?>