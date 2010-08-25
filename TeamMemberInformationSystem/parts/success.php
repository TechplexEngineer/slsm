<?php
session_start();

include "../lib/vars.php";
print_r($_SESSION);
echo "<title>" .$title. "</title>";
?>
<!--<meta http-equiv="refresh" content="10;url=../">-->
<center><h2>Account successfully created</h2></center>
<br />
<center><a href="../">Click here to continue....</a></center>
