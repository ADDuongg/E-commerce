<?php
$admin_select = "select account.*, sessions.session from account RIGHT JOIN sessions on sessions.session = account.user_id";
$result_admin = $conn->query($admin_select);
while ($admin = $result_admin->fetch_assoc()) {
    $avatar_admin = $admin['avatar'];
}

?>
<div class="header border-bottom border-3 d-flex flex-column" style="height: auto; width: 100%;">
    <div class="border-bottom border-1 d-flex justify-content-between" style="height: 50px; width: 100%;">
        <button class="btn btnsidebar" type="button" id="btnToggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="me-5 divadmin-profile">
            <img class="avataradmin" src="../avatar/<?php echo $avatar_admin ?>" alt="" style="height: 3rem; width: 3rem; cursor: pointer;">
        </div>
    </div>
    <div class="divdashboard d-flex justify-content-around p-3">
        <div class="container">
            <div class="row g-3 d-flex justify-content-center">
                <div class="col-lg-3 col-12  divactiveuser divdash  border border-1 shadow" style="border-radius: 5%;">
                    <div class="d-flex align-content-center ps-3" style="height: 100%; width: 100%; flex-wrap: wrap;">Số người đang online: <span class="ps-2"><?php echo $number_active ?></span></div>
                </div>
                <div class="col-lg-3 col-12 mx-5 divrevenue divdash d-flex flex-column border border-1 justify-content-between shadow" style="border-radius: 5%;">
                    <div class="d-flex justify-content-between ps-2 pe-2 pt-1"><span>Số tiền thu được hôm nay</span><i class="fa-solid fa-circle-info" style="padding-top: 5px;"></i></div>
                    <div class="d-flex justify-content-between">
                        <span class="ps-2">Value: <?php echo $salesfigure_formatted ?></span>
                        <span class="pe-2">Target today: 1000$</span>
                    </div>
                    <div class="pb-3 ms-2 me-2">
                        <div class="progress " style="width: 100%; ">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (($salesfigure * 100) / 1000) ?>%" aria-valuenow="<?php echo $salesfigure ?>" aria-valuemin="0" aria-valuemax="1000"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 divsales divdash border border-1 d-flex flex-column border border-1 justify-content-between shadow" style="border-radius: 5%;">
                    <div class="d-flex justify-content-between ps-2 pe-2 pt-1"><span>Hôm nay bán được</span><i class="fa-solid fa-circle-info" style="padding-top: 5px;"></i></div>
                    <div class="d-flex justify-content-between">
                        <span class="ps-2">Number: <?php echo $number_sold ?>$</span>
                        <span class="pe-2">Target today: 1000</span>
                    </div>
                    <div class="pb-3 ms-2 me-2">
                        <div class="progress " style="width: 100%; ">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (($number_sold * 100) / 1000) ?>%" aria-valuenow="<?php echo $number_sold ?>" aria-valuemin="0" aria-valuemax="1000"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="divModalSidebar">
    <div class="text-red modalSidebar">
        <div class="div1">
            <div style="height: 200px; width: 100%;" class="d-flex justify-content-center">
                <img style="height: 200px; width: 200px;" src="../public/logo.png" alt="...">
            </div>
            <div class="detailnav d-flex flex-column align-items-center" style="height: 340px; width: 100%;">
                <div class="item home1"><i class="fa-solid fa-house pe-3"></i> Trang chủ</div>
                <div class="item revenue1"><i class="fa-solid fa-arrow-trend-up pe-3"></i> Quản lý doanh thu</div>
                <div class="item account1"><i class="fa-solid fa-user-tie pe-3"></i> Quản lý tài khoản</div>
                <div class="item food1"><i class="fa-solid fa-bowl-food pe-3"></i> Quản lý món ăn</div>
                <div class="item order1"><i class="fa-solid fa-database pe-3"></i> Quản lý đơn hàng</div>
                <div class="item data1"><i class="fa-solid fa-database pe-3"></i> Thống kê món ăn</div>
            </div>
        </div>
        <div class="div2" style="height: calc(100% - 540px); position: relative; width: 100%;">
            <button class="btn text-danger logout" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);"><i class="fa-solid fa-arrow-right-from-bracket me-3 text-danger"></i><a href="../logout.php" style="text-decoration: none; color: red">Log out</a></button>
        </div>
    </div>
</div>

<script>
    const btnToggleSidebar = document.querySelector('.btnsidebar')
    const divModalSidebar = document.querySelector('.divModalSidebar')
    const modalSidebar = document.querySelector('.modalSidebar')
    if (btnToggleSidebar) {
        btnToggleSidebar.addEventListener('click', function() {

            divModalSidebar.classList.toggle('activeModal')
        })
    }
    divModalSidebar.addEventListener('click', function(event) {
        const isClickedInsideModal = modalSidebar.contains(event.target);
        if (!isClickedInsideModal) {
            divModalSidebar.classList.remove('activeModal');
        }
    });
</script>

<php? ?>