<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" type="text/css" href="../CSS/bestellungen.css">
    <!-- Inline-Styles -->
    <style>
        .booking-container {
            margin-top: 50px;
        }
        .booking-header {
            margin-bottom: 20px;
        }
        .booking-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- PHP-Skripte zum Einbinden der Kopfzeile und Buchungslogik -->
<?php
include "../../Backend/logic/header.php";
include "../../Backend/logic/showOrders.php"; // Include the showOrders.php file
?>

<!-- Hauptcontainer für die Buchungsanzeige -->
<div class="container booking-container">
    <?php if (isset($currentUser)): ?>
        <div class="container booking-header">
            <h2>Welcome to your bookings, <?= htmlspecialchars($currentUser["username"]) ?>!</h2>
        </div>
    <?php endif; ?>

    <!-- Akkordeon zur Anzeige der Buchungen -->
    <div class="accordion accordion-flush" id="bookingAccordion">
        <?php if ($result_bookings->num_rows > 0): 
            $bookingCount = 1;
            while ($row_booking = $result_bookings->fetch_assoc()): ?>
                <div class="accordion-item booking-card">
                    <h2 class="accordion-header" id="heading<?= $bookingCount ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $bookingCount ?>" aria-expanded="false" aria-controls="collapse<?= $bookingCount ?>">
                            Order <?= $bookingCount ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $bookingCount ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $bookingCount ?>" data-bs-parent="#bookingAccordion">
                        <div class="accordion-body collapse-content">
                            <form>
                                <input type='hidden' name='bookingID' value='<?= htmlspecialchars($row_booking["id"]) ?>' disabled>
                                <div class="mb-3">
                                    <label for='title<?= $bookingCount ?>' class="form-label">Title:</label>
                                    <input type='text' class="form-control" id='title<?= $bookingCount ?>' name='title' value='<?= htmlspecialchars($row_booking["title"]) ?>' disabled>
                                </div>
                                <div class="mb-3">
                                    <label for='price<?= $bookingCount ?>' class="form-label">Price:</label>
                                    <input type='text' class="form-control" id='price<?= $bookingCount ?>' name='price' value='<?= htmlspecialchars($row_booking["price"]) ?>' disabled>
                                </div>
                                <div class="mb-3">
                                    <label for='created_at<?= $bookingCount ?>' class="form-label">Created At:</label>
                                    <input type='text' class="form-control" id='created_at<?= $bookingCount ?>' name='created_at' value='<?= htmlspecialchars($row_booking["created_at"]) ?>' disabled>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php 
            $bookingCount++;
            endwhile;
        else: ?>
            <div class="alert alert-info" role="alert">
                No current Orders found.
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>