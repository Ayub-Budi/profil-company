<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Ganti dengan server SMTP Anda
        $mail->SMTPAuth   = true;
        $mail->Username   = 'webprofile212@gmail.com'; // Ganti dengan email Anda
        $mail->Password   = '#admin1234'; // Ganti dengan password Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('webprofile212@gmail.com', 'web');
        $mail->addAddress('ayubbudisantoso09@gmail.com'); // Ganti dengan email penerima

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<h4>Message from: $name ($email)</h4><p>$message</p>";
        $mail->AltBody = "Message from: $name ($email)\n\n$message";

        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Form is not submitted.";
}
