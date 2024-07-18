<?php
session_start();
include ('connection.php');

if (isset($_SESSION['userid'])) {
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="sidebar/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/adminindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .box {
            background-color: #4169E1;
            color: white;
            padding: 20px;
            text-align: center; 
            margin: 10px;
            width: 45%; /* Adjusted width */
            display: inline-block; /* Ensure boxes are displayed inline */
        }

        .box h5,
        .box h3 {
            margin: 0;
        }

        .box i {
            font-size: 2rem;
        }
    </style>
</head>
<body>
<?php include('sidebar.php'); ?>

    <main class="content px-5 py-4">
                <div class="container" >
                <h1 style="color: grey;">Dashboard</h1>
                    <div class="box"  style="width: 30%; border-radius: 10px; min-width: 300px;">
                        <h5 style="margin-left: -100px;">Daily Booking</h5>
                        <h3 style="margin-left: -200px;"><b>
                        <?php
                        require('connection.php');

                        date_default_timezone_set('Asia/Manila');
                        $current_date = date('Y-m-d');

                        $count_query = "SELECT COUNT(*) AS booking_count FROM booking WHERE DATE(book_datetime) = '$current_date' ";
                        $count_result = $conn->query($count_query);

                        if ($count_result->num_rows > 0) {
                            $count_row = $count_result->fetch_assoc();
                            echo $count_row['booking_count'];
                        } else {
                            echo '0';
                        }

                        $conn->close();
                        ?>
                        </b></h3>
                        <div class="d-flex align-items-center justify-content-end" style="margin-top: -50px; margin-right: 50px;">
                            <i class="bi bi-book"></i>
                        </div>
                    </div>
                    <div class="box"  style="width: 30%; border-radius: 10px; min-width: 300px;">
                        <h5 style="margin-left: -100px;">Daily Visitor Log</h5>
                        <h3 style="margin-left: -200px;"><b>
                        <?php
                        require('connection.php');

                        $count_visitor_log_query = "SELECT COUNT(*) AS visitor_count FROM visitor_log WHERE DATE(entry_timestamp) = '$current_date' ";
                        $count_visitor_log_result = $conn->query($count_visitor_log_query);
                        $visitor_log_count = 0;

                        if ($count_visitor_log_result->num_rows > 0) {
                            $count_visitor_log_row = $count_visitor_log_result->fetch_assoc();
                            $visitor_log_count = $count_visitor_log_row['visitor_count'];
                        }

                        $count_visitor_org_query = "SELECT COUNT(*) AS visitor_count FROM visitor_org WHERE DATE(entry_timestamp) = '$current_date' ";
                        $count_visitor_org_result = $conn->query($count_visitor_org_query);
                        $visitor_org_count = 0;

                        if ($count_visitor_org_result->num_rows > 0) {
                            $count_visitor_org_row = $count_visitor_org_result->fetch_assoc();
                            $visitor_org_count = $count_visitor_org_row['visitor_count'];
                        }

                        $total_visitor_count = $visitor_log_count + $visitor_org_count;

                        echo $total_visitor_count;

                        $conn->close();
                        ?>

                        </b></h3>
                        <div class="d-flex align-items-center justify-content-end" style="margin-top: -50px; margin-right: 50px;">
                        <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="box"  style="width: 30%; border-radius: 10px; min-width: 300px;">
                        <h5 style="margin-left: -100px;">Current Visitor</h5>
                        <h3 style="margin-left: -200px;"><b>
                        <?php
                            require('connection.php');

                            $current_visitor_log_query = "SELECT COUNT(*) AS current_visitor_count FROM visitor_log WHERE exit_timestamp IS NULL";
                            $current_visitor_log_result = $conn->query($current_visitor_log_query);
                            
                            $current_visitor_log_count = 0;
                            
                            if ($current_visitor_log_result) {
                                if ($current_visitor_log_result->num_rows > 0) {
                                    $count_current_visitor_log_row = $current_visitor_log_result->fetch_assoc();
                                    $current_visitor_log_count = $count_current_visitor_log_row['current_visitor_count'];
                                }
                            } else {
                                echo "Error: " . $conn->error;
                            }
                            
                            echo $current_visitor_log_count;
                            ?>
                        <div class="d-flex align-items-center justify-content-end" style="margin-top: -50px; margin-right: 50px;">
                        <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container" style="background-color: white; padding: 30px;">
                    <div class="mb-3 float-end" style="width: 10%;">
                        <select id="timePeriod" class="form-select">
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <canvas id="visitorChart"></canvas>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const ctx = document.getElementById('visitorChart').getContext('2d');
                        const timePeriodSelect = document.getElementById('timePeriod');

                        let visitorChart;

                        const weeklyData = {
                            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                            datasets: [{
                                label: 'Visitors',
                                data: [4, 0, 0, 0],
                                backgroundColor: [
                                    '#4169E1'
                                ],
                                borderColor: [
                                    '#4169E1'
                                ],
                                borderWidth: 1
                            }]
                        };

                        const monthlyData = {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                            datasets: [{
                                label: 'Visitors',
                                data: [200, 300, 400, 500, 600, 700],
                                backgroundColor: [
                                    '#4169E1'
                                ],
                                borderColor: [
                                    '#4169E1'
                                ],
                                borderWidth: 1
                            }]
                        };

                        function createChart(data) {
                            if (visitorChart) {
                                visitorChart.destroy();
                            }
                            visitorChart = new Chart(ctx, {
                                type: 'bar',
                                data: data,
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        }

                        timePeriodSelect.addEventListener('change', function () {
                            const selectedPeriod = timePeriodSelect.value;
                            if (selectedPeriod === 'weekly') {
                                createChart(weeklyData);
                            } else if (selectedPeriod === 'monthly') {
                                createChart(monthlyData);
                            }
                        });

                        // Initialize chart with weekly data
                        createChart(weeklyData);
                    });
                </script>
            </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="sidebar/script.js"></script>
</body>
</html>

           

 
<?php
}else{
    
   header ("Location: index.php");
   die();
}
?>

