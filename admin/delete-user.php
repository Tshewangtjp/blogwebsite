<?php
require 'config/database.php';

if(isset($_GET['user_id'])) {
    // fetch user from database
    $user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch user from database
    $query = "SELECT * FROM users WHERE user_id=$user_id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // make sure we got back only one user
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../assets/images/' .$avatar_name;
        // delete image if available
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    // FOR LATER
    // fetch all thumbnails of users post and delete
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$author_id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if(mysqli_num_rows($thumbnails_result) > 0) {
        while($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
            $thumbnail_path = '../assets/images/' . $thumbnail['thumbnail'];

            //delete thumbnail from images folder is exist
            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }


    // delete user from database
    $delete_user_query = "DELETE FROM users WHERE user_id=$user_id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "couldn't delete '{$user['fullname']}'";
    } else {
        $_SESSION['delete-user-success'] = "'{$user['fullname']}' deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'manage-users.php');
die();