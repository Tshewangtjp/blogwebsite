<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 if unchecked
        // WORK ON THUMBNAIL
        // rename the image
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../assets/images/' . $thumbnail_name;

        // make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $thumbnail_name);
        $extention = end($extention);
        if(in_array($extention, $allowed_files)) {
            // make sure image is not big. (10mb)
            if($thumbnail['size'] < 10_000_000) {
                // upload thumbnail
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);

            }else {
                $_SESSION['add-photo'] = 'File size too big. Should be less than 10mb';
            }
        }else {
            $_SESSION['add-photo'] = 'File should be png, jpg, or jpeg';
        }

    }


    // redirect back
    if(isset($_SESSION['add-photo'])) {
        $_SESSION['add-photo-data'] = $_POST;
        header('location: ' . ROOT_URL . 'add-photo.php');
        die();
    }else {
       

        // insert post into database
        $query = "INSERT INTO photos (images) VALUES ('$thumbnail_name')";
        $result = mysqli_query($connection, $query);

        if(!mysqli_errno($connection)) {
            $_SESSION['add-photo-success'] = "New photo added successfully";
            header('location: ' . ROOT_URL . 'manage-photo.php');
            die();
        }
    }

header('location: ' . ROOT_URL . 'add-post.php');
die();