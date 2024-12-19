<?php
require 'database.php';
//this page is used to add the review to the database and the user should be logged in 
if(isset($_SESSION['id'])){
$auction_id = $_GET['id'];
$author = $_GET['author'];
$review = $_POST['reviewtext'];
$user_id = $_SESSION['id'];
$date= date("Y-m-d");
//the review is added to the database
$reviews = $join->prepare("INSERT INTO review (reviewtext, user_id, author_id, date) VALUES (:reviewtext, :user_id, :author_id, :date)");
$criteria = ['reviewtext' => $review, 'user_id' => $user_id, 'author_id' => $author, 'date' => $date];
$reviews->execute($criteria);
//redirect the user to the same page
echo '<script>window.location.href="auction.php?id='.$auction_id.'"</script>';
die();

}