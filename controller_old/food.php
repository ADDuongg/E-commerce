<?php
include('../database.php');

$sql = "SELECT SUM(numberSold) as number, type from salefigure GROUP BY type ORDER BY type ASC";
$result = $conn->query($sql);
$sql1 = "SELECT SUM(numberSold) as number, nameFood from salefigure GROUP BY nameFood ORDER BY numberSold DESC LIMIT 0, 5";
$result1 = $conn->query($sql1);

$array = array();
$foodData = array();
$foodData_Detail = array();
$detailsalefigure = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $foodType = $row['type'];
        $foodNumber = $row['number'];
        $foodItem = array(
            'type' => $foodType,
            'number' => $foodNumber
        );
        $foodData[] = $foodItem;
    }
}

if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $number = $row['number'];
        $nameFood = $row['nameFood'];
        $foodItem = array(
            'number' => $number,
            'nameFood' => $nameFood
        );

        $foodData_Detail[] = $foodItem;
    }
}

$array = array(
    "all" => $foodData,
    "top5" => $foodData_Detail,
);
header('Content-Type: application/json');
print_r(json_encode($array)); // Trả về mảng $foodData dưới dạng JSON
