<?php
include 'partials/header.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>

<section class="form_section">
    <div class="container form_section-container sm">
        <h2>Sign In</h2>
        <?php if (isset($_SESSION['signup-success'])): ?> 
            <div class="alert_message success">
            <p><?= $_SESSION['signup-success']; 
            unset($_SESSION['signup-success']);
            ?></p>
        </div>
        <?php elseif (isset($_SESSION['signin'])): ?>
        <div class="alert_message error">
            <p><?= $_SESSION['signin']; 
            unset($_SESSION['signin']);
            ?></p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>signin-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">
            <input type="password" name="password" value="<?= $password ?>" placeholder="Password">
            <button type="submit" name="submit" class="btn">Sign In</button>
           <small>Don't have account yet? <a href="signup.php">Sign Up</a></small>
        </form>
    </div>
</section>

<?php
include 'partials/footer.php';
?>