<?php
session_start();
include ('connection.php');

if(isset($_POST['contact_email'])) {
    // Sanitize the input to prevent SQL injection
    $contactEmail = mysqli_real_escape_string($conn, $_POST['contact_email']);
    
    $sql = "SELECT * FROM booking WHERE contact_email = '$contactEmail'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo " <br>";
            echo "<h3>".$row["organization_name"] . "</h3>","<br>";
            echo "Email: " . $row["contact_email"] . "<br>";
            echo "Number: " . $row["contact_number"] . "<br>";
            echo "Total: ".$row["num_male"]+$row["num_female"] . "<br>";
            echo "Date and Time: " . $row["book_datetime"] . "<br>";
            echo '<div  class="mt-3" style="border: 1px solid white; padding: 10px 40px 10px 40px; display: inline-block; border-radius: 5px;">';
            echo $row["book_status"] . "<br>";
            echo '</div>'. "<br>";
            
            echo "<br>";
        }
    } else {
        echo "No booking found with the provided contact email.";
    }
} else {
    echo json_encode(["error" => "Contact email is not provided."]);
}

$conn->close();
?>
