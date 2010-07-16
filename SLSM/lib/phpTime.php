<?php

echo "SL Time: " . $_GET['slt'] . "\n";
echo "PHP Time: " . time() . "\n";
$dif = $_GET['slt']-time();
echo "Difference: " . $dif . "\n";
//echo time()+480;

?>
