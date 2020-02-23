<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "config/database.php";

try{
	$del = $db_conn->prepare("DELETE FROM `db_camagru` . `images` WHERE `images`.`image_id` =:mm");
	$del->bindParam(':mm', $_GET['image_id']);
	$del->execute();
}
catch(PDOException $err){
	echo "Could not delete image".$err->getMessage();
}
try{
	$del_com = $db_conn->prepare("DELETE FROM `db_camagru` . `comments` WHERE `comments`.`image_id` = :v");
	$del_com->bindParam(':v', $_GET['image_id']);
	$del_com->execute();
}
catch(PDOException $err){
	echo "Could not delete comment".$err->getMessage();
}
try{
	$del_like = $db_conn->prepare("DELETE FROM `db_camagru` . `likes` WHERE `likes`.`image_id` = :l");
	$del_like->bindParam(':l', $_GET['image_id']);
	$del_like->execute();
}
catch(PDOException $err){
	echo "Could not delete like".$err->getMessage();
}
header("Location: index.php");
?>