<?php
require 'database.php';
//only logged in users can delete categories and only if they are admin
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
    //delete the category
    $id = $_GET['id'];
    $category = $join->prepare("DELETE FROM category WHERE category_id = $id");
    $category->execute();
    //redirect the user to the adminCategories page
    echo '<script>window.location.href="adminCategories.php"</script>';
    die();
}
