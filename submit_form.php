<?php
session_start();
include('connection.php');

header('Content-Type: application/json'); // Set the content type to JSON

$response = array('status' => 'error', 'message' => 'An unknown error occurred.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array(); // Initialize an array to store error messages

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $errors[] = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $response['message'] = implode(' ', $errors);
    } else {
        // File upload is successful
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert form data into database
            $title = $conn->real_escape_string($_POST['title']);
            $description = $conn->real_escape_string($_POST['description']);
            $image_path = $conn->real_escape_string($target_file);

            $sql = "INSERT INTO submissions (image_path, title, description) VALUES ('$image_path', '$title', '$description')";

            if ($conn->query($sql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = 'New record created successfully.';
            } else {
                $response['message'] = 'Error: ' . $conn->error;
            }
        } else {
            $response['message'] = 'Sorry, there was an error uploading your file.';
        }
    }
}

$conn->close();
echo json_encode($response); // Return the response as JSON
?>
