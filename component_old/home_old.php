<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/home.css">
    <!-- <link rel="stylesheet" href="../css/menu.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
    </style>
</head>

<body>
    <div class="col-8 home">
        <div class="contenthome d-flex flex-column align-items-center p-0" style="height: 100%; ">
            <div class="header" style="background-image: linear-gradient(-20deg, #88d3ce 0%, #6e45e2 100%);">
                <div class="divsearch d-flex justify-content-center pt-2">
                    <input type="search" class="rounded-pill inputsearch me-3">
                    <div class="icon" style="font-size: 30px;">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                </div>
                <div class="about d-flex justify-content-between">
                    <div class="detail ">
                        <p class="" style="color: #FF6347; padding-left: 40px">Fastest</p>
                        <p class="text-center" style="padding-right: 80px;">Delivery and </p>
                        <p class="text-end" style="color:FF6347; padding-right: 120px; ">Pick up</p>
                    </div>
                    <div class="shape bg-secondary">
                        <img class="boy" src="../public//boy-removebg-preview.png" alt="">
                        <img class="setsize burger" src="../public//burger-removebg-preview.png" alt="">
                        <img class="setsize chicken" src="../public//chicken-removebg-preview.png" alt="">
                        <img class="setsize drink" src="../public//drink-removebg-preview.png" alt="">
                        <img class="setsize potato" src="../public//khoai-removebg-preview.png" alt="">
                    </div>
                </div>
            </div>
            <div class="divsale">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="content">data12</div>
                        </div>
                        <div class="carousel-item">
                            <div class="content">data22</div>
                        </div>
                        <div class="carousel-item">
                            <div class="content">data32</div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="content-detail " style="height: 446px; width: 100%">
                <div class="text-start pb-2" style="width: 100%; height: 70px">
                    <img src="../public//seller.png" alt="" style="width: 300px; height: 100%">
                </div>
                <div class="burger-seller pt-2">

                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" style="cursor: pointer;"><a class=" fastfood-link">Fast food</a></li>
                            <li class="breadcrumb-item" style="cursor: pointer;"><a class=" snack-link">Snacks</a></li>
                            <li class="breadcrumb-item" style="cursor: pointer;"><a class=" drinks-link">Drinks</a></li>
                        </ol>
                    </nav>

                </div>
                <div class="seller border border-2 " style="">
                    <?php
                    include '../database.php';
                    if (isset($_GET['type'])) {
                        $type = $_GET['type'];
                    } else {
                        // Nếu không có tham số "type" trong URL, đặt mặc định là "Fastfood"
                        $type = "Fastfood";
                    }
                    $favoriteFoods = array();
                    $userId = $_SESSION['user_id'];
                    $sql = "SELECT food_id FROM favor WHERE user_id = '$userId'";
                    $result_sql = $conn->query($sql);
                    if ($result_sql->num_rows > 0) {
                        while ($row_favor = $result_sql->fetch_assoc()) {
                            $favoriteFoods[] = $row_favor['food_id'];
                        }
                    }
                    $cmd = "select * from foods where type = '" . $type . "'";
                    $result = $conn->query(($cmd));

                    $discount = array();
                    $sql_discount = "select foodid from salefood";
                    $result_discount = $conn->query($sql_discount);
                    if ($result_discount->num_rows > 0) {
                        while ($row_discount = $result_discount->fetch_assoc()) {
                            $discount[] = $row_discount['foodid'];
                        }
                    }
                    ?>
                    <?php
                    while ($row = $result->fetch_assoc()) :
                        $idfood = uniqid();
                        $foodId = $row['id'];
                        $isFavorite = in_array($foodId, $favoriteFoods);
                        /* print_r($favoriteFoods) */
                        $isDiscount = in_array($foodId, $discount);
                    ?>
                        <div class="cards">
                            <div class="card" style="position: relative;">
                                <div class="card__image">
                                    <img src="../foodimage/<?php echo $row['image'] ?>" alt="...">
                                </div>
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
                                    <?php echo '<div class="discount text-center">'. $discountValue .'%</div>' ?>
                                <?php endif; ?>
                                
                                <div class="card__content">
                                    <div data-isfavor="false" idfood="<?php echo $row['id'] ?>" class="text-end favor" style="width: 100%; height: 30px; cursor: pointer">
                                        <?php if ($isFavorite) : ?>
                                            <i style="width: 100%; height: 100%; color: pink" class="fa-solid fa-regular fa-heart"></i>
                                        <?php else : ?>
                                            <i style="width: 100%; height: 100%; color: pink" class="fa-regular fa-heart"></i>
                                        <?php endif; ?>
                                    </div>
                                    <p class="card__title "><?php echo $row['name'] ?></p>
                                    <div class="card__description">
                                        <p class="detail-food "><?php echo $row['detail'] ?></p>
                                        <div class="add d-flex justify-content-between " style="height: 40px;">
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

                                                // Tính giá mới sau giảm giá
                                                $originalPrice = $row['price'];
                                                $discountedPrice = $originalPrice - ($originalPrice * $discountValue / 100);
                                                ?>
                                                <p class="card_text text-start">
                                                    <span style="text-decoration: line-through;"><?php echo $originalPrice; ?> $</span>
                                                    <span style="color: red"><?php echo $discountedPrice; ?> $</span>
                                                </p>
                                            <?php else : ?>
                                                <p class="card_text text-start"><?php echo $row['price']; ?> $</p>
                                            <?php endif; ?>
                                            <div>
                                                <button class="btn btn-success btndetailfood" style="height: 100%; width: 60px;" data-food-id-fake="<?php echo $idfood; ?>" data-food-id-real="<?php echo $row['id']; ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                <button data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $idfood; ?>" class="btn btn-success btndetail" style="height: 100%; width: 60px;" data-food-id-fake="<?php echo $idfood; ?>" data-food-id-real="<?php echo $row['id']; ?>"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="staticBackdrop<?php echo $idfood; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Thông tin sản phẩm</h5>
                                        <button type="button" class="btn-close btnclose" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="div-image-food">
                                            <img class="img-food" style="height: 100%; width: 100%" src="../foodimage/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>">
                                        </div>
                                        <div class="div-detail-food ms-2 border border-1 rounded">
                                            <div class="food-name-price ms-3">
                                                <h3><?php echo $row['name']; ?></h3><br>
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex">
                                                        <h4 class="ps-2"><?php echo $row['price']; ?></h4>
                                                        <p>$</p>
                                                    </div>
                                                    <div class="me-3">
                                                        <button style="height: 30px; width: 30px" id="btn-minus" class="btn-minus rounded-circle bg-danger"><i class="fa-solid fa-minus text-white"></i></button>

                                                        <span class="numberfood">1</span>
                                                        <button style="height: 30px; width: 30px" id="btn-plus" class="btn-plus rounded-circle bg-success  border-none"><i class="fa-solid fa-plus text-white"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btnclose" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success btnadd"><i class="fa-solid fa-cart-shopping"></i> Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php

                    endwhile;


                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fastfood = document.querySelector('.fastfood-link')
            var snack = document.querySelector('.snack-link')
            var drink = document.querySelector('.drinks-link')
            const btndetail = document.querySelectorAll('.btndetail')
            const btndetailfood = document.querySelectorAll('.btndetailfood')
            var favorite = document.querySelectorAll('.favor')

            favorite.forEach(item => {
                item.addEventListener('click', function() {
                    const icon = item.querySelector("i.fa-heart");
                    icon.classList.toggle("fa-solid");
                    const isFavorite = icon.classList.contains("fa-solid");
                    fetch(`../controller/favorite.php?idfood=${item.getAttribute('idfood')}&isfavor=${isFavorite}`, {})
                        .then(res => {
                            if (res) {
                                return res.text()
                            }
                        })
                        .then(data => {
                            console.log(data);
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                        });
                })
            })
            console.log(btndetailfood);
            btndetailfood.forEach(item => {
                item.addEventListener('click', function() {
                    var idfoodreal = item.getAttribute('data-food-id-real')
                    window.location.href = `./detailFood.php?id=${idfoodreal}`
                    /* alert(1) */
                })
            })
            btndetail.forEach(item => {
                item.addEventListener('click', showmodal(item))
            })

            function showmodal(item) {
                var idfoodfake = item.getAttribute('data-food-id-fake');
                var idfoodreal = item.getAttribute('data-food-id-real')
                let curren_value = 1;
                var modal = document.querySelector('#staticBackdrop' + idfoodfake);
                var namefood = modal.querySelector('h3').textContent;
                var pricefood = modal.querySelector('h4').textContent;
                var imgfood = modal.querySelector('.img-food').getAttribute('alt');
                var btnadd = modal.querySelector('.btnadd');
                const plusButtons = modal.querySelector('.btn-plus');
                const minusButtons = modal.querySelector('.btn-minus');
                const numberFields = modal.querySelector('.numberfood');
                var btnclose = modal.querySelectorAll('.btnclose');
                plusButtons.addEventListener('click', function() {
                    curren_value++;
                    numberFields.textContent = curren_value
                    console.log(`curren_value: ${curren_value} and numberFields: ${numberFields.textContent}`);

                });
                minusButtons.addEventListener('click', function() {
                    if (parseInt(numberFields.textContent) > 1) {
                        curren_value--;
                        numberFields.textContent = curren_value
                        console.log(`curren_value: ${curren_value} and numberFields: ${numberFields.textContent}`);
                    }
                });

                btnclose.forEach(items => {
                    items.addEventListener('click', function() {
                        curren_value = 1
                        numberFields.textContent = curren_value

                    })
                })
                let type = "Fastfood";
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('type')) {
                    type = urlParams.get('type');
                } else {
                    console.log('Tham số "type" không tồn tại trong URL.');
                }
                btnadd.addEventListener('click', function() {
                    const data = {
                        orderid: Date.now() + '-' + Math.random().toString(36).substr(2, 9),
                        idfoodreal,
                        namefood,
                        pricefood: Number(numberFields.textContent * pricefood),
                        imgfood,
                        type,
                        numberorder: parseInt(numberFields.textContent) == 1 ? 1 : parseInt(numberFields.textContent)
                    }
                    fetch('addToCart.php', {
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
                            alert(data);
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                        });


                })
            }
            snack.addEventListener('click', function() {
                window.location.href = "./page.php?type=Snacks"
            })
            fastfood.addEventListener('click', function() {
                window.location.href = "./page.php?type=Fastfood"
            })
            drink.addEventListener('click', function() {
                window.location.href = "./page.php?type=Drink"
            })
        })
    </script>


</body>

</html>