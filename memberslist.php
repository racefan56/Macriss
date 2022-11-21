<?php include('./inc/header.php');

$sql = "SELECT username, user_role, post_count, registered_date FROM users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="members-container">
    <table class="table">
        <thead>
            <tr>
                <td>Avatar</td>
                <td>Username</td>
                <td>Joined</td>
                <td>Post Count</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><img class="avatar" src="./img/blaziken.png" alt="blaziken"></td>
                    <td>
                        <p class="username"> <?php echo $user['username']; ?> </p>
                        <p><?php echo $user['user_role']; ?></p>
                    </td>
                    <td><?php echo $user['registered_date']; ?></td>
                    <td><?php echo $user['post_count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php include('./inc/footer.php'); ?>