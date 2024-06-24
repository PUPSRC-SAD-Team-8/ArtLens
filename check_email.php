<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $bookingDate = $_POST["date"];

    // Extract the date part from the datetime string
    $bookingDateOnly = date('Y-m-d', strtotime($bookingDate));

    // Check if email exists in the database and if there are bookings on the same day
    $sql = "SELECT COUNT(*) AS count FROM booking WHERE contact_email = ? AND DATE(book_datetime) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $bookingDateOnly);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Email exists and has a booking on the same day
        echo 'exists_same_day';
    } else {
        // Email does not exist or no booking on the same day
        echo 'not_exists';
    }
} else {
    // Invalid request method
    echo 'error';
}
?>
