<?php

$to = "recipient@team2648.com";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";

if (mail($to, $subject, $body))
{
    echo("<p>Message sent!</p>");
} else
{
    echo("<p>Message delivery failed...</p>");
}
?>