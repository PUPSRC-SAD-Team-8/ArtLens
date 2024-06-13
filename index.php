<?php
session_start();
include ('connection.php');

$displayModal = isset($_SESSION['msg']);

if(isset($_SESSION['id'])){
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLens</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/indexstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="assets/js/indexdrag.js" defer></script>
    <style>
        .wrapper{
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        

        }
        .wrapper i{
        top: 50%;
        height: 44px;
        width: 44px;
        color: #343F4F;
        cursor: pointer;
        font-size: 1.15rem ;
        position: absolute ;
        text-align: center ;
        line-height: 44px ;
        background: #fff ;
        border-radius: 50% ;
        transform: translateY(-50%) ;
        transition: transform 0.1s linear ;
        }
        .wrapper i:active{
        transform: translateY(-50%) scale(0.9);
        }
        .wrapper i:hover{
        background: #f2f2f2;
        }
        .wrapper i:first-child{
        left: -22px;
        display: none;
        }
        .wrapper i:last-child{
        right: -22px;
        }
        .wrapper .carousel{
        font-size: 0px;
        cursor: pointer;
        overflow: hidden;
        white-space: nowrap;
        scroll-behavior: smooth;
        }
        .carousel.dragging{
        cursor: grab;
        scroll-behavior: auto;
        }
        .carousel.dragging img{
        pointer-events: none;
        }
        .carousel img{
        height: 340px;
        object-fit: cover;
        user-select: none;
        margin-left: 14px;
        width: calc(100% / 3);
        }
        .carousel img:first-child{
        margin-left: 0px;
        }

        @media screen and (max-width: 900px) {
        .carousel img{
            width: calc(100% / 2);
        }
        }

        @media screen and (max-width: 550px) {
        .carousel img{
            width: 100%;
        }
        }
    </style>
</head>
<body>
    <nav class="head navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <h1 style="color: white; font-family: 'Arial Grook', sans-serif;"><b>ArtLens</b></h1>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="first-page d-flex justify-content-center align-items-center">
        <div class="container con1">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 text-center imgrizaldiv">
                    <img src="assets/images/lgs.png" class="img-fluid imgrizal" alt="Rizal Image" style="position: relative; z-index: 1;">
                </div>
                <div class="col-md-6 order-md-1" style="position: relative; z-index: 2;">
                    <h1 style="color: #4169E1;"><b>Rizal Shrine</b></h1>
                    <p style="color: grey;">The Rizal Shrine in Calamba (Filipino: Museo ni José Rizal Calamba) is a reproduction of the original two-story, Spanish-colonial style house in Calamba, Laguna where José Rizal was born on June 19, 1861. The house is designated as a National Shrine (Level 1) by the National Historical Commission of the Philippines.</p>
                    <div class="container mb-3 mt-5">
                        <div class="row">
                            <div class="col-lg-4" style="display: flex; align-items: start ;justify-content: start; margin-left: 0;">
                                <h3>Now Open</h3>
                            </div>
                            <div class="col-lg-5" style="display: flex;align-items: center;justify-content: center;">
                                <p>Open Tuesday - Sunday<br> 9:00 AM to 4:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <a href="visitorindex.php" class="cssbuttons-io-button" style="position: relative; z-index: 3; text-decoration: none; width: 45%; min-width: 260px; max-width: 260px;">
                      Explore the Museum
                      <div class="icon">
                          <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                          </svg>
                      </div>
                  </a>                
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br>

            <div class="container text-center">
                <div class="title">
                    <h1>Announcements</h1>
                </div>
                <div class="description">
                    <p>Stay tuned for updates, behind-the-scenes peeks, and exclusive events surrounding this exciting announcement. We can't wait to share this journey with you!</p>
                </div>
                <div class="wrapper">
                    <i id="left" class="fa-solid fa-angle-left" style="z-index: 1111; border: solid 1px #4169E1; background-color: #4169E1; color: white; margin-left: 25px;"></i>
                    <div class="carousel">
                        <img src="images/advisory.jpg" alt="img" draggable="false">
                        <img src="images/advisory.jpg" alt="img" draggable="false">
                        <img src="images/advisory.jpg" alt="img" draggable="false">
                        <img src="images/advisory.jpg" alt="img" draggable="false">
                        <img src="images/advisory.jpg" alt="img" draggable="false">
                        <img src="images/advisory.jpg" alt="img" draggable="false">
                    </div>
                    <i id="right" class="fa-solid fa-angle-right" style="border: solid 1px #4169E1; background-color: #4169E1; color: white; margin-right: 25px;"></i>
                    </div>
            </div>
  
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

    <br><br><br><br><br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2">
                <img src="assets/images/lp.png" class="img-fluid" alt="Your Image">
            </div>
            <div class="col-md-6 order-md-1">
                <h2>🎟️ Plan Your Visit to the Rizal Shrine</h2>
                <p>Excited to explore the life and legacy of Dr. Jose Rizal? Plan your visit to the Rizal Shrine today! Whether you're a solo traveler, a family seeking cultural enrichment, or a group interested in our guided tours, booking your visit is a breeze. Simply fill up the booking form to secure your preferred date and time slot. With our seamless booking process, you can look forward to an immersive experience delving into the life and ideals of our national hero. Join us at the Rizal Shrine and embark on a journey through history, enlightenment, and inspiration.</p>
                <button class="btn kulay" onclick="document.getElementById('myModal1').style.display='flex'">Book Visitation</button>&emsp;
                <div id="myModal1" class="modal1">
                    <div class="modal-content1">
                        <span class="close2 float-end mb-3" onclick="document.getElementById('myModal1').style.display='none'">&times;</span>
                        <h3 id="modalTitle" class="mt-2">Booking Form</h3>
                        <hr>
    
                        <div id="toggleButtons" class="d-flex justify-content-center mb-3">
                            <a type="button" class="btn-toggle form" onclick="showForm()">Form</a>
                            <a type="button" class="btn-toggle status" 
                            onclick="showStatus()">Status</a>
                        </div>

                        <!-- Booking Form -->
                        <div id="formContent">
                            <form id="bookingForm" action="booking.php" method="POST">
                                <input class="form-control" name="onam" type="text" placeholder="Organization Name" required>
                                <input class="form-control" name="emal" type="email" placeholder="Email" required>
                                <input class="form-control" name="monu" type="tel" placeholder="Mobile Number" required>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" name="numa" type="number" placeholder="Number of Male" required>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" name="nufe" type="number" placeholder="Number of Female" required>
                                    </div>
                                </div>
                                <input class="form-control" name="dati" type="datetime-local" placeholder="Date and Time" required>
                                
                                
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" name="submit" class="btn3 mt-3" style="width: 100%;">Book</button>
                                </div>
                            </form>
                        </div>

                        <!-- Status Content -->
                        <div id="statusContent" class="hidden">
                            <form id="statusForm" action="#" method="POST">
                                <input class="form-control" name="contact_email" type="text" placeholder="Search by Email" required>
                                <div id="imageContainer" style="margin-top: 10px; background-color: #FFFFFF; border-radius: 10px;">
                                    <!-- Add image with default message -->
                                    <center><img src="assets/images/status.png" alt="No information" id="noInfoImage"></center>
                                    <!-- Container for displaying message -->
                                    <div id="statusMessage" class="mt-3" style="margin: 10px; color: white;"></div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="button" onclick="checkStatus()" class="btn3" style="width: 100%;">Search Status</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
                <button class="btn kulay" onclick="document.getElementById('myModal2').style.display='flex'">Visit the Museum</button>
                <div id="myModal2" class="modal2">
                    <div class="modal-content2 p-4">
                        <span class="close3 float-end mb-3" onclick="document.getElementById('myModal2').style.display='none'">&times;</span>
                        <h3 class="mt-2">Log Form</h3>
                        <hr>
                        <form id="logForm" action="log.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="modal-status" class="form-label">Type</label>
                                <select id="modal-status" class="form-select" name="status" onchange="toggleFields()">
                                    <option name="status" value="Individual">Individual</option>
                                    <option name="status" value="Organization">Organization</option>
                                </select>
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" id="busno" name="busno" type="text" placeholder="C.N. Bus No." >
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" id="names" name="names" type="text" placeholder="Name" >
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" id="address" name="address" type="text" placeholder="Address" >
                            </div>
                            <div class="mb-3 individual">
                                <input class="form-control" id="fn" name="fn" type="text" placeholder="First Name" >
                            </div>
                            <div class="mb-3 individual">
                                <input class="form-control" id="ln" name="ln" type="text" placeholder="Last Name" >
                            </div>
                            <div class="mb-3 individual">
                                <input class="form-control" id="mo" name="mo" type="text" placeholder="MI(Optional)">
                            </div>
                            <div class="mb-3 individual">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="male" name="gen" value="Male" >
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="female" name="gen" value="Female" >
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="mb-3 individual">
                                <input class="form-control" id="email" name="email1" type="email" placeholder="Email" >
                            </div>
                            <div class="mb-3 individual">
                                <input class="form-control" id="mobile" name="monu1" type="number" placeholder="Mobile Number" >
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" id="nationality" name="nationality" type="text" placeholder="Nationality" >
                            </div>
                            <div class="row mb-3 organization">
                                <div class="col">
                                    <input class="form-control" id="numma" name="numma" type="number" placeholder="Number of Male" >
                                </div>
                                <div class="col">
                                    <input class="form-control" id="numfe" name="numfe" type="number" placeholder="Number of Female" >
                                </div>
                            </div>
                            <label for="numstudents" class="form-label organization">Number of Students</label>
                            <div class="mb-3 organization">
                                <input class="form-control" name="gs" type="number" placeholder="Grade School" >
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" name="hs" type="number" placeholder="High School" >
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" name="cls" type="number" placeholder="College/Grad School" >
                            </div>
                            <label class="form-label organization">PWD</label>
                            <div class="mb-3 organization">
                                <input class="form-control" name="pwd" type="number" placeholder="PWD" >
                            </div>
                            <label class="form-label organization">Number of Guests Based on Age Bracket</label>
                            <div class="mb-3 organization">
                                <input class="form-control" name="17below" type="number" placeholder="17 years old below" >
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" name="1930below" type="number" placeholder="19-30 years old" >
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" name="3159below" type="number" placeholder="31-59 years old" >
                            </div>
                            <div class="mb-3 organization">
                                <input class="form-control" name="60above" type="number" placeholder="60 years old above" >
                            </div>
                            
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" name="submit" class="btn btn3 w-100 mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="assets/images/rloob.png" class="img-fluid" alt="Placeholder Image" style="width: 600px;">
            </div>
            <div class="col-md-6 order-md-1">
                <h3>Art Discovery with Our Innovative Recognition System</h3>
                <p>Experience art in a whole new way at the Rizal Shrine with our cutting-edge art recognition system. Using advanced technology, our system allows visitors to interact with artworks in a dynamic and engaging manner. Simply point your smartphone or tablet at a piece of art, and watch as detailed information, artist biographies, and historical context come to life before your eyes. Dive deeper into the stories behind each masterpiece and gain a deeper appreciation for the artistic contributions that honor Dr. Jose Rizal's legacy. Explore our galleries with a fresh perspective and uncover hidden treasures waiting to be discovered through our innovative art recognition system.</p>
                <button class="btn kulay">Try our Image Recognition</button>
            </div>
        </div>
    </div>
    
    <br><br><br><br><br>
    <footer class="footer">
        <div class="container">
            <p>Museo ni Jose Rizal, Calamba, Laguna</p>
            <p>J. P. Rizal St., Cor. F. Mercado St., Brgy. 6 Poblacion, Calamba, Philippines</p>
        </div>
    </footer>
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        var modal = document.getElementById("myModal1");
        var span = document.getElementsByClassName("close2")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function showForm() {
            document.getElementById("formContent").classList.remove("hidden");
            document.getElementById("statusContent").classList.add("hidden");
            document.getElementById("modalTitle").textContent = "Booking Form";
            document.querySelector(".btn-toggle.form").style.backgroundColor = "#4169E1";
            document.querySelector(".btn-toggle.form").style.color = "white"; // Set text color to white
            document.querySelector(".btn-toggle.status").style.backgroundColor = "white";
            document.querySelector(".btn-toggle.status").style.color = "black"; // Set text color to black
        }

        function showStatus() {
            document.getElementById("formContent").classList.add("hidden");
            document.getElementById("statusContent").classList.remove("hidden");
            document.getElementById("modalTitle").textContent = "Booking Status";
            document.querySelector(".btn-toggle.form").style.backgroundColor = "white";
            document.querySelector(".btn-toggle.form").style.color = "black"; // Set text color to black
            document.querySelector(".btn-toggle.status").style.backgroundColor = "#4169E1";
            document.querySelector(".btn-toggle.status").style.color = "white"; // Set text color to white
        }

        // Set default text color
        document.querySelector(".btn-toggle.form").style.color = "white"; // Default text color for form button
        document.querySelector(".btn-toggle.status").style.color = "black"; // Default text color for status button


            </script>
            <script>
            function checkStatus() {
            // Retrieve the reference number
            var referenceNumber = document.querySelector('#statusContent input[name="contact_email"]').value;

            // AJAX request to send the reference number to check_status.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "check_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from check_status.php
                    document.getElementById('statusMessage').innerHTML = xhr.responseText;
                    // Hide the image when search is made
                    document.getElementById('noInfoImage').style.display = 'none';
                    // Change the background color to blue
                    document.getElementById('imageContainer').style.backgroundColor = '#4169E1';
                }
            };
            xhr.send("contact_email=" + referenceNumber); // Send the reference number as POST data
        }
</script>
<script>
function toggleFields() {
    var status = document.getElementById('modal-status').value;
    var organizationFields = document.querySelectorAll('.organization');
    var individualFields = document.querySelectorAll('.individual');

    if (status === 'Organization') {
        individualFields.forEach(element => element.removeAttribute('required'));
        organizationFields.forEach(function(field) {
            field.classList.remove('hidden');
             field.required = true;
        });
        individualFields.forEach(function(field) {
            field.classList.add('hidden');
            field.required = false;
        });
    } else {
        organizationFields.forEach(element => element.removeAttribute('required'));
        organizationFields.forEach(function(field) {
            field.classList.add('hidden');
            field.required = false;
        });
        individualFields.forEach(function(field) {
            field.classList.remove('hidden');
            field.required = true;
        });
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    toggleFields(); // Ensure the fields are toggled correctly on page load
});
</script>


</body>
</html>
