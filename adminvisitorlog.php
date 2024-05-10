<?php
session_start();
include ('connection.php');

if (isset($_SESSION['userid'])) {
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/adminvisitorlogs.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <title>Artlens</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" style="position: relative;">
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
                        <a href="adminindex.php" class="sidebar-link mx-2 ">
                            <i class="fa-regular fa-address-card pe-2"></i>
                            Manage Account
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="adminartwork.php" class="sidebar-link mx-2">
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
                        <a href="adminvisitorlog.php" class="sidebar-link mx-2 active">
                            <i class="fa-solid fa-person pe-2"></i>
                            Visitor Log
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="logout.php" class="sidebar-link mx-2" style="margin-top: 30%; color: red;" >
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
            <main class="content px-3 py-2" style="overflow-x: auto;">
                <div class="container">
                    <div class="d-flex justify-content-end mt-3">
                        <button id="add-row" class="btn mb-3" style="background-color: #4169E1; color: white;">Add Log</button>
                    </div>
                    <div class="table-container" style="max-height: 400px; ">
                        <table id="myTable" class="table table-striped table-bordered"  style="background-color: #ffffff;">
                            <thead style="background-color: #4169E1; color: white;">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Time in</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            include('connection.php');
                            $sql = "SELECT * FROM visitor_log";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row_count = 0; // Initialize row count variable
                                while($row = $result->fetch_assoc()) {
                                    $row_count++; // Increment row count for each row
                                    $row_class = ($row_count % 2 == 0) ? "even-row" : "odd-row";
                                    echo "<tr class='clickable-row $row_class' data-info='" . $row["log_form"] . "|" . $row["log_first_name"] . "|" . $row["log_mid_name"] . "|" . $row["log_last_name"] . "|" . $row["log_contact_email"] . "|" . $row["log_contact_number"] . "' style='cursor: pointer;'>";
                                    echo "<td>" . $row_count . "</td>"; // Output row count for ID column
                                    echo "<td>" . $row["log_first_name"]. ' ' . $row["log_mid_name"]. ' '. $row["log_last_name"] .  "</td>";
                                    echo "<td>" . $row["log_gender"] . "</td>";
                                    echo "<td>" . $row["log_contact_number"] . "</td>";
                                    echo "<td>" . $row["log_contact_email"] . "</td>";
                                    echo "<td>" . $row["entry_timestamp"] . "</td>";
                                    echo "</tr>";
                                }
                            } 
                            ?>
                            </tbody>
                        </table>
                        <br>
                        <br><br>
                    </div>

                <!-- Modal -->
                <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="z-index: 1111111;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="infoModalLabel">Log Form</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="infoForm" action="logad.php" method="POST">
                                <div class="mb-3">
                                    <label for="fnameInput" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="fnameInput" name="fn" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lnameInput" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lnameInput" name="ln" required>
                                </div>
                                <div class="mb-3">
                                    <label for="miInput" class="form-label">MI (Optional)</label>
                                    <input type="text" class="form-control" id="miInput" name="mo">
                                </div>
                                <div class="mb-3 gender">Gender:
                                    <input type="radio" id="male" name="gen" value="Male">
                                    <label for="male">Male</label>
                                    <input type="radio" id="female" name="gen" value="Female">
                                    <label for="female">Female</label>
                                    <input type="radio" id="other" name="gen" value="Other">
                                    <label for="other">Other</label>
                                </div>
                                <div class="mb-3">
                                    <label for="malInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="malInput" name="email1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="numberInput" class="form-label">Mobile Number</label>
                                    <input type="number" class="form-control" id="numberInput" name="monu1" required>
                                </div>
                                <button type="submit" class="btn float-end" style="background-color: #4169E1; color: white;">Submit</button>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>ID: <span id="modal-id"></span></p>
                                <p>Name: <span id="modal-name"></span></p>
                                <p>Gender: <span id="modal-gender"></span></p>
                                <p>Mobile Number: <span id="modal-mobile"></span></p>
                                <p>Email: <span id="modal-email"></span></p>
                                <p>Time in: <span id="modal-in"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <script>
                    $(document).ready(function () {
                        // Add Row button click event
                        $('#add-row').click(function () {
                            $('#infoModal').modal('show');
                        });
                    });
                </script>
            </main>
        </div>
            </main>
        </div>
        <!--END MAIN-->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();

        // Attach click event handler directly to table rows
        $('.clickable-row').click(function () {
            var rowData = $(this).data('info').split('|');
            $('#modal-id').text(rowData[0]);
            $('#modal-name').text(rowData[1]);
            $('#modal-gender').text(rowData[2]);
            $('#modal-email').text(rowData[3]);
            $('#modal-mobile').text(rowData[4]);
            $('#modal-in').text(rowData[5]);
            $('#myModal').modal('show');
        });
    });
</script>

<?php
}else{
    
   header ("Location: index.php");
   die();
}
?>