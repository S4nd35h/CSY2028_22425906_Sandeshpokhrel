<?php
// Include the header file for necessary HTML structure and session management
include 'header.php';

// Fetch all auctions for the selected category based on the category ID from the URL parameter
$auction = $join->query("SELECT * FROM auction WHERE categoryId = $_GET[id]");

// Loop through each auction to display its details
foreach($auction as $auction){
    // If the auction has an image, use it, otherwise use a placeholder image
    $image = !empty($auction['image']) ? htmlspecialchars($auction['image']) : 'placeholder.png';

    // Fetch the category name for the current auction using the categoryId
    $category = $join->query("SELECT * FROM category WHERE category_id = $_GET[id]");
    $category = $category->fetch(); // Fetch the category details

    // Fetch the highest bid for the auction using its auctionId
    $bids = $join->query("SELECT max(bid) FROM bid WHERE auctionId = $auction[auction_id]");

    // Loop through the bids to fetch the maximum bid for the auction
    foreach ($bids as $bid) {
        // Display the auction information inside a <main> section
        echo '<main>
    
        <li>
            <!-- Display the auction image, with a fallback to a placeholder if no image is set -->
            <img src="' . $image .'" alt="product name" height="200" width="300">
            <article>
                <!-- Display the auction title -->
                <h2>'.$auction['title'].'</h2>
                <!-- Display the category name for the auction -->
                <h3>'.$category['name'].'</h3>
                <!-- Display the auction description -->
                <p>'.$auction['description'].'</p>

                <!-- Display the current bid amount -->
                <p class="price">Current bid: £'.$bid['max(bid)'].'</p>
                <!-- Link to the individual auction page for more details -->
                <a href="auction.php?id='.$auction['auction_id'].'" class="more auctionLink">More &gt;&gt;</a>
            </article>
        </li>

        </main>';
    }
}

// Include the footer to close the HTML structure
include 'footer.php';
?>
