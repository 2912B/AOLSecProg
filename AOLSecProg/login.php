<?php
    session_start();
    session_regenerate_id();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNook</title>
    <link rel="stylesheet" href="assets/login.css">
</head>
<body>

<div id="form">
    <h1>Login Form</h1>
    <form method="POST" action="controller/AuthLogin.php">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
        <label for="password">Password: </label>
        <input type="password" id="pass" name="pass">
        <input type="submit" id="btn" value="Login" name="submit"/>
    </form>
    <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>
