<?php
session_start();

if (empty($_SESSION['user']))
{
    header("location:login.php?page=".$_GET['page']);
}
include"lib/_mysql.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title> SLSMS | TE's edition </title>

        <!-- Javascript - Fix the flash of unstyled content -->
        <script type="text/javascript"></script>

        <!-- Stylesheets -->
        <link href="style/reset.css" rel="stylesheet" type="text/css" media="all" />
        <link href="style/default.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="style/styling.css" rel="stylesheet" type="text/css" media="screen" />

        <!-- Meta Information -->
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="author" content="Techplex Engineer" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div id="header-in">
                    <?php include "lib/header.php" ?>
                </div> <!-- end #header-in -->
            </div> <!-- end #header -->
            <div id="content-wrap" class="clear lcol">
                <div class="column">
                    <div class="column-in">
                        <?php include "lib/navigation.php"; ?>
                    </div>
                </div>
                <div class="content">
                    <div class="content-in">
                        <?php
                        $page = $_REQUEST['page'];
                        if (empty($page))
                            include "lib/home.php";
                        elseif (file_exists($page . ".php"))
                            include $page . ".php";
                        elseif (file_exists($page))
                            include $page;
                        ?>
                    </div><!-- end .content-in -->
                </div> <!-- end .content -->
            </div> <!-- end #content-wrap -->
            <div id="footer">
                <div id="footer-in">
                    <?php include"lib/footer.php" ?>
                </div> <!-- end #footer-in -->
            </div> <!-- end #footer -->
        </div> <!-- end div#container -->
    </body>
</html>