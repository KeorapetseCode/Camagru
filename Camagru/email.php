<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

function varify($toAddr, $toUsername) {
  $dir = explode("/",$_SERVER['REQUEST_URI']);
  $sr = "http://".$_SERVER['HTTP_HOST'].'/'.$dir[1].'/'."varify.php";
  $subject = "[CAMAGRU] - Email verification";
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <kmpoloke@student.wethinkcode.co.za>' . "\r\n";
  $message = '
    <html>
      <head>
        <title>' . $subject . '</title>
      </head>
      <body>
        Hello ' . htmlspecialchars($toUsername) . ' </br>
        To finalyze your subscribtion please click the link below And Login</br>
        <a href='.$sr.'>Verify E-mail Address</a>
      </body>
    </html>
    ';
    mail($toAddr, $subject, $message, $headers);
  }

  function send_forget($toAddr) {
    $dir = explode("/",$_SERVER['REQUEST_URI']);
    $sr = "http://".$_SERVER['HTTP_HOST'].'/'.$dir[1].'/'."change_password.php?mail= ". $toAddr;
    $subject = "[CAMAGRU] - Forgot Password";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: <kmpoloke@student.wethinkcode.co.za>' . "\r\n";
    $message = '
    <html>
      <head>
        <title>Password Change</title>
      </head>
      <body>
        Hello user,</br>
        To change your password please click the link below</br>
        <a href='.$sr.'>Change Password</a>
      </body>
    </html>
    ';
    mail($toAddr, $subject, $message, $headers);
  }
?>