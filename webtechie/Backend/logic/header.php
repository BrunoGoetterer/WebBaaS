<?php
// Startet die Sitzung, wenn sie noch nicht gestartet ist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../CSS/navbar.css"> <!-- Einbindung der CSS-Datei für die Navigationsleiste -->
</head>

<body>
    <nav class="navbar navbar-custom navbar-expand-lg navbar-dark shadow-5-strong navbar fixed-top">
        <div class="container-fluid p-1 m-1">
            <a class="navbar-brand" href="../../Frontend/sites/index.php">
                <img src="../../Frontend/Bilder/123.png" alt="BaaS" width="50" height="65" class="d-inline-block">
                BaaS <!-- Branding der Website -->
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="../../Frontend/sites/help.php">
                            <img src="../../Frontend/Bilder/faq.svg" style="padding 5px; width:30px; height:30px;"> FAQs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../../Frontend/sites/impressum.php">
                            <img src="../../Frontend/Bilder/people.svg" style="padding 5px; width:30px; height:30px;"> Impressum
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../../Frontend/sites/product.php">
                            <img src="../../Frontend/Bilder/box.svg" style="padding 5px; width:30px; height:30px;"> Products
                        </a>
                    </li>

                    <!-- Überprüft, ob ein Benutzer eingeloggt ist -->
                    <?php if (isset($_SESSION['currentUser'])) : ?>
                        <!-- Überprüft, ob der eingeloggt Benutzer ein Administrator ist -->
                        <?php if ($_SESSION['currentUser']['role'] === 1) : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="../../Frontend/sites/productupload.php">
                                    <img src="../../Frontend/Bilder/box-arrow-up.svg" style="padding 5px; width:30px; height:30px;"> Product Upload
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="../../Frontend/sites/Voucher.php">
                                    <img src="../../Frontend/Bilder/envelope-paper-heart.svg" style="padding 5px; width:30px; height:30px;"> Manage Vouchers
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link active" href="../../Backend/logic/logout.php">
                                <img src="../../Frontend/Bilder/box-arrow-right.svg" style="padding 5px; width:30px; height:30px;"> Logout
                            </a>
                        </li>
                    <?php else : ?>
                        <!-- Dropdown-Menü für Registrierung und Login, wenn kein Benutzer eingeloggt ist -->
                        <li class="nav-item dropdown navbar-nav ms-auto">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registration/Login
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../../Frontend/sites/registration.php">Registration</a></li>
                                <li><a class="dropdown-item" href="../../Frontend/sites/login.php">Login</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- Anzeige des Profil-Links, wenn ein Benutzer eingeloggt ist -->
                <?php if (isset($_SESSION['currentUser'])) : ?>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="../../Frontend/sites/profile.php">
                                <img src="../../Frontend/Bilder/person-circle.svg" style="padding 5px; width:30px; height:30px;"> Profile
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>

                <!-- Anzeige des Benutzerverwaltungs-Links, wenn ein Administrator eingeloggt ist -->
                <?php if (isset($_SESSION['currentUser']) && $_SESSION['currentUser']['role'] === 1) : ?>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="../../Frontend/sites/user_management.php">
                                <img src="../../Frontend/Bilder/person-gear.svg" style="padding 5px; width:30px; height:30px;"> User Management
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>

                <!-- Suchformular in der Navigationsleiste -->
                <form class="form-floating" role="search">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search" id="floatingSearch" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</body>

</html>
