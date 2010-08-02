<ul>
                            <li><a href="./"> Main </a></li>
                            <li><a href="?page=manage.data"> Data </a></li>
                            <li><a href="logout.php"> Logout </a></li>
                        </ul>
<?
if (!empty($_SESSION['id']))
{
    $str;
    $str .= "\t\t\t<br />\n";
    $str .= "\t\t\tLogged in as: \n";
    $str .= "\t\t\t<br />\n";
    $str .= "\t\t\t<a href=\"users.php\">" . $_SESSION['user'] . "</a>\n";
    $str .= "\t\t\t<br />\n";
    echo $str;
}
?>