<?php 
require 'configuration/config.php';

session_start();

if(isset($_SESSION['user'])){
    header("Location:home");
}

if(isset($_POST['register-submit'])){
    $name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));
    $cpassword = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['cpassword']));
    $hash = password_hash($password, PASSWORD_BCRYPT, ['cost'=>10]);
    if($name == ""){
        echo "Name is empty!";
    }else{
        if($password == ""){
            echo "Password is empty";
        }else{
            if($cpassword == ""){
                echo "Verification Password is empty!";
            }else{
                if($password != $cpassword){
                    $notthesame = '<h1 style="position:relative; top:125px; text-align:center; color:red; font-family:monospace;">Password not the same</h1>';
                    echo $notthesame;
                }else{
                    $sql = "SELECT * FROM users WHERE username='".$name."'";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        echo '<h1 style="position:relative; top:125px; text-align:center; color:red; font-family:monospace;">There is already a user with this username!</h1>';
                    }else{
                        $sql = "INSERT INTO users (username, password, status, role, site, discord, telegram, banned) VALUES ('".$name."', '".$hash."', 'new', 'user', '', '', '', '0' )";
                        $result = mysqli_query($conn, $sql);
                        header("Location: login");
                        exit();
                    }
                }
            }
        }
    }
}
?>
<html>
    <head>
        <title>MarketPlace /NAME/</title>
        <link rel="stylesheet" href="assets/css/register.css">
    </head>
    <body>
        <div class="panel">
            <form method="POST">
                <p class="another-title-top login-title">Register to /NAME/</p>
                <p class="login-input-label another-title">Username</p>
                <input type="text" name="username" class="login-input" maxlength="255" placeholder="...">
                <p class="login-input-label-another another-title">Password</p>
                <input type="password" name="password" class="login-input" maxlength="255" placeholder="...">
                <p class="login-input-label-another another-title">Verify Password</p>
                <input type="password" name="cpassword" class="login-input" maxlength="255" placeholder="...">
                <br>
                <input type="submit" name="register-submit" class="btn-input" value="Register">
                <p class="noacc">Already have a account? <a class="noaccbtn" href="Login">Login</a> now!</p>
            </form>
        </div>
    </body>
</html>