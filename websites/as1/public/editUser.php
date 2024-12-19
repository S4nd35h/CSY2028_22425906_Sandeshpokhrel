<?php
include 'header.php';
//only logged in users can edit users and only if they are admin, if they are not admin
//they will see the message page not found
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
    $user = $join->query('SELECT * FROM users where user_id = ' . $_GET['id']);
    $user = $user->fetch();
?>
    <main>
        <form action="" method="post">
            <label>Username</label> <input type="text" name="name" value="<?php echo $user['name'] ?>" />
            <label>password</label> <input type="text" name="password" value="<?php echo $user['password'] ?>" />
            <label>email</label> <input type="text" name="email" value="<?php echo $user['email'] ?>" />
            <label>role</label> <select name="role">
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
    if (isset($_POST['submit'])) {
        $username = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        //password is hashed before it is stored in the database
        $addUser = $join->prepare("UPDATE users SET name = :name, password = :password, email = :email, role = :role WHERE user_id = :id");
        $addUser->bindParam(':name', $username);
        $addUser->bindParam(':password', $password);
        $addUser->bindParam(':email', $email);
        $addUser->bindParam(':role', $role);
        $addUser->bindParam(':id', $_GET['id']);
        $addUser->execute();
        //redirect the user to the listUser page
        echo '<script>window.location.href = "listUser.php";</script>';
    }
}  else {
    //if the user is not an admin, display page not found0
    echo '<h1>page not found !!</h1>';
}
