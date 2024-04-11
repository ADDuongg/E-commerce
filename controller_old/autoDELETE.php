<?php
include("../database.php");

// Kết nối đến cơ sở dữ liệu (sử dụng thông tin từ file database.php)
// $conn = connectToDatabase(); // Bạn cần thay đổi hàm này phù hợp với cách bạn kết nối đến cơ sở dữ liệu

// Xóa các đơn hàng đã thanh toán sau một ngày
$dateToDelete = date('Y-m-d', strtotime('-1 day')); // Ngày hôm qua

// Chuẩn bị truy vấn xóa dữ liệu
$query = "DELETE FROM orders WHERE state = 0 AND DAY(create_at) < DAY(CURRENT_DATE())";

// Thực thi truy vấn
$result = $conn->query($query);



// Đóng kết nối đến cơ sở dữ liệu
// closeDatabaseConnection($conn); // Bạn cần thay đổi hàm này phù hợp với cách bạn đóng kết nối
