<?php
// Include the header file to load necessary HTML structure and session management
include 'header.php';

// Fetch auction data based on the auction_id parameter from the URL
$auction = $join->query("SELECT * FROM auction WHERE auction_id = $_GET[id]");
// Fetch the result of the query as an associative array
$auction = $auction->fetch();

// Fetch the category related to the auction using the categoryId from the auction data
$category = $join->query("SELECT * FROM category WHERE category_id = $auction[categoryId]");
// Fetch the category details
$category = $category->fetch();

// Fetch the author (user) details based on the userId from the auction
$author = $join->query("SELECT * FROM users WHERE user_id = $auction[userId]");
// Fetch the author's details
$author = $author->fetch();

// Fetch the highest bid for the auction
$bid = $join->query("SELECT max(bid) FROM bid WHERE auctionId = $auction[auction_id]");
// Fetch the highest bid amount
$bid = $bid->fetch();

// Fetch reviews for the author of the auction (user who created it)
$review = $join->query("SELECT * FROM review WHERE author_id = $auction[userId]");

// Get the image path of the auction
$image_path = $auction['image']; 

// Display the main content of the auction page
echo ' <main><h1>Car listing Page</h1>
			<article class="car">
					<img src="' . $image_path .'" alt="product name" height="300" width="300" />
					<section class="details">
						<h2>' . $auction['title'] . '</h2>
						<h3>' . $category['name'] . '</h3>
						<p>Auction created by <a href="#">' . $author['name'] . '</a></p>
						<p class="price">Current bid: £' . $bid['max(bid)'] . '</p>';

// Calculate the remaining time for the auction to end
$endDate = strtotime($auction['endDate']); // Convert auction end date to timestamp
$presentTime = time(); // Get the current timestamp
$diffrenceTime = $endDate - $presentTime; // Calculate the time difference between the auction end time and the current time

// If the auction is still active, display the remaining time
if ($diffrenceTime >= 0) {
	// Calculate days, hours, and minutes remaining
	$days = floor($diffrenceTime / (60 * 60 * 24));
	$hours = floor(($diffrenceTime % (60 * 60 * 24)) / (60 * 60));
	$min = floor(($diffrenceTime % (60 * 60)) / 60);

	// Display the remaining time
	echo '<time>Time left:  ' . $days . ' days ' . $hours . ' hours ' . $min . ' minutes</time>';
} else {
	// If the auction has ended, display a message saying the auction is finished
	echo '<time>Auction is finished</time>';
}

// If the user is logged in and the auction is still active, display a bid form
if (isset($_SESSION['id'])) {
	if ($auction['endDate'] > date('Y-m-d H:i:s')) {
		// Display the form to place a bid
		echo '	<form action="bid.php?id=' . $_GET['id'] . '" class="bid" method="post">
							<input type="text" name="bid" placeholder="Enter bid amount" />
							<input type="submit" value="Place bid" />
						</form>';
	}
}

// Display the auction description
echo '</section>
					<section class="description">
					<p>
						' . $auction['description'] . '</p>
					</section>

					<section class="reviews">
						<h2>Reviews of ' . $author['name'] . ' </h2>';

// Loop through each review and display it
foreach ($review as $review) {
	// Fetch the user details who wrote the review
	$user = $join->query("SELECT * FROM users WHERE user_id = $review[user_id]");
	$user = $user->fetch(); // Fetch the user data

	// Display the review with the username linked to their reviews page
	echo '<ul>
							<li><strong><a href="listreview.php?id=' . $review['user_id'] . '">' . $user['name'] . '</a>  said </strong>' . $review['reviewtext'] . ' <em>' . $review['date'] . '</em></li>
						</ul>';
}

// If the user is logged in, display a form to add a review
if (isset($_SESSION['id'])) {
	echo '<form action="review.php?id=' . $_GET['id'] . '&author=' . $auction['userId'] . '" method="post">
							<label>Add your review</label> <textarea name="reviewtext"></textarea>
							<input type="submit" name="submit" value="Add Review" />
						</form>';
}

// Close the main content section
echo '</section>
					</article>
					<hr />
					</main>';

// Include the footer to close the HTML structure
include 'footer.php';
?>
