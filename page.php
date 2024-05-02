<?php
session_start();
include("./database.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_new/page.css">
    <link rel="stylesheet" href="../css_new/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div class="page" style="height: 100%; width: 100%;">
        <!-- Header -->
        <div class="div-header" style="height: 800px; width: 100%; z-index: -1;">
            <div class="content-header border border-2">
                <div class="content-header-child">
                </div>
                <header class=" ">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between divHeader">
                            <div class="icon-header" style="width: 170px;">
                                <i class="fa-brands fa-facebook me-2"></i>
                                <i class="fa-brands fa-twitter me-2"></i>
                                <i class="fa-brands fa-square-instagram"></i>
                            </div>

                            <div class="navbar-header d-flex flex-column justify-content-center align-content-center flex-wrap" style="width: 1000px;">
                                <div class="d-flex justify-content-between" style="width: 80%; margin:auto">
                                    <p class="text-center pizzas">The Pizzeria</p>
                                    <div class="d-flex" style="position: relative">
                                        <div class="container-input">
                                            <input type="text" placeholder="Search" name="text" class="inputsearch input">

                                        </div>
                                        <div class="resultSearch" style="overflow: hidden;">
                                            <div class="divfoodsearch" style="width: 100%; height:100%;background-color: whitesmoke; overflow-y: scroll;">

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <ul class="d-flex justify-content-center mt-5 ulNav">
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
                                <li><a class="dropdown-item d-flex justify-content-start" href="../component/usersetting.php?type=myorder"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-pizza-slice"></i>Your Order</a></li>
                                <li><a class="dropdown-item d-flex justify-content-start" href="../component/usersetting.php?type=profile"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-user"></i>Profile</a></li>
                                <li><a class="dropdown-item d-flex justify-content-start" href="../component/usersetting.php?type=changepassword"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-lock"></i>Change Password</a></li>
                                <div class = "dropdown-divider p2"></div>
                                <li><a class="dropdown-item d-flex justify-content-start" href="../logout.php" style = "color: red; font-weight: bold; font-size: 15px"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-right-from-bracket"></i>Log Out</a></li>
                            </ul>
                            </div>
                        </div>
                        '

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
                                <li><a class="dropdown-item d-flex justify-content-start" href="../component/usersetting.php?type=myorder"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-pizza-slice"></i>Your Order</a></li>
                                <li><a class="dropdown-item d-flex justify-content-start" href="../component/usersetting.php?type=profile"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-user"></i>Profile</a></li>
                                <li><a class="dropdown-item d-flex justify-content-start" href="../component/usersetting.php?type=changepassword"><i style = "padding: 5px 20px 0 0" class="fa-solid fa-lock"></i>Change Password</a></li>
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
            <p class="titleHeader">
                Authentic Italian Pizzeria
            </p>
            <div class="descriptionHeader" style="">
                Et praesent nulla urna consequat dui arcu cursus diam fringilla libero risus, aliquam diam, aliquam
                ullamcorper urna pulvinar velit suspendisse aliquam lacus sollicitudin mauris.
            </div>
            <br><br>
            <div class="text-center">
                <button class="btn btn-danger" style="width: 180px; height: 45px;"><a href="#pagemenu" style="text-decoration: none; color: white">ORDER NOW</a></button>
            </div>
        </div>

        <!-- detail about products -->
        <div class="div-detail border border-4 mt-2 d-flex justify-content-evenly" style="position: relative; width: 100%; height: auto; background-color: #f7f6f2;">
            <div style="height: 400px; width: 400px;position: absolute; top: -35%; left: 50%; transform: translateX(-50%); z-index: 1;">
                <img class="best-pizza" style="height: 400px; width: 400px; " src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-header-pizza-img.png" alt="...">
            </div>
            <div class="container-fluid divCircle">
                <div class="row ">
                    <div class="col-md-4 col-12 fresh d-flex flex-column justify-content-center flex-wrap align-content-center">
                        <div class="" style="width: 100%; text-align: center;">
                            <img style="height: 240px; width: 240px;" class="rounded-circle shadow-lg img-detail" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-fresh-ingredients-img.jpg" alt="...">
                        </div>
                        <p style="color: red; font-size: 30px; text-align: center; font-weight: bold;">Fresh Ingredients</p>
                        <p class="" style="text-align: center;">Risus egestas felis, purus ultricies tortor feugiat aliquam
                            euismod senectus sed amet felis viverra
                            mi bibendum.</p>
                    </div>
                    <div class="col-md-4 col-12 handmade d-flex flex-column justify-content-center flex-wrap align-content-center">
                        <div style="width: 100%; text-align: center;">
                            <img class="rounded-circle img-detail" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-homemade-mozarella.jpg" alt="...">
                        </div>
                        <p style="color: red; font-size: 30px; text-align: center; font-weight: bold;">Handmade Mozarella</p>
                        <p style="text-align: center;">
                            Feugiat neque, rhoncus suspendisse proin amet aliquet diam pretium condimentum nisl tempus risus
                            imperdiet egestas sit.
                        </p>
                    </div>
                    <div class="col-md-4 col-12 secret-sauce d-flex flex-column justify-content-center flex-wrap align-content-center">
                        <div style="width: 100%; text-align: center;">
                            <img src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-secret-recipe-sauce-img.jpg" alt="..." class="rounded-circle img-detail">
                        </div>
                        <p style="color: red; font-size: 30px; text-align: center; font-weight: bold;">"Secret Recipe" Sauce</p>
                        <p style="text-align: center;">
                            Placerat id sagittis dolor dictum sit ante dui varius dui eu iaculis pellentesque nam lobortis
                            lectus.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bring to you -->
        <div class="bring-to-you" style="width: 100%; height: auto; position: relative; z-index: -2;">
            <div class="bg-color" style="position: absolute;top: 0; left: 0;height: 100%; width: 100%; background-color: #121212;
            opacity: 0.7; z-index: -1;">
            </div>
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-4 col-12 text-white" style=" padding-top: 70px;">
                        <p style="font-size: 65px; font-weight: bold;"> Bringing Happiness To You
                        </p>
                        <p style="font-weight: bold; font-size: 15px;">Tellus id nisl quis at sollicitudin nisl nisi
                            tincidunt purus .</p>
                    </div>
                    <div class="text-white col-md-4 col-12 d-flex flex-column align-content-center flex-wrap " style="  padding-top: 140px;">
                        <div style="width: 100%;">
                            <div style="height: 130px; width: 130px; background-color: red; position: relative; margin: auto;" class="rounded-circle ">
                                <i style=" font-size: 65px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" class="fa-solid fa-earth-americas"></i>
                            </div>
                        </div>
                        <br>
                        <p class="text-center" style="font-size: 30px; font-weight: bold; width: 100%;">
                            Online Delivery
                        </p>
                        <br>
                        <p class="text-center" style="font-size: 20px; font-weight: bold; width: 100%; cursor: pointer;">
                            ORDER ONLINE ->
                        </p>
                    </div>
                    <div class="text-white col-md-4 col-12 d-flex flex-column align-content-center flex-wrap " style="  padding-top: 140px;">
                        <div style="width: 100%;">
                            <div style="height: 130px; width: 130px; background-color: red; position: relative; margin: auto;" class="rounded-circle ">
                                <i style=" font-size: 65px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" class="fa-solid fa-box"></i>
                            </div>
                        </div>
                        <br>
                        <p class="text-center" style="font-size: 30px; font-weight: bold; width: 100%;">
                            Click & Collect
                        </p>
                        <br>
                        <p class="text-center" style="font-size: 20px; font-weight: bold; width: 100%; cursor: pointer;">
                            TAKEOUT ORDER ->
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Menu -->
        <div id="pagemenu" class="mb-2" style="width: 100%; height: auto; position: relative;">

            <div class="d-flex flex-column flex-wrap align-content-center" style="height: 80%; width: 100%; z-index: 2; padding-top: 80px;">
                <p style="color: red; font-weight: bold; font-size: 20px; width: 100%; text-align: center;">Choose your
                    Flavor</p>
                <p style="font-size: 65px; font-weight: bold; color: black; width: 100%; text-align: center;">Food that
                    brings people together!</p>
                <p style="width: 100%; text-align: center;">
                    Cursus ultricies in maecenas pulvinar ultrices integer quam amet, semper dictumst sit interdum ut
                    venenatis pellentesque nunc.
                </p>
                <div style="width: 100%; text-align: center;" class="mt-4">
                    <button class="btn-view-all btn-view-all-menu" style="border: 1px solid red;  height: 50px; width: 200px; border-radius: 10px; ">
                        View Our Menu
                    </button>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-evenly" style="width: 100%">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-lg-4 col-12 d-flex flex-column justify-content-between food-item ">
                            <div class="text-center">
                                <img class="food-image img-snacks" style="height: 350px; width: 350px;" src="../public/cookie.png" alt="...">
                            </div>
                            <p style="width: 100%; text-align: center; color: red; font-size: 30px; font-weight: bold;">Snacks
                            </p>
                        </div>
                        <div class="col-lg-4 col-12 d-flex flex-column justify-content-between food-item">
                            <div class="text-center">
                                <img class="food-image img-fastfood" style="height: 350px; width: 350px;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-menu-pizza-img.png" alt="...">
                            </div>
                            <p style="width: 100%; text-align: center; color: red; font-size: 30px; font-weight: bold;">Fast
                                Food</p>
                        </div>
                        <div class="col-lg-4 col-12 d-flex flex-column justify-content-between food-item ">
                            <div class="text-center">
                                <img class="food-image img-drink" style="height: 350px; width: 350px;" src="../public/drink.png" alt="...">
                            </div>
                            <p style="width: 100%; text-align: center; color: red; font-size: 30px; font-weight: bold;">Drink
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales -->
        <div style="background-color: #f7f6f2; width: 100%; height: 1040px;">
            <br><br><br>
            <div class="infor d-flex justify-content-between align-content-center flex-wrap" style="width: 80%; margin: auto;">
                <p style="font-size: 65px; font-weight: bold;">Best Deals!</p>
                <div class="d-flex align-items-center">
                    <button class="btn-view-all btn-view-all-offer" style=" border: 1px red solid; height: 45px; width: 135px; border-radius: 5px;">VIEW
                        ALL</button>
                </div>
            </div>
            <div style="display: grid; row-gap: 30px; column-gap: 10px; margin-top: 50px; grid-template-rows: 400px 400px; grid-template-columns: 600px 600px; margin: auto; width: 80%;">
                <div class="first-sale" style="grid-column: 1/ span 1; grid-row: 1/ span 1; position: relative; ">
                    <img style="width: 120%; height: 100%;border-radius: 20px;z-index: -1;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-1.jpg" alt="...">
                    <div class="circle text-center d-flex flex-column justify-content-around" style="position: absolute; top: 10%; left: 17%; border-radius: 50%; height: 130px; width: 130px; color: white; z-index: 1; background-color: #e4032f;">
                        <p class="" style="font-size: 30px; margin: 0; padding-top: 15px;">SAVE</p>
                        <p style="font-size: 30px; height: 53px;">50%</p>
                    </div>
                </div>
                <div style=" position: relative; border-radius: 20px; z-index: 1; grid-column: 0/ span1;grid-row: 1/ span 1;background-image: url('https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-shape-bg-1.svg');">
                    <div class="" style="padding-left: 19px; top: 50%; left: 59%; transform: translate(-50%, -50%); height: 80%; width: 90%; position: absolute;">
                        <p style="font-size: 20px; color: yellow;">Daily Deal!!</p>
                        <p style="font-size: 65px; color: white;">Big Meat Monsta</p>
                        <p style="font-size: 90px; color: white;">$18</p>
                    </div>
                </div>
                <div class="secone-sale" style="grid-column: 1/span 1; grid-row: 2/span 1; position: relative;">
                    <div>
                        <img style="z-index: -1; border-radius: 20px; height: 100%; width: 100%;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-2.jpg" alt="...">
                        <div style="border-radius: 20px; position: absolute; right: -61px; top: 0; height: 100%; width: 60%; z-index: 1; background-image: url('https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-shape-bg-2.svg'); background-repeat: no-repeat;">
                            <div class="" style="position: absolute; right: 17%; width: 80%; top: 10%; height: 70%;">
                                <p style="color: yellow; font-size: 40px; width: 100%;text-align: end; padding-right: 10px; margin: 0;">
                                    Combo Double</p>
                                <p style="color: yellow; font-size: 40px; width: 100%; text-align: end;padding-right: 10px; padding-bottom: 10px;">
                                    Box</p>
                                <p style="font-size: 90px; color: white; width: 100%; text-align: end;padding-right: 10px;">
                                    $24</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="third-sale" style="grid-column: 2/span 1; grid-row: 2/span 1; position: relative;">
                    <img style="z-index: -1; border-radius: 20px; height: 100%; width: 100%;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-3.jpg" alt="...">
                    <div style="background-color: red; position: absolute; right: 0; top: 0; height: 100%; width: 45%; z-index: 1;clip-path: polygon(50% 0%, 100% 0, 100% 35%, 100% 70%, 100% 100%, 50% 100%, 28% 100%, 0 35%, 21% 0); border-radius: 20px;">
                        <div class="" style="position: absolute; right: 17%; width: 80%; top: 10%; height: 70%;">
                            <p style="color: yellow; font-size: 40px; width: 100%;text-align: end; padding-right: 10px; margin: 0;">
                                Italian
                                Stallion</p>
                            <p style="font-size: 90px; color: white; width: 100%; text-align: end;padding-right: 10px;">
                                $16</p>
                        </div>
                    </div>
                    <div class="circle text-center d-flex flex-column justify-content-around" style="position: absolute; top: 10%; left: 44%; border-radius: 50%; height: 130px; width: 130px; color: black; z-index: 2; background-color: #fecc00;">
                        <p class="" style="font-size: 30px; margin: 0; padding-top: 15px;">SAVE</p>
                        <p style="font-size: 30px; height: 53px;">30%</p>
                    </div>
                </div>
            </div>
        </div>

        <?php include('./layout/footer.php') ?>
    </div>

    <script src="./js/all.js"></script>
    <script>
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>