<?php 
include '../public/partials/header.php';



// get back form data if form was invalid
$title = $_SESSION['add-category-data']['cat_name'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;
$thumbnail = $_SESSION['add-category-data']['images'] ?? null;

    //delete form data session
    unset($_SESSION['add-category-data']);

?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Category</h2>
        <?php if(isset($_SESSION['add-category'])) : ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>add-category-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Category Title">
    
            <textarea rows="10" name="description" id="description" placeholder="Description of Category"><?= $description ?></textarea>
            <div class="form_control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" value="<?= $thumbnail ?>">
            </div>
            <button type="submit" name="submit" class="btn">Add Category</button>
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

