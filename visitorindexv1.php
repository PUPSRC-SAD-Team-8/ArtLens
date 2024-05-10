<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLens</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/visitorindex.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <style>


    </style>
</head>
<body>
    <nav class="head navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <h1 style="color: white; font-family: Merriweather, serif;">ArtLens</h1>
            <a class="nav-link admin-login-mobile btn1" href="index.php">Home</a>
        </div>
    </nav>
    <div class="container" style="margin-top: 44px;"> <!-- Adjusted margin-top to move the container downwards -->
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 grid-container" style="max-width: 175px; padding: 0; margin: 1px;">
                <a href="#" class="card" data-description="${description}">
                    <img src="assets/images/lp.png" class="card-img-top image" alt="Artwork Image">
                    <div class="card-title text-center">Title</div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 grid-container" style="max-width: 175px; padding: 0; margin: 1px;">
                <a href="#" class="card" data-description="${description}">
                    <img src="assets/images/lp.png" class="card-img-top image" alt="Artwork Image">
                    <div class="card-title text-center">Title </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 grid-container" style="max-width: 175px; padding: 0; margin: 1px;">
                <a href="#" class="card" data-description="${description}">
                    <img src="assets/images/lp.png" class="card-img-top image" alt="Artwork Image">
                    <div class="card-title text-center">Title </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 grid-container" style="max-width: 175px; padding: 0; margin: 1px;">
                <a href="#" class="card" data-description="${description}">
                    <img src="assets/images/lp.png" class="card-img-top image" alt="Artwork Image">
                    <div class="card-title text-center">Title </div>
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end fixed-bottom fixed-end p-3">
    <div class="fixed-button">
        <button class="btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-plus"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a type="button" href="visitorartrecog.php" class="dropdown-item" type="button"> <i class="fa-solid fa-camera"></i>&emsp;Art Recognition</a></li>
            <hr>
            <li><a type="button" href="visitorquiz.php" class="dropdown-item" type="button"><i class="fa-regular fa-file"></i>&emsp;Quiz</a></li>
        </ul>
    </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>


  <!-- EXAMPLE ONLY  EXAMPLE ONLY EXAMPLE ONLY EXAMPLE ONLY EXAMPLE ONLY EXAMPLE ONLY EXAMPLE ONLY EXAMPLE ONLY EXAMPLE ONLY-->