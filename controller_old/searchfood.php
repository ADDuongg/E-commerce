<?php
include("../database.php");

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $query = "SELECT * FROM foods WHERE name LIKE '%" . $_GET['search'] . "%'";
    $query_discount = "SELECT * FROM salefood";
    $result = $conn->query($query);
    $result1 = $conn->query($query_discount);

    $arr_discount = array();
    while ($discount = $result1->fetch_assoc()) {
        $food_id = $discount['foodid'];
        $arr_discount[$food_id] = $discount['discount'];
    }

    $arr = array();
    while ($results = $result->fetch_assoc()) {
        $food_id = $results['id'];
        $food_info = $results;
        $food_info['discount_value'] = isset($arr_discount[$food_id]) ? $arr_discount[$food_id] : 0;
        $arr[] = $food_info;
    }

    header('Content-Type: application/json');
    echo json_encode($arr);
}
