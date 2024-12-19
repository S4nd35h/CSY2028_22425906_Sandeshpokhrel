<!-- /**
 * Deletes a user from the database and redirects to the listUser.php page.
 *
 * @param int $id The ID of the user to be deleted.
 * @return void
 */ -->
<?php
include 'header.php';
//only logged in users can delete users and only if they are admin
if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'admin') {
    $deleteUser = $join->prepare("DELETE FROM users WHERE user_id = $_GET[id]");
    $deleteUser->execute();
}
//redirect the user to the listUser page
echo '<script>window.location.href = "listUser.php";</script>';
