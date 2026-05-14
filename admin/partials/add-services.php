      
<?php 
include '../public/partials/header.php';

//fetch categorries from database
$query = "SELECT * FROM services";
$services = mysqli_query($connection, $query);



// get back form data if form was invalid
$title = $_SESSION['add-services-data']['title'] ?? null;
$body = $_SESSION['add-services-data']['body'] ?? null;

    //delete form data session
    unset($_SESSION['add-services-data']);

?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Services</h2>
        <?php if(isset($_SESSION['add-services'])) : ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['add-post'];
                unset($_SESSION['add-post']);
                ?>
            </p>


        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>add-services-logic.php" class="admin_form" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title Of The Services">
          
            <textarea id="body" rows="10" name="body"><?= $body?></textarea>

            <button type="submit" name="submit" class="btn">Add Services</button>
        </form>
    </div>
</section>




<script src="<?= ROOT_URL  ?>../assets/js/main.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/theme.js"></script>
      <script src="<?= ROOT_URL  ?>../assets/js/app.js"></script>

</body>
</html>

