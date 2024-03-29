<?
session_start();

if (empty($_SESSION['user']))
{
    header("location:login.php");
}
include("lib/_mysql.php");
include("functions.php");
?>
<?

function do_xml_post($data_channel, $data_int, $data_string)
{
    $service_port = getservbyname('www', 'tcp');
    $address = gethostbyname('xmlrpc.secondlife.com');
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    $result = socket_connect($socket, $address, $service_port);

    $data = "<?xml version=\"1.0\"?><methodCall><methodName>llRemoteData</methodName><params><param><value><struct><member><name>Channel</name><value><string>$data_channel</string></value></member><member><name>IntValue</name><value><int>$data_int</int></value></member><member><name>StringValue</name><value><string>$data_string</string></value></member></struct></value></param></params></methodCall>";

    $in = "POST /cgi-bin/xmlrpc.cgi HTTP/1.1\r\n";
    $in .= "Accept: */*\r\n";
    $in .= "Accept-Language: en-gb\r\n";
    $in .= "Cache-control: no-cache\r\n";
    $in .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $in .= "Host: xmlrpc.secondlife.com\r\n";
    $in .= "Content-Length: " . strlen($data) . "\r\n\r\n";
    $in .= $data;
    socket_write($socket, $in, strlen($in));
    socket_close($socket);
}

