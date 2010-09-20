<?php
session_start();
if (empty($_SESSION['user'])) //check this code!!1
{
    exit;
}

if (isset($_REQUEST['Submit']))
{
    //echo "Let's process this form!\n";

    //die(print_r($_REQUEST));
    include "config.php";
    include "mail.php";
    if ($_REQUEST['form'] == "info")
    {//Personal Infos
        //"UPDATE `tims`.`pending_profile` SET `nickname` = 'I Don''t Have One' WHERE `pending_profile`.`id` = 1;";
        $sql = "INSERT INTO `tims`.`personal_information`"
                . "(`id`, `homephone`, `cellphone`, `medications`, `mailaddress`) \n"
                . "VALUES ('" . $_SESSION['id'] . "', '" . $_REQUEST['homephone'] . "', '" . $_REQUEST['cellphone'] . "', '" . $_REQUEST['medications'] . "', '" . $_REQUEST['mailaddress'] . "')\n"
                . "ON DUPLICATE KEY UPDATE homephone ='" . $_REQUEST['homephone'] . "', cellphone='" . $_REQUEST['cellphone'] . "', medications= '" . $_REQUEST['medications'] . "', mailaddress='" . $_REQUEST['mailaddress'] . "'\n";
        $qry = mysql_query($sql) or die(mysql_error());

        //SQL 4 email
        $sql ="UPDATE `tims_users` SET email = '" .$_REQUEST['email']."' WHERE id = ". $_SESSION['id'];
        $qry = mysql_query($sql) or die(mysql_error());

//@todo overlay this
//http://flowplayer.org/tools/overlay/index.html
        

        echo "<link href=\"../css/styling.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
        echo "<div class =\"widget\" style=\"width:350px\">";
        echo "Your changes have been saved";
        echo "<br>";
        echo "<a href=\"../\">Click here to continue</a>";
        echo "</div>";
    }
    exit;
}

$sql = "SELECT * FROM `personal_information` WHERE id ='" . $_SESSION['id'] . "'";
$qry = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($qry);

$sql1 ="SELECT * FROM `tims_users` WHERE  id ='" . $_SESSION['id'] . "'";
        $qry1 = mysql_query($sql1) or die(mysql_error());
        $row1 = mysql_fetch_assoc($qry1);
?>
<!--<h3>Use this page to manage your profile information</h3>-->
<h4>Private Information</h4>
<strong>NOTE:</strong> None of the information provided in this form is accessible to the public.
<br />
<form id="profile" name="profile" method="get" action="pages/manage.info.php">
    <input type="hidden" name="form" value="info" >
    <table>
        <tr>
            <td><label for="myname">Hello, My name is:</label><td>
            <td><input type="text" readonly="readonly" name="myname" value="<?php echo $_SESSION['fullname']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="email">My Email Address is:</label><td>
            <td><input type="text" name="email" style="width: 150%;" value="<?php echo $row1['email']; //@todo email is in a diff table ?>"/><td>
        </tr>
        <tr>
            <td><label for="mailaddress">My Full Mailing Address is</label><td>
            <td><input type="text" name="mailaddress" style="width: 150%;" value="<?php echo $row['mailaddress']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="homephone">My Home Phone number is:</label><td>
            <td><input type="text" name="homephone" value="<?php echo $row['homephone']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="cellphone">My Cell Phone number is:</label><td>
            <td><input type="text" name="cellphone" value="<?php echo $row['cellphone']; ?>"/><td>
        </tr>
<!--        <tr>
            <td><label for="pi_medications">The Medications I take are:</label><td>
            <td><input type="text" name="pi_medications" value="<?php //echo $row['pi_medications'];  ?>"/><td>
        </tr>-->
<!--        <tr>
            <td><label for="fav_moment">One of my favorite team moments:</label><td>
            <td><input type="text" name="fav_moment" value="<?php // echo $row['favMoment'];  ?>"/><td>
        </tr>
        <tr>
            <td><label for="gain">I would like to gain the following this year:</label><td>
            <td><input type="text" name="gain" value="<?php // echo $row['gainThisYr'];  ?>"/><td>
        </tr>
        <tr>
            <td><label for="future">My future plans include:</label><td>
            <td><input type="text" name="future" value="<?php // echo $row['futurePlans'];  ?>"/><td>
        </tr>-->
        <!--        <tr>
            <td><label for="pi_medications">The Medications I take are:</label><td>
            <td><input type="text" name="pi_medications" value="<?php //echo $row['pi_medications'];  ?>"/><td>
        </tr>
        @todo text areas aren't big enough
        -->
        <tr>
            <td><label for="medications">The Medications I take are:</label><td>
            <td><textarea style="width: 150%;" name="medications" ><?php echo $row['medications']; ?></textarea><td>
        </tr>
    </table>

<?php include "disclaimer.php"; ?>
    <br><input type="submit" name="Submit" value=" I Agree, Submit ">

</form>
