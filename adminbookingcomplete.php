<?php
session_start();
include('connection.php');

if (isset($_SESSION['userid'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sidebar/style.css">
    <link rel="stylesheet" href="assets/css/adminbooking.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
<style>
    .btn3 {
        width: auto;
        padding: 10px 32px;
        background-color: #4169E1;
        color: white;
        border-radius: 5px;
        text-align: center;
        text-transform: capitalize;
        cursor: pointer;
        text-decoration: none;
        border: solid 1px white;
        margin: 0 auto;
    }

    .btn3:hover {
        background-color: white;
        color: #4169E1;
        border: solid 1px #4169E1;
        box-shadow: none;
    }

    .dropdown-menu {
        min-width: auto;
    }

    .dropdown-menu button {
        width: 100%;
    }
    .inactive-link {
  padding: 10px 20px;
  border: none;
  background-color: #f0f0f0;
  color: #333;
  font-size: 16px;
  border-radius: 10px;
  cursor: pointer;
  position: relative;
  box-shadow: inset 0 -4px 6px rgba(0, 0, 0, 0.2);
  transition: box-shadow 0.3s ease;
  text-decoration: none;
  }

  .inactive-link:hover {
      box-shadow: inset 0 -6px 8px rgba(0, 0, 0, 0.3);
  }

  .inactive-link:active {
      box-shadow: inset 0 -2px 4px rgba(0, 0, 0, 0.1);
  }
</style>
    <title>Artlens</title>
</head>

<body>
    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>

    <!-- MAIN MAIN MAIN -->
    <main class="content px-3 py-2">
    <br>
        <div class="container">
            <a href="adminbooking.php" class="inactive-link">On-Going</a>&emsp;
            <span><a href="adminbookingcomplete.php" class="active-link" >Completed</a></span>
            </div>
            <br><br>
                <div class="container">
                    <div>
                        <table id="myTable" class="table table-striped table-bordered" style="background-color: #ffffff;">
                            <thead style="background-color: #4169E1; color: white;">
                                <tr>
                                    <th>Organization Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Total</th>
                                    <th>Date and Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('connection.php');
                                $current_date = date('Y-m-d H:i:s');

                                // Update status to Completed for past bookings
                                $update_sql = "UPDATE booking SET book_status='Completed' WHERE book_datetime < '$current_date' AND book_status != 'Completed'";
                                $conn->query($update_sql);

                                // Fetch only completed bookings
                                $sql = "SELECT * FROM booking WHERE book_status='Completed'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["organization_name"] . "</td>";
                                        echo "<td>" . $row["contact_email"] . "</td>";
                                        echo "<td>" . $row["contact_number"] . "</td>";
                                        echo "<td>" . ($row["num_male"] + $row["num_female"]) . "</td>";
                                        echo "<td>" . $row["book_datetime"] . "</td>";
                                        echo "<td class='status'>" . $row["book_status"] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <br>
                        <br><br>
                    </div>
                </div>
            

        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="sidebar/script.js"></script>

        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>
        
    </main>
</body>
</html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>
