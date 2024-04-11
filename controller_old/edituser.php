<?php
session_start();
include('../database.php');
$userid = $_SESSION['user_id'];
if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $date = $_POST['date'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name']; // Sửa 'tmp' thành 'tmp_name'
    $img_error = $_FILES['img']['error'];

    $img_extension = pathinfo($img_name, PATHINFO_EXTENSION); // Sửa thành $img_extension

    $img_extension_lwc = strtolower($img_extension);
    $array = ["jpg", "png", "jpeg"];
    if(in_array($img_extension_lwc, $array)){
        $selectQuery = "SELECT avatar FROM account WHERE user_id = '$userid'";
        $result1 = $conn->query($selectQuery);
        if ($result1->num_rows === 1) {
            $row = $result1->fetch_assoc();
            $old_img = $row['avatar'];
            if(!empty($old_img)){
                $old_img_path = '../avatar/' . $old_img;
                    if (file_exists($old_img_path)) {
                        unlink($old_img_path);
                    }
            }
        }
        $avatar_file = uniqid("AVATAR-", true).".".$img_extension_lwc;
        $avatar_upload_path = "../avatar/".$avatar_file;
        move_uploaded_file($img_tmp, $avatar_upload_path);
        $cmd = "UPDATE account SET username = '$name', email = '$email', age = '$age', dateOfBirth = '$date', avatar = '$avatar_file' WHERE user_id = '$userid'"; // Đặt '$date' trong dấu nháy đơn
        $result = $conn->query($cmd);
        echo "<script>window.location.href = '../component/usersetting.php?type=profile'</script>";
    }
    else{
        echo "lỗi";
    }
}
?>
