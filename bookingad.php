<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['booking_id']) && !empty($_POST['booking_id'])) {
        // Update existing booking
        $booking_id = $_POST['booking_id'];
        $org_name = $_POST["organization_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["mobile_number"];
        $num_male = $_POST["num_male"];
        $num_female = $_POST["num_female"];
        $status = $_POST["status"]; // Ensure the status value is retrieved correctly

        $sql = "UPDATE booking SET 
                organization_name = ?, 
                contact_email = ?, 
                contact_number = ?, 
                num_male = ?, 
                num_female = ?, 
                book_status = ?
                WHERE booking_id = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("sssiisi", $org_name, $email, $phone_number, $num_male, $num_female, $status, $booking_id);

        if ($stmt->execute()) {
            header('location:adminbooking.php');
        } else {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }

        $stmt->close();
    } else {
        // Insert new booking
        $org_name = $_POST["onam"];
        $email = $_POST["emal"];
        $phone_number = $_POST["monu"];
        $num_male = $_POST["numa"];
        $num_female = $_POST["nufe"];
        $date_time = $_POST["dati"];

        $sql = "INSERT INTO booking (organization_name, contact_email, contact_number, num_male, num_female, book_datetime, book_status)
                VALUES (?, ?, ?, ?, ?, ?, 'Pending')"; // Set default status to 'Pending' for new bookings

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("sssiis", $org_name, $email, $phone_number, $num_male, $num_female, $date_time);

        if ($stmt->execute()) {
            header('location:adminbooking.php');
        } else {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }

        $stmt->close();
    }
    $conn->close();
}
?>
