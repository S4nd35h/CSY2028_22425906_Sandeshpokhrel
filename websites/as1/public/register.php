<?php
require 'header.php';
?>
<!-- this is the register page -->
<main>
    <form action="register.php" method="post">
        <label>Name</label> <input type="text" name="name" />
        <label>Email</label> <input type="email" name="email" />
        <label>Password</label> <input type="password" name="password" />
        <input type="hidden" name="role" value="user" />
        <input type="submit" name="submit" value="Submit" />
        <label> Have a account? <a href="login.php"> Login?</a> </label>
    </form>
</main>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userRole = $_POST['role'];

    $checkQuery = $join->prepare("SELECT * FROM users WHERE email = :email");
    // Bind the parameter
    $checkQuery->bindParam(':email', $email);
    $checkQuery->execute();

    if ($checkQuery->rowCount() > 0) {
        // Email is already taken, display an error message or handle it as needed
        echo '<script>alert("Email is already taken. Please choose another email.")</script>';
    } else {
        // Email is available, add the user to the database
        $password = password_hash($password, PASSWORD_DEFAULT);
        //password is hashed before it is stored in the database
        $query = $join->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        $criteria = ['name' => $name, 'email' => $email, 'password' => $password, 'role' => $userRole];
        // Bind the parameters
        $query->execute($criteria);
        //redirect the user to the login page
        echo '<script>window.location.href="login.php"</script>';
        die();
    }
}
require 'footer.php';
?>