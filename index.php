<?php include('./inc/header.php');


$sql = 'SELECT forumGroupName FROM forums GROUP BY forumGroupName';
$result = mysqli_query($conn, $sql);
$forumGroups = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Loop over the list of forumGroups, and place their associated forums within them -->
<?php foreach ($forumGroups as $i => $group) : ?>
    <?php
    $curGroupName = $group['forumGroupName'];
    $sql = "SELECT * FROM forums WHERE forumGroupName='$curGroupName'";
    $result = mysqli_query($conn, $sql);
    $forums = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?> <div class="forum-group">
        <h2 class="forum-group-heading"> <?php echo $group['forumGroupName']; ?> </h2>
        <table>
            <thead>
                <tr>
                    <td>Forum</td>
                    <td>Threads</td>
                    <td>Posts</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forums as $i => $forum) : ?>
                    <tr>
                        <td class="forum">
                            <a href="./viewForum.php?forumID=<?php echo $forum['forumID']; ?>" class="forum-name"><?php echo $forum['forumName']; ?></a>
                            <span class="forum-description"><?php echo $forum['description']; ?></span>
                        </td>
                        <td><?php echo $forum['thread_count']; ?></td>
                        <td><?php echo $forum['post_count']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endforeach; ?>
<?php include('./inc/footer.php'); ?>