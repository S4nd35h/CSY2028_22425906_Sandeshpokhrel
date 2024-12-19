<?php
include 'header.php';

// Prepare the search query with a placeholder
$sql = "SELECT a.*, c.name AS category_name, MAX(b.bid) AS current_bid 
        FROM auction a 
        LEFT JOIN category c ON a.categoryId = c.category_id 
        LEFT JOIN bid b ON a.auction_id = b.auctionId";

// Check if the search form is submitted
if (isset($_POST['submit'])) {
    $keyword = '%' . $_POST['search'] . '%';
    $sql .= " WHERE a.title LIKE ? OR a.description LIKE ?";
    $params = [$keyword, $keyword];
} else {
    $params = [];
}

// Order by endDate and limit the results to 10
$sql .= " GROUP BY a.auction_id ORDER BY a.endDate LIMIT 10";
$auction = $join->prepare($sql);
$auction->execute($params);

$count = $auction->rowCount();

// Display the listings or a "no results" message
echo '<main>
<h1>Latest Car Listings</h1>';
if ($count > 0) {
    foreach ($auction as $row) {
        // Set a default image if no product image exists
        $image = !empty($row['image']) ? htmlspecialchars($row['image']) : 'placeholder.png';

        // Handle null current_bid value
        $currentBid = $row['current_bid'] !== null ? $row['current_bid'] : 0;

        echo '<ul class="carList">
            <li>
                <img src="'. $image .'" alt="product image">
                <article>
                    <h2>' . htmlspecialchars($row['title']) . '</h2>
                    <h3>' . htmlspecialchars($row['category_name']) . '</h3>
                    <p>' . htmlspecialchars($row['description']) . '</p>
                    <p class="price">Current bid: £' . htmlspecialchars($currentBid) . '</p>
                    <a href="auction.php?id=' . htmlspecialchars($row['auction_id']) . '" class="more auctionLink">More &gt;&gt;</a>
                </article>
            </li>
        </ul>';
    }
} else {
    echo '<p>Sorry, no results found</p>';
}
echo '</main>';

require 'footer.php';
