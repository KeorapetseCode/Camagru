<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "config/database.php";
  
$image_id = $_POST['img_id'];
$user = $_SESSION['username'];

try {
    $i = $db_conn->prepare("DELETE FROM `db_camagru` . `likes` WHERE `image_id` = :image_id AND `user_like` = :user");
    $i->bindParam(':image_id', $image_id);
    $i->bindParam(':user', $user);
    $i->execute();
    header("Location:index.php");
}
catch(PDOException $erra)
{
    echo "Could not delete".$erra->getMessage();
}
?>