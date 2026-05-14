<?php
include '../public/partials/header.php';


// fetch categories data from database if id is set
if(isset($_GET['cat_id'])) {
    $cat_id = filter_var($_GET['cat_id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE cat_id=$cat_id";
    $result = mysqli_query($connection, $query);
    $category = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'dashboard.php');
    die();
}
?>
<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit Category</h2>
        <?php if(isset($_SESSION['edit-category'])) : ?>
        <div class="alert_message error" style="text-align: center;">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>edit-category-logic.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="cat_id" value="<?= $category['cat_id'] ?>">
        <input type="hidden" name="previous_thumbnail_name" value="<?= $category['images'] ?>">
        <input type="text" name="title" value="<?= $category['cat_name'] ?>" placeholder="Title Of The Category">
        <textarea id="description" rows="10" name="description" placeholder="Category Description"><?= $category['description'] ?></textarea>
            
            <div class="form_control">
                <label for="thumbnail">Change Thumbnail</label>
                
              <input type="file" id="thumbnail" name="thumbnail" value="<?= $category['images'] ?>"></input>
            </div>

            <button type="submit" name="submit" class="btn">Update Category</button>
        </form>
    </div>
</section>

    </script>
<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>
</body>
</html>