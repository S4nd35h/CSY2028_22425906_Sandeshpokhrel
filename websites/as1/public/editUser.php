<?php
include 'header.php'; // Include the header file for the page layout

// Check if the user is logged in and if the user has admin privileges
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
    // Fetch the user details from the database based on the ID passed in the URL (GET request)
    $user = $join->query('SELECT * FROM users WHERE user_id = ' . $_GET['id']);
    $user = $user->fetch(); // Fetch the user data into an associative array
?>
    <main>
        <!-- Form to edit user details -->
        <form action="" method="post">
            <label>Username</label> <input type="text" name="name" value="<?php echo $user['name'] ?>" />
            <label>Password</label> <input type="text" name="password" value="<?php echo $user['password'] ?>" />
            <label>Email</label> <input type="text" name="email" value="<?php echo $user['email'] ?>" />
            <label>Role</label> 
            <select name="role">
                <!-- The selected option should match the current user's role -->
                <option value="<?php echo $user['role'] ?>" <?php if ($user['user_id'] == $_GET['id']) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $user['role'] ?></option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Submit" />
        </form>
    </main>

<?php
    // If the form is submitted, update the user information in the database
    if (isset($_POST['submit'])) {
        // Capture the form data
        $username = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Hash the password before storing it in the database for security
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to update the user's details in the database
        $addUser = $join->prepare("UPDATE users SET name = :name, password = :password, email = :email, role = :role WHERE user_id = :id");
        $addUser->bindParam(':name', $username);
        $addUser->bindParam(':password', $password);
        $addUser->bindParam(':email', $email);
        $addUser->bindParam(':role', $role);
        $addUser->bindParam(':id', $_GET['id']); // Use the ID from the GET request to update the correct user

        // Execute the query to update the user information
        $addUser->execute();

        // After the update, redirect the user to the list of users page
        echo '<script>window.location.href = "listUser.php";</script>';
    }
} else {
    // If the user is not logged in or is not an admin, display a "page not found" message
    echo '<h1>Page not found !!</h1>';
}
?>
