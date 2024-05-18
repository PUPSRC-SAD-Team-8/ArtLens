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
    <link rel="stylesheet" href="assets/css/adminbooking.css">
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
                    <div class="d-flex justify-content-end mt-3">
                        <button id="add-row" class="btn mb-3" style="background-color: #4169E1; color: white;">Add Booking</button>
                    </div>
                    <div style="max-height: 400px; ">
                        <table id="myTable" class="table table-striped table-bordered"  style="background-color: #ffffff;">
                            <thead style="background-color: #4169E1; color: white;">
                                <tr>
                                    <th>ID</th>
                                    <th>Organization Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                include('connection.php');
                                $sql = "SELECT * FROM booking";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row_num = 0; // Initialize row number counter
                                    while($row = $result->fetch_assoc()) {
                                        $row_num++; // Increment row number for each iteration
                                        // Determine row class based on row number for alternating colors
                                        $row_class = ($row_num % 2 == 0) ? "even-row" : "odd-row";
                                        
                                        echo "<tr class='clickable-row $row_class' data-info='" . $row["booking_id"] . "|" . $row["organization_name"] . "|" . $row["contact_email"] . "|" . $row["contact_number"] . "|" . ($row["num_male"] + $row["num_male"])  . "|" . $row["book_status"] . "'>";
                                        echo "<td>" . $row["booking_id"] . "</td>";
                                        echo "<td>" . $row["organization_name"] . "</td>";
                                        echo "<td>" . $row["contact_email"] . "</td>";
                                        echo "<td>" . $row["contact_number"] . "</td>";
                                        echo "<td>" . ($row["num_male"] + $row["num_female"]) . "</td>";
                                        echo "<td>" . $row["book_status"] . "</td>";
                                        echo "</tr>";
                                    }
                                } 
                                ?>
                            </tbody>
                        </table>
                        <br>
                        <br><br>
                    </div>
                </div>
            
                <!-- Modal -->
                <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="infoModalLabel">Booking Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="infoForm" action="bookingad.php" method="POST">
                                    <div class="mb-3">
                                        <label for="nameInput" class="form-label">Organization Name</label>
                                        <input class="form-control" type="text" id="nameInput" name="onam" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInput" name="emal" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mnumberInput" class="form-label">Mobile Number</label>
                                        <input type="number" class="form-control" id="mnumberInput" name="monu" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nummInput" class="form-label">Number of Male</label>
                                        <input type="number" class="form-control" id="nummInput" name="nufe" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nummInput" class="form-label">Number of Female</label>
                                        <input type="number" class="form-control" id="nummInput" name="numa" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateInput" class="form-label">Date and Time</label>
                                        <input type="datetime-local" class="form-control" id="dateInput" name="dati" required>
                                    </div>

                                    <button type="submit" name="submit" class="btn float-end" style="background-color: #4169E1; color: #ffffff;">Submit</button>
                                </form>
                            </div>

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
                                <p>Organization Name: <span id="modal-name"></span></p>
                                <p>Email: <span id="modal-email"></span></p>
                                <p>Mobile Number: <span id="modal-mobile"></span></p>
                                <p>Total: <span id="modal-total"></span></p>
                                <p>Status: <span id="modal-status"></span></p>
                                <div class="float-end" style="margin-bottom: 10px;"> <!-- Add margin-bottom for gap -->
                                <button class="btn btn-primary">Edit</button>
                                <span style="margin-left: 10px;"> <!-- Add margin-left for gap -->
                                <button class="btn" style="background-color: green; color: white;">Save Changes</button>
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <script>
                    $(document).ready(function () {
                        $('#add-row').click(function () {
                            $('#infoModal').modal('show');
                        });
                    });
                </script>
            </main>
        </div>
        <!--END MAIN-->
    </div>
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
            $('#modal-email').text(rowData[2]);
            $('#modal-mobile').text(rowData[3]);
            $('#modal-total').text(rowData[4]);
            $('#modal-status').text(rowData[5]);
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