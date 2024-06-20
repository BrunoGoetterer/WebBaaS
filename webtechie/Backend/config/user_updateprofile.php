<?php

function getValueOrDefault($name, $currentUser)
{
    if (isset($_POST[$name]) && !empty($_POST[$name])) {
        return $_POST[$name];
    }

    if (isset($currentUser[$name]) && !empty($currentUser[$name])) {
        return $currentUser[$name];
    }

    return "";
}

session_start();

if (!isset($_SESSION['currentUser'])) {
    header("Location: ../login.php");
    exit();
}

$currentUser = $_SESSION['currentUser'];

require_once("dbaccess.php");

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

$userID = $currentUser['id'];
$useremail = getValueOrDefault('useremail', $currentUser);
$firstname = getValueOrDefault('firstname', $currentUser);
$lastname = getValueOrDefault('lastname', $currentUser);
$anrede = getValueOrDefault('anrede', $currentUser);

$update = "UPDATE users SET useremail=?, anrede=?, firstname=?, lastname=? WHERE id=?";
$stmt = $connection->prepare($update);

$stmt->bind_param("ssssi", $useremail, $anrede, $firstname, $lastname, $userID);

if ($stmt->execute()) {
    $_SESSION['currentUser'] = [
        "id" => $userID,
        "username" => $currentUser["username"],
        "password" => $currentUser["password"],
        "useremail" => $useremail,
        "anrede" => $anrede,
        "firstname" => $firstname,
        "lastname" => $lastname,
        "role" => $currentUser["role"]
    ];

    $_SESSION['status'] = 'success';
    $_SESSION['message'] = 'User updated successfully!';

    header("Location: ../profile.php");
    exit();
} else {
    $_SESSION['status'] = 'error';
    $_SESSION['message'] = 'An error occurred trying to update the user! Please try again or contact support.';

    header("Location: ../profile.php");
    exit();
}
