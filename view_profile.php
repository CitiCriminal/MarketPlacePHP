<?php 
session_start();

require 'configuration/config.php';
require 'configuration/functions.php';

if(isset($_SESSION['user'])){
?>
<html>
    <head>
        <title>MarketPlace <?php sitename(); ?></title>
        <link rel="stylesheet" href="assets/css/profileview.css">
        
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
             <?php
                if(isset($_GET['id']) && is_numeric($_GET['id'])){
                    $sql = "SELECT * FROM users WHERE id = ".$_GET['id']."";
                    $result = mysqli_query($conn, $sql);

                    if(isset($result) > 0){
                        while($userinfo = mysqli_fetch_assoc($result)){?>

            <div class="profile">
                <img src="assets/img/profile/undraw_male_avatar_re_nyu5.svg" alt="" class="post-profile"> 
                <div class="post-profile-information">
                    <p class="post-profile-info"><?php echo $userinfo['username']; ?></p>
                    <p class="post-profile-info"><?php if($userinfo['premium'] = '1'){
                        echo "VIP User";
                    }else{
                        echo "Non VIP User";
                    } ?></p>
                    <p class="post-profile-info"><?php echo $userinfo['role']; ?></p>
                    <p class="post-profile-info"><?php echo $userinfo['discord']; ?></p>
                    <a href="https://<?php echo $userinfo['telegram']; ?>" class="post-profile-info "><?php echo $userinfo['telegram']; ?></a>
                    <a href="https://<?php echo $userinfo['site']; ?>" class="post-profile-info post-profile-site"><?php echo $userinfo['site']; ?></a>
                </div>
            </div>

            <div class="post-title-div">
                <p class="posts-info-title">Posts:</p>
                <a class="post-view-title"><?php 
                $sql = "SELECT * FROM posts WHERE `posted-user` = '".$_SESSION['user']."'";
                $result = mysqli_query($conn, $sql); if(mysqli_num_rows($result) > 0){
                $result = mysqli_query($conn, $sql);
                echo mysqli_num_rows($result);
                }else{
                    echo "0";
                }?></a>
            </div>
            <div class="post-title-div">
                <p class="posts-info-title">Status:</p>
                <p class="post-view-title"><?php $sql = "SELECT status FROM users WHERE username='".$_SESSION['user']."'";
                $result = mysqli_query($conn, $sql);
                if(isset($result) > 0){
                    while($userstatus = mysqli_fetch_assoc($result)){
                        echo $userstatus['status'];
                    }
                }
                ?></p>
            </div>
        </div>
        <?php
                } 
            }
        }else{
            header("Location: posts");
        }
        ?>

        <script src="https://kit.fontawesome.com/ba23ae2d89.js" crossorigin="anonymous"></script>
    </body>
</html>
<?php 
}else{
    header("Location:login");
}
?>