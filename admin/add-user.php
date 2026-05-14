<?php
include '../public/partials/header.php';

// get back form data if there was an error
$name = $_SESSION['add-user-data']['fullname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
$userrole = $_SESSION['add-user-data']['userrole'] ?? null;

// delete session data
?>
<section class="form_section">
    <div class="container form_section-container">
        <h2>Add User</h2>
        <?php if(isset($_SESSION['add-user'])) : ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['add-user'];
                unset($_SESSION['add-user']);
                ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>add-user-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="name" value="<?= $name ?>" placeholder="Your Name">
            <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
            <input type="emai" name="email" value="<?= $email ?>" placeholder="Email">
            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
            <select name="userrole">
                <option value="2">Author</option>
                <option value="1">Admin</option>
                <option value="3">Editor</option>
                <option value="0">Users</option>
            </select>
            <div class="form_control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" value="<?= $avatar ?>" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Add Users</button>
             </form>
    </div>
</section>
<footer>
<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>
</footer>
</body>
</html>