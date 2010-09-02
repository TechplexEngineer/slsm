<?php
session_start();

if(isset($_REQUEST['Submit']))
{
    include "./lib/mail.php";
    $body = "From: " . $_REQUEST['myname'] . "\n".
    "On: " . $_REQUEST['time'] . "\n".
    "At: " . $_REQUEST['errorPage'] . "\n".
    "Desc: " . $_REQUEST['description'];

    mailer($captMail,$shortname."Bug Report ", $body);
    die("<br/> Your Message has been sent to a smart person :) <br>Thanks for your time");
}
$urlErr = $_REQUEST['referrer'];//$_SERVER["REQUEST_URI"]
$urlErr = substr($urlErr, strpos($urlErr, "?"));

// @todo add different foms, bug, feature rewuest, eneral mail
?><h5>So you found a bug?</h5>
<hr>
<br/>
<form id="bugreport" name=bugreport" method="post" action="">
<table>
    <tr>
        <td width="150px">Your name is:</td>
        <td><input type="text" readonly="readonly" name="myname" value="<?php echo $_SESSION['user']; ?>"/></td>
    </tr>
    <tr>
        <td>The current time is:</td>
        <td><input type="text" readonly="readonly" name="time" value="<?php echo date('l F jS\, Y h:i:s A'); ?>"/></td>
    </tr>
    <tr>
        <td>The problem page is:</td>
        <td><input type="text" name="errorPage" value="<?php echo $urlErr; ?>"/></td>
    </tr>
    <tr>
        <td style="vertical-align: top"><br/>And the problem is:</td>
        <td><textarea cols="80" rows="5"  name="description" >Very Complex... please include what the page said, You can Copy and paste the message here, and any other helpful relevant information</textarea></td>
    </tr>
    <tr>
        <td COLSPAN=2><input type="submit" name="Submit" value=" Send My Message to a Smart Person "/></td>
    </tr>
</table>
</form>


