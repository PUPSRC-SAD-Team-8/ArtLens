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
    <title>Artlens</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="sidebar/style.css">
    <link rel="stylesheet" href="assets/css/adminartwork.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <style> 
        .homebtn {
            padding: 10px !important;
            background-color: #4169E1 !important;
            color: white !important;
            border-radius: 5px !important;
            text-decoration: none !important;
            width: 100%;
        }
        .homebtn:hover {
            background-color: white !important; 
            border: 1px solid #4169E1 !important;
            color: #4169E1 !important;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>
            <!-- Main Content -->
            <main class="content px-3 py-2">
                <div id="artModal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="height: 700px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addArtworkModalLabel">Add Artwork</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="overflow-y: auto;">
                                <form class="add-form" enctype="multipart/form-data" action="submitartwork.php" method="POST">
                                    <div class="mb-3">
                                        <label for="image-upload" class="form-label">Upload Image</label>
                                        <input type="file" id="image-upload" name="image" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="titleInput" class="form-label">Title</label>
                                        <input class="form-control" type="text" id="titleInput" name="title" required max="50">
                                    </div>
                                    <div class="mb-3">
                                        <label for="artistInput" class="form-label">Artist</label>
                                        <input class="form-control" type="text" id="artistInput" name="artist" required max="50">
                                    </div>
                                    <div class="mb-3">
                                        <label for="yearInput" class="form-label">Year</label>
                                        <input class="form-control" type="number" id="yearInput" name="year" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mediumInput" class="form-label">Medium</label>
                                        <input class="form-control" type="text" id="mediumInput" name="medium" required max="50">
                                    </div>
                                    <div class="mb-3">
                                        <label for="descriptionInput" class="form-label">Description</label>
                                        <textarea class="form-control" id="descriptionInput" name="description" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn homebtn">Add Artwork</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Button -->
                <div class="container">
                    <div class="row justify-content-end mt-3">
                        <div class="col-md-6 col-lg-4">
                            <div class="input-group">
                                <input class="form-control" type="search" id="searchInput" placeholder="Search" aria-label="Search">
                                <button id="sort-button" class="btn btn-secondary ms-2" data-sort="asc"><i class="bi bi-sort-alpha-up"></i></button>
                                <button id="add-box" class="btn btn-primary ms-2">Add Artwork</button>
                            </div>
                        </div>
                    </div>

                    <!-- Artwork Boxes -->
                    <div class="container mt-3">
                        <div class="row" id="artworkContainer">
                            <?php
                            // Modify SQL query to fetch artworks without default ordering
                            $sql = "SELECT * FROM artwork";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='col-lg-3 col-md-4 col-sm-6 col-6 grid-container mt-3'>";
                                    echo "<div class='card artwork-card' data-bs-toggle='modal' data-bs-target='#cardModal'
                                            data-id='" . $row["artwork_id"] . "' 
                                            data-title='" . $row["artwork_name"] . "' 
                                            data-image='" . $row["artwork_img"] . "' 
                                            data-artist='" . $row["artwork_artist"] . "'  
                                            data-year='" . $row["artwork_year"] . "'  
                                            data-medium='" . $row["artwork_medium"] . "'  
                                            data-desc='" . $row["artwork_description"] . "'>";
                                    echo "<img src='" . $row["artwork_img"] . "' class='card-img-top image' height='200' width='150' alt='Artwork Image'>";
                                    echo "<div class='card-title text-center'>" . $row["artwork_name"] . "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<div class='col-12 text-center mt-3'>No artworks found.</div>";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Card Modal -->
                    <!-- Card Modal -->
                <div id="cardModal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Artwork Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <center><img id="modal-image" class="img-fluid" alt="Artwork Image"></center>
                                <br>
                                <form id="editArtworkForm">
                                    <div class="mb-3">
                                        <input type="file" class="form-control" id="modal-image-input" name="modal-image">
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-title-input" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="modal-title-input" name="modal-title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-artist-input" class="form-label">Artist</label>
                                        <input type="text" class="form-control" id="modal-artist-input" name="modal-artist">
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-year-input" class="form-label">Year</label>
                                        <input type="text" class="form-control" id="modal-year-input" name="modal-year">
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-medium-input" class="form-label">Medium</label>
                                        <input type="text" class="form-control" id="modal-medium-input" name="modal-medium">
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal-description-input" class="form-label">Description</label>
                                        <textarea class="form-control" id="modal-description-input" name="modal-description" rows="3"></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                </div>
                </main>

                <!-- Bootstrap JS and jQuery -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
                <script src="sidebar/script.js"></script>
            
                <script>
    $(document).ready(function() {
        var originalArtworks = []; // Array to store original artworks order

        // Fetch initial artworks order
        $('#artworkContainer').children('.col-lg-3, .col-md-4, .col-sm-6, .col-6').each(function() {
            originalArtworks.push($(this));
        });

        // Sorting button click event
        $('#sort-button').click(function() {
            var sortDirection = $(this).data('sort');

            // Toggle sorting direction
            if (sortDirection === 'asc') {
                $(this).data('sort', 'desc').html('<i class="bi bi-sort-alpha-up"></i>').css('background-color', '#4169E1');
                sortArtworks('asc');
            } else if (sortDirection === 'desc') {
                $(this).data('sort', 'original').html('<i class="bi bi-sort-alpha-down"></i>').css('background-color', '#4169E1');
                sortArtworks('desc');
            } else {
                $(this).data('sort', 'asc').html('<i class="bi bi-sort-alpha-up"></i>').css('background-color', ''); // Reset to default background
                sortArtworks('original');
            }
        });

        // Function to sort artworks based on title
        function sortArtworks(direction) {
            var artworks;

            if (direction === 'original') {
                artworks = originalArtworks;
            } else {
                artworks = $('#artworkContainer').children('.col-lg-3, .col-md-4, .col-sm-6, .col-6').get();

                artworks.sort(function(a, b) {
                    var titleA = $(a).find('.card-title').text().toUpperCase();
                    var titleB = $(b).find('.card-title').text().toUpperCase();

                    if (direction === 'asc') {
                        return (titleA < titleB) ? -1 : (titleA > titleB) ? 1 : 0;
                    } else {
                        return (titleA > titleB) ? -1 : (titleA < titleB) ? 1 : 0;
                    }
                });
            }

            $.each(artworks, function(index, element) {
                $('#artworkContainer').append(element);
            });
        }

        // Other script for modal and search functionality remains the same
        $('#add-box').click(function() {
            $('#artModal').modal('show');
        });

        // Function to handle live search
        $('#searchInput').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            filterArtworks(searchText);
        });

        // Function to filter artworks based on search text
        function filterArtworks(searchText) {
            var artworks = $('#artworkContainer').children();
            artworks.each(function() {
                var artworkName = $(this).find('.card-title').text().toLowerCase();
                if (artworkName.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Handling artwork card click to show modal with details
       $('#artworkContainer').on('click', '.artwork-card', function() {
    var title = $(this).data('title');
    var image = $(this).data('image');
    var artist = $(this).data('artist');
    var year = $(this).data('year');
    var medium = $(this).data('medium');
    var description = $(this).data('desc');
    var artworkId = $(this).data('id'); // Make sure this is set

    // Populate modal fields
    $('#modal-image').attr('src', image);
    $('#modal-title-input').val(title).data('id', artworkId); // Store artworkId in data attribute
    $('#modal-artist-input').val(artist);
    $('#modal-year-input').val(year);
    $('#modal-medium-input').val(medium);
    $('#modal-description-input').val(description);

    // Show the modal
    $('#cardModal').modal('show');
});

$('#saveChangesBtn').click(function() {
    var updatedTitle = $('#modal-title-input').val();
    var updatedArtist = $('#modal-artist-input').val();
    var updatedYear = $('#modal-year-input').val();
    var updatedMedium = $('#modal-medium-input').val();
    var updatedDescription = $('#modal-description-input').val();
    var artworkId = $('#modal-title-input').data('id'); // Retrieve artworkId from data attribute

    // Create a FormData object to handle file uploads
    var formData = new FormData();
    formData.append('title', updatedTitle);
    formData.append('artist', updatedArtist);
    formData.append('year', updatedYear);
    formData.append('medium', updatedMedium);
    formData.append('description', updatedDescription);
    formData.append('artworkId', artworkId);

    // Check if a new image file is selected
    var imageFile = $('#modal-image-input')[0].files[0]; // Ensure the input field for image exists and is used
    if (imageFile) {
        formData.append('image', imageFile);
    }

    // AJAX request to update artwork details
    $.ajax({
        url: 'updateartwork.php',
        method: 'POST',
        data: formData,
        processData: false, // Important for file uploads
        contentType: false, // Important for file uploads
        success: function(response) {
            console.log(response);
            $('#cardModal').modal('hide');
            // Redirect to adminartwork.php after successful update
            window.location.href = 'adminartwork.php';
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
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