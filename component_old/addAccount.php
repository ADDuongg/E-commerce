<?php
include('../database.php');
if (isset($_POST['submit']) && isset($_POST['role'])) {
    $id = uniqid();
    $name = $_POST['name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $dateofbirth = $_POST['dateofbirth'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $img_name = $_FILES['img']['name'];
    $img_size = $_FILES['img']['size'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_error = $_FILES['img']['error'];
    if ($img_error == 0) {
        if ($img_size > 500000) {
            echo "file quá lớn";
            header("Location: addFood.php");
        } else {
            $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ext_lwc = strtolower($img_extension);
            $img_ext_allow = array("jpg", "png", "jpeg");
            if (in_array($img_ext_lwc, $img_ext_allow)) {
                $new_img = uniqid("AVATAR-", true) . '.' . $img_ext_lwc;
                $img_upload_path = '../avatar/' . $new_img;
                move_uploaded_file($img_tmp_name, $img_upload_path);

                // Băm mật khẩu trước khi lưu vào cơ sở dữ liệu
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $cmd = "INSERT INTO account(user_id, username, email, password, role, dateOfBirth, age, avatar) VALUES ('$id', '$name', '$email', '$hashed_password', '$role', '$dateofbirth', '$age', '$new_img')";
                $conn->query($cmd);
                header('Location: ./account.php');
            } else {
                echo "File không hợp lệ";
            }
        }
    } else {
        echo "lỗi file";
    }
} else {
    echo "lỗi";
}
