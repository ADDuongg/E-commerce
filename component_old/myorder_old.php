<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/myorder.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/sidebar1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include('./sidebar.php')
            ?>
            <div class="col-8 position-relative rounded-3">
                <div class="div-order shadow-lg position-absolute top-50 start-50 translate-middle ">
                    <div class="div-order-title d-flex ">
                        <h3 class="ms-5">Your order <i class="fa-solid fa-bowl-food border border-1"></i></h3>
                    </div>
                    <div class="div-order-detail border border-3 ">
                        <?php
                        include('../database.php');
                        $id = $_GET['order'];
                        $cmd = "select * from orders where user_id = '" . $id . "'";
                        $result = $conn->query($cmd);
                        $cmd_total = "SELECT SUM(total_price) AS total FROM orders WHERE user_id = '" . $id . "'";
                        $result1 = $conn->query($cmd_total);
                        $row = $result1->fetch_assoc();
                        $total_price = $row['total'];
                        /* print_r($result); */
                        if ($result->num_rows === 0) {
                            echo "Bạn chưa order món nào";
                        } else {
                            $orderAll = array();
                            foreach ($result as $row) {
                        ?>
                                <form class="formAction" action="../controller/actionOrder.php" method="POST">
                                    <div class="div-order-detail-food pb-1   ">
                                        <div class="img-food border border-2" style="height: 100px">
                                            <img class="ps-2" src="../foodimage/<?php echo $row['image'] ?>" alt="" style=" width: 150px; height: 100px">
                                        </div>
                                        <div class="detail-food pe-2">
                                            <?php echo $row['food_order']; ?>
                                            <div class="action " style="height:70px">
                                                <div class="mt-2 div-img d-flex justify-content-between detail-item">
                                                    <div>Total:<strong class="total-item-price"> <?php echo $row['total_price']  ?></strong>$</div>
                                                    <div class="d-flex justify-content-center align-content-center detail-number" style="flex-wrap: wrap;">
                                                        <?php echo $row['number_order']; ?>
                                                        <div class="">
                                                            <button style="height: 25px; width: 25px" id="btn-minus" class="btn-minus rounded-circle bg-danger"><i class="fa-solid fa-minus text-white"></i></button>
                                                            <span>Số lượng đặt </span><strong class="numberorder"><?php echo $row['number_order']; ?></strong>
                                                            <button style="height: 25px; width: 25px" id="btn-plus" class="btn-plus rounded-circle bg-success  border-none"><i class="fa-solid fa-plus text-white"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="div-action mt-2">
                                                    <button type="submit" name="btnsold" class="btn btn-success btn-action me-2">
                                                        <input type="hidden" value="<?php echo $row['food_id'] ?>" name="foodid">
                                                        <input type="hidden" value="<?php echo $id ?>" name="id_user">
                                                        <input type="hidden" value="<?php echo $row['food_order'] ?>" name="namefood">
                                                        <input type="hidden" value="<?php echo $row['type'] ?>" name="type">
                                                        <input type="hidden" value="<?php echo $row['order_id'] ?>" name="idorder">
                                                        <input type="hidden" id="total-fake" name="total" value="<?php echo $row['total_price']; ?>">
                                                        <input type="hidden" id="numberorder-fake" name="numberorder" value="<?php echo $row['number_order']; ?>">
                                                        <i class="fa-solid fa-money-check-dollar"></i> Thanh toán
                                                    </button>
                                                    <button type="submit" name="btncancel" class="btn btn-danger btn-action">
                                                        <i class="fa-solid fa-x"></i> Hủy đặt
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        <?php

                            }
                        }
                        ?>
                    </div>
                    <div class="div-order-price order border-3 ">
                        <div class="total-price text-start d-flex justify-content-between mt-3">
                            <div style="padding-left: 34px"><strong>Total price: </strong></div>
                            <?php echo '<div style = "padding-right: 34px"><strong class = "total-price-real">' . $total_price . '</strong> $</div>' ?>
                        </div>
                        <div class="buy-all fs-5 text-end " style="padding-right: 34px">
                            <button name="btnSoldAll" class="btn text-white btnSoldAll" style="background-color: orange"><i class="fa-solid fa-money-bill"></i> Thanh toán tất cả</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include('./sidebar1.php')
            ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var btnSolds = document.querySelectorAll('.btnsold');
            var btnCancles = document.querySelectorAll('.btncancle');
            var btnPluss = document.querySelectorAll('.btn-plus');
            var btnMinuss = document.querySelectorAll('.btn-minus');
            var allDetailItem = document.querySelectorAll('.div-order-detail-food');
            let totalprice = document.querySelector('.total-price-real');
            var btnSoldAll = document.querySelector('.btnSoldAll');
            var parentAll =document.querySelector('.div-order-detail')
            let iduser;
            let urlpram = new URLSearchParams(window.location.href);
            /* if (urlpram.has('order')) {
                iduser = urlpram.get('order')
            } else {
                console.log('Tham số "type" không tồn tại trong URL.');
            } */
            var totalnumber = 0;
            var allFood = []
            allDetailItem.forEach(food => {
                var foodid = food.querySelector('input[name="foodid"]').value
                var namefood = food.querySelector('input[name="namefood"]').value
                var type = food.querySelector('input[name="type"]').value
                var idorder = food.querySelector('input[name="idorder"]').value
                var total_price = food.querySelector('input[name="total"]').value
                var number_order = food.querySelector('input[name="numberorder"]').value
                let data = {
                    foodid,
                    namefood,
                    type,
                    idorder,
                    total_price,
                    number_order,
                    totalprice: parseFloat(totalprice.textContent).toFixed(1),
                }
                allFood.push(data)
                console.log(allFood);
            })
            btnSoldAll.addEventListener('click', function() {
                fetch('../controller/actionOrder.php', {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(allFood)
                    })
                    .then(res => res.text())
                    .then(data => {
                        alert(data);
                        parentAll.textContent = "Bạn chưa order món nào";
                    })
                    .catch(err => console.log(err))
            })





            function updateTotalPrice() {
                allDetailItem.forEach(item => {
                    var price = item.querySelector('.total-item-price');
                    totalnumber += parseFloat(price.textContent);
                });
                totalprice.textContent = totalnumber.toFixed(1); // Hiển thị tổng với 1 chữ số thập phân
            }
            // Hàm cập nhật tổng    
            function updateTotal() {
                totalnumber = 0;
                allDetailItem.forEach(item => {
                    var price = item.querySelector('.total-item-price');
                    totalnumber += parseFloat(price.textContent);
                });
                totalprice.textContent = totalnumber.toFixed(1); // Hiển thị tổng với 1 chữ số thập phân
            }

            btnPluss.forEach(btnPlus => {
                btnPlus.addEventListener('click', (e) => {
                    e.preventDefault()
                    var parentDiv = btnPlus.closest('.div-order-detail-food'); // Tìm phần tử cha chứa số lượng
                    var numberorder = parentDiv.querySelector('.numberorder'); // Tìm số lượng đặt cho sản phẩm tương ứng
                    var total = parentDiv.querySelector('.total-item-price'); // Tìm tổng cho sản phẩm tương ứng
                    var pricePerItem = parseFloat(total.textContent) / parseFloat(numberorder.textContent);
                    var numberorder_fake = parentDiv.querySelector('#numberorder-fake')
                    var total_fake = parentDiv.querySelector('#total-fake')
                    var currentValue = parseInt(numberorder.textContent);
                    currentValue += 1;
                    numberorder.textContent = currentValue;

                    total.textContent = (parseFloat(total.textContent) + pricePerItem).toFixed(1);

                    // Cập nhật tổng
                    updateTotal();
                    numberorder_fake.value = numberorder.textContent;
                    total_fake.value = total.textContent
                    console.log(`Tổng tiền hidden: ${total_fake.value} và số lượng hidden: ${numberorder_fake.value}`);
                });
            });

            btnMinuss.forEach(btnMinus => {
                btnMinus.addEventListener('click', (e) => {
                    e.preventDefault()
                    var parentDiv = btnMinus.closest('.div-order-detail-food'); // Tìm phần tử cha chứa số lượng
                    var numberorder = parentDiv.querySelector('.numberorder'); // Tìm số lượng đặt cho sản phẩm tương ứng
                    var total = parentDiv.querySelector('.total-item-price'); // Tìm tổng cho sản phẩm tương ứng
                    var pricePerItem = parseFloat(total.textContent) / parseFloat(numberorder.textContent);
                    var numberorder_fake = parentDiv.querySelector('.numberorder-fake')
                    var total_fake = parentDiv.querySelector('.total-fake')
                    var currentValue = parseInt(numberorder.textContent);
                    if (currentValue > 1) {
                        currentValue -= 1;
                        numberorder.textContent = currentValue; // Cập nhật số lượng đặt hiển thị

                        total.textContent = (parseFloat(total.textContent) - pricePerItem).toFixed(1);

                        // Cập nhật tổng
                        updateTotal();
                        numberorder_fake.value = numberorder.textContent;
                        total_fake.value = total.textContent
                        console.log(`Tổng tiền hidden: ${total_fake.value} và số lượng hidden: ${numberorder_fake.value}`);
                    }
                });
            });

            // Ban đầu, cập nhật tổng
            updateTotal();
        });
    </script>
</body>

</html>