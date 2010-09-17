<?php
session_start(); //not sure if i need this or not //I Do since its an external file
// This file is requested using ajax from the main dashboard because it takes so long to load,
// as to not slow down the usage of the rest of the page.

if (!empty($_GET['name']))
{
    if (empty($_SESSION['fhrs']))
    {
        //die ($col);
        include "hours.php";
        // GetCollumn of which C#R1 = users name
        $col = getCol($_GET['name']);

        if($col == "error")
            die("User Missing From Database");
            //@todo sned message to blake
            //@todo account approval


        // then get cell from each of the sheets for that user,
        // assuming they are in the same column of each sheet
        $s1 = getcell(3, $col, 1);
        $s2 = getcell(3, $col, 2);
        $s3 = getcell(3, $col, 3);
        $s4 = getcell(3, $col, 4);
        // Store my loot in the session varibles,
        // so next time I want this, I don't need to fetch it
        $_SESSION['fhrs'] = $s1;
        $_SESSION['fdol'] = $s2;
        $_SESSION['chrs'] = $s3;
        $_SESSION['bhrs'] = $s4;
    }
}
//print_r($_SESSION);
?>
<!-- and finally output the information formated for the widget-->
<strong>You have:</strong><br/>
<ul style="padding-left: 10px;">
    <li>        <strong><?php echo $_SESSION['fhrs']; ?></strong> of 30 fundraising hours<br/></li>
    <li>fundraised $<strong><?php echo $_SESSION['fdol']; ?></strong> of $300<br/></li>
    <li>        <strong><?php echo $_SESSION['chrs']; ?></strong> of 5 community service hours<br/></li>
    <li>        <strong><?php echo $_SESSION['bhrs']; ?></strong> of 40 build hours <br/></li>
</ul>
