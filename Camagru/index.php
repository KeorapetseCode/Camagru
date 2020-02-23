<?php
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "config/database.php"; 
?>
<html>
    
    <title>Home page</title>
    <link rel="stylesheet" href="random_style.css">
    <meta charset="UTF-8">
    <body>
		<h1>Camagru</h1>
            <?php if (isset($_SESSION['id'])){ ?>
            <h4>
                <?php 
                $name = $_SESSION['username'];
                echo "Welcome To Camagru ". $name?>
            </h4>
            <?php } ?>
		<div class="gallery">
            <?php
            //  ------------------------------------------------------GET[] pagination---------------------------------------------------------------------------------------
                $results_per_page = 6;
                $pic = $db_conn->prepare("SELECT count(*) FROM `db_camagru` . `images`");
                $pic->execute();
                $picture_count = $pic->fetch(PDO::FETCH_ASSOC);
                $total_pics = $picture_count['count(*)'];
                $numberofpages = ceil($total_pics / $results_per_page);
                for ($page = 1; $page <= $numberofpages; $page++)
                {
                    echo '
                            <a href="index.php?page=' . $page . '">' . $page . '</a>
                                            ';
                }
                if (!isset($_GET['page'])){
                    $page = 1;
                }
                else{
                    $page = $_GET['page'];
                }
//-------------------------------------------------------------------Image_Display---------------------------------------------------------------------------------
                $start_select = ($page-1) * $results_per_page;
                $img_prep = $db_conn->prepare("SELECT * FROM `db_camagru` . `images` ORDER BY `date_of_creation` DESC LIMIT " . $start_select . ", " . $results_per_page);
                $img_prep->execute();
                $total_images = $img_prep->fetchAll(PDO::FETCH_ASSOC);

                foreach($total_images as $img_one){
                    $image_id = $img_one['image_id'];
                    $image_ofuser = $img_one['user_image'];
                    $image_date = $img_one['date_of_creation'];
                    $image_src = $img_one['image_file'];
                    echo '
                            <div class="img_box">
                                <h3 class="img_title"> '. $image_ofuser . '  </h3>
                                <a href="display_comment.php?id_image='.$image_id.'" ><img class="img_file" src="data:image/png;base64,'.base64_encode($image_src).'"/></a>
                    ';
            //------------------------------------------------------------LIKES-------------------------------------------------------------------------------------------
                        $like_select = $db_conn->prepare("SELECT count(*) FROM `db_camagru` . `likes` WHERE `image_id` = :image_id");
                        $like_select->bindParam(':image_id', $image_id);
                        $like_select->execute();
                        $like_count = $like_select->fetch(PDO::FETCH_ASSOC);
                        echo '
                            <div class="number_oflikes">
                                <label>Likes :</label>
                                ' . $like_count['count(*)'] . ' 
                            </div>
                        ';
                        if (isset($_SESSION['id'])){
                            $sql = $db_conn->prepare("SELECT * FROM db_camagru . likes WHERE  `user_like`= :user AND `image_id`= :image_id");
                            $sql->bindParam(':user', $_SESSION['username']);
                            $sql->bindParam(':image_id', $image_id);
                            $sql->execute();
                            if ($sql->rowCount() == 0){
                            ?>
                            <div class="addlike">
                                <form method="post" action="add_like.php">
                                <input type="text" value='<?php echo $image_id; ?>' name="img_id" hidden>
                                    <button type="submit" name="Like_btn">Like</button>
                                </form>
                            </div>
                            <?php }
                            else { ?>
                            <div class="deletelike">
                                <form method="post" action="delete_like.php">
                                    <input type="text" value='<?php echo $image_id; ?>' name="img_id" hidden>
                                    <button type="submit" name="Like_btn">Unlike</button>
                                </form>
                            </div>
                            <?php
//------------------------------------------------------------Comments---------------------------------------------------------
                    }?>

                        <div class="addcomment">
                            <form method="POST" action="add_comment.php">
                                <input type="text" value='<?php echo $image_id; ?>' name="image_id" hidden>
                                <input type="text" class="comment_box" name="comment_box">
                                <button type="submit">Comment</button>
                            </form>
                            <br><br>
                        </div>
                    <?php
                    }
                }
            ?>
        </div>
		<br>
        <?php
        if (isset($_SESSION['id'])){
            ?>
            <div class="redirect">
                <a href="config/logout.php">Log out</a>
                <a href="image_upload.php">Upload</a>
                <a href="edit_profile.php">Edit</a>
                <a href="capture.php">Capture</a>
            </div>
        <?php }
        else {
            ?>
            <div class="redirect">
                <a href="log_in.php" >Log In</a>
                <a href="sign_up.php">Sign Up</a>
            </div>
        <?php }
        ?>
    </body>
    <div class="footerBar">
    	<hr>
    	<p style="text-align:right;">By kmpoloke &copy</p>
    </div>
</html>