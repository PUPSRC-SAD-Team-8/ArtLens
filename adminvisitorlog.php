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
            
            
            
            <!--MAIN MAIN MAIN-->
            <main class="content px-3 py-2" style="overflow-x: auto;">
                <div class="container">
                    
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h3>Individual</h3>
                    <button id="add-row" class="btn mb-3" style="background-color: #4169E1; color: white;">Add Log</button>
                </div>
                    <div class="table-container" style="max-height: 400px; ">
                        <table id="myTable" class="table table-striped table-bordered"  style="background-color: #ffffff;">
                            <thead style="background-color: #4169E1; color: white;">
                                <tr>
                                    <th>#</th>
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

                <!-- New Table -->
                <h3>Ogranization</h3>
                    <div class="table-container" style="max-height: 400px; ">
                        <table id="myTable" class="table table-striped table-bordered"  style="background-color: #ffffff;">
                            <thead style="background-color: #4169E1; color: white;">
                                <tr>
                                    <th>C.N. Bus No.</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Total</th>
                                    <th>Nationality</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            include('connection.php');
                            $sql = "SELECT * FROM visitor_org";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row_count = 0; // Initialize row count variable
                                while($row = $result->fetch_assoc()) {
                                    $row_count++; // Increment row count for each row
                                    $row_class = ($row_count % 2 == 0) ? "even-row" : "odd-row";
                                    echo "<tr class='clickable-row $row_class' data-info='" .  "|" . $row["visitor_org_cn_no"] . "|" . $row["visitor_org_name"] . "|" . $row["visitor_org_add"] . "|" . $row["visitor_org_natl"] . "|" . $row["visitor_org_male"] . "|" . $row["visitor_org_female"] . "|" . $row["visitor_org_gschool"] . "|" . $row["visitor_org_hschool"] . "|" . $row["visitor_org_college"] . "|" . $row["visitor_org_pwd"] . "|" . $row["visitor_org_17blow"] .  $row["visitor_org_1930old"] . $row["visitor_org_3159old"] . $row["visitor_org_60old"] ."' style='cursor: pointer;'>";
                                    
                                    echo "<td>" . $row["visitor_org_cn_no"] . "</td>";
                                    echo "<td>" . $row["visitor_org_name"] . "</td>";
                                    echo "<td>" . $row["visitor_org_add"] . "</td>";
                                    echo "<td>" . ($row["visitor_org_male"] + $row["visitor_org_female"]) . "</td>";
                                    echo "<td>" . $row["visitor_org_natl"] . "</td>";
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
        </>
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