<?php
// Include the header file to load necessary HTML structure and session management
include 'header.php';
?>

<?php
/**
 * Check if the user is logged in and has the role of 'admin'.
 * If true, display the main content.
 */
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
?>
    <main>
        <!-- Link to navigate to the page where a new category can be added -->
        <a href="addCategory.php"><h2>Add Category</h2></a>

        <?php
        // Query to fetch all categories from the database
        $categories = $join->query("SELECT * FROM category");
        
        // Loop through each category and display the category information
        foreach ($categories as $category) {
        ?>
            <div>
                <?php
                /**
                 * Generates HTML code for displaying a category.
                 *
                 * @param array $category The category data.
                 * @return string The HTML code for displaying the category.
                 */
                ?>
                <!-- Display category name -->
                <h2><?php echo $category['name'] ?></h2>
                
                <!-- Links to edit or delete the category -->
                <a href="editCategory.php?id=<?php echo $category['category_id'] ?>">Edit</a>
                <a href="deleteCategory.php?id=<?php echo $category['category_id'] ?>">Delete</a>
            </div>
        <?php
        }
        ?>
    </main>
<?php
}
else {
    // If the user is not an admin, display a 'page not found' message
    echo '<h1>Page not found !!</h1>';
}
?>

<?php
// Include the footer file to close the HTML structure
include 'footer.php';
?>
