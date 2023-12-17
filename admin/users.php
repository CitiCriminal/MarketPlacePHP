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
        <link rel="stylesheet" href="assets/css/users.css">
        
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
                <p class="total-users another-title">Total Users:</p>
                <p class="users-count another-title-top"><?php $sql = "SELECT * FROM users"; $result = mysqli_query($conn, $sql); if(mysqli_num_rows($result) > 0){
                    echo mysqli_num_rows($result);
                }else{
                    echo "0";
                }?></p>
            </div>
            <div class="search">
                <div class="search-input-div">
                    <input type="text" name="search" placeholder="..." class="search-input">
                    <button type="submit" name="search-submit" class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
            <div><?php 
                    if(isset($_POST['search-submit'])){
                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                        $sql = "SELECT * FROM users WHERE `username` LIKE '".$search."'";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0){
                            while($searching = mysqli_fetch_assoc($result)){ ?>
                <p class="searched-post">Searched Users:</p>
                <div class="searched-posts">
                    <div class="post-information">
                        <p class="post-info"><?php echo $searching['id']; ?></p>
                        <p class="post-info"><?php echo $searching['username']; ?></p>
                        <p class="post-info"><?php echo $searching['role']; ?></p>
                        <a class="post-info" href="<?php echo $searching['id']; ?>">View</a>
                    </div>
                </div>
                <?php 
                }
            }
        }?>
            </div>
            <br>
            <br>
            <div>
                <p class="uploaded-posts">Users on site:</p>
                <?php 
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($users_list = mysqli_fetch_assoc($result)){?>
                <div class="posts">
                    <div class="post-information">
                        <p class="post-info"><?php echo $users_list['id']; ?></p>
                        <p class="post-info"><?php echo $users_list['username']; ?></p>
                        <p class="post-info"><?php echo $users_list['role']; ?></p>
                        <a class="post-info" href="<?php echo $users_list['id']; ?>">View</a>
                    </div>
                </div>
                <?php 
                }
            }?>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/ba23ae2d89.js" crossorigin="anonymous"></script>
    </body>
</html>
<?php 
}
?>