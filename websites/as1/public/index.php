<?php
include 'header.php'; // Include the header file for page structure and navigation

// Prepare the initial SQL query to fetch auction details, including category name and current highest bid
$sql = "SELECT a.*, c.name AS category_name, MAX(b.bid) AS current_bid 
        FROM auction a 
        LEFT JOIN category c ON a.categoryId = c.category_id 
        LEFT JOIN bid b ON a.auction_id = b.auctionId";

// Check if the search form is submitted
if (isset($_POST['submit'])) {
    // Prepare the search keyword by adding wildcard characters for LIKE query
    $keyword = '%' . $_POST['search'] . '%';
    // Modify the SQL query to search in the auction title or description based on the search term
    $sql .= " WHERE a.title LIKE ? OR a.description LIKE ?";
    $params = [$keyword, $keyword]; // Bind the parameters for the query
} else {
    $params = []; // No parameters if the search form is not submitted
}

// Add GROUP BY to group by auction_id and ORDER BY to sort by end date, limiting results to 10
$sql .= " GROUP BY a.auction_id ORDER BY a.endDate LIMIT 10";
$auction = $join->prepare($sql); // Prepare the SQL query
$auction->execute($params); // Execute the query with parameters

$count = $auction->rowCount(); // Get the number of rows returned by the query

// Start outputting the main content section
echo '<main>
<h1>Latest Car Listings</h1>';

// Check if any auction listings are found
if ($count > 0) {
    // Loop through the auction results and display each item
    foreach ($auction as $row) {
        // Set a default image if no product image exists in the database
        $image = !empty($row['image']) ? htmlspecialchars($row['image']) : 'placeholder.png';

        // Handle null current_bid value, default to 0 if no bid is found
        $currentBid = $row['current_bid'] !== null ? $row['current_bid'] : 0;

        // Display the auction item details in an unordered list
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
    // If no auctions match the search criteria, display a "no results" message
    echo '<p>Sorry, no results found</p>';
}

// Close the main content section
echo '</main>';

require 'footer.php'; // Include the footer file for page structure and ending
?>
