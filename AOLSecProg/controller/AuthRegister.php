<?php
    require_once "Connection.php";
    session_start();

    function checkLength($string, $minLength, $maxLength){
        $length = strlen($string);
        return $length > $minLength && $length < $maxLength;
    }
    
    function emailExists($db, $email){
        $query = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($db);
        if(!mysqli_stmt_prepare($stmt, $query)){
            die("SQL error");
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result) !== null;
    }

    function registerUser($db, $username, $email, $password, $role){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($db);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die("SQL error");
        }
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPassword, $role);
        mysqli_stmt_execute($stmt);

        header("Location: ../login.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        // CSRF token check
        $token = md5(uniqid(rand(), true));
        $_SESSION['crsf_token'] = $token;
        $_SESSION['crsf_token_time'] = time();

        if(isset($_POST['crsf_token'])){
            if($_POST['crsf_token'] != $_SESSION['crsf_token']){
                die("Token invalid");
            }
        }

        $max_time = 60 * 60;
        if(isset($_SESSION['csrf_token'])){
            $token_time = $_SESSION['crsf_token'];
            if($token_time + $max_time >= time()){
            }else{
                unset($_SESSION['crsf_token']);
                unset($_SESSION['crsf_token_time']);
                die("Timed Out");
            }
        }

        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = $_POST["pass"];
        $password_confirm = $_POST["cpass"];
        $role = "user";

        // Input sanitization
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validation
        if(empty($username) || empty($email) || empty($password) || empty($password_confirm)){
            die("Please fill in all fields");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("Invalid email format");
        }

        if(!checkLength($username, 5, 20) || !checkLength($password, 8, 20)){
            die("Username must be 5-20 characters and password must be 8-20 characters long");
        }
        
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            die("Username Invalid");
        }

        if($password !== $password_confirm){
            die("Passwords do not match");
        }



        if(emailExists($db, $email)){
            die("Email already exists");
        }

        registerUser($db, $username, $email, $password, $role);
    }
?>
