<?
session_start();

if (empty($_SESSION['user']))
{
    header("location:login.php");
} else
{
    //print_r($_SESSION);
}
/* if (!session_is_registered(myusername))
  {
  header("location:login.php");
  } */
include("lib/_mysql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title> SLSM &nbsp; :|: &nbsp; V1.5 </title>
        <!-- Javascript - Fix the flash of unstyled content -->
        <script type="text/javascript"></script>

        <!-- Stylesheets -->
        <link href="css/reset.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="css/styling.css" rel="stylesheet" type="text/css" media="screen" />
        <!-- Print Stylesheet -->
        <link href="css/print.css" rel="stylesheet" type="text/css" media="print" />

        <!-- Meta Information -->
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta http-equiv="cache-control" content="public" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="expires" content="never" />
        <meta name="language" content="en" />
        <meta name="MSSmartTagsPreventParsing" content="true" />
        <meta name="robots" content="index, follow" />
        <meta name="revisit-after" content="14 days" />
        <meta name="author" content="Techplex Engineer" />

        <meta name="keywords" content="" />
        <meta name="description" content="" />

    </head>
    <body>

        <div id="container">
            <div id="header">
                <div id="header-in">
<?php include "lib/header.php"; ?>
                </div> <!-- end #header-in (provides padding)-->
            </div> <!-- end #header -->

            <div id="content-wrap" class="clear lcol">
                <div class="column">
                    <div class="column-in">
<?php include "lib/nav.php"; ?>
                    </div> <!-- end .column-in -->
                </div> <!-- end .column -->

                <div class="content">
                    <div class="content-in">
                        <h1> Welcome</h1>
                        <p>Welcome to the Second Life Server Management System (SLSMS), this system allows you to keep track of your active servers in game and store information about them (position, key, name etc) without having to worry about data loss when derezzing them.</p>
                        <p>By adding the supplied scripts inside client objects in game, you will find that there will be constant communication between your server and your clients because of the external storage capability.</p>
                        <p>One of the amazing features with this system is the ability to build your own configuration and have it stored on a database, it means that if you have several different items in game that you want to have configured centrally all you need to do is update a variable here to have it reflected in game after a sync.</p>
                        <h2>Using the System</h2>
                        <p>This website was designed with simplicity in mind, because of this you will find some simple links on the left hand side that will allow you to make changes to your system, the different sections include:</p>
                        <ul>
                            <li>Server Management - This allows you to reset, reload, disable, enable or kill any of the servers remotely.</li>
                            <li>Admin Management - This allows you to add or remove admins that have access to this site.</li>
                            <li>Configuration - This allows you to make changes to the server configuration in game.</li>
                            <li>Logout - This will log you out of this website.</li>
                        </ul>
                        <p>If you require any additional help, please contact Hero Jimador in game.</p>
                        <h2>Support</h2>
                        <p>I understand that for most people it may seem daunting to try and configure this webscript and in game script, I have made it as simple as I can with the attached documentation and video.</p>
                        <p>If however, you are unable to get the product working in the way you'd like then you are free to contact me in game and we can work out the issues that you are having.</p>
                        <p>&nbsp;</p>
                    </div> <!-- end .content-in -->
                </div> <!-- end .content -->
            </div> <!-- end #content-wrap 
            <div class="clear"></div>-->
            <div id="footer">
                <div id="footer-in">
<?php include "lib/footer.php"; ?>
                </div> <!-- end #footer-in -->
            </div> <!-- end #footer -->
        </div> <!-- end div#container -->
    </body>
</html>