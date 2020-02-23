<html>
<head>
    <title>Upload</title>
    <script type="text/JavaScript" src="stickers.js"></script>
    <script type="text/JavaScript" src="image_upload.js"></script>
    <link rel="stylesheet" href="random_style.css">
    <meta name= "viewport" content="width= device-width, initial-scale=1">
    <h1>Camagru</h1>
</head>
<body>
    <div class="video_box">
        <canvas id="canvas" width="400" height="300"></canvas> 
    </div>
    <br>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="ChooseFile" id="File">
        <input type="submit" id="Preview" value="Preview" name="submit">
    </form>
    <button id="Save" disabled onclick="saveImage()";>Save</button>
</body>
</html>
<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require 'config/database.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_FILES['ChooseFile']['error']){
            header("Location:image_upload.php?No+File+Selected");
        }
        else{
            $tmp_image = $_FILES['ChooseFile']['tmp_name'];
            $process_dir = "image_process/";
            $image_bin = file_get_contents($tmp_image); 
            $image = $_FILES['ChooseFile']['name'];
            $img_path = $process_dir.$image;
            move_uploaded_file($tmp_image, $process_dir.$image);
            if($_POST['submit']){
                echo "<script type='text/javascript'>
                    uploadImage('$img_path');
                    btnEnable();
                    btnDisablePr();
                </script>";
            }
        }
    }
?>
<html>
<body>
    <div class="redirect">
        <a href="config/logout.php">Log out</a>
        <a href="index.php">Home</a>
        <a href="Capture.php">Capture</a>
    </div>
    <div class="stickers">
        <img id="sticker1" disabled src="stickers/emoji(1).png" alt="sticker1" onclick="addSticker('stickers/emoji(1).png', 0, 0)";>
        <img id="sticker2" src="stickers/emoji(2).png" alt="sticker2" onclick="addSticker('stickers/emoji(2).png', 320, 0)";>
        <img id="sticker3" src="stickers/emoji(3).png" alt="sticker3" onclick="addSticker('stickers/emoji(3).png', 0, 220)";>
        <img id="sticker4" src="stickers/emoji(4).png" alt="sticker4" onclick="addSticker('stickers/emoji(4).png', 320, 220)";>
    </div>
</body>
<div class="footerBar">
    	<hr>
    	<p style="text-align:right;">By kmpoloke &copy</p>
    </div>
</html>
 