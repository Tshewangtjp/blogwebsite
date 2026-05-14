<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>

<?php 
include 'partials/header.php';

// fetch post from database if id is set
if(isset($_GET['post_id'])) {
    $post_id = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
}else {
    header('location: ' . ROOT_URL . 'singlepage.php');
    die();
}


// recent post
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 5";
$posts = mysqli_query($connection, $query);

$query = "SELECT * FROM posts WITH cat_id=$cat_id LIMIT 5";
$post1 =mysqli_query($connection, $query);

$post_id = $_GET['post_id'];
$blog_title = $post['title'];
$share_image = $post['thumbnail'];
$share_url = "http://localhost:3000/public/singlepost.php?$post_id=post_id";
$blog_content  = $post['body'];

$visitor_ip=$_SERVER['REMOTE_ADDR'];

$query = "SELECT * FROM posts WHERE views='$visitor_ip'";
$result = mysqli_query($connection, $query);

// checking query error
if (!$result) {
    die("Retriving Query Error<br>".$query);
}
$total_visitors=mysqli_num_rows($result);
if ($total_visitors<1) {
    $query = "INSERT posts (views) VALUES($visitor_ip)";
$result = mysqli_query($connection, $query);

}

//fetch existing visitors
$query = "SELECT * FROM posts";
$result = mysqli_query($connection, $query);

// checking query error
if (!$result) {
    die("Retriving Query Error<br>".$query);
}
$total_visitors=mysqli_num_rows($result);

?>






<!--------END OFNAV------->
 <!--Page Banner-->
         <section class="page-banner">
            <div class="banner-container">
                <div class="left-box">
                    <h1 class="banner-title" style='font-size: 2rem;'><?= $post['title']?></h1>
                    <div class="post-details">
                        <div class="author-wrapper">
                        <?php
                    // fetch author from users table using author_id
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE user_id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);


                    ?>
                            <div class="name-wrapper">
                                <a href="#">By: <?= $author['fullname'] ?></a>
                                <small>
                                <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                                </small>
                            </div>
                        </div>
                        <div class="view">
                            <br>
                            <small>Views:<?php echo $total_visitors; ?></small>
                        </div>
                        
                        <div class="social-links">
                        <meta property="og:title" <?php echo 'content="'.$blog_title.'"'; ?>/>
                        <meta property="og:image" <?php echo 'content="'.$share_image.'"'; ?>/>
                        <meta property="og:url" <?php echo 'content="'.$share_url.'"'; ?>/>
                        <meta property="og:description" <?php echo 'content="'.$blog_content.'"'; ?>/>                                                          
                        <meta property="og:site_name" content="http://localhost:3000/public/"/>
                            <span>Share</span>
                            <br>
                            <br>
                            <a class="facebook-btn" href="https://www.facebook.com/share.php?u=<?php echo $blog_title . $share_url;?>" target="_blank" style="color: blue;"><i class="uil uil-facebook"></i></a>
                            <a class="twitter-btn"href="https://twitter.com/share?text=<?php echo $blog_title;?>&url=<?php echo $share_url;?>" target="_blank" style="color: #1DA1F2;"><i class="uil uil-twitter"></i></a>
                            <a class="instagram-btn" href="https://www.instagram.com/share.php?u=<?php echo $blog_title . $share_url;?>" target="_blank" style="color: #C13584;"><i class="uil uil-instagram"></i></a>
                        </div>
        
                    </div>
                </div>
                <div class="right-box">
                    <div class="bg-image featured-image-wrapper" style="background-image: url(../assets/images/<?= $post['thumbnail']?>);">

                    </div>
                </div>
            </div>
        </section>
        <div class="right-box">
                    <div class="bg-image image-wrapper" style="background-image: url(../assets/images/<?= $post['thumbnail']?>);">
                    </div>
                </div>
        <div class="default-page-container page-container single-page">
            <div class="main-content">      
                <div class="primary-font">
                    <p class="post-body">
                    <?php echo html_entity_decode(preg_replace('/\s+?(\S+)?$/', '', $post["body"])); ?>
                    </p>
                    
                </div>            
            </div>
           <div class="sidebar">
           <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v19.0" nonce="rw63odkE"></script>
<div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100063469936455" data-tabs="timeline" data-width="250" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/profile.php?id=100063469936455" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=100063469936455">Pema carves with ink</a></blockquote></div>

                    <div class="sidebar-section topics-section">
                        <div class="section popular">
                      
                            <h2 class="Popular" style="color: black;">Recent Post</h2>
                            <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                            <div class="post">
                                <img src="../assets/images/<?= $post['thumbnail'] ?>">
                                <a href="<?= ROOT_URL ?>singlepost.php?post_id=<?= $post['post_id'] ?>" style="transform: translateY(20px); color: black; font-size: 18px; font-weight: 500; hover: green;"><?= $post['title']?></a>
                            </div>
                            <?php endwhile ?>
                        </div>
                    </div>

                    <?php
                if (isset($_GET['post_id'])) {
                    $post_id = $_GET['post_id'];
                    }

                $sql1 = "select * from posts where post_id=$post_id";
                $result1 = mysqli_query($connection, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                ?>
                    <div class="sidebar-section topics-section">
                        <div class="section popular">
                      
                            <h2 class="Popular" style="color: black;">Related Post</h2>
                            <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
                            <div class="post">
                                <img src="../assets/images/<?= $row['thumbnail'] ?>">
                                <a href="<?= ROOT_URL ?>singlepost.php?post_id=<?= $row['post_id'] ?>" style="transform: translateY(20px); color: black; font-size: 18px; font-weight: 500; hover: green;"><?= $row['title']?></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>


                                
<?php } ?>
                   

                  
                   
                </div>
                
             </div>

             <section class="category_buttons">
     <!--image card layout start-->
     <div class="container">
     <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
    
    ?>
      <!--image row start-->
      <div class="row">
      <?php while($category = mysqli_fetch_assoc($all_categories)) : ?>
        <!--image card start-->
        <div class="image">
          <img src="../assets/images/<?= $category['images']?>" alt="">
          <div class="details">
            <a href="<?= ROOT_URL ?>category-posts.php?cat_id=<?= $category['cat_id'] ?>"><h2><?= $category['cat_name']?></h2></a>
          </div>
        </div>
        <!--image card end-->
        <?php endwhile ?>
      </div>
     
    </div>
    <!--image card layout end-->
</section>

<?php 

include 'partials/footer.php';

?>