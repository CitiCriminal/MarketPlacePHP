<?php 
session_start();

require 'configuration/config.php';
require 'configuration/functions.php';

if(isset($_SESSION['user'])){
?>
<html>
    <head>
        <title>MarketPlace <?php sitename(); ?></title>
        <link rel="stylesheet" href="assets/css/post.css">
        
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
                <p class="total-users another-title">Your Posts:</p>
                <p class="users-count another-title-top"><?php $sql = "SELECT * FROM posts WHERE `posted-user` = '".$_SESSION['user']."'"; $result = mysqli_query($conn, $sql); if(mysqli_num_rows($result) > 0){
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
                <p class="total-users another-title">Total Premiums Posts:</p>
                <p class="users-count another-title-top"><?php $sql = "SELECT * FROM posts WHERE premium = '1'"; $result = mysqli_query($conn, $sql); if(mysqli_num_rows($result) > 0){
                    echo mysqli_num_rows($result);
                }else{
                    echo "0";
                }?></p>
            </div>
            <div class="totalgraph">
                <p class="total-users another-title">BTC Price:</p>
                <p class="users-count another-title-top"><?php bitcoinprice(); ?></p>
            </div>
            <div class="search">
                <form method="POST">
                <div class="search-input-div">
                    <input type="text" name="search" placeholder="..." class="search-input">
                    <button type="submit"name="search-submit"  class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                </form>
            </div>
            <div>
                <p class="searched-post">Searched Posts:</p>
                <?php 
                    if(isset($_POST['search-submit'])){
                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                        $sql = "SELECT * FROM posts WHERE `post-name` LIKE '".$search."'  AND `premium` = '1'";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0){
                            while($searching = mysqli_fetch_assoc($result)){ ?>
                <div class="searched-posts">
                    <div class="post-information">
                        <p class="post-info"><?php echo $searching['posted-user']?></p>
                        <p class="post-info"><?php echo $searching['post-name']?></p>
                        <textarea class="description post-info" name="description" id="" cols="20" rows="2" readonly ><?php echo $searching['post-content']?></textarea>
                        <a class="post-info" href="">View</a>
                    </div>
                </div>
                <?php 
                        }
                    }else{
                        echo '<h1 class="another-title" style="position:relative; text-align:center;">Not found.</h1>';
                    }
                }
                ?>
            </div>
            <br>
            <br>
            <div>
                <p class="uploaded-posts">Posts uploaded:</p>
                <?php 
                    $sql = "SELECT * FROM posts WHERE premium = '1'";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($posted_posts = mysqli_fetch_assoc($result)){?>
                <div class="posts">
                    <div class="post-information">
                        <p class="post-info"><?php echo $posted_posts['posted-user']?></p>
                        <p class="post-info"><?php echo $posted_posts['post-name']?></p>
                        <textarea class="description post-info" name="description" id="" cols="20" rows="2" readonly ><?php echo $posted_posts['post-content']?></textarea>
                        <a class="post-info" href="">View</a>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
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