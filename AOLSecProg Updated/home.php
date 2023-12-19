<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNook</title>

    <link rel="stylesheet" href="assets/navbar.css">
    <link rel="stylesheet" href="assets/welcomepage.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="kiri">
            <a href="">BookNook</a>
        </div>

        <div class="kanan">
            <a href="login.php">Login</a>
            <a href="register.php" class="register">Register</a>
        </div>
    </nav>

    <h1>Welcome to BookNook!!!</h1>
    <p>Please Login</p>
</body>
</html>