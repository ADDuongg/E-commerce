<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/sidebar1.css">
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
    <div class="container-fluid ">
        <div class="row" style="height: 100%; ">
            <?php
            include('./sidebar.php');
            ?>
            <div class="col-8 home">
                <div class="contenthome d-flex flex-column align-items-center p-0" style="height: 745px; ">
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
                    <!-- <div class="type">Fast Food</div> -->
                    <div class="food-detail border border-1">
                        <div class="foodgrid">
                            <?php
                            $type = $_GET['type'];
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }
                            echo '<script>console.log("' . $type . '")</script>';
                            include('../database.php');
                            $cmd = "select * from foods where type = '" . $type . "'";
                            $total_food = $conn->query($cmd);
                            $total_row = $total_food->num_rows;
                            $item_PerPage = 6;
                            $start_from = ($page - 1) * 6;
                            $total_page = ceil($total_row / $item_PerPage);
                            $cmd1 = "select * from foods where type = '" . $type . "' limit $start_from, $item_PerPage";
                            $result = $conn->query($cmd1);
                            $prev_page = ($page == 1) ? $total_page : $page - 1;
                            $next_page = ($page == $total_page) ? 1 : $page + 1;

                            $favoriteFoods = array();
                            $discount = array();
                            $userId = $_SESSION['user_id'];
                            $sql = "SELECT food_id FROM favor WHERE user_id = '$userId'";
                            $result_sql = $conn->query($sql);
                            if ($result_sql->num_rows > 0) {
                                while ($row_favor = $result_sql->fetch_assoc()) {
                                    $favoriteFoods[] = $row_favor['food_id'];
                                }
                            }
                            $sql_discount = "select foodid from salefood";
                            $result_discount = $conn->query($sql_discount);
                            if ($result_discount->num_rows > 0) {
                                while ($row_discount = $result_discount->fetch_assoc()) {
                                    $discount[] = $row_discount['foodid'];
                                }
                            }
                            // Assume $result là kết quả truy vấn từ cơ sở dữ liệu
                            foreach ($result as $row) {
                                $idfood = uniqid();
                                $foodId = $row['id'];
                                $isFavorite = in_array($foodId, $favoriteFoods);
                                $isDiscount = in_array($foodId, $discount);
                            ?>
                                <div class="div-card text-start mt-3 border border-2 card " style="position: relative;">
                                    <div idfood="<?php echo $row['id'] ?>" class="iconfavor" style="width: 20px; height: 20px">
                                        <?php if ($isFavorite) : ?>
                                            <i style="width: 100%; height: 100%; color: pink" class="fa-solid fa-regular fa-heart"></i>
                                        <?php else : ?>
                                            <i style="width: 100%; height: 100%; color: pink" class="fa-regular fa-heart"></i>
                                        <?php endif; ?>
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
                                        <?php echo '<div class="discount text-center">' . $discountValue . '%</div>' ?>
                                    <?php endif; ?>
                                    <div class="div-card-image">
                                        <img class="card_image" src="../foodimage/<?php echo $row['image']; ?>" alt="Title">
                                    </div>

                                    <div class="card_body">
                                        <div>
                                            <h6 class="card_title text-start"><?php echo $row['name']; ?></h6>
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
                                        </div>
                                        <div>
                                            <button class="btn btn-success btndetailfood" style="height: 40px; width: 40px;" data-food-id-fake="<?php echo $idfood; ?>" data-food-id-real="<?php echo $row['id']; ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            <button data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $idfood; ?>" class="btn btn-success btndetail" style="height: 40px; width: 40px" data-food-id-fake="<?php echo $idfood; ?>" data-food-id-real="<?php echo $row['id']; ?>"><i class="fa-solid fa-plus"></i></button>
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
                                                                <!-- <input value="1" style="height: 30px; width: 30px" class="ms-2 me-2 numberfood" type="text"> -->
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
                            }
                            ?>
                        </div>

                        <div class="page">

                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="menu.php?type=<?php echo $type; ?>&page=<?php echo $prev_page; ?>">Previous</a></li>
                                    <?php
                                    for ($i = 1; $i <= $total_page; $i++) {
                                        echo '<li class="page-item"><a class="page-link" href="menu.php?type=' . $type . '&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    ?>
                                    <li class="page-item"><a class="page-link" href="menu.php?type=<?php echo $type; ?>&page=<?php echo $next_page; ?>">Next</a></li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var favorite = document.querySelectorAll('.iconfavor')
                    favorite.forEach(item => {
                        item.addEventListener('click', function() {
                            console.log(123);
                            const icon = item.querySelector("i.fa-heart");
                            icon.classList.toggle("fa-solid")
                            /* if(icon.classList.contains("fa-solid")){
                                icon.classList.remove("fa-solid");
                                icon.classList.add("fa-regular");
                            }
                            if(icon.classList.contains("fa-regular")){
                                icon.classList.remove("fa-regular");
                                icon.classList.add("fa-solid");
                            } */
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
                    const btndetailfood = document.querySelectorAll('.btndetailfood')
                    console.log(btndetailfood);
                    btndetailfood.forEach(item => {
                        item.addEventListener('click', function() {
                            var idfoodreal = item.getAttribute('data-food-id-real')
                            window.location.href = `./detailFood.php?id=${idfoodreal}`
                            /* alert(1) */
                            /*  console.log('dmm'); */
                        })
                    })
                    const btndetail = document.querySelectorAll('.btndetail')
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
                        let type;
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
                                    console.log(data);
                                })
                                .catch(function(error) {
                                    console.error('Error:', error);
                                });


                        })
                    }


                });
            </script>

            <?php
            include('./sidebar1.php')
            ?>
        </div>
    </div>

</body>

</html>