<?php
session_start();
include('../database.php');
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = json_decode(file_get_contents("php://input"), true);

        // Kiểm tra xem dữ liệu đã được gửi đến chưa
        if (isset($data)) {
            $namefood = $data['namefood'];
            $pricefood = $data['pricefood'];
            $current_price = $data['current_price'];
            $imgfood = $data['imgfood'];
            $orderid = $data['orderid'];
            $idfood = $data['idfoodreal'];
            $type = $data['type'];
            $number_order = $data['numberorder'];

            /* echo $number_order .' '. $pricefood; */
            $cmd = "SELECT * FROM orders WHERE food_order = '" . $namefood . "' AND user_id = '" . $user_id . "' AND state = 1";
            $result = $conn->query($cmd);

            if ($result->num_rows >= 1) {
                // Sản phẩm đã tồn tại, cập nhật giá
                $updateCmd = "UPDATE orders SET total_price = total_price + '" . $pricefood . "', number_order = number_order + '" . $number_order . "' WHERE food_order = '" . $namefood . "' AND user_id = '" . $user_id . "'";
                if ($conn->query($updateCmd) === TRUE) {
                    echo 'Giá sản phẩm đã được cập nhật';
                } else {
                    echo 'Lỗi khi cập nhật giá sản phẩm: ' . $conn->error;
                }
            } else {
                // Sản phẩm chưa tồn tại, thêm sản phẩm mới
                $insertCmd = "INSERT INTO orders (order_id, user_id, food_order, type, time, total_price, image, number_order, food_id, state, create_at, current_price) VALUES ('$orderid', '$user_id', '$namefood', '$type', CURRENT_TIMESTAMP(), '$pricefood', '$imgfood', '$number_order', '$idfood', 1, CURRENT_TIMESTAMP(), '$current_price')";
                if ($conn->query($insertCmd) === TRUE) {
                    echo 'Sản phẩm đã được thêm vào đơn hàng';
                } else {
                    echo 'Lỗi khi thêm sản phẩm vào đơn hàng: ' . $conn->error;
                }
            }
        } else {
            echo 'Dữ liệu không hợp lệ';
        }
    } else {
        echo 'DMM';
    }
}
