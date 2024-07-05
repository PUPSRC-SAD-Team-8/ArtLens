<?php
session_start();
include('connection.php');

if (isset($_SESSION['userid'])) {
    $userId = 1; // Replace with actual user ID logic if needed

    // Fetch user data
    $sql = "SELECT firstName, lastName, middleInitial, employee_id, email, mobileNumber FROM login WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName, $middleInitial, $employeeId, $email, $mobileNumber);
    $stmt->fetch();
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="sidebar/style.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Artlens</title>
    <style>
        .homebtn {
            padding: 10px;
            background-color: #4169E1 !important;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .homebtn:hover {
            background-color: white !important;
            border: 1px solid #4169E1 !important;
            color: #4169E1 !important;
        }

        .homebtn1 {
            padding: 10px;
            background-color: green !important;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .homebtn1:hover {
            background-color: white !important;
            border: 1px solid green !important;
            color: green !important;
        }

        .form-control[readonly] {
            background-color: #f0f0f0; /* Read-only background color */
        }
        
        .is-invalid {
            border-color: red;
        }
        .invalid-feedback {
            color: red;
        }
    </style>
</head>

<body>
    <?php include('sidebar.php'); ?>

    <!-- Main Content -->
    <main class="content px-4 py-3">
    <h1 style="color: grey;">Manage Account</h1>
        <div class="container mt-3" style="background-color: white; background: linear-gradient(to top, white 93%, #4169E1 7%);">
            <div class="row" style="margin-left: 50px; margin-right: 50px; padding-top: 25px; padding-bottom: 35px;">
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="assets/images/profile.png" style="width: 120px; height: auto;" alt="Profile Picture" class="profile-image mt-4">
                        </div>
                        <div class="col-md-10">
                            <span>
                                <h2 style="display: inline-block; vertical-align: middle; margin-top: 20px;">Hello, <span><?php echo htmlspecialchars($firstName); ?></span></h2>
                            </span>
                        </div>
                    </div>
                    <h2 class="mt-5" style="font-size: 25px;">Personal Information</h2>
                    <hr style="width: 300px; height: 3px; background-color: #4169E1">
                    <br>
                    <form id="employeeForm" action="update_user.php" method="POST" onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="firstNameInput" class="form-label">First Name</label>
                            <input class="form-control" type="text" id="firstNameInput" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" readonly required oninput="validateInput('firstNameInput', 'firstNameError')">
                            <div class="invalid-feedback" id="firstNameError"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastNameInput" class="form-label">Last Name</label>
                            <input class="form-control" type="text" id="lastNameInput" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" readonly required oninput="validateInput('lastNameInput', 'lastNameError')">
                            <div class="invalid-feedback" id="lastNameError"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middleInitialInput" class="form-label">M.I.</label>
                            <input class="form-control" type="text" id="middleInitialInput" name="middleInitial" value="<?php echo htmlspecialchars($middleInitial); ?>" style="width: 100px;" readonly required oninput="validateInput('middleInitialInput', 'middleInitialError')">
                            <div class="invalid-feedback" id="middleInitialError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="employeeIdInput" class="form-label">Employee ID</label>
                            <input class="form-control" type="text" id="employeeIdInput" name="employee_id" value="<?php echo htmlspecialchars($employeeId); ?>" readonly required oninput="validateInput('employeeIdInput', 'employeeIdError')">
                            <div class="invalid-feedback" id="employeeIdError"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="emailInput" class="form-label">Email</label>
                            <input class="form-control" type="email" id="emailInput" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly required oninput="validateInput('emailInput', 'emailError')">
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="mobileNumberInput" class="form-label">Mobile Number</label>
                            <input class="form-control" type="text" id="mobileNumberInput" name="mobileNumber" value="<?php echo htmlspecialchars($mobileNumber); ?>" readonly required oninput="validateInput('mobileNumberInput', 'mobileNumberError')">
                            <div class="invalid-feedback" id="mobileNumberError"></div>
                        </div>
                    </div>
                    <button type="button" class="homebtn float-end" style="border: none;" onclick="toggleEdit()">Edit</button>
                    <button type="submit" class="homebtn1 float-end" style="border: none; display: none; margin-right: 5px;" id="saveChangesBtn">Save Changes</button>
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                </form>
                </div>
            </div>
        </div>

        <!-- New Container -->
        <div class="container mt-3" style="background-color: white; background: linear-gradient(to top, white 93%, #4169E1 7%);">
            <div class="row" style="margin-left: 50px; margin-right: 50px; padding-top: 25px; padding-bottom: 35px;">
                <div class="col-md-12" style="margin-top: 20px;">
                    <h2 class="mt-4" style="font-size: 25px;">Password</h2>
                    <hr style="width: 300px; height: 3px; background-color: #4169E1">
                    <p>To update your password</p>
                    <p>Please enter your existing password and your new password</p>

                    <?php
                    if (isset($_SESSION['errors'])) {
                        echo $_SESSION['errors'][0];
                    }
                    ?>

                    <form id="changePasswordForm" action="changepassword.php" method="POST">
                        <div class="col-md-4 mb-3">
                            <label for="currentPasswordInput" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPasswordInput" name="currentpassword" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="newPasswordInput" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPasswordInput" name="newpassword" required>
                        </div>
                        <button class="btn btn-primary" type="submit" style="float: right; background-color: #4169E1;">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="sidebar/script.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function toggleEdit() {
        var inputs = document.querySelectorAll('input');
        var editButton = document.querySelector('.homebtn');
        var saveButton = document.getElementById('saveChangesBtn');

        inputs.forEach(function(input) {
            input.removeAttribute('readonly');
        });

        editButton.textContent = 'Cancel'; // Change button text to 'Cancel'
        editButton.setAttribute('onclick', 'cancelEdit()'); // Change onclick function to cancelEdit()
        saveButton.style.display = 'inline-block'; // Show Save Changes button
    }

    function cancelEdit() {
        var inputs = document.querySelectorAll('input');
        var editButton = document.querySelector('.homebtn');
        var saveButton = document.getElementById('saveChangesBtn');

        inputs.forEach(function(input) {
            input.setAttribute('readonly', ''); // Set inputs back to readonly
        });

        editButton.textContent = 'Edit'; // Change button text back to 'Edit'
        editButton.setAttribute('onclick', 'toggleEdit()'); // Change onclick function back to toggleEdit()
        saveButton.style.display = 'none'; // Hide Save Changes button
    }

    $(document).ready(function() {
        $('#employeeForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'update_user.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'Changes saved successfully'
                    });

                    // Reset form to readonly mode
                    cancelEdit();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        });
    });
</script>

</body>

</html>

<?php
} else {
    header("Location: index.php");
    die();
}
?>
