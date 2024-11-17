<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch messages from the database
$sql = "SELECT m.message, m.timestamp, m.ip_address, u.username 
        FROM messages m
        JOIN users u ON m.user_id = u.user_id 
        ORDER BY m.timestamp DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<strong>{$row['username']}</strong>: {$row['message']} 
              <br><small>Posted on {$row['timestamp']} | IP: {$row['ip_address']}</small><hr>";
    }
} else {
    echo "No messages to display.";
}
?>

