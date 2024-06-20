<?php
// Include session status and user role verification
include "../../Backend/logic/session_status.php";

// Include database access
require_once("../../Backend/config/dbaccess.php");

// Check if a user is logged in and if he is an admin, if not redirect to login.php
if (!isset($currentUser) || $currentUser["role"] !== 1) {
    // Redirect to login.php
    header('Location: login.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../../Frontend/Bilder/123.png">
    <meta charset="UTF-8">
    <title>Product Upload</title>

    <link rel="stylesheet" href="../../Frontend/CSS/productupload.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../Frontend/CSS/productupload.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="../CSS/productupload.css">
</head>

<body>

    <?php include "../../Backend/logic/header.php"; ?>

    <div class="parallax">
        <section class="gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-transparent text-white" style="border-radius: 0rem;">
                            <div class="card-body p-5 text-center">
                                <h1 class="fw-bold mb-4 text-uppercase text-black">Product Upload</h1>
                                <form method="POST" action='../../Backend/config/insert_product.php' enctype="multipart/form-data">
                                    <?php displaySessionStatus(); ?>
                                    <div class="mb-4 text-black">
                                        <label for="title" class="form-label">Title:</label>
                                        <input required type="text" id="title" name="title" class="form-control" placeholder="Enter product title" />
                                    </div>
                                    <div class="mb-4 text-black">
                                        <label for="image" class="form-label">Image:</label>
                                        <input required type="file" id="image" name="image" accept="image/*" class="form-control" />
                                    </div>
                                    <div class="mb-4 text-black">
                                        <label for="tags" class="form-label">Tags:</label>
                                        <select name="tags" id="tags" class="form-select">
                                            <option value="Lego Technic">Lego Technic</option>
                                            <option value="Lego Heroes">Lego Heroes</option>
                                            <option value="Lego Classic">Lego Classic</option>
                                            <option value="Lego Disney">Lego Disney</option>
                                            <option value="Lego City">Lego City</option>
                                        </select>
                                    </div>
                                    <div class="mb-4 text-black">
                                        <label for="price" class="form-label">Price:</label>
                                        <input required type="number" step="0.01" id="price" name="price" class="form-control" placeholder="Enter product price" />
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg px-5">Upload</button>
                                    <button type="reset" class="btn btn-danger btn-lg px-5">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
