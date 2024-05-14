<?php
if (isset($_POST['image'])) {
    // Decode base64 image data
    $imageData = base64_decode(str_replace('data:image/jpeg;base64,', '', $_POST['image']));

    // Save the image to a file
    $filename = 'uploads/' . uniqid() . '.jpg';
    file_put_contents($filename, $imageData);

    // Optionally, you can perform further processing on the image or save it to a database
    echo "Image uploaded successfully. Image path: $filename";
} else {
    echo "No image data received.";
}
?>
