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
    <div style="height: 100vh">
        <div class="d-flex" style="height: 100%;">
            <?php include('../layout/sidebar.php') ?>

            <div class=" detailadmin">
                <?php include('../layout/headerAdmin.php') ?>
                <div class="height: auto; width: 100%" style="padding: 0;">
                    
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