<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function send_mail($subject,$body,$recipient){

    $mail = new PHPMailer(true);

try {
    // --- Server Settings ---
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       =  $_ENV['EMAIL_HOST'];                       // Set the SMTP server
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $_ENV['EMAIL_USER'];                 // email
    $mail->Password   = $_ENV['EMAIL_PASSWORD'];                    // App Password (not your login password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
    $mail->Port       = $_ENV['EMAIL_PORT'];                                    // TCP port to connect to

    // --- Recipients ---
    $mail->setFrom($_ENV['EMAIL_USER'], 'WSOMART');
    $mail->addAddress($recipient);                 // Add a recipient

    // --- Content ---
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = '';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



}
