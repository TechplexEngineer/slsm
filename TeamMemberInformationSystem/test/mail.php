<?php

//
//$to = "recipient@team2648.com";
//$subject = "Hi!";
//$body = "Hi,\n\nHow are you?";
//
//if (mail($to, $subject, $body))
//{
//    echo("<p>Message sent!</p>");
//} else
//{
//    echo("<p>Message delivery failed...</p>");
//}
?>

<?php

$to = "techwiz@techwizworld.net";
$subject = "Your account was successfully created";
$body = "Greetings,\n\nBe sure to check back frequently, to track your progress.\ntechwizworld.net/TIMS";
$headers = "From: TIMS@team2648.com\r\n" .
        "X-Mailer: php";
if (mail($to, $subject, $body, $headers))
{
    echo("<p>Message sent!</p>");
} else
{
    echo("<p>Message delivery failed...</p>");
}
?>
