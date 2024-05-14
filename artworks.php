<?php
	session_start();
	include('connection.php');
    
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image_name = $_POST["img/"];
    $title_name = $_POST["titl"];
    $description_name = $_POST["desc"];
    

    

    // SQL query to insert booking into database
    $sql = "INSERT INTO art (artwork_name, artwork_img, art_description)
            VALUES ('$image_name', '$title_name', '$description_name')";

    if ($conn->query($sql) === TRUE) {
    
        header('location:index.php');

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>