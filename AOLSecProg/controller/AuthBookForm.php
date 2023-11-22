<?php
    require_once "Connection.php";
    session_start();

    function isStringLengthValid($string, $maxLength){
        return strlen($string) <= $maxLength;
    }

    function regisBuku($db, $judul, $tahun, $genre, $halaman){
        $sql = "INSERT INTO library (judul, tahun_terbit, genre, jumlah_halaman) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_prepare($db, $sql);
        if (!$stmt) {
            die("Error: " . mysqli_error($db));
        }

        mysqli_stmt_bind_param($stmt, "sisi", $judul, $tahun, $genre, $halaman);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: ../homeuser.php?success=bookregistered");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $judul = filter_var($_POST["judul"], FILTER_SANITIZE_STRING);
        $tahun = filter_var($_POST["tahun"], FILTER_SANITIZE_NUMBER_INT);
        $genre = filter_var($_POST["genre"], FILTER_SANITIZE_STRING);
        $halaman = filter_var($_POST["halaman"], FILTER_SANITIZE_NUMBER_INT);

        if(empty($judul) || empty($tahun) || empty($genre) || empty($halaman)){
            header("Location: ../publishform.php?error=emptyinput");
            exit();
        }

        if(!isStringLengthValid($judul, 40)){
            header("Location: ../publishform.php?error=toolongtitle");
            exit();
        }

        if(strlen($tahun) !== 4 || !is_numeric($tahun)){
            header("Location: ../publishform.php?error=invalidyear");
            exit();
        }

        if(!isStringLengthValid($genre, 20)){
            header("Location: ../publishform.php?error=toolonggenre");
            exit();
        }

        if(!is_numeric($halaman)){
            header("Location: ../publishform.php?error=invalidpagecount");
            exit();
        }

        regisBuku($db, $judul, $tahun, $genre, $halaman);
    }
?>
