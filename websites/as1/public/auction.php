<?php
include 'header.php';
$auction = $join->query("SELECT * FROM auction WHERE auction_id = $_GET[id]");
//fething the data from the database that is received from the url
$auction = $auction->fetch();
$category = $join->query("SELECT * FROM category WHERE category_id = $auction[categoryId]");
$category = $category->fetch();
$author = $join->query("SELECT * FROM users WHERE user_id = $auction[userId]");
$author = $author->fetch();
$bid = $join->query("SELECT max(bid) FROM bid WHERE auctionId = $auction[auction_id]"); //fetches the highest bid that is made in the auction
$bid = $bid->fetch();
$review = $join->query("SELECT * FROM review WHERE author_id = $auction[userId]");
$image_path = $auction['image']; 
echo ' <main><h1>Car listing Page</h1>
			<article class="car">

					<img src="' . $image_path .'" alt="product name" height="300" width="300" />
					<section class="details">
						<h2>' . $auction['title'] . '</h2>
						<h3>' . $category['name'] . '</h3>
						<p>Auction created by <a href="#">' . $author['name'] . '</a></p>
						<p class="price">Current bid: £' . $bid['max(bid)'] . '</p>';
$endDate = strtotime($auction['endDate']); // Replace with your actual end date
$presentTime = time();
$diffrenceTime = $endDate - $presentTime;
if ($diffrenceTime >= 0) {
	// Calculate days and remaining hours and minutes
	$days = floor($diffrenceTime / (60 * 60 * 24));
	$hours = floor(($diffrenceTime % (60 * 60 * 24)) / (60 * 60));
	$min = floor(($diffrenceTime % (60 * 60)) / 60);

	// Display the remaining time
	echo '<time>Time left:  ' . $days . ' days ' . $hours . ' hours ' . $min . ' minutes</time>';
} else {
	echo '<time>Auction is finished</time>';
}
if (isset($_SESSION['id'])) {
	if ($auction['endDate'] > date('Y-m-d H:i:s')) {
		//if the user is logged in, display the form to place a bid
		echo '	<form action="bid.php?id=' . $_GET['id'] . '" class="bid" method="post">
							<input type="text" name="bid" placeholder="Enter bid amount" />
							<input type="submit" value="Place bid" />
						</form>';
	}
}
echo '</section>
					<section class="description">
					<p>
						' . $auction['description'] . '</p>


					</section>

					<section class="reviews">
						<h2>Reviews of ' . $author['name'] . ' </h2>';
foreach ($review as $review) {
	$user = $join->query("SELECT * FROM users WHERE user_id = $review[user_id]");
	//fetching the reviews from the database of the author
	$user = $user->fetch();
	//the username has the link which redirects to listreview where you can find the all reviews added by that specific user
	echo '<ul>
							<li><strong><a href="listreview.php?id=' . $review['user_id'] . '">' . $user['name'] . '</a>  said </strong>' . $review['reviewtext'] . ' <em>' . $review['date'] . '</li>
						
							</ul>';
}


if (isset($_SESSION['id'])) {
	//if the user is logged in, display the form to add a review
	echo '<form action="review.php?id=' . $_GET['id'] . '&author=' . $auction['userId'] . '" method="post">
							<label>Add your review</label> <textarea name="reviewtext"></textarea>
							<input type="submit" name="submit" value="Add Review" />
						</form>';
}
echo '</section>
					</article>

					<hr />
					</main>';
include 'footer.php';
