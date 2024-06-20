<?php
// Funktion zum Anzeigen einer Alert-Nachricht basierend auf dem Sitzungsstatus
function displayAlert() {
    // Überprüfen, ob ein Status in der Sitzung gesetzt ist
    if (isset($_SESSION['status'])) {
        $status = $_SESSION['status']; // Den Status aus der Sitzung abrufen
        $message = $_SESSION['message']; // Die Nachricht aus der Sitzung abrufen

        // Überprüfen, ob der Status 'error' ist und eine entsprechende Alert-Nachricht anzeigen
        if ($status === 'error') {
            echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($message) . '</div>';
        // Überprüfen, ob der Status 'success' ist und eine entsprechende Alert-Nachricht anzeigen
        } elseif ($status === 'success') {
            echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($message) . '</div>';
        }

        // Entfernen des Status und der Nachricht aus der Sitzung
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    }
}
?>
