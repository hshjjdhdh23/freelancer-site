<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, balance FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $balance);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>
<p>Balance: $<?php echo number_format($balance, 2); ?></p>
<a href="tasks/math.php">Solve Math Problem</a><br>
<a href="tasks/emoji.php">Guess Emoji Color</a><br>
<a href="logout.php">Logout</a>
</body>
</html>
