<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artlens";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Failed Connection".$conn->connect_error);
}
?>