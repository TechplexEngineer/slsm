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
    if (timsMail($to, $subject, $body))
    {
        //echo "Email: " . $_SESSION['email'];
        //echo "You should recieve an email at " . $_SESSION['email'] . " shortly, in the meantime head on over to your dashboard";
    }
}
?>
<!--<meta http-equiv="refresh" content="10;url=../">-->
<center><h2>Account successfully created</h2></center>
<br />
<center><a href="../">Let me see my dashboard!</a></center>
