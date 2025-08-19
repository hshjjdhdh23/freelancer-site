<?php
// Secure database connection with error handling
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "freelancer_site";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Database error.");
}
?>