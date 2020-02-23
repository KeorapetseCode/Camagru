
<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "config/database.php";
   	
   	if (isset($_POST['base_str'])){
		$str = $_POST['base_str'];
		$img = str_replace('data:image/png;base64,', '', $str);
		$img = str_replace(' ', '+', $img);
		$image_bin = base64_decode($img);
		$d = date('Y-m-d')." ".date("h:i:s");
        
        try{
        	$db_upload = $db_conn->prepare("INSERT INTO `db_camagru`.`images`(user_image, date_of_creation, image_file) VALUES (:owner, :upload_date, :img_file)");
        	$db_upload->bindParam(':owner', $_SESSION['username']);
        	$db_upload->bindParam(':upload_date', $d);
        	$db_upload->bindParam(':img_file', $image_bin);
        	$db_upload->execute();	
        }
        catch(PDOException $erra){
        	echo "Did Not Insert The Captured Image";
        }
    }
  
?>
