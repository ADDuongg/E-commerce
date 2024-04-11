<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/detail.css">
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
            include('./sidebar.php');
            ?>
            <div class="col-8 div-detail">
                <div class="div-detail-food border border-2">
                    <?php
                    include('../database.php');
                    $id = $_GET['id'];
                    $cmd1 = "select * from foods order by RAND() LIMIT 7";
                    $result1 = $conn->query($cmd1);
                    $cmd = "select * from foods where id = '" . $id . "' ";
                    $result = $conn->query($cmd);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    ?>
                        <div class="image-food border border-1">
                            <div class="image">
                                <img class="div_image-food" src="../foodimage/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>">
                            </div>
                        </div>
                        <div class="detail-food border border-1 ps-4">
                            <h2><?php echo $row['name']; ?></h2>
                            <div class="d-flex">Type:<h5><?php echo $row['type']; ?></h5>
                            </div>
                            <h4><?php echo $row['detail']; ?></h4>
                            <span class="d-flex">Price:<h3><?php echo $row['price']; ?></h3>
                                <h3>$</h3>
                            </span>
                            <div class="me-3">
                                <button style="height: 30px; width: 30px" id="btn-minus" class="btn-minus rounded-circle bg-danger"><i class="fa-solid fa-minus text-white"></i></button>
                                <span class="numberfood">1</span>
                                <button style="height: 30px; width: 30px" id="btn-plus" class="btn-plus rounded-circle bg-success  border-none"><i class="fa-solid fa-plus text-white"></i></button>
                            </div>
                            <div>
                                <button data-food-id-real="<?php echo $row['id']; ?>" type="button" class="btn btn-success btnadd"><i class="fa-solid fa-cart-shopping"></i> Add to cart</button>
                            </div>
                            <!-- Add more details as needed -->
                            
                        </div>
                        
                        <div class="same-food border border-1 d-flex flex-column" style = "overflow-x: scroll;">
                        <span class = "ms-3">Sản phẩm tương tự</span>
                            <div class = "d-flex" >
                            <?php
                            if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                while ($row1 = $result1->fetch_assoc()) {
                                ?>
                                <div idfoodreal = "<?php echo $row1['id']?>" class="foodsame ms-3 d-flex flex-column align-items-center border border-2 shadow mt-3">
                                    <div class = " border-bottom border-2">
                                    <img src="../foodimage/<?php echo $row1['image']?>" alt="" style = "height: 120px; width: 120px">
                                    </div>
                                    <div class="text-start d-flex flex-column ps-2" style = "width: 100%; height: 100%">
                                        <span><?php echo $row1['name'] ?></span>
                                        <span><?php echo $row1['price'] ?> $</span>
                                    </div>
                                </div>
                                
                                <?php
                                }
                            }
                            ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo '<p>Product not found.</p>';
                    }
                    ?>

                </div>
            </div>
            <?php
            include('./sidebar1.php');
            ?>
        </div>
    </div>
    <script>
        var btnadd = document.querySelector('.btnadd')
        var btnminus = document.querySelector('.btn-minus')
        var btnplus = document.querySelector('.btn-plus')
        let value = document.querySelector('.numberfood')
        var idfoodreal = btnadd.getAttribute('data-food-id-real')
        var namefood = document.querySelector('h2').textContent
        var pricefood = document.querySelector('h3').textContent
        var type = document.querySelector('h5').textContent
        var imgfood = document.querySelector('.div_image-food').getAttribute('src')
        var foodsame =document.querySelectorAll('.foodsame');

        foodsame.forEach(item => {
            item.addEventListener('click', function(){
                var idfood = item.getAttribute('idfoodreal');
                window.location.href = `./detailFood.php?id=${idfood}`;
            })
        })
        /*  
         console.log(namefood.textContent);
         console.log(pricefood.textContent);
         console.log(type.textContent);
         console.log(imgfood); */
        let currentValue = Number(value.textContent)
        btnminus.addEventListener('click', function() {
            if (Number(value.textContent) > 1) {
                currentValue--
                value.textContent = currentValue
            }
        })
        btnplus.addEventListener('click', function() {
            currentValue++
            value.textContent = currentValue

        })

        btnadd.addEventListener('click', function() {
            const data = {
                orderid: Date.now() + '-' + Math.random().toString(36).substr(2, 9),
                 idfoodreal,
                 namefood,
                 pricefood: Number(value.textContent * pricefood),
                 imgfood,
                 type,
                 numberorder: parseInt(value.textContent) == 1 ? 1 : parseInt(value.textContent)
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
                    alert(data)
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });


        })
    </script>
</body>

</html>