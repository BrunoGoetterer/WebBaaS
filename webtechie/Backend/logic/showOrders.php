<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['currentUser'])) {
    header("Location: ../../Frontend/sites/login.php");
    exit();
}

$currentUser = $_SESSION['currentUser'];

// Include your database connection file
require_once("../../Backend/config/dbaccess.php");

// Create a new mysqli object which will be used to interact with the database
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch the current user's bookings
$query = "SELECT * FROM bookings WHERE userID = " . $currentUser['id'];
$result_bookings = $connection->query($query);

// Close the database connection at the end
function closeConnection($connection) {
    $connection->close();
}
?>
