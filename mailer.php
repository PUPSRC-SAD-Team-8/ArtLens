<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true); // Enable exceptions

// SMTP Configuration
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
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
$mail->Subject = 'this is for demo';
$mail->Body    = 'for tester ';

// Send the email
if(!$mail->send()){
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