if ($_GET['cmd'] == "del")
{
    $idtodelete = $_GET['id'];
    $getsql = "DELETE FROM `" .$_SESSION['serverstable']. "` WHERE sid=$idtodelete";
    $getqry = mysql_query($getsql) or die(mysql_error());
} else if ($_GET['cmd'] == "Send")
{
    $slcmd = $_GET['slcmd'];
    if ($_GET['sendall'] == "yes")
    {
        if ($slcmd == "kill")
        {
            $integer_var = 1;
        } else if ($slcmd == "reset")
        {
            $integer_var = 2;
        } else if ($slcmd == "st")
        {
            $string_var = $_GET['settext'];
            $integer_var = 6;
        } else if ($slcmd == "store")
        {
            $integer_var = 3;
        } else if ($slcmd == "disable")
        {
            $integer_var = 4;
        } else if ($slcmd == "enable")
        {
            $integer_var = 5;
        }
        $getsql = "SELECT sxml FROM `" . $_SESSION['serverstable'] . "`";
        $getqry = mysql_query($getsql) or die(mysql_error());
        while ($row = mysql_fetch_assoc($getqry))
        {
            do_xml_post($row['sxml'], $integer_var, $string_var);
        }
        echo "OK.";
        if ($integer_var == 1)
        {
            $getsql = "TRUNCATE TABLE " . $_SESSION['serverstable'];
            $getqry = mysql_query($getsql) or die(mysql_error());
        }
    } else
    {
        $serversarray = array();
        for ($counter = 1; $counter <= ($_GET['numrows']); $counter++)
        {
            $value = $_GET['xml' . $counter];
            $serversarray[] = $value;
//                if(empty($value))
//                    $valempty = true;
//                echo " |One" . $value .":)". $valempty . "| ";
        }
        //print_r($serversarray);

        if ($slcmd == "kill")
        {
            $integer_var = 1;
            foreach ($serversarray as $xmlid)
            {
                if (!empty($xmlid))
                {
                    do_xml_post($xmlid, $integer_var, $string_var);
                    $getsql = "DELETE FROM `" . $_SESSION['serverstable'] . "` WHERE `sxml`='$xmlid'";
                    $getqry = mysql_query($getsql) or die(mysql_error());
                }
            }
//            $servArray = array((0 => $_GET['xml'][0])
//            $idtodelete = array(0 => $_GET['xml'][0], 1 => $_GET['xml'][1]) ;
//            //$idtodelete = $_GET['xml'][0];
//            echo gettype($idtodelete);
//            print_r($idtodelete);
        } else if ($slcmd == "reset")
        {
            $integer_var = 2;
            do_xml_post($_GET['xml'], $integer_var, $string_var);
        } else if ($slcmd == "st")
        {
            $string_var = $_GET['settext'];
            $integer_var = 6;
            do_xml_post($_GET['xml'], $integer_var, $string_var);
        } else if ($slcmd == "store")
        {
            $integer_var = 3;
            do_xml_post($_GET['xml'], $integer_var, $string_var);
        } else if ($slcmd == "disable")
        {
            $integer_var = 4;
            do_xml_post($_GET['xml'], $integer_var, $string_var);
        } else if ($slcmd == "enable")
        {
            $integer_var = 5;
            do_xml_post($_GET['xml'], $integer_var, $string_var);
        }
    }
} else if ($_REQUEST['cmd'] == "store")
{
    $slsname = $_GET['name'];       // Name of the object
    $slskey = $_GET['key'];         // The sl UUID of the obj
    $slsregion = $_GET['region'];   // Name of the Region containing the obj
    $slsxml = $_GET['xml'];         // XML-RPC "channel"
    $slspos = $_GET['pos'];         // Vector position of the obj
    $slstime = $_GET['time'] - 496;       // Time in secs since unix epoch
    $slsid = $_GET['id'];           // Random ID generated by the object
    //The following lines add the
    $getsql = "REPLACE INTO `" . $serverstable . "` (`sname`, `skey`, `sxml`, `sregion`, `spos`, `stime`, `sid`) VALUES ('" . $slsname . "', '" . $slskey . "',  '" . $slsxml . "', '" . $slsregion . "', '" . $slspos . "', '" . $slstime . "', '" . $slsid . "')";
    $getqry = mysql_query($getsql) or die(mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title> SLSM &nbsp; :|: &nbsp; V1.5 </title>
        <!-- Javascript - Fix the flash of unstyled content -->
        <script type="text/javascript"></script>
        <script type="text/javascript" src="jquery-1.4.min.js"></script>
        <script type="text/javascript">
            function FillForm(xml) {
                $("#xmlrpc").val(function(i, v)
                { return xml });
            }
        </script>

        <!-- Stylesheets -->
<!--        <link href="css/reset.css" rel="stylesheet" type="text/css" media="all" />-->
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
        <meta name="language" content="en-gb" />
        <meta name="MSSmartTagsPreventParsing" content="true" />
        <meta name="robots" content="index, follow" />
        <meta name="revisit-after" content="14 days" />
        <meta name="author" content="Mitchell Bryson" />

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
                        <h1> Server Management</h1>
                        <form action="" method="get" enctype="application/x-www-form-urlencoded" name="form1" id="form1">
                            <?
                            $getsql = "SELECT * FROM `" .$_SESSION['serverstable']. "`";
                            $getqry = mysql_query($getsql) or die(mysql_error());
                            $numrows = mysql_num_rows($getqry);
                            if ($numrows > 0)
                            {
                                echo "<h3>Servers Inworld:</h3>";
                                echo "<table width='100%' border='1'>";
                                echo "<td>ID</td>";
                                echo "<td>Server Name</td>";
                                echo "<td>Key</td>";
                                echo "<td>Region</td>";
                                echo "<td>Position</td>";
                                echo "<td>Last Seen</td>";
                                echo "<td>Select</td>";
                                $res = $getqry;
                                $count = 1;
                                while ($row = mysql_fetch_assoc($res))
                                {

                                    $slsid = $row['sid'];
                                    $slsname = $row['sname'];
                                    $slskey = $row['skey'];
                                    $slsregion = $row['sregion'];
                                    $slspos = $row['spos'];
                                    $stime = $row['stime'];
                                    $slsxml = $row['sxml'];

                                    $diff = (time()) - $stime;
                                    $slstime = round(($diff) / 60, 2);

                                    //echo get("checkInTime", $_SESSION['varstable']);
                                    //echo "Diff: " . $diff;
                                    if ($diff > get("checkInTime", $_SESSION['varstable']))
                                    {
                                        $getsql = "DELETE FROM `" . $_SESSION['serverstable'] . "` WHERE sid = '" . $slsid . "'";
                                        $getqry = mysql_query($getsql) or die(mysql_error());
                                        echo "deleting " . $slsid . " diff: " . $diff; //@todo make a javascript confirm popup
                                    } else
                                    {
                                        echo "<tr>\n";
                                        echo "<td>$slsid</td>\n";
                                        echo "<td>$slsname</td>";
                                        echo "<td>$slskey</td>";
                                        //echo "<td>$slsxml</td>";
                                        echo "<td>$slsregion</td>";
                                        echo "<td>$slspos</td>";
                                        echo "<td>$slstime min</td>";

                                        //echo "<td><a href=\"#\" onClick=\"javascript:FillForm('" . $slsxml . "');return false;\"><img src=\"img/tick.gif\" border=\"0\"></a></td>\n";
                                        //echo "<td> <button onClick=\"javascript:FillForm(\'hehe\');return false;\">Input</button></td>";
                                        echo "<td><center><input type=\"checkbox\" name=\"xml" . $count . "\" value='" . $slsxml . "'/></center></td>";
                                        //echo "<td><a href=\"servers.php?cmd=del&id=$slsid\" OnClick=\"return confirm('Are you sure you want to delete $slsname? The server will be unavailable until it next syncronises.');\"><img src=\"img/cross.gif\" border\"0\"></a></td>";
                                        echo "</tr>";
                                        //@todo get length of mysql table and send it to loop above
                                    }
                                    $count +=1;
                                }
                                echo "</table>";
                            } else
                            {
                                echo "No servers.";
                            }
                            ?>

                            <h3>Server Options:</h3>
<!--                            <p>-->
                            <!--<label for="id">RPC Channel</label>
                            <input name="xml" type="text" id="xmlrpc" readonly="readonly" />-->

                            <label>
                                <input type="radio" name="slcmd" value="kill" id="RadioGroup1_0" />
                                Kill - Warning: This will destroy the object!</label>
                            <br />

                            <label>
                                <input type="radio" name="slcmd" value="reset" id="RadioGroup1_1" />
                                Reset</label>
                            <br />
                            <label>
                                <input type="radio" name="slcmd" value="disable" id="RadioGroup1_1" />
                                Disable</label>
                            <br />
                            <label>
                                <input type="radio" name="slcmd" value="enable" id="RadioGroup1_1" />
                                Enable</label>
                            <br />
                            <label>
                                <input type="radio" name="slcmd" value="store" id="RadioGroup1_2" />
                                Update Information</label>
                            <br />
                            <label>
                                <input type="radio" name="slcmd" value="st" id="RadioGroup1_2" />
                                Set Text</label>

                            <label>
                                <input type="text" name="settext" id="settext" />
                            </label>
                            <!--                            </p>-->
                            <label>
                                <input type="checkbox" name="sendall" value="yes" id="sendall_0" />
                                Send to All (May take a while)</label>
                            <br />
                            <label for="submit"></label>
                            <input type="submit" name="cmd" id="cmd" value="Send" />
                            <input type="hidden" name="numrows" id="" value="<?php echo $numrows; //@todo javascript popupt "are you sure you want to delete the selected objects from SL and the Database? Vars will be teatined but the objects will be lost FOREVER>" ?>" />
                        </form>
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