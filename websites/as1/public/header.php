<?php
include 'database.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Carbuy Auctions</title>
    <link rel="stylesheet" href="carbuy.css" />
</head>

<body>
    <header>
        <h1>
            <a href="index.php">
                <span class="C">C</span>
                <span class="a">a</span>
                <span class="r">r</span>
                <span class="b">b</span>
                <span class="u">u</span>
                <span class="y">y</span>
            </a>
        </h1>
        <form action="index.php" method="POST">
            <input type="text" name="search" placeholder="Search for anything" />
            <input type="submit" name="submit" value="Search" />
            <?php
            // If user is not logged in, show the login button
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
            echo $_SESSION['loggedin'];
            echo '| <a href="logout.php">Logout</a>';
            echo '| <a href="myAuction.php">My Auctions</a>';
            // If the user is an admin, display admin-related links
            if ($_SESSION['role'] == 'admin') {
                echo ' | <a href="adminCategories.php">Admin Categories</a>';
                echo ' | <a href="listUser.php">List user</a>';
            }
        }
        ?>
    </div>

    <nav>
        <ul>
            <?php
            $categories = $join->query('SELECT * FROM category');
            // Display the categories in the navigation menu
            foreach ($categories as $category) {
                echo '<li><a class="categoryLink" href="category.php?id=' . $category['category_id'] . '">' . $category['name'] . '</a></li>';
            }
            ?>
        </ul>
    </nav>

    <div class="banner">
        <img src="banners/1.jpg" alt="Banner" />
    </div>

</body>

</html>
