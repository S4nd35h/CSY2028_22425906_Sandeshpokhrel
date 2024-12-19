<?php
require 'header.php';
//the user should be logged in and should be an admin
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
?>
    <main>
        <!-- form to add a category -->
        <form action="addCategory.php" method="POST">
            <label>Category Name</label> <input type="text" name="name" required />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </main>
<?php
    if (isset($_POST['submit'])) {
        //when the user submits the form, insert the category into the database
        $name = $_POST['name'];
        $query = $join->prepare("INSERT INTO category (name) VALUES (:name)");
        //using prepared statements to prevent sql injection
        $criteria = ['name' => $name];
        //using criteria to prevent sql injection
        if ($query->execute($criteria)) {
        //redirect the user to adminCategories.php
        echo '<script>window.location.href="adminCategories.php"</script>';
        die();
        } else{
            echo '<p>There was an error adding the category. Please try again</p>';
        }
    }
}
else {
    //if the user is not an admin, display page not found0
    echo '<h1>page not found !!</h1>';
}
include 'footer.php';
?>