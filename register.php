<?php include('./inc/header.php'); ?>

<?php
// Set vars to empty values
$username = $password = $passwordConfirm = $email = '';
$usernameErr = $passwordErr = $emailErr = $passwordMatchErr = '';
$user = '';

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
    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        $email = filter_input(
            INPUT_POST,
            'email',
            FILTER_SANITIZE_EMAIL
        );
    }
    // Validate password & passwordConfirm match
    if ($_POST['password'] !== $_POST['passwordConfirm']) {
        $passwordMatchErr = 'Passwords do not match';
    }

    // Validate password
    if (empty($_POST['password'])) {
        $passwordErr = 'Password is required';
    }

    // Validate passwordConfirm
    if (empty($_POST['passwordConfirm'])) {
        $passwordErr = 'Password is required';
    }



    if (empty($usernameErr) && empty($passwordErr) && empty($emailErr) && empty($passwordMatchErr)) {
        // Hash password
        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        //  Add user to DB
        $sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $passwordHash, $email);
        $stmt->execute();
        $stmt->close();

        // query success, log user in
        $_SESSION['username'] = $username;
        header('Location: index.php');
    }
}
?>

<form method="POST" action="<?php echo htmlspecialchars(
                                $_SERVER['PHP_SELF']
                            ); ?>">
    <label for="username">Username</label>
    <input type="text" name="username" value="<?php echo $username ?>">
    <?php echo $usernameErr ? "<p>${usernameErr}</p>" : ''; ?>
    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo $email ?>">
    <?php echo $emailErr ? "<p>${emailErr}</p>" : ''; ?>
    <label for="password">Password</label>
    <input type="password" name="password" value="<?php echo $password ?>">
    <?php echo $passwordErr ? "<p>${passwordErr}</p>" : ''; ?>
    <label for="passwordConfirm">Password Confirm</label>
    <input type="password" name="passwordConfirm" value="<?php echo $passwordConfirm ?>">
    <?php echo $passwordErr ? "<p>${passwordErr}</p>" : ''; ?>
    <?php echo $passwordMatchErr ? "<p>${passwordMatchErr}</p>" : ''; ?>
    <button type="submit" name="submit">Register</button>
</form>

<?php include('./inc/footer.php'); ?>