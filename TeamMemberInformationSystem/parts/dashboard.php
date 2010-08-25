<?php
//echo print_r($_SESSION);
echo "<h5>Welcome to your personal dashboard " . $_SESSION['fullname'] . "</h5>";
?>
<hr id="hr1"/>
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

<div id="cal" class="widget">
<!--    <iframe src="https://www.google.com/calendar/hosted/team2648.com/embed?showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;mode=AGENDA&amp;height=200&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=team2648.com_a1ur39fpp2cn076ak2q06o8hhc%40group.calendar.google.com&amp;color=%235229A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="400" height="200" frameborder="0" scrolling="no"></iframe>-->
    <iframe src="https://www.google.com/calendar/hosted/team2648.com/embed?showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=200&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=team2648.com_a1ur39fpp2cn076ak2q06o8hhc%40group.calendar.google.com&amp;color=%235229A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="400" height="200" frameborder="0" scrolling="no"></iframe>
</div>
<?php
if ($_SESSION['type'] == "member")
{
    if (empty($_SESSION['fhrs']))
    {
        echo "<script>";
        echo "var fullname = \"" . $_SESSION['fullname'] . "\";";
        echo "ajaxStats(fullname);";
        echo "</script>";
        echo "<div id=\"stats\" class=\"widget\">";
        echo "Loading Stats...";
        echo "<img alt=\"Loading Stats\"  src=\"img/ajax-loader.gif\"/>";
        echo "</div>";
    }
    else
    {
        echo "<div id=\"stats\" class=\"widget\">";
        include "lib/dashboard.stats.php";
        //echo"good";
        //echo $_SESSION['fhrs'];
        echo "</div>";
    }
}
?>


<div class="clear"></div>
