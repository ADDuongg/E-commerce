<?php
$sql_discount = "select foodid, discount from salefood";
$result_discount = $conn->query($sql_discount);
if ($result_discount->num_rows > 0) {
    while ($row_discount = $result_discount->fetch_assoc()) {
        $discount[] = $row_discount['foodid'];
        $discountValue = $row_discount['discount'];
    }
}
?>
<div class=" myorder d-flex flex-column justify-content-start p-3" style="  background-color: white; border-radius: 20px; padding: 0 40px 0; height: auto;">
    <div class="title mb-2 d-flex pt-2" style="">
        <p style="font-size: 40px; font-weight: bold;">Your Cart <i style="font-size: 50px; color: red" class="fa-solid fa-cart-shopping ms-2"></i></p>
    </div>
    <div style="height: auto" class="">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-7 col-12 d-flex justify-content-between flex-column align-content-center pe-3">
                    <div class="border border-1  shadow-sm" action="" method="POST" style="overflow-y: auto; width: 100%; flex: 9; padding:10px 10px; border-radius: 20px;">
                        <?php
                        if ($numrow > 0) {
                            $idfood1 = uniqid();
                            while ($foods_order = $resule_food->fetch_assoc()) {
                                $isDiscount = in_array($foods_order['food_id'], $discount);
                                if ($isDiscount) {
                                    $originalPrice = $foods_order['current_price'];
                                    $discountedPrice = $originalPrice - ($originalPrice * $discountValue / 100);
                                }
                                
                        ?>
                                <form class="d-flex div-food-order mb-5" action="../controller_old/actionOrder.php" method="POST">
                                    <img style="height: 100%; width: 25%;" src="../foodimage/<?php echo $foods_order['image'] ?>" alt="">
                                    <div class="d-flex justify-content-between ps-5" style="width: 70%;">
                                        <div style="flex: 4">
                                            <p style="font-weight: bold"><?php echo $foods_order['food_order'] ?></p>
                                            <p class="totalPriceFood">$ <?php echo $foods_order['total_price'] ?></p>
                                        </div>
                                        <div style="width: 100%; display: flex; flex-direction: column; margin-top: 20px; flex: 6">
                                            <div class="d-flex">
                                                <input name="price" type="hidden" value="<?php echo $foods_order['current_price'] ?>">
                                                <button class="me-3 btn btn-primary rounded-circle btn-plus d-flex justify-content-center flex-wrap align-content-center" style="height: 30px; width: 30px;"><i class="fa-solid fa-plus"></i></button>
                                                <span class="inputNumber border border-1 form-control" style="height: 40px; width: 120px;"><?php echo $foods_order['number_order'] ?></span>
                                                <button class="ms-3 btn btn-primary rounded-circle btn-minus d-flex justify-content-center flex-wrap align-content-center" style="height: 30px; width: 30px;"><i class="fa-solid fa-minus"></i></button>
                                                <input type="hidden" value="<?php echo $foods_order['food_id'] ?>" name="foodid">
                                                <input type="hidden" value="<?php echo $id ?>" name="id_user">
                                                <input type="hidden" value="<?php echo $foods_order['food_order'] ?>" name="namefood">
                                                <input type="hidden" value="<?php echo $foods_order['type'] ?>" name="type">
                                                <input type="hidden" value="<?php echo $foods_order['order_id'] ?>" name="idorder">
                                                <input type="hidden" id="total-fake" name="total" value="">
                                                <input type="hidden" id="numberorder-fake" name="numberorder" value="">

                                            </div>
                                            <div style="margin-top: 10px;" class="d-flex justify-content-end">
                                                <button type="submit" name="btncancle" style="height: 40px; width: 40px;" class="btn btn-danger me-2 btn-action"><i class="fa-solid fa-trash"></i></button>
                                                <!-- <button type="submit" name="btnsold" style="height: 40px; width: 70px;" class="btn btn-success btn-action">Pay</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </form>




                        <?php
                            }
                        } else {
                            echo "<div class='d-flex'>
                            Bạn chưa order món nào cả." . "<button class = 'btn btn-primary ms-3 order-now'>Order ngay</button>
                            
                            </div>";
                        }
                        ?>


                    </div>
                    <div class="d-flex justify-content-end mb-2 mt-3" style="width: 100%; padding: 0 0; flex: 1">
                        Total Price: <p class="totalPriceRecepit ms-3" style="font-weight: bold;"></p>
                        <!-- <button class="btn btn-warning btn-pay-all" style="height: 40px; width: 90px;">Pay all</button> -->
                    </div>
                </div>
                <div class="col-lg-5 col-12 border border-1 p-2 d-flex flex-column justify-content-between">
                    <!-- Form thông tin đơn hàng -->
                    <form class="orderinfor" action="../controller_old/actionOrder.php" method="POST" style="flex:7">
                        <p style="font-weight: bold;">Thông tin đơn hàng</p>
                        <div class="mb-3">
                            <label for="hoten" class="form-label">Họ tên</label>
                            <input name="hoten" type="text" class="form-control" id="hoten" required>
                        </div>
                        <div class="mb-3">
                            <label for="sdt" class="form-label">Số điện thoại</label>
                            <input name="sdt" type="text" class="form-control" id="sdt" required>
                        </div>
                        <div class="mb-3">
                            <label for="diachi" class="form-label">Địa chỉ</label>
                            <input name="diachi" type="text" class="form-control" id="diachi" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea name="note" class="form-control text-note" id="note" rows="3" required></textarea>
                        </div>

                    </form>
                    <div style="flex:3" class="d-flex justify-content-center">
                        <button name="btn-pay-all" class="btn btn-pay-all" style="width: 100%; height:40px; background-color: #4e4ed4; color:white">Thanh toán khi nhận hàng</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var div_food_orders = document.querySelectorAll('.div-food-order');
    var btn_order_now = document.querySelector('.order-now')
    if (btn_order_now) {
        btn_order_now.addEventListener('click', function() {
            window.location.href = "ourMENU.php";
        })
    }
    var totalPriceRecepit = document.querySelector('.totalPriceRecepit');
    var btnSoldAll = document.querySelector('.btn-pay-all');
    var btnconfirm = document.querySelector('[name="btnconfirm"]');
    console.log(`this is a ${btnconfirm}`);
    var totalPriceFlag = 0;
    var priceFoodFlag = 0;
    var allFood = [];
    var total_price_food = ''


    document.querySelectorAll('.orderinfor input, .orderinfor textarea').forEach(element => {
        element.addEventListener('change', function() {
            hoten = document.querySelector('input[name="hoten"]').value;
            sdt = document.querySelector('input[name="sdt"]').value;
            diachi = document.querySelector('input[name="diachi"]').value;
            email = document.querySelector('input[name="email"]').value;
            note = document.querySelector('.text-note').value;
            allFood.forEach(item => {
                item.hoten = hoten;
                item.sdt = sdt;
                item.diachi = diachi;
                item.email = email;
                item.note = note;
            });


        });
    });




    div_food_orders.forEach(item => {
        var btn_plus = item.querySelector('.btn-plus');
        var btn_minus = item.querySelector('.btn-minus');
        var numberOrder = item.querySelector('.inputNumber');
        var current_value = Number(numberOrder.textContent);
        var totalPriceFood = item.querySelector('.totalPriceFood');
        var priceFood = item.querySelector('input[name="price"]').value;
        var btn_cancle = item.querySelector('.btn-cancle')
        var btn_pay = item.querySelector('.btn-pay')

        var inputNumberOrder = item.querySelector('input[name="numberorder"]')
        var inputTotal = item.querySelector('input[name="total"]')
        inputNumberOrder.value = parseInt(numberOrder.textContent);
        total_price_food = totalPriceFood.textContent.replace('$ ', '')
        totalPriceFlag += Number(totalPriceFood.textContent.replace('$ ', ''));
        priceFoodFlag = Number(priceFood)

        inputTotal.value = total_price_food

        var foodid = item.querySelector('input[name="foodid"]').value
        var namefood = item.querySelector('input[name="namefood"]').value
        var type = item.querySelector('input[name="type"]').value
        var idorder = item.querySelector('input[name="idorder"]').value
        var number_order = inputNumberOrder.value
        let data = {
            foodid,
            namefood,
            type,
            idorder,
            total_price_food: Number(total_price_food),
            number_order,
            hoten,
            sdt,
            diachi,
            email,
            note
        }
        allFood.push(data)


        function updateAllFood() {
            allFood.forEach((item, index) => {

                var numberOrder = document.querySelectorAll('.inputNumber')[index];
                var totalPriceFood = document.querySelectorAll('.totalPriceFood')[index];
                var priceFood = document.querySelectorAll('input[name="price"]')[index].value;

                var current_value = parseInt(numberOrder.textContent);
                var newTotalPrice = parseFloat(current_value * priceFood).toFixed(2);

                item.number_order = current_value;
                item.total_price_food = Number(newTotalPrice);
            });
        }
        btn_plus.addEventListener('click', function() {
            event.preventDefault();
            current_value++;
            numberOrder.textContent = current_value;
            totalPriceFlag += Number(priceFood)
            totalPriceFood.textContent = parseFloat(current_value * priceFood).toFixed(2)
            totalPriceRecepit.textContent = `$ ${parseFloat(totalPriceFlag.toFixed(2))}`;
            inputNumberOrder.value = current_value

            // Tìm index của món hàng hiện tại trong mảng allFood
            var currentIndex = Array.from(div_food_orders).indexOf(item);
            // Cập nhật dữ liệu của món hàng hiện tại trong mảng allFood
            allFood[currentIndex].number_order = current_value;
            allFood[currentIndex].total_price_food = parseFloat(current_value * priceFood).toFixed(2);
        });

        btn_minus.addEventListener('click', function() {
            event.preventDefault();
            if (current_value > 1) {
                current_value--;
                numberOrder.textContent = current_value;
                totalPriceFlag -= Number(priceFood)
                totalPriceFood.textContent = parseFloat(current_value * priceFood).toFixed(2)
                totalPriceRecepit.textContent = `$ ${parseFloat(totalPriceFlag.toFixed(2))}`
                inputNumberOrder.value = current_value

                // Tìm index của món hàng hiện tại trong mảng allFood
                var currentIndex = Array.from(div_food_orders).indexOf(item);
                // Cập nhật dữ liệu của món hàng hiện tại trong mảng allFood
                allFood[currentIndex].number_order = current_value;
                allFood[currentIndex].total_price_food = parseFloat(current_value * priceFood).toFixed(2);
            }
        });
    });
    totalPriceRecepit.textContent = `$ ${parseFloat(totalPriceFlag.toFixed(2))}`

    console.log(btnSoldAll);


    console.log(allFood);
    btnSoldAll.addEventListener('click', function() {

        fetch('../controller_old/actionOrder.php', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(allFood)
            })
            .then(res => res.text())
            .then(data => {
                window.location.href = '../component/usersetting.php?type=myorder'
                parentAll.textContent = "Bạn chưa order món nào";
            })
            .catch(err => console.log(err))
    })
</script>
<?php

?>