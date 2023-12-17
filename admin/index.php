
<?php 
session_start();

require 'configuration/config.php';
require 'configuration/functions.php';


$username = $_SESSION['user'];
$sql = "SELECT '.$username.' FROM users WHERE `role` = 'admin'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)){
    $admin = mysqli_fetch_assoc($result);

    if($admin == 'user'){
        header("Location: ../other/html.html");
        exit;
    }
?>
<html>
    <head>
        <title>MarketPlace <?php sitename(); ?></title>
        <link rel="stylesheet" href="assets/css/style.css">
        
    </head>
    <body>
        <div class="header">
            <p class="another-title-top header-title"><?php sitename(); ?></p>
            <div class="header-buttons">
                <a class="header-button" href="index">
                    <button>home</button>
                </a>
                <a class="header-button" href="users">
                    <button>users</button>
                </a>
                <a class="header-button" href="posts">
                    <button>posts</button>
                </a>
                <a class="header-button" href="premium">
                    <button>premium posts</button>
                </a>
                <a class="header-button" href="news">
                    <button>News</button>
                </a>
            </div>
        </div>
        <div class="content">
            <form method="POST">
                <?php 
                if(isset($_POST['name-submit'])){
                    $sitename = $_POST['sitename-input'];

                    $sql = "UPDATE settings SET sitename = '$sitename'";
                    mysqli_query($conn, $sql);
                }

                if(isset($_POST['url-submit'])){
                    $siteurl = $_POST['siteurl-input'];

                    $sql = "UPDATE settings SET siteurl = '$siteurl'";
                    mysqli_query($conn, $sql);
                }

                if(isset($_POST['logo-submit'])){
                    $sitelogo = $_POST['sitelogo-input'];

                    $sql = "UPDATE settings SET sitelogo = '$sitelogo'";
                    mysqli_query($conn, $sql);
                }

                if(isset($_POST['maintenance-submit'])){
                    $maintenancechoice = $_POST['maintenance'];

                    if($maintenancechoice == '1'){
                        $sql = "UPDATE settings SET maintenance = '1'";
                        mysqli_query($conn, $sql);
                    }elseif($maintenancechoice == '0'){
                        $sql = "UPDATE settings SET maintenance = '0'";
                        mysqli_query($conn, $sql);
                    }
                }
                ?>
            <div class="sitename">
                <input type="text" placeholder="site name.." class="site-name-input" name="sitename-input">
                <br>
                <button type="submit" name="name-submit" class="sitename-button">Set</button>
            </div>
            <div class="sitename">
                <input type="text" placeholder="site url.." class="site-name-input" name="url-input">
                <br>
                <button type="submit" name="url-submit" class="sitename-button">Set</button>
            </div>
            <div class="sitename">
                <input type="text" placeholder="site logo.. USE LINK OR DIRECTORY" class="site-name-input" name="logo-input">
                <br>
                <button type="submit" name="logo-submit" class="sitename-button">Set</button>
            </div>
            <div class="maintenance-panel">
                <p class="maintenance-title">Maintenance:</p>
                <select name="maintenance" class="maintenance" id="maintenance">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <br>
                <button type="submit" name="maintenance-submit" class="sitename-button">Set</button>
            </div>
            </form>
        </div>

        <script src="https://kit.fontawesome.com/ba23ae2d89.js" crossorigin="anonymous"></script>
    </body>
</html>

<?php 
}
?>