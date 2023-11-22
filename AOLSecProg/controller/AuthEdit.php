<?php
    require_once "Connection.php";
    session_start();
    function checklength($string, $length){
        if(strlen($string) > $length){
            return true;
        }
        else{
            return false;
        }
    }
    function regisBuku($db, $judul, $tahun, $genre, $halaman){
        $sql = "INSERT INTO library (judul, tahun_terbit, genre, jumlah_halaman) VALUES (?, ?, ?, ?);";

        $stmt = mysqli_prepare($db, $sql);
        if (!$stmt) {
            die("Error: " . mysqli_error($db));
        }

        mysqli_stmt_bind_param($stmt, "ssss", $judul, $tahun, $genre, $halaman);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: ../homeadmin.php?error=none");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $judul = $_POST["judul"];
        $tahun = $_POST["tahun"];
        $genre = $_POST["genre"];
        $halaman = $_POST["halaman"];

        require './Connection.php';


        // check empty or not
        if(empty($judul) || empty($tahun) || empty($genre) || empty($halaman)){
            header("Location: ../edit.php?error=emptyinput");
            exit();
        }


        // check judul
        if(!preg_match("/^[a-zA-Z0-9]*$/", $judul)){
            header("Location: ../edit.php?error=invalidtitle");
            exit();
        }else if(checklength($judul, 40) !== false){
            header("Location: ../edit.php?error=mustnotexceed40chars");
            exit();
        }

        // check tahun
        if(strlen($tahun) !== 4){ 
            header("Location: ../edit.php?error=yearmustbe4chars");
            exit();
        }else if(!preg_match("/^[0-9]*$/", $tahun)){
            header("Location: ../edit.php?error=yearmustbenumbers");
            exit();
        }

        // check genre
        if(checklength($genre, 20) !== false){
            header("Location: ../edit.php?error=mustnotexceed20chars");
            exit();
        }

        // check halaman
        if(!preg_match("/^[0-9]*$/", $halaman)){
            header("Location: ../edit.php?error=invalidhalaman");
            exit();
        }

        regisBuku($db, $judul, $tahun, $genre, $halaman);
    }
?>