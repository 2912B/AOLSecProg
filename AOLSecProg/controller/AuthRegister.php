<?php
    require_once "Connection.php";
    session_start();
    $is_login = false;
    function checklength($string, $length){
        if(strlen($string) > $length){
            return true;
        }
        else{
            return false;
        }
    }

    function checkminimum($string, $length){
        if(strlen($string) < $length){
            return true;
        }
        else{
            return false;
        }
    }
    function emailExist($db, $email){
        $query = "SELECT * FROM users WHERE email = ?;";

        $stmt = mysqli_stmt_init($db);

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: ../register.php?error=preparefailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){
            return $row;
        }else{
            return false;
        }

        mysqli_stmt_close($stmt);
    }

    function regisUser($db, $username, $email, $password, $password_confirm){
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";

        $stmt = mysqli_stmt_init($db);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../register.php?error=preparefailed");
            exit();
        }

        // $hashedpass = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION['is_login'] = true;
        header("Location: ../login.php?error=none");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["pass"];
        $password_confirm = $_POST["cpass"];

        require './Connection.php';


        // check empty or not
        if(empty($username) || empty($email) || empty($password) || empty($password_confirm)){
            header("Location: ../register.php?error=emptyinput");
            exit();
        }


        // check username
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../register.php?error=invalidusername");
            exit();
        }else if(checklength($username, 20) !== false){
            header("Location: ../register.php?error=mustnotexceed20chars");
            exit();
        }

        // check password
        if(checkminimum($password, 8) !== false || checklength($password, 20) !== false){ 
            header("Location: ../register.php?error=passwordmustbe8-20chars");
            exit();
        }
        // else if(!preg_match("/^[a-zA-Z0-9!#$%^&-+]*$/", $password)){
        //     header("Location: ../register.php?error=invalidpassword");
        //     exit();
        // }
        else if($password !== $password_confirm){
            header("Location: ../register.php?error=passworddontmatch");
            exit();
        }

        // email validation
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../register.php?error=invalidemail");
            exit();
        }else if(emailExist($db, $email) !== false){
            header("Location: ../register.php?error=emailexisted");
            exit();
        }

        regisUser($db, $username, $email, $password, $password_confirm);
    }
?>