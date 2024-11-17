<?php
session_start();
include('config.php');

// Function to get the real IP address
function getUserIP() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $ip_address = getUserIP(); // Fetch the real IP address

    $sql = "INSERT INTO messages (user_id, message, ip_address) VALUES ('$user_id', '$message', '$ip_address')";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Message</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="message-container">
        <div class="message-header">
            <h1>Post Your Message</h1>
            <img src="https://cdn-icons-png.flaticon.com/512/5356/5356190.png" alt="Message Icon">
        </div>
        <form method="POST" action="post_message.php" class="message-form">
            <textarea name="message" placeholder="Write your message here..." required></textarea>
            <button type="submit">Post Message</button>
        </form>
    </div>
</body>
</html>


