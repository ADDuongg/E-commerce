<?php
include('../database.php');

if (isset($_POST['submit'])) {
    $id = $_GET['id']; // Lưu ý: Bạn cần kiểm tra và xử lý dữ liệu đầu vào một cách an toàn trước khi sử dụng
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $price_medium = $_POST['price_medium'];
    $price_large = $_POST['price_large'];
    $detail = $_POST['detail'];
    $flavor = $_POST['flavor'];
    $state = $_POST['state'];
    $new_img = null;
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img_name = $_FILES['img']['name'];
        $img_size = $_FILES['img']['size'];
        $img_tmp_name = $_FILES['img']['tmp_name'];
        $img_error = $_FILES['img']['error'];
        $selectQuery = "SELECT image FROM foods WHERE id = '$id'";
        $result1 = $conn->query($selectQuery);
        if ($result1->num_rows === 1) {
            $row = $result1->fetch_assoc();
            $old_img = $row['image'];
            print_r($old_img);
            if ($img_error == 0) {
                // Xóa ảnh cũ
                if (!empty($old_img)) {
                    $old_img_path = '../foodimage/' . $old_img;
                    if (file_exists($old_img_path)) {
                        unlink($old_img_path);
                    }
                }
            } else {
                echo "Lỗi khi cập nhật dữ liệu: ";
            }
        } else {
            echo "File không hợp lệ";
        }
        if ($img_error == 0) {
            if ($img_size > 500000) {
                echo "file quá lớn";
            } else {
                $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ext_lwc = strtolower($img_extension);
                $img_ext_allow = array("jpg", "png", "jpeg");
                if (in_array($img_ext_lwc, $img_ext_allow)) {
                    $new_img = uniqid("IMG-", true) . '.' . $img_ext_lwc;
                    $img_upload_path = '../foodimage/' . $new_img;
                    move_uploaded_file($img_tmp_name, $img_upload_path);
                } else {
                    echo "lỗi file";
                }
            }
        }
        // Tiếp tục xử lý tệp ảnh...
    }
    $updateQuery = "UPDATE foods SET name='$name', type='$type', price='$price', detail='$detail', flavor = '$flavor', price_medium = '$price_medium', price_large = '$price_large', state = '$state'";
    if ($new_img) {
        $updateQuery .= ", image = '$new_img'";
    }
    $updateQuery .= " WHERE id='$id'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Cập nhật dữ liệu thành công!";
        header('Location: ./foodadmin.php');
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
    }
}
