<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and sanitize user inputs (not necessary with prepared statements)
    $email = $_POST["emal"];
    $date_time = $_POST["dati"];

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
        echo 'exists_same_day';
    } else {
        // No booking exists for the same email on the same date
        echo 'success';
    }

    // Close connection
    $conn->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method';
}
?>
