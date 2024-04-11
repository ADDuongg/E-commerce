<?php
include('../database.php');
include('../controller_old/autoDELETE.php');
$cmd = "SELECT * FROM orders";
$result1 = $conn->query($cmd);
$totalRow = $result1->num_rows;

$itemPerPage = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$start_from = ($page - 1) * 5;
$totalPage = ceil($totalRow / $itemPerPage);
$prev_page = ($page == 1) ? $totalPage : $page - 1;
$next_page = ($page == $totalPage) ? 1 : $page + 1;

$select = "SELECT * from orders LIMIT $start_from, $itemPerPage";
$result_order = $conn->query($select);

$sortOrder = "ASC";
if (isset($_GET['sort']) && $_GET['sort'] === 'DESC') {
    $sortOrder = "DESC";
}
$sql_select = "SELECT * from orders";

if (isset($_GET['sort'])) {
    $sql_select .= " ORDER BY total_price $sortOrder";
}

$sql_select .= " LIMIT $start_from, $itemPerPage";
/* header */
$day = date('d');
$active_user = "SELECT COUNT(DISTINCT session) AS unique_sessions FROM sessions;";
$result = $conn->query($active_user);
while ($row = $result->fetch_assoc()) {
    $number_active = $row['unique_sessions'];
}

$sales = "select SUM(totalPrice) as totalprice1 from salefigure where DAY(date) = $day";
$result1 = $conn->query($sales);
while ($row = $result1->fetch_assoc()) {
    $salesfigure = $row['totalprice1'];
    $salesfigure_formatted = number_format($salesfigure, 1);
}
$number = "select SUM(numberSold) as number from salefigure where DAY(date) = $day";
$result2 = $conn->query($number);
while ($row = $result2->fetch_assoc()) {
    $number_sold = $row['number'];
}


?>

