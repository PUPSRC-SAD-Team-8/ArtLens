<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

unset($_SESSION['errors']);
	include('connection.php');
    if (isset($_SESSION['userid'])) {
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if ($_POST["currentpassword"]!=$_POST['newpassword']){
			$new_password = $_POST['newpassword'];
			if(preg_match('/[^a-zA-Z0-9]/', $new_password))
{
	$userid = $_SESSION['userid'];
	$query=mysqli_query($conn,"select * from `login` where userid='$userid'");

	if (mysqli_num_rows($query)<1){
		header('location:adminaccount.php');
	}else{
		$mail = new PHPMailer(true); 
$mail->isSMTP();
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->Host = 'live.smtp.mailtrap.io'; // Your SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'api'; // Your Mailtrap username
$mail->Password = '5292e7459736dfadbea5bb3a7d776ccd'; // Your Mailtrap password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('mailtrap@demomailtrap.com');
$mail->addAddress('kaizenc79@gmail.com');

// Sending plain text email
$mail->isHTML(false); // Set email format to plain text
$mail->Subject = 'Change password';
$mail->Body    = 'your password is "'.$new_password.'"';
$mail->send();
		$row=mysqli_fetch_array($query);
	 $id = $row['userid']; 
	 $new_password = $_POST['newpassword'];
	 $update_pwd=mysqli_query($conn, "update login set password='$new_password' where userid='$id'");
	 $error = "<span style = 'color:green;'>password successfully change</span>";
	 $_SESSION['errors'] = array();
	 array_push($_SESSION['errors'],$error);
	 header('location:adminaccount.php');
	 
	//  if (mysqli_num_rows($update_pwd)<1){
	// 	header('location:adminindex.php');

	// }else{ 
	//     header('location:adminindex.php');

	// }
		
		}
}else{
	$error = "<span style = 'color:red;'>please enter alpha numeric</span>";
	$_SESSION['errors'] = array();
	array_push($_SESSION['errors'],$error);
	header('location:adminaccount.php');
 
}

	
		
		}
	
		else{
			
			 $error = "<span style = 'color:red;'>Sorry your password is the same!</span>";
			 $_SESSION['errors'] = array();
			 array_push($_SESSION['errors'],$error);
			 header('location:adminaccount.php');
 
		}

		}
	}else{
        header("Location: index.php");
        die();
     }	
?>
