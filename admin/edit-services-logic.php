<?php 
require 'config/database.php';

// make sure edit post button was clicked
if (isset($_POST['submit'])) {
    $service_id = filter_var($_POST['service_id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
    

    // check and validate input values
    if (!$title) {
        $_SESSION['edit-service'] = "Couldn't update, Invalid Data";
    }elseif (!$body) {
        $_SESSION['edit-service'] = "Couldn't update, Invalid Data";
    }

    if ($_SESSION['edit-service']) {
        // redirect to manage form page if form was invalid
        header('location: ' . ROOT_URL . 'manage-services.php');
        die();
    }else {
        $query = "UPDATE services SET title='$title', body='$body' WHERE service_id=$service_id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-service-success'] = "$title service updated successfully";
    }
}

header('location: ' . ROOT_URL . 'manage-services.php');