<!DOCTYPE html>
<html lang="en">

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
                        <div class="item account"><i class="fa-solid fa-user-tie pe-3"></i> Quản lý tài khoản</div>
                        <div class="item food"><i class="fa-solid fa-bowl-food pe-3"></i> Quản lý món ăn</div>
                        <div class="item order"><i class="fa-solid fa-database pe-3"></i> Quản lý đơn hàng</div>
                        <div class="item data"><i class="fa-solid fa-database pe-3"></i> Thống kê món ăn</div>
                    </div>
                </div>
                <div class="div2" style="height: calc(100% - 540px); position: relative; width: 100%;">
                    <button class="btn text-danger logout" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);"><i class="fa-solid fa-arrow-right-from-bracket me-3 text-danger"></i>Log out</button>
                </div>
            </div>
            <div class="orderdetail col-10" style="padding: 0;">
                <div class="header border-bottom border-3 d-flex flex-column" style="height: 180px; width: 100%; position:sticky; top: 0">
                    <div class="border-bottom border-1 d-flex justify-content-between" style="height: 50px; width: 100%;">
                        <p class="ms-5">Dashboard</p>
                        <div class="me-5 divadmin-profile" style="position: relative;">
                            <img class="avataradmin" src="../avatar/<?php echo $avatar_admin ?>" alt="" style="height: 50px; width: 50px; cursor: pointer;">
                        </div>
                    </div>
                    <div class="divdashboard d-flex justify-content-around ">
                        <div class="divactiveuser divdash  border border-1 shadow" style="border-radius: 5%;">
                            <div class="d-flex align-content-center ps-3" style="height: 100%; width: 100%; flex-wrap: wrap;">Số người đang online: <span class="ps-2"><?php echo $number_active ?></span></div>
                        </div>
                        <div class="divrevenue divdash d-flex flex-column border border-1 justify-content-between shadow" style="border-radius: 5%;">
                            <div class="d-flex justify-content-between ps-2 pe-2 pt-1"><span>Số tiền thu được hôm nay</span><i class="fa-solid fa-circle-info" style="padding-top: 5px;"></i></div>
                            <div class="d-flex justify-content-between">
                                <span class="ps-2">Value: <?php echo $salesfigure_formatted ?></span>
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
                <div class="" style="overflow-y: scroll;">
                    <div id="div-table__food" style="width: 100%;">
                        <table class="table table-striped" style="width: 100%; height: auto;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Name food</th>
                                    <th scope="col">Thời gian đặt</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Tổng tiền<a href="datafood.php?type=salesfigure&page=<?php echo $page; ?>&sort=<?php echo $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">
                                            <i style="cursor: pointer;" class="fa-solid fa-sort-<?php echo $sortOrder === 'ASC' ? 'up' : 'down'; ?>"></i>
                                        </a>
                                    </th>
                                    <th scope="col">Số lượng đặt</th>
                                    <th>Action</th>
                                    <th scope="col">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if ($result_order) {
                                    while ($row = $result_order->fetch_assoc()) {
                                ?>
                                        <tr scope="row" class="rowfood">
                                            <td class="order_id"><?php echo $row['order_id'] ?></td>
                                            <td class="user_id"><?php echo $row['user_id'] ?></td>
                                            <td class="food_order"><?php echo $row['food_order'] ?></td>
                                            <td class="time"><?php echo $row['time'] ?></td>
                                            <td><img class="imgfood" src="../foodimage/<?php echo $row['image']; ?>" alt="Food Image"></td>
                                            <td class="total_price"><?php echo $row['total_price'] ?> $</td>
                                            <td class="number_order"><?php echo $row['number_order'] ?></td>
                                            <input type="hidden" name="hoten" value="<?php echo $row['hoten'] ?>">
                                            <input type="hidden" name="sdt" value="<?php echo $row['sdt'] ?>">
                                            <input type="hidden" name="diachi" value="<?php echo $row['diachi'] ?>">
                                            <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                                            <input type="hidden" name="note" value="<?php echo $row['note'] ?>">
                                            <td>
                                                <a href="../component/index.php?id=<?php echo $row['order_id'] ?>" class="btn btn-primary btn-view" style="color: white; text-decoration: none;"><i class="fa-solid fa-eye"></i></a>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['state'] == 0) {
                                                ?>
                                                    <div class="bg-success mt-2 d-flex flex-wrap align-content-center justify-content-center text-light" style="height: 50px; width: 125px; border-radius: 8px;">Đã thanh toán</div>
                                                <?php
                                                } else if ($row['state'] == 1) {
                                                ?>
                                                    <div class="bg-danger mt-2 d-flex flex-wrap align-content-center justify-content-center text-light" style="height: 50px; width: 125px; border-radius: 8px;">Chưa thanh toán</div>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <span>Show <?php echo $page ?> of <?php echo $totalPage ?> pages</span>
                            <nav aria-label="Page navigation example ">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="order.php?page=<?php echo $prev_page; ?>&sort=<?php echo $sortOrder ?>">Previous</a></li>
                                    <?php
                                    for ($i = 1; $i <= $totalPage; $i++) {
                                        echo '<li class="page-item"><a class="page-link" href="order.php?page=' . $i . '&sort=' . ($sortOrder) . '">' . $i . '</a></li>';
                                    }
                                    ?>
                                    <li class="page-item"><a class="page-link" href="order.php?page=<?php echo $next_page; ?>&sort=<?php echo $sortOrder ?>">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var rowfoods = document.querySelectorAll('.rowfood')


        rowfoods.forEach(item => {
            var view = document.querySelectorAll('.btn-view')
            var order_id = item.querySelector('.order_id').textContent
            var user_id = item.querySelector('.user_id').textContent
            var food_order = item.querySelector('.food_order').textContent
            var time = item.querySelector('.time').textContent
            var imgfood = item.querySelector('.imgfood').src
            var total_price = item.querySelector('.total_price').textContent.replace(' $', '')
            var number_order = item.querySelector('.number_order').textContent
            var hoten = document.querySelector('input[name="hoten"]').value;
            var sdt = document.querySelector('input[name="sdt"]').value;
            var diachi = document.querySelector('input[name="diachi"]').value;
            var email = document.querySelector('input[name="email"]').value;
            var note = document.querySelector('input[name="note"]').value;
            view.forEach(btnview => {
                var orderInfo = {
                    order_id: order_id,
                    user_id: user_id,
                    food_order: food_order,
                    time: time,
                    imgfood: imgfood,
                    total_price: total_price,
                    number_order: number_order,
                    hoten: hoten,
                    sdt: sdt,
                    diachi: diachi,
                    email: email,
                    note: note
                };
                
            })

        })
    </script>
    <script type="module" src="../js/admin.js"></script>

</body>

</html>