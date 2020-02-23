<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    try{
        require 'config/database.php';

        $varify = $db_conn->prepare("UPDATE  db_camagru . user_accounts SET varify=1");
        $varify->execute();
        header("Location:log_in.php?login-succesful");
    }
    catch (PDOException $t){
        echo "Error!" . $t->getMessage();
    }
?>