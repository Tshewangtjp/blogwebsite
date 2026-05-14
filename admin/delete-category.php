<?php
require 'config/database.php';

if(isset($_GET['cat_id'])) {
    $cat_id = filter_var($_GET['cat_id'], FILTER_SANITIZE_NUMBER_INT);

    // FOR LATER
    // update category_id of posts that belong to this category to id of uncategorized category
    $update_query = "UPDATE posts SET cat_id=5 WHERE cat_id=$cat_id";
    $update_result = mysqli_query($connection, $update_query);

    if(!mysqli_errno($connection)) {

// delete category
$query = "DELETE FROM categories WHERE cat_id=$cat_id LIMIT 1";
$result = mysqli_query($connection, $query);
$_SESSION['delete-category-success'] = "Category deleted successfully";

}
}
header('location: ' . ROOT_URL . 'manage-categories.php');
die();
