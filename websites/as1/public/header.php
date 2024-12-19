<?php
include 'database.php'; // Include the database connection
?>
<!DOCTYPE html>
<html>

<head>
    <title>Carbuy Auctions</title>
    <link rel="stylesheet" href="carbuy.css" /> <!-- Link to the external stylesheet for styling -->
</head>

<body>
    <header>
        <h1>
            <a href="index.php">
                <!-- Logo styling with individual span elements for each character -->
                <span class="C">C</span>
                <span class="a">a</span>
                <span class="r">r</span>
                <span class="b">b</span>
                <span class="u">u</span>
                <span class="y">y</span>
            </a>
        </h1>
        <form action="index.php" method="POST">
            <!-- Search form for users to search for items -->
            <input type="text" name="search" placeholder="Search for anything" />
            <input type="submit" name="submit" value="Search" />
            <?php
            // If the user is not logged in, show the login button
            if (!isset($_SESSION['id'])) {
                echo '<input type="button" value="Login" onclick="window.location.href=\'login.php\'" />';
            }
            ?>
        </form>
    </header>

    <div class="user-info">
        <?php
        // If the user is logged in, display the username and logout link
        if (isset($_SESSION['id'])) {
            echo $_SESSION['loggedin']; // Display logged-in username
            echo '| <a href="logout.php">Logout</a>'; // Provide the logout link
            echo '| <a href="myAuction.php">My Auctions</a>'; // Provide link to user's auctions
            // If the user is an admin, display admin-related links
            if ($_SESSION['role'] == 'admin') {
                echo ' | <a href="adminCategories.php">Admin Categories</a>'; // Admin category management
                echo ' | <a href="listUser.php">List user</a>'; // Admin user management
            }
        }
        ?>
    </div>

    <nav>
        <ul>
            <?php
            // Query to get all categories from the database and display them in the navigation menu
            $categories = $join->query('SELECT * FROM category');
            foreach ($categories as $category) {
                // Display each category as a clickable link
                echo '<li><a class="categoryLink" href="category.php?id=' . $category['category_id'] . '">' . $category['name'] . '</a></li>';
            }
            ?>
        </ul>
    </nav>

    <div class="banner">
        <!-- Display a banner image for the website -->
        <img src="banners/1.jpg" alt="Banner" />
    </div>

</body>

</html>
