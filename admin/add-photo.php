<?php 
include '../public/partials/header.php';

//fetch categorries from database
$query = "SELECT * FROM photos";
$photos = mysqli_query($connection, $query);

// get back form data if form was invalid
$thumbnail = $_SESSION['add-photo-data']['images'] ?? null;

    //delete form data session
    unset($_SESSION['add-photo-data']);

?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Photo</h2>
        <?php if(isset($_SESSION['add-photo'])) : ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['add-photo'];
                unset($_SESSION['add-photo']);
                ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>add-photo-logic.php" enctype="multipart/form-data" method="POST">
            <div class="form_control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" value="<?= $thumbnail ?>">
            </div>
            <button type="submit" name="submit" class="btn">Add Photo</button>
        </form>
    </div>
</section>
<script>
 

    </script>
<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>

</body>
</html>

