<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function sendEmail($companyEmail, $name, $userEmail, $formData)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'mail.lafoevents.co.za';  // Change this to your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'info@lafoevents.co.za';  // Your email
        $mail->Password = 'Lafo2024!@#';  // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom($userEmail, $name);
        $mail->addAddress($companyEmail);  // Company email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Site Visitor: $name";

        // Construct the email body with form data
        $mail->Body = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Full Name:</strong> {$formData['name']}</p>
            <p><strong>Subject:</strong> {$formData['subject']}</p>
            <p><strong>Email Address/Phone Number:</strong> {$formData['email']}</p>
            <p><strong>Number of Guests:</strong> {$formData['guests']}</p>
            <p><strong>Event Date:</strong> {$formData['date']}</p>
            <p><strong>Event Location:</strong> {$formData['location']}</p>
            <p><strong>Theme:</strong> {$formData['theme']}</p>
            <p><strong>Message:</strong> {$formData['message']}</p>
        ";

        // Send the email
        if ($mail->send()) {
            error_log('Email sent successfully to ' . $userEmail);
            return 'email sent';
        } else {
            error_log('Email sending failed: ' . $mail->ErrorInfo);
            return 'email sending failed: ' . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    $mail->SMTPDebug = 2; // Debug output (set 0 for production)
}

// Example form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = [
        'name' => $_POST['name'],
        'subject' => $_POST['subject'],
        'email' => $_POST['email'],
        'guests' => $_POST['guests'],
        'date' => $_POST['date'],
        'location' => $_POST['location'],
        'theme' => $_POST['theme'],
        'message' => $_POST['message'],
    ];

    $companyEmail = 'info@lafoevents.co.za';
    $result = sendEmail($companyEmail, $formData['name'], $formData['email'], $formData);

    // Simple response
    if ($result === 'email sent') {
        echo 'success';
    } else {
        echo 'error';
    }
    exit;
}
?>
