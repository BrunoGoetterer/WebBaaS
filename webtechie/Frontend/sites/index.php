<!--
    Diese Seite ist die Startseite der Anwendung "Bricks as a Service". Sie lädt Bootstrap für das Styling, 
    enthält benutzerdefinierte CSS-Dateien und bindet PHP-Skripte ein, um die Kopfzeile und die Profil-Logik zu laden. 
    Wenn ein Benutzer eingeloggt ist, wird eine Begrüßungsnachricht angezeigt.
-->


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../../Frontend/Bilder/123.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bricks as a Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../../Frontend/CSS/index.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/index.css">
</head>

<body>

    <?php include "../../Backend/logic/header.php"; ?>
    <?php include "../../Backend/logic/profile_logic.php"; ?>


    <div class="images">
        <div class="photo">
            <img src="../../Frontend/Bilder/welcomeLego.png" alt="photo" />
        </div>
    </div>
    <?php
    // Check if currentUser is set.
    if (isset($currentUser)) {
    ?>
        <div class="container" id="hello">
            Hello, <?= $currentUser["username"] ?>!
        </div>
    <?php } ?>



</body>

</html>