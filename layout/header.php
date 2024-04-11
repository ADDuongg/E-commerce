<?php

?>
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
    <div class="description text-center d-flex flex-column flex-wrap justify-content-center align-content-center" style="width: 1200px; height: 400px; position: absolute; top: 200px; left: 50%; transform: translateX(-50%); color: white;">
        <p class="titleHeader" style="font-size: 90px;">
            <?php echo $pageInfo['title']; ?>
        </p>
        <div class="descriptionHeader" style="margin: 0 auto; width: 60%;">
            <?php echo $pageInfo['description']; ?>
        </div>
    </div>

</div>

<?php

?>