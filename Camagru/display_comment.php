<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comment Display</title>
    <link rel="stylesheet" href="random_style.css">
</head>
<body>
<h1>Camagru</h1>
    <?php
        session_start();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require "config/database.php"; 

        $id_img = intval($_GET['id_image']);
        $pic = $db_conn->prepare("SELECT * FROM `db_camagru` . `images` WHERE image_id = :image_id");
        $pic->execute(['image_id' => $id_img]);
        $results = $pic->fetch(PDO::FETCH_ASSOC);
        echo '
            <div class="comm_view">
            <h3 class="img_title"> ' .  $results['user_image']. ' </h3> 
            <img class="img_file" src="data:image/png;base64,'.base64_encode($results['image_file']).'"/>
            ';
        $sql = $db_conn->prepare("SELECT * FROM `db_camagru` . `comments` WHERE image_id = :image_id");
        $sql->execute(['image_id' => $id_img]);
        while ($com_results = $sql->fetch(PDO::FETCH_ASSOC)){
            echo '
                    <p class="comment_str" >' . $com_results['comment_string'] . '</p>
            ';
        }
        echo '</div>';
        if ($_SESSION['username'] == $results['user_image']){
            echo '
                <form action="delete_image.php?image_id='.$id_img.'" method="POST">
                    <input type="submit" id="deleteImg" value="Delete Image" name="submit">
                </form>
                </div>
            ';
        }
    ?>
    <div class="redirect">
                <a href="config/logout.php">Log out</a>
                <a href="index.php">Home</a>
    </div>
    <div class="footerBar">
        <br>
        <br>
        <hr>
        <p style="text-align:right;">By kmpoloke &copy</p>
    </div>
</body>
</html>