<?php
include '../public/partials/header.php';

// fetch categories from database
$photo_query = "SELECT * FROM photos";
$photos = mysqli_query($connection, $photo_query);

// fetch post data from database if id is set
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM photos WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $photo = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'manage-photo.php');
    die();
}
?>
<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit Photo</h2>
        
        <form action="<?= ROOT_URL ?>edit-photo-logic.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?= $photo['id'] ?>">
        <input type="hidden" name="previous_thumbnail_name" value="<?= $photo['images'] ?>">
            <div class="form_control">
                <label for="thumbnail">Change Thumbnail</label>
                
              <input type="file" id="thumbnail" name="thumbnail" value="<?= $photo['images'] ?>"></input>
            </div>

            <button type="submit" name="submit" class="btn">Update Photo</button>
        </form>
    </div>
</section>

    </script>
<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>
</body>
</html>