<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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
                        <a href="adminindex.php" class="sidebar-link mx-2">
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
                        <a href="adminbooking.php" class="sidebar-link mx-2 active">
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

                    <div class="d-flex justify-content-end mt-3">
                        <button id="add-row" class="btn mb-3" style="background-color: #4169E1; color: white;">Add Booking</button>
                    </div>

<div class="table-container" style="max-height: 400px; overflow-y: auto;">
                        <table id="myTable" class="table table-striped table-bordered"  style="background-color: #ffffff;">
                            <thead style="background-color: #4169E1; color: white;">
                                <tr>
                                    <th>Quiz Name</th>
                                    <th>Length</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr data-bs-toggle="collapse" data-bs-target="#quiz1" aria-expanded="true" aria-controls="flush-collapseOne">
                                <td>Quiz 1</td>
                                <td>10</td>
                                <td>Active</td>
                            </tr>
                            
                            </tbody>
                            <tr>
                                <td colspan="3" class="p-0">
                                <div class="collapse" id="quiz1">
                                    <div class="card card-body">
                                    Additional content for Quiz 1
                                    </div>
                                </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    

                    
     
            
                <!-- Modal -->
                <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="infoModalLabel">Quiz Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="infoForm" action="bookingad.php" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Quiz Title</label>
                                        <input class="form-control" type="text" name="qtitle" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInput" name="emal" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mnumberInput" class="form-label">Mobile Number</label>
                                        <input type="number" class="form-control" id="mnumberInput" name="monu" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nummInput" class="form-label">Number of Male</label>
                                        <input type="number" class="form-control" id="nummInput" name="nufe" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nummInput" class="form-label">Number of Female</label>
                                        <input type="number" class="form-control" id="nummInput" name="numa" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateInput" class="form-label">Date and Time</label>
                                        <input type="datetime-local" class="form-control" id="dateInput" name="dati" required>
                                    </div>

                                    <button type="submit" name="submit" class="btn float-end" style="background-color: #4169E1; color: #ffffff;">Submit</button>
                                </form>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            
                <script>
                    $(document).ready(function () {
                        $('#add-row').click(function () {
                            $('#infoModal').modal('show');
                        });
                    });
                </script>
            </main>
        </div>
        <!--END MAIN-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

