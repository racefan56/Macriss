<?php
session_start();
include('config/database.php');

date_default_timezone_set('America/Chicago');
$today = date("F j, Y, g:i a");
$username = $_SESSION['username'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Macriss Online</title>
    <script src="./script.js"></script>
</head>

<body>
    <nav>
        <div>
            <a class="brand" href="./index.php">Macriss Online</a>
        </div>
        <div class="links">
            <a href="./index.php" class="nav-link">Home</a>
            <a href="./memberslist.php" class="nav-link">Member List</a>
        </div>
    </nav>
    <div class="container">
        <div class="forums-header">

            <span>Hello There, <?php echo $username ?>! ( <?php echo $username === 'Guest' ? '<a href="./login.php">Login</a> — <a href="./register.php">Register</a>' :  '<a href="./logout.php">Logout</a>'; ?> )</span>
            <div><span class="current-time">Current Time: </span> <?php echo $today; ?></div>
        </div>