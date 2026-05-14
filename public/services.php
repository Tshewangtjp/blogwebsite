<?php 

include 'partials/header.php';

$query = "SELECT * FROM services ORDER BY date_time DESC";
$services = mysqli_query($connection, $query);
?>

<!--------END OFNAV------->
<br>
<br>
<br>
<?php if (mysqli_num_rows($services) > 0) : ?>
<div class="wrapper">
         <div class="box">
         <?php while($service = mysqli_fetch_assoc($services)) : ?>
            <div class="front-face">
               <span><?= $service['title']?></span>
            </div>
            <div class="back-face">
               <span><?= $service['title']?></span>
               <p>
               <?= $service['body']?> 
               </p>
            </div>
         </div>
         <?php endwhile ?>
        

        
   
      
      </div>

      <?php else : ?>
        <div class="alert_message error lg">
    <p>No Services found in this page</p>
</div>
<?php endif ?>
<?php
include 'partials/footer.php';

?>