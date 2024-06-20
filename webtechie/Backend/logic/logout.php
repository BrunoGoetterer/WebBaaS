<?php
// Startet die Sitzung
session_start();

// Entfernt die aktuelle Benutzer-Session
unset($_SESSION['currentUser']);

// Zerstört die aktuelle Sitzung
session_destroy();

// Weiterleiten zur Login-Seite
header("Location: ../../Frontend/sites/login.php");
exit;
?>
