<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com'; // Hotmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'bytepacksales@hotmail.com'; // Your Hotmail address
            $mail->Password = 'Gamemetalslug@1'; // Your Hotmail password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($email);
            $mail->addAddress('bytepacksales@hotmail.com'); // The recipient's address

            // Content
            $mail->isHTML(false);
            $mail->Subject = 'New Chat Message from BytePack Website';
            $mail->Body = "You have received a new message from $email:\n\n$message";

            $mail->send();
            echo 'Your message has been sent successfully.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Invalid email address or message.";
    }
} else {
    echo "Invalid request.";
}
?>
