<?php
include('connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the POST request contains the required data
if (isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['year']) && isset($_POST['medium']) && isset($_POST['description']) && isset($_POST['artworkId'])) {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $year = $_POST['year'];
    $medium = $_POST['medium'];
    $description = $_POST['description'];
    $artworkId = $_POST['artworkId'];

    // Initialize the update query
    $update_query = "UPDATE artwork SET artwork_name=?, artwork_artist=?, artwork_year=?, artwork_medium=?, artwork_description=? WHERE artwork_id=?";
    $params = [$title, $artist, $year, $medium, $description, $artworkId];
    $types = "sssssi";

    // Check if a new image file is uploaded
    if (!empty($_FILES['image']['name'])) {
        // Define the target directory
        $target_dir = 'images/';
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $image = $target_file; // Store the full path including the 'images/' prefix

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Update the query to include the image
            $update_query = "UPDATE artwork SET artwork_img=?, artwork_name=?, artwork_artist=?, artwork_year=?, artwork_medium=?, artwork_description=? WHERE artwork_id=?";
            $params = [$image, $title, $artist, $year, $medium, $description, $artworkId];
            $types = "ssssssi";
        } else {
            echo "There was a problem updating the image.";
            exit;
        }
    }

    // Prepare and bind
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param($types, ...$params);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Artwork updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "All fields are required.";
}

// Close the connection
$conn->close();
?>