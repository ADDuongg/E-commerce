<?php
session_start(); // Bắt đầu phiên của người dùng
include('../database.php');

if(isset($_SESSION['user_id']) && $_SERVER["REQUEST_METHOD"] === "GET"){
    $iduser = $_SESSION['user_id'];
    $cmd = "select * from account where user_id = '$iduser'";
    $result = $conn->query($cmd);
    if ($result->num_rows == 1) {
        $userInfo = $result->fetch_assoc();
        echo json_encode($userInfo); // Trả về dữ liệu dưới dạng JSON
    }
}
?>
