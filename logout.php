<?php
include('./database.php');
session_start();
$session_id = $_SESSION['user_id'];
$referrer = $_SESSION['previous_page'];
session_unset();
session_destroy();
$cmd = "DELETE FROM sessions WHERE session = ?";
$stmt = $conn->prepare($cmd);
$stmt->bind_param('s', $session_id);
$stmt->execute();
echo "<script>window.location.href = './login.php'</script>";
exit(); // Đảm bảo chương trình kết thúc sau khi chuyển hướng
