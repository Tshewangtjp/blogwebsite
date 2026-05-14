<?php  
include 'partials/header.php';

//get back from data if there was registration error
$name = $_SESSION['signup-data']['fullname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
//delete
unset($_SESSION['signup-data']);
?>


<section class="form_section">
    <div class="container form_section-container">
        <h2>Sign Up</h2>
        <?php if (isset($_SESSION['signup'])): ?> 
            <div class="alert_message error">
            <p><?= $_SESSION['signup']; 
            unset($_SESSION['signup']);
            ?></p>
        </div>
        
        <?php endif ?>
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="name" value="<?= $name ?>" placeholder="Your Name">
            <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
            <input type="email" name="email" placeholder="Email" value="<?= $email ?>">
            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
            <div class="form_control">
                <label for="avatar">User Avatar</label>
                <input type="file" id="avatar" name="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
            <small>Already have an account? <a href="signin.php">Sign In</a></small>
        </form>
    </div>
</section>

<?php

include 'partials/footer.php';

?>