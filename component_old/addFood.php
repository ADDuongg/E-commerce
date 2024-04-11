<?php
include('../database.php');
if (isset($_POST['submit']) && isset($_POST['type'])) {
    $id = uniqid('FOOD-', true);
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $detail = $_POST['detail'];
    $flavor = $_POST['flavor'];
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
                $new_img = uniqid("IMG-", true).'.'.$img_ext_lwc;
                $img_upload_path = '../foodimage/'.$new_img; 
                move_uploaded_file($img_tmp_name, $img_upload_path);
                $cmd = "INSERT INTO foods(id, name, type, price, detail, image, flavor) VALUES ('$id', '$name', '$type', '$price', '$detail', '$new_img', '$flavor')";
                $conn -> query($cmd);
                header('Location: ./foodadmin.php');
            } else {
                echo "File không hợp lệ";

            }
        }
    } else {
        echo "lỗi file";

    }
} else {

}
