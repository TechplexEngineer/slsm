<?php
session_start();
include "lib/vars.php";
echo "<title>" .$title. "</title>";
session_destroy();

?>
<meta http-equiv="refresh" content="2;url=./">
<center><h2> <?php echo $sysname; ?> </h2></center>
<br />
<center><? echo "Sucessfully logged out..."; ?></center>

