<?php

require 'header.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    die('Error: You must be logged in to add an auction.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $category = $_POST['categoryId'] ?? null;
    $end_date = $_POST['endDate'] ?? null;
    $user_id = $_SESSION['id'];

    // Validate required fields
    if (empty($title) || empty($description) || empty($category) || empty($end_date)) {
        echo '<p>Error: All fields are required.</p>';
    } else {
        // Handle image upload (if provided)
        $image_path = 'placeholder.png'; // Default image
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate image file
            $check = getimagesize($image["tmp_name"]);
            if ($check !== false) {
                if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                    if (move_uploaded_file($image["tmp_name"], $target_file)) {
                        $image_path = $target_file;
                    } else {
                        echo "<p>Error: Failed to upload image.</p>";
                        exit();
                    }
                } else {
                    echo "<p>Error: Only JPG, JPEG, PNG & GIF files are allowed.</p>";
                    exit();
                }
            } else {
                echo "<p>Error: File is not an image.</p>";
                exit();
            }
        }

        // Insert auction into the database
        $query = $join->prepare("INSERT INTO auction (title, description, categoryId, endDate, image, userId) 
                                 VALUES (:title, :description, :categoryId, :endDate, :image, :userId)");
        $criteria = [
            'title' => $title,
            'description' => $description,
            'categoryId' => $category,
            'endDate' => $end_date,
            'image' => $image_path,
            'userId' => $user_id,
        ];

        if ($query->execute($criteria)) {
            echo '<script>window.location.href="myAuction.php"</script>';
            exit();
        } else {
            echo '<p>Error: Failed to add the auction.</p>';
        }
    }
}
?>

<main>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title</label>
        <input type="text" name="title" required />

        <label>Description</label>
        <textarea name="description" required></textarea>

        <label>Category</label>
        <select name="categoryId" required>
            <option value="" disabled selected>Select a category</option>
            <?php
            // Fetch categories
            $categories = $join->query("SELECT * FROM category");
            foreach ($categories as $category) {
                echo '<option value="' . htmlspecialchars($category['category_id']) . '">' . htmlspecialchars($category['name']) . '</option>';
            }
            ?>
        </select>

        <label>End Date</label>
        <input type="date" name="endDate" required />

        <label>Image (optional)</label>
        <input type="file" name="image" />

        <input type="submit" value="Add Auction" />
    </form>
</main>

<?php require 'footer.php'; ?>
