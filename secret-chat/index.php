<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Redirect logged-in users to the dashboard
    header('Location: dashboard.php');
} else {
    // Redirect non-logged-in users to the login page
    header('Location: login.php');
}
exit;
?>
