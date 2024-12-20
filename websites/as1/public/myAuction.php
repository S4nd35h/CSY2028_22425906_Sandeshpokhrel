<?php
require 'header.php';

// This page displays the auctions added by the logged-in user
if (isset($_SESSION['id'])) {
    // Securely fetch all auctions for the logged-in user
    $userId = $_SESSION['id'];
    $myAuction = $join->prepare("SELECT * FROM auction WHERE userId = :userId");
    $myAuction->execute(['userId' => $userId]);

    // Count the number of auctions added by the user
    $count = $myAuction->rowCount();

    // Uncomment for debugging (to ensure session and database data are correct)
    // var_dump($_SESSION['id']);
    // var_dump($myAuction->fetchAll(PDO::FETCH_ASSOC)); // Uncomment to debug query output
?>
    <main>
        <a href="addAuction.php">
            <h1>Add Auction</h1>
        </a>

        <?php
        if ($count == 0) {
            echo '<h1>You have no auctions</h1>';
        } else {
            foreach ($myAuction as $auction) {
                // Sanitize and fetch auction details
                $auction_id = htmlspecialchars($auction['auction_id']);
                $title = htmlspecialchars($auction['title']);
                $description = htmlspecialchars($auction['description']);
                $endDate = htmlspecialchars($auction['endDate']);
                $image = !empty($row['image']) ? 'uploads/' . htmlspecialchars($row['image']) : 'uploads/car.png';
                ?>

                <div class="auction-item">
                    <h2><?php echo $title; ?></h2>
                    <img src="<?php echo $image; ?>" alt="product image" height="100" width="100" />
                    <p><?php echo $description; ?></p>
                    <p>End Date: <?php echo $endDate; ?></p>
                    <a href="editAuction.php?id=<?php echo $auction_id; ?>">Edit</a>
                    <a href="deleteAuction.php?id=<?php echo $auction_id; ?>" onclick="return confirm('Are you sure you want to delete this auction?')">Delete</a>
                </div>
        <?php
            }
        }
        ?>
    </main>
<?php
} else {
    echo '<h1>Error: You must be logged in to view this page.</h1>';
}

require 'footer.php';
?>
