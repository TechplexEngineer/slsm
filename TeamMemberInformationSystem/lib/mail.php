<?php
include "vars.php";
function timsMail($to, $subject, $body)
{
//$to = "techwiz@techwizworld.net";
//$subject = "Your account was successfully created";
//$body = "Greetings,\n\nBe sure to check back frequently, to track your progress.\ntechwizworld.net/TIMS";
    $headers = "From: TIMS@team2648.com\r\n" .
            "X-Mailer: php";
    if (mail($to, $subject, $body, $headers))
    {
        echo("<p>Message sent!</p>");
    } else
    {
        echo("<p>Message delivery failed...</p>");
    }
}
//BRAIN: Blakes Remote Application INformation
?>
Blake
Brain
Robotics
Information
System
Application
Management

BAM
BRAINS
barn
rtims
Automated

BLAKE
Ballistic
Logistic
Application