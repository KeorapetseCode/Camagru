<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require 'config/database.php';
	include 'email.php';

	if(isset($_POST['sign_up'])){
		if($_POST['password'] == $_POST['conf_password']){
			$input_1 = $_POST['username'];
			$input_2 = $_POST['email'];
			$input_3 = $_POST['password'];

			if (empty($input_1) || empty($input_2) || empty($input_3)){
				header("Location:sign_up.php?error=emptyfield[s]");
				exit();
			}
			else if (!filter_var($input_2, FILTER_VALIDATE_EMAIL)){
				header("Location:sign_up.php?error=invalidemail&email=".$input_2);
				exit();
			}
			else if (strlen($input_3) <= 4){
				header("Location:sign_up.php?error=password-too-short");
				exit();
			}
			$sql = "SELECT * FROM db_camagru . user_accounts WHERE username = ? OR email = ?";
			$check_user = $db_conn->prepare($sql);
			$check_user->execute([$input_1, $input_2]);
			if ($check_user->rowCount() > 0){
				echo "Username/Email already exists";
				exit();
			}
			else{
				$input_3 = md5($input_3);
				try{
					$db_ff = $db_conn->prepare("INSERT INTO `db_camagru`.`user_accounts` (username, email, password) VALUES (:username, :email, :password)");
					$db_ff->bindParam(':username', $input_1);
					$db_ff->bindParam(':email', $input_2);
					$db_ff->bindParam(':password', $input_3);	
					$db_ff->execute();
					varify($input_2, $input_1);
					echo "signup successful please check your email";

				}
				catch(PDOException $erra){
					echo "Did not insert".$erra->getMessage();
				}
			}
		}
		else if ($_POST['password'] !== $_POST['conf_password']){
			header("Location:sign_up.php?error=password-do-not-match");
			exit();
		}
    }
?>
<html>
    <title>Sign Up</title>
    <link rel="stylesheet" href="random_style.css">
	<meta name="viewport" content="width=device-width, initail-scale=9">
    <body>
		<h1>Camagru</h1>
		<form action="" method="POST">
		<div>
			<label for="username">Username</label>
			<input type="text" name="username" required>
		</div>
		<div>
			<label for="email">Email</label>
			<input type="text" name="email" required>
        </div>
        <div>
            <label for="Password">Password</label>
			<input type="password" name="password" required pattern="^(?=.*[A-Z])(?=.*[0-9]).{6,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'invalid password.'">
		</div>
		<div>
			<label for="conf_password">Confirm Password</label>
			<input type="password" name="conf_password" required>
		</div>
		<input type="submit" name="sign_up" value="Sign_Up">
        </form>
        <p><a href="index.php" style="display:inline; position:fixed; top: 10px; right: 10px;">Home</a></p>
    </body>
    <div class="footerBar">
    	<hr>
    	<p style="text-align:right;">By kmpoloke &copy</p>
    </div>
</html>