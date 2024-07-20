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
            .active-link {
        color: white;
        background-color: #4169E1;
        padding: 10px;
        border-radius: 10px;
        text-decoration: none;
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
        <?php include('sidebar.php'); ?>

                <!--MAIN MAIN MAIN-->
                <main class="content px-4 py-3">
                    <div class="container">
                    <h1 style="color: grey;" class="mb-4">Manage Announcement</h1>
                    <a href="adminan.php" class="active-link">Announcement</a>&emsp;
                    <span><a href="adminan2.php" class="inactive-link">Schedule</a></span></div>
                            <div class="container d-flex justify-content-center"> 
                            <?php
                            // Fetch schedule data from the database
                            $schedule = mysqli_query($conn, "SELECT * FROM schedule");
                            $row = mysqli_fetch_assoc($schedule);
                            $startTime = date("H:i", strtotime($row['start_time']));
                            $endTime = date("H:i", strtotime($row['end_time']));
                            ?>

                            <form action="adminannouncements.php" method="post">
                                <div class="d-flex flex-column">
                                    <!-- Left Column: Input Fields -->
                                    <div class="mb-4" style="min-width: 300px;">
                                        <label for="modal-openclose" class="form-label">Status</label>
                                        <select id="modal-openclose" class="form-select mb-3" name="openclose" required>
                                            <option value="" disabled>Select Museum Status</option>
                                            <option value="Now Open" <?php if ($row['museum_status'] == "Now Open") echo "selected"; ?>>Now Open</option>
                                            <option value="Now Closed" <?php if ($row['museum_status'] == "Now Closed") echo "selected"; ?>>Now Closed</option>
                                        </select>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="description" id="description" type="text" placeholder="Open Dates" value="<?php echo $row['description']; ?>" required>
                                            <label for="description">Open Dates</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="startTime" id="startTime" type="time" placeholder="Start Time" value="<?php echo $startTime; ?>" required>
                                            <label for="startTime">Start Time</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="endTime" id="endTime" type="time" placeholder="End Time" value="<?php echo $endTime; ?>" required>
                                            <label for="endTime">End Time</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn3 w-100" name="update_schedule">Submit</button>
                            </form>

                            <script>
                                // Output PHP variables as JavaScript variables
                                const savedStartTime = '<?php echo $startTime; ?>';
                                const savedEndTime = '<?php echo $endTime; ?>';
                            </script>
                        </div>

                            
                </main>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="sidebar/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="sidebar/script.js"></script>
    </body>

    </html>
<?php
} else {

    header("Location: index.php");
    die();
}
?>












