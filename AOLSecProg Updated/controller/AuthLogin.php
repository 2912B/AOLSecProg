<?php
    require_once "Connection.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = $_POST['pass'];

        $query = "SELECT * FROM users WHERE username = ?;";
        $stmt = $db->prepare($query);
        if (!$stmt) {
            die("Database query failed");
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $ip = $_SERVER['REMOTE_ADDR'];
        $time = time() - 10;
        $login_attempts = mysqli_query($db, "SELECT COUNT(*) as total_count from login_attempt where ip='$ip' and time_login>'$time'");
        $counting = mysqli_fetch_assoc($login_attempts);
        $count = $counting['total_count'];

        if(empty($username) || empty($password)){
            $count++;
            $ip = $_SERVER['REMOTE_ADDR'];
            $time = time();
            $sqlquery = "INSERT INTO login_attempt (ip, time_login) VALUES (?, ?);";
            $stmtquery = mysqli_prepare($db, $sqlquery);
            if(!$stmtquery){
                die("Error: " . mysqli_error($db));
            }

            mysqli_stmt_bind_param($stmtquery, "ss", $ip, $time);
            mysqli_stmt_execute($stmtquery);
            mysqli_stmt_close($stmtquery);
            if($count == 3){
                die("Your account has been blocked");
            }
            header("Location: ../login.php?error=emptyinput");
            exit();
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $count++;
            $ip = $_SERVER['REMOTE_ADDR'];
            $time = time();
            $sqlquery = "INSERT INTO login_attempt (ip, time_login) VALUES (?, ?);";
            $stmtquery = mysqli_prepare($db, $sqlquery);
            if(!$stmtquery){
                die("Error: " . mysqli_error($db));
            }

            mysqli_stmt_bind_param($stmtquery, "ss", $ip, $time);
            mysqli_stmt_execute($stmtquery);
            mysqli_stmt_close($stmtquery);
            if($count == 3){
                die("Your account has been blocked");
            }
            header("Location: ../login.php?error=emptyinput");
            exit();
        }

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['Password'])) {
                // Security practice to prevent session fixation
                session_regenerate_id();
                $_SESSION["is_login"] = true;
                $_SESSION["username"] = $row["Username"];
                if ($row["Role"] === 'admin') {
                    $delete = mysqli_query($db, "DELETE from login_attempt");
                    $_SESSION['is_admin'] = true;
                    header("Location: ../homeadmin.php");
                } else {
                    $delete = mysqli_query($db, "DELETE from login_attempt");
                    header("Location: ../homeuser.php");
                }
            } else {
                $count++;
                $ip = $_SERVER['REMOTE_ADDR'];
                $time = time();
                $sqlquery = "INSERT INTO login_attempt (ip, time_login) VALUES (?, ?);";
                $stmtquery = mysqli_prepare($db, $sqlquery);
                if(!$stmtquery){
                    die("Error: " . mysqli_error($db));
                }

                mysqli_stmt_bind_param($stmtquery, "ss", $ip, $time);
                mysqli_stmt_execute($stmtquery);
                mysqli_stmt_close($stmtquery);
                if($count == 3){
                    die("Your account has been blocked");
                }
                header("Location: ../login.php?error=invalidcredentials");
                exit();
            }
        } else {
            $count++;
            $ip = $_SERVER['REMOTE_ADDR'];
            $time = time();
            $sqlquery = "INSERT INTO login_attempt (ip, time_login) VALUES (?, ?);";
            $stmtquery = mysqli_prepare($db, $sqlquery);
            if(!$stmtquery){
                die("Error: " . mysqli_error($db));
            }

            mysqli_stmt_bind_param($stmtquery, "ss", $ip, $time);
            mysqli_stmt_execute($stmtquery);
            mysqli_stmt_close($stmtquery);
            if($count == 3){
                die("Your account has been blocked");
            }
            header("Location: ../login.php?error=nouser");
            exit();
        }

        $db->close();
    }
?>
