<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Sertakan file PHPMailer
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize dan validasi input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Cek apakah email valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Inisialisasi PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi server SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Server SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ayubbudisantoso09@gmail.com'; // Email Anda
        $mail->Password   = 'jteltwqqebszjdod'; // Password Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 465;

        // Pengirim dan penerima email
        $mail->setFrom('ayubbudisantoso09@gmail.com', 'Web Profile');
        $mail->addAddress('webprofile212@gmail.com'); // Email penerima

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<h4>Message from: $name ($email)</h4><p>$message</p>";
        $mail->AltBody = "Message from: $name ($email)\n\n$message";

        // Kirim email
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Jika form tidak dikirim dengan metode POST
    echo "Form is not submitted.";
}
