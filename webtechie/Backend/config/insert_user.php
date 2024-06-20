<?php
session_start();

require_once("../config/dbaccess.php");

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $anrede = $_POST['anrede'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    // Validate that passwords match
    if ($password1 !== $password2) {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Passwords do not match!';
        header("Location: ../../Frontend/sites/registration.php");
        exit();
    }

    // Check if the username is already in use
    $usernameCheck = $connection->prepare("SELECT id FROM users WHERE username = ?");
    $usernameCheck->bind_param("s", $username);
    $usernameCheck->execute();
    $usernameCheck->store_result();

    if ($usernameCheck->num_rows > 0) {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Username is already taken!';
        header("Location: ../../Frontend/sites/registration.php");
        exit();
    }
    $usernameCheck->close();

    // Check if the email is already in use
    $emailCheck = $connection->prepare("SELECT id FROM users WHERE useremail = ?");
    $emailCheck->bind_param("s", $useremail);
    $emailCheck->execute();
    $emailCheck->store_result();

    if ($emailCheck->num_rows > 0) {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Email is already registered!';
        header("Location: ../../Frontend/sites/registration.php");
        exit();
    }
    $emailCheck->close();

    // Hash the password
    $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

    // SQL query to insert the new user
    $insert = "INSERT INTO users (username, useremail, firstname, lastname, anrede, password, address, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($insert);

    // Bind parameters
    $stmt->bind_param("ssssssssss", $username, $useremail, $firstname, $lastname, $anrede, $hashedPassword, $address, $city, $state, $zip);

    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'User registered successfully!';
    } else {
        // Set error message in session
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'An error occurred trying to register the user! Please try again or contact support.';
    }
    $stmt->close();
    header("Location: ../../Frontend/sites/registration.php");
    exit();
}
