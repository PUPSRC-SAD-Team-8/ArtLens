<?php
session_start();
include('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$username = $_POST['uname'];
	$password = $_POST['pass'];

	$query = mysqli_query($conn, "SELECT * FROM `admin` WHERE (admin_username='$username' OR admin_email='$username') AND admin_password='$password'");
	if (mysqli_num_rows($query) < 1) {
		$_SESSION['msg'] = "<center><div style='background-color: #f8d7da;
			border: 1px solid #f5c6cb;
			border-radius: 5px;
			padding: 10px;
			text-align: center;'>Login Failed, User not found!</div></center>";
		header('location:index.php');
	} else {
		$row = mysqli_fetch_array($query);
		$_SESSION['userid'] = $row['admin_id'];
		if (isset($_SESSION["userid"])) {
			header('location: adminindex.php');
		} else {
			header('location:index.php');
		}
	}
}
