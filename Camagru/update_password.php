<?php
require 'config/database.php';
$mail = $_POST['mail'];
$password = $_POST['password'];
$ver_password = $_POST['ver_password'];

if (!($password == $ver_password))
{
    header("Location: change_password.php");
    die;
}
$password = md5($password);
try{
    $update = $db_conn->prepare("UPDATE db_camagru . user_accounts SET `password` = :password WHERE email = :mail");
    $update->bindParam(':password', $password);
    $update->bindParam(':mail', $mail);
    $update->execute();
    header("Location: log_in.php?updated='success'");
}
catch(PDOException $erra)
{
    echo "Did not update".$erra->getMessage();
}

?>