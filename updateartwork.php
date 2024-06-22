<?php
session_start();
include('connection.php'); // Ensure this file has your database connection

// Check if all required POST parameters are set
if (isset($_SESSION['userid'], $_POST['title'], $_POST['artist'], $_POST['year'], $_POST['medium'], $_POST['description'], $_POST['artworkId'])) {
    // Sanitize input data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $artist = mysqli_real_escape_string($conn, $_POST['artist']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $medium = mysqli_real_escape_string($conn, $_POST['medium']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $artworkId = mysqli_real_escape_string($conn, $_POST['artworkId']);

    // Update SQL query
    $sql = "UPDATE artwork SET 
            artwork_name = '$title', 
            artwork_artist = '$artist', 
            artwork_year = '$year', 
            artwork_medium = '$medium', 
            artwork_description = '$description' 
            WHERE artwork_id = '$artworkId'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request parameters.";
}

$conn->close();
?>
