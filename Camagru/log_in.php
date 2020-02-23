<?php
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require "config/database.php";

    if (isset($_POST['log_in']))
    {
        $input_1 = $_POST['username'];
        $input_2 = $_POST['password'];

        $sql = "SELECT * FROM db_camagru . user_accounts WHERE username = ?";
        $check_user = $db_conn->prepare($sql);
		$check_user->execute([$input_1]);
        $i = 0;
        while ($row = $check_user->fetch(PDO::FETCH_ASSOC)){
            $i++;
            $hash = $row['password'];
        }
        if ($i == 0){
			header("Location:login_in.php?user-not-found");
			exit();
        }
        else if($i == 1){
			$input_2 = md5($input_2);
        	if ($input_2 == $hash){
                header("Location:index.php?login-succesful");
            }
            else{
				header("Location:log_in.php?password-does-not-exist");
            }
		}
		$stm = "SELECT * FROM db_camagru . user_accounts WHERE username = ? AND varify = 1";
		$current_usr = $db_conn->prepare($stm);
		$current_usr->execute([$input_1]);
		$details = $current_usr->fetch(PDO::FETCH_ASSOC);

		$_SESSION['username'] = $details['username'];
		$_SESSION['email'] = $details['email'];
		$_SESSION['id'] = $details['id'];
        $_SESSION['comment_noti'] = $details['comment_notify'];
	}
?>

<!doctype html>
<html>
    <title>Login</title>
    <link rel="stylesheet" href="random_style.css">
    <body>
		<h1> Camagru</h1>
        <form action="" method="POST">
			<div>
				<label for="username">Username</label>
				<input type="text" name="username" required>
            </div>
            
            <div>
                <label for="password">Password</label>
                <input type="password"  name="password" required>
            </div>
            
            <input type="submit" name="log_in" value="Log_in">
    		<p> <a href="forgot_password.php">Forgot Password</a></p>
        <p> <a href="sign_up.php">Sign_up</a></p><br />
        </form>	
    </body>
</html>