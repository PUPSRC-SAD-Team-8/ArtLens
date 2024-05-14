<?php
    session_start();
    include('connection.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST["firstName"];
        $last_name = $_POST["lastName"];
        $middle_initial = $_POST["middleinitial"];
        $employee_id = $_POST["employeeid"];
        $email = $_POST["email"];
        $mobile_number = $_POST["mobilenumber"];

       $query=  "select * from `admin` where admin_id=" .$_SESSION['userid']. "";
        // mysqli_num_rows($result) > 0
        $result = $conn->query($query);
        $row = mysqli_fetch_array($result);
    if ($row  > 0 ) {

        $sql=mysqli_query($conn, "UPDATE admin set admin_first_name='$first_name', admin_last_name='$last_name', admin_middle_name='$middle_initial', admin_employee_id='$employee_id', admin_pnumber='$mobile_number'");

        $sql2 = mysqli_query($conn, "UPDATE login set username='$email'");
        header('location:adminindex.php');
    }else{

        $sql11 = "INSERT INTO admin (admin_username,admin_password,admin_pnumber,admin_img,admin_first_name,admin_middle_name,admin_last_name,admin_employee_id)
        VALUES (null,null,'$mobile_number',null,'$first_name', '$middle_initial', '$last_name', '$employee_id')";
        $conn->query($sql11);
            // $sql22 = "INSERT INTO login (username)
            // VALUES ('$email')";
            //      $conn->query($sql22);
            	header('location:adminindex.php');
   
    }
   
   
    }
?>