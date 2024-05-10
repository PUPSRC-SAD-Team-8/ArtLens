<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/adminartwork.css">
    <title>Artlens</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" style="position: relative;">
            <div class="h-100">
                <center>
                    <br>
                    <img src="assets/images/image.png" class="img-fluid" style="width: 70px;" alt="logo">
                    <div class="sidebar-logo">
                        <h4 style="color: #4169E1;"><b>ArtLens</b></h4>
                        <hr>
                    </div>
                </center>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="adminindex.php" class="sidebar-link mx-2 ">
                            <i class="fa-regular fa-address-card pe-2"></i>
                            Manage Account
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="adminartwork.php" class="sidebar-link mx-2 active">
                            <i class="fa-solid fa-palette pe-2"></i>
                            Artworks
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="adminannouncements.php" class="sidebar-link mx-2 ">
                            <i class="fa-solid fa-bullhorn pe-2"></i>
                            Announcements
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="adminquiz.php" class="sidebar-link mx-2 ">
                            <i class="fa-regular fa-newspaper pe-2"></i>
                            Quiz
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="adminbooking.php" class="sidebar-link mx-2 ">
                            <i class="fa-solid fa-book-open pe-2"></i>
                            Booking
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="adminvisitorlog.php" class="sidebar-link mx-2 ">
                            <i class="fa-solid fa-person pe-2"></i>
                            Visitor Log
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="logout.php" class="sidebar-link mx-2" style="margin-top: 30%; color: red;" >
                            <i class="fa-solid fa-right-from-bracket pe-2"></i>
                             Logout
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom" style="background-color: white;">
                <button class="btn btn-white" type="button" style="background-color: white; color: #4169E1;">
                    <span class="fa-solid fa-bars" style="font-size: 20px;"></i></span>
                </button>
                <div class="mx-auto">
                    <form class="form-inline my-2 my-lg-0">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append" style="background-color: #4169E1; border-radius: 0 10px 10px 0; border: 0px;">
                                <button class="btn" type="submit" style="color: white;">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ms-auto" style="margin-right: 15px; margin-top: 8px;">
                    <a href="#" class="position-relative d-inline-block">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            9+ 
                        </span>
                    </a>
                </div>
            </nav>

            <!-- MAIN MAIN MAIN -->
            <main class="content px-3 py-2">
                <div id="artModal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <span class="close ms-auto" data-bs-dismiss="modal" style="margin-right: 10px; margin-top: 5px;">&times;</span>
                            <center><h3>Add Artwork</h3></center>
                            <form class="add-form" enctype="multipart/form-data" style="padding: 20px;">
                                <input type="file" id="image-upload" name="image-upload" class="form-control mb-3" accept="image/*">
                                <input class="form-control input1 mb-3" type="text" placeholder="Title" name="title">
                                <input class="form-control input1 mb-3" type="text" placeholder="Description" name="description">
                                <button type="submit" class="btn btn-primary float-end">Add Artwork</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add Button -->
                <div class="position-fixed top-4 end-0 m-4">
                    <button id="add-box" class="btn btn-primary rounded-circle fs-5">+</button>
                </div>

                <!-- Insights -->
                <section id="boxes">
                    <div class="container">
                        <div class="row" id="box-container">
                            <!-- Initially, no boxes -->
                        </div>
                    </div>
                </section>

                <div id="cardModal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <center><img id="modal-image" class="img-fluid" alt="Artwork Image"></center>
                                <p id="modal-description"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </main>
        </div>
        <!-- END MAIN -->
    </div>

    <!-- Bootstrap JS and jQuery (required for Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>

<!-- Updated addBox function -->
<!-- Updated addBox function -->
<script>
    $(document).ready(function() {
        // Function to add a new box
        function addBox(imageSrc, title, description) {
            var boxHtml = `
                <div class="col-lg-3 col-md-4 col-sm-6 grid-container">
                    <a href="#" class="card" data-description="${description}">
                        <img src="${imageSrc}" class="card-img-top image" alt="Artwork Image">
                        <div class="card-title">${title}</div>
                    </a>
                </div>`;
                
            $('#box-container').append(boxHtml);
        }

        $('#add-box').click(function() {
            // Show the modal
            $('#artModal').modal('show');
        });

        $('.add-form').submit(function(e) {
            e.preventDefault(); 

            var title = $('[name="title"]').val();
            var description = $('[name="description"]').val();
            var fileInput = $('#image-upload')[0];
            
            if (title && description && fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imageSrc = e.target.result;
                    addBox(imageSrc, title, description);
                };
                reader.readAsDataURL(fileInput.files[0]);

                // Hide the modal
                $('#artModal').modal('hide');

                // Reset the form
                $('.add-form')[0].reset();
            } else {
                // Show an alert if either image, title, or description is missing
                alert('Please provide an image, title, and description.');
            }
        });
        
        // Click event for showing modal with image, title, and description
        $('#box-container').on('click', '.card', function(e) {
            e.preventDefault();
            var imageSrc = $(this).find('.image').attr('src');
            var title = $(this).find('.card-title').text();
            var description = $(this).data('description');

            // Update the modal title
            var modalTitle = document.getElementById('modal-title');
            modalTitle.innerText = 'Title: ' + title;

            // Set other modal content
            $('#modal-image').attr('src', imageSrc);
            $('#modal-description').text(description);
            $('#cardModal').modal('show');
        });
    });
</script>