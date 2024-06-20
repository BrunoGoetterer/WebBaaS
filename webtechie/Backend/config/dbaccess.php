<?php
// Datenbankzugangsdaten
$dbUsername = "webtechie1"; // Benutzername für die Datenbankverbindung
$dbPassword = "admin1";     // Passwort für die Datenbankverbindung
$dbHost = "localhost";      // Hostname des Datenbankservers
$dbName = "webtechie";      // Name der Datenbank

// Erstellen einer neuen MySQLi-Verbindung
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Überprüfen, ob die Verbindung zur Datenbank erfolgreich ist
if ($connection->connect_error) {
    // Verbindung fehlgeschlagen, Skript beenden und Fehlermeldung ausgeben
    die("Connection failed: " . $connection->connect_error);
}
