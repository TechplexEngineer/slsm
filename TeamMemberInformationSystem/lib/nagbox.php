<strong>IMPORTANT</strong><br/>
<ul style="padding-left: 10px;">
    <?php
//@todo validate info for public profile [none]
    $sql = "SELECT * FROM `pending_profile` WHERE id ='" . $_SESSION['id'] . "'";
    $qry = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($qry) > 0)
        echo "<li>Your Public Profile is pending moderation.</li>\n";
    else
        echo "<li>You have not finished filling out your public profile <a href=\"?page=manage.profile\">finish here</a></li>";

//$sql = "SELECT * FROM `public_profile` WHERE id ='" . $_SESSION['id'] . "'";
//$qry = mysql_query($sql) or die(mysql_error());
//$row1 = mysql_fetch_assoc($qry);
//
//print_r($row1);
//echo count($row1) . "<br/>";

    $sql = "SELECT * FROM `personal_information` WHERE id ='" . $_SESSION['id'] . "'";
    $qry = mysql_query($sql) or die(mysql_error());
    $row2 = mysql_fetch_assoc($qry);

    $profileIncomplete = false;
    if ($row2['homephone'] == "" || $row2['homephone'] == " ")
        $profileIncomplete = true;
    if ($row2['cellphone'] == "" || $row2['cellphone'] == " ")
        $profileIncomplete = true;
    if ($row2['medications'] == "" || $row2['medications'] == " ")
        $profileIncomplete = true;
    if ($row2['mailaddress'] == "" || $row2['mailaddress'] == " ")
        $profileIncomplete = true;
    if ($profileIncomplete)
        echo "<li>You are missing critical information in your personal information <a href=\"?page=manage.info\">fix here</a></li>";

    $sql = "SELECT * FROM `econtact` WHERE id ='" . $_SESSION['id'] . "'";
    $qry = mysql_query($sql) or die(mysql_error());
    $row3 = mysql_fetch_assoc($qry);

    $econtactIncomplete = false;
    if ($row3['ec1_fullname'] == "" || $row3['ec1_fullname'] == " ")
        $econtactIncomplete = true;
    if ($row3['ec1_email'] == "" || $row3['ec1_email'] == " ")
        $econtactIncomplete = true;
    if ($row3['ec1_mailingaddress'] == "" || $row3['ec1_mailingaddress'] == " ")
        $econtactIncomplete = true;
    if ($row3['ec1_homephone'] == "" || $row3['ec1_homephone'] == " ")
        $econtactIncomplete = true;
    if ($row3['ec1_workphone'] == "" || $row3['ec1_workphone'] == " ")
        $econtactIncomplete = true;
    if ($row3['ec1_cellphone'] == "" || $row3['ec1_cellphone'] == " ")
        $econtactIncomplete = true;
    if ($row3['ec1_relation'] == "" || $row3['ec1_relation'] == " ")
        $econtactIncomplete = true;
    if ($row3['ec1_bestway'] == "" || $row3['ec1_bestway'] == " ")
        $econtactIncomplete = true;

//$econtactIncomplete = true;
    if ($econtactIncomplete)
        echo "<li>Your emergency contact information is incomplete or missing <a href=\"?page=manage.econtact\">fill it in here</a></li>";
    ?>




</ul>