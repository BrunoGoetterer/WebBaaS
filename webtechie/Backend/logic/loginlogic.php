<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Include the database access configuration
require_once("../../Backend/config/dbaccess.php");

// Get the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Create a new MySQLi connection
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection to the database is successful
if ($connection->connect_error) {
    // Set an error message in the session and redirect to the login page
    $_SESSION["error"] = "Connection failed: " . $connection->connect_error;
    header("Location: ../../Frontend/sites/login.php");
    exit;
}

// Prepare the SQL query to select the user with the given username
$select = "SELECT * FROM users WHERE username = ?";
$stmt = $connection->prepare($select);

// Bind the parameter to the prepared statement
$stmt->bind_param("s", $username);

// Execute the statement and check if it was successful
if ($stmt->execute()) {
    $userResult = $stmt->get_result();

    // Check if a user with the given username was found
    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();

        // Verify the password
        if (password_verify($password, $userRow['password'])) {
            // Check if the account is deactivated
            if ($userRow['accountstatus'] == '0') {
                // Set an error message in the session and redirect to the login page
                $_SESSION["error"] = "Your account has been temporarily deactivated. Please contact support.";
                header("Location: ../../Frontend/sites/login.php");
                exit;
            }

            // Save the user data in the session and redirect to the home page
            $_SESSION["currentUser"] = $userRow;
            header("Location: ../../Frontend/sites/index.php");
        } else {
            // Set an error message in the session and redirect to the login page
            $_SESSION["error"] = "Invalid username or password";
            header("Location: ../../Frontend/sites/login.php");
        }
    } else {
        // Set an error message in the session and redirect to the login page
        $_SESSION["error"] = "Invalid username or password";
        header("Location: ../../Frontend/sites/login.php");
    }
} else {
    // Set an error message in the session and redirect to the login page
    $_SESSION["error"] = "Unable to complete the request.";
    header("Location: ../../Frontend/sites/login.php");
}

// Close the statement and the connection
$stmt->close();
$connection->close();
