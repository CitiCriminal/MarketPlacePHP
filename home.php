<?php 
session_start();

require 'configuration/config.php';
require 'configuration/functions.php';

if(isset($_SESSION['user'])){
?>
<html>
    <head>
        <title>MarketPlace <?php sitename(); ?></title>
        <link rel="stylesheet" href="assets/css/home.css">
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
            <div class="totalgraph">
                <p class="total-users another-title">Total Users:</p>
                <p class="users-count another-title-top"><?php $sql = "SELECT * FROM users"; $result = mysqli_query($conn, $sql); if(mysqli_num_rows($result) > 0){
                    echo mysqli_num_rows($result);
                }else{
                    echo "0";
                }?></p>
            </div>
            <div class="totalgraph">
                <p class="total-users another-title">Total Posts:</p>
                <p class="users-count another-title-top"><?php $sql = "SELECT * FROM posts"; $result = mysqli_query($conn, $sql); if(mysqli_num_rows($result) > 0){
                    echo mysqli_num_rows($result);
                }else{
                    echo "0";
                }?></p>
            </div>
            <div class="totalgraph">
                <p class="total-users another-title">Total Premium Posts:</p>
                <p class="users-count another-title-top"><?php $sql = "SELECT * FROM posts WHERE premium = '1'"; $result = mysqli_query($conn, $sql); if(mysqli_num_rows($result) > 0){
                    echo mysqli_num_rows($result);
                }else{
                    echo "0";
                }?></p>
            </div>
            <div class="totalgraph">
                <p class="total-users another-title">Your Posts:</p>
                <p class="users-count another-title-top"><?php $sql = "SELECT * FROM posts WHERE `posted-user` = '".$_SESSION['user']."'"; $result = mysqli_query($conn, $sql); if(mysqli_num_rows($result) > 0){
                    echo mysqli_num_rows($result);
                }else{
                    echo "0";
                }?></p>
            </div>

            <div class="news">
                <p class="another-title" style="position:absolute; transform:translate(-50%, -50%); left:50%; top:0.5%; font-size:23px;">News:</h1>
                <?php 
                $sql = "SELECT * FROM news ORDER BY id DESC LIMIT 3";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0){
                    while($newsinfo = mysqli_fetch_assoc($result)){?>
                <div class="news-table">
                    <p class="news-title another-title-top"><?php echo $newsinfo['news-name']; ?></p>
                    <p class="description-title another-title"><?php echo $newsinfo['news-description']; ?></p>
                </div>
                <?php
                    }
                }else{
                    echo '<h1 class="another-title" style="position:relative; top:50px;">No News!</h1>';
                }
                ?>
            </div>
            <div class="profile">
                <img src="assets/img/profile/undraw_male_avatar_re_nyu5.svg" alt="" class="profile-pfp">
                <p class="profile-info another-title-top"><?php echo $_SESSION['user']; ?></p>
                <p class="profile-info another-title"><?php $sql = "SELECT role FROM users WHERE username='".$_SESSION['user']."'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($userinfo = mysqli_fetch_assoc($result)){
                        echo "Role: ".$userinfo['role'];"";
                    }
                } ?></p>
                <p class="profile-info another-title-top"><?php $sql = "SELECT status FROM users WHERE username='".$_SESSION['user']."'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($userinfo = mysqli_fetch_assoc($result)){
                        echo "Status: ".$userinfo['status'];"";
                    }
                } ?></p>
                <a href="shop">
                    <button class="profile-shop">Shop</button>
                </a>
            </div>
        </div>
    </body>
</html>

<?php 
}else{
    header("Location: login");
}
?>