<?php
    session_start();
    session_regenerate_id();

    if($_SESSION['is_login'] !== true){
        header("Location: home.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNook</title>

    <link rel="stylesheet" href="assets/publishstyle.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <form action="controller/AuthBookForm.php" method="POST">
                <h1>Form Book</h1>
                <div class="input">
                    <input type="text" placeholder="Judul Buku" name="judul" id="judul">
                </div>
                <div class="input">
                    <input type="text" placeholder="Tahun Terbit" name="tahun" id="tahun">
                </div>
                <div class="input">
                    <input type="text" placeholder="Genre" name="genre" id="genre">
                </div>
                <div class="input">
                    <input type="text" placeholder="Jumlah Halaman" name="halaman" id="halaman">
                </div>
                <div class="buttons">
                    <input type="submit" id="btn" value="Submit" name="submit"/>
                    <a href="homeuser.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>