<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<div class=\"widget\" style=\"width: 30%;\">";
print_r($_REQUEST);
//@todo make this prettier
echo "</div>";

$uprof = $_SERVER["REQUEST_URI"];
$uprof = substr($uprof, strpos($uprof, "?"));

//send them back to manage.profile
?>
<link href="../css/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/styling.css" rel="stylesheet" type="text/css" media="screen" />

<div class="widget" style="text-align: center;">
    <?php include "../lib/disclaimer.php"; ?>
    <br/>
    <a href="../manage.profile.php<?php echo $uprof;?>">I Agree Submit</a>
<!--  @todo I Don't agree  -->
</div>
