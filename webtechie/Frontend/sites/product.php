<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="icon" href="../../Frontend/Bilder/123.png">
    <meta charset="UTF-8">
    <title>Products</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom CSS for the product page -->
    <link rel="stylesheet" href="../CSS/product.css">
    <link rel="stylesheet" href="../CSS/showproducts.css">

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Additional Custom CSS for the product page -->
    <link rel="stylesheet" type="text/css" href="../CSS/product.css">
</head>

<body>

    <!-- Include the header -->
    <?php include "../../Backend/logic/header.php"; ?>

    <!-- Page title -->
    <h2 class="title">Baas newest Products:</h2>
    
    <!-- Container for the products -->
    <div class="container">
        <!-- Include the ShowProducts partial -->
        <?php include "../partials/ShowProducts.php"; ?>
    </div>

</body>

</html>
