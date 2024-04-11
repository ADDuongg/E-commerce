<?php
include('../database.php');
$id = $_GET['id'];
$action = $_GET['action'];
$image = $_GET['image'];
if ($action == 'delete') {
  $img_name = $_FILES['img']['name'];
  $img_size = $_FILES['img']['size'];
  $img_tmp_name = $_FILES['img']['tmp_name'];
  $img_error = $_FILES['img']['error'];
  $selectQuery = "SELECT avatar FROM account WHERE user_id = '$id' and avatar = '$image'";
  $result1 = $conn->query($selectQuery);
  if ($result1->num_rows === 1) {
    $row = $result1->fetch_assoc();
    $old_img = $row['image'];
    print_r($old_img);
    if ($img_error == 0) {
      // Xóa ảnh cũ
      if (isset($old_img)) {
        $old_img_path = '../avatar/' . $old_img;
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

  $cmd = "DELETE from account where user_id = '$id'";
  $result = $conn->query($cmd);
  if ($result === TRUE) {
    echo "Record deleted successfully";
    header('Location: ./account.php');
  } else {
    echo "Error deleting record: ";
  }
}
else {
  echo 'lỗi';
}
