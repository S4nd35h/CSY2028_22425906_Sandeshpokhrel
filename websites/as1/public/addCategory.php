<?php
// Include the header file to load necessary HTML structure and session management
require 'header.php';

// Check if the user is logged in and has an 'admin' role
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
?>
    <main>
        <!-- Form to add a category. This is only visible to the admin. -->
        <form action="addCategory.php" method="POST">
            <label>Category Name</label> 
            <input type="text" name="name" required />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </main>

<?php
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Get the category name from the submitted form data
        $name = $_POST['name'];

        // Prepare the SQL query to insert the new category into the database
        $query = $join->prepare("INSERT INTO category (name) VALUES (:name)");
        
        // Using prepared statements to prevent SQL injection
        $criteria = ['name' => $name];
        
        // Execute the query and check if it was successful
        if ($query->execute($criteria)) {
            // If the insertion is successful, redirect the user to the admin categories page
            echo '<script>window.location.href="adminCategories.php"</script>';
            die();
        } else {
            // If there is an error, display an error message
            echo '<p>There was an error adding the category. Please try again</p>';
        }
    }
} else {
    // If the user is not logged in as an admin, display a "page not found" message
    echo '<h1>Page not found !!</h1>';
}

// Include the footer file to close the HTML structure
include 'footer.php';
?>
