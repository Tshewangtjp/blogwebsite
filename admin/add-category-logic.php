<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    
    // validate form data
    if(!$title) {
        $_SESSION['add-category'] ='Enter Category Title';
    }elseif (!$description) {
        $_SESSION['add-category'] = 'Enter Category Description';
    }elseif (!$thumbnail['name']) {
        $_SESSION['add-category'] = 'Choose Post Thumbnail';
    }else {
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
                $_SESSION['add-category'] = 'File size too big. Should be less than 10mb';
            }
        }else {
            $_SESSION['add-category'] = 'File should be png, jpg, or jpeg';
        }

    }


    // redirect back
    if(isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'add-category.php');
        die();
    }else {
        // insert post into database
        $insert_category_query = "INSERT INTO categories (cat_name,  description, images) VALUES ('$title',  '$description', '$thumbnail_name')";
        $insert_category_result = mysqli_query($connection, $insert_category_query);

        if(!mysqli_errno($connection)) {
            $_SESSION['add-category-success'] = "New $title Category added successfully";
            header('location: ' . ROOT_URL . 'manage-categories.php');
            die();
        }
    }
}
header('location: ' . ROOT_URL . 'add-category.php');
die();