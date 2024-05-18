<?php
session_start();
include('connection.php');

$displayModal = isset($_SESSION['msg']);

if (isset($_SESSION['id'])) {
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
    <link href="https://cdn.jsdelivr.net/npm/air-datepicker@3.5.0/air-datepicker.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="head navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <h1 style="color: white; font-family: 'Arial Grook', sans-serif; "><b>ArtLens</b></h1>
            <a class="nav-link admin-login-mobile btn1 adminlogbtn" onclick="document.getElementById('myModal').style.display='flex'">Admin Login</a>
        </div>
    </nav>

    <!-- Login Modal -->
    <div id="myModal" class="modal" style="<?php if ($displayModal) echo 'display: flex; ' ?>">
        <div class="modal-content">
            <span class="close3 " onclick="document.getElementById('myModal').style.display='none'" style="position: absolute; top: 1px; right: 20px; ">&times;</span> <!-- Adjust position as needed -->
            <br><br><br>
            <center><b>
                    <h3 style="font-size: 150%; font-family: sans-serif; color: #4169E1;">ARTLENS
                </b></h3>
                <br>
                <p style="margin: 0px 15% 0px 15%;">Journey Through the Heart of Rizal: Where History Comes to Life</p>
            </center>
            <br>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?><br>
            <form action="login.php" method="POST">

                <input class="form-control input1" style="background-color: #eee;" type="email" name="uname" placeholder="Email" required>
                <div class="input-group">
                    <input class="form-control input1" type="password" style="background-color: #eee;" name="pass" id="pass" placeholder="Password" required>
                    <div class="input-group-append">
                        <button class="form-control shadow-none" type="button" id="togglePassword">Show</button>
                    </div>
                </div>
                <div class="forgot-pass" style="margin-top: 1%; float: right;">
                    <a href="forgotpassword.php">Forgot Password?</a>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" name="submit" class="btn3">Login</button>
                </div>

            </form>

        </div>
    </div>

    <div class="first-page d-flex justify-content-center align-items-center">
        <div class="container con1">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 text-center imgrizaldiv">
                    <img src="assets/images/rizal.png" class="img-fluid imgrizal" alt="Rizal Image" style="position: relative; z-index: 1;">
                </div>
                <div class="col-md-6 order-md-1" style="position: relative; z-index: 2;">
                    <h1><b>Rizal Shrine</b></h1>
                    <p style="color: grey;">The Rizal Shrine in Calamba (Filipino: Museo ni José Rizal Calamba) is a reproduction of the original two-story, Spanish-colonial style house in Calamba, Laguna where José Rizal was born on June 19, 1861. The house is designated as a National Shrine (Level 1) by the National Historical Commission of the Philippines.</p>
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
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="footerblue" style="margin-top: -20%; position: relative; z-index: 0;">
            <path fill="#4169E1" fill-opacity="1" d="M0,256L120,261.3C240,267,480,277,720,234.7C960,192,1200,96,1320,48L1440,0L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
        </svg>
    </div>


    <br><br><br><br><br>
    <div class="container text-center">
        <div class="title">
            <h1>Announcements</h1>
        </div>
        <div class="description">
            <p>Stay tuned for updates, behind-the-scenes peeks, and exclusive events surrounding this exciting announcement. We can't wait to share this journey with you!</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <div class="box">
                    <img src="assets/images/sched.png" alt="Placeholder Image">
                    <div class="content">
                        <h3>Schedule</h3>
                        <p>Opens Tuesday to Sunday</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="box">
                    <img src="assets/images/sched.png" alt="Placeholder Image">
                    <div class="content">
                        <h3>Events</h3>
                        <p>Join us as we celebrate the beauty of History.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="box">
                    <img src="assets/images/sched.png" alt="Placeholder Image">
                    <div class="content">
                        <h3>Schedule</h3>
                        <p>Opens Tuesday to Sunday</p>
                    </div>
                </div>
            </div>
        </div>
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
                        <h3 class="mt-2">Booking Form</h3>
                        <hr>
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
                            <input class="form-control" id="dati" type="text" placeholder="Date and Time" required readonly>
                            <input name="dati" type="text" placeholder="Date and Time" required hidden>
                            <input class="form-control" name="othe" type="text" placeholder="Other">
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn3">Book</button>
                            </div>
                        </form>
                    </div>
                </div>
                <button class="btn kulay" onclick="document.getElementById('myModal2').style.display='flex'">Visit the Museum</button>
                <div id="myModal2" class="modal2">
                    <div class="modal-content2">
                        <span class="close2 float-end mb-3" onclick="document.getElementById('myModal2').style.display='none'">&times;</span>
                        <h3 class="mt-2">Log Form</h3>
                        <hr>
                        <form id="logForm" action="log.php" method="POST">
                            <input class="form-control" name='fn' type="text" placeholder="First Name" required>
                            <input class="form-control" name='ln' type="text" placeholder="Last Name" required>
                            <input class="form-control" name='mo' type="text" placeholder="MI(Optional)" required>
                            <div class="gender">Gender:
                                <input type="radio" id="male" name="gen" value="Male" required>
                                <label for="male">Male</label>
                                <input type="radio" id="female" name="gen" value="Female" required>
                                <label for="female">Female</label>
                                <input type="radio" id="other" name="gen" value="Other" required>
                                <label for="other">Other</label>
                            </div>
                            <input class="form-control" name='email1' type="email" placeholder="Email" required>
                            <input class="form-control" name='monu1' type="tel" placeholder="Mobile Number" required>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn3">Submit</button>
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
                <button type="button" class="btn kulay" onclick="location.href='visitorartrecog.php';">Try our Image Recognition</button>
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
    <script src="assets/js/input-validator.js"></script>
    <script type="module" src="assets/js/visitor-index.js" defer></script>

</body>

</html>

<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("loginBtn");
    var span = document.getElementsByClassName("close1")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var loginForm = document.getElementById("loginForm");
    var errorMessage = document.getElementById("errorMessage");

    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();

        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;


        if (username === "correct_username" && password === "correct_password") {

            console.log("Login successful");


            modal.style.display = "none";
        } else {
            errorMessage.textContent = "Wrong username or password.";
            modal.style.display = "block";
        }
    });
</script>
<script>
    // JavaScript to toggle password visibility
    const togglePasswordBtn = document.getElementById("togglePassword");
    const passwordField = document.getElementById("pass");

    togglePasswordBtn.addEventListener("click", function() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePasswordBtn.textContent = "Hide";
        } else {
            passwordField.type = "password";
            togglePasswordBtn.textContent = "Show";
        }
    });
</script>