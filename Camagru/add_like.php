<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "config/database.php";
  
$image_id = $_POST['img_id'];
$user = $_SESSION['username'];
try {
    $i = $db_conn->prepare("INSERT INTO `db_camagru` . `likes` (image_id, user_like) VALUES (:image_id, :user_like)");
    $i->bindParam(':image_id', $image_id);
    $i->bindParam(':user_like', $user);
    $i->execute();
    header("Location:index.php");
}
catch(PDOException $erra)
{
    echo "Did not insert".$erra->getMessage();
}

?>