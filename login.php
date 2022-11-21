<?php include('./inc/header.php'); ?>

<?php
// Set vars to empty values
$username = $password = '';
$usernameErr = $passwordErr = $loginErr =  '';
$user = '';
$auth = 0;

// Form submit
if (isset($_POST['submit'])) {
    // Validate username
    if (empty($_POST['username'])) {
        $usernameErr = 'Username is required';
    } else {
        $username = filter_input(
            INPUT_POST,
            'username',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }

    // Validate password
    if (empty($_POST['password'])) {
        $passwordErr = 'Password is required';
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        // Hash password
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //  Find user in DB
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            $auth = password_verify($_POST['password'], $user["password"]);
        }

        if ($result) {
            // query success
            if ($user && $auth) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
            } else {
                $loginErr = "Username or password is incorrect. Don't have an account? <a href='./register.php'>Register</a>";
            }
        } else {
            // query error
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
?>

<form method="POST" action="<?php echo htmlspecialchars(
                                $_SERVER['PHP_SELF']
                            ); ?>">
    <label for="username">Username</label>
    <input type="text" name="username" value="<?php echo $username ?>">
    <?php echo $usernameErr ? "<p>${usernameErr}</p>" : ''; ?>
    <?php echo isset($_POST['submit']) && !$user || !$auth ? $loginErr : ''; ?>
    <label for="password">Password</label>
    <input type="password" name="password" value="<?php echo $password ?>">
    <?php echo $passwordErr ? "<p>${passwordErr}</p>" : ''; ?>
    <button type="submit" name="submit">Login</button>
</form>

<?php include('./inc/footer.php'); ?>