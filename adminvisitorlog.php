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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sidebar/style.css">
    <link rel="stylesheet" href="assets/css/adminvisitorlogs.css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <title>Artlens</title>
    <style>
        .table-container {
            margin-bottom: 2rem;
            overflow: auto;
        }
    </style>
</head>

<body>
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>

            <!--MAIN MAIN MAIN-->
            <main class="content px-3 py-2">
                <div class="container">
                <form method="POST" action="generate_visitor_individual.php" target="_blank">
                        <button type="submit" class="btn btn-primary float-end" name="pdf_for_individual" value="PDF">Export to File <i class="bi bi-file-earmark-pdf"></i></button>
                    </form>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h3 style="color: grey;">Individual</h3>
                        <button id="add-row" class="btn mb-3" style="background-color: #4169E1; color: white; visibility: hidden;">Add Log</button>
                    </div>

                    <!-- First Table -->
                    <div class="table-container">
                        <table id="myTable" class="table table-striped table-bordered" style="background-color: #ffffff;">
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
                            $sql = "SELECT * FROM visitor_log";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row_count = 0;
                                while($row = $result->fetch_assoc()) {
                                    $row_count++;
                                    $row_class = ($row_count % 2 == 0) ? "even-row" : "odd-row";
                                    echo "<tr class='clickable-row $row_class' data-info='" . $row["log_first_name"] . "|" . $row["log_mid_name"] . "|" . $row["log_last_name"] . "|" . $row["log_gender"] . "|" . $row["log_contact_number"] . "|" . $row["log_contact_email"] . "|" . $row["entry_timestamp"] . "' style='cursor: pointer;'>";
                                    echo "<td>" . $row_count . "</td>";
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
                    </div>

                    <!-- Second Table -->
                    <form method="POST" action="generate_visitor_org.php" target="_blank">
                        <button type="submit" class="btn btn-primary float-end" name="pdf_for_org" value="PDF">Export to File <i class="bi bi-file-earmark-pdf"></i></button>
                    </form>
                    <h3 style="margin-top: 2rem; color: grey;">Organization</h3> 
                    <div class="table-container">
                        <table id="myTable1" class="table table-striped table-bordered" style="background-color: #ffffff;">
                            <thead style="background-color: #4169E1; color: white;">
                                <tr>
                                    <th>C.N. Bus No.</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Total</th>
                                    <th>Nationality</th>
                                    <th>Time in</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM visitor_org";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row_count = 0;
                                while($row = $result->fetch_assoc()) {
                                    $row_count++;
                                    $row_class = ($row_count % 2 == 0) ? "even-row" : "odd-row";
                                    echo "<tr class='clickable-row $row_class' data-info='" . $row["visitor_org_cn_no"] . "|" . $row["visitor_org_name"] . "|" . $row["visitor_org_add"] . "|" . ($row["visitor_org_male"] + $row["visitor_org_female"]) . "|" . $row["visitor_org_natl"] . "|" . $row["visitor_org_male"] . "|" . $row["visitor_org_female"] . "|" . $row["visitor_org_gschool"] . "|" . $row["visitor_org_hschool"] . "|" . $row["visitor_org_college"] . "|" . $row["visitor_org_pwd"] . "|" . $row["visitor_org_17blow"] . "|" . $row["visitor_org_1930old"] . "|" . $row["visitor_org_3159old"] . "|" . $row["visitor_org_60old"] . "|"  . $row["entry_timestamp"].  "' style='cursor: pointer;'>";
                                    echo "<td>" . $row["visitor_org_cn_no"] . "</td>";
                                    echo "<td>" . $row["visitor_org_name"] . "</td>";
                                    echo "<td>" . $row["visitor_org_add"] . "</td>";
                                    echo "<td>" . ($row["visitor_org_male"] + $row["visitor_org_female"]) . "</td>";
                                    echo "<td>" . $row["visitor_org_natl"] . "</td>";
                                    echo "<td>" . $row["entry_timestamp"] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal for Individual Table -->
                    <div class="modal fade" id="individualModal" tabindex="-1" aria-labelledby="individualModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="individualModalLabel">Visitor Log Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Name: <span id="individual-modal-name"></span></p>
                                    <p>Gender: <span id="individual-modal-gender"></span></p>
                                    <p>Mobile Number: <span id="individual-modal-mobile"></span></p>
                                    <p>Email: <span id="individual-modal-email"></span></p>
                                    <p>Time in: <span id="individual-modal-in"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Organization Table -->
                    <div class="modal fade" id="organizationModal" tabindex="-1" aria-labelledby="organizationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="organizationModalLabel">Organization Visitor Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>C.N. Bus No.: <span id="organization-modal-cn"></span></p>
                                    <p>Name: <span id="organization-modal-name"></span></p>
                                    <p>Address: <span id="organization-modal-address"></span></p>
                                    <p>Total: <span id="organization-modal-total"></span></p>
                                    <p>Nationality: <span id="organization-modal-nationality"></span></p>
                                    <p>Time in: <span id="organization-modal-in"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Add Log Form -->
                    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="z-index: 1111111;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infoModalLabel">Log Form</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="infoForm" method="POST" action="save_log.php">
                                        <div class="mb-3">
                                            <label for="fnameInput" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="fnameInput" name="fn" required>
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
                </div>
            </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="sidebar/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#myTable1').DataTable();

            // Attach click event handler to the tbody element instead of individual rows
            $('#myTable tbody').on('click', '.clickable-row', function () {
                var rowData = $(this).data('info').split('|');
                $('#individual-modal-name').text(rowData[0] + ' ' + rowData[1] + ' ' + rowData[2]);
                $('#individual-modal-gender').text(rowData[3]);
                $('#individual-modal-mobile').text(rowData[4]);
                $('#individual-modal-email').text(rowData[5]);
                $('#individual-modal-in').text(rowData[6]);
                $('#individualModal').modal('show');
            });

            $('#myTable1 tbody').on('click', '.clickable-row', function () {
                var rowData = $(this).data('info').split('|');
                $('#organization-modal-cn').text(rowData[0]);
                $('#organization-modal-name').text(rowData[1]);
                $('#organization-modal-address').text(rowData[2]);
                $('#organization-modal-total').text(rowData[3]);
                $('#organization-modal-nationality').text(rowData[4]);
                $('#organization-modal-in').text(rowData[15]);
                $('#organizationModal').modal('show');
            });

            // Add Row button click event
            $('#add-row').click(function () {
                $('#infoModal').modal('show');
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
