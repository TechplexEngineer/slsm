<?php
session_start();
ob_start("ob_gzhandler");
if (empty($_SESSION['user']))
    header("location:login.php?page=" . $_GET['page']);

//if ($_SESSION['user'] == "register")
//    $page = "register";
//else if ($_GET['page'] == "register")
//{
//    $page = "";
//    $_GET['page'] = "";
//    header("location: ./");
//} else
    $page = $_REQUEST['page'];

include "config.php";
include "vars.php";
include "hours.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title; ?></title>

        <!-- Javascript - Fix the flash of unstyled content -->
        <script type="text/javascript"></script>

        <!-- Stylesheets -->
        <link href="css/reset.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="css/styling.css" rel="stylesheet" type="text/css" media="screen" />

        <!--Validation-->

        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript"></script><link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" charset="utf-8" />


        <script src="js/common.js" type="text/javascript"></script>


        <!-- Meta Information -->
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="author" content="Techplex Engineer" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-10899272-10']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div id="header-in">
                    <?php include "parts/header.php" ?>
                </div> <!-- end #header-in -->
            </div> <!-- end #header -->
            <div id="content-wrap" class="clear lcol">
                <div class="column">
                    <div class="column-in">
                        <?php include "parts/navigation.php"; ?>
                    </div>
                </div>
                <div class="content">
                    <div class="content-in">

                        <?php
                        include "lib/functions/io.php";
                        if (empty($page))
                            if($_SESSION['user'] != "register")
                                include "parts/dashboard.php";
                            else
                                echo "I'm Sorry Something went wrong.";
                        elseif (file_exists("pages/".$page . ".php"))
                            include "pages/".$page . ".php";
                        elseif ("pages/".file_exists($page))
                            include "pages/".$page;
                        else
                            echo"ERROR 404: file '" . $page . "' could not be found <br/><br/><br/><br/><br/><br/><br/><br/>";
                        ?>
                    </div><!-- end .content-in -->
                </div> <!-- end .content -->
            </div> <!-- end #content-wrap -->
            <div id="footer">
                <div id="footer-in">
                    <?php include"parts/footer.php" ?>
                </div> <!-- end #footer-in -->
            </div> <!-- end #footer -->
        </div> <!-- end div#container -->
    </body>
</html>