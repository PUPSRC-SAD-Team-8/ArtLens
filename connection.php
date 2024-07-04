<?php
$servername = "localhost";
$username = 'u155023598_artlensKvufe';
$password = 'dZNtUjukGYb4C55zqGmtvZJBzqWKeFbYRnJkwJXDV4467xfa4wrcZqCZLHUgv5vA';
$dbname = "u155023598_artlens";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed Connection" . $conn->connect_error);
}
