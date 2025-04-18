<?php
include('connection.php');

// Get current date
$current_date = date('Y-m-d H:i:s');

// Update status to Completed for past bookings
$update_sql = "UPDATE booking SET book_status='Completed' WHERE book_datetime < '$current_date' AND book_status != 'Completed'";
$conn->query($update_sql);

// Fetch weekly data
$weeklyData = [];
$weekly_sql = "SELECT WEEK(book_datetime) as week, COUNT(*) as visitors FROM booking WHERE book_status != 'Completed' GROUP BY WEEK(book_datetime)";
$weekly_result = $conn->query($weekly_sql);
while ($row = $weekly_result->fetch_assoc()) {
    $weeklyData[] = $row;
}

// Fetch monthly data
$monthlyData = [];
$monthly_sql = "SELECT MONTHNAME(book_datetime) as month, COUNT(*) as visitors FROM booking WHERE book_status != 'Completed' GROUP BY MONTH(book_datetime)";
$monthly_result = $conn->query($monthly_sql);
while ($row = $monthly_result->fetch_assoc()) {
    $monthlyData[] = $row;
}

$conn->close();

// Return data as JSON
echo json_encode(['weekly' => $weeklyData, 'monthly' => $monthlyData]);
?>
