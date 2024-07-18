<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = $_POST['booking_id'];
    $status = $_POST['status'];

    if (!empty($bookingId) && !empty($status)) {
        $sql = "UPDATE booking SET book_status = ? WHERE booking_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $bookingId);

        if ($stmt->execute()) {
            // Success response for AJAX
            echo json_encode(array('status' => 'success'));
        } else {
            // Error response for AJAX
            echo json_encode(array('status' => 'error', 'message' => 'Error updating booking status: ' . $stmt->error));
        }

        $stmt->close();
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid input.'));
    }

    $conn->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method.'));
}
?>
