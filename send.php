<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader (jika menggunakan Composer)
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi server SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Server SMTP Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'ayubbudisantoso09@gmail.com'; // Ganti dengan alamat email Anda
        $mail->Password = 'olhtqhaudlqcvrcw'; // Ganti dengan password aplikasi email Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Konfigurasi email
        $mail->setFrom('ayubbudisantoso09@gmail.com', 'Ayub'); // Ganti dengan alamat email Anda
        $mail->addAddress('webprofile212@gmail.com'); // Ganti dengan alamat email penerima

        // Setel subject dan body sesuai form
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // Kirim email
        $mail->send();
        echo 'success'; // Status sukses
    } catch (Exception $e) {
        echo 'error: ' . $mail->ErrorInfo; // Status error dengan pesan kesalahan
    }
}
?>
