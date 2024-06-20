<?php
require_once("../config/dbaccess.php");

// Erstellen einer neuen MySQLi-Verbindung mit den in dbaccess.php definierten Zugangsdaten
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Abrufen der übermittelten Daten aus dem POST-Array
$tags = $_POST['tags'];
$title = $_POST['title'];
$price = $_POST['price'];
$imagePath = '';

// Sitzung starten
session_start();

/*
 * Überprüfen, ob eine Datei hochgeladen wurde und ob beim Hochladen kein Fehler aufgetreten ist.
 * Falls eine Datei hochgeladen wurde, wird diese in das entsprechende Verzeichnis verschoben.
 */
if (isset($_FILES["image"]) && $_FILES['image']['error'] == 0) {
    $image = $_FILES["image"]["name"];
    $uploadDir = "../uploads/products";
    $imagePathBase = "uploads/products";
    $imagePath = $imagePathBase . "/" . $image;
    $imageStoragePath = $uploadDir . "/" . $image;

    // Falls das Verzeichnis nicht existiert, wird es erstellt
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Verschieben der hochgeladenen Datei in das Zielverzeichnis
    move_uploaded_file($_FILES["image"]["tmp_name"], $imageStoragePath);
}

// SQL-Abfrage zum Einfügen der Daten in die Tabelle 'products'
$insert = "INSERT INTO products (tags, title, price, image) VALUES (?,?,?,?)";

$stmt = $connection->prepare($insert); // Vorbereiten des Statements

// Binden der Parameter an das vorbereitete Statement
$stmt->bind_param("ssds", $tags, $title, $price, $imagePath);

/*
 * Überprüfen, ob die Ausführung des vorbereiteten Statements erfolgreich war.
 * Setzen einer Erfolgs- oder Fehlermeldung in die Sitzung und Weiterleiten zur Produkt-Upload-Seite.
 */
if ($stmt->execute()) {
    $_SESSION['status'] = "success";
    $_SESSION["message"] = "Product uploaded successfully!";
    // Weiterleitung zur Produkt-Upload-Seite mit einer Erfolgsmeldung
    header("Location: ../../Frontend/sites/productupload.php");
} else {
    $_SESSION['status'] = "error";
    $_SESSION["message"] = "An error occurred while uploading the product! Please try again.";
    // Bei Fehler Weiterleitung zur Produkt-Upload-Seite mit einer Fehlermeldung
    header("Location: ../../Frontend/sites/productupload.php");
}

$stmt->close(); // Schließen des Statements
$connection->close(); // Schließen der Verbindung
?>
