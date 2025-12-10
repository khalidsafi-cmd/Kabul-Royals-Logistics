<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data safely
    $name    = $_POST["name"] ?? '';
    $email   = $_POST["email"] ?? '';
    $subject = $_POST["subject"] ?? '';
    $message = $_POST["message"] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bahara.noorzai2004@gmail.com';
        $mail->Password   = 'yogakzyskgugivtd'; // App password
        $mail->Port       = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        // Sender and recipient
        $mail->setFrom('bahara.noorzai2004@gmail.com', 'Website Contact Form');
        $mail->addAddress('bahara.noorzai2004@gmail.com', 'Bahara');
        $mail->addReplyTo($email, $name);

        // Email content
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name
Email: $email

Message:
$message";

        $mail->send();

        // Redirect back to contact page with a "sent" flag
        header("Location: contact.php?sent=1");
        exit;

    } catch (Exception $e) {
        echo "Email failed: {$mail->ErrorInfo}";
    }

} else {
    // If accessed directly, redirect to contact page
    header("Location: contact.php");
    exit;
}
?>
