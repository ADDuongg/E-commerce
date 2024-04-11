<?php
include('../database.php');

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $monthlySales = array_fill(1, 12, 0);
    $daySales = array();
    $yearSales = array();
    for ($i = 1; $i <= 31; $i++) {
        $daySales[$i] = 0;
    }
    for ($i = $year - 2; $i <= $year + 2; $i++) {
        $yearSales[$i] = 0;
    }
    // Sử dụng Prepared Statements để ngăn chặn SQL Injection
    $sql = "SELECT MONTH(date) as month, SUM(totalPrice) as total FROM salefigure where YEAR(date) = ? GROUP BY MONTH(date)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $year);
    $stmt->execute();
    $result = $stmt->get_result();

    $sql1 = "SELECT DAY(date) as day, SUM(totalPrice) as total FROM salefigure where YEAR(date) = ? and MONTH(date) = ? GROUP BY DAY(date)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ss", $year, $month);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    $sql2 = "SELECT YEAR(date) as year, SUM(totalPrice) as total FROM salefigure where YEAR(date) = ? GROUP BY YEAR(date)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $year);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $month = $row["month"];
            $total_month = $row["total"];
            $monthlySales[$month] = $total_month;
        }
    }
    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $day = $row["day"];
            $total_day = $row["total"];
            $daySales[$day] = $total_day;
        }
    }
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $year = $row["year"];
            $total_year = $row["total"];
            $yearSales[$year] = $total_year;
        }
    }
    $data = array(
        "monthlySales" => $monthlySales,
        "daySales" => $daySales,
        "yearSales" => $yearSales
    );
    header('Content-Type: application/json');
    print_r(json_encode($data));

    $stmt->close();
    $stmt1->close();
    $stmt2->close();
    $conn->close();
} else {
    echo "lỗi";
}
