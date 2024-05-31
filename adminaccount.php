<?php
session_start();
include('connection.php');

if (isset($_SESSION['userid'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <title>Artlens</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" style="position: relative;">
            <?php include('sidebar.php'); ?>
        </aside>

        <!-- Main Component -->
        <div class="main">
        <?php include('header.php'); ?>

            <!-- Main Content -->
            <main class="content px-4 py-3">
               
                <div class="container mt-3" style="background-color: white; background: linear-gradient(to top, white 93%, #4169E1 7%);">
                    <div class="row" style="margin-left: 50px; margin-right: 50px; padding-top: 25px; padding-bottom: 35px;">
                        <div class="col-md-12" style="margin-top: 20px;">
                            <a type="button" id="editButton" class="btn btn-primary float-end mt-5" onclick="toggleSave()">Edit</a>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="assets/images/profile.png" style="width: 120px; height: auto;" alt="Profile Picture" class="profile-image mt-4">
                                </div>
                                <div class="col-md-10">
                                    <span><h2 style="display: inline-block; vertical-align: middle; margin-top: 20px;">Hello, Admin Juan</h2></span>
                                </div>
                            </div>
                            <h2 class="mt-5" style="font-size: 25px;">Personal Information</h2>
                            <hr style="width: 300px; height: 3px; background-color: #4169E1">
                            <br>
                            <form id="" action="" method="POST">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="firstNameInput" class="form-label">First Name</label>
                                        <input class="form-control" type="text" id="firstNameInput" name="firstName" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="lastNameInput" class="form-label">Last Name</label>
                                        <input class="form-control" type="text" id="lastNameInput" name="lastName" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="middleInitialInput" class="form-label">M.I.</label>
                                        <input class="form-control" type="text" id="middleInitialInput" name="middleInitial" style="width: 100px;" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="firstNameInput" class="form-label">Employee ID</label>
                                        <input class="form-control" type="text" id="firstNameInput" name="firstName" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="lastNameInput" class="form-label">Email</label>
                                        <input class="form-control" type="text" id="lastNameInput" name="lastName" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="middleInitialInput" class="form-label">Mobile Number</label>
                                        <input class="form-control" type="text" id="middleInitialInput" name="middleInitial" required>
                                    </div>
                                </div>
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
                            <form id="" action="" method="POST">
                                <div class="col-md-4 mb-3">
                                    <label for="nummInput" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="nummInput" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="dateInput" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="dateInput" name="dati" required>
                                </div>
                                <button class="btn btn-primary" type="submit" style="float: right; background-color: #4169E1;">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="script.js"></script>
</body>
</html>

<script>
    function toggleSave() {
        var editButton = document.getElementById('editButton');
        if (editButton.textContent === 'Edit') {
            editButton.textContent = 'Save';
            editButton.classList.remove('btn-primary');
            editButton.classList.add('btn-success');
        } else {
            editButton.textContent = 'Edit';
            editButton.classList.remove('btn-success');
            editButton.classList.add('btn-primary');
        }
    }
</script>

<?php
} else {
    header("Location: index.php");
    die();
}
?>
