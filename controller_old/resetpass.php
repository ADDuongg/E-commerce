<?php
session_start();
include('../database.php');
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email_reset'];
    $select = "select password from account where email = '$email'";
    $result = $conn->query($select);
    if ($result->num_rows > 0) {
        $password_new = $_POST['password_new'];
        $password_confirm = $_POST['password_confirm'];

        if (($password_confirm === $password_new)) {
            $hash_password = password_hash($password_new, PASSWORD_DEFAULT);
            $update = "update account set password = '$hash_password'";
            $result_update = $conn->query($update);
            if($result_update){
                ?>
                <p>Reset mật khẩu thành công, bây giờ bạn có thể đăng nhập <a href="../login.php" style="text-decoration: none;">Login</a></p>
                <?php
            }
        }
        else{
            ?>
            <script>alert("Mật khẩu không khớp, vui lòng nhập lại")</script>
            <?php
        
        }
    }
} else {
    echo 'ERROR';
}
