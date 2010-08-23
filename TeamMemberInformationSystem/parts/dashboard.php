<?php
//echo print_r($_SESSION);
echo "<h5>Welcome to your personal dashboard " . $_SESSION['fullname'] . "</h5>";


?>
<hr/>
<div id="bio" style="display: none;">
    Your current Bio: <br/><textarea rows="10" cols="50"><?php echo $_SESSION['bio']; ?> </textarea>
</div>

<div id="profilestats" class="widget">
    <strong>IMPORTANT</strong><br/>
    <ul style="padding-left: 10px;">
        <li>You have not finished filing out your public profile <a href="?page=manage.profile">finish here</a></li>
        <li>You are missing critical information in your personal information <a href="?page=manage.info">fix here</a></li>
        <li>Your emergency contact information is incomplete or missing <a href="?page=manage.econtact">fill it in here</a></li>
    </ul>
</div>
<div id="fund_hours" class="widget">
    <strong>You have:</strong><br/>
    <ul style="padding-left: 10px;">
        <li><strong>  <?php echo $_SESSION['fhours'];?></strong> fundraising hours<br/></li>
        <li>earned <strong> $<?php echo $_SESSION['fdollars'];?></strong> fundraising<br/></li>
        <li><strong>  <?php echo $_SESSION['cchours'];?></strong> community service hours<br/></li>
        <li><strong>  <?php echo $_SESSION['bhours'];?></strong> build hours <br/></li>
    </ul>
</div>

<div class="clear"></div>
