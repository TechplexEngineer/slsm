<?php
include "lib/config.php";
include "lib/vars.php";
include "lib/mail.php";
if (!empty($_REQUEST['fname']))
{
    session_start();
    //The form has been submitted
    //print_r($_REQUEST);
    $usrtype = "member";
    $myusername = $_REQUEST['fname'] . "." . $_REQUEST['lname'];
    $sql = "INSERT INTO `" . $login_table . "` (`id`, `firstname`, `lastname`, `user`, `pass`, `email`, `type`) VALUES (NULL, '" . $_REQUEST['fname'] . "', '" . $_REQUEST['lname'] . "', '" . $myusername . "', '" . $_REQUEST['pass'] . "', '" . $_REQUEST['email'] . "', '" . $usrtype . "')";
    $qry = mysql_query($sql) or die(mysql_error());

    $sql = "SELECT * FROM `" . $login_table . "` WHERE user='" . $myusername . "'";
    $query = mysql_query($sql) or die(mysql_error());

    $row = mysql_fetch_assoc($query);
    $_SESSION['user'] = $row['user'];
    $_SESSION['pass'] = $row['pass'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['fullname'] = $row['firstname'] . " " . $row['lastname'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['type'] = $row['type'];
    //print_r($_SESSION);
    //session_destroy();
    
    header("location:lib/success.php");
    exit;
} else if ($_SESSION['user'] != "register")
{
    header("location:./");
}
echo "<h3>Register yourself here</h3>";
?>
<script>
    $(document).ready(function() {
        $("#register").validationEngine()
    })
</script>
<form id="register" name="register" method="post" action="register.php">
    <table>
        <tr>
            <td><label for="fname">Hello, My first name is:</label><td>
            <td><input type="text" id="fname" class="validate[required,custom[onlyLetter],length[0,100]]" name="fname" /><td>
        </tr>
        <tr>
            <td><label for="lname">Hello, My last name is:</label><td>
            <td><input type="text" id="lname" class="validate[required,custom[onlyLetter],length[0,100]]" name="lname" /><td>
                <!--                onBlur="makeUname(this.form)"-->
        </tr>
        <tr>
            <td><label for="uname">My username will be:</label><td>
            <td><input type="text" readonly="readonly" id="uname"  name="uname" /><td>
        </tr>
        <tr>
            <td><label for="pass">I want my password to be:</label><td>
            <td><input type="password" id="pass" class="validate[required,length[6,20]] text-input" name="pass"/> <!--onblur="passMatch(this.form);"--><td>
        </tr>
        <tr>
            <td><label for="pass2">I am sure my password is:</label><td>
            <td><input id="pass2" type="password" class="validate[required,confirmPass[pass]] text-input" name="pass2"/> <!-- onblur="passMatch(this.form);"--> <td>
        </tr>
        <tr>
            <td><label for="email">My email address is:</label><td>
            <td><input type="text" id="e1"class="validate[required,custom[email]] text-input" name="email" /><td>
        </tr>
        <tr>
            <td><label for="email2">I am sure my email address is:</label><td>
            <td><input type="text" id="e2"class="validate[required,confirmEmail[e1]] text-input" name="email2" /><td>
        </tr>
<!--        <tr>
            <td><label for="nickname">But I prefer to be called:</label><td>
            <td><input type="text" name="nickname" /><td>
        </tr>
        <tr>
            <td><label for="town">I live in:</label><td>
            <td><input type="text" name="town" /><td>
        </tr>
        <tr>
            <td><label for="role">My role on the team is:</label><td>
            <td><input type="text" name="role" /><td>
        </tr>
        <tr>
            <td><label for="books">Some of my favorite books are:</label><td>
            <td><input type="text" name="books" /><td>
        </tr>
        <tr>
            <td><label for="interests">Some of my favorite interests are:</label><td>
            <td><input type="text" name="interests" /><td>
        </tr>
        <tr>
            <td><label for="fav_moment">One of my favorite team moments:</label><td>
            <td><input type="text" name="fav_moment" /><td>
        </tr><tr>
            <td><label for="web">If I had a web site the address would be:</label><td>
            <td><input type="text" name="web" /><td>
        </tr><tr>
            <td><label for="gain">I would like to gain the following this year:</label><td>
            <td><input type="text" name="gain" /><td>
        </tr><tr>
            <td><label for="end">By the end of my life I will:</label><td>
            <td><input type="text" name="end" /><td>
        </tr><tr>
            <td><label for="older">When I grow up I want to:</label><td>
            <td><input type="text" name="older" /><td>
        </tr><tr>
            <td><label for="future">My future plans include:</label><td>
            <td><input type="text" name="future" /><td>
        </tr><tr>
            <td><label for="quote">My favorite quote is:</label><td>
            <td><input type="text" name="quote" /><td>
        </tr><tr>
            <td><label for="bored">Sometimes when I get bored:</label><td>
            <td><input type="text" name="bored" /><td>
        </tr><tr>
            <td><label for="passTime">My favorite way to pass time is:</label><td>
            <td><input type="text" name="passTime" /><td>
        </tr>-->
    </table>
<?php include "lib/disclaimer.php"; ?>
    <br><input type="submit" id="submit" name="Submit" value="I Agree, Create My account">
</form>