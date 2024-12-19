<?php

// Include the header file to load necessary HTML structure and session management
require 'header.php';

// Check if the user is logged in by verifying the session ID
if (!isset($_SESSION['id'])) {
    // If the user is not logged in, display an error message and stop further execution
    die('Error: You must be logged in to add an auction.');
}

// Check if the form has been submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data using POST method, set default null if not provided
    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $category = $_POST['categoryId'] ?? null;
    $end_date = $_POST['endDate'] ?? null;
    $user_id = $_SESSION['id']; // Get the logged-in user's ID from the session

    // Validate that all required fields are filled out
    if (empty($title) || empty($description) || empty($category) || empty($end_date)) {
        // If any required field is empty, display an error message
        echo '<p>Error: All fields are required.</p>';
    } else {
        // If an image is uploaded, handle the file upload process
        $image_path = 'placeholder.png'; // Set a default image if no image is uploaded
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']; // Get the uploaded image file
            $target_dir = "uploads/"; // Define the directory where the image will be uploaded
            $target_file = $target_dir . basename($image["name"]); // Set the target file path
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Get the file extension

            // Validate the uploaded file is an image
            $check = getimagesize($image["tmp_name"]);
            if ($check !== false) {
                // Validate that the image file is of an allowed type (JPG, JPEG, PNG, GIF)
                if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                    // Try to move the uploaded file to the target directory
                    if (move_uploaded_file($image["tmp_name"], $target_file)) {
                        // If successful, update the image path with the uploaded file
                        $image_path = $target_file;
                    } else {
                        // If upload fails, display an error message and stop execution
                        echo "<p>Error: Failed to upload image.</p>";
                        exit();
                    }
                } else {
                    // If the image file type is not allowed, display an error message
                    echo "<p>Error: Only JPG, JPEG, PNG & GIF files are allowed.</p>";
                    exit();
                }
            } else {
                // If the uploaded file is not an image, display an error message
                echo "<p>Error: File is not an image.</p>";
                exit();
            }
        }

        // Prepare the SQL query to insert the auction data into the database
        $query = $join->prepare("INSERT INTO auction (title, description, categoryId, endDate, image, userId) 
                                 VALUES (:title, :description, :categoryId, :endDate, :image, :userId)");

        // Define the criteria to bind to the prepared statement
        $criteria = [
            'title' => $title,
            'description' => $description,
            'categoryId' => $category,
            'endDate' => $end_date,
            'image' => $image_path,
            'userId' => $user_id,
        ];

        // Execute the query and check if it was successful
        if ($query->execute($criteria)) {
            // If the auction is successfully added, redirect the user to their auctions page
            echo '<script>window.location.href="myAuction.php"</script>';
            exit();
        } else {
            // If the query fails, display an error message
            echo '<p>Error: Failed to add the auction.</p>';
        }
    }
}
?>

<!-- HTML form to collect auction details from the user -->
<main>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Title input field -->
        <label>Title</label>
        <input type="text" name="title" required />

        <!-- Description input field -->
        <label>Description</label>
        <textarea name="description" required></textarea>

        <!-- Category selection dropdown -->
        <label>Category</label>
        <select name="categoryId" required>
            <option value="" disabled selected>Select a category</option>
            <?php
            // Fetch available categories from the database
            $categories = $join->query("SELECT * FROM category");
            foreach ($categories as $category) {
                // Output category options dynamically from the database
                echo '<option value="' . htmlspecialchars($category['category_id']) . '">' . htmlspecialchars($category['name']) . '</option>';
            }
            ?>
        </select>

        <!-- End date input field -->
        <label>End Date</label>
        <input type="date" name="endDate" required />

        <!-- Image upload field (optional) -->
        <label>Image (optional)</label>
        <input type="file" name="image" />

        <!-- Submit button to add the auction -->
        <input type="submit" value="Add Auction" />
    </form>
</main>

<?php 
// Include the footer file to close the HTML structure
require 'footer.php'; 
?>
