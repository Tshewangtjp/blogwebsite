<?php
include 'partials/header.php';

if(isset($_GET['user_id'])) {
    $user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE user_id=$user_id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}else {
    header('location: ' . ROOT_URL . 'manage-users.php');
    die();
}
?>
<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit User</h2>    
        <form action="<?= ROOT_URL ?>edit-user-logic.php"  method="POST">
        <input type="hidden" value="<?= $user['user_id'] ?>" name="user_id">    
        <input type="text" value="<?= $user['fullname'] ?>" name="name" placeholder="Your Name">
            <select name="userrole">
                <option value="2">Author</option>
                <option value="1">Admin</option>
                <option value="2">Editor</option>
                <option value="0">Users</option>
            </select>
           
            <button type="submit" name="submit" class="btn">Update Users</button>
             </form>
    </div>
</section>

<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>

</body>
</html>