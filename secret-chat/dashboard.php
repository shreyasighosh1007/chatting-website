<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

echo "Welcome to Your Dashboard, $username<br><br>";

$sql = "SELECT m.message, m.timestamp, m.ip_address, u.username 
        FROM messages m
        JOIN users u ON m.user_id = u.user_id 
        ORDER BY m.timestamp DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<strong>{$row['username']}</strong>: {$row['message']} ({$row['timestamp']}, IP: {$row['ip_address']})<br>";
    }
} else {
    echo "No messages found.";
}

echo '<br><a href="logout.php">Logout</a>';
?>
