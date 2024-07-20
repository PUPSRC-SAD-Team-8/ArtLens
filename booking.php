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
    $user_otp = $_POST["otp"];
    if ($user_otp != $_SESSION['otp']) {
        echo "Invalid OTP";
        http_response_code(400);
        exit;
    }

    // Extract the date part from the datetime string
    $bookingDateOnly = date('Y-m-d', strtotime($date_time));

    // Check if there's already a booking for the same email on the same date
    $sql_check_booking = "SELECT COUNT(*) AS count FROM booking WHERE contact_email = ? AND DATE(book_datetime) = ?";
    $stmt_check_booking = $conn->prepare($sql_check_booking);
    $stmt_check_booking->bind_param("ss", $email, $bookingDateOnly);
    $stmt_check_booking->execute();
    $stmt_check_booking->bind_result($count);
    $stmt_check_booking->fetch();
    $stmt_check_booking->close();

    if ($count > 0) {
        // Booking exists for the same email on the same date
        http_response_code(400); // Bad Request
        echo 'exists_same_day';
        exit; // Exit to prevent further execution
    }

    // Prepare SQL statement for insertion
    $stmt_insert_booking = $conn->prepare("INSERT INTO booking (organization_name, contact_email, contact_number, num_male, num_female, book_datetime, book_status) 
                                           VALUES (?, ?, ?, ?, ?, ?, 'Pending')");
    // Bind parameters for insertion
    $stmt_insert_booking->bind_param("ssssss", $org_name, $email, $phone_number, $num_male, $num_female, $date_time);

    // Execute the insertion query
    if ($stmt_insert_booking->execute()) {
        echo 'success';
    } else {
        http_response_code(500); // Internal Server Error
        echo 'Error executing statement: ' . $stmt_insert_booking->error;
    }

    // Close statement for insertion
    $stmt_insert_booking->close();

    unset($_SESSION['otp']);

    // Close connection
    $conn->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method';
}
