<?php
include "vars.php";
function timsMail($to, $subject, $body)
{
    $headers = "From: TIMS@team2648.com\r\n" .
            "X-Mailer: php";
    return (mail($to, $subject, $body, $headers));
//    if ()
//    {
//        echo("<p>Message sent!</p>");
//    } else
//    {
//        echo("<p>Message delivery failed...</p>");
//    }
}
//$to = "techwiz@techwizworld.net";
//$subject = "Your account was successfully created";
//$body = "Greetings,\n\nBe sure to check back frequently, to track your progress.\ntechwizworld.net/TIMS";

?>
