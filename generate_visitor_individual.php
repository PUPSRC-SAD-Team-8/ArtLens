<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include 'connection.php';
date_default_timezone_set('Asia/Manila');

$log_query = "SELECT * FROM visitor_log";

$i = 1;
$log_result = mysqli_query($conn, $log_query);

$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Individual | Generate Reports</title>
    <p>Date: <span>' . date('F j, Y'). '</span></p>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calibri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Calibri, sans-serif;
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
            text-align: left;
            padding: 5px;
        }
        th {
            text-align: center;
        }
        
</style>
<body>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Time In</th>
            </tr>
        </thead>
        <tbody>';
        if(mysqli_num_rows($log_result) > 0) {
            while ($row_log = mysqli_fetch_array($log_result)) {
            $html .= '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row_log["log_first_name"]. ' ' . $row_log["log_mid_name"]. ' '. $row_log["log_last_name"] .'</td>
                    <td>'.$row_log['log_gender'].'</td>
                    <td>'.$row_log['log_contact_number'].'</td>
                    <td>'.$row_log['log_contact_email'].'</td>
                    <td>'.$row_log['entry_timestamp'].'</td>
                </tr>';
                $i++;
            }
        }
        else {
            $html .='<tr>
                <td class="text-center" colspan="6">No record found!</td>
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
$fileName = 'Visitor_Log_Individiual_' . $NameModified . '.pdf';
    
// Output the PDF to the browser and force download
$dompdf->stream($fileName, ["Attachment" => true]);
?>
