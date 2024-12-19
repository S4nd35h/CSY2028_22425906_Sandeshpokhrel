<?php
include 'header.php';
//this page is used to display the reviews of a specific user that is clicked  from the 
//auction page review section
//it shows all the reviews added by the specific user
$review = $join->query("SELECT * FROM review WHERE user_id = $_GET[id]"); // it receives the id from the auction page

echo '<main>
<h1> List of reviews</h1>';
foreach ($review as $review) {
    $user = $join->query("SELECT * FROM users WHERE user_id = $review[user_id]");
    $user = $user->fetch();
    echo '<ul>
                        <li><strong>' . $user['name'] . ' said </strong>' . $review['reviewtext'] . ' <em>' . $review['date'] . '</li>
                    </ul>';
}
?>
</main>
