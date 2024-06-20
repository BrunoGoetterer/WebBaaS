<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
$currentUser = isset($_SESSION['currentUser']) ? $_SESSION['currentUser'] : null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../Backend/config/user_updateprofile.php';

    // Redirect to profile page after update logic
    header('Location: ../../Frontend/sites/profile.php');
    exit;
}

// Fetch the current status and message from the session
$status = isset($_SESSION['status']) ? $_SESSION['status'] : null;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;

// Unset the status and message session variables
unset($_SESSION['status'], $_SESSION['message']);
?>
