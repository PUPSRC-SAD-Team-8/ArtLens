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
    <title>Artlens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/adminartwork.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
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

            <!-- Main Content -->
            <main class="content px-3 py-2">
                <div id="artModal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <span class="close ms-auto" data-bs-dismiss="modal" style="margin-right: 10px; margin-top: 5px;">&times;</span>
                            <center><h3>Add Artwork</h3></center>
                            <form class="add-form" enctype="multipart/form-data" action="submitartwork.php" method="POST" style="padding: 20px;">
                                <input type="file" id="image-upload" name="image" class="form-control mb-3" accept="image/*">
                                <input class="form-control input1 mb-3" type="text" placeholder="Title" name="title">
                                <input class="form-control input1 mb-3" type="text" placeholder="Artist" name="artist">
                                <input class="form-control input1 mb-3" type="text" placeholder="Year" name="year">
                                <input class="form-control input1 mb-3" type="text" placeholder="Medium" name="medium">
                                <textarea class="form-control input1 mb-3" type="text" placeholder="Description" name="description"></textarea>
                                <button type="submit" class="btn btn-primary float-end">Add Artwork</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add Button -->
                <div class="mx-auto mt-3">
                    <div class="d-flex justify-content-between">
                        <form class="form-inline mx-auto">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="min-width: 400px;">
                                <div class="input-group-append">
                                    <button class="btn" style="background-color: #4169E1; color: white;" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                        <button id="add-box" class="btn btn-primary" style="background-color: #4169E1; color: white; margin-right:25px;">Add Artwork</button>
                    </div>
                </div>

                <!-- Artwork Boxes -->
                <!-- Main Content -->
                <main class="content px-3 py-2">
                    <!-- Artwork Boxes -->
                    <div class="container">
                        <div class="row">
                            <?php
                            include('connection.php');
                            $sql = "SELECT * FROM artwork";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row_num = 0; // Initialize row number counter
                                while ($row = $result->fetch_assoc()) {
                                    $row_num++; // Increment row number for each iteration
                                    // Determine row class based on row number for alternating colors
                                    $row_class = ($row_num % 2 == 0) ? "even-row" : "odd-row";

                                    // Generate HTML for each artwork box
                                    echo "<div class='col-lg-3 col-md-4 col-sm-6 col-6 grid-container mt-3'>";
                                    echo "<div class='card' data-toggle='modal' data-target='#cardModal' data-title='" . $row["artwork_name"] . "' data-image='" . $row["artwork_img"] . "' data-artist='" . $row["artwork_artist"] . "'  data-year='" . $row["artwork_year"] . "'  data-medium='" . $row["artwork_medium"] . "'  data-desc='" . $row["artwork_description"] . "' >";
                                    echo "<img src='" . $row["artwork_img"] . "' class='card-img-top image' height='200' width='150' alt='Artwork Image'>";
                                    echo "<div class='card-title text-center'>" . $row["artwork_name"] . "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Card Modal -->
                    <div id="cardModal" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <center><img id="modal-image" class="img-fluid" alt="Artwork Image"></center>
                                    <br>
                                    <p><b>Artist: </b><span id="modal-artist"></span></p>
                                    <p><b>Year: </b><span id="modal-year"></span></p>
                                    <p><b>Medium: </b><span id="modal-medium"></span></p>
                                    <p><b>Description: </b><span id="modal-description"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>


    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="script.js"></script>

    
</body>
</html>
<script>$(document).ready(function() {
    $('#add-box').click(function() {
        // Show the modal
        $('#artModal').modal('show');
    });
});</script>
<script>
$(document).ready(function() {
    // Add click event listener to artwork box
    $('.card').click(function() {
        // Extract artwork information
        var title = $(this).data('title');
        var image = $(this).data('image');
        var description = $(this).data('desc');
        var artist = $(this).data('artist');
        var medium = $(this).data('medium');
        var year = $(this).data('year');
console.log(title ,year ,image ,description ,artist, medium);
        // Populate modal with artwork information
        $('#modal-title').text(title);
        $('#modal-image').attr('src', image);
        $('#modal-artist').text(artist);
        $('#modal-year').text(year);
        $('#modal-medium').text(medium);
        $('#modal-description').text(description);

        // Show the modal
        $('#cardModal').modal('show');
    });

    $('#add-box').click(function() {
        // Show the modal
        $('#artModal').modal('show');
    });
});
</script>

<?php
}else{
    
   header ("Location: index.php");
   die();
}
?>