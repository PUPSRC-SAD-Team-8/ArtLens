<?php
// Database connection settings
include('connection.php');

// Get the POST data
$userId = $_POST['userId'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$middleInitial = $_POST['middleInitial'];
$employeeId = $_POST['employee_id'];
$email = $_POST['email'];
$mobileNumber = $_POST['mobileNumber'];

// Update the user data
$sql = "UPDATE login SET firstName=?, lastName=?, middleInitial=?, employee_id=?, email=?, mobileNumber=? WHERE userid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $firstName, $lastName, $middleInitial, $employeeId, $email, $mobileNumber, $userId);

if ($stmt->execute()) {
    // Redirect back to adminaccount.php with success message
    $stmt->close();
    $conn->close();
    
    header("Location: adminaccount.php?update_success=1");
    exit();
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

