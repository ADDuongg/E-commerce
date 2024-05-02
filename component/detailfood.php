<?php
error_reporting(E_ALL);

session_start();
include('../database.php');
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT food_id FROM favor WHERE user_id = '$user_id'";
    $result_sql = $conn->query($sql);
   
    if ($result_sql->num_rows > 0) {
        while ($row_favor = $result_sql->fetch_assoc()) {
            $favoriteFoods[] = $row_favor['food_id'];
        }
    }
}

$id = $_GET['id'];
$type = $_GET['type'];
$isUserSet = isset($user_id) ? $user_id : '';

$select = "select * from foods where id = '$id'";
$result = $conn->query($select);

$select_flavor = "select flavor from foods where id = '$id'";
$result_flavor = $conn->query($select_flavor);
$row1 = $result_flavor->fetch_assoc();

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css_new/detailfood.css">
    <link rel="stylesheet" href="../css_new/all.css">
    <link rel="stylesheet" href="../css_new/switter.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <title>Document</title>
</head>

<body>
    
    <div class="page" style="height: 100%; width: 100%; background-color: #fafafa;">

        <!-- Header -->
        <?php
        include('../layout/setHeader.php');
        $page = 'fooddetail';
        $pageInfo = setPageInfo($page);
        include('../layout/header.php')
        ?>

        <div class="border border-2 d-flex flex-column justify-content-evenly" style="overflow: hidden; border-radius: 40px;  background-color: white; height: 1700px; width: 60%; margin: auto; margin-top: 10px;">
            <div class="divDetailFood" style="flex: 2; padding: 20px; position: relative;">
                <?php
                while ($row = $result->fetch_assoc()) {
                   
                ?>
                    <div style="width: 100%; height: auto">
                        <div class="container">
                            <div class="row g-3">
                                <img class="foodimage col-md-5 col-12" style="  " src="../foodimage/<?php echo $row['image'] ?>" alt="">
                                <div class="col-md-7 col-12" style="   display: flex; flex-direction: column; justify-content: space-between;">
                                    <div>
                                        <div class="d-flex justify-content-between" style="width: 100%;">
                                            <div>
                                                <p class="foodname"><?php echo $row['name'] ?></p>

                                                <?php
                                                $discountValue = 0;
                                                $foodId = $row['id'];
                                                $sql_discount_value = "SELECT discount FROM salefood WHERE foodid = '$foodId'";
                                                $result_discount_value = $conn->query($sql_discount_value);

                                                if ($result_discount_value->num_rows > 0) {
                                                    $row_discount_value = $result_discount_value->fetch_assoc();
                                                    $discountValue = $row_discount_value['discount'];
                                                }


                                                $originalPrice = $row['price'];
                                                $discountedPrice = $originalPrice - ($originalPrice * $discountValue / 100);
                                                $originalPrice_medium = $row['price_medium'];
                                                $discountedPrice_medium = $originalPrice_medium - ($originalPrice_medium * $discountValue / 100);
                                                $originalPrice_large = $row['price_large'];
                                                $discountedPrice_large = $originalPrice_large - ($originalPrice_large * $discountValue / 100);
                                                ?>
                                                <p class="d-flex justify-content-center" style="font-size: 20px;">
                                                    <?php if ($discountValue > 0) { ?>
                                                        <span class="price discount_dash ">$ <?php echo $originalPrice ?></span>
                                                        <span class="price_medium discount_dash inactice">$ <?php echo $originalPrice_medium ?></span>
                                                        <span class="price_large discount_dash inactice">$ <?php echo $originalPrice_large ?></span>
                                                        <span class="d_price active" id="foodprice" style="color: red;">$ <?php echo $discountedPrice; ?></span>
                                                        <span class="d_price_medium inactice" id="foodprice" style="color: red;">$ <?php echo $discountedPrice_medium; ?></span>
                                                        <span class="d_price_large inactice" id="foodprice" style="color: red;">$ <?php echo $discountedPrice_large; ?></span>
                                                    <?php } else { ?>
                                                        <span class="price normal " id="foodprice">$ <?php echo $originalPrice ?></span>
                                                        <span class="price_medium normal inactice" id="foodprice">$ <?php echo $originalPrice_medium ?></span>
                                                        <span class="price_large normal inactice" id="foodprice">$ <?php echo $originalPrice_large ?></span>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                            <i style="color: red; font-size: 30px;" class="fa-regular fa-heart"></i>
                                        </div>
                                        <p class="fooddetails"><?php echo $row['detail'] ?></p>

                                        <!-- star -->
                                        <div class="d-flex justify-content-start" style="width: 100%;">
                                            <div style=" display: inline-block; width: 75%;">
                                                <?php

                                                for ($i = 1; $i <= $row1['flavor']; $i++) {
                                                ?>
                                                    <i class="fa-solid fa-star" style="font-size: 30px; color: #f5f514;"></i>
                                                <?php
                                                }
                                                ?>
                                            </div>


                                            <?php
                                            if ($row['state'] == 1) {
                                            ?>
                                                <div class="status" style="color: red; text-align: center;">Hết hàng</div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="status" style="color: green; text-align:center">Còn hàng</div>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <!-- Plus Minus -->
                                        <div class="d-flex justify-content-between">
                                            <div style="width: 40%; display: flex;justify-content: space-between; margin-top: 20px;">
                                                <button class="btn btn-primary rounded-circle btn-plus" style="height: 40px; width: 40px;"><i class="fa-solid fa-plus"></i></button>
                                                <span class="inputNumber border border-1 form-control ms-3 me-3" style="height: 40px; width: 120px;">0</span>
                                                <button class="btn btn-primary rounded-circle btn-minus" style="height: 40px; width: 40px;"><i class="fa-solid fa-minus"></i></button>
                                            </div>
                                            <div class="text-center" style="width: 60%; margin-top:20px">
                                                <div>
                                                    <?php


                                                    ?>
                                                    <label for="small">Small</label>
                                                    <input class="me-3" type="radio" id="small" value="small" name="radiofood">

                                                    <?php
                                                    if ($row['price_medium'] !== '0' || $row['price_large'] !== '0') {
                                                    ?>
                                                        <label for="medium">Medium</label>
                                                        <input class="me-3" type="radio" id="medium" value="medium" name="radiofood">

                                                        <label for="large">Large</label>
                                                        <input class="me-3" type="radio" id="large" value="large" name="radiofood">
                                                    <?php
                                                    }
                                                    ?>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between" style="height: 20px; width: 35%; margin-top: 40px;">
                                            Total price: <p class="totalPrice"></p>
                                        </div>
                                    </div>

                                    <div style="width: 100%; " class="d-flex justify-content-end">
                                        <button userid="<?php echo $isUserSet ?>" idvalue="<?php echo $row['id'] ?>" data-type="<?php echo $row['type'] ?>" class="btn btn-success d-flex justify-content-between btnaddcart" style="color: white; width: 140px; height: 40px;">
                                            Add to Cart
                                            <i class="fa-solid fa-cart-shopping" style=" font-size: 20px;"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
                <div style="width: 100%; height: 1px; padding: 0 20px; position: absolute; bottom: 10px;">
                    <div style="bottom: 0;height: 1px;width: 80%;background-color: #dedede;margin: auto;"></div>
                </div>
            </div>

            <p style="padding-left: 20px; font-weight: bold; font-size: 20px; color: red">Same Food Type</p>

            <div class="divSameFood" style="flex: 2; margin-top: 100px; position: relative; ">
                <div class="swiper mySwiper" style="border-radius: 10px; overflow: visible;">
                    <div class="swiper-wrapper">
                        <?php
                        include('../database.php');

                        $select_same = "SELECT * FROM foods where type = '$type'";
                        $result_same = $conn->query($select_same);

                        $foods = $result_same->fetch_all(MYSQLI_ASSOC);

                        $chunkedFoods = array_chunk($foods, 3); // Chia danh sách thành các phần tử con có tối đa 3 mục trong mỗi phần tử

                        foreach ($chunkedFoods as $chunk) {
                        ?>
                            <div class="swiper-slide" style="display: flex; justify-content: space-around;">
                                <?php
                                foreach ($chunk as $food_same) {
                                ?>
                                    <div class="d-flex flex-column justify-content-between divFood" style="width: 25%; height: 80%; margin-left: 15px; position: relative; z-index: 1; padding: 10px;">
                                        <div style="height: 150px; width: 75%;">
                                            <img style="width: 100%; height: 100%;" src="../foodimage/<?php echo $food_same['image'] ?>" alt="">
                                        </div>
                                        <div class="d-flex flex-column justify-content-around mt-5" style="flex: 8;">
                                            <p style="font-size: 20px; font-weight: bold;"><?php echo $food_same['name']; ?></p>
                                            <p class="foodDescription"><?php echo $food_same['detail']; ?></p>
                                            <div class="d-flex justify-content-between mb-5">
                                                <p style="font-size: 20px; color: black; font-weight: bold;">$<?php echo $food_same['price']; ?></p>
                                                <div style="width: 100%; flex: 2; margin-top: 10px;" class="d-flex justify-content-end">
                                                    <div data-type="<?php echo $food_same['type'] ?>" value='<?php echo $food_same['id'] ?>' class="plus rounded-circle d-flex justify-content-center align-content-center flex-wrap btnadd" style="position: absolute; bottom: -25px; right: 20px; cursor: pointer; height: 50px; width: 50px; background-color: #e63945;">
                                                        <i style="color: white; font-size: 35px;" class="fa-solid fa-plus"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Hiển thị thông tin thực phẩm khác ở đây -->
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
                <div style="width: 100%; height: 1px; padding: 0 20px; position: absolute; bottom: 5px;">
                    <div style="bottom: 0;height: 1px;width: 80%;background-color: #dedede;margin: auto;"></div>
                </div>
            </div>

            <p style="padding-left: 20px; font-weight: bold; font-size: 20px; color: red">May be you will like</p>
            <div style="flex: 2; margin-top: 150px;">
                <div class="swiper mySwiper" style="border-radius: 10px; overflow: visible;">
                    <div class="swiper-wrapper">
                        <?php
                        include('../database.php');
                        $allTypes = array("Fastfood", "Snacks", "Drink");
                        $otherTypes = array_diff($allTypes, array($type));

                        $select_all_food = "SELECT * FROM foods WHERE type IN ('" . implode("', '", $otherTypes) . "')";
                        $result_same = $conn->query($select_all_food);

                        $foods_same = $result_same->fetch_all(MYSQLI_ASSOC);

                        $chunkedFoods_same = array_chunk($foods_same, 3); // Chia danh sách thành các phần tử con có tối đa 3 mục trong mỗi phần tử

                        foreach ($chunkedFoods_same as $chunk_same) {
                        ?>
                            <div class="swiper-slide" style="display: flex; justify-content: space-around;">
                                <?php
                                foreach ($chunk_same as $food) {
                                ?>
                                    <div class="d-flex flex-column justify-content-between divFood" style="width: 25%; height: 80%; margin-left: 15px; position: relative; z-index: 1; padding: 10px;">
                                        <div style="height: 150px; width: 75%; position: absolute; left: 50%; transform: translateX(-50%); top: -100px; z-index: 2;">
                                            <img style="width: 100%; height: 100%;" src="../foodimage/<?php echo $food['image'] ?>" alt="">
                                        </div>
                                        <div class="d-flex flex-column justify-content-around mt-5" style="flex: 8;">
                                            <p style="font-size: 20px; font-weight: bold;"><?php echo $food['name']; ?></p>
                                            <p class="foodDescription"><?php echo $food['detail']; ?></p>
                                            <div class="d-flex justify-content-between mb-5">
                                                <p style="font-size: 20px; color: black; font-weight: bold;">$<?php echo $food['price']; ?></p>
                                                <div style="width: 100%; flex: 2; margin-top: 10px;" class="d-flex justify-content-end">
                                                    <div data-type="<?php echo $food['type'] ?>" value='<?php echo $food['id'] ?>' class="plus rounded-circle d-flex justify-content-center align-content-center flex-wrap btnadd" style="position: absolute; bottom: -25px; right: 20px; cursor: pointer; height: 50px; width: 50px; background-color: #e63945;">
                                                        <i style="color: white; font-size: 35px;" class="fa-solid fa-plus"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Hiển thị thông tin thực phẩm khác ở đây -->
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>


            </div>
        </div>
        

        
        <?php include('../layout/footer.php') ?>

    </div>
    <script src="../js/all.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var status = document.querySelector('.status')
            var btn_plus = document.querySelector('.btn-plus')
            var btn_minus = document.querySelector('.btn-minus')
            var btnaddcart = document.querySelector('.btnaddcart')
            var idfoodreal = btnaddcart.getAttribute('idvalue')
            var type = btnaddcart.getAttribute('data-type')
            var namefood = document.querySelector('.foodname').textContent
            var pricefood = document.querySelector('#foodprice')
            var imgfood = document.querySelector('.foodimage').getAttribute('src')
            var numberOrder = document.querySelector('.inputNumber')
            var totalPrice = document.querySelector('.totalPrice')
            var radioSize = document.querySelectorAll('input[name="radiofood"]');
            var status = document.querySelector('.status')
            var current_price = '';
            var price = ''
            var price_discount = '';
            var isChecked = false;
            radioSize.forEach(item => {
                item.addEventListener('input', function() {
                    if (this.checked) {
                        isChecked = true;
                        var small = document.querySelector('.price');
                        var medium = document.querySelector('.price_medium');
                        var large = document.querySelector('.price_large');
                        var d_small = document.querySelector('.d_price');
                        var d_medium = document.querySelector('.d_price_medium');
                        var d_large = document.querySelector('.d_price_large');
                        if (this.value === "small") {
                            small.style.display = "block";
                            large.style.display = "none";
                            medium.style.display = "none";
                            if (d_small) {
                                d_small.style.display = "block";
                                d_medium.style.display = "none";
                                d_large.style.display = "none";
                                totalPrice.textContent = `$ ${Number(numberOrder.textContent * d_small.textContent.replace('$ ', '')).toFixed(2)}`
                                price_discount = d_small.textContent;
                                current_price = Number(d_small.textContent.replace('$ ', ''))
                                console.log(current_price);
                            } else {
                                current_price = Number(small.textContent.replace('$ ', ''))
                                console.log(current_price);
                            }
                            price = small.textContent

                            totalPrice.textContent = `$ ${Number(numberOrder.textContent * small.textContent.replace('$ ','')).toFixed(2)}`
                        } else if (this.value === "medium") {
                            medium.style.display = "block";
                            small.style.display = "none";
                            large.style.display = "none";
                            if (d_medium) {
                                d_medium.style.display = "block";
                                d_small.style.display = "none";
                                d_large.style.display = "none";
                                totalPrice.textContent = `$ ${Number(numberOrder.textContent * d_medium.textContent.replace('$ ', '')).toFixed(2)}`
                                price_discount = d_medium.textContent;
                                current_price = Number(d_medium.textContent.replace('$ ', ''))
                                console.log(current_price);
                            } else {

                                current_price = Number(medium.textContent.replace('$ ', ''))
                                console.log(current_price);
                            }
                            price = medium.textContent;
                            totalPrice.textContent = `$ ${Number(numberOrder.textContent * medium.textContent.replace('$ ','')).toFixed(2)}`
                        } else if (this.value === "large") {
                            large.style.display = "block";
                            medium.style.display = "none";
                            small.style.display = "none";
                            if (d_large) {
                                d_large.style.display = "block";
                                d_medium.style.display = "none";
                                d_small.style.display = "none";
                                totalPrice.textContent = `$ ${Number(numberOrder.textContent * d_large.textContent.replace('$ ', '')).toFixed(2)}`
                                price_discount = d_large.textContent;
                                current_price = Number(d_large.textContent.replace('$ ', ''))
                                console.log(current_price);
                            } else {

                                current_price = Number(large.textContent.replace('$ ', ''))
                                console.log(current_price);
                            }
                            price = large.textContent;
                            totalPrice.textContent = `$ ${Number(numberOrder.textContent * large.textContent.replace('$ ','')).toFixed(2)}`
                        }
                    }
                })
            })
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
            /* add */

            if (status.textContent === "Còn hàng") {
                
                btnaddcart.addEventListener('click', function() {
                    if (btnaddcart.getAttribute('userid') === "") {
                        alert("Đăng nhập để có thể đặt hàng")
                    } else if (status.textContent === 'Hết hàng') {
                        alert('Đồ ăn này tạm thời hết hàng, vui lòng đợi chúng tôi cập nhật thêm')
                    }
                    else if (!isChecked) {
                        alert('Vui lòng chọn size đồ ăn')
                    }
                    else if(numberOrder.textContent === '0'){
                        alert('Vui lòng chọn số lượng')
                    } else {
                        const data = {
                            orderid: Date.now() + '-' + Math.random().toString(36).substr(2, 9),
                            idfoodreal,
                            namefood,
                            pricefood: Number(totalPrice.textContent.replace('$ ', '')),
                            imgfood,
                            type,
                            current_price,
                            numberorder: parseInt(numberOrder.textContent) == 0 ? 0 : parseInt(numberOrder.textContent)
                        }
                        fetch('../component_old/addToCart.php', {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json; charset=utf-8"
                                },
                                body: JSON.stringify(data)
                            })
                            .then(res => {
                                if (res) {
                                    return res.text()
                                }
                            })
                            .then(data => {
                                alert(data)
                            })
                            .catch(function(error) {
                                console.error('Error:', error);
                            });
                    }


                })
            }
            if (status.textContent === "Hết hàng") {
                btnaddcart.addEventListener('click', function() {
                    alert("Mặt hàng này đã hết")
                })
            }


            var curren_value = 0
            var curren_value_total = 1
            btn_plus.addEventListener('click', function() {
                console.log(price.replace('$ ', ''));
                curren_value++;
                numberOrder.textContent = curren_value
                curren_value_total = curren_value * Number(price.replace('$ ', ''))
                totalPrice.textContent = `$ ${parseFloat(curren_value_total).toFixed(2)}`
                if (price_discount) {
                    curren_value_total = curren_value * Number(price_discount.replace('$ ', ''))
                    totalPrice.textContent = `$ ${parseFloat(curren_value_total.toFixed(2))}`
                }


            })
            btn_minus.addEventListener('click', function() {
                if (Number(numberOrder.textContent) > 1) {
                    curren_value--;
                    numberOrder.textContent = curren_value
                    curren_value_total = curren_value * Number(price.replace('$ ', ''))
                    totalPrice.textContent = `$ ${parseFloat(curren_value_total).toFixed(2)}`
                    if (price_discount) {
                        curren_value_total = curren_value * Number(price_discount.replace('$ ', ''))
                        totalPrice.textContent = `$ ${parseFloat(curren_value_total.toFixed(2))}`
                    }

                }
            })

            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                }
            });

            var btnadds = document.querySelectorAll('.btnadd')
           
            if(btnadds){
                btnadds.forEach(btnadd => {
                    btnadd.addEventListener('click', function(event) {
                        
                       
                        location.replace(`detailfood.php?id=${btnadd.getAttribute('value')}&&type=${btnadd.getAttribute('data-type')}`);
                    })
                })
            }
        })
    </script>
</body>

</html>