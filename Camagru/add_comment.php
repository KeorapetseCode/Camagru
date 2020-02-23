<?php
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "config/database.php";
    require "comment_noti.php";
 
    $image_id = $_POST['image_id'];
    $comment = htmlspecialchars($_POST['comment_box']);
    $user = $_SESSION['username'];

    try {
            $i = $db_conn->prepare("INSERT INTO `db_camagru` . `comments` (image_id, user_comment, comment_string) VALUES (:image_id, :user_comment, :comment)");
            $i->bindParam(':image_id', $image_id);
            $i->bindParam(':user_comment', $user);
            $i->bindParam(':comment', $comment);
            $i->execute();
        }
        catch(PDOException $erra){
            echo "Did not insert comment".$erra->getMessage();
        }
        try{
            $pic = $db_conn->prepare("SELECT * FROM `db_camagru` . `images` WHERE image_id = :image_id");
            $pic->execute(['image_id' => $image_id]);
            $results = $pic->fetch(PDO::FETCH_ASSOC);
            if ($_SESSION['username'] !== $results['user_image'])
            {
                $owner = $db_conn->prepare("SELECT * FROM `db_camagru` . `user_accounts` WHERE username = :usr");
                $owner->execute([':usr' => $results['user_image']]);
                $owner_mail = $owner->fetch(PDO::FETCH_ASSOC);
                
                if ($owner_mail['comment_notify'] == 1){
                    comment_noti($owner_mail['email'], $owner_mail['username'], $_SESSION['username']);
                }
            }
        }
        catch(PDOException $erra){
            echo "Could Not Notify The Pic Owner By Email".$erra->getMessage();
        }
        header("Location:index.php");
?>