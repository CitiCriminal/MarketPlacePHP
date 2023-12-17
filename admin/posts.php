<html>
    <head>
        <title>MarketPlace /NAME/</title>
        <link rel="stylesheet" href="assets/css/users.css">
        
    </head>
    <body>
        <div class="header">
            <p class="another-title-top header-title">/NAME/</p>
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
                <p class="users-count another-title-top">N/A</p>
            </div>
            <div class="totalgraph">
                <p class="total-users another-title">Total Premiums:</p>
                <p class="users-count another-title-top">N/A</p>
            </div>
            <div class="search">
                <form method="POST">
                    <div class="search-input-div">
                        <input type="text" name="search" placeholder="..." class="search-input">
                        <button type="submit" name="search-submit" class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div>
                <p class="searched-post">Searched Posts:</p>
                <div class="searched-posts">
                    <?php 
                    if(isset($_POST['search-submit'])){
                        $searchname = $_POST['search'];
                        $sql = "SELECT * FROM posts WHERE `post-name` = '".$searchname."' ";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0){
                            while($showsearch = mysqli_fetch_assoc($result){
                    ?>

                    <div class="post-information">
                        <p class="post-info"><?php echo $showsearch['posted-user']; ?></p>
                        <p class="post-info"><?php echo $showsearch['post-name']; ?></p>
                        <textarea class="description post-info" name="description" id="" cols="20" rows="2" readonly ><?php echo $showsearch['posted-content']; ?></textarea>
                        <a class="post-info" href="view_posts.php?id=<?php echo $showsearch['id']; ?>">View</a>
                    </div>
                    
                    <?php
                            })
                        }
                    }
                    ?>
                </div>
            </div>
            <br>
            <br>
            <div>
                <p class="uploaded-posts">Posts uploaded:</p>
                <div class="posts">
                    <div class="post-information">
                        <p class="post-info">User</p>
                        <p class="post-info">123456</p>
                        <textarea class="description post-info" name="description" id="" cols="20" rows="2" readonly ></textarea>
                        <a class="post-info" href="">View</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/ba23ae2d89.js" crossorigin="anonymous"></script>
    </body>
</html>