<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require 'setup.php';

	$db_var = "CREATE DATABASE IF NOT EXISTS db_camagru";	
	$db = $db_conn->prepare($db_var);
	$db->execute();
	try
	{
		$tab_var = "CREATE TABLE IF NOT EXISTS `db_camagru`.`user_accounts` ( 
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY  , 
		`username` VARCHAR(30)  NOT NULL ,
		`email` VARCHAR(50) NOT NULL ,
		`password` VARCHAR(100) NOT NULL , 
		`varify` INT(1) DEFAULT 0 , 
		`comment_notify` INT(1) DEFAULT 0)";
		$db = $db_conn->prepare($tab_var);
		 $db->execute();
		
		$tab_pic = "CREATE TABLE IF NOT EXISTS `db_camagru`.`images` (
		`image_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
		`user_image` VARCHAR(30) NOT NULL , 
		`date_of_creation` DATETIME NOT NULL , 
		`image_file` LONGBLOB NOT NULL)";
		 $pic_var = $db_conn->prepare($tab_pic);
		 $pic_var->execute();

		 $like_tab = "CREATE TABLE IF NOT EXISTS `db_camagru`.`likes` (
		`like_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`image_id` INT NOT NULL ,
		`user_like` VARCHAR(30) NOT NULL)";
		$like_var = $db_conn->prepare($like_tab);
		$like_var->execute();
		
		$comment_tab = "CREATE TABLE IF NOT EXISTS `db_camagru`.`comments` (
		`comment_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
		`image_id` INT NOT NULL , 
		`user_comment` VARCHAR(30) NOT NULL , 
		`comment_string` VARCHAR(225) NOT NULL)";
		$comment_var =$db_conn->prepare($comment_tab);
		$comment_var->execute();
	}
    catch (PDOException $err)
    {
		echo "Connot Create Table_".$err->getMessage();
	}
?>