<?php
// Startet die Sitzung
session_start();

// Überprüft, ob der aktuelle Benutzer in der Sitzung gesetzt ist
if (!isset($_SESSION['currentUser'])) {
    // Wenn kein Benutzer in der Sitzung gesetzt ist, wird zur Login-Seite weitergeleitet
    header("Location: ../login.php");
    exit();
}

// Holt den aktuellen Benutzer aus der Sitzung
$currentUser = $_SESSION['currentUser'];

// Einbinden der Datenbankzugangsdaten
require_once("../../Backend/config/dbaccess.php");

// Erstellen einer neuen MySQLi-Verbindung
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Überprüfen, ob die Verbindung erfolgreich ist
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Holt die übermittelten Daten aus dem POST-Array
$bookingID = $_POST['bookingID'];
$title = $_POST['title'];
$price = $_POST['price'];
$created_at = $_POST['created_at'];

// SQL-Abfrage zum Aktualisieren der Buchung
$update = "UPDATE bookings SET title=?, price=?, created_at=? WHERE id=?";
$stmt = $connection->prepare($update);

// Bindet die Parameter an das vorbereitete Statement
$stmt->bind_param("sdsi", $title, $price, $created_at, $bookingID);

// Führt das Statement aus und überprüft, ob es erfolgreich war
if ($stmt->execute()) {
    // Setzt eine Erfolgsnachricht in der Sitzung
    $_SESSION['status'] = 'success';
    $_SESSION['message'] = 'Order updated successfully!';

    // Weiterleitung zur Benutzerverwaltungsseite
    header("Location: ../../Frontend/sites/user_management.php");
} else {
    // Setzt eine Fehlermeldung in der Sitzung
    $_SESSION['status'] = 'error';
    $_SESSION['message'] = 'An error occurred trying to update the order! Please try again or contact support.';

    // Weiterleitung zur Benutzerverwaltungsseite
    header("Location: ../../Frontend/sites/user_management.php");
}

// Schließt das Statement und die Verbindung
$stmt->close();
$connection->close();
?>
