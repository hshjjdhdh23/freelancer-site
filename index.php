<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Freelancer Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to the Freelancer Site!</h1>
    <a href="login.php">Login</a> or <a href="register.php">Register</a>
</body>
</html>
