<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class=" column1 col-2 border border-left border-3 d-flex flex-column justify-content-evenly align-items-center flex-wrap p-0">
        <div class="text-center logo">
            <img src="../public//logo.png" alt="" height="100%" width="100%">
        </div>
        <div class="sidebar color-secondary">
            <ul class="list-unstyled fs-5 pt-5">
                <li class="pt-3 sidebaritem home1 ps-2 pb-3">Home</li>
                <li class="menu pt-3 sidebaritem ps-2 pb-3 d-flex justify-content-between align-items-center ">
                    Menu
                    <i class="fa-solid fa-chevron-down pe-1"></i>
                    <div class="menuitem">
                        <div class="detail d-flex flex-column justify-content-around">
                            <div class="detailmenu ps-2 fastfood1"><i class="fa-solid fa-burger pe-3"></i> Fast food</div>
                            <div class="detailmenu ps-2 snack1"><i class="fa-solid fa-cookie-bite pe-3"></i>Snack</div>
                            <div class="detailmenu ps-2 drink1"><i class="fa-solid fa-mug-hot pe-3"></i>Drink</div>
                        </div>
                    </div>
                </li>

                <li class="order pt-3 sidebaritem ps-2 pb-3 myorder">Your order</li>
            </ul>
        </div>
        <form action="../logout.php" method="POST">
            <button type="submit" name="logout" class=" text-center logout btn text-danger" style="cursor: pointer;">
                <i class="fa-solid fa-right-from-bracket color-danger pe-2"></i>Log out
            </button>
        </form>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const home1 = document.querySelector('.home1');
            const fastfood = document.querySelector('.fastfood1')
            const snack = document.querySelector('.snack1')
            const drink = document.querySelector('.drink1')
            /* const logout = document.querySelector('.logout') */
            const menu = document.querySelector(".menu");
            const menuitem = document.querySelector(".menuitem");
            const order = document.querySelector('.order')
            const sidebaritem = document.querySelectorAll('.sidebaritem')
            const myorder = document.querySelector('.myorder')
            let isMenuitemVisible = false;
            home1.addEventListener('click', function() {
                window.location.href = "./page.php";
            })
            fastfood.addEventListener('click', function() {
                window.location.href = "./menu.php?type=Fastfood&"
            })
            snack.addEventListener('click', function() {
                window.location.href = "./menu.php?type=Snacks&"
            })
            drink.addEventListener('click', function() {
                window.location.href = "./menu.php?type=Drink&"
            })
            myorder.addEventListener('click', function() {
                window.location.href = "./myorder.php?order=<?php echo $_SESSION['user_id'] ?>";
            });

            /* logout.addEventListener('click', function() {
                window.location.href = "../login.php"
            }) */
            menu.addEventListener("click", function() {
                if (!isMenuitemVisible) {
                    menuitem.style.display = "block";
                    order.classList.add('margintop')
                } else {
                    menuitem.style.display = "none";
                    order.classList.remove('margintop')
                }
                isMenuitemVisible = !isMenuitemVisible;
            });
            sidebaritem.forEach(items => {
                items.addEventListener('click', function() {
                    sidebaritem.forEach(items1 => {
                        items1.classList.remove('color')
                    })
                    if (!items.classList.contains('color')) {
                        items.classList.add('color')
                    } else {
                        items.classList.remove('color')
                    }
                })
            })
        });
    </script>
</body>

</html>