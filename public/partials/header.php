<?php
require 'config/database.php';
// fetch current user from database


if(isset($_SESSION['user-id'])) {
    $user_id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE user_id=$user_id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pema Carves With Ink</title>
    <link rel="stylesheet" href="<?= ROOT_URL  ?>../assets/css/public.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet" />
    <!---IconScout-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.core.css">    

</head>
<body>
    <nav>
        <div class="container nav_container">
            <a href="<?= ROOT_URL  ?>../public/index.php"><img src="../assets/images/bhutan flag color logo.png" class="logo"></a>
            <img src="../assets/images/moon.png" id="icon">
            
        <ul class="nav_items">
            <li><a href="<?= ROOT_URL  ?>../public/index.php">Home</a></li>
            <li><a href="<?= ROOT_URL  ?>../public/post.php">Post</a></li>
            <li><a href="<?= ROOT_URL  ?>../public/services.php">Services</a></li>
            <li><a href="<?= ROOT_URL  ?>../public/aboutus.php">AboutUs</a></li>
            <li><a href="<?= ROOT_URL  ?>../public/contactus.php">ContactUs</a></li>
            <?php if(isset($_SESSION['user-id'])): ?>
            
                <li class="nav_profile">
            <div class="avatar">
                <img src="<?= ROOT_URL . '../assets/images/' . $avatar['avatar'] ?>">
            </div>
            <ul>
            
                <li><a href="<?= ROOT_URL  ?>../admin/dashboard.php">Dashboard</a></li>
                
                <li><a href="<?php ROOT_URL ?>../public/logout.php">Logout</a></li>
            </ul>
        </li>
        <?php else : ?>
            <li><a href="<?= ROOT_URL  ?>signin.php">Login</a></li>
        <?php endif ?>
       
     
    </ul>
        <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
        <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
        
    </nav>