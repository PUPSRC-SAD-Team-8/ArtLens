<?php
	session_start();
	include('connection.php');
    
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["fn"];
    $mid_name = $_POST["mo"];
    $last_name = $_POST["ln"];
    $email = $_POST["email1"];
    $mobile_number = $_POST["monu1"];
    $gender = $_POST["gen"];

    
    
    // SQL query to insert booking into database
    $sql = "INSERT INTO visitor_log (log_first_name, log_mid_name, log_last_name, log_contact_email, log_contact_number, log_gender)
            VALUES ('$first_name', '$mid_name', '$last_name', '$email', '$mobile_number', '$gender')";

    if ($conn->query($sql) === TRUE) {
    
        header('location:index.php');

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>