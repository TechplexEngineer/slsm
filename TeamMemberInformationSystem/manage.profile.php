<?php

$sql = "SELECT * FROM `pending_profile` WHERE id ='" .$_SESSION['id']."'";
$qry = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($qry);



?>
<!--<h3>Use this page to manage your profile information</h3>-->
<h4>Public Profile</h4>
<strong>NOTE:</strong> Fields left blank will not show on the website.
<br />
<form id="profile" name="profile" method="get" action="lib/change.php">
    <input type="hidden" value="profile" name="form">
    <table>
        <tr>
            <td><label for="myname">Hello, My name is:</label><td>
            <td><input type="text" readonly="readonly" name="myname" value="<?php echo $_SESSION['firstname'];?>"/><td>
        </tr>
        <tr>
            <td><label for="nickname">But I like to be called:</label><td>
            <td><input type="text" name="nickname" value="<?php echo $row['nickname'];?>"/><td>
        </tr>
        <tr>
            <td><label for="town">I live in:</label><td>
            <td><input type="text" name="town" value="<?php echo $row['location'];?>"/><td>
        </tr>
        <tr>
            <td><label for="role">My role on the team is:</label><td>
            <td><input type="text" name="role" value="<?php echo $row['role'];?>"/><td>
        </tr>
        <tr>
            <td><label for="yog">I will graduate High School in:</label><td>
            <td><input type="text" name="yog" value="<?php echo $row['yog'];?>"/><td>
        </tr>
        <tr>
            <td><label for="interests">Some of my interests are:</label><td>
            <td><input type="text" name="interests" value="<?php echo $row['interests'];?>"/><td>
        </tr>
        <tr>
            <td><label for="fav_moment">One of my favorite team moments:</label><td>
            <td><input type="text" name="fav_moment" value="<?php echo $row['favMoment'];?>"/><td>
        </tr>
        <tr>
            <td><label for="gain">I would like to gain the following this year:</label><td>
            <td><input type="text" name="gain" value="<?php echo $row['gainThisYr'];?>"/><td>
        </tr>
        <tr>
            <td><label for="future">My future plans include:</label><td>
            <td><input type="text" name="future" value="<?php echo $row['futurePlans'];?>"/><td>
        </tr>
        <tr>
            <td><label for="bio">My Bio:</label><td>
            <td><textarea name="bio" ><?php echo $row['bio'];?></textarea><td>
        </tr>
    </table>

    <?php include "lib/disclaimer.php"; ?>
    <br><input type="submit" name="Submit" value=" I Agree, Submit ">

</form>
