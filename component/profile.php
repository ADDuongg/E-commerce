<?php
?>
<div class="profile d-flex flex-column justify-content-start shadow-lg p-5" style=" background-color: white; border-radius: 20px;  height:auto">
    <div class="title mb-5" style="">
        <p style="font-size: 40px; font-weight: bold;">Your Profile</p>
    </div>
    <div class="d-flex justify-content-between " style="height: 70%; border-radius: 15px;">
        <div class="container">
            <div class="row g-3 p-3">
                <div class="col-lg-4 mx-auto col-12 border border-2 d-flex flex-column justify-content-between flex-wrap align-content-center pb-3 " style=" background-color: #f7f6f2; border-radius: 30px;">
                    <div class="h-50 w-100 d-flex justify-content-center align-items-center">
                        <img style="height: 13rem; width: 13rem" class="rounded-circle rounded-circle" src="../avatar/<?php echo $row['avatar'] ?>" alt="">
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between flex-wrap align-content-center  w-100">
                        <p class="action" style="font-weight:bold; font-size: 20px; cursor: pointer; color: blue"><i style="padding: 5px 20px 0 0; color: blue" class="fa-solid fa-user"></i>Cập nhật thông tin cá nhân</p>
                        <p class="reroll" style="font-weight:bold; font-size: 20px;cursor: pointer;"><i style="padding: 5px 20px 0 0" class="fa-solid fa-lock"></i>Đặt lại mật khẩu</p>
                        <div class="logout" style="font-weight:bold; font-size: 20px;cursor: pointer; color: red"><i style="padding: 5px 20px 0 0; color: red" class="fa-solid fa-right-from-bracket"></i>Log out</div>
                    </div>
                </div>

                <div class="col-lg-7 col-12 border border-2 p-3" style=" background-color: #f7f6f2 ; border-radius: 30px">

                    <div class="text-profile" style="width: 100%; font-weight: bold; font-size: 35px; ">
                        Profile detail
                    </div>
                    <div style="max-width: 60%; margin: 0 auto 0;">
                        <form class="" action="../controller_old/edituser.php" method="POST" enctype="multipart/form-data">
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input value="<?php echo $row['username'] ?>" type="text" class="form-control " name="name" id="name" aria-describedby="emailHelp">
                            </div>
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input value="<?php echo $row['email'] ?>" type="email" class="form-control " name="email" id="email" aria-describedby="emailHelp">
                            </div>
                            <div>
                                <label for="date" class="form-label">Date of birth</label>
                                <input value="<?php echo $row['dateOfBirth'] ?>" type="date" class="form-control " name="date" id="date" aria-describedby="emailHelp">
                            </div>
                            <div>
                                <label for="age" class="form-label">age</label>
                                <input value="<?php echo $row['age'] ?>" type="text" class="form-control " name="age" id="age" aria-describedby="emailHelp">
                            </div>
                            <div>
                                <label for="img" class="form-label">Avatar</label>
                                <input type="file" class="form-control " name="img" id="img" aria-describedby="emailHelp">
                            </div>
                            <div class="action mt-2 text-end">
                                <button name="edit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="action" style="width: 100%; text-align: end; flex: 2">
        <i class="fa-solid fa-pen-to-square" style="font-size: 35px; padding: 40px; cursor: pointer; "></i>
    </div> -->
</div>
<script>
    var edit = document.querySelector('.action');
    var reroll = document.querySelector('.reroll');
    var logout = document.querySelector('.logout');
    edit.addEventListener('click', function() {
        window.location.href = "../component/usersetting.php?type=profile"
        console.log(123);
    });
    reroll.addEventListener('click', function() {
        window.location.href = "../component/usersetting.php?type=changepassword"
    });
    logout.addEventListener('click', function() {
        window.location.href = "../logout.php"
    });
</script>
<?php

?>