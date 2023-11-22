<?php
    session_start();
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
        <h1>Register Form</h1>
        <form name="form" method="POST" action="controller/AuthRegister.php">
            <input type="hidden" name="csrf_token">
        
            <label for="username">Username: </label>
            <input type="text" id="username" name="username">

            <label for="email">Email: </label>
            <input type="text" id="email" name="email">

            <label for="password">Password: </label>
            <input type="password" id="pass" name="pass">

            <label for="cpass">Confirm Password: </label>
            <input type="password" id="cpass" name="cpass">
        
            <input type="submit" id="btn" value="Register" name="submit"/>
        </form>
        <p class="register-link">Already have an account? <a href="login.php">Login Here</a></p>
    </div>

    </body>
</html>