<?php
    session_start();
    include('connection.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $org_name = $_POST["onam"];
        $email = $_POST["emal"];
        $phone_number = $_POST["monu"];
        $num_female = $_POST["nufe"];
        $num_male = $_POST["numa"];
        $date_time = $_POST["dati"];
        
        $sql = "INSERT INTO booking (organization_name, contact_email, contact_number, num_male, num_female, book_datetime)
        VALUES ('$org_name', '$email', '$phone_number', '$num_male', '$num_female', '$date_time')";
        
        if ($conn->query($sql) === TRUE) {
            header('location:index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>