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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
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
                        <a href="adminartwork.php" class="sidebar-link mx-2">
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
                        <a href="adminquiz.php" class="sidebar-link mx-2 active">
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
                <!-- Footer -->

            </div>
        </aside>
        
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom" style="background-color: white;">
                <button class="btn btn-white" type="button" style="background-color: white; color: #4169E1;">
                    <span class="fa-solid fa-bars" style="font-size: 20px;"></i></span>
                </button>
                <!--<div class="mx-auto text-center">
                    <span style="font-size: larger;"><b>Rizal Shrine</b></span>
                </div>-->
                    <div class="ms-auto" style="margin-right: 15px; margin-top: 8px;">
                    <a href="#" class="position-relative d-inline-block">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            9+ 
                        </span>
                    </a>
                </div>
            </nav>
            
            <!--MAIN MAIN MAIN-->
            <main class="content px-3 py-2">
            <div class="accordion" id="accordionExample">

    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Accordion Item #1
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
</body>

</html>
<?php
}else{
    
   header ("Location: index.php");
   die();
}
?>