<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "config/database.php";
?>
<html>
<title>Capture</title>
    <link rel="stylesheet" href="random_style.css">
    <h1>Camagru<h1>
    <body>
        <div class="video_box">
            <video id="video" autoplay></video>
            <canvas id="canvas" width="400" height="300"></canvas> 
        </div>
            <button id="capture" onclick="drawImage();"> Capture</button>
            <button name="save" id="save" disabled onclick="saveImage();"> Save</button>
        <div class="stickers">
            <img id="sticker1" src="stickers/emoji(1).png" alt="sticker1" onclick="addSticker('stickers/emoji(1).png', 0, 0)";>
            <img id="sticker2" src="stickers/emoji(2).png" alt="sticker2" onclick="addSticker('stickers/emoji(2).png', 320, 0)";>
            <img id="sticker3" src="stickers/emoji(3).png" alt="sticker3" onclick="addSticker('stickers/emoji(3).png', 0, 220)";>
            <img id="sticker4" src="stickers/emoji(4).png" alt="sticker4" onclick="addSticker('stickers/emoji(4).png', 320, 220)";>
        </div>
        <div class="redirect">
            <a href="config/logout.php">Log out</a>
            <a href="index.php">Home</a>
            <a href="image_upload.php">Upload</a>
        </div>
    </body>
    <p id="demo"></p>
    <script type="text/JavaScript" src="webcam.js"></script>
    <script type="text/JavaScript" src="stickers.js"></script>
    <div class="footerBar">
    	<hr>
    	<p style="text-align:right;">By kmpoloke &copy</p>
    </div>
    </html>