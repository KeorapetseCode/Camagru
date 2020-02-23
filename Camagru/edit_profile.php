<?php
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
    session_start();

    require "config/database.php";
    if (isset($_POST['comm_not'])){
        if ($_SESSION['comment_noti'] == 1){
            $val = 0;
            $noti = $db_conn->prepare("UPDATE db_camagru . user_accounts SET comment_notify = :val WHERE id = :id");
            $noti->bindParam(':id', $_SESSION['id']);
            $noti->bindParam(':val', $val);
            $noti->execute();
            $_SESSION['comment_noti'] = 0;
        }
        else{
            $val = 1;
            $noti = $db_conn->prepare("UPDATE db_camagru . user_accounts SET comment_notify = :val WHERE id = :id");
            $noti->bindParam(':id', $_SESSION['id']);
            $noti->bindParam(':val', $val);
            $noti->execute();
            $_SESSION['comment_noti'] = 1;
        }
    }
    if (isset($_POST['edit']))
    {
        $input_1 = $_POST['username'];
		$input_2 = $_POST['email'];
		$input_3 = $_POST['password'];
        $input_4 = $_POST['con_password'];
        echo $input_1;
        
        if (empty($input_1) && empty($input_2) && empty($input_3) && empty($input_4)){
				header("Location:index.php?error=emptyfield[s]");
                exit();
            }
        else{
            if ($input_1){
                try{
                    $update = $db_conn->prepare("UPDATE db_camagru . user_accounts SET `username` = :new_name WHERE id = :user_ida");
                    $update->bindParam(':new_name', $input_1);
                    $update->bindParam(':user_ida', $_SESSION['id']);
                    $update->execute();
                    $_SESSION['username'] = $input_1;
                    header("Location: index.php?updated='success'");
                }
                catch(PDOException $erra){
                    echo "could not update username".$erra->getMessage();
                }
            }
            if ($input_2){
                try{
                    $update = $db_conn->prepare("UPDATE db_camagru . user_accounts SET `email` = :new_mail WHERE id = :user_ida");
                    $update->bindParam(':new_mail', $input_2);
                    $update->bindParam(':user_ida', $_SESSION['id']);
                    $update->execute();
                    $_SESSION['email'] = $input_2;
                    header("Location: index.php?updated='success'");
                }
                catch(PDOException $erra){
                    echo "could not update email".$erra->getMessage();
                }
            }
        }
        if ($input_3){
            if ($input_3 == $input_4){
                $input_3 = md5($input_3);
                try{
                    $update = $db_conn->prepare("UPDATE db_camagru . user_accounts SET `password` = :new_pass WHERE id = :user_ida");
                    $update->bindParam(':new_pass', $input_3);
                    $update->bindParam(':user_ida', $_SESSION['id']);
                    $update->execute();
                    $_SESSION['password'] = $input_3;
                    header("Location: index.php?updated='success'");
                }
                catch(PDOException $erra){
                    echo "could not update username".$erra->getMessage();
                }
            }
            else{
                header("Location: edit_profile.php?password-do-not-match");
            }
        }
    }
?>

<html>
    <title>Edit Profile </title>
    <link rel="stylesheet" href="random_style.css">
    <body>
    <h1>Camagru</h1>
		<form method="POST">
		<div>
			<label for="username">Username</label>
			<input type="text" name="username">
		</div>
		<div>
			<label for="email">Email</label>
			<input type="text" name="email">
        </div>
        <div>
            <label for="Password">Password</label>
			<input type="password" name="password" pattern="^(?=.*[A-Z])(?=.*[0-9]).{6,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'invalid password.'">
		</div>
        <div>
            <label for="Password">Confirm Password</label>
			<input type="password" name="con_password" pattern="^(?=.*[A-Z])(?=.*[0-9]).{6,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'invalid password.'">
		</div>
        <div>
            <label for="CommentNot">Comment Notifier</label>
        <?php
            if (($_SESSION['comment_noti']) == 0){
                ?>
                <input type="submit" name="comm_not" value="Off">
            <?php }
            else{?>
                <input type="submit" name="comm_not" value="On">
            <?php }
        ?>
        </div>
        <input type="submit" name="edit" value="edit">
        </form>
       <div class="redirect">
                <a href="config/logout.php">Log out</a>
                <a href="index.php">Home</a>
        </div>
        <div class="footerBar">
            <hr>
            <p style="text-align:right;">By kmpoloke &copy</p>
        </div> 
    </body>
</html>