<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Nạp các file của PHPMailer autoload.php
require '../vendor/autoload.php';

include("../database.php");

// Nhận email từ form
$email = $_POST['email'];

// Tạo reset token và thời gian hết hạn
$reset_token = md5(uniqid(rand(), true));
$token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Thời gian hết hạn sau 1 giờ

// Lưu reset token và thời gian hết hạn vào bảng account
$sql = "UPDATE account SET reset_token='$reset_token', token_expiry='$token_expiry' WHERE email='$email'";
if ($conn->query($sql) === TRUE) {
    // Gửi email chứa link đặt lại mật khẩu cùng với reset token
    $reset_link = "http://localhost/firstPHP/resetpass.php?token=$reset_token&email=$email";
    $subject = "Đặt lại mật khẩu";
    $message = "Xin chào,\n\nBạn đã yêu cầu đặt lại mật khẩu. Vui lòng truy cập link sau để thực hiện: $reset_link";

    // Tạo một đối tượng PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Cấu hình thông tin của máy chủ SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Thay 'smtp.example.com' bằng máy chủ SMTP của bạn
        $mail->SMTPAuth = true;
        $mail->Username = 'monbedehp1@gmail.com'; // Thay 'your_username' bằng tên đăng nhập SMTP của bạn
        $mail->Password = 'bqpk dhjj vfcv obmi'; // Thay 'your_password' bằng mật khẩu SMTP của bạn
        $mail->SMTPSecure = 'tls'; // Hoặc 'ssl' nếu máy chủ hỗ trợ
        $mail->Port = 587; // Cổng SMTP, thay đổi nếu cần

        // Thiết lập thông tin người gửi và người nhận
        $mail->setFrom("$email", 'Your Name');
        $mail->addAddress($email);

        // Đặt tiêu đề và nội dung email
        $mail->Subject = mb_encode_mimeheader($subject, 'UTF-8', 'B');
        $mail->Body = $message;

        // Gửi email
        $mail->send();

        echo "Một email chứa hướng dẫn đặt lại mật khẩu đã được gửi đến địa chỉ email của bạn.";
    } catch (Exception $e) {
        echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
    }
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
