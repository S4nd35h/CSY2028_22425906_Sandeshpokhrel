<?php
// Include the database connection for executing queries
require('database.php');

// Check if the user is logged in (i.e., session ID is set)
if (isset($_SESSION['id'])) {
    // Sanitize and validate the auction ID passed via the GET request
    // Ensure the ID is an integer to prevent SQL injection
    $auctionId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Ensure that the auction ID is valid (greater than 0)
    if ($auctionId > 0) {
        // Retrieve the logged-in user's ID
        $userId = $_SESSION['id'];

        // Prepare a query to check if the auction belongs to the logged-in user
        $stmt = $join->prepare("SELECT * FROM auction WHERE auction_id = :auctionId AND userId = :userId");
        $stmt->execute(['auctionId' => $auctionId, 'userId' => $userId]);

        // If the auction exists and belongs to the logged-in user, proceed with deletion
        if ($stmt->rowCount() > 0) {
            // Prepare the delete statement to remove the auction from the database
            $deleteStmt = $join->prepare("DELETE FROM auction WHERE auction_id = :auctionId");
            $deleteStmt->execute(['auctionId' => $auctionId]);

            // Redirect the user to the "myAuction" page after successful deletion
            echo '<script>window.location.href="myAuction.php";</script>';
            die(); // Terminate the script after redirection
        } else {
            // If the auction does not belong to the user, display an error
            echo 'Error: You cannot delete this auction.';
        }
    } else {
        // If the auction ID is invalid, display an error
        echo 'Invalid auction ID.';
    }
} else {
    // If the user is not logged in, display an error
    echo 'Error: You must be logged in to delete an auction.';
}
?>
