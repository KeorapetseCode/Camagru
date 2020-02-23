<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function comment_noti($toAddr, $toUsername, $com_writer){

    $subject = "[CAMAGRU] - Email Notification";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: <kmpoloke@student.wethinkcode.co.za>' . "\r\n";
    $message = '
    <html>
      <head>
        <title>' . $subject . '</title>
      </head>
      <body>
        Hello ' . htmlspecialchars($toUsername) . ', </br>
        '. $com_writer . ' has commented on your picture.</br>
      </body>
    </html>
    ';
    mail($toAddr, $subject, $message, $headers);
}
?>