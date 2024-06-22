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
        <link rel="stylesheet" href="assets/css/sidebar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />

        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/annstyle.css" />
        <link rel="stylesheet" href="assets/css/adminannouncement.css" />
        <style>
    .calendar-container {
      display: none; /* Hide by default */
    }
  </style>
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
                <main class="content px-4 py-3">
                    <div class="accordion" id="accordionExample" style="background-color: white;">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Add Announcement
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <center>
                                    <form action="submit_form.php" method="post" enctype="multipart/form-data" class="border p-4 shadow rounded" style="min-width: 350px; max-width: 450px;">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image:</label>
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description:</label>
                                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                        </div>
                                        <button type="submit" class="btn3" style="width: 100%;">Submit</button>
                                    </form>
                                </center>
                                <hr>
                                <?php
                                // Display submissions
                                $sql = "SELECT image_path, title, description FROM submissions ORDER BY id DESC";
                                $result = $conn->query($sql);
                                $cards = "";
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $cards .= '<div class="card swiper-slide">
                                        <div class="img-box" style="height: 350px; position: relative;"> <!-- Added position: relative; -->
                                            <div style="position: absolute; top: 10px; right: 10px; z-index: 10;"> <!-- Edit button -->
                                                <button>Edit</button>
                                            </div>
                                            <img src="' . $row["image_path"] . '" alt="" class="image" />
                                            <div class="overlay">
                                                <div class="text">
                                                    <h2>' . $row["title"] . '</h2>
                                                    <p>' . $row["description"] . '</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                            }
                                    } else {
                                    // Display "No updates today" if there are no submissions
                                    $cards = '<div class="card swiper-slide">
                                    <div class="img-box" style="height: 350px; border: 1px solid #4169E1;">
                                        <div class="text-center" style="margin:10px;">
                                            <h2>No updates today</h2>
                                            <p>There are no announcements at this time. Please check back later for updates.</p>
                                            <center>
                                                <img src="assets/images/void.png" style="max-width: 60%; max-height: 60%; height: auto; width: auto;">
                                            </center>
                                        </div>
                                    </div>
                                </div>';
                                }
                                ?>
                                <div class="container1 swiper">
                                    <div class="slide-container">
                                        <div class="card-wrapper swiper-wrapper">
                                            <?php echo $cards; ?>
                                        </div>
                                    </div>
                                    <div class="swiper-button-next swiper-navBtn"></div>
                                    <div class="swiper-button-prev swiper-navBtn"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Museum Schedule
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body d-flex justify-content-center">
                                    <form>
                                        <div class="d-flex flex-row align-items-center">
                                            <!-- Left Column: Input Fields -->
                                            <div class="me-4 mb-4" style="min-width: 300px;">
                                                <label for="modal-openclose" class="form-label">Status</label>
                                                <select id="modal-openclose" class="form-select mb-3" name="openclose" required>
                                                    <option value="" disabled selected>Select Museum Status</option>
                                                    <option value="Individual">Now Open</option>
                                                    <option value="Organization">Now Closed</option>
                                                </select>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="startTime" id="startTime" type="time" placeholder="Start Time" required>
                                                    <label for="startTime">Start Time</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="endTime" id="endTime" type="time" placeholder="End Time" required>
                                                    <label for="endTime">End Time</label>
                                                </div>
                                            </div>
                                            <!-- Right Column: Checkboxes -->
                                            <div class="ml-4 mb-4">
                                                <label>Days of the Week</label><br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="sunday" value="sunday">
                                                    <label class="form-check-label" for="sunday">Sunday</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="monday" value="monday">
                                                    <label class="form-check-label" for="monday">Monday</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="tuesday" value="tuesday">
                                                    <label class="form-check-label" for="tuesday">Tuesday</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="wednesday" value="wednesday">
                                                    <label class="form-check-label" for="wednesday">Wednesday</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="thursday" value="thursday">
                                                    <label class="form-check-label" for="thursday">Thursday</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="friday" value="friday">
                                                    <label class="form-check-label" for="friday">Friday</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="saturday" value="saturday">
                                                    <label class="form-check-label" for="saturday">Saturday</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn3 w-100">Submit</button>
                                    </form>
                                </div>
                            </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Museum Closure
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <form action="submit.php" method="POST">
                                    <div class="row d-flex align-items-center" >
                                    <div class="col-md-6 d-flex align-items-center"" >
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary" id="datePickerBtn"><i class="fas fa-calendar-alt"></i> Pick a Date</button>
                                        </div>
                                        <input type="text" class="form-control d-none" id="selectedDate" name="selectedDate" placeholder="Select date" autocomplete="off">
                                        </div>
                                        <div id="calendarContainer" class="calendar-container mt-4">
                                        <div id="datepicker"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                        <input class="form-control" name="titleclosure" id="titleclosure" type="text" placeholder="Title" required>
                                        <label for="titleclosure">Title</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                        <input class="form-control" name="desclosure" id="desclosure" type="text" placeholder="Description" required>
                                        <label for="desclosure">Description</label>
                                        </div>  
                                    </div><div class="text-center">
                                        <button type="submit" class="btn3 w-40">Submit</button>
                                        </div>
                                    </div>
                                    
                                </form>
                        </div>
                    </div>
                </main>
            </div>
            <!--END MAIN-->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="script.js"></script>
        <script src="assets/js/swiper-bundle.min.js"></script>
        <script src="assets/js/carscript.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
  $(document).ready(function() {
    // Initialize date picker
    $('#datepicker').datepicker({
      format: 'yyyy-mm-dd', // Adjust date format as needed
      autoclose: true
    });

    // Show/hide calendar on button click
    $('#datePickerBtn').click(function() {
      $('#calendarContainer').toggle();
    });

    // Handle date selection
    $('#datepicker').on('changeDate', function(e) {
      var selectedDate = $('#datepicker').datepicker('getFormattedDate');
      $('#selectedDate').val(selectedDate); // Update hidden input value
      $('#calendarContainer').hide(); // Hide calendar after selection
    });
  });
</script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get all cards
                const cards = document.querySelectorAll('.card');

                // Function to toggle overlay
                function toggleOverlay(card) {
                    const overlay = card.querySelector('.overlay');
                    if (overlay.classList.contains('active')) {
                        overlay.classList.remove('active');
                    } else {
                        // Close any other open overlay
                        cards.forEach(card => {
                            card.querySelector('.overlay').classList.remove('active');
                        });
                        // Open the clicked overlay
                        overlay.classList.add('active');
                    }
                }

                // Add click event listener to each card
                cards.forEach(card => {
                    card.addEventListener('click', function() {
                        toggleOverlay(this);
                    });

                    // Add touchstart event listener for mobile devices
                    card.addEventListener('touchstart', function(e) {
                        e.preventDefault(); // Prevent default touch behavior
                        toggleOverlay(this);
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