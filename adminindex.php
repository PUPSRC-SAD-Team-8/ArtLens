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
        <title>Artlens</title>
    </head>

    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            <aside id="sidebar" style="position: relative; ">

                <div class="h-100">
                    <center>
                        <br>
                        <img src="assets/images/image.png" class="img-fluid" style="width: 70px;" alt="logo">
                        <div class="sidebar-logo">
                            <h4 style="color: #4169E1;"><b>ArtLens</b></h4>
                            <hr>
                        </div>
                    </center>
                    <!-- Sidebar Navigation -->
                    <ul class="sidebar-nav">
                        <li class="sidebar-item">
                            <a href="adminindex.php" class="sidebar-link mx-2 active">
                                <i class="fa-regular fa-address-card pe-2"></i>
                                Manage Account
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="adminartwork.php" class="sidebar-link mx-2 ">
                                <i class="fa-solid fa-palette pe-2"></i>
                                Artworks
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="adminannouncements.php" class="sidebar-link mx-2 ">
                                <i class="fa-solid fa-bullhorn pe-2"></i>
                                Announcements
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="adminquiz.php" class="sidebar-link mx-2 ">
                                <i class="fa-regular fa-newspaper pe-2"></i>
                                Quiz
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="adminbooking.php" class="sidebar-link mx-2 ">
                                <i class="fa-solid fa-book-open pe-2"></i>
                                Booking
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="adminvisitorlog.php" class="sidebar-link mx-2 ">
                                <i class="fa-solid fa-person pe-2"></i>
                                Visitor Log
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="logout.php" class="sidebar-link mx-2" style="margin-top: 30%; color: red;">
                                <i class="fa-solid fa-right-from-bracket pe-2"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <!-- Footer -->

                </div>
            </aside>

            <!-- Main Component -->
            <div class="main">
                <nav class="navbar navbar-expand px-3 border-bottom" style="background-color: white;">
                    <button class="btn btn-white" type="button" style="background-color: white; color: #4169E1;">
                        <span class="fa-solid fa-bars" style="font-size: 20px;"></i></span>
                    </button>
                    <!--<div class="mx-auto text-center">
                    <span style="font-size: larger;"><b>Rizal Shrine</b></span>
                </div>-->
                    <div class="ms-auto" style="margin-right: 15px; margin-top: 8px;">
                        <a href="#" class="position-relative d-inline-block">
                            <i class="fas fa-bell fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                9+
                            </span>
                        </a>
                    </div>
                </nav>

                <!--MAIN MAIN MAIN-->
                <main class="content px-4 py-3">
                    <div class="container mt-3" style="background-color: white; background: linear-gradient(to top, white 93%, #4169E1 7%);">
                        <div class="row" style="margin-left: 50px; margin-right: 50px; padding-top: 25px; padding-bottom: 35px;">
                            <div class="col-md-12" style="margin-top: 20px;">
                                <form id="" action="adminedit.php" enctype="multipart/form-data" method="POST">
                                    <button type="submit" id="editButton" class="btn btn-primary float-end mt-5">Save</button>
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="assets/images/profile.png" style="width: 120px; height: auto;" alt="Profile Picture" class="profile-image mt-4">
                                        </div>
                                        <div class="col-md-10">
                                            <span>
                                                <h2 style="display: inline-block; vertical-align: middle; margin-top: 20px;">Hello, Admin Juan</h2>
                                            </span>
                                        </div>
                                    </div>
                                    <h2 class="mt-5" style="font-size: 25px;">Personal Information</h2>
                                    <hr style="width: 300px; height:3px; background-color: #4169E1">
                                    <br>
                                    <?php
                                    include('connection.php');
                                    $sql = "SELECT * FROM admin where admin_id=" . $_SESSION['userid'] . "";
                                    $result = $conn->query($sql);
                                    $row = mysqli_fetch_array($result);
                                    $sqlt = "SELECT * FROM login where userid =" . $_SESSION['userid'] . "";
                                    $results = $conn->query($sqlt);
                                    $rowd = mysqli_fetch_array($results);
                                    ?>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="firstNameInput" class="form-label">First Name</label>
                                            <input class="form-control" type="text" id="firstNameInput" name="firstName" value="<?php echo $row['admin_first_name'] ?: " "  ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="lastNameInput" class="form-label">Last Name</label>
                                            <input class="form-control" type="text" id="lastNameInput" name="lastName" value="<?php echo $row['admin_last_name'] ?: " "  ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="middleInitialInput" class="form-label">M.I.</label>
                                            <input class="form-control" type="text" id="middleInitialInput" name="middleinitial" value="<?php echo $row['admin_middle_name'] ?: " "  ?>" style="width: 100px;" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="firstNameInput" class="form-label">Employee ID</label>
                                            <input class="form-control" type="text" id="firstNameInput" name="employeeid" value="<?php echo $row['admin_employee_id'] ?: " "  ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="lastNameInput" class="form-label">Email</label>
                                            <input class="form-control" type="text" id="lastNameInput" name="email" value="<?php echo $rowd['username']  ?: " " ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="middleInitialInput" class="form-label">Mobile Number</label>
                                            <input class="form-control" type="text" id="middleInitialInput" name="mobilenumber" value="<?php echo $row['admin_pnumber'] ?: " " ?>" required>
                                        </div>
                                    </div>
                                    <?php
                                    ?>

                            </div>
                            </form>
                        </div>
                    </div>
                    <!--NEW CONTAINER-->
                    <div class="container mt-3" style="background-color: white; background: linear-gradient(to top, white 93%, #4169E1 7%);">
                        <div class="row" style="margin-left: 50px; margin-right: 50px; padding-top: 25px; padding-bottom: 35px;">
                            <div class="col-md-12" style="margin-top: 20px;">
                                <h2 class="mt-4" style="font-size: 25px;">Password</h2>
                                <hr style="width: 300px; height:3px; background-color: #4169E1">
                                <p>To update your password</p>
                                <p>Please enter your existing password and your new password</p>
                                <?php
                                if (isset($_SESSION['errors'])) {
                                    echo $_SESSION['errors'][0];
                                }

                                ?>
                                <form id="" action="changepassword.php" method="POST">
                                    <div class="col-md-4 mb-3">
                                        <label for="nummInput" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" id="nummInput" name="currentpassword" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="dateInput" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="dateInput" name="newpassword" required>
                                    </div>
                                    <button class="btn btn-primary" type=submit style="float: right; background-color: #4169E1;">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <!--END MAIN-->
            </div>
            <script src="script.js"></script>
    </body>

    </html>
    <!-- 
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
    </script> -->










<?php
} else {

    header("Location: index.php");
    die();
}
?>