<?php
require 'header.php';

// Only logged-in users can edit auctions, and only if it's theirs
if (isset($_SESSION['id'])) {
    // Get the auction ID from the URL
    $auction_id = $_GET['id'];

    if (isset($_POST['submit'])) {
        // Retrieve updated data from the form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['categoryId'];
        $end_date = $_POST['endDate'];
        $user_id = $_SESSION['id'];

        // Check if the user uploaded a new image
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image'];

            // Validate and handle image upload
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the file is an actual image
            $check = getimagesize($image["tmp_name"]);
            if ($check !== false) {
                // Allow certain file formats
                if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($image["tmp_name"], $target_file)) {
                        // If the image is successfully uploaded, update the image path in the database
                        $image_path = $target_file;
                    } else {
                        echo "<p>Sorry, there was an error uploading your file.</p>";
                    }
                } else {
                    echo "<p>Only JPG, JPEG, PNG & GIF files are allowed.</p>";
                }
            } else {
                echo "<p>File is not an image.</p>";
            }
        } else {
            // If no new image is uploaded, retain the current image
            $image_path = $_POST['current_image'];
        }

        // Update the auction details
        $query = $join->prepare("UPDATE auction SET title = :title, description = :description, categoryId = :categoryId, endDate = :endDate, image = :image WHERE auction_id = :auction_id AND userId = :userId");
        $criteria = [
            'title' => $title,
            'description' => $description,
            'categoryId' => $category,
            'endDate' => $end_date,
            'image' => $image_path,
            'auction_id' => $auction_id,
            'userId' => $user_id
        ];

        // Execute the query with the criteria
        $query->execute($criteria);

        // Redirect the user to the myAuction page after successful update
        echo '<script>window.location.href="myAuction.php"</script>';
        die();
    }

    // Fetch the auction details to pre-fill the form
    $auction = $join->prepare("SELECT * FROM auction WHERE auction_id = :auction_id AND userId = :userId");
    $auction->execute(['auction_id' => $auction_id, 'userId' => $_SESSION['id']]);
    $auction = $auction->fetch();

    if ($auction) {
        ?>
        <main>
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Title</label> 
                <input type="text" name="title" value="<?php echo htmlspecialchars($auction['title']) ?>" />

                <label>Description</label> 
                <input type="text" name="description" value="<?php echo htmlspecialchars($auction['description']) ?>" />

                <label>Category</label>
                <select name="categoryId">
                    <?php
                    // Fetch all categories and mark the current one as selected
                    $categories = $join->query("SELECT * FROM category");
                    foreach ($categories as $category) {
                        ?>
                        <option value="<?php echo $category['category_id'] ?>" <?php if ($category['category_id'] == $auction['categoryId']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($category['name']) ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>

                <label>End Date</label> 
                <input type="date" name="endDate" value="<?php echo htmlspecialchars($auction['endDate']) ?>" />

                <label>Current Image</label> 
                <img src="<?php echo htmlspecialchars($auction['image']) ?>" alt="Auction Image" height="100" width="100" />

                <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($auction['image']) ?>" />

                <label>Update Image (optional)</label> 
                <input type="file" name="image" />

                <input type="submit" name="submit" value="Update Auction" />
            </form>
        </main>
        <?php
    } else {
        echo '<p>You cannot edit this auction.</p>';
    }
}

require 'footer.php';
?>
