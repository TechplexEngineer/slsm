<?php
session_start();
echo "<title>" .$_SESSION['version']. "</title>";
session_destroy();

?>
<meta http-equiv="refresh" content="2;url=./">
<center><img alt="Secondlife Server Managment"  src="img/logo.jpg" /></center>
<br />
<center><? echo "Sucessfully logged out..."; ?></center>

