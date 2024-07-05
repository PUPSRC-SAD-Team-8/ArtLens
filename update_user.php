<?php
session_start();
include('connection.php');

if (isset($_POST['userId'])) {
    $userId = intval($_POST['userId']);
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $middleInitial = htmlspecialchars(trim($_POST['middleInitial']));
    $employeeId = htmlspecialchars(trim($_POST['employee_id']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mobileNumber = htmlspecialchars(trim($_POST['mobileNumber']));

    // Update user data in the database
    $sql = "UPDATE login SET firstName = ?, lastName = ?, middleInitial = ?, employee_id = ?, email = ?, mobileNumber = ? WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $firstName, $lastName, $middleInitial, $employeeId, $email, $mobileNumber, $userId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
