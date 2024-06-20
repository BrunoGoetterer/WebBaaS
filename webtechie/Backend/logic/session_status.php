<?php
// Check if a session is not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if there is a current user stored in the session
if (isset($_SESSION["currentUser"])) {
    $currentUser = $_SESSION["currentUser"];
}

// Check for session status messages
function displaySessionStatus() {
    if (isset($_SESSION['status'])) {
        $status = $_SESSION['status'];
        if ($status === 'error') {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['message'] . '</div>';
        }
        if ($status === 'success') {
            echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
        }
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    }
}
?>
