<?php
    require_once "Connection.php";
    session_start();

    // function loginattempt() {
    //     if (!isset($_SESSION['login_attempts'])) {
    //         $_SESSION['login_attempts'] = 1;
    //     } else {
    //         $_SESSION['login_attempts']++;
    //     }
    // }
    
    // function resetattempt() {
    //     $_SESSION['login_attempts'] = 0;
    // }
    
    // function lockAccount() {
    //     $_SESSION['account_locked'] = true;
    // }

    $is_admin = false;
    $is_login = false;

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $username = $_POST['username'];
        $password = $_POST['pass']; 

        $query = "SELECT * FROM users WHERE username=? and password=?;";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $username, $password);

        $stmt->execute();
        $result = $stmt->get_result();

        $db->close();

        if(empty($username) || empty($password)){
            header("Location: ../login.php?error=emptyinput");
            exit();
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../login.php?error=invalidusername");
            exit();
        }

        // if(!preg_match("/^[a-zA-Z0-9!#$%^&-+]*$/", $password)){
        //     header("Location: ../register.php?error=invalidpassword");
        //     exit();
        // }

        if($result->num_rows === 1){
            $rows = $result->fetch_assoc();
            $_SESSION["is_login"] = true;
            $_SESSION["username"] = $rows["Username"];
            // $hashedpwd = $rows["password"];
            // $verify = password_verify($password, $hashedpwd);

            // var_dump($username, $password);
            if($username == "admin" && $password == "admin123"){
                $_SESSION['is_admin'] = true;
                header("Location: ../homeadmin.php");
                // resetattempt();
            }else if($password === $rows["Password"]){
                header("Location: ../homeuser.php");
                // resetattempt();
            }else{
                header("Location: ../login.php");
                // loginattempt();
            }
        }
        else{
            // loginattempt();

            // if($_SESSION['login_attempts'] >= 3){
            //     lockAccount();

            //     if(time() < time() * 60){
            //         header("Location: ../login.php?error=accountlocked");
            //     }else{
            //         unset($_SESSION['account_locked']);
            //     }
            // }

            header("Location: ../login.php");
        }
    }
?>