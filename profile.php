<?php 
session_start();

require 'configuration/config.php';
require 'configuration/functions.php';

if(isset($_SESSION['user'])){
?>
<html>
    <head>
        <title>MarketPlace <?php sitename(); ?></title>
        <link rel="stylesheet" href="assets/css/profile.css">
        
    </head>
    <body>
        <div class="header">
            <p class="another-title-top header-title"><?php sitename(); ?></p>
            <div class="header-buttons">
                <a class="header-button" href="home">
                    <button>home</button>
                </a>
                <a class="header-button" href="posts">
                    <button>posts</button>
                </a>
                <a class="header-button" href="premium">
                    <button>premium posts</button>
                </a>
                <a class="header-button" href="create">
                    <button>Create Post</button>
                </a>
                <a class="header-button" href="shop">
                    <button>Store</button>
                </a>
                <a class="header-button" href="tos">
                    <button>ToS</button>
                </a>
                <?php 
                $sql = "SELECT role FROM users WHERE username = '".$_SESSION['user']."'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result)){
                    $adminbtn = mysqli_fetch_assoc($result);
                    $admin_button = $adminbtn['role'];

                    if($admin_button == "admin"){
                        echo '<a class="header-button" href="admin/index"><button>Admin</button></a>';
                    }
                }
                ?>
            </div>
            <div class="top-header">
                <a href="profile">
                    <img src="assets/img/profile/undraw_pic_profile_re_7g2h.svg" alt="" class="profile-picture">
                </a>
            </div>
        </div>
        <div class="content">
            <form method="POST">
                <?php 
                $sql = "SELECT * FROM users WHERE username='".$_SESSION['user']."'";
                $result = mysqli_query($conn, $sql);

                if(isset($result) > 0){
                    while($showuserinfo = mysqli_fetch_assoc($result)){?>
                <div class="profile">
                    <img src="assets/img/profile/undraw_pic_profile_re_7g2h.svg" alt="" class="profile-profilepic">
                    <br>
                    <input type="text" readonly class="profile-input" value="<?php echo $showuserinfo['username']?>" placeholder="username">
                    <input type="text" readonly class="profile-input" value="<?php echo $showuserinfo['role']?>" placeholder="Role">
                    <input type="text" name="usersite" class="profile-input" value="<?php echo $showuserinfo['site']?>" placeholder="Your Site">
                    <input type="text" name="userdiscord" class="profile-input" value="<?php echo $showuserinfo['discord']?>" placeholder="Your Discord">
                    <input type="text" name="usertelegram" class="profile-input" value="<?php echo $showuserinfo['telegram']?>"  placeholder="Your Telegram">
                    <br>
                </div>
                <?php
                    }
                }
                ?>
            </form>
        </div>

        <script src="https://kit.fontawesome.com/ba23ae2d89.js" crossorigin="anonymous"></script>
    </body>
</html>
<?php 
}else{
    header("Location: login");
}
?>