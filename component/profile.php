<?php
?>
<div class="profile d-flex flex-column justify-content-start shadow-lg" style=" background-color: white; border-radius: 20px; padding: 40px 40px 0; height:700px">
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