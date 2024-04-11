<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Nạp các file của PHPMailer autoload.php
require '../vendor/autoload.php';

include("../database.php");


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = $_POST['l-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $location = $_POST['location'];
    $message = $_POST['comment'];

    echo $email;

    // Tạo một đối tượng PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Cấu hình thông tin của máy chủ SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Thay 'smtp.example.com' bằng máy chủ SMTP của bạn
        $mail->SMTPAuth = true;
        $mail->Username = $email; // Thay 'your_username' bằng tên đăng nhập SMTP của bạn
        $mail->Password = 'lqlq rkuk xkoo ampn'; // Thay 'your_password' bằng mật khẩu SMTP của bạn
        $mail->SMTPSecure = 'tls'; // Hoặc 'ssl' nếu máy chủ hỗ trợ
        $mail->Port = 587; // Cổng SMTP, thay đổi nếu cần

        // Thiết lập thông tin người gửi và người nhận
        $mail->setFrom($email, 'Your Name');
        $mail->addAddress('duong88999@st.vimaru.edu.vn');

        // Đặt tiêu đề và nội dung email
        // Đặt tiêu đề và nội dung email
        $mail->Subject = mb_encode_mimeheader($subject, 'UTF-8', 'B');
        $mail->Body = $message;


        // Gửi email
        $mail->send();

        echo "nội dung của bạn đã được gửi tới chúng tôi, vui lòng đợi phản hồi";
        header('Location: ../component/contact.php');
    } catch (Exception $e) {
        echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
    }
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
