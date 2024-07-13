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
    <link rel="stylesheet" href="sidebar/style.css">
    <link rel="stylesheet" href="assets/css/adminbooking.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
<style>
    .btn3 {
width: auto;
padding: 10px 32px;
background-color: #4169E1;
color: white;
border-radius: 5px;
text-align: center;
text-transform: capitalize;
cursor: pointer;
text-decoration: none;
border: solid 1px white;
margin: 0 auto;

}

.btn3:hover {
background-color: white;
color: #4169E1;
border: solid 1px #4169E1;
box-shadow: none;
}
</style>
    <title>Artlens</title>
</head>

<body>
   
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>
        
            <!--MAIN MAIN MAIN-->
            <main class="content px-3 py-2">
                <div class="container">
                    <div class="d-flex justify-content-end mt-3">
                        <button id="add-row" class="btn mb-3" style="background-color: #4169E1; color: white; margin-right: 10px;">Add Booking</button>
                        <form method="POST" action="generate_booking_report.php" target="_blank">
                            <button type="submit" class="btn float-end" name="pdf_creater" value="PDF"  style="background-color: #4169E1; color: white;">Export to File <i class="bi bi-file-earmark-pdf"></i></button>
                        </form>
                    </div>
                    <div >
                        <table id="myTable" class="table table-striped table-bordered" style="background-color: #ffffff;">
                            <thead style="background-color: #4169E1; color: white;">
                                <tr>
                                    <th>Organization Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Total</th>
                                    <th>Date and Time</th>
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
                                        
                                        echo "<tr class='clickable-row $row_class' data-info='" . $row["booking_id"] . "|" . $row["organization_name"] . "|" . $row["contact_email"] . "|" . $row["contact_number"] . "|" . $row["num_male"] . "|" . $row["num_female"] . "|" . $row["book_datetime"] . "|" . $row["book_status"] . "'>";
                                        echo "<td>" . $row["organization_name"] . "</td>";
                                        echo "<td>" . $row["contact_email"] . "</td>";
                                        echo "<td>" . $row["contact_number"] . "</td>";
                                        echo "<td>" . ($row["num_male"] + $row["num_female"]) . "</td>";
                                        echo "<td>" . $row["book_datetime"] . "</td>";
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
                                <div id="alertMessage" class="alert alert-primary d-none" role="alert">
                                    Form submitted successfully!
                                    <button type="button" class="btn-close float-end" aria-label="Close" onclick="dismissAlert()"></button>
                                </div>
                                <form id="bookingForm" name="bookingForm" action="booking.php" method="POST" onsubmit="handleSubmit(event)">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="onam" name="onam" type="text" placeholder="Organization Name" required maxlength="50">
                                    <label>Organization Name</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="emal" name="emal" type="email" placeholder="Email" required maxlength="50" oninput="checkEmail()">
                                    <label>Email</label>
                                    <div class="invalid-feedback"></div>
                                    <div id="emailStatus"></div><!-- Error message container -->
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="monu" name="monu" type="tel" placeholder="Mobile Number" required title="Please enter an 11-digit mobile number." maxlength="13">
                                    <label>Mobile Number</label>
                                    <div id="mobileStatus" class="invalid-feedback"></div> <!-- Error message container -->
                                </div>
                                <div class="row">
                                    <label class="form-label d-block">Number by Sex</label>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="numa" name="numa" type="number" placeholder="Number of Males" required min="0" max="50" oninput="this.value = this.value.slice(0, 2)">
                                            <label>Male</label>
                                            <span id="maleError" class="error-message"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="nufe" name="nufe" type="number" placeholder="Number of Females" required min="0" max="50" oninput="this.value = this.value.slice(0, 2)">
                                            <label>Female</label>
                                            <span id="femaleError" class="error-message"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="dati" name="dati" type="datetime-local" placeholder="Date and Time" required>
                                    <label>Date and Time</label>
                                    <div id="dateTimeError" class="invalid-feedback" style="display: none; color: #dc3545; font-size: smaller;"></div> <!-- Error message container -->
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" name="submit" class="btn3 mt-3" id="bookButton" style="width: 100%;" disabled>
                                        <span id="submitText">Book</span>
                                        <span id="loadingSpinner" class="visually-hidden">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </span>
                                    </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" action="bookingad.php" method="POST">
                                    <input type="hidden" id="modal-id" name="booking_id">
                                    <div class="mb-3">
                                        <label for="modal-name" class="form-label">Organization Name</label>
                                        <input type="text" class="form-control" id="modal-name" name="organization_name" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="modal-email" name="email" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-mobile" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" id="modal-mobile" name="mobile_number" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-nummale" class="form-label">Number of Male</label>
                                        <input type="number" class="form-control" id="modal-nummale" name="num_male" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-numfemale" class="form-label">Number of Female</label>
                                        <input type="number" class="form-control" id="modal-numfemale" name="num_female" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-date-time" class="form-label">Date and Time</label>
                                        <input type="datetime-local" class="form-control" id="modal-date-time" name="date_time" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-status" class="form-label">Status</label>
                                        <select id="modal-status" class="form-select" name="status" readonly>
                                            <option value="Pending">Pending</option>
                                            <option value="Confirmed">Confirmed</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>

                                    <div class="float-end" style="margin-bottom: 10px;">
                                        <button id="edit-button" type="button" class="btn btn-primary">Edit</button>
                                        <button id="save-button" type="submit" class="btn" style="background-color: green; color: white; display: none;">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#add-row').click(function () {
                            $('#infoModal').modal('show');
                        });
                        
                        
                        var table = new $('#myTable').DataTable();

                        table.on('draw', function () {
                            console.log('Redraw occurred at: ' + new Date().getTime());
                            $('.clickable-row').click(function () {
                            var rowData = $(this).data('info').split('|');
                            console.log(rowData);
                            $('#modal-id').val(rowData[0]);
                            $('#modal-name').val(rowData[1]);
                            $('#modal-email').val(rowData[2]);
                            $('#modal-mobile').val(rowData[3]);
                            $('#modal-nummale').val(rowData[4]);
                            $('#modal-numfemale').val(rowData[5]);
                            $('#modal-date-time').val(rowData[6]);
                            $('#modal-status').val(rowData[7]);
                            $('#myModal').modal('show');
                        });
                        });

                        
                    });
                </script>
             <script>
            $(document).ready(function () {
                // Function to enable editing mode
                $('#edit-button').click(function () {
                    // Enable input fields and dropdown for editing
                    $('#modal-status').prop('disabled', false); // Enable select element
                    $(this).hide(); // Hide edit button
                    $('#save-button').show(); // Show save changes button
                });

                // Function to save changes
                $('#save-button').click(function () {
                    // Disable input fields and dropdown after saving changes
                    $('#modal-name, #modal-email, #modal-mobile, #modal-total, #modal-date-time').prop('readonly', true);
                    $('#edit-button').show(); // Show edit button
                    $(this).hide(); // Hide save changes button

                    // Submit the form with updated status
                    $('#editForm').submit(); // This will submit the form to bookingad.php
                });

                // Initial setup: disable the status dropdown and hide the save button
                $('#modal-status').prop('disabled', true);
                $('#save-button').hide();
            });
            </script>
            </main>
                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
                <script src="sidebar/script.js"></script>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/bookvalidation.js"></script>
<script src="assets/js/bookvalidationinput.js"></script>

<?php
} else {
    header("Location: index.php");
    die();
}
?>

