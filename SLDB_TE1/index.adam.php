<?php
session_start();
if (empty($_SESSION['user']))
{
    header("location:login.php");
}

include "lib/vars.php";
include "functions.data.php";
/////////////////////////////////////////////
$nav = file_get_contents("lib/nav.php");
if (!empty($_SESSION['id']))
{
    $str;
    $str .= "<br />";
    $str .= "Logged in as: ";
    $str .= "<br />";
    $str .= "<a href=\"users.php\">" . $_SESSION['user'] . "</a>";
    $str .= "<br />";
    $nav = str_replace("{@loggedInAs}", $str, $nav);
}
/////////////////////////////
$page = file_get_contents("lib/page.html");
if(!empty($_REQUEST['page']))
{
    if($_REQUEST['page'] == vars)
    {
        $content .= "<table><tr><td>ID</td><td>UUID</td><td>Creator</td><td>Field</td><td>Value</td><td>System Variable</td><td>Timestamp</td></tr>";

//</table>
        $content = retrieve_values("sldb_data", $_SESSION['uuid'], array('test'), false, "|");
    }
}
else
{
    $content =  $_SESSION['SL_first'] ." | ". $_SESSION['SL_last'];
}




$replace =array('{@beforeHTML}' => '','{@header}' => $header,'{@nav}' => $nav,'{@content}' => $content,'{@footer}' => $footerMSG,'{@afterHTML}' => "");

foreach($replace as $k => $v)
{
    $page = str_replace($k, $v, $page);
}

echo $page;

?>
