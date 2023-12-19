<?php
    session_start();

    if($_SESSION['is_login'] !== true){
        header("Location: logout.php");
        exit();
    }

    function genCRSFToken(){
        if(!isset($_SESSION["csrf_token"])){
            $token = bin2hex(random_bytes(32));
            $_SESSION['crsf_token'] = $token;
        }
        
        return $_SESSION['crsf_token'];
    }

    $_SESSION['crsf_token_time'] = time();

    if(isset($_POST['crsf_token'])){
        if($_POST['crsf_token'] == $_SESSION['crsf_token']){
        }else{
            die("Invalid Token");
        }
    }

    $max_time = 5;
    if(isset($_SESSION['csrf_token'])){
        $token_time = $_SESSION['crsf_token'];
        if($token_time + $max_time >= time()){
        }else{
            unset($_SESSION['crsf_token']);
            unset($_SESSION['crsf_token_time']);
            die("Timed Out");
        }
    }

    genCRSFToken();

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
                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>" />

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