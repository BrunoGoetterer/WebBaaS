<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="icon" href="../../Frontend/Bilder/123.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom CSS for the profile page -->
    <link rel="stylesheet" href="../CSS/profile.css">

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- Additional Custom CSS for the profile page -->
    <link rel="stylesheet" type="text/css" href="../CSS/profile.css">
</head>

<body>
    <!-- Include the header -->
    <?php include "../../Backend/logic/header.php"; ?>

    <!-- Include profile logic -->
    <?php include "../../Backend/logic/profile_logic.php"; ?> 

    <div class="hello">
        <?php if ($currentUser): ?>
            <!-- Welcome message for the user -->
            <div class="container" style="margin-top: 120px;" id="hello">
                Welcome to <?= htmlspecialchars($currentUser["username"]) ?>'s profile page!
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12" style="background-color: #f8f9fa; color: #343a40; border-radius: 15px;">
                    <!-- Profile update form -->
                    <form id="profileForm" action="profile.php" method="post">
                        <?php if ($status): ?>
                            <!-- Display status message -->
                            <div class="alert alert-<?= $status === 'error' ? 'danger' : 'success' ?>" role="alert">
                                <?= htmlspecialchars($message) ?>
                            </div>
                            <?php
                            // Unset the status and message session variables after displaying them
                            unset($_SESSION['status'], $_SESSION['message']);
                            ?>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($currentUser["username"]) ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="anrede">Anrede</label>
                            <input type="text" class="form-control" id="anrede" name="anrede" value="<?= htmlspecialchars($currentUser["anrede"]) ?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($currentUser["firstname"]) ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($currentUser["lastname"]) ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="useremail" value="<?= htmlspecialchars($currentUser["useremail"]) ?>">
                        </div>
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="role">Your user role:</label>
                            <input type="text" class="form-control" id="role" name="role" value="<?= htmlspecialchars($currentUser["role"] == 1 ? 'Admin' : 'User') ?>" disabled>
                        </div>
                        <div class="buttons">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                    <a href="bestellungen.php" class="btn btn-info">My Orders</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- JavaScript for profile page -->
    <script src="../js/profile.js"></script>
</body>

</html>
