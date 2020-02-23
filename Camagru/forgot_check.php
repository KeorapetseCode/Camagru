<?php
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    require 'config/database.php';
    require 'email.php';
    
    session_start();
    $mail = $_POST['mail'];
    send_forget($mail);
    echo "please check your email";
?>