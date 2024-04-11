<?php
?>
<div class="changepassword d-flex flex-column justify-content-start shadow-lg" style=" background-color: white; border-radius: 20px; padding: 40px 40px 0; height:700px">
    <div class="title mb-5" style="">
        <p style="font-size: 40px; font-weight: bold;">Your Profile</p>
    </div>
    <div class="d-flex justify-content-between " style="height: 70%; border-radius: 15px;">
        <div class="border border-2 d-flex flex-column justify-content-between flex-wrap align-content-center pb-3 " style="flex: 3; height: 100%; width: 100px; margin-right: 20px; background: rgb(34,193,195);
background: linear-gradient(0deg, rgba(34,193,195,1) 21%, rgba(45,131,253,1) 91%);; border-radius: 30px;">
            <img style="flex:7" class="rounded-circle rounded-circle" src="../avatar/<?php echo $row['avatar'] ?>" alt="">
            <div class="d-flex flex-column justify-content-between flex-wrap align-content-center" style="flex:3">
                <p class="action" style="font-weight:bold; font-size: 20px; cursor: pointer; color: blue"><i style="padding: 5px 20px 0 0; color: blue" class="fa-solid fa-user"></i>Cập nhật thông tin cá nhân</p>
                <p class="reroll" style="font-weight:bold; font-size: 20px;cursor: pointer;"><i style="padding: 5px 20px 0 0" class="fa-solid fa-lock"></i>Đặt lại mật khẩu</p>
                <div class="logout" style="font-weight:bold; font-size: 20px;cursor: pointer; color: red"><i style="padding: 5px 20px 0 0; color: red" class="fa-solid fa-right-from-bracket"></i>Log out</div>
            </div>
        </div>

        <div class="border border-2" style="flex: 6;margin-left: 50px;background: rgb(34,193,195);
background: linear-gradient(0deg, rgba(34,193,195,1) 21%, rgba(45,131,253,1) 91%); border-radius: 30px">

            <div class="text-profile" style="width: 100%; font-weight: bold; font-size: 35px; ">
                Change password
            </div>
            <div style="max-width: 60%; margin: 40px auto 0;">
                <form action="../controller_old/changepassword.php" method="POST" style="">
                    <label for="password" class="form-label">Your Password</label>
                    <input style="width: 100%;" type="password" name="password" class="form-control">

                    <label for="password_new" class="form-label">New Password</label>
                    <input style="width: 100%;" type="password" name="password_new" class="form-control">

                    <label for="password_confirm" class="form-v">Confirm Password</label>
                    <input style="width: 100%;" type="password" name="password_confirm" class="form-control">
                    <div class=" d-flex justify-content-end" style="width: 100%;  text-align: end; flex: 1; margin-top: 20px;">
                        <button class="btn btn-primary text-center btnsave" style="height: 45px; width: 100px;">
                            <P style="padding-top: 5px;">SAVE</P>
                        </button>
                    </div>
                </form>
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