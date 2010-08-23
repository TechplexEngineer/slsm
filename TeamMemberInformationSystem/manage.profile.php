<?php
/*
 * need to write a sql get and fill the fields
 */
?>
<h3>Use this page to manage your profile information</h3>
<h4>Public Profile</h4>
<strong>NOTE:</strong> Fields left blank will not show on the website.
<br />
<form id="profile" name="profile" method="get" action="change.profile.php">
    <table>
        <tr>
            <td><label for="name">Hello, My name is:</label><td>
            <td><input type="text" readonly="readonly" name="name" value="<?php echo $_SESSION['fullname'];?>"/><td>
        </tr>
        <tr>
            <td><label for="nickname">But I like to be called:</label><td>
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
            <td><label for="books">I will graduate High School in:</label><td>
            <td><input type="text" name="books" /><td>
        </tr>
        <tr>
            <td><label for="interests">Some of my interests are:</label><td>
            <td><input type="text" name="interests" /><td>
        </tr>
        <tr>
            <td><label for="fav_moment">One of my favorite team moments:</label><td>
            <td><input type="text" name="fav_moment" /><td>
        </tr>
        <tr>
            <td><label for="gain">I would like to gain the following this year:</label><td>
            <td><input type="text" name="gain" /><td>
        </tr>
        <tr>
            <td><label for="future">My future plans include:</label><td>
            <td><input type="text" name="future" /><td>
        </tr>
    </table>

    <?php include "lib/disclaimer.php"; ?>
    <br><input type="submit" name="Submit" value="I Agree, Create My account">

</form>
