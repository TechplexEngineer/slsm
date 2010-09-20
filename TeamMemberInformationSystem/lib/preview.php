<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<div class=\"widget\" style=\"width: 30%;\">";
echo "This part is still under development <br/> preview comming soon";
//print_r($_REQUEST);

//@todo make this prettier
//@todo 'let me make a change'
echo "</div>";

$urlProf = $_SERVER["REQUEST_URI"];
$urlProf = substr($urlProf, strpos($urlProf, "?"));

//send them back to manage.profile
?>
<link href="../css/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/styling.css" rel="stylesheet" type="text/css" media="screen" />

<div class="widget" style="text-align: center;">
    <?php include "disclaimer.php"; ?>
    <br/>
    <a href="../pages/manage.profile.php<?php echo $urlProf;?>">I Agree Submit</a>
<!--  @todo I Don't agree  -->
</div>
