<?php
require 'header.php';
?>
<main>

    <form action="login.php" method="POST">
        <label>Email</label> <input type="email" name="email" />
        <label>Password</label> <input type="password" name="password" />
        <label> No account? <a href="register.php"> register?</a> </label>
        <input type="submit" name="submit" value="Submit" />

    </form>

</main>
<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Check if the user exists and is of the correct role
    $query = $join->prepare("SELECT * FROM users WHERE email = :email");
    $criteria = ['email' => $email];
    $query->execute($criteria);
    // Get the number of rows returned
    $count = $query->rowCount();
    // If the user exists
    if ($count > 0) {
        $user = $query->fetch();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Authentication successful
            $_SESSION['loggedin'] = $user['name'];
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['role'] = $user['role']; // Set role based on userRole
            echo '<script>window.location.href="index.php"</script>';
            die();
        } 
        else {
            echo 'Sorry, the password is incorrect';
        }
    } else {
        echo 'Sorry, this account does not exist';
    }
}

require 'footer.php';
?>