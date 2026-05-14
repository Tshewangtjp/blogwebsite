<?php
include 'partials/header.php';

// fetch featyred post from database
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// fetch 9 posts from posts table 
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
$posts = mysqli_query($connection, $query);

$photo_query = "SELECT * FROM photos";
$photos = mysqli_query($connection, $photo_query);

?>

<!--------END OFNAV------->
<?php if(mysqli_num_rows($featured_result) == 1) : ?>
<section class="featured">
    <div class="container featured_container">
        <div class="post_thumbnail">
            <img src="../assets/images/<?= $featured['thumbnail'] ?>">
        </div>
        <div class="post_info">
            <?php 
            // fetch category from categories table using category_id of post
            $category_id = $featured['cat_id'];
            $category_query = "SELECT * FROM categories WHERE cat_id=$category_id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            ?>
            <a href="<?= ROOT_URL ?>category-posts.php?cat_id=<?= $category['cat_id'] ?>" class="category_button"><?= $category['cat_name'] ?></a>
            <h2 class="post_title"><a href="<?= ROOT_URL ?>singlepost.php?post_id=<?= $featured['post_id'] ?>"><?= $featured['title'] ?></a></h2>
            <p class="post_description">
              <?php echo html_entity_decode(preg_replace('/\s+?(\S+)?$/', '', substr($featured["body"], 0, 300))); ?>
                </p>
                <br>
               <a href="<?= ROOT_URL ?>singlepost.php?post_id=<?= $featured['post_id'] ?>" class="readmore">Read More →</a>
                <div class="post_author">
                    <?php
                    // fetch author from users table using author_id
                    $author_id = $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE user_id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);


                    ?>
                    <div class="post_author-avatar">
                        <img src="../assets/images/<?= $author['avatar']?>">
                    </div>
                    <div class="post_author-info">
                        <h5>By: <?= $author['fullname'] ?></h5>
                        <small>
                            <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                        </small>

                    </div>
                </div>
        </div>
    </div>
</section>
<?php endif ?>
<!---------END  OF FEATURED POST-->
<br>
<section class="posts <?= $featured ? '' : 'section_extra_margin' ?>">
    <h2 style="text-align: center;"></h2>
        <br>
    <div class="container post_container">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
        <article class="post">
            <div class="post_thumbnail">
                <img src="../assets/images/<?= $post['thumbnail']?>">
            </div>
            <div class="post_info">
            <?php 
            // fetch category from categories table using category_id of post
            $category_id = $post['cat_id'];
            $category_query = "SELECT * FROM categories WHERE cat_id=$category_id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            ?>

                <a href="<?= ROOT_URL ?>category-posts.php?cat_id=<?= $category['cat_id'] ?>" class="category_button"><?= $category['cat_name'] ?></a>
                <h3 class="post_title"><a href="<?= ROOT_URL ?>singlepost.php?post_id=<?= $post['post_id'] ?>"><?= $post['title']?></a></h3>
                <p class="post_description">
                <?php echo html_entity_decode(preg_replace('/\s+?(\S+)?$/', '', substr($post["body"], 0, 300))); ?>
                </p>
                <br>
               <a href="<?= ROOT_URL ?>singlepost.php?post_id=<?= $post['post_id'] ?>" class="readmore">Read More →</a>
                <div class="post_author">
                <?php
                    // fetch author from users table using author_id
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE user_id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>

                    <div class="post_author-avatar">
                        <img src="../assets/images/<?= $author['avatar']?>">
                    </div>
                    <div class="post_author-info">
                        <h5>By: <?= $author['fullname'] ?></h5>
                        <small>
                        <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        </article>
        <?php endwhile ?>
    </div>
</section>
<!------End of Posts-->
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




<!---Start of category----->


 <div class="container">
    <?php while($photo = mysqli_fetch_assoc($photos)) : ?>
      <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
          
        </button>
        <ul class="image-list">
          <img class="image-item" src="../assets/images/<?= $photo['images']?>"alt="img-1" />
        </ul>
        <button id="next-slide" class="slide-button material-symbols-rounded">
          >
        </button>
      </div>
      <div class="slider-scrollbar">
        <div class="scrollbar-track">
          <div class="scrollbar-thumb"></div>
        </div>
      </div>
      <?php endwhile ?>
    </div>

 
    
    
<!-----END OF Categories button-->
<?php
include 'partials/footer.php';
?>