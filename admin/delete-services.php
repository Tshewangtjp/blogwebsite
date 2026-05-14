<?php
require 'config/database.php';

if(isset($_GET['service_id'])) {
    $service_id = filter_var($_GET['service_id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch post from database in order to delete thumbnail from images folder
    $query = "SELECT * FROM services WHERE service_id=$service_id";
    $result = mysqli_query($connection, $query);

    // make sure only 1 record/post was fetched
    if (mysqli_num_rows($result) == 1) {
        $service = mysqli_fetch_assoc($result);
            // delete post from database
            $delete_post_query = "DELETE FROM services WHERE service_id=$service_id LIMIT 1";
            $delete_post_result = mysqli_query($connection, $delete_post_query);


            if(!mysqli_errno($connection)) {
                $_SESSION['delete-service-success'] = 'service deleted successfully';
            }
        }
    }


header('location: ' . ROOT_URL . 'manage-services.php');
die();