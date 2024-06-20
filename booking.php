<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and sanitize user inputs (not necessary with prepared statements)
    $org_name = $_POST["onam"];
    $email = $_POST["emal"];
    $phone_number = $_POST["monu"];
    $num_female = $_POST["nufe"];
    $num_male = $_POST["numa"];
    $date_time = $_POST["dati"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO booking (organization_name, contact_email, contact_number, num_male, num_female, book_datetime, book_status) 
                            VALUES (?, ?, ?, ?, ?, ?, 'Pending')");

    // Bind parameters
    $stmt->bind_param("ssssss", $org_name, $email, $phone_number, $num_male, $num_female, $date_time);

    // Execute the query
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'Error executing statement: ' . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method';
}
