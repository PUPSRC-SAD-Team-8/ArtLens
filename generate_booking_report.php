<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include 'connection.php';
date_default_timezone_set('Asia/Manila');

$booking_query = "SELECT * FROM booking";

$i = 1;
$booking_result = mysqli_query($conn, $booking_query);

$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking | Generate Reports</title>
    <p>Date: <span>' . date('F j, Y'). '</span></p>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calibri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Calibri, sans-serif;
        }
        h2 {
            text-align: center;
            margin-top: 10px;
        }
        span {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #4444;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4169E1;
            color: white;
        }
</style>
<body>
    <h2>Booking Report</h2>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Organization Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Total</th>
                <th>Date and Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';
        if(mysqli_num_rows($booking_result) > 0) {
            while ($row = mysqli_fetch_array($booking_result)) {
            $html .= '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['organization_name'].'</td>
                    <td>'.$row['contact_email'].'</td>
                    <td>'.$row['contact_number'].'</td>
                    <td>'.($row["num_male"] + $row["num_female"]).'</td>
                    <td>'.$row['book_datetime'].'</td>
                    <td>'.$row['book_status'].'</td>
                </tr>';
                $i++;
            }
        }
        else {
            $html .='<tr>
                <td class="text-center" colspan="7">No record found!</td>
            </tr>';
            }
        $html .= '</tbody>
    </table>';

$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);
    
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
    
// Set the paper size to A4 and orientation to landscape
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
    
$NameModified = strtolower(str_replace(' ', '', date('F j, Y | g:i A')));
// Generate the file name with the current time, unique identifier, and equipment name
$fileName = 'Booking_Report_' . $NameModified . '.pdf';
    
// Output the PDF to the browser and force download
$dompdf->stream($fileName, ["Attachment" => true]);
?>
