<?php
include '../public/partials/header.php';

// fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT user_id=$current_admin_id";
$users = mysqli_query($connection, $query);

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
  $stmt1 = $connection->prepare("SELECT COUNT(*) As total_records FROM users");
  
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
  
  $stmt2 = $connection->prepare("SELECT * FROM users LIMIT $offset,$total_records_per_page");
  $stmt2->execute();
  $users = $stmt2->get_result();
  ?>


<section class="dashboard">
<?php if(isset($_SESSION['add-user-success'])) : ?>
        <div class="alert_message success" style="text-align: center;">
            <p>
                <?= $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-user-success'])) : ?>
        <div class="alert_message success container" style="text-align: center;">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>
            </p>
        </div> 
        <?php elseif(isset($_SESSION['edit-user'])) : ?>
        <div class="alert_message error" style="text-align: center;">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?>
            </p>
        </div>   
        <?php elseif(isset($_SESSION['delete-user'])) : ?>
        <div class="alert_message error" style="text-align: center;">
            <p>
                <?= $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
                ?>
            </p>
        </div>    
        <?php elseif(isset($_SESSION['delete-user-success'])) : ?>
        <div class="alert_message success" style="text-align: center;">
            <p>
                <?= $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']);
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
                    <a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                        <h5>Manage Category</h5>
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
            <h2>Manage User</h2>
            <?php if(mysqli_num_rows($users) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td><?= $user['fullname']?></td>
                        <td><?= $user['username']?></td>
                        <td><a href="<?= ROOT_URL ?>edit-user.php?user_id=<?= $user['user_id'] ?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>delete-user.php?user_id=<?= $user['user_id'] ?>" class="btn danger">Delete</a></td>
                        <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
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
                <div class="alert_message error"><?= "No users found" ?></div>
                <?php endif ?>
    
</section>

<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>

</body>
</html>