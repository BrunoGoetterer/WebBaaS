<?php

// Diese Seite stellt ein Login-Formular zur Verfügung. 
// Sie verwendet Bootstrap für das Styling und enthält PHP-Skripte für die Kopfzeile und die Sitzungslogik. 
// Nach erfolgreicher Anmeldung wird der Benutzer begrüßt, und bei Fehlern wird eine entsprechende Nachricht angezeigt.

session_start();
include "../../Backend/logic/header.php";
include "../../Backend/logic/session_status.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../../Frontend/Bilder/123.png">
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../CSS/login.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
</head>

<body>
    <div class="parallax">
        <section class="vh-100 gradient-custom">
            <form action="../../Backend/logic/loginlogic.php" method="POST">
                <div class="container py-5 h-100 ">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-transparent text-white" style="border-radius: 0rem;">
                                <div class="card p-5 text-center">
                                    <div class="mb-md-5 mt-md-4 pb-5">
                                        <?php
                                        if (isset($_SESSION['error'])) {
                                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                                            unset($_SESSION['error']);
                                        }
                                        ?>



                                        <h2 class="fw-bold mb-2 text-uppercase text-white">Login</h2>
                                        <p class="text-white-50 mb-5">Please enter your username and password!</p>

                                        <div class="form-floating mb-4">
                                            <input required type="text" id="username" name="username" class="form-control form-control-lg" />
                                            <label for="username">Username</label>
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input required type="password" id="password" name="password"
                                                class="form-control form-control-lg" />
                                            <label for="password">Password</label>
                                        </div>

                                        <p class="small mb-10 pb-lg-2"><a class="text-white" href="registration.php">Not a member yet?</a></p>
                                        
                                        <p class="mb-10">
    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
    <label for="rememberMe" class="text-white">Remember Login?</label>
</p>

                                        

                                        <button type="submit" class="btn btn-success btn-lg px-5">Login</button>
                                        <button type="reset" class="btn btn-danger btn-lg px-5">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>

</html>
