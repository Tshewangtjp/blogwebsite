<?php
include '../public/partials/header.php';

// fetch categories from database
$query = "SELECT * FROM categories ORDER BY cat_name";
$categories = mysqli_query($connection, $query);
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
  $stmt1 = $connection->prepare("SELECT COUNT(*) As total_records FROM categories");
  
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
  
  $stmt2 = $connection->prepare("SELECT * FROM categories LIMIT $offset,$total_records_per_page");
  $stmt2->execute();
  $categories = $stmt2->get_result();
  ?>

<section class="dashboard">
<?php if(isset($_SESSION['add-category-success'])) : ?>
        <div class="alert_message success" style="text-align: center;">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['add-category'])) : ?>
        <div class="alert_message success" style="text-align: center;">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-category-success'])) : ?>
        <div class="alert_message success" style="text-align: center;">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['delete-category-success'])) : ?>
        <div class="alert_message success" style="text-align: center;">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
                ?>
            </p>
        </div>
        <?php endif ?>
    <div class="container dashboard_container">
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>

                <li>
                    <a href="dashboard.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Post</h5>
                    </a>
                </li>
                <?php if(isset($_SESSION['user_is_admin'])): ?>
                <li>
                    <a href="add-user.php"><i class="uil uil-user-plus"></i>
                        <h5>Add User Post</h5>
                    </a>
                </li>

                <li>
                    <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                        <h5>Manage User</h5>
                    </a>
                </li>

                <li>
                    <a href="add-category.php"><i class="uil uil-edit"></i>
                        <h5>Add Category</h5>
                    </a>
                </li>

                <li>
                    <a href="manage-categories.php" class="active"><i class="uil uil-list-ul"></i>
                        <h5>Manage Category</h5>
                    </a>
                </li>

                <li>
                    <a href="add-photo.php"><i class="fa-solid fa-plus"></i>
                        <h5>Add Photo</h5>
                    </a>
                </li>

                <li>
                    <a href="manage-photo.php"><i class="fa-solid fa-photo-film"></i>
                        <h5>Manage Photo</h5>
                    </a>
                </li>

                
                <li>
                    <a href="add-services.php"><i class="fa-solid fa-plus"></i>
                        <h5>Add Services</h5>
                    </a>
                </li>

                <li>
                    <a href="manage-services.php"><i class="fa-regular fa-pen-to-square"></i>
                        <h5>Manage Services</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if(mysqli_num_rows($categories) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <tr>
                        <td><?= $category['cat_name'] ?></td>
                        <td><img src="<?php echo "../assets/images/". $category['images'] ?>"/></td>
                        <td><a href="<?= ROOT_URL ?>edit-category.php?cat_id=<?= $category['cat_id'] ?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>delete-category.php?cat_id=<?= $category['cat_id'] ?>" class="btn danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>

                <div class="containerss">
         <ul class="pagination">
            <li class="icon <?php if($page_no<=1){echo 'disabled';}?>"><a href="<?php if($page_no <= 1){echo '#';}else{echo '?page_no='.$page_no-1;} ?>">
               <span class="fas fa-angle-left"></span>
               Previous</a>
            </li>
            <li><a href="?page_no=1">1</a></li>
            <li><a href="?page_no=2">2</a></li>
            <li><a href="?page_no=3">3</a></li>
            <li><a href="?page_no=4">4</a></li>
            <?php if( $page_no >=5) {?>
            <li><a href="">...</a></li>
            <li><a href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no;?>></a></li>
            <?php }?>
            <li class="icon <?php if($page_no>= $total_no_of_page){echo 'disabled';} ?>"><a href="<?php if($page_no >= $total_no_of_page){echo '#';}else {echo "?page_no=".$page_no+1;}?>">
               Next<span class="fas fa-angle-right"></span>
               </a>
            </li>
         </ul>
      </div>
        </main>
    </div>
    <?php else : ?>
                <div class="alert_message error"><?= "No categories found" ?></div>
                <?php endif ?>
</section>

<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>
</body>
</html>