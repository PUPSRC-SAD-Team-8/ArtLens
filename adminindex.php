<?php
session_start();
include ('connection.php');

if (isset($_SESSION['userid'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Artlens</title>
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
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" style="position: relative;">
            <?php include('sidebar.php'); ?>
        </aside>

        <!-- Main Component -->
        <div class="main">
            <?php include('header.php'); ?>

            <!-- Main Content -->
            <main class="content px-5 py-4">
                <div class="container" >
                <h1 style="color: grey;">Dashboard</h1>
                    <div class="box"  style="width: 30%; border-radius: 10px; min-width: 300px;">
                        <h5 style="margin-left: -100px;">Daily Booking</h5>
                        <h3 style="margin-left: -200px;"><b>123</b></h3>
                        <div class="d-flex align-items-center justify-content-end" style="margin-top: -50px; margin-right: 50px;">
                            <i class="bi bi-book"></i>
                        </div>
                    </div>
                    <div class="box"  style="width: 30%; border-radius: 10px; min-width: 300px;">
                        <h5 style="margin-left: -100px;">Daily Visitor Log</h5>
                        <h3 style="margin-left: -200px;"><b>123</b></h3>
                        <div class="d-flex align-items-center justify-content-end" style="margin-top: -50px; margin-right: 50px;">
                        <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="box"  style="width: 30%; border-radius: 10px; min-width: 300px;">
                        <h5 style="margin-left: -100px;">Current Visitor</h5>
                        <h3 style="margin-left: -200px;"><b>123</b></h3>
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
                                data: [50, 100, 150, 200],
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

            <script src="script.js"></script>
</body>

</html>
<?php
} else {
    header("Location: index.php");
    die();
}
?>
