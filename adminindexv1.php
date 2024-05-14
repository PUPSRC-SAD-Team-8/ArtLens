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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <title>Artlens</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" style="position: relative; ">

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
                        <a href="adminindex.php" class="sidebar-link mx-2 active">
                            <i class="fa-regular fa-address-card pe-2"></i>
                            Manage Account
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="adminartwork.php" class="sidebar-link mx-2 ">
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
                <br>
                <div class="container" style="margin-top: -2.5% !important;">
                    <div class="row">
                      <div class="col-sm" >
                        <br>
                        <div class=" contentprofile" style="background-color: white; height: 320px;">
                            <br><br>
                        <center><img src="assets/images/image.png" style="width: 15%; height: auto; min-width: 150px; ">
                        <br><br><h2>Hello, Admin User</h2></center></div>
                      </div>
                      <div class="col-sm col-lg">
                        <br>
                        <a><i class="fa-solid fa-pen-to-square" style="float: right; margin-right: 15px; margin-top: 15px; font-size: 24px;"></i></a>

                        <div class="contentprofile1" style="padding: 50px; background-color: white; width: 100%; height: 320px; min-width: 400px;">
                        <div style="width: 100%;"><h3><b>Personal Information</b></h3>
                        <hr style="width: 35%; background-color: #4169E1; padding: 0.3px;">
                        <input class="form-control input1 mb-3" type="text" placeholder="Admin Name" name="admin name">
                        <input class="form-control input1 mb-3" type="text" placeholder="Admin Id" name="admin id">
                    </div>
                      </div>
                      
                      </div>

                      <div class="col-sm">
                        <form action="changepassword.php" enctype="multipart/form-data" method="post" >
                        <div class="contentprofile2" style="padding: 50px !important; background-color: white; min-width: 1215px;">
                        <h3><b>Password</b></h3>
                        <hr style="width: 100%; background-color: #4169E1; padding: 0.3px;">
                 
                        <input class="input1" placeholder="Current Password" name="currentpassword">
                        <br> 
                        <input class="input1"  placeholder="New Password" name="newpassword">
                        <br>
                        <button class="btn btn-primary" type=submit style="float: right; margin-left: 16%; background-color: #4169E1;">Change Password</button>     
                        </div></form>
                      
                      </div>
                    </div>
                  </div>

           

 
<?php
}else{
    
   header ("Location: index.php");
   die();
}
?>