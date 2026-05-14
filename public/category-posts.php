<?php 
include 'partials/header.php';


// fetch posts if id is set
if (isset($_GET['cat_id'])) {
    $cat_id = filter_var($_GET['cat_id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE cat_id=$cat_id ORDER by date_time DESC";
    $posts = mysqli_query($connection, $query);
}else {
    header('location: ' . ROOT_URL . 'post.php');
}
?>


    <!-----endofnav-->
<header class="category_title">
    <h2>
        <?php
    // fetch category from categories table using category_id of post
            $category_id = $cat_id;
            $category_query = "SELECT * FROM categories WHERE cat_id=$cat_id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            echo $category['cat_name']
            ?>
    </h2>
</header>
<?php if (mysqli_num_rows($posts) > 0) : ?>
<section class="posts">
    <div class="container post_container">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
        <article class="post">
            <div class="post_thumbnail">
                <img src="../assets/images/<?= $post['thumbnail']?>">
            </div>
            <div class="post_info">
            
                <a href="<?= ROOT_URL ?>category-posts.php?cat_id=<?= $category['cat_id'] ?>" class="category_button"><?= $category['cat_name'] ?></a>
                <h3 class="post_title"><a href="<?= ROOT_URL ?>singlepost.php?post_id=<?= $post['post_id'] ?>"><?= $post['title']?></a></h3>
                <p class="post_description">
                <?php echo html_entity_decode(preg_replace('/\s+?(\S+)?$/', '', substr($post["body"], 0, 200))); ?>
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
<?php else : ?>
<div class="alert_message error lg">
    <p>No posts found in this category</p>
</div>
<?php endif ?>
<!---Start of category----->
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
 
