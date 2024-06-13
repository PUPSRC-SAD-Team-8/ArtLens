<?php
	session_start();
	include('connection.php');
//     $body = print_r($_POST, true);
// echo $body;
// exit;
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if($_POST["status"] == "Organization"){

    $busno = $_POST["busno"];
    $names = $_POST["names"];
    $address = $_POST["address"];
    $nationality = $_POST["nationality"];
    $numma = $_POST["numma"];
    $numfe = $_POST["numfe"];
    $gs = $_POST["gs"];
    $hs = $_POST["hs"];
    $cls = $_POST["cls"];
    $pwd = $_POST["pwd"];
    $sevenbelow = $_POST["17below"];
    $oneninebelow = $_POST["1930below"];
    $threeonebelow = $_POST["3159below"];
    $sixabove = $_POST["60above"];
    // SQL query to insert booking into database
    $sql = "INSERT INTO visitor_org (visitor_org_cn_no, visitor_org_name, visitor_org_add, visitor_org_natl, visitor_org_male, visitor_org_female, visitor_org_gschool, visitor_org_hschool, visitor_org_college, visitor_org_pwd, visitor_org_17blow, visitor_org_1930old, visitor_org_3159old, visitor_org_60old)
            VALUES ('$busno', '$names', '$address', '$nationality', '$numma', '$numfe', '$gs', '$hs', '$cls', '$pwd', '$sevenbelow', '$oneninebelow', '$threeonebelow', '$sixabove')";

    if ($conn->query($sql) === TRUE) {
    
        header('location:index.php');

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}else{
    $first_name = $_POST["fn"];
    $mid_name = $_POST["mo"];
    $last_name = $_POST["ln"];
    $email = $_POST["email1"];
    $mobile_number = $_POST["monu1"];
    $gender = $_POST["gen"];

    
    
    // SQL query to insert booking into database
    $sql = "INSERT INTO visitor_log (log_first_name, log_mid_name, log_last_name, log_contact_email, log_contact_number, log_gender)
            VALUES ('$first_name', '$mid_name', '$last_name', '$email', '$mobile_number', '$gender')";

    if ($conn->query($sql) === TRUE) {
    
        header('location:index.php');

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



}

?>