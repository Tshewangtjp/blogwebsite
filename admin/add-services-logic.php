<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    // validate form data
    if(!$title) {
        $_SESSION['add-sevice'] ='Enter Services Title';
    }elseif (!$body) {
        $_SESSION['add-service'] = 'Enter Services Description';
    }
    }


    // redirect back
    if(isset($_SESSION['add-service'])) {
        $_SESSION['add-service-data'] = $_POST;
        header('location: ' . ROOT_URL . 'add-services.php');
        die();
    }else {
        // insert post into database
        $query = "INSERT INTO services (title,  body) VALUES ('$title',  '$body')";
        $result = mysqli_query($connection, $query);

        if(!mysqli_errno($connection)) {
            $_SESSION['add-service-success'] = "$title new service added successfully";
            header('location: ' . ROOT_URL . 'manage-services.php');
            die();
        }
    }

header('location: ' . ROOT_URL . 'add-services.php');
die();