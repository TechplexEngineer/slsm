<!--        <h4>Private Profile</h4>
        Full Name:
        Email Address:
        Mailing Address:
        Home Phone:
        CellPhone:
        Medications

-->

<?php
session_start();
if (empty($_SESSION['user'])) //check this code!!1
{
    exit;
}
$sql = "SELECT * FROM `full_profile` WHERE id ='" . $_SESSION['id'] . "'";
$qry = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($qry);
?>
<!--<h3>Use this page to manage your profile information</h3>-->
<h4>Private Information</h4>
<strong>NOTE:</strong> None of the information provided in this form is accessible to the public.
<br />
<form id="profile" name="profile" method="get" action="lib/change.php">
    <input type="hidden" value="info" name="form">
    <table>
        <tr>
            <td><label for="myname">Hello, My name is:</label><td>
            <td><input type="text" readonly="readonly" name="myname" value="<?php echo $_SESSION['firstname']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="email">My Email Address is:</label><td>
            <td><input type="text" name="email" value="<?php echo $row['email']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="mail">My Full Mailing Address is</label><td>
            <td><input type="text" name="mail" value="<?php echo $row['pi_mailaddress']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="pi_homephone">My Home Phone number is:</label><td>
            <td><input type="text" name="pi_homephone" value="<?php echo $row['pi_homephone']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="pi_cellphone">My Cell Phone number is:</label><td>
            <td><input type="text" name="pi_cellphone" value="<?php echo $row['pi_cellphone']; ?>"/><td>
        </tr>
<!--        <tr>
            <td><label for="pi_medications">The Medications I take are:</label><td>
            <td><input type="text" name="pi_medications" value="<?php //echo $row['pi_medications']; ?>"/><td>
        </tr>-->
<!--        <tr>
            <td><label for="fav_moment">One of my favorite team moments:</label><td>
            <td><input type="text" name="fav_moment" value="<?php // echo $row['favMoment']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="gain">I would like to gain the following this year:</label><td>
            <td><input type="text" name="gain" value="<?php // echo $row['gainThisYr']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="future">My future plans include:</label><td>
            <td><input type="text" name="future" value="<?php // echo $row['futurePlans']; ?>"/><td>
        </tr>-->
        <!--        <tr>
            <td><label for="pi_medications">The Medications I take are:</label><td>
            <td><input type="text" name="pi_medications" value="<?php //echo $row['pi_medications']; ?>"/><td>
        </tr>-->
        <tr>
            <td><label for="pi_medications">The Medications I take are:</label><td>
            <td><textarea name="pi_medications" ><?php echo $row['pi_medications']; ?></textarea><td>
        </tr>
    </table>

<?php include "lib/disclaimer.php"; ?>
    <br><input type="submit" name="Submit" value=" I Agree, Submit ">

</form>
