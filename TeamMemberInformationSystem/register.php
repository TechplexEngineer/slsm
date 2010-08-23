<?php
echo "<h3>Register yourself here</h3>";
if(!empty($_REQUEST['fname']))
{
    //The form has been submitted
    print_r($_REQUEST);
}
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script> 
<!--<script src="js/common.js" type="text/javascript"></script>-->
<script type="text/javascript" language="javascript">
$(document).ready(function() {
 $("#register").validationEngine()
});
console.log
</script>
<p><a href="#" onclick="alert($('#formID').validationEngine({returnIsValid:true}))">Return true or false without binding anything</a> |
		<a href="#" onclick="$.validationEngine.buildPrompt('#formID','This is an example','error')">Build a prompt on a div</a> |
		<a href="#" onclick="$.validationEngine.loadValidation('#date')">Load validation date</a> |
		<a href="#" onclick="$.validationEngine.closePrompt('.formError',true)">Close all prompt</a></p> 
<form id="register" name="register" method="get" action="">
    <table>
        <tr>
            <td><label for="fname">Hello, My first name is:</label><td>
            <td><input type="text" class="validate[required,custom[onlyLetter],length[0,100]]" name="fname" /><td>
        </tr>
        <tr>
            <td><label for="lname">Hello, My last name is:</label><td>
            <td><input type="text" class="validate[required,custom[onlyLetter],length[0,100]]" name="lname" /><td>
        </tr>
        <tr>
            <td><label for="pass">I want my password to be:</label><td>
            <td><input type="password" class="validate[required,length[6,20]] text-input"name="pass"/> <!--onblur="passMatch(this.form);"--><td>
        </tr>
        <tr>
            <td><label for="pass2">I am sure my password is:</label><td>
           <td><input id="pass2" type="password" class="validate[required,confirm[pass]] text-input" name="pass2"/> <!-- onblur="passMatch(this.form);"--> <td>
        </tr>
        <tr>
            <td><label for="email">My email address is:</label><td>
            <td><input type="text" class="validate[required,custom[email]] text-input" name="email" /><td>
        </tr>
        <tr>
            <td><label for="email2">I am sure my email address is:</label><td>
            <td><input type="text" class="validate[required,confirm[email]] text-input" name="email2" /><td>
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
    <?php include "lib/disclaimer.php";?>
    <br><input type="submit" name="Submit" value="I Agree, Create My account">
</form>