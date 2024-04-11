<?php
include('../database.php');
$day = date('d');
$month = date('m');
$year = date('Y');
$check = false;
$iduser;
/* if (isset($_POST['btnsold'])) {
    $iduser = $id_user = $_POST['id_user'];
    $id = $_POST['foodid'];
    $namefood = $_POST['namefood'];
    $type = $_POST['type'];
    $numberorder = $_POST['numberorder'];
    $totalprice = $_POST['total'];
    $idsalefigure = uniqid();
    $idorder = $_POST['idorder'];

    $deletesql = "UPDATE orders SET state = 0, create_at = CURRENT_TIMESTAMP() WHERE order_id = '$idorder' AND food_id = '$id'";
    $conn->query($deletesql);


    $cmd_check = "select * from salefigure where foodid = '$id' and MONTH(date) = $month and YEAR(date) = $year and DAY(date) = $day";
    $result = $conn->query($cmd_check);
    if ($result->num_rows > 0) {
        $updateSql = "UPDATE salefigure SET totalPrice = totalPrice + $totalprice, numberSold = numberSold + $numberorder  WHERE foodid = '$id' AND MONTH(date) = $month AND YEAR(date) = $year";

        if ($conn->query($updateSql) === TRUE) {
            echo '<script>window.history.back()</script>';
        } else {
            echo "Lỗi khi cập nhật: " . $conn->error;
        }
    } else {
        $idrevenue = uniqid();
        $insertSql = "INSERT INTO salefigure (id, nameFood, type, totalPrice, foodid, numberSold, date) VALUES ('$idsalefigure','$namefood', '$type', $totalprice, '$id', $numberorder, CURRENT_TIMESTAMP())";
        if ($conn->query($insertSql) === TRUE) {
            echo '<script>window.history.back()</script>';
        } else {
            echo "Lỗi khi chèn dữ liệu mới: " . $conn->error;
        }
    }
} else  */
if (isset($_POST['btncancle'])) {
    $id = $_POST['foodid'];
    $idorder = $_POST['idorder'];
    $deletesql = "delete from orders where order_id = '$idorder' and food_id = '$id'";
    $conn->query($deletesql);
    echo '<script>window.history.back()</script>';
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $postData = json_decode($data, true);
    
    /* print_r($postData); */
    try {
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('JSON Decode Error: ' . json_last_error_msg());
        }

        if (!is_array($postData) || !isset($postData[0]['total_price_food'])) {
            throw new Exception('Invalid JSON data or missing "total_price_food".');
        }

        // In ra dữ liệu để kiểm tra

        foreach ($postData as $item) {
            $id = $item['foodid'];
            $namefood = $item['namefood'];
            $type = $item['type'];
            $numberorder = $item['number_order'];
            $idsalefigure = uniqid();
            $idorder = $item['idorder'];
            $totalpricefood = $item['total_price_food'];
            $hoten = $item['hoten'];
            $sdt = $item['sdt'];
            $diachi = $item['diachi'];
            $email = $item['email'];
            $note = $item['note'];


            $deletesql = "UPDATE orders SET state = 0, create_at = CURRENT_TIMESTAMP(), hoten='$hoten', sdt='$sdt', diachi = '$diachi', email='$email', note='$note' WHERE order_id = '$idorder' AND food_id = '$id'";
            $conn->query($deletesql);
            $cmd_check = "SELECT * FROM salefigure WHERE foodid = '$id' AND MONTH(date) = $month AND YEAR(date) = $year AND DAY(date) = $day";
            $result = $conn->query($cmd_check);

            if ($result->num_rows > 0) {
                $updateSql = "UPDATE salefigure SET totalPrice = totalPrice + $totalpricefood, numberSold = numberSold + $numberorder  WHERE foodid = '$id' AND MONTH(date) = $month AND YEAR(date) = $year";

                if ($conn->query($updateSql) === TRUE) {
                    echo '<script>window.history.back()</script>';
                } else {
                    throw new Exception("Lỗi khi cập nhật: " . $conn->error);
                }
            } else {
                $insertSql = "INSERT INTO salefigure (id, nameFood, type, totalPrice, foodid, numberSold, date) VALUES ('$idsalefigure','$namefood', '$type', $totalpricefood, '$id', $numberorder, CURRENT_TIMESTAMP)";
                if ($conn->query($insertSql) === TRUE) {
                    echo '<script>window.history.back()</script>';
                } else {
                    throw new Exception("Lỗi khi chèn dữ liệu mới: " . $conn->error);
                }
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo 'Lỗi 2';
}
