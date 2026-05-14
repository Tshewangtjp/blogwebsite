<?php

include 'partials/header.php';

// fetch all posts from posts table 
$query = "SELECT * FROM posts ORDER BY date_time DESC";
$posts = mysqli_query($connection, $query);
?>

<?php
//pagination
if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    //if user has already entered page then page is the one that user selected
    $page_no = $_GET['page_no'];
  }else{
    //if user just entered the page then default page is 1
    $page_no = 1;
  }
  
  //return number of products
  $stmt1 = $connection->prepare("SELECT COUNT(*) As total_records FROM posts");
  
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();
  
  //product per page
  $total_records_per_page = 10;
  
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  
  $adjacents = "2";
  
  $total_no_of_page = ceil($total_records/$total_records_per_page);
  
  //get all products
  
  $stmt2 = $connection->prepare("SELECT * FROM posts LIMIT $offset,$total_records_per_page");
  $stmt2->execute();
  $posts = $stmt2->get_result();
  ?>

<!--------END OFNAV------->
<section class="search_bar">
<?php if (mysqli_num_rows($posts) > 0) : ?>
    <form class="container search_bar-container" action="<?= ROOT_URL ?>search.php" method="GET">
        <div>
            <i class="uil uil-search"></i>
            <input type="search" name="search" placeholder="Search">
        </div>
        <button type="submit" name="submit" class="btn">Go</button>
    </form>
</section>

<section class="posts <?= $featured ? '' : 'section__extra_margin' ?>">
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
    <div class="containers">
         <ul class="pagination">
            <li <?php if($page_no<=1){echo 'disabled';}?>><a href="<?php if($page_no <= 1){echo '#';}else{echo '?page_no='.$page_no-1;} ?>">Previous</a></li>
            <li><a href="?page_no=1">1</a></li>
            <li><a href="?page_no=2">2</a></li>
            <li><a href="?page_no=3">3</a></li>
            <li><a href="?page_no=4">4</a></li>
            <?php if( $page_no >=5) {?>
            <li><a href="">...</a></li>
            <li><a href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no;?>></a></li>
            <?php }?>
            <li <?php if($page_no>= $total_no_of_page){echo 'disabled';} ?>><a href="<?php if($page_no >= $total_no_of_page){echo '#';}else {echo "?page_no=".$page_no+1;}?>">Next</a></li>
         </ul>
      </div>
    
</section>

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
<?php else : ?>
        <div class="alert_message error lg">
    <p>No posts found in this page</p>
</div>
<?php endif ?>
<?php 
include 'partials/footer.php';
?>