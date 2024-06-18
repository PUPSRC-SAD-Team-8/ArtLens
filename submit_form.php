<?php
session_start();
include('connection.php');

$errors = array(); // Initialize an array to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $errors[] = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    // For now, allow any file size, so the check is commented out
    /*
    if ($_FILES["image"]["size"] > 500000) {
        $errors[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    */

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // Prepare error messages for display in JavaScript
        echo '<script>';
        foreach ($errors as $error) {
            echo 'alert("' . $error . '");';
        }
        echo '</script>';
    } else {
        // File upload is successful
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert form data into database
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image_path = $target_file;

            $sql = "INSERT INTO submissions (image_path, title, description) VALUES ('$image_path', '$title', '$description')";

            if ($conn->query($sql) === TRUE) {
                
                header("Location: adminannouncements.php");
                echo '<script>alert("New record created successfully.");</script>';
                exit();
            } else {
                echo '<script>alert("Error: ' . $sql . '\\n' . $conn->error . '");</script>';
            }
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
        }
    }
}

$conn->close();
?>