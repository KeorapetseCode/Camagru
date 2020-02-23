<?php
	$username = "root";
	$db_name = "db_users";
	$dsn = "mysql:host=localhost";
	$password = "keo242";

	try
    {
		$db_conn = new PDO($dsn, $username, $password);
		$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
    catch (PDOException $err)
    {
		echo "Connection Failed__".$err->getMessage();
	}
?>