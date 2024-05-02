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


    $sales = "select SUM(totalPrice) as totalprice1 from salefigure where DAY(date) = $day ";
    $result1 = $conn->query($sales);
    while ($row = $result1->fetch_assoc()) {
        $salesfigure = $row['totalprice1'];
        $salesfigure_formatted = number_format($salesfigure, 1);
    }
    $number = "select SUM(numberSold) as number from salefigure where DAY(date) = $day ";
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
    <div class="" style="height: 100vh">
        <div class="d-flex">
            <?php include('../layout/sidebar.php') ?>
            <div class=" detailadmin" >
               
                <?php include('../layout/headerAdmin.php') ?>

                <div class="detailtable mt-5" >
                    <div class="container">
                        <div class="row g-3">
                            <div class="col-lg-8 col-12 border border-1 d-flex flex-column p-4">
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
                            <div class="col-lg-4 col-12 border border-1 d-flex flex-column" style=" overflow-y: auto; padding: 20px; ">
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
                                            <img class="rounded-circle" style="flex: 3; height: 5rem; width: 5rem; border: 1px solid black;" src="../avatar/<?php echo $kh['avatar'] ?>" alt="">
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