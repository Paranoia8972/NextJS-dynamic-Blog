<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// connect to database
$conn = mysqli_connect("IP", "user", "password", "database");

if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

// define global constants
if (!defined("ROOT_PATH")) {
    define("ROOT_PATH", realpath(dirname(__FILE__)));
}
if (!defined("BASE_URL")) {
    define("BASE_URL", "https://blog.encryptopia.dev");
}
// echo SITE_NAME

define("SITE_NAME", "Encryptopia Blog");
