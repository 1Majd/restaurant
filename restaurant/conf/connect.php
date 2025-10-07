<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/rstourant/');
}

if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}

if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'rstourant');
}

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));