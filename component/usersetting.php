<?php
session_start();
include('../database.php');
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $select_user = "select * from account where user_id = '$id'";
    $result = $conn->query($select_user);
    $row = $result->fetch_assoc();

    $select_food = "select * from orders where state = 1";
    $resule_food = $conn->query($select_food);
    $numrow = $resule_food->num_rows;
} else {
    echo '<script>alert("Bạn chưa đăng nhập nên k thể xem thông tin này")</script>';
    echo '<script>window.location.href = "../page.php"</script>';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_new/usersetting.css">
    <link rel="stylesheet" href="../css_new/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div style="height: 100%; width: 100%;">
        <!-- Header -->
        <div class="div-header" style="height: 600px; width: 100%; z-index: -1;">
            <div class="content-header border border-2">
                <div class="content-header-child">
                    <img style="height: 100%; width: 100%;" src="../public/profileimage.png" alt="">
                </div>
                <header class=" ">
                    <div class="d-flex flex-column ">
                        <div class="d-flex justify-content-between divHeader" style="width: 100%; max-width: 80%; margin: auto; padding-top: 25px; z-index: 3;">
                            <div class="icon-header" style="width: 170px;">
                                <i class="fa-brands fa-facebook me-2"></i>
                                <i class="fa-brands fa-twitter me-2"></i>
                                <i class="fa-brands fa-square-instagram"></i>
                            </div>

                            <div class="navbar-header d-flex flex-column justify-content-center align-content-center flex-wrap" style="width: 1000px;">
                                <div class="d-flex justify-content-between" style="width: 80%; margin:auto">
                                    <p style="font-size: 20px;" class="text-center">The Pizzeria</p>
                                    <div class="d-flex" style="position: relative">
                                        <div class="container-input">
                                            <input type="text" placeholder="Search" name="text" class="inputsearch input">
                                            <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="resultSearch" style="overflow: hidden;">
                                            <div class="divfoodsearch" style="width: 100%; height:100%;background-color: whitesmoke; overflow-y: scroll;">

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <ul class="d-flex justify-content-center mt-5" style="list-style: none; width: 100%; font-size: 20px;">
                                    <li style="cursor: pointer" class="home linav">HOME</li>
                                    <li style="cursor: pointer" class="menu linav">OUR MENU</li>
                                    <li style="cursor: pointer" class="about linav">ABOUT</li>
                                    <li style="cursor: pointer" class="offer linav">OFFER</li>
                                    <li style="cursor: pointer" class="contact linav">CONTACT</li>
                                </ul>
                            </div>


                            <?php

                            if (isset($_SESSION["user_id"])) {
                                $id = $_SESSION['user_id'];
                                $select = "select * from account where user_id = '$id'";
                                $result = $conn->query($select);
                                $row = $result->fetch_assoc();
                            }

                            echo isset($_SESSION['user_id']) ? ('<div class="dropdown rounded-circle d-flex justify-content-between" style="height: 80px; width: 120px;">
                            <img class="btn-dropdown rounded-circle" style="height: 75%; width: 65px; cursor:pointer" src="../avatar/' . $row['avatar'] . '" alt="">
        
                            <div class="dropdown-menu">
                            <ul class="ulMenu" aria-labelledby="dropdownMenuButton1" style="list-style: none; padding: 0;">
                                <li><a class="dropdown-item d-flex justify-content-start" href="./usersetting.php?type=myorder"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-pizza-slice"></i>Your Order</a></li>
                                <li><a class="dropdown-item d-flex justify-content-start" href="./usersetting.php?type=profile"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-user"></i>Profile</a></li>
                                <li><a class="dropdown-item d-flex justify-content-start" href="./usersetting.php?type=changepassword"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-lock"></i>Change Password</a></li>
                                <div class = "dropdown-divider p2"></div>
                                <li><a class="dropdown-item d-flex justify-content-start" href="../logout.php" style = "color: red; font-weight: bold; font-size: 15px"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-right-from-bracket"></i>Log Out</a></li>
                            </ul>
                            </div>
                        </div>
                        <script>
                            var dropdowm = document.querySelector(\'.btn-dropdown\');
                        var dropdowm_menu = document.querySelector(\'.dropdown-menu\');
                        </script>'

                            ) : ('<button class="d-flex justify-content-center align-content-center flex-wrap btn_login">
                            LOG IN
                        </button>
                        <script>
                            var dropdowm = null;
                            var dropdowm_menu = null;
                        </script>'
                            );
                            ?>
                        </div>
                        <button class="btn btn-secondary btnNav">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <div class="divToggle w-100 px-4 py-3">
                            <div class="text-end mb-3"><button class="btn btn-secondary btnHide">X</button></div>
                            <div class="d-flex  flex-column">
                                <div class="d-flex justify-content-between">
                                    <div class="icon-header d-flex" style="width: 170px;">
                                        <i class="fa-brands fa-facebook me-2"></i>
                                        <i class="fa-brands fa-twitter me-2"></i>
                                        <i class="fa-brands fa-square-instagram"></i>
                                    </div>
                                    <?php

                                    if (isset($_SESSION["user_id"])) {
                                        $id = $_SESSION['user_id'];
                                        $select = "select * from account where user_id = '$id'";
                                        $result = $conn->query($select);
                                        $row = $result->fetch_assoc();
                                    }

                                    echo isset($_SESSION['user_id']) ? ('<div class="dropdown rounded-circle d-flex justify-content-between" style="height: 80px; width: 120px;">
                            <img class="btn-dropdown rounded-circle" style="height: 75%; width: 65px; cursor:pointer" src="../avatar/' . $row['avatar'] . '" alt="">
        
                            <div class="dropdown-menu">
                            <ul class="ulMenu" aria-labelledby="dropdownMenuButton1" style="list-style: none; padding: 0;">
                                <li><a class="dropdown-item d-flex justify-content-start" href="./usersetting.php?type=myorder"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-pizza-slice"></i>Your Order</a></li>
                                <li><a class="dropdown-item d-flex justify-content-start" href="./usersetting.php?type=profile"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-user"></i>Profile</a></li>
                                <li><a class="dropdown-item d-flex justify-content-start" href="./usersetting.php?type=changepassword"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-lock"></i>Change Password</a></li>
                                <div class = "dropdown-divider p2"></div>
                                <li><a class="dropdown-item d-flex justify-content-start" href="../logout.php" style = "color: red; font-weight: bold; font-size: 15px"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-right-from-bracket"></i>Log Out</a></li>
                            </ul>
                            </div>
                        </div>
                        <script>
                            var dropdowm = document.querySelector(\'.btn-dropdown\');
                        var dropdowm_menu = document.querySelector(\'.dropdown-menu\');
                        </script>'

                                    ) : ('<button class="d-flex justify-content-center align-content-center flex-wrap loginbtn btn_login btn_login1">
                            LOG IN
                        </button>
                        <script>
                            var dropdowm = null;
                            var dropdowm_menu = null;
                        </script>'
                                    );
                                    ?>
                                </div>
                                <div class="">
                                    <div class="d-flex flex-column w-25 divBar" style="gap: 10px;">
                                        <div style="cursor: pointer" class="home linav">HOME</div>
                                        <div style="cursor: pointer" class="menu linav">OUR MENU</div>
                                        <div style="cursor: pointer" class="about linav">ABOUT</div>
                                        <div style="cursor: pointer" class="offer linav">OFFER</div>
                                        <div style="cursor: pointer" class="contact linav">CONTACT</div>
                                    </div>
                                </div>
                                <div class="container-input mt-3 w-100">
                                    <input type="text" placeholder="Search" name="text" class="inputsearch1 input w-100">
                                    <div class="resultSearch1 w-100" style="overflow: hidden;">
                                        <div class="divfoodsearch1" style="width: 100%; height:100%;background-color: whitesmoke; overflow-y: scroll;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="description text-center d-flex flex-column flex-wrap justify-content-center align-content-center" style="width: 1200px; height: 400px;position: absolute; top: 200px; left: 50%; transform: translateX(-50%); color: white;">
            <p style="font-size: 90px;">
                Setting Your Account
            </p>
        </div>

        <div style="width: 100%; height: 700px; background-color:#f7f6f2 ; position: relative; margin-top: 30px;">
            <div style=" position: absolute; background-color:#f7f6f2; height: 100%; width: 75%; left: 50%; transform: translateX(-50%); top: -15%; border-radius: 20px;">
                <?php
                // Lấy giá trị hash từ URL
                $type = isset($_GET['type']) ? $_GET['type'] : 'default';

                // Tùy thuộc vào giá trị hash, hiển thị nội dung tương ứng
                if ($type === 'profile') {
                    include('./profile.php');
                } elseif ($type === 'changepassword') {
                    include('./changepassword.php');
                } elseif ($type === 'myorder') {
                    include('./myorder.php');
                } else {
                    echo "Lỗi";
                }
                ?>

            </div>
        </div>

        <?php include('../layout/footer.php') ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdowns = document.querySelectorAll('.btn-dropdown');
            var dropdownMenus = document.querySelectorAll('.dropdown-menu');

            dropdowns.forEach(function(dropdown, index) {
                dropdown.addEventListener('click', function() {
                    dropdownMenus[index].classList.toggle('show');
                });
            });

            // Đóng dropdown menu khi click bên ngoài
            window.addEventListener('click', function(event) {
                dropdowns.forEach(function(dropdown, index) {
                    if (!dropdown.contains(event.target)) {
                        dropdownMenus[index].classList.remove('show');
                    }
                });
            });
            // Lấy giá trị "hash" từ URL
            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get('type');
            console.log(type);


            if (type) {
                const targetElement = document.querySelector(`.${type}`);
                console.log(targetElement);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    </script>
    <script src="../js/all.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>