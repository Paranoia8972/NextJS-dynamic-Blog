<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// connect to database
$conn = mysqli_connect("192.168.178.67", "root", "root", "blog");

if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

// define global constants
if (!defined("ROOT_PATH")) {
    define("ROOT_PATH", realpath(dirname(__FILE__)));
}
if (!defined("BASE_URL")) {
    define("BASE_URL", "http://192.168.178.187");
}
// echo SITE_NAME

define("SITE_NAME", "Encryptopia Blog");
?>
