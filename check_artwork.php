<?php
include('connection.php');

$input = json_decode(file_get_contents('php://input'), true);
$artworkName = $input['artwork_name'];

$sql = "SELECT * FROM artwork WHERE artwork_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $artworkName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'exists' => true,
        'artwork_img' => $row['artwork_img'],
        'artwork_name' => $row['artwork_name'],
        'artwork_artist' => $row['artwork_artist'],
        'artwork_year' => $row['artwork_year'],
        'artwork_medium' => $row['artwork_medium'],
        'artwork_description' => $row['artwork_description']
    ]);
} else {
    echo json_encode(['exists' => false]);
}

$stmt->close();
$conn->close();
?>
