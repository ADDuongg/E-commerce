<!DOCTYPE html>
<html lang="en">
<?php
include('../database.php');
session_start();
if (isset($_SESSION['authenticated'])) {

    $day = date('d');
    $month = date('m');
    $active_user = "SELECT COUNT(DISTINCT sessions.session) AS unique_sessions
    FROM sessions
    INNER JOIN account ON sessions.session = account.user_id
    WHERE account.role = 'khach hang';
    ";
    $result = $conn->query($active_user);
    while ($row = $result->fetch_assoc()) {
        $number_active = $row['unique_sessions'];
    }

    $admin_select = "select account.*, sessions.session from account RIGHT JOIN sessions on sessions.session = account.user_id";
    $result_admin = $conn->query($admin_select);
    while ($admin = $result_admin->fetch_assoc()) {
        $avatar_admin = $admin['avatar'];
    }

    $sales = "select SUM(totalPrice) as totalprice1 from salefigure where DAY(date) = $day and MONTH(date) = $month";
    $result1 = $conn->query($sales);
    while ($row = $result1->fetch_assoc()) {
        $salesfigure = $row['totalprice1'];
        $salesfigure_formatted = number_format($salesfigure, 1);
    }
    $number = "select SUM(numberSold) as number from salefigure where DAY(date) = $day and MONTH(date) = $month";
    $result2 = $conn->query($number);
    while ($row = $result2->fetch_assoc()) {
        $number_sold = $row['number'];
    }
} else {
    header('Location: ../login.php');
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
                    <button class="btn text-danger logout" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);"><i class="fa-solid fa-arrow-right-from-bracket me-3 text-danger"></i><a href="../logout.php" style="text-decoration: none; color: red">Log out</a></button>
                </div>
            </div>
            <div class="col-10 detailadmin" style="padding: 0; position: relative;">
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

                <div class="detailtable d-flex justify-content-between" style=" height:calc(100% - 180px);">
                    <div class="border border-1 d-flex flex-column p-4" style="flex: 7; height: 557px;  ">
                        <div style="overflow: scroll;">
                            <!-- <div class="shadow-lg" style="flex: 1; width: 100%; margin-bottom: 2rem;  border: 1px solid black; border-radius: 13px;"> -->
                            <div class="d-flex mb-4" style="position: relative;">
                                <div class="divchart" style=" width: 100%; ">
                                    <canvas id="myChart_revenue"></canvas>
                                </div>

                                <ul class="ul-option " style="z-index: 4;">
                                    <div class="d-flex justify-content-evenly">
                                        <li><a style="text-decoration: none; color: black" href="./revenueadmin.php"><i class="fa-solid fa-circle-info "></i></a></li>
                                        <li class="zoom-in" style="cursor:pointer" onclick="zoomIn()"><i class="fa-solid fa-magnifying-glass-plus "></i></li>
                                        <li class="zoom-out" style="cursor:pointer" onclick="zoomOut()"><i class="fa-solid fa-magnifying-glass-minus "></i></li>
                                    </div>
                                </ul>
                                <button class="btn btn-secondary d-flex justify-content-center flex-wrap align-content-center" style="height: 30px; width: 70px; position: absolute; left: 50px; top: 0; cursor: pointer" id="resetButton">Reset</button>
                                <p class="setting" style="position: absolute; right: 10px; top: 0; cursor: pointer"><i class="fa-solid fa-ellipsis-vertical"></i>
                                </p>
                            </div>

                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="border border-1 d-flex flex-column" style="flex: 3;height: 100%; overflow-y: auto; padding: 20px; ">
                        <div class="d-flex justify-content-between">
                            <p>Current Users</p>
                            <button class="btn btn-primary d-flex justify-content-center flex-wrap align-content-center btnuser" style="height: 30px; width: 60px;"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
                        </div>
                        <div class="border border-1 shadow-lg" style="height: 100%; width: 100%; border-radius: 10px; overflow-y: auto">
                            <?php
                            $select = "select * from account where role = 'Khach hang'";
                            $result = $conn->query($select);
                            while ($kh = $result->fetch_assoc()) {
                            ?>
                                <div class="ps-3 pe-3 pt-3 pb-2 d-flex justify-content-between divuser " style="position: relative;">
                                    <img class="rounded-circle" style="flex: 3; height: 80px; width: 80px; border: 1px solid black;" src="../avatar/<?php echo $kh['avatar'] ?>" alt="">
                                    <div class="d-flex flex-column ms-4 ps-4 border-start border-2 " style="flex: 7;">
                                        <p><?php echo $kh['username'] ?></p>
                                        <p><?php echo $kh['email'] ?></p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/2.0.1/chartjs-plugin-zoom.min.js" integrity="sha512-wUYbRPLV5zs6IqvWd88HIqZU/b8TBx+I8LEioQ/UC0t5EMCLApqhIAnUg7EsAzdbhhdgW07TqYDdH3QEXRcPOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var setting = document.querySelector('.setting')
        var isShowing = false; // Trạng thái ban đầu
        var divoption = document.querySelector('.div-option')
        var uloption = document.querySelector('.ul-option')
        const ctx_canvas = document.getElementById('myChart_revenue');
        const zoomInButton = document.querySelector('.zoom-in');
        const zoomOutButton = document.querySelector('.zoom-out');
        var btnreset = document.getElementById('resetButton')
        var btnuser = document.querySelector('.btnuser');

        btnuser.addEventListener('click', function() {
            window.location.href = "./account.php";
        })
        let chart;



        btnreset.addEventListener('click', function() {
            chart.resetZoom()
        })

        function zoomIn() {
            chart.zoom(1.1)
        }

        function zoomOut() {
            chart.zoom(0.5)
        }
        fetch('../controller_old/revenue.php')
            .then(res => res.json())
            .then(dataBE => {
                const monthColors = [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)',
                    'rgba(143, 105, 230, 0.2)',
                    'rgba(163, 100, 245, 0.2)',
                    'rgba(133, 102, 222, 0.2)',
                    'rgba(193, 111, 200, 0.2)',
                    'rgba(123, 101, 219, 0.2)',
                ];

                const dayColors = Array.from({
                    length: 31
                }, (_, i) => monthColors[i % monthColors.length]);


                const backgroundColor = dayColors

                let dataDay = {};
                let labelDay = [];
                /* day */
                dataDay = {
                    ...dataBE['daySales']
                };
                labelDay = Object.keys(dataDay);
                var dataDay_array = Object.values(dataDay);

                const data = {
                    labels: labelDay,
                    datasets: [{
                        label: 'Danh thu theo ngày',
                        data: dataDay_array,
                        backgroundColor: backgroundColor,
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 1
                    }]
                };
                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            zoom: {
                                zoom: {
                                    wheel: {
                                        enabled: true
                                    },
                                    pinch: {
                                        enabled: true
                                    },
                                    mode: 'xy'
                                }
                            }
                        }
                    },

                };
                chart = new Chart(ctx_canvas, config);
                /* zoomInButton.addEventListener('click', () => {
                    console.log(12);
                    chart.options.aspectRatio = 2; 
                    chart.update();
                });

                
                zoomOutButton.addEventListener('click', () => {
                    chart.options.aspectRatio = 1; 
                    chart.update();
                }); */
            });



        var logoutadmin = document.querySelector('.logout');
        console.log(logoutadmin);
        logoutadmin.addEventListener('click', function() {
            window.location.href = "../login.php"
        })
        var avataradmin = document.querySelector('.avataradmin')
        var ulMenu = document.querySelector('.ulMenu')
        avataradmin.addEventListener('click', function() {
            ulMenu.classList.toggle('avtive')
        })

        setting.addEventListener('click', function() {
            console.log(123);
            if (isShowing) {
                uloption.style.display = "none"; // Nếu đã hiển thị, ẩn đi
            } else {
                uloption.style.display = "block"; // Nếu chưa hiển thị, hiển thị lên
            }
            isShowing = !isShowing; // Đảo ngược trạng thái
        });
    </script>
    <script src="../js/admin.js"></script>

    </script>



</body>

</html>