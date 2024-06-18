<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if email exists in the database and if there are future bookings
    $sql = "SELECT COUNT(*) AS count, MAX(book_datetime) AS max_date FROM booking WHERE contact_email = '$email'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            $maxDate = strtotime($row['max_date']);
            $today = strtotime(date('Y-m-d H:i:s'));

            if ($count > 0 && $maxDate > $today) {
                // Email exists and has future bookings
                echo 'exists_future';
            } else {
                // Email exists but no future bookings or past bookings
                echo 'exists_past';
            }
        } else {
            // Email does not exist
            echo 'not_exists';
        }
    } else {
        // Query execution error
        echo 'error';
    }
} else {
    // Invalid request method
    echo 'error';
}
?>
