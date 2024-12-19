<?php
include 'header.php';
//only logged in users can edit categories and only if they are admin
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
    $id = $_GET['id'];
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $query = $join->prepare("UPDATE category SET name = :name WHERE category_id = $id");
        //using the execute method instead of query method to prevent sql injection
        $criteria = ['name' => $name];
        $query->execute($criteria);
        //redirect the user to the adminCategories page
        echo '<script>window.location.href="adminCategories.php"</script>';
        die();
    }
    $category = $join->query("SELECT * FROM category WHERE category_id = $id");
    $category = $category->fetch();
    //using fetch to get the first row of the result
?>
    <main>
        <form action="" method="POST">
            <label>Category Name</label> <input type="text" name="name" value="<?php echo $category['name'] ?>" />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </main>
<?php


}
else {
    //if the user is not an admin, display page not found0
    echo '<h1>page not found !!</h1>';
}

?>