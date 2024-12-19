<?php
include 'header.php';
//this page will display all auctions of the selected category from the navbar
$auction = $join->query("SELECT * FROM auction WHERE categoryId = $_GET[id]");
foreach($auction as $auction){
	$image = !empty($auction['image']) ? htmlspecialchars($auction['image']) : 'placeholder.png';
    $category = $join->query("SELECT * FROM category WHERE category_id = $_GET[id]");
    $category = $category->fetch();
    $bids = $join->query("SELECT max(bid) FROM bid WHERE auctionId = $auction[auction_id]");
    foreach ($bids as $bid) {

echo '<main>
    
<li>
					<img src="' . $image .'" alt="product name" height="200" width="300">
					<article>
						<h2>'.$auction['title'].'</h2>
						<h3>'.$category['name'].'</h3>
						<p>'.$auction['description'].'</p>

						<p class="price">Current bid: £'.$bid['max(bid)'].'</p>
						<a href="auction.php?id='.$auction['auction_id'].'" class="more auctionLink">More &gt;&gt;</a>
					</article>
				</li>
	

</main>';
}
}
include 'footer.php';