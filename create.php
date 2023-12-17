<?php 
session_start();

require 'configuration/config.php';
require 'configuration/functions.php';

if(isset($_SESSION['user'])){
?>
<html>
    <head>
        <title>MarketPlace <?php sitename(); ?></title>
        <link rel="stylesheet" href="assets/css/create.css">
        
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
                <p class="total-users another-title">Total Premiums Posts:</p>
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

            <div class="create-post-panel">
                <form method="POST">
                    <?php 
                    if(isset($_POST['create-submit'])){
                        $title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['post-title']));
                        $content = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['post-description']));
                        $premium = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['post-premium']));
                        $username = $_SESSION['user'];

                        $sql = "SELECT id FROM users WHERE username='".$username."'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $user_id = $row['id'];
                        }


                        if($title == ""){
                            echo '<h1>Title is Empty!</h1>';
                        }else{
                            if($content == ""){
                                echo '<h1>Content is empty!</h1>';
                            }else{
                              if (strlen($title) > 10){
                                header("Location: other/html.html");
                                exit;
                              }else{
                                $sql = "INSERT INTO posts(`post-name`, `post-content`, `posted-user`, `user-id`, `premium`) VALUES('".$title."', '".$content."', '".$username."', '".$user_id."', '".$premium."')";
                                $result = mysqli_query($conn, $sql);
                                header("Location: create");
                                exit;
                              }  
                            }
                        }
                    }
                    ?>

                    <input maxlength="10" type="text" name="post-title" class="post-title" placeholder="post title.. 10 letters MAX. talk about what you sell ETC.">
                    <br>
                    <textarea name="post-description" class="post-description" placeholder="tell everyone what you sell, which accounts, what it has like payment methods or ITEMS, how much, where we can contact you ETC.." id="" cols="30" rows="10"></textarea>
                    <br>
                    <select name="post-premium" class="standardpremium">
                        <option value="0">Standard Posts</option>
                        <?php 
                        $username = $_SESSION['user'];
                        $sql = "SELECT premium FROM users WHERE username='".$username."' ";
                        $result = mysqli_query($conn, $sql);
                        
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_assoc($result);
                            $premium_onof = $row['premium'];

                            if($premium_onof == "1"){
                            echo '<option value="1">Premium</option>';
                            }else{
                                echo '<option disabled>Premium</option>';
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <button type="submit" name="create-submit" class="post-post-button">Post</button>
                </form>
            </div>

        </div>

        <script src="https://kit.fontawesome.com/ba23ae2d89.js" crossorigin="anonymous"></script>
    </body>
</html>
<?php }
?>