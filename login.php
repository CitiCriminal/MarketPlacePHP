<?php 
require 'configuration/config.php';

session_start();

if(isset($_SESSION['user'])){
    header("Location:home");
}

if(isset($_POST['login-submit'])){
    $name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));

    $sql = "SELECT id, password FROM users WHERE username='$name'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        if(password_verify($password, $data['password'])){
            $_SESSION['user'] = $name;
            header("Location: home");
            exit();
        }
    }else{
        echo '<h1>Password wrong</h1>';
    }
}
?>

<html>
    <head>
        <title>MarketPlace /NAME/</title>
        <link rel="stylesheet" href="assets/css/login.css">
    </head>
    <body>
        <div class="panel">
            <form method="POST">
                <p class="another-title-top login-title">Login to /NAME/</p>
                <p class="login-input-label another-title">Username</p>
                <input type="text" name="username" class="login-input" placeholder="...">
                <p class="login-input-label-another another-title">Password</p>
                <input type="password" name="password" class="login-input" placeholder="...">
                <br>
                <input type="submit" name="login-submit" class="btn-input" value="Login">
                <p class="noacc">Don't have a account? <a class="noaccbtn" href="register">Register</a> now!</p>
            </form>
        </div>
    </body>
</html>