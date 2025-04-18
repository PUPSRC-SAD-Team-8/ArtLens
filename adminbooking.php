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

    .dropdown-menu {
        min-width: auto;
    }

    .dropdown-menu button {
        width: 100%;
    }
    .inactive-link {
  padding: 10px 20px;
  border: none;
  background-color: #f0f0f0;
  color: #333;
  font-size: 16px;
  border-radius: 10px;
  cursor: pointer;
  position: relative;
  box-shadow: inset 0 -4px 6px rgba(0, 0, 0, 0.2);
  transition: box-shadow 0.3s ease;
  text-decoration: none;
  }

  .inactive-link:hover {
      box-shadow: inset 0 -6px 8px rgba(0, 0, 0, 0.3);
  }

  .inactive-link:active {
      box-shadow: inset 0 -2px 4px rgba(0, 0, 0, 0.1);
  }
</style>
    <title>Artlens</title>
</head>

<body>
    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>

    <!-- MAIN MAIN MAIN -->
    <main class="content px-3 py-2">
    <br>
    <div class="container">
    <a href="adminbooking.php" class="active-link">On-Going</a>&emsp;
    <span><a href="adminbookingcomplete.php" class="inactive-link">Completed</a></span>
    </div>
    <div class="container">
    <div class="d-flex justify-content-end mt-3">
        <button id="add-row" class="btn mb-3" style="background-color: #4169E1; color: white; margin-right: 10px;">Add Booking</button>
        <form method="POST" action="generate_booking_report.php" target="_blank">
            <button type="submit" class="btn float-end" name="pdf_creater" value="PDF" style="background-color: #4169E1; color: white;">Export to File <i class="bi bi-file-earmark-pdf"></i></button>
        </form>
    </div>
    <div>
        <table id="myTable" class="table table-striped table-bordered" style="background-color: #ffffff;">
            <thead style="background-color: #4169E1; color: white;">
                <tr>
                    <th>Organization Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Total</th>
                    <th>Date and Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('connection.php');
                $current_date = date('Y-m-d H:i:s');

                // Update status to Completed for past bookings
                $update_sql = "UPDATE booking SET book_status='Completed' WHERE book_datetime < '$current_date' AND book_status != 'Completed'";
                $conn->query($update_sql);

                // Fetch only non-completed bookings
                $sql = "SELECT * FROM booking WHERE book_status != 'Completed'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["organization_name"] . "</td>";
                        echo "<td>" . $row["contact_email"] . "</td>";
                        echo "<td>" . $row["contact_number"] . "</td>";
                        echo "<td>" . ($row["num_male"] + $row["num_female"]) . "</td>";
                        echo "<td>" . $row["book_datetime"] . "</td>";
                        echo "<td class='status'>" . $row["book_status"] . "</td>";
                        echo "<td class='icon-dropdown'>
                            <div class='dropdown text-center'>
                                <ion-icon name='create-outline' class='edit-icon fs-3' style='cursor: pointer;' data-bs-toggle='dropdown' aria-expanded='false' onclick='toggleDropdown(this)'></ion-icon>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton" . $row["booking_id"] . "'>
                                    <li><button class='dropdown-item confirm-btn' data-id='" . $row["booking_id"] . "'>Confirm</button></li>
                                    <li><button class='dropdown-item cancel-btn' data-id='" . $row["booking_id"] . "'>Cancel</button></li>
                                </ul>
                            </div>
                        </td>";
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


        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div id="loadingAndCheck" style="display: none;">
                            <i id="checkIcon" class="bi bi-check-circle-fill text-success" style="font-size: 7rem; display: none;"></i>
                        </div>
                        <p id="successMessage">Booking status updated successfully.</p>
                        <br>
                        <button type="button" class="btn btn3 w-100" data-bs-dismiss="modal">Continue</button>
                    </div>
                </div>
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
                        <?php
                            // Fetch schedule data from the database
                            $schedule = mysqli_query($conn, "SELECT * FROM schedule");
                            $row = mysqli_fetch_assoc($schedule);
                            $startTime = date("H:i", strtotime($row['start_time']));
                            $endTime = date("H:i", strtotime($row['end_time']));
                            ?>
                        <form id="bookingForm" name="bookingForm" action="booking.php" method="POST" onsubmit="handleSubmit(event)">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="onam" name="onam" type="text" placeholder="Organization Name" required maxlength="50">
                                <label>Organization Name</label>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input class="form-control" id="monu" name="monu" type="tel" placeholder="Mobile Number" required title="Please enter an 11-digit mobile number." maxlength="13">
                                <label for="monu">Mobile Number</label>
                                <div id="mobileStatus" class="invalid-feedback"></div> <!-- Error message container -->
                            </div>
                            
                            <div class="mb-2">
                                    <div class="input-group">
                                        <div class="form-floating flex-grow-1">
                                            <input class="form-control" id="emal" name="emal" type="email" placeholder="Email" required maxlength="50">
                                            <label for="emal">Email</label>
                                            <div class="invalid-feedback"></div>
                                            <div id="emailStatus"></div><!-- Error message container -->
                                        </div>

                                    </div>
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

        <!-- JavaScript for handling dropdown actions -->
        <script>
          $(document).ready(function () {
            $('.confirm-btn').click(function () {
                var bookingId = $(this).data('id');
                updateBookingStatus(bookingId, 'Confirmed');
            });

            $('.cancel-btn').click(function () {
                var bookingId = $(this).data('id');
                updateBookingStatus(bookingId, 'Cancelled');
            });

            function updateBookingStatus(bookingId, status) {
                $.ajax({
                    url: 'bookingad.php',
                    type: 'POST',
                    data: {
                        booking_id: bookingId,
                        status: status
                    },
                    dataType: 'json', // Expect JSON response
                    beforeSend: function () {
                        $('#loadingAndCheck').hide(); // Hide loading and check elements before AJAX call
                        $('#loadingSpinner').show(); // Show loading spinner before AJAX call
                    },
                    success: function (response) {
                        $('#loadingSpinner').hide(); // Hide loading spinner on success
                        if (response.status === 'success') {
                            // Show check icon and success message
                            $('#checkIcon').show(); // Show check icon inside loadingAndCheck container
                            $('#successMessage').text('Booking status updated successfully.');
                            $('#loadingAndCheck').fadeIn(); // Show loading and check elements with fade-in effect
                            $('#successModal').modal('show');

                            // Automatically hide after 2 seconds
                            setTimeout(function () {
                                $('#successModal').modal('hide');
                                location.reload(); // Reload the page to see the updated status
                            }, 2000);
                        } else {
                            alert('Error updating status: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        $('#loadingSpinner').hide(); // Hide loading spinner on error
                        alert('An error occurred while updating the status. Please try again.');
                    }
                });
            }
        });


        $(document).ready(function () {
            $('#add-row').click(function () {
                $('#infoModal').modal('show');
            });
        });


            function handleSubmit(event) {
                event.preventDefault();
                $('#submitText').addClass('visually-hidden');
                $('#loadingSpinner').removeClass('visually-hidden');

                setTimeout(function () {
                    document.getElementById('alertMessage').classList.remove('d-none');
                    $('#submitText').removeClass('visually-hidden');
                    $('#loadingSpinner').addClass('visually-hidden');
                    $('#bookingForm')[0].reset();
                }, 2000);
            }

            function dismissAlert() {
                document.getElementById('alertMessage').classList.add('d-none');
            }

            const emailInput = document.getElementById('emal');
            const bookButton = document.getElementById('bookButton');

            emailInput.addEventListener('input', checkEmail);

            function checkEmail() {
                const email = emailInput.value;
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const emailStatus = document.getElementById('emailStatus');

                if (email.match(emailPattern) && !email.includes('.c0m')) {
                    emailStatus.textContent = '';
                    bookButton.disabled = false;
                } else {
                    emailStatus.textContent = 'Invalid email format.';
                    emailStatus.style.color = '#dc3545';
                    bookButton.disabled = true;
                }
            }

            const mobileInput = document.getElementById('monu');

            mobileInput.addEventListener('input', validateMobile);

            function validateMobile() {
                const mobile = mobileInput.value;
                const mobileStatus = document.getElementById('mobileStatus');
                const mobilePattern = /^(09\d{9}|\+639\d{9})$/;

                if (mobilePattern.test(mobile)) {
                    mobileStatus.textContent = '';
                    bookButton.disabled = false;
                } else {
                    mobileStatus.textContent = 'Invalid mobile number.';
                    bookButton.disabled = true;
                }
            }
        </script>

        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="sidebar/script.js"></script>
        <script src="assets/js/bookvalidation.js"></script>
        <script src="assets/js/bookvalidationinput.js"></script>

        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Output PHP variables as JavaScript variables
    const savedStartTime = '<?php echo date("h:i A", strtotime($startTime)); ?>';
    const savedEndTime = '<?php echo date("h:i A", strtotime($endTime)); ?>';

    const input = document.getElementById('dati');
    const now = new Date().toISOString().slice(0, 16);
    input.setAttribute('min', now);

    input.addEventListener('change', function() {
        const selectedDateTime = new Date(input.value);
        const selectedTime = formatTime(selectedDateTime);

        // Convert times to minutes since midnight for comparison
        const savedStartMinutes = convertToMinutes(savedStartTime);
        const savedEndMinutes = convertToMinutes(savedEndTime);
        const selectedMinutes = convertToMinutes(selectedTime);

        // Validate against saved schedule times
        if (selectedMinutes < savedStartMinutes || selectedMinutes > savedEndMinutes) {
            input.classList.add('input-error', 'border-red');
            displayErrorMessage(`Booking time must be between ${savedStartTime} and ${savedEndTime}.`);
            document.getElementById('bookButton').disabled = true;
        } else if (selectedMinutes < convertToMinutes('9:00 AM') || selectedMinutes > convertToMinutes('4:00 PM')) {
            // Validate against allowed business hours
            input.classList.add('input-error', 'border-red');
            displayErrorMessage("Only times between 9 AM and 4 PM are allowed.");
            document.getElementById('bookButton').disabled = true;
        } else {
            input.classList.remove('input-error', 'border-red');
            clearErrorMessage();
            document.getElementById('bookButton').disabled = false;
        }
    });

    function formatTime(date) {
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        return hours + ':' + minutes + ' ' + ampm;
    }

    function convertToMinutes(time) {
        const [hourMinute, period] = time.split(' ');
        let [hour, minute] = hourMinute.split(':').map(Number);
        if (period === 'PM' && hour !== 12) hour += 12;
        if (period === 'AM' && hour === 12) hour = 0;
        return hour * 60 + minute;
    }

    function displayErrorMessage(message) {
        const errorContainer = document.getElementById('dateTimeError');
        errorContainer.textContent = message;
        errorContainer.style.display = 'block';
    }

    function clearErrorMessage() {
        const errorContainer = document.getElementById('dateTimeError');
        errorContainer.textContent = '';
        errorContainer.style.display = 'none';
    }
});
</script>
        
    </main>
</body>
</html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>
