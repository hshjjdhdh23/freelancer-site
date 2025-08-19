<?php
include '../includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$emojis = [
    ["emoji" => "🍎", "color" => "red"],
    ["emoji" => "🍋", "color" => "yellow"],
    ["emoji" => "🥦", "color" => "green"],
    ["emoji" => "🍆", "color" => "purple"],
];
$chosen = $emojis[array_rand($emojis)];
$answer = $chosen['color'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (strtolower($_POST['solution']) == $answer) {
        $reward = 0.30;
        $conn->query("UPDATE users SET balance = balance + $reward WHERE id = $user_id");
        $conn->query("INSERT INTO tasks (user_id, task_type, status, reward) VALUES ($user_id, 'emoji', 'completed', $reward)");
        echo "Correct! You've earned $$reward.";
    } else {
        echo "Incorrect. Try again!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Emoji Task</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h3>Guess the color of this emoji: <?php echo $chosen['emoji']; ?></h3>
<form method="POST">
    <input type="text" name="solution" placeholder="Color" required />
    <input type="hidden" name="answer" value="<?php echo $answer; ?>" />
    <button type="submit">Submit</button>
</form>
<a href="../dashboard.php">Back to dashboard</a>
</body>
</html>
