<?php

//function timsMail($to, $subject, $body)
//{
//    include "vars.php";
//    $headers = "From: ".$shortname."@team2648.com\r\n" .
//            "X-Mailer: php";
//    return (mail($to, $subject, $body, $headers));
//}

function mailer($to, $subject, $body)
{
    include "vars.php";
    $headers = "From: ".$shortname."@team2648.com\r\n" .
            "X-Mailer: php";
    return (mail($to, $subject, $body, $headers));
}
//$to = "techwiz@techwizworld.net";
//$subject = "Your account was successfully created";
//$body = "Greetings,\n\nBe sure to check back frequently, to track your progress.\ntechwizworld.net/TIMS";

?>
