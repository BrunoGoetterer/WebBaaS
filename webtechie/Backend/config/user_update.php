<?php
session_start();

if (!isset($_SESSION['currentUser'])) {
    header("Location: ../login.php");
    exit();
}

$currentUser = $_SESSION['currentUser'];

require_once("../../Backend/config/dbaccess.php");

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Get the submitted data
$userID = $_POST['userID'];
$username = $_POST['username'];
$password = $_POST['password'];
$useremail = $_POST['useremail'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$anrede = $_POST['anrede'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$role = $_POST['role'];
$accountstatus = $_POST['accountstatus'];

// SQL query to update the user
$update = "UPDATE users SET username=?, password=?, useremail=?, address=?, city=?, state=?, zip=?, anrede=?, firstname=?, lastname=?, role=?, accountstatus=? WHERE id=?";
$stmt = $connection->prepare($update);

// Bind parameters
$stmt->bind_param("ssssssssssiii", $username, $password, $useremail, $address, $city, $state, $zip, $anrede, $firstname, $lastname, $role, $accountstatus, $userID);

if ($stmt->execute()) {
    // Set success message in session
    $_SESSION['status'] = 'success';
    $_SESSION['message'] = 'User updated successfully!';

    // Redirect back to the user management page
    header("Location: ../../Frontend/sites/user_management.php");
} else {
    // If an error exists, set error message in session
    $_SESSION['status'] = 'error';
    $_SESSION['message'] = 'An error occurred trying to update the user! Please try again or contact support.';

    // Redirect back to the user management page
    header("Location: ../../Frontend/sites/user_management.php");
}
?>
