<?php
    require_once "Connection.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = $_POST['pass'];

        if(empty($username) || empty($password)){
            header("Location: ../login.php?error=emptyinput");
            exit();
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../login.php?error=invalidusername");
            exit();
        }

        $query = "SELECT * FROM users WHERE username = ?;";
        $stmt = $db->prepare($query);
        if (!$stmt) {
            die("Database query failed");
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $db->close();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['Password'])) {
                // Security practice to prevent session fixation
                session_regenerate_id();
                $_SESSION["is_login"] = true;
                $_SESSION["username"] = $row["Username"];
                if ($row["Role"] === 'admin') {
                    $_SESSION['is_admin'] = true;
                    header("Location: ../homeadmin.php");
                } else {
                    header("Location: ../homeuser.php");
                }
            } else {
                header("Location: ../login.php?error=invalidcredentials");
            }
        } else {
            header("Location: ../login.php?error=nouser");
        }
    }
?>
