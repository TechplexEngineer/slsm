<?php
session_start();
if (empty($_SESSION['user']) && empty($_REQUEST['form'])) //check this code!!1
{
    exit;
}
if (isset($_REQUEST['Submit']))
{
    //echo "Let's process this form!";
    include "lib/config.php";
    include "lib/mail.php";
    if ($_REQUEST['form'] == "profile")
    {//public profile
        //print_r($_REQUEST);
        //"UPDATE `tims`.`pending_profile` SET `nickname` = 'I Don''t Have One' WHERE `pending_profile`.`id` = 1;";
        $sql = "INSERT INTO `tims`.`pending_profile`"
                . "(`id`, `nickname`, `location`, `role`, `yog`, `interests`, `favMoment`, `gainThisYr`, `futurePlans`, `bio`) \n"
                . "VALUES ('" . $_SESSION['id'] . "', '" . $_REQUEST['nickname'] . "', '" . $_REQUEST['town'] . "', '" . $_REQUEST['role'] . "', '" . $_REQUEST['yog'] . "', '" . $_REQUEST['interests'] . "', '" . $_REQUEST['fav_moment'] . "', '" . $_REQUEST['gain'] . "', '" . $_REQUEST['future'] . "', '" . $_REQUEST['bio'] . "')\n"
                . "ON DUPLICATE KEY UPDATE nickname ='" . $_REQUEST['nickname'] . "', location='" . $_REQUEST['town'] . "', role= '" . $_REQUEST['role'] . "', yog='" . $_REQUEST['yog'] . "', interests='" . $_REQUEST['interests'] . "', favMoment='" . $_REQUEST['fav_moment'] . "', gainThisYr='" . $_REQUEST['gain'] . "', futurePlans='" . $_REQUEST['future'] . "', bio='" . $_REQUEST['bio'] . "'\n";
        $qry = mysql_query($sql) or die(mysql_error());

//@todo overlay this
//http://flowplayer.org/tools/overlay/index.html
        //send mail to moderators
        include "lib/vars.php";
        $to = $captMail;
        $prof = implode("\n", $_REQUEST);
        $subject = "Moderation Needed";
        $body = $_SESSION['fullname'] . " Has just changed their public profile.\n" .
                "Please login here to moderate their changes:\n" .
                //"http://team2648.com/OPIS/login.php?page=manage".
                "http://www." . $sysurl . "/login.php?page=manage\n" .
                "Best,\n" .
                "Blake\n\n\n" .
                "Click here to accept the profile bleow\n\n" .
                "http://www." . $sysurl . "/login.php?page=manage&acceptID=".$_SESSION['id']."\n" .
                $prof;
        timsMail($to, $subject, $body);
        $to = $mentorMail;
        timsMail($to, $subject, $body);

        echo "<link href=\"../css/styling.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
        echo "<div class =\"widget\" style=\"width:350px\">";
        echo "Your changes have been saved, they will not go live until reviewed by a moderator";
        echo "<br>";
        echo "<a href=\"./\">Click here to continue</a>";
        echo "</div>";
    }
    exit;
}
$sql = "SELECT * FROM `pending_profile` WHERE id ='" . $_SESSION['id'] . "'";
$qry = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($qry);
?>
<!--<h3>Use this page to manage your profile information</h3>-->
<h4>Public Profile</h4>
<strong>NOTE:</strong> Fields filled with [NONE] will not show on the website.
<br />
<form id="profile" name="profile" method="get" action="lib/preview.php">
    <input type="hidden" value="profile" name="form">
    <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="id">
    <table>
        <tr>
            <td><label for="myname">Hello, My name is:</label><td>
            <td><input type="text" readonly="readonly" name="myname" value="<?php echo $_SESSION['firstname']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="nickname">But I like to be called:</label><td>
            <td><input type="text" name="nickname" value="<?php echo $row['nickname']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="town">I live in:</label><td>
            <td><input type="text" name="town" value="<?php echo $row['location']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="role">My role on the team is:</label><td>
            <td><input type="text" name="role" value="<?php echo $row['role']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="yog">I will graduate High School in:</label><td>
            <td><input type="text" name="yog" value="<?php echo $row['yog']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="interests">Some of my interests are:</label><td>
            <td><input type="text" name="interests" value="<?php echo $row['interests']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="fav_moment">One of my favorite team moments:</label><td>
            <td><input type="text" name="fav_moment" value="<?php echo $row['favMoment']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="gain">I would like to gain the following this year:</label><td>
            <td><input type="text" name="gain" value="<?php echo $row['gainThisYr']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="future">My future plans include:</label><td>
            <td><input type="text" name="future" value="<?php echo $row['futurePlans']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="bio">My Bio:</label><td>
            <td><textarea name="bio" ><?php echo $row['bio']; ?></textarea><td>
        </tr>
    </table>
    * All fields are required.
<?php
include "lib/disclaimer.php";
// @todo add js validation of all fields filled in
?>
    <br><input type="submit" name="Submit" value=" I Agree, Preview "/>

</form>
