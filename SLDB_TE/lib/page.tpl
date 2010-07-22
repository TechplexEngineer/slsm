{@beforeHTML}

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
        <meta name="author" content="{@author}" />
        <meta name="keywords" content="{@keywords}" />
        <meta name="description" content="{@description}" />
    </head>
    <body>

        <div id="container">
            {@header}
            <div id="content-wrap" class="clear lcol">
                {@nav}
                <div class="content">
                    <div class="content-in">
                        {@content}
                    </div><!-- end .content-in -->
                </div> <!-- end .content -->
            </div> <!-- end #content-wrap -->
            {@footer}
        </div> <!-- end div#container -->
    </body>
</html>
{@afterHTML}