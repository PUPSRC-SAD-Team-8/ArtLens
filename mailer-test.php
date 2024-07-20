<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php"; //PHPMailer Object 

// CONFIGURATION

// Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

// Enable verbose debug output. Uncomment if needed—debugging purposes
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

// Send using SMTP
$mail->isSMTP();

// Enable SMTP authentication
$mail->SMTPAuth = true;

// SMTP server
$mail->Host = "smtp.gmail.com";

// TLS encryption — secure than SSL
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

// TCP Port
$mail->Port = 587;

// SMTP username
$mail->Username = "gozunivan1@gmail.com";

// SMTP password
$mail->Password = "rpndkalzejrmxyij";

// Set email format to HTML
$mail->isHtml(true);

// return $mail;
function send_otp($code, $mail, $email)
{
    // $mail = new PHPMailer; //From email address and name 
    $mail->From = "gozunivan1@gmail.com";
    $mail->FromName = "Name of sender"; //To address and name 
    $mail->addAddress("$email"); //Recipient name is optional
    // $mail->addAddress("emailNgSesendan2@example.com"); //Address to which recipient will reply 
    $mail->isHTML(true);
    $mail->Subject = "gozunivan1@gmail.com";
    $mail->Body = "This is your otp code <b> $code </b>";
    return $mail->send();
}
