<?php
session_start();
$mail = $_GET['mail'];

?>
<HTML>
<title>Change Password</title>
<link rel="stylesheet" href="random_style.css">
<meta charset="UTF-8">
<h1> Camagru</h1>
<form id="forgot_password" method="POST" action="update_password.php">
    <input type="text" value='<?php echo $mail; ?>' name="mail" hidden>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <label for="ver_password">verify Password</label>
        <input type="password" id="ver_password" name="ver_password">
    </div>
    <input type="submit" value="Submit">
</form>
</HTML>
