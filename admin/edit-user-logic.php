<?php
require 'config/database.php';
if(isset($_POST['submit'])) {
    ///get updated form data
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // check for valid input
    if (!$name) {
        $_SESSION['edit-user'] = "Invalid Letters";
    } else {
        // update user
        $query = "UPDATE users SET fullname='$name', is_admin=$is_admin WHERE 
        user_id=$user_id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Failed to update user";
        }else {
            $_SESSION['edit-user-success'] = "User $name updated successfully";
        }
    }

}

header('location: ' . ROOT_URL . 'manage-users.php');
die();