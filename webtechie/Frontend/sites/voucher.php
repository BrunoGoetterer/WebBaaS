<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="icon" href="../../Frontend/Bilder/123.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vouchers</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/vouchers.css">
    <link rel="stylesheet" type="text/css" href="../CSS/vouchers.css">
</head>

<body>
    <!-- Include the header -->
    <?php include "../../Backend/logic/header.php"; ?>

    <div class="container mt-5">
        <h2>Manage Vouchers</h2>

        <!-- Display message if set -->
        <?php if (isset($message)) : ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <!-- Include the form to add vouchers -->
        <?php include "../partials/AddVoucherForm.php"; ?>

        <h3 class="mt-5">Voucher List</h3>
        
        <!-- Include the voucher list -->
        <?php include "../partials/ShowVouchers.php"; ?>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
