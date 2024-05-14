<?php
	include('connection.php');
//$art_image = $_POST['image'];
$art_title = $_POST['title'];
$art_artist = $_POST['artist'];
$art_year = $_POST['year'];
$art_medium = $_POST['medium'];
$art_description = $_POST['description'];
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imagefile = strtolower($target_file);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagefile) && !empty($art_title) && !empty($art_artist) && !empty($art_year) && !empty($art_medium) && !empty($art_description) )  {
    $sql = "INSERT INTO artwork (artwork_name, artwork_img, artwork_artist, artwork_year, artwork_medium, artwork_description) VALUES ('$art_title' , '$imagefile' , '$art_artist' , '$art_year' , '$art_medium' , '$art_description')";

    if ($conn->query($sql) === TRUE) {
        header('location:adminartwork.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();

  } else {
    echo "Sorry, there was an error uploading your file.";
  }


?>