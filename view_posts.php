<?php 
session_start();

require 'configuration/config.php';
require 'configuration/functions.php';

if(isset($_SESSION['user'])){
?>
<html>
    <head>
        <title>MarketPlace <?php sitename(); ?></title>
        <link rel="stylesheet" href="assets/css/view.css">
        
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
                    $sql = "SELECT * FROM posts WHERE id = ".$_GET['id']."";
                    $result = mysqli_query($conn, $sql);

                    if(isset($result) > 0){
                        while($showpost = mysqli_fetch_assoc($result)){?>


                        <div class="profile">
                            <img src="assets/img/profile/undraw_male_avatar_re_nyu5.svg" alt="" class="post-profile"> 
                            <div class="post-profile-information">
                                <p class="post-profile-info"><?php echo $showpost['posted-user']; ?></p>
                                <p class="post-profile-info"><?php if($showpost['premium'] = '0'){
                                    echo "Not a Premium Post";
                                }else{
                                    echo "Premium Post";
                                } ?></p>
                                <a href="view_profile.php?id=<?php echo $showpost['user-id']; ?>">
                                    <button class="post-profile-view">View Profile</button>
                                </a>
                            </div>
                        </div>

                        <div class="post-title-div">
                            <p class="post-title-label">Post Title:</p>
                            <input type="text" name="post-title" class="post-title" value="<?php echo $showpost['post-name']?>" readonly>
                        </div>

                        <div class="post-description">
                            <textarea name="post-content" readonly class="post-content" id="" cols="30" rows="10"><?php echo $showpost['post-content']; ?></textarea>
                        </div>


                    <?php
                    }
                    }
                }else{
                    header("Location: posts");
                }
                ?>

        </div>

        <script src="https://kit.fontawesome.com/ba23ae2d89.js" crossorigin="anonymous"></script>
    </body>
</html>
<?php 
}else{
    header("Location: login");
}
?>