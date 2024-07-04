<?php
session_start();
include('connection.php');

if (isset($_SESSION['userid'])) {

    if (isset($_POST["confirm_update"])) {
        $update_id = $_POST['update-id'];
        $update_title = $_POST['update-title'];
        $update_desc = $_POST['update-desc'];

        // Check if a new image file is uploaded
        if ($_FILES['update-image']['name'] !== '') {
            // Update the image file and move it to the target directory
            $target = basename($_FILES['update-image']['name']);
            $image = $_FILES['update-image']['name'];

            if (move_uploaded_file($_FILES['update-image']['tmp_name'], $target)) {
                $update_query = "UPDATE `submissions` SET image_path = '$image', title = '$update_title', description = '$update_desc' WHERE id = '$update_id'";
            } else {
                // Handle the case when image upload fails
                $msg = "There was a problem updating the image.";
                // You can add further error handling here if needed.
            }
        } else {
            // No new image selected, update only the other fields
            $update_query = "UPDATE `submissions` SET title = '$update_title', description = '$update_desc' WHERE id = '$update_id'";
        }

        // Execute the update query
        if (isset($update_query)) {
            mysqli_query($conn, $update_query);
            header('Location: adminannouncements.php');
            exit();
        }
    }

    if (isset($_POST["update_schedule"])) {
        // Retrieve form data
        $openclose = $_POST['openclose'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $description = $_POST['description'];

        $query = "UPDATE schedule SET museum_status= '$openclose', start_time= '$startTime', end_time= '$endTime', description = '$description' WHERE sched_id = 1";
        // Execute the update query
        if (isset($query)) {
            mysqli_query($conn, $query);
            header('Location: adminannouncements.php');
            exit();
        }
    }
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />

        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/annstyle.css" />
        <link rel="stylesheet" href="assets/css/adminannouncement.css" />
        <style>
            .calendar-container {
                display: none;
                /* Hide by default */
            }
        </style>
        <title>Artlens</title>
    </head>

    <body>
        <?php include('sidebar.php'); ?>

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
                                    <form action="adminannouncements.php" method="post" enctype="multipart/form-data" class="border p-4 shadow rounded" style="min-width: 350px; max-width: 450px;">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image:</label>
                                            <input type="file" class="form-control" id="image" name="image" accept=".png, .jpeg, .jpg" required>
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
                                $sql = "SELECT id, image_path, title, description FROM submissions ORDER BY id DESC";
                                $result = $conn->query($sql);
                                $cards = "";
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $cards .= '<div class="card swiper-slide">
                                            <div class="img-box" style="height: 350px; position: relative;">
                                                <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                                    <button type="button" class="update_btn" data-id="' . $row["id"] . '" 
                                                        data-image="' . $row["image_path"] . '" 
                                                        data-title="' . htmlspecialchars($row["title"]) . '" 
                                                        data-description="' . htmlspecialchars($row["description"]) . '">Edit</button>
                                                </div>
                                                <img src="' . $row["image_path"] . '" alt="" class="image" />
                                                <div class="overlay">
                                                    <div class="text">
                                                        <h2>' . htmlspecialchars($row["title"]) . '</h2>
                                                        <p>' . htmlspecialchars($row["description"]) . '</p>
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
                                    <form action="adminannouncements.php" method="post">
                                        <div class="d-flex flex-column">
                                            <!-- Left Column: Input Fields -->
                                            <?php
                                            $schedule = mysqli_query($conn, "SELECT * FROM schedule");
                                            $row = mysqli_fetch_assoc($schedule);
                                            ?>
                                            <div class="mb-4" style="min-width: 300px;">
                                                <label for="modal-openclose" class="form-label">Status</label>
                                                <select id="modal-openclose" class="form-select mb-3" name="openclose" required>
                                                    <option value="" disabled>Select Museum Status</option>
                                                    <option value="Now Open" <?php if ($row['museum_status'] == "Now Open") echo "selected"; ?>>Now Open</option>
                                                    <option value="Now Closed" <?php if ($row['museum_status'] == "Now Closed") echo "selected"; ?>>Now Closed</option>
                                                </select>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="description" id="description" type="text" placeholder="Open Dates" value="<?php echo $row['description']; ?>" required>
                                                    <label for="endTime">Open Dates</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="startTime" id="startTime" type="time" placeholder="Start Time" value="<?php echo date("H:i", strtotime($row['start_time'])); ?>" required>
                                                    <label for="startTime">Start Time</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="endTime" id="endTime" type="time" placeholder="End Time" value="<?php echo date("H:i", strtotime($row['end_time'])); ?>" required>
                                                    <label for="endTime">End Time</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn3 w-100" name="update_schedule">Submit</button>
                                    </form>
                                </div>
                            </div>
                            
                </main>
            </div>
            <!--END MAIN-->
        </div>

        <!--modal-->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="update-id" id="update-id">

                            <div class="form-group">
                                <label>Current Image</label>
                                <img src="" class="img-fluid img-thumbnail" id="update-image-preview">
                            </div>

                            <div class="form-group">
                                <label>Update Image</label>
                                <input type="file" class="form-control" id="update-image" name="update-image" accept=".png, .jpeg, jpg">
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" id="update-title" name="update-title" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="update-desc" name="update-desc" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="confirm_update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="sidebar/script.js"></script>
        <script src="assets/js/swiper-bundle.min.js"></script>
        <script src="assets/js/carscript.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="sidebar/script.js"></script>
        <script>
            $(document).ready(function() {
                $('.update_btn').on('click', function() {
                    var id = $(this).data('id');
                    var image = $(this).data('image');
                    var title = $(this).data('title');
                    var description = $(this).data('description');

                    // Populate modal fields
                    $('#editForm').attr('action', 'adminannouncements.php?id=' + id); // Adjust action attribute if necessary
                    $('#update-id').val(id);
                    $('#update-image-preview').attr('src', image);
                    $('#update-title').val(title);
                    $('#update-desc').val(description);

                    // Show the modal
                    $('#editmodal').modal('show');
                });
            });


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