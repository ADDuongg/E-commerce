<?php
include('../database.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = file_get_contents("php://input");
    $postdata = json_decode($data, true);
    $foodid = $postdata['foodid'];
    $price = $postdata['price'];
    $discount = $postdata['discount'];

    // Kiểm tra xem foodid đã tồn tại trong cơ sở dữ liệu hay chưa
    $checkQuery = "SELECT * FROM salefood WHERE foodid = '$foodid'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Nếu foodid đã tồn tại, thực hiện truy vấn cập nhật discount
        $updateQuery = "UPDATE salefood SET discount = '$discount' WHERE foodid = '$foodid'";
        if ($conn->query($updateQuery) === TRUE) {
            // Cập nhật thành công
            $response = array("status" => "success", "message" => "Cập nhật discount thành công.");
        } else {
            // Lỗi khi cập nhật
            $response = array("status" => "error", "message" => "Lỗi khi cập nhật discount: " . $conn->error);
        }
    } else {
        // Nếu foodid chưa tồn tại, thực hiện truy vấn thêm mới
        $id = uniqid();
        $insertQuery = "INSERT INTO salefood (id, foodid, price, discount) VALUES ('$id', '$foodid', '$price', '$discount')";
        if ($conn->query($insertQuery) === TRUE) {
            // Thêm mới thành công
            $response = array("status" => "success", "message" => "Thêm mới food thành công.");
        } else {
            // Lỗi khi thêm mới
            $response = array("status" => "error", "message" => "Lỗi khi thêm mới food: " . $conn->error);
        }
    }

    // Trả về kết quả dưới dạng JSON
    echo json_encode($response);
}
?>
