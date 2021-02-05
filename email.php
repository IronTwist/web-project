<?php
$to = "";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: ";

mail($to,$subject,$txt,$headers);
?>