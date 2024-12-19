<?php
include 'header.php';
//this page cannot be accessed by the user unless they are logged in and they are admin
//it displays all the users in the database and the admin can delete or edit them
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
    $user = $join->query('SELECT * FROM users');
    echo '<main>
    <a href="addUser.php"><h2>Add User</h2></a>';
    foreach ($user as $user) {
?>
        <h3> <?php echo $user['name'] . '<br> '; ?></h3>
        <a href="deleteUser.php?id=<?php echo $user['user_id'] ?>">Delete</a>
        <a href="editUser.php?id=<?php echo $user['user_id'] ?>">Edit</a>
<?php
    }
   echo' </main>';
}  else {
    //if the user is not an admin, display page not found0
    echo '<h1>page not found !!</h1>';
}
?>