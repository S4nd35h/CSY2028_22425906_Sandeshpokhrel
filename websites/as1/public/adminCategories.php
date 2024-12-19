<?php
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
        <a href="addCategory.php"><h2>Add Category</h2></a>
        <?php
        $categories = $join->query("SELECT * FROM category");
        foreach ($categories as $category) {
        ?>
            <div>
                <?php
                /**
                 * Generates HTML code for displaying a category.
                 *
                 * @param array $category The category data.
                 * @return string The HTML code for displaying the category.
                 */ ?>
                <h2><?php echo $category['name'] ?></h2>
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
    //if the user is not an admin, display page not found0
    echo '<h1>page not found !!</h1>';
}
include 'footer.php';
?>