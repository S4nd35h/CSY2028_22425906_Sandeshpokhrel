<?php
include 'header.php';
?>
<main>
    <!-- checks if the user logged in is an admin and displays the form to add a user -->
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') { ?>
        <!-- Form to add a user and only the admin will be able to add the user. -->
        <form action="addUser.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="name" id="username" required />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required />
            <label for="role">Role</label>
            <select name="role" id="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Add User" />
        </form>
</main>
<?php
        if (isset($_POST['submit'])) {
            $username = $_POST['name'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            //using password_hash to hash the password to make it more secure
            $addUser = $join->prepare("INSERT INTO users (name, password, email, role) VALUES (:name, :password, :email, :role)");
            //using prepared statements to prevent sql injection
            $addUser->bindParam(':name', $username);
            $addUser->bindParam(':password', $password);
            $addUser->bindParam(':email', $email);
            $addUser->bindParam(':role', $role);
            $addUser->execute();
            //redirect the user to listUser.php
            echo '<script>window.location.href = "listUser.php";</script>';
        }
    } else {
        //if the user is not an admin, display page not found0
        echo '<h1>page not found !!</h1>';
    }
