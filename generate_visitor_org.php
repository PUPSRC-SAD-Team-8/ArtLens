<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include 'connection.php';
date_default_timezone_set('Asia/Manila');

$org_query = "SELECT * FROM visitor_org";
$org_result = mysqli_query($conn, $org_query);

$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Organization | Generate Reports</title>
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
                <th>C.N. Bus No.</th>
                <th>Name</th>
                <th>Address/Affiliation</th>
                <th> Nationality</th>
                <th>Female</th>
                <th>Male</th>
                <th>Grade School</th>
                <th>High School</th>
                <th>College</th>
                <th>PWD</th>
                <th>17 y/o below</th>
                <th>18-30 y/o</th>
                <th>31-59 y/o</th>
                <th>60 y/o above</th>
                <th>Total</th>
                <th>Time in</th>
            </tr>
        </thead>
        <tbody>';
        if(mysqli_num_rows($org_result) > 0) {
            while ($row_org = mysqli_fetch_array($org_result)) {
            $html .= '<tr>
                    <td>'.$row_org['visitor_org_cn_no'].'</td>
                    <td>'.$row_org['visitor_org_name'] .'</td>
                    <td>'.$row_org['visitor_org_add'].'</td>
                    <td>'.$row_org['visitor_org_natl'] .'</td>
                    <td>'.$row_org['visitor_org_female'].'</td>
                    <td>'.$row_org['visitor_org_male'] .'</td>
                    <td>'.$row_org['visitor_org_gschool'].'</td>
                    <td>'.$row_org['visitor_org_hschool'] .'</td>
                    <td>'.$row_org['visitor_org_college'].'</td>
                    <td>'.$row_org['visitor_org_pwd'] .'</td>
                    <td>'.$row_org['visitor_org_17blow'].'</td>
                    <td>'.$row_org['visitor_org_1930old'] .'</td>
                    <td>'.$row_org['visitor_org_3159old'].'</td>
                    <td>'.$row_org['visitor_org_60old'] .'</td>
                    <td>'.$row_org['visitor_org_female'] + $row_org['visitor_org_male'].'</td>
                    <td>'.$row_org['entry_timestamp'] .'</td>
                </tr>';
            }
        }
        else {
            $html .='<tr>
                <td class="text-center">No record found!</td>
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
$fileName = 'Visitor_Organization_' . $NameModified . '.pdf';
    
// Output the PDF to the browser and force download
$dompdf->stream($fileName, ["Attachment" => true]);
?>
