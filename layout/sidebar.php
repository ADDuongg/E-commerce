<!DOCTYPE html>
<html lang="en">
<?php
include('../database.php');
$day = date('d');
$active_user = "select COUNT(session) as number from sessions";
$result = $conn->query($active_user);
while ($row = $result->fetch_assoc()) {
    $number_active = $row['number'];
}

$sales = "select SUM(totalPrice) as totalprice1 from salefigure where DAY(date) = $day";
$result1 = $conn->query($sales);
while ($row = $result1->fetch_assoc()) {
    $salesfigure = $row['totalprice1'];
}
$number = "select SUM(numberSold) as number from salefigure where DAY(date) = $day";
$result2 = $conn->query($number);
while ($row = $result2->fetch_assoc()) {
    $number_sold = $row['number'];
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid" style="height: 100vh">
        <div class="row" style="height: 100%;">
            <div class="col-2 navbar-admin text-white" style="padding: 0">
                <div class="div1">
                    <div style="height: 200px; width: 100%;" class="d-flex justify-content-center">
                        <img style="height: 200px; width: 200px;" src="../public/logo.png" alt="...">
                    </div>
                    <div class="detailnav d-flex flex-column align-items-center" style="height: 340px; width: 100%;">
                        <div class="item home"><i class="fa-solid fa-house pe-3"></i> Trang chủ</div>
                        <div class="item revenue"><i class="fa-solid fa-arrow-trend-up pe-3"></i> Quản lý doanh thu</div>
                        <div class="item food"><i class="fa-solid fa-bowl-food pe-3"></i> Quản lý món ăn</div>
                        <div class="item data"><i class="fa-solid fa-database pe-3"></i> Phân tích dữ liệu</div>
                    </div>
                </div>
                <div class="div2" style="height: calc(100% - 540px); position: relative; width: 100%;">
                    <button class="btn text-danger logout" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);"><i class="fa-solid fa-arrow-right-from-bracket me-3 text-danger"></i>Log out</button>
                </div>
            </div>
            <div class="col-10 detailadmin" style="padding: 0; position: relative;">
                <div class="header border-bottom border-3 d-flex flex-column" style="height: 180px; width: 100%; position:sticky; top: 0">
                    <div class="border-bottom border-1" style="height: 50px;">
                        Dashboard
                    </div>
                    <div class="divdashboard d-flex justify-content-around ">
                        <div class="divactiveuser divdash  border border-1 shadow" style="border-radius: 5%;">
                            <div class="d-flex align-content-center ps-3" style="height: 100%; width: 100%; flex-wrap: wrap;">Số người đang online: <span class="ps-2"><?php echo $number_active ?></span></div>
                        </div>
                        <div class="divrevenue divdash d-flex flex-column border border-1 justify-content-between shadow" style="border-radius: 5%;">
                            <div class="d-flex justify-content-between ps-2 pe-2 pt-1"><span>Số tiền thu được hôm nay</span><i class="fa-solid fa-circle-info" style="padding-top: 5px;"></i></div>
                            <div class="d-flex justify-content-between">
                                <span class="ps-2">Value: <?php echo $salesfigure ?>$</span>
                                <span class="pe-2">Target today: 1000$</span>
                            </div>
                            <div class="pb-3 ms-2 me-2">
                                <div class="progress " style="width: 100%; ">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo (($salesfigure * 100) / 1000) ?>%" aria-valuenow="<?php echo $salesfigure ?>" aria-valuemin="0" aria-valuemax="1000"></div>
                                </div>
                            </div>
                        </div>
                        <div class="divsales divdash border border-1 d-flex flex-column border border-1 justify-content-between shadow" style="border-radius: 5%;">
                            <div class="d-flex justify-content-between ps-2 pe-2 pt-1"><span>Hôm nay bán được</span><i class="fa-solid fa-circle-info" style="padding-top: 5px;"></i></div>
                            <div class="d-flex justify-content-between">
                                <span class="ps-2">Number: <?php echo $number_sold ?>$</span>
                                <span class="pe-2">Target today: 1000</span>
                            </div>
                            <div class="pb-3 ms-2 me-2">
                                <div class="progress " style="width: 100%; ">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo (($number_sold * 100) / 1000) ?>%" aria-valuenow="<?php echo $number_sold ?>" aria-valuemin="0" aria-valuemax="1000"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detailtable" style="overflow-y: scroll; height:auto">
                </div>
            </div>
        </div>
    </div>
</body>

</html>