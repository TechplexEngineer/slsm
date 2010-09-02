<?php
session_start();

include "vars.php";
include "mail.php";
//print_r($_SESSION);
echo "<title>" . $title . "</title>";

$to = $_SESSION['email'];
$subject = "Your " . $shortname . " Account Successfully Created";
$body = "Your account was successfully created on " . $shortname . ".\n" .
        "Your username is " . $_SESSION['user'] . "\n\n" .
        "In order to login please visit:\n" .
        $sysurl . "\n\n\n" .
        "Best," .
        "Blake";

if (!empty($to))
{
    //echo "Email: " . $_SESSION['email'];
    if (mailer($to, $subject, $body))
    {
        //echo "Email: " . $_SESSION['email'];
        //echo "You should recieve an email at " . $_SESSION['email'] . " shortly, in the meantime head on over to your dashboard";
    }
}
?>
<!--<meta http-equiv="refresh" content="10;url=../">-->
<link href="../css/styling.css" rel="stylesheet" type="text/css" media="screen" />
<center>
    <div class="widget" style="float: center; width: 50%">
        <center><h2>Account successfully created</h2></center>
        <br />
        <strong> Please NOTE:</strong> This site's advanced features <strong>DO NOT</strong> work in Internet Explorer. <br/>
        For the best experience I recommend <a href="http://chrome.google.com" target="_blank"> Chrome by Google </a><br/><br/>
        <center><a href="../">Let me see my dashboard!</a></center>
    </div>
</center>
