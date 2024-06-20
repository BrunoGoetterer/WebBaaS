<?php
session_start();

if (!isset($_SESSION['currentUser'])) {
    header("Location: ../login.php");
    exit();
}

$currentUser = $_SESSION['currentUser'];

require_once("dbaccess.php");

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get the submitted data
$title = $_POST['title'];
$price = $_POST['price'];
$created_at = $_POST['created_at'];
$userID = $currentUser['id'];

// SQL query to insert data into the 'bookings' table
$insert = "INSERT INTO bookings (userID, price, title, created_at) VALUES (?, ?, ?, ?)";
$stmt = $connection->prepare($insert);

if (!$stmt) {
    die("Prepare statement failed: " . $connection->error);
}

// Bind parameters
$stmt->bind_param("idss", $userID, $price, $title, $created_at);

if ($stmt->execute()) {
    // Check if execution of prepared statement was successful 
    $_SESSION['status'] = 'success';
    $_SESSION['message'] = 'Order was submitted successfully!';
    header("Location: ../bestellung.php");
} else {
    // If an error exists, set error message in session
    $_SESSION['status'] = 'error';
    $_SESSION['message'] = 'An error occurred trying to submit the order! Please try again or contact support.';
    header("Location: ../bestellung.php");
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>
