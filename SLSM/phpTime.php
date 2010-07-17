<?php

include 'functions.php';
if ($_GET['cmd'] == "time")
{

    //echo "SL Time: " . $_GET['slt'] . "\n";
    //echo "PHP Time: " . time() . "\n";
    $dif = $_GET['slt'] - time();
    //echo "Difference: " . $dif . "\n";

    edit("timeDifference", $dif, $_SESSION['varstable']);
} else
{
    echo "SL Time: " . $_GET['slt'] . "\n";
    echo "PHP Time: " . time() . "\n";
    $dif = $_GET['slt'] - time();
    echo "Difference: " . $dif . "\n";
//echo time()+480;
}
?>
