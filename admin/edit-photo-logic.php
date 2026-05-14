<?php 
require 'config/database.php';

// make sure edit post button was clicked
if (isset($_POST['submit'])) {
    
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

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
                    $_SESSION['edit-photo'] = "Couldn't update, Thumbnail size is too big. Should be less than 10mb";
                }
            } else {
                $_SESSION['edit-photo'] = "Couldn't update, Thumbnail should be png, jpg or jpeg";
            }
        }
    }

    if ($_SESSION['edit-photo']) {
        // redirect to manage form page if form was invalid
        header('location: ' . ROOT_URL . 'manage-photo.php');
        die();
    }else {
        // set is_featured of all posts to 0 if is_featured for this post is 1
       

        // set thumbnail name if a new one was uploaded, else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $query = "UPDATE photos SET images='$thumbnail_to_insert' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-photo-success'] = "Photo updated successfully";
    }


header('location: ' . ROOT_URL . 'manage-photo.php');