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
    if ($_REQUEST['form'] == "econtact")
    {//Personal Infos
        //"UPDATE `tims`.`pending_profile` SET `nickname` = 'I Don''t Have One' WHERE `pending_profile`.`id` = 1;";
        $sql = "INSERT INTO `tims`.`econtact`"
                . "(`id`, `ec1_fullname`, `ec1_email`, `ec1_mailingaddress`, `ec1_homephone`, `ec1_workphone`, `ec1_cellphone`, `ec1_relation`, `ec1_bestway`) \n"
                . "VALUES ('" . $_SESSION['id'] . "', '" . $_REQUEST['ec1_fullname'] . "', '" . $_REQUEST['ec1_email'] . "', '" . $_REQUEST['ec1_mailingaddress'] . "', '" . $_REQUEST['ec1_homephone'] . "', '" . $_REQUEST['ec1_workphone'] . "','" . $_REQUEST['ec1_cellphone'] . "','" . $_REQUEST['ec1_relation'] . "','" . $_REQUEST['ec1_bestway'] . "')\n"
                . "ON DUPLICATE KEY UPDATE "
                    . "   ec1_fullname ='"          . $_REQUEST['ec1_fullname']
                    . "', ec1_email='"              . $_REQUEST['ec1_email']
                    . "', ec1_mailingaddress= '"    . $_REQUEST['ec1_mailingaddress']
                    . "', ec1_homephone='"          . $_REQUEST['ec1_homephone']
                    . "', ec1_workphone='"          . $_REQUEST['ec1_workphone']
                    . "', ec1_cellphone='"          . $_REQUEST['ec1_cellphone']
                    . "', ec1_relation='"           . $_REQUEST['ec1_relation']
                    . "', ec1_bestway='"            . $_REQUEST['ec1_bestway']
                    . "'\n";
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

$sql = "SELECT * FROM `econtact` WHERE id ='" . $_SESSION['id'] . "'";
$qry = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($qry);
?>


<h4>Emergency Contact</h4>
<strong>NOTE:</strong> None of the information provided in this form is accessible to the public.
<br />
<form id="profile" name="profile" method="get" action="pages/manage.econtact.php">
    <input type="hidden" name="form" value="econtact" >
    <table>
        <tr>
            <td><label for="ec1_fullname">Name:</label><td>
            <td><input type="text" name="ec1_fullname" value="<?php echo $row['ec1_fullname']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="ec1_email">Email Address:</label><td>
            <td><input type="text" name="ec1_email" value="<?php echo $row['ec1_email']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="ec1_mailingaddress">Mailing Address</label><td>
            <td><input type="text" name="ec1_mailingaddress" value="<?php echo $row['ec1_mailingaddress']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="ec1_homephone">Home Phone:</label><td>
            <td><input type="text" name="ec1_homephone" value="<?php echo $row['ec1_homephone']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="ec1_workphone">Work Phone:</label><td>
            <td><input type="text" name="ec1_workphone" value="<?php echo $row['ec1_workphone']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="ec1_cellphone">Cell Phone:</label><td>
            <td><input type="text" name="ec1_cellphone" value="<?php echo $row['ec1_cellphone']; ?>"/><td>
        </tr>
        <tr>
            <td><label for="ec1_relation">Relation:</label><td>
            <td><input type="text" name="ec1_relation" value="<?php echo $row['ec1_relation'];  // @todo dropdown?>"/><td>
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
        </tr>-->
        <tr>
            <td><label for="ec1_bestway">The best way to contact this person is:</label><td>
            <td><textarea name="ec1_bestway" ><?php echo $row['ec1_bestway']; ?></textarea><td>
        </tr>
    </table>

    <?php include "disclaimer.php"; ?>
    <br><input type="submit" name="Submit" value=" I Agree, Submit ">

</form>
