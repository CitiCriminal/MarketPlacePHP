<?php 
session_start();

require 'configuration/config.php';
require 'configuration/functions.php';

if(isset($_SESSION['user'])){
?>
<html>
    <head>
        <title>MarketPlace <?php sitename(); ?></title>
        <link rel="stylesheet" href="assets/css/tos.css">
        
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
                <p class="total-users another-title">Total Premiums:</p>
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
            <div class="tos-panel">
                <p class="tos-title">Terms of Service</p>
                <hr>
                <p class="tos-text">Scammers will be BANNED. Scamming will lead to concequences</p>
                <p class="tos-text">Do not spam creating accounts!</p>
                <p class="tos-text">Using IP GRABBING Links or Malware links on your profile will lead to concequences.</p>
                <p class="tos-text">Selling Softwares is not allowed!</p>
                <p class="tos-text">Selling Pornographic Information is not allowed!</p>
                <p class="tos-text">Selling Source Codes are not allowed!</p>
                <p class="tos-text">Selling Stolen Credit Cards, Banking and financiel information / data are not allowed!</p>
                <p class="tos-text">We are not responsible if you get scammed!</p>
                <p class="tos-text">Do not Beg for Donations!</p>
            </div>
            <div class="faq-panel">
                <p class="tos-title">Frequently Asked Questions</p>
                <hr>
                <p class="tos-text">Do we save any data when a user registers? No We Do Not</p>
                <p class="tos-text">is middleman allowed? Yes it is.</p>
                <p class="tos-text">What happens if I ignore the TOS? There will be concequences</p>
                <p class="tos-text">What happens if I post something racist / sexist or generally offensive, Post will be deleted, and you will get a warning.</p>
                <p class="tos-text">Are you allowed to sell Proxies? Sure you can. but you will be banned if your scamming.</p>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/ba23ae2d89.js" crossorigin="anonymous"></script>
    </body>
</html>
<?php 
}else{
    header("Location: login");
}
?>