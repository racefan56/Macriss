<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'Dick');
define('DB_PASS', '123456');
define('DB_NAME', 'macriss');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die('Connection Failed ' . $conn->connect_error);
}
