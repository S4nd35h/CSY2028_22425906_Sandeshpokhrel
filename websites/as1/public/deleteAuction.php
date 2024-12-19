<?php
require('database.php');

// Only logged-in users can delete auctions, and only if it's theirs
if (isset($_SESSION['id'])) {
    // Sanitize and validate the auction ID from the GET request
    $auctionId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Ensure the auction ID is valid and greater than 0
    if ($auctionId > 0) {
        // Check if the auction belongs to the logged-in user
        $userId = $_SESSION['id'];
        $stmt = $join->prepare("SELECT * FROM auction WHERE auction_id = :auctionId AND userId = :userId");
        $stmt->execute(['auctionId' => $auctionId, 'userId' => $userId]);

        if ($stmt->rowCount() > 0) {
            // Auction belongs to the logged-in user, so proceed with deletion
            $deleteStmt = $join->prepare("DELETE FROM auction WHERE auction_id = :auctionId");
            $deleteStmt->execute(['auctionId' => $auctionId]);

            // Redirect the user to the myAuction page after deletion
            echo '<script>window.location.href="myAuction.php";</script>';
            die();
        } else {
            echo 'Error: You cannot delete this auction.';
        }
    } else {
        echo 'Invalid auction ID.';
    }
} else {
    echo 'Error: You must be logged in to delete an auction.';
}
?>
