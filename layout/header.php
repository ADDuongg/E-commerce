<?php
if (isset($_SESSION["user_id"])) {
    $id = $_SESSION['user_id'];
    $select_user = "select * from account where user_id = '$id'";
    $result_user = $conn->query($select_user);
    $row_user = $result_user->fetch_assoc();
}
?>
<div class="div-header" style="height: 550px; width: 100%; z-index: -1;">
    <div class="content-header border border-2">
        <div class="content-header-child">
        </div>
        <header class=" ">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-between divHeader" style="width: 100%; max-width: 80%; margin: auto; padding-top: 25px; z-index: 3;">
                    <div class="icon-header " style="width: 170px;">
                        <i class="fa-brands fa-facebook me-2"></i>
                        <i class="fa-brands fa-twitter me-2"></i>
                        <i class="fa-brands fa-square-instagram"></i>
                    </div>

                    <div class="navbar-header d-flex flex-column justify-content-center align-content-center flex-wrap" style="width: 1000px;">
                        <div class="d-flex justify-content-between " style="width: 80%; margin:auto">
                            <p style="font-size: 20px;" class="text-center">The Pizzeria</p>
                            <div class="d-flex" style="position: relative">
                                <div class="container-input">
                                    <input type="text" placeholder="Search" name="text" class="inputsearch input">
                                    
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

                    

                    echo isset($_SESSION['user_id']) && isset($row_user) ? ('<div class="dropdown rounded-circle d-flex justify-content-between" style="height: 80px; width: 120px;">
                            <img class="btn-dropdown rounded-circle" style="height: 75%; width: 65px; cursor:pointer" src="../avatar/' . $row_user['avatar'] . '" alt="">
        
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
                <button class="btn btn-secondary btnNav">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <div class="divToggle w-100 px-4 py-3">
                            <div class="text-end mb-3"><button class="btn btn-secondary btnHide">X</button></div>
                            <div class="d-flex  flex-column">
                                <div class="d-flex justify-content-between">
                                    <div class="icon-header d-flex" style="width: 170px;">
                                        <i class="fa-brands fa-facebook me-2"></i>
                                        <i class="fa-brands fa-twitter me-2"></i>
                                        <i class="fa-brands fa-square-instagram"></i>
                                    </div>
                                    <?php

                                    

                                    echo isset($_SESSION['user_id']) ? ('<div class="dropdown rounded-circle d-flex justify-content-between" style="height: 80px; width: 120px;">
                            <img class="btn-dropdown rounded-circle" style="height: 75%; width: 65px; cursor:pointer" src="../avatar/' . $row_user['avatar'] . '" alt="">
        
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
                            
                        </script>'

                                    ) : ('<button class="d-flex justify-content-center align-content-center flex-wrap loginbtn btn_login btn_login1">
                            LOG IN
                        </button>
                        <script>
                            var dropdowm = null;
                            var dropdowm_menu = null;
                        </script>'
                                    );
                                    ?>
                                </div>
                                <div class="">
                                    <div class="d-flex flex-column w-25 divBar" style="gap: 10px;">
                                        <div style="cursor: pointer" class="home linav">HOME</div>
                                        <div style="cursor: pointer" class="menu linav">OUR MENU</div>
                                        <div style="cursor: pointer" class="about linav">ABOUT</div>
                                        <div style="cursor: pointer" class="offer linav">OFFER</div>
                                        <div style="cursor: pointer" class="contact linav">CONTACT</div>
                                    </div>
                                </div>
                                <div class="container-input mt-3 w-100">
                                    <input type="text" placeholder="Search" name="text" class="inputsearch1 input w-100">
                                    <div class="resultSearch1 w-100" style="overflow: hidden;">
                                        <div class="divfoodsearch1" style="width: 100%; height:100%;background-color: whitesmoke; overflow-y: scroll;">
    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </header>
    </div>
    <div class="description text-center d-flex flex-column flex-wrap justify-content-center align-content-center" style="width: 1200px; height: 400px; position: absolute; top: 200px; left: 50%; transform: translateX(-50%); color: white;">
        <p class="titleHeader" >
            <?php echo $pageInfo['title']; ?>
        </p>
        <div class="descriptionHeader" >
            <?php echo $pageInfo['description']; ?>
        </div>
    </div>

</div>

<?php

?>