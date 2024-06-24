<?php
session_start();
include('connection.php');

if (isset($_SESSION['userid'])) {
    $updateSuccess = isset($_GET['update_success']) && $_GET['update_success'] == 1;
    $userId = 1; // for example purposes

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
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <title>Artlens</title>
    <style>
        .homebtn{
  padding: 10px ;
  background-color:#4169E1 !important;
  color: white;
  border-radius: 5px;
  text-decoration: none;
}

.homebtn:hover{
  background-color: white !important;
  border: 1px solid #4169E1 !important;
  color: #4169E1 !important;
}
    </style>
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
                            <form id="employeeForm" action="update_user.php" method="POST">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="firstNameInput" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="firstNameInput" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="lastNameInput" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" id="lastNameInput" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="middleInitialInput" class="form-label">M.I.</label>
                                    <input class="form-control" type="text" id="middleInitialInput" name="middleInitial" value="<?php echo htmlspecialchars($middleInitial); ?>" style="width: 100px;" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="employeeIdInput" class="form-label">Employee ID</label>
                                    <input class="form-control" type="text" id="employeeIdInput" name="employee_id" value="<?php echo htmlspecialchars($employeeId); ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="emailInput" class="form-label">Email</label>
                                    <input class="form-control" type="email" id="emailInput" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="mobileNumberInput" class="form-label">Mobile Number</label>
                                    <input class="form-control" type="text" id="mobileNumberInput" name="mobileNumber" value="<?php echo htmlspecialchars($mobileNumber); ?>" required>
                                </div>
                            </div>
                            <button type="submit" class="homebtn float-end" style="border: none;">Update</button>
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
                            if(isset($_SESSION['errors'])){
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
