<?php
session_start();
include('../database.php');
if (isset($_SERVER['HTTP_REFERER'])) {
    $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
}
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $sql = "SELECT food_id FROM favor WHERE user_id = '$id'";
    $result_sql = $conn->query($sql);
    if ($result_sql->num_rows > 0) {
        while ($row_favor = $result_sql->fetch_assoc()) {
            $favoriteFoods[] = $row_favor['food_id'];
        }
    }
}
$select_snack = "SELECT * from foods where type = 'Snacks' LIMIT 0, 4";
$snacks = $conn->query($select_snack);



$select_fastfood = "SELECT * from foods where type = 'Fastfood' LIMIT 0, 4";
$fastfood = $conn->query($select_fastfood);


$select_drink = "SELECT * from foods where type = 'Drink' LIMIT 0, 4";
$drink = $conn->query($select_drink);

$favoriteFoods = array();
$discount = array();
$sql_discount = "select foodid, discount from salefood";
$result_discount = $conn->query($sql_discount);
if ($result_discount->num_rows > 0) {
    while ($row_discount = $result_discount->fetch_assoc()) {
        $discount[] = $row_discount['foodid'];
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_new/ourMENU.css">
    <link rel="stylesheet" href="../css_new/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div class="page" style="height: 100%; width: 100%;">
        <?php
        include('../layout/setHeader.php');
        $page = 'menu';
        $pageInfo = setPageInfo($page);
        include('../layout/header.php')
        ?>
        <!-- food items -->
        <div class="" style="width: 100%; height: auto; background-color: #f7f6f2">
            <div class="mt-3 d-flex justify-content-evenly" style="width: 100%; ">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-4 col-12 d-flex flex-column justify-content-between food-item " style="height: 300px">
                            <div class="text-center p-4">
                                <img class="food-image image-snacks" style="height: 350px; width: 350px;" src="../public/pobcorn.png" alt="...">
                            </div>
                            <p style="width: 100%; text-align: center; color: red; font-size: 30px; font-weight: bold;">Snacks
                            </p>
                        </div>
                        <div class="col-lg-4 col-12 d-flex flex-column justify-content-between food-item" style="height: 300px;">
                            <div class="text-center p-4">
                                <img class="food-image image-fastfood" style="height: 350px; width: 350px;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-menu-pizza-img.png" alt="...">
                            </div>
                            <p style="width: 100%; text-align: center; color: red; font-size: 30px; font-weight: bold;">Fast
                                Food</p>
                        </div>
                        <div class="col-lg-4 col-12 d-flex flex-column justify-content-between food-item " style="height: 300px;">
                            <div class="text-center p-4">
                                <img class="food-image image-drink" style="height: 350px; width: 350px;" src="../public/tsmt.png" alt="...">
                            </div>
                            <p style="width: 100%; text-align: center; color: red; font-size: 30px; font-weight: bold;">Drink
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Snacks -->
        <div class="divSnacks" style=" width: 100%; margin: 0;background-color: #f7f6f2; height: auto;">
            <div class="d-flex justify-content-between" style="width: 80%; margin: 0 auto; padding-top: 150px;">
                <p style="flex: 4; color: red; font-weight: bold; font-size: 50px;">Snacks</p>
                <p style="flex: 6; font-size: 20px;">Snacks, hay đồ ăn vặt, là các món ăn nhẹ và thường nhỏ trong kích
                    thước, được thường xuyên tiêu
                    thụ giữa các bữa chính. Chúng thường có mục đích giảm đói hoặc thỏa mãn nhu cầu ngon miệng và
                    giải trí. </p>
            </div>
            <!-- div hash -->
            <div style="width: 80%; margin: auto; height: 1px; background-color: red;"></div>
            <div style="width: 80%; margin: auto; text-align: end; padding-top: 20px;"><button class="btn-show-snacks btn-show">View All</button></div>
            <!-- Menu pasta -->
            <div class="d-flex flex-column" style="position: relative;">
                <div class="container" style="height: auto; padding-top: 10px">
                    <div class="row g-3">
                        <?php
                        while ($row = $snacks->fetch_assoc()) {
                            $isDiscount = in_array($row['id'], $discount);

                            $foodName = $row['name'];
                            $foodPrice = $row['price'];
                            $foodImage = $row['image'];
                            $foodDetail = $row['detail'];
                            $discountValue = 0;
                            $foodId = $row['id'];
                            $sql_discount_value = "SELECT discount FROM salefood WHERE foodid = '$foodId'";
                            $result_discount_value = $conn->query($sql_discount_value);

                            if ($result_discount_value->num_rows > 0) {
                                $row_discount_value = $result_discount_value->fetch_assoc();
                                $discountValue = $row_discount_value['discount'];
                            }

                            // Tính giá mới sau giảm giá
                            $originalPrice = $row['price'];
                            $discountedPrice = $originalPrice - ($originalPrice * $discountValue / 100);
                        ?>
                            <div class="d-flex div-food col-md-6 col-12" style=" margin-bottom: 50px; height: 210px;">
                                <img style="height: 120px; width: 170px; border-radius: 10px; flex: 3;" src="../foodimage/<?php echo ($foodImage) ?>" alt="...">
                                <div class="text-start d-flex flex-column justify-content-between" style="flex: 6; padding-left: 25px;">
                                    <div class="d-flex justify-content-start">
                                        <p class="d-flex" style="font-weight: bold; font-size: 30px;;"><?php echo $foodName ?></p>
                                        <?php if ($isDiscount) : ?>
                                            <?php
                                            // Truy vấn cơ sở dữ liệu để lấy giá trị giảm giá cho món ăn
                                            $discountValue = 0; // Giá trị giảm giá mặc định là 0
                                            $foodId = $row['id'];
                                            $sql_discount_value = "SELECT discount FROM salefood WHERE foodid = '$foodId'";
                                            $result_discount_value = $conn->query($sql_discount_value);
                                            if ($result_discount_value->num_rows > 0) {
                                                $row_discount_value = $result_discount_value->fetch_assoc();
                                                $discountValue = $row_discount_value['discount'];
                                            }
                                            ?>
                                            <?php echo '<div style="position: relative; margin-top:3px; border-radius: 5px; text-align: center; height: 30px; width: 70px; background-color: red; color: white; margin-top: 10px; margin-left: 20px; transform: rotate(25deg); font-weight: bold ">' . $discountValue . '%<i class="fa-solid fa-link" style="position: absolute; top: 4px; left: -13px; color: orange; font-size: 20px"></i></div>' ?>
                                        <?php endif; ?>
                                    </div>
                                    <p style="font-size: 15px;"><?php echo $foodDetail ?></p>
                                    <div class="d-flex justify-content-between" style="width: 100%;">

                                        <p class="d-flex justify-content-center" style="font-size: 20px;">
                                            <?php if ($discountValue > 0) { ?>
                                                <span style="text-decoration: line-through; font-weight: bold; color: black; padding-right: 40px;">$ <?php echo $originalPrice ?></span>
                                                <span style="color: red">$ <?php echo $discountedPrice; ?></span>
                                            <?php } else { ?>
                                                <span style="font-weight: bold; color: black; padding-right: 40px;">$ <?php echo $originalPrice ?></span>
                                            <?php } ?>
                                        </p>
                                        <button class="btn btn-success btnadd" style="width: 30%" data-type="<?php echo $row['type'] ?>" value='<?php echo $row['id'] ?>'><i style="font-size: 20px; color: white; padding-top: 3px" class="fa-solid fa-cart-shopping"></i></button>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        /* endwhile; */
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <!-- Drink -->
        <div class="divDrink" style="width: 100%; margin-top: 150px; height: auto; background-color:#f7f6f2 ; position: relative; ">
            <!-- Discount -->
            <div style="position: absolute; top: -150px;width: 100%; left: 50%; transform: translateX(-50%); z-index: 2;">
                <div class="first-sale" style=" position: relative; width: 80%; height: 400px; margin: 0 auto;">
                    <img style="width: 100%; height: 100%;border-radius: 20px;z-index: -1;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-1.jpg" alt="...">
                    <div class="circle text-center d-flex flex-column justify-content-around" style="position: absolute; top: 10%; left: 17%; border-radius: 50%; height: 130px; width: 130px; color: white; z-index: 1; background-color: #e4032f;">
                        <p class="" style="font-size: 30px; margin: 0; padding-top: 15px;">SAVE</p>
                        <p style="font-size: 30px; height: 53px;">50%</p>
                    </div>
                    <div style="position: absolute; top: 0; height: 100%; width: 600px; right: 0">
                        <div style="height: 100%; width: 100%; position: relative; border-radius: 20px; z-index: 1;background-image: url('https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-shape-bg-1.svg');">
                            <div class="" style="padding-left: 19px; top: 58%; left: 65%; transform: translate(-50%, -50%); height: 100%; width: 100%; position: absolute;">
                                <p style="font-size: 20px; color: yellow;">Daily Deal!!</p>
                                <p style="font-size: 65px; color: white;">Big Meat Monsta</p>
                                <p style="font-size: 90px; color: white;">$18</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="" style=" width: 100%; margin: 0;background-color: #f7f6f2; height: auto;  top: 25%; padding-top: 120px;">
                <div class="d-flex justify-content-between" style="width: 80%; margin: 0 auto; padding-top: 150px;">
                    <p style="flex: 4; color: red; font-weight: bold; font-size: 50px;">Drink</p>
                    <p style="flex: 6; font-size: 20px;">"Drink" (đồ uống) là một thuật ngữ chung để chỉ mọi thứ mà con người uống để giải khát hoặc thỏa mãn sự khát. Đồ uống có thể bao gồm nhiều loại, bao gồm nước, nước trái cây, nước ngọt, trà, cà phê, bia, rượu, và nhiều loại thức uống khác.</p>
                </div>

                <!-- div hash -->
                <div style="width: 80%; margin: auto; height: 0.5px; background-color: red;"></div>
                <div style="width: 80%; margin: auto; text-align: end; padding-top: 20px;"><button class="btn-show-drink btn-show">View All</button></div>

                <div class="d-flex flex-column" style="position: relative;">
                    <div class="container" style="height: auto; padding-top: 10px">
                        <div class="row g-3">

                            <?php

                            while ($row = $drink->fetch_assoc()) {
                                $isDiscount = in_array($row['id'], $discount);

                                $foodName = $row['name'];
                                $foodPrice = $row['price'];
                                $foodImage = $row['image'];
                                $foodDetail = $row['detail'];
                                $discountValue = 0;
                                $foodId = $row['id'];
                                $sql_discount_value = "SELECT discount FROM salefood WHERE foodid = '$foodId'";
                                $result_discount_value = $conn->query($sql_discount_value);

                                if ($result_discount_value->num_rows > 0) {
                                    $row_discount_value = $result_discount_value->fetch_assoc();
                                    $discountValue = $row_discount_value['discount'];
                                }

                                // Tính giá mới sau giảm giá
                                $originalPrice = $row['price'];
                                $discountedPrice = $originalPrice - ($originalPrice * $discountValue / 100);
                            ?>
                                <div class="col-md-6 col-12 d-flex div-food" style=" margin-bottom: 50px; height: 210px;">
                                    <img style="height: 120px; width: 170px; border-radius: 10px; flex: 3;" src="../foodimage/<?php echo ($foodImage) ?>" alt="...">
                                    <div class="text-start d-flex flex-column justify-content-between" style="flex: 6; padding-left: 25px;">
                                        <div class="d-flex justify-content-start">
                                            <p class="d-flex" style="font-weight: bold; font-size: 30px;;"><?php echo $foodName ?></p>
                                            <?php if ($isDiscount) : ?>
                                                <?php

                                                $discountValue = 0;
                                                $foodId = $row['id'];
                                                $sql_discount_value = "SELECT discount FROM salefood WHERE foodid = '$foodId'";
                                                $result_discount_value = $conn->query($sql_discount_value);
                                                if ($result_discount_value->num_rows > 0) {
                                                    $row_discount_value = $result_discount_value->fetch_assoc();
                                                    $discountValue = $row_discount_value['discount'];
                                                }
                                                ?>
                                                <?php echo '<div style="position: relative; margin-top:3px; border-radius: 5px; text-align: center; height: 30px; width: 70px; background-color: red; color: white; margin-top: 10px; margin-left: 20px; transform: rotate(25deg); font-weight: bold ">' . $discountValue . '%<i class="fa-solid fa-link" style="position: absolute; top: 4px; left: -13px; color: orange; font-size: 20px"></i></div>' ?>
                                            <?php endif; ?>
                                        </div>
                                        <p style="font-size: 15px;"><?php echo $foodDetail ?></p>
                                        <div class="d-flex justify-content-between" style="width: 100%;">
                                            <p class="d-flex justify-content-center" style="font-size: 20px;">
                                                <?php if ($discountValue > 0) { ?>
                                                    <span style="text-decoration: line-through; font-weight: bold; color: black; padding-right: 40px;">$ <?php echo $originalPrice ?></span>
                                                    <span style="color: red">$ <?php echo $discountedPrice; ?></span>
                                                <?php } else { ?>
                                                    <span style="font-weight: bold; color: black; padding-right: 40px;">$ <?php echo $originalPrice ?></span>
                                                <?php } ?>
                                            </p>
                                            <button class="btn btn-success btnadd" style="width: 30%" data-type="<?php echo $row['type'] ?>" value='<?php echo $row['id'] ?>'><i style="font-size: 20px; color: white; padding-top: 3px" class="fa-solid fa-cart-shopping"></i></button>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            }

                            ?>
                            <!-- <div class="d-flex justify-content-end" style="margin: auto; width: 80%;">
                    <div class="">
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="ourMENU.php?page=<?php echo $prev_page; ?>">Previous</a></li>
                                <?php
                                for ($i = 1; $i <= $total_page; $i++) {
                                    echo '<li class="page-item"><a class="page-link" href="ourMENU.php?page=' . $i . '">' . $i . '</a></li>';
                                }
                                ?>
                                <li class="page-item"><a class="page-link" href="ourMENU.php?page=<?php echo $next_page; ?>">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fastfood -->
        <div class="divFastfood" style="height: auto; width: 100%; background-color:#f7f6f2;  margin-top: 100px;">
            <div class="d-flex justify-content-between" style="width: 80%; margin: 0 auto; padding-top: 150px;">
                <p style="flex: 4; color: red; font-weight: bold; font-size: 50px;">Fast food</p>
                <p style="flex: 6; font-size: 20px;">Đồ ăn fast food là một loại thực phẩm nhanh chóng và thuận tiện, thường được cung cấp tại các nhà hàng hoặc quán ăn nhanh </p>
            </div>
            <!-- div hash -->
            <div style="width: 80%; margin: auto; height: 1px; background-color: red;"></div>
            <div style="width: 80%; margin: auto; text-align: end; padding-top: 20px;"><button class="btn-show-fastfood btn-show">View All</button></div>
            <!-- Menu pasta -->
            <div class="d-flex flex-column" style="position: relative;">
                <div class="container" style="height: auto; padding-top: 10px">
                    <div class="row g-3">

                        <?php

                        while ($row = $fastfood->fetch_assoc()) {
                            $isDiscount = in_array($row['id'], $discount);

                            $foodName = $row['name'];
                            $foodPrice = $row['price'];
                            $foodImage = $row['image'];
                            $foodDetail = $row['detail'];
                            $discountValue = 0;
                            $foodId = $row['id'];
                            $sql_discount_value = "SELECT discount FROM salefood WHERE foodid = '$foodId'";
                            $result_discount_value = $conn->query($sql_discount_value);

                            if ($result_discount_value->num_rows > 0) {
                                $row_discount_value = $result_discount_value->fetch_assoc();
                                $discountValue = $row_discount_value['discount'];
                            }

                            // Tính giá mới sau giảm giá
                            $originalPrice = $row['price'];
                            $discountedPrice = $originalPrice - ($originalPrice * $discountValue / 100);
                        ?>
                            <div class="col-md-6 col-12 d-flex div-food " style="margin-bottom: 50px; height: 210px;">
                                <img style="height: 120px; width: 170px; border-radius: 10px; flex: 3;" src="../foodimage/<?php echo ($foodImage) ?>" alt="...">
                                <div class="text-start d-flex flex-column justify-content-between" style="flex: 6; padding-left: 25px; position: relative;">
                                    <div class="d-flex justify-content-start">
                                        <p class="d-flex" style="font-weight: bold; font-size: 30px;;"><?php echo $foodName ?></p>
                                        <?php if ($isDiscount) : ?>
                                            <?php
                                            // Truy vấn cơ sở dữ liệu để lấy giá trị giảm giá cho món ăn
                                            $discountValue = 0; // Giá trị giảm giá mặc định là 0
                                            $foodId = $row['id'];
                                            $sql_discount_value = "SELECT discount FROM salefood WHERE foodid = '$foodId'";
                                            $result_discount_value = $conn->query($sql_discount_value);
                                            if ($result_discount_value->num_rows > 0) {
                                                $row_discount_value = $result_discount_value->fetch_assoc();
                                                $discountValue = $row_discount_value['discount'];
                                            }
                                            ?>
                                            <?php echo '<div style="position: relative; margin-top:3px; border-radius: 5px; text-align: center; height: 30px; width: 70px; background-color: red; color: white; margin-top: 10px; margin-left: 20px; transform: rotate(25deg); font-weight: bold ">' . $discountValue . '%<i class="fa-solid fa-link" style="position: absolute; top: 4px; left: -13px; color: orange; font-size: 20px"></i></div>' ?>
                                        <?php endif; ?>
                                    </div>

                                    <p style="font-size: 15px;"><?php echo $foodDetail ?></p>
                                    <div class="d-flex justify-content-between" style="width: 100%;">
                                        <p class="d-flex justify-content-center" style="font-size: 20px;">
                                            <?php if ($discountValue > 0) { ?>
                                                <span style="text-decoration: line-through; font-weight: bold; color: black; padding-right: 40px;">$ <?php echo $originalPrice ?></span>
                                                <span style="color: red">$ <?php echo $discountedPrice; ?></span>
                                            <?php } else { ?>
                                                <span style="font-weight: bold; color: black; padding-right: 40px;">$ <?php echo $originalPrice ?></span>
                                            <?php } ?>
                                        </p>
                                        <button class="btn btn-success btnadd" style="width: 30%" data-type="<?php echo $row['type'] ?>" value='<?php echo $row['id'] ?>'><i style="font-size: 20px; color: white; padding-top: 3px" class="fa-solid fa-cart-shopping"></i></button>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        /* endwhile; */
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php include('../layout/footer.php') ?>
    </div>
    <script src="../js/all.js"> </script>
    <script>
        var btnadds = document.querySelectorAll('.btnadd')
        btnadds.forEach(btnadd => {
            btnadd.addEventListener('click', function() {
                window.location.href = `detailfood.php?id=${btnadd.getAttribute('value')}&type=${btnadd.getAttribute('data-type')}`;
            })
        })
        if (dropdowm) {
            dropdowm.addEventListener('click', function() {
                dropdowm_menu.classList.toggle('show');
            });
        }

        function scrollToElement(hash) {
            var elementIdMap = {
                "#snacks": ".divSnacks",
                "#fastfood": ".divFastfood",
                "#drink": ".divDrink",
            };

            var targetElement = document.querySelector(elementIdMap[hash]);
            if (targetElement) {
                targetElement.scrollIntoView();
            }
        }
        scrollToElement(window.location.hash);
        var snacks = document.querySelector('.image-snacks')
        var fastfood = document.querySelector('.image-fastfood')
        var drink = document.querySelector('.image-drink')

        var snacksShow = document.querySelector('.btn-show-snacks')
        var fastfoodShow = document.querySelector('.btn-show-fastfood')
        var drinkShow = document.querySelector('.btn-show-drink')

        snacksShow.addEventListener('click', function() {
            window.location.href = "./food.php?type=Snacks"
        })
        fastfoodShow.addEventListener('click', function() {
            window.location.href = "./food.php?type=Fastfood"
        })
        drinkShow.addEventListener('click', function() {
            window.location.href = "./food.php?type=Drink"
        })

        snacks.addEventListener('click', function() {
            var snacks = document.querySelector(".divSnacks");
            if (snacks) {
                snacks.scrollIntoView();
            }
        })

        fastfood.addEventListener('click', function() {
            var fastfoodDiv = document.querySelector(".divFastfood");
            if (fastfoodDiv) {
                fastfoodDiv.scrollIntoView();
            }
        })

        drink.addEventListener('click', function() {
            var drink = document.querySelector(".divDrink");
            if (drink) {
                drink.scrollIntoView();
            }
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>