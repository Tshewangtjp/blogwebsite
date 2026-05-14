
<?php
include '../public/partials/header.php';


// fetch post data from database if id is set
if(isset($_GET['service_id'])) {
    $service_id = filter_var($_GET['service_id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM services WHERE service_id=$service_id";
    $result = mysqli_query($connection, $query);
    $service = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'manage-services.php');
    die();
}
?>
<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit Service</h2>
        
        <form action="<?= ROOT_URL ?>edit-services-logic.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="service_id" value="<?= $service['service_id'] ?>">
            <input type="text" name="title" value="<?= $service['title'] ?>" placeholder="Title Of The Services">
           
            <textarea id="body" name="body"><?= $service['body'] ?></textarea>
          
            <button type="submit" name="submit" class="btn">Update Services</button>
        </form>
    </div>
</section>


<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>
</body>
</html>