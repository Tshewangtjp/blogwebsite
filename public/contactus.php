<?php include 'sendmail.php'; ?>
<?php
include 'partials/header.php';

?>

<!--------END OFNAV------->
<main>
    <section class="contact">
    
    <!--alert messages end-->
        </div>
        <div class="container">
            <div class="left">
                <div class="form-wrapper">
                    <div class="contact-heading">
                    <h1>For Freelance Work<span>.</span></h1>
                    <p class="text">Or reach via : <a href="" target="_blank">Pemanorbu@gmail.com</a></p>
                </div>
                <form action="" method="post" class="contact-form">
                    <div class="input-wrap">
                        <input type="text" class="contact-input" autocomplete="off" name="name" required>
                        <label>Your Name</label>
                        <i class="icon fa-solid fa-address-card"></i>
                    </div>

                    <div class="input-wrap w-100">
                        <input type="email" class="contact-input" autocomplete="off" name="email" required>
                        <label>Your Email</label>
                        <i class="icon fa-solid fa-envelope"></i>
                    </div>

                    <div class="input-wrap textarea w-100">
                        <textarea name="message" autocomplete="off" class="contact-input" required></textarea>
                        <label>Your Message</label>
                        <i class="icon fa-solid fa-inbox"></i>
                    </div>
                    <div class="contact-buttons">
            
                        <input type="submit" name="submit"  value="Send message" class="btn">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</main>



<?php 
include 'partials/footer.php';


?>