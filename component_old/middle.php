<?php
session_start(); 
if(isset($_SESSION["user_id"])){
    echo "<script>console.log('Đăng nhập thành công')</script>";
    echo "<script>console.log('" . $_SESSION["user_id"] . "')</script>";
    $user_role = $_SESSION['user_role'];
    if($user_role == 'admin'){
        echo '<script>window.location.href = "./admin.php";</script>';
    }
    elseif($user_role == 'Khach hang'){
        echo '<script>window.location.href = "../page.php";</script>';
    }
    /* echo 'ok'; */
}
else{
    echo "lỗi";
}
?>



