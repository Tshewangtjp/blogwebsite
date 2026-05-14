<?php 
require 'config/database.php';

// make sure edit post button was clicked
if (isset($_POST['submit'])) {
    $cat_id = filter_var($_POST['cat_id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];


   

    // check and validate input values
    if (!$title) {
        $_SESSION['edit-category'] = "Couldn't update, Invalid Data";
    }elseif (!$description) {
        $_SESSION['edit-category'] = "Couldn't update, Invalid Data";
    }else {
        // delete existing thumbnail if new thumbnail is available
        if ($thumbnail['name']) {
            $previous_thumbnail_path ='../assets/images/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {
                unlink($previous_thumbnail_path);
            }

            // Work on new thumbnail
            // Rename Image
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../assets/images/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extention = explode('.', $thumbnail_name);
            $extention = end($extention);
            if (in_array($extention, $allowed_files)) {
                // make sure avatar is not too large
                if ($thumbnail['size'] < 10000000) {
                    // upload avatar
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['edit-category'] = "Couldn't update, Thumbnail size is too big. Should be less than 10mb";
                }
            } else {
                $_SESSION['edit-category'] = "Couldn't update post, Thumbnail should be png, jpg or jpeg";
            }
        }
    }

    if ($_SESSION['edit-category']) {
        // redirect to manage form page if form was invalid
        header('location: ' . ROOT_URL . 'edit-category.php');
        die();
    }else {
        // set is_featured of all posts to 0 if is_featured for this post is 1
        

        // set thumbnail name if a new one was uploaded, else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $update_category_query = "UPDATE categories SET cat_name='$title', description='$description', images='$thumbnail_to_insert'
         WHERE cat_id=$cat_id LIMIT 1";
        $update_category_result = mysqli_query($connection, $update_category_query);
    }

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-category-success'] = "$title Category updated successfully";
    }
}

header('location: ' . ROOT_URL . 'manage-categories.php');