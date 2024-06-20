<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../../Frontend/Bilder/123.png">
    <meta charset="UTF-8">
    <title>User Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/user_management.css">

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    // Include necessary backend logic files
    include "../../Backend/logic/header.php";
    include "../../Backend/logic/user_management_logic.php";
    include "../../Backend/logic/alert.php"; // Include the alert.php file
    ?>

    <div class="container" style="margin-top: 120px;">
        <?php displayAlert(); // Call the function to display alerts ?>

        <?php
        // Check if the query was successful
        if ($userResult && $userResult->num_rows > 0) {
            // Loop through the results -> each iteration of the loop corresponds to one user
            while ($userRow = $userResult->fetch_assoc()) {
                $result_bookings = fetchUserBookings($connection, $userRow["id"]);
                ?>
                <div class='container d-flex justify-content-center align-items-center'
                    style='margin-top: 50px; min-height:50vh; width: 50%; background-color: #f8f9fa; color: #343a40; border-radius: 15px;'>
                    <div class='content-wrapper'>
                        <form action='../../Backend/config/user_update.php' method='post'>
                            <input type='hidden' name='userID' value='<?= htmlspecialchars($userRow["id"]) ?>'>
                            <div class="form-group">
                                <label for='username'>Username:</label>
                                <input type='text' class='form-control' id='username' name='username' value='<?= htmlspecialchars($userRow["username"]) ?>'>
                            </div>
                            <div class="form-group">
                                <label for='password'>Password:</label>
                                <input type='password' class='form-control' id='password' name='password' value='<?= htmlspecialchars($userRow["password"]) ?>'>
                            </div>
                            <div class="form-group">
                                <label for='useremail'>Email:</label>
                                <input type='email' class='form-control' id='useremail' name='useremail' value='<?= htmlspecialchars($userRow["useremail"]) ?>'>
                            </div>
                            <div class="divider"></div>
                            <div class="form-group">
                                <label for='address'>Address:</label>
                                <input type='text' class='form-control' id='address' name='address' value='<?= htmlspecialchars($userRow["address"]) ?>'>
                            </div>
                            <div class="form-group">
                                <label for='city'>City:</label>
                                <input type='text' class='form-control' id='city' name='city' value='<?= htmlspecialchars($userRow["city"]) ?>'>
                            </div>
                            <div class="form-group">
                                <label for='state'>State:</label>
                                <input type='text' class='form-control' id='state' name='state' value='<?= htmlspecialchars($userRow["state"]) ?>'>
                            </div>
                            <div class="form-group">
                                <label for='zip'>Zip:</label>
                                <input type='text' class='form-control' id='zip' name='zip' value='<?= htmlspecialchars($userRow["zip"]) ?>'>
                            </div>
                            <div class="divider"></div>
                            <div class="form-group">
                                <label for='anrede'>Anrede:</label>
                                <input type='text' class='form-control' id='anrede' name='anrede' value='<?= htmlspecialchars($userRow["anrede"]) ?>'>
                            </div>
                            <div class="form-group">
                                <label for='firstname'>First Name:</label>
                                <input type='text' class='form-control' id='firstname' name='firstname' value='<?= htmlspecialchars($userRow["firstname"]) ?>'>
                            </div>
                            <div class="form-group">
                                <label for='lastname'>Last Name:</label>
                                <input type='text' class='form-control' id='lastname' name='lastname' value='<?= htmlspecialchars($userRow["lastname"]) ?>'>
                            </div>
                            <div class="divider"></div>
                            <div class="form-group">
                                <label for='role'>Role:</label>
                                <input type='number' class='form-control' id='role' name='role' value='<?= htmlspecialchars($userRow["role"]) ?>'>
                            </div>
                            <div class="form-group">
                                <label for='accountstatus'>Account Status:</label>
                                <select class='form-control' id='accountstatus' name='accountstatus'>
                                    <option value='1' <?= $userRow["accountstatus"] == '1' ? "selected" : "" ?>>Active</option>
                                    <option value='0' <?= $userRow["accountstatus"] == '0' ? "selected" : "" ?>>Deactivated</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark" style='margin-top:2%'>Update User</button>
                        </form><br />
                        <label for='booking'>Orders:</label>

                        <?php
                        // Check if a booking exists for the user
                        if ($result_bookings && $result_bookings->num_rows > 0) {
                            $bookingCount = 1;
                            while ($row_booking = $result_bookings->fetch_assoc()) {
                                ?>
                                <div>
                                    <button class='btn btn-primary mb-3' type='button' data-bs-toggle='collapse'
                                        data-bs-target='#booking-<?= $row_booking['id'] ?>' aria-expanded='false'
                                        aria-controls='booking<?= $bookingCount ?>'>
                                        Order <?= $bookingCount ?>
                                    </button>
                                    <div class='collapse' id='booking-<?= $row_booking['id'] ?>'>
                                        <div class='card card-body'>
                                            <form action='../../Backend/config/bestellung_update.php' method='post'>
                                                <input type='hidden' name='bookingID' value='<?= htmlspecialchars($row_booking["id"]) ?>'>
                                                <div class="form-group">
                                                    <label for='title'>Title:</label>
                                                    <input type='text' class='form-control' id='title' name='title' value='<?= htmlspecialchars($row_booking["title"]) ?>'>
                                                </div>
                                                <div class="form-group">
                                                    <label for='price'>Price:</label>
                                                    <input type='text' class='form-control' id='price' name='price' value='<?= htmlspecialchars($row_booking["price"]) ?>'>
                                                </div>
                                                <div class="form-group">
                                                    <label for='created_at'>Created At:</label>
                                                    <input type='text' class='form-control' id='created_at' name='created_at' value='<?= htmlspecialchars($row_booking["created_at"]) ?>' readonly>
                                                </div>
                                                <input type='submit' class='btn btn-dark' style='margin-top:2%' value='Update Order'>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $bookingCount++;
                            }
                        } else {
                            ?>
                            <input type='text' class='form-control' id='booking' name='booking' value='No current bookings' disabled><br>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <?php
            }
        } else {
            echo "No users found";
        }

        // Close the connection
        if ($connection) {
            $connection->close();
        }
        ?>
    </div>
</body>

</html>
