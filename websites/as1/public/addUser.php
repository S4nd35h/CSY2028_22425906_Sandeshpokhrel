<?php
// Include the header file to load necessary HTML structure and session management
include 'header.php';
?>

<main>
    <!-- Check if the user is logged in and has an 'admin' role, only then show the form to add a user -->
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') { ?>
        <!-- Form to add a user. Only accessible by the admin -->
        <form action="addUser.php" method="post">
            <!-- Input field for the user's username -->
            <label for="username">Username</label>
            <input type="text" name="name" id="username" required />
            
            <!-- Input field for the user's password -->
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
            
            <!-- Input field for the user's email -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required />
            
            <!-- Dropdown menu for selecting the user's role -->
            <label for="role">Role</label>
            <select name="role" id="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            
            <!-- Submit button to add the user -->
            <input type="submit" name="submit" value="Add User" />
        </form>
</main>

<?php
        // If the form is submitted, process the user data
        if (isset($_POST['submit'])) {
            // Retrieve form data
            $username = $_POST['name'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            // Hash the password using password_hash() to ensure it's securely stored
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL query to insert the new user into the database
            $addUser = $join->prepare("INSERT INTO users (name, password, email, role) VALUES (:name, :password, :email, :role)");

            // Use prepared statements with bindParam to prevent SQL injection
            $addUser->bindParam(':name', $username);
            $addUser->bindParam(':password', $password);
            $addUser->bindParam(':email', $email);
            $addUser->bindParam(':role', $role);

            // Execute the query to add the user
            $addUser->execute();

            // Redirect the admin to the list of users after the user is successfully added
            echo '<script>window.location.href = "listUser.php";</script>';
        }
    } else {
        // If the user is not an admin, display a 'page not found' message
        echo '<h1>Page not found !!</h1>';
    }
?>
