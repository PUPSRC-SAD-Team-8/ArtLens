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
       <!-- Swiper CSS -->
       <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />

<!-- CSS -->
<link rel="stylesheet" href="assets/css/annstyle.css" />
<link rel="stylesheet" href="assets/css/adminannouncement.css" />
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
                <div class="container">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Add Announcement
                </button>
                </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <center><form action="submit_form.php" method="post" enctype="multipart/form-data" class="border p-4 shadow rounded" style="min-width: 350px; max-width: 450px;">
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
                        </form></center>
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
                                <div class="accordion-body">
                                <p>Museum Schedule</p>
                                </div>
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
                                    <p>Museum Closure</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </main>
        </div>
        <!--END MAIN-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/carscript.js"></script>
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
}else{
    
   header ("Location: index.php");
   die();
}
?>