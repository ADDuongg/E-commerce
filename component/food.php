<?php
session_start();
include('../database.php');
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
$type;

if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

$cmd = "select * from foods where type = '$type'";
$result1 = $conn->query($cmd);
$totalRow = $result1->num_rows;

$itemPerPage = 12;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page - 1) * 12;
$total_page = ceil($totalRow / $itemPerPage);
$prev_page = ($page == 1) ? $total_page : $page - 1;
$next_page = ($page == $total_page) ? 1 : $page + 1;
$select = "select * from foods where type = '$type' LIMIT $start_from, $itemPerPage";
$result = $conn->query($select);

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
    <link rel="stylesheet" href="../css_new/fastfood.css">
    <link rel="stylesheet" href="../css_new/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div style="height: 100%; width: 100%;">
        <!-- Header -->
        <div class="div-header" style="height: 550px; width: 100%; z-index: -1;">
            <div class="content-header border border-2">
                <div class="content-header-child">
                </div>
                <header class=" ">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between" style="width: 100%; max-width: 80%; margin: auto; padding-top: 25px; z-index: 3;">
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
                            echo isset($_SESSION['user_id']) ? ('<div class="dropdown rounded-circle d-flex justify-content-between" style="height: 80px; width: 120px;">
                            <img class="btn-dropdown" style="height: 75%; width: 65px; cursor:pointer" src="../public/burger-removebg-preview.png" alt="">
        
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
                    </div>
                </header>
            </div>
        </div>
        <div class="description text-center d-flex flex-column flex-wrap justify-content-center align-content-center" style="width: 1200px; height: 400px;position: absolute; top: 200px; left: 50%; transform: translateX(-50%); color: white;">
            <p style="font-size: 90px;">
                <?php echo $type ?>!
            </p>
            <div class="" style="margin: 0 auto; width: 60%;">
                Dignissim sed suscipit mattis neque, in nibh blandit at nec in urna tristique ornare aliquam orci augue
                vestibulum dignissim vel aliquam.
            </div>
        </div>

        <div class="d-flex flex-column" style="background-color: #fafafa; width: 100%; height: auto; margin-top: 30px;">
            <div style="width: 80%; margin: auto; height: auto;">
                <p style="color: #faab34; text-align: center;">A VARIETY OF</p>
                <p style="font-weight: bold; font-size: 40px; text-align: center;"><?php echo ($type === "Fastfood") ? 'Delicious Burger and More!!' : (
                                                                                        ($type === "Snacks") ? 'Snacks and Sides' : 'Sweet and Good Drink') ?></p>
                <div style="" class="d-flex justify-content-center">
                    <div style="height: 60px; width: 3px; background-color: #dedede;"></div>
                </div>
            </div>
            <div class="d-flex flex-wrap " style="width: 80%; margin: auto; height: auto; ">
                <?php
                while ($row = $result->fetch_assoc()) {
                    $isDiscount = in_array($row['id'], $discount);
                ?>
                    <div class="d-flex flex-wrap justify-content-center divFood" style="width: 30%; height: 250px; margin: 160px auto 0 0; position: relative; padding-top: 50px; border-radius: 10px">
                        <div style="position: absolute;left: 50%; transform: translateX(-44%); top: -140px; width: 100% ">
                            <img style="height: 200px; width: 300px;" src="../foodimage/<?php echo $row['image'] ?>" alt="">
                        </div>
                        <!-- div discount -->
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
                            <?php echo '<div style="position: relative; border-radius: 5px; text-align: center; height: 30px; width: 70px; background-color: red; color: white; position: absolute; top: 60px; left: -30px; transform: rotate(30deg); font-weight: bold">' . $discountValue . '%<i class="fa-solid fa-link" style="position: absolute; top: 5px; left: -20px; color: orange; font-size: 25px"></i></div>' ?>
                        <?php endif; ?>
                        <?php
                        ?>
                        <div>
                            <p style="font-weight: bold; font-size: 20px; width: 100%; text-align: center;"><?php echo $row['name'] ?></p>

                            <?php
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

                            <p class="d-flex justify-content-center" style="font-size: 20px;">
                                <?php if ($discountValue > 0) { ?>
                                    <span style="text-decoration: line-through; font-weight: bold; color: black; padding-right: 40px;">$ <?php echo $originalPrice ?></span>
                                    <span style="color: red">$ <?php echo $discountedPrice; ?></span>
                                <?php } else { ?>
                                    <span style="font-weight: bold; color: black; padding-right: 40px;">$ <?php echo $originalPrice ?></span>
                                <?php } ?>
                            </p>

                            <p style="width: 100%; text-align: center;"><?php echo $row['detail'] ?></p>
                        </div>


                        <div type="<?php echo $row['type'] ?>" value='<?php echo $row['id'] ?>' class="plus rounded-circle d-flex justify-content-center align-content-center flex-wrap btnadd" style="cursor: pointer; position: absolute; bottom: -25px; left: 50%; transform: translateX(-50%); height: 50px; width: 50px; background-color: #e63945;">
                            <i style="color: white; font-size: 35px;" class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="d-flex justify-content-end mt-5" style="margin: auto; width: 80%;">
                <div class="">
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="food.php?type=<?php echo $type; ?>&&page=<?php echo $prev_page; ?>">Previous</a></li>
                            <?php
                            for ($i = 1; $i <= $total_page; $i++) {
                                echo '<li class="page-item"><a class="page-link" href="food.php?type=' . $type . '&&page=' . $i . '">' . $i . '</a></li>';
                            }
                            ?>
                            <li class="page-item"><a class="page-link" href="food.php?type=<?php echo $type; ?>&&page=<?php echo $next_page; ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <?php include('../layout/footer.php') ?>
    </div>
    <script>
        if (dropdowm) {
            dropdowm.addEventListener('click', function() {
                dropdowm_menu.classList.toggle('show');
            });
        }
        var btnadds = document.querySelectorAll('.btnadd')
        btnadds.forEach(btnadd => {
            btnadd.addEventListener('click', function() {
                window.location.href = `detailfood.php?id=${btnadd.getAttribute('value')}&&type=${btnadd.getAttribute('type')}`
            })
        })
    </script>
    <script src="../js/all.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>