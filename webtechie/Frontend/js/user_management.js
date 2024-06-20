// Use strict mode
"use strict";

// on ready function (called when DOM is loaded)
$(document).ready(function() {
    console.log("Ready ... DOM loaded!");

    let divResult = $("#result");
    let apiPath = "../backend/api.php";

    /** Load all users */
    function loadAllUsers() {
        divResult.empty(); // Clear the div content
        $.ajax({
            type: "GET",
            dataType: "json",
            url: apiPath + "?resource=users",
            success: function(response) {
                console.log("Success:", response);
                if (response.length > 0) {
                    response.forEach(user => {
                        divResult.append(createUserCard(user)); // Append user cards to the div
                    });
                } else {
                    divResult.append("<p>No users found</p>");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("Error:", xhr);
                divResult.text("Error:\n" + JSON.stringify(xhr, undefined, 2));
            }
        });
    }

    /** Create user card */
    function createUserCard(user) {
        return `
            <div class='container d-flex justify-content-center align-items-center'
                style='margin-top: 50px; min-height:50vh; width: 50%; background-color: #f8f9fa; color: #343a40; border-radius: 15px;'>
                <div class='content-wrapper'>
                    <form action='../backend/config/user_update.php' method='post'>
                        <input type='hidden' name='userID' value='${user.id}'>
                        <div class="form-group">
                            <label for='username'>Username:</label>
                            <input type='text' class='form-control' id='username' name='username' value='${user.username}'>
                        </div>
                        <div class="form-group">
                            <label for='password'>Password:</label>
                            <input type='password' class='form-control' id='password' name='password' value='${user.password}'>
                        </div>
                        <div class="form-group">
                            <label for='useremail'>Email:</label>
                            <input type='email' class='form-control' id='useremail' name='useremail' value='${user.useremail}'>
                        </div>
                        <div class="divider"></div>
                        <div class="form-group">
                            <label for='address'>Address:</label>
                            <input type='text' class='form-control' id='address' name='address' value='${user.address}'>
                        </div>
                        <div class="form-group">
                            <label for='city'>City:</label>
                            <input type='text' class='form-control' id='city' name='city' value='${user.city}'>
                        </div>
                        <div class="form-group">
                            <label for='state'>State:</label>
                            <input type='text' class='form-control' id='state' name='state' value='${user.state}'>
                        </div>
                        <div class="form-group">
                            <label for='zip'>Zip:</label>
                            <input type='text' class='form-control' id='zip' name='zip' value='${user.zip}'>
                        </div>
                        <div class="divider"></div>
                        <div class="form-group">
                            <label for='anrede'>Anrede:</label>
                            <input type='text' class='form-control' id='anrede' name='anrede' value='${user.anrede}'>
                        </div>
                        <div class="form-group">
                            <label for='firstname'>First Name:</label>
                            <input type='text' class='form-control' id='firstname' name='firstname' value='${user.firstname}'>
                        </div>
                        <div class="form-group">
                            <label for='lastname'>Last Name:</label>
                            <input type='text' class='form-control' id='lastname' name='lastname' value='${user.lastname}'>
                        </div>
                        <div class="divider"></div>
                        <div class="form-group">
                            <label for='role'>Role:</label>
                            <input type='number' class='form-control' id='role' name='role' value='${user.role}'>
                        </div>
                        <div class="form-group">
                            <label for='accountstatus'>Account Status:</label>
                            <select class='form-control' id='accountstatus' name='accountstatus'>
                                <option value='1' ${user.accountstatus == '1' ? "selected" : ""}>Active</option>
                                <option value='0' ${user.accountstatus == '0' ? "selected" : ""}>Deactivated</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark" style='margin-top:2%'>Update User</button>
                    </form><br />
                </div>
            </div>
        `;
    }

    // Load all users on page load
    loadAllUsers();
});
