<?php
include 'database.php';
/**
 * Handles the submission of a bid for an auction.
 * If the bid made by any user is higher than the current bid, the bid is added to the database.
 *
 * @param int $bid_amt The amount of the bid.
 * @param int $auction_id The ID of the auction.
 * @param int $user_id The ID of the user placing the bid.
 */
if(isset($_SESSION['id'])){
    $bid_amt = $_POST['bid'];
    $auction_id = $_GET['id'];
    $user_id = $_SESSION['id'];
    $bid = $join->prepare("INSERT INTO bid (bid, auctionId, user_id) VALUES (:bid_amt, :auction_id, :user_id)");
    $criteria = ['bid_amt' => $bid_amt, 'auction_id' => $auction_id, 'user_id' => $user_id];
    $bid->execute($criteria);
    //redirect the user to the auction page
    echo '<script>window.location.href="auction.php?id='.$auction_id.'"</script>';
}