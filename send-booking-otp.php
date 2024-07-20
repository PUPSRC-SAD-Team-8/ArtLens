<?php

require_once 'mailer-test.php';
function generate_otp()
{
    $digits = 4;
    return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the email parameter is set
    if (isset($_POST['email'])) {
        // Get the email value
        $email = $_POST['email'];

        // Process the email (e.g., validate it, send an OTP, etc.)
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $otp = generate_otp();


            if (send_otp($otp, $mail, $email)) {
                http_response_code(200);
                try {
                    session_start();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }

                $_SESSION['otp'] = $otp;
                echo json_encode(['message' => 'OTP has been sent.']);
            }
        } else {
            // Send an error response if the email is invalid
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid email address']);
        }
    } else {
        // Send an error response if the email parameter is missing
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Email parameter is missing']);
    }
} else {
    // Send an error response if the request method is not POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}
