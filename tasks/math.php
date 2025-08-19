<?php
include '../includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

a = rand(1, 20);
b = rand(1, 20);
answer = a + b;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['solution'] == $_POST['answer']) {
        $reward = 0.50;
        $conn->query("UPDATE users SET balance = balance + $reward WHERE id = $user_id");
        $conn->query("INSERT INTO tasks (user_id, task_type, status, reward) VALUES ($user_id, 'math', 'completed', $reward)");
        echo "Correct! You've earned $$reward.";
    } else {
        echo "Incorrect. Try again!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Math Task</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h3>Solve: <?php echo "$a + $b = ?"; ?></h3>
<form method="POST">
    <input type="number" name="solution" placeholder="Your answer" required />
    <input type="hidden" name="answer" value="<?php echo $answer; ?>" />
    <button type="submit">Submit</button>
</form>
<a href="../dashboard.php">Back to dashboard</a>
</body>
</html>
