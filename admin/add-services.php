<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>
        

<?php 
include '../public/partials/header.php';

//fetch categorries from database
$query = "SELECT * FROM services";
$service = mysqli_query($connection, $query);



// get back form data if form was invalid
$title = $_SESSION['add-service-data']['title'] ?? null;
$body = $_SESSION['add-service-data']['body'] ?? null;

    //delete form data session
    unset($_SESSION['add-service-data']);

?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Services</h2>
        <?php if(isset($_SESSION['add-service'])) : ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['add-service'];
                unset($_SESSION['add-service']);
                ?>
            </p>


        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>add-services-logic.php"  enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title Of The Services">
            <textarea id="body" rows="10" name="body"><?= $body?></textarea>


            
            <button type="submit" name="submit" class="btn">Add Service</button>
        </form>
    </div>
</section>




<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>

</body>
</html>

