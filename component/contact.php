<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_new/contact.css">
    <link rel="stylesheet" href="../css_new/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div style="height: 100%; width: 100%;">
        <?php
        session_start();
        include('../database.php');
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }
        include('../layout/setHeader.php');
        $page = 'contact';
        $pageInfo = setPageInfo($page);
        include('../layout/header.php')
        ?>

        <div style="width: 100%; height: 1000px; background-color:#f7f6f2 ; position: relative; margin-top: 30px;">
            <div style="display: flex; position: absolute; background-color:#f7f6f2; height: 100%; width: 75%; left: 50%; transform: translateX(-50%); top: -13%; border-radius: 20px;">
                <div class="d-flex flex-column justify-content-between" style="flex:4; padding: 40px 40px 0; height: 80%;">
                    <div>
                        <p style="font-size: 40px; font-weight: bold;">Corporate Office</p>
                        <div class="d-flex" style="width: 300px; height: 75px;">
                            <i style="font-size: 20px; color: red; flex: 2; padding-top: 10px;" class="fa-solid fa-location-dot"></i>
                            <p style="flex: 8; font-size: 20px;">Via di S. Vincenzo, 12/34A, 00123 Roma RM, Italy.</p>
                        </div>

                        <div class="d-flex" style="width: 300px;">
                            <i style="font-size: 20px; color: red; flex: 2; padding-top: 10px;" class="fa-solid fa-phone"></i>
                            <p style="flex: 8; font-size: 20px;">+84 856 474 699</p>
                        </div>

                        <div class="d-flex" style="width: 300px;">
                            <i style="font-size: 20px; color: red; flex: 2; padding-top: 10px;" class="fa-solid fa-envelope"></i>
                            <p style="flex: 8; font-size: 20px;">duong88999@gmail.com</p>
                        </div>
                    </div>

                    <div>
                        <p style="font-size: 40px; font-weight: bold;">Press Inquiries</p>
                        <p style="font-weight: bold; font-size: 30px;">Matteo Damian</p>
                        <div class="d-flex" style="width: 300px;">
                            <i style="font-size: 20px; color: red; flex: 2; padding-top: 10px;" class="fa-solid fa-phone"></i>
                            <p style="flex: 8; font-size: 20px;">+84 367 565 105</p>
                        </div>

                        <div class="d-flex" style="width: 300px;">
                            <i style="font-size: 20px; color: red; flex: 2; padding-top: 10px;" class="fa-solid fa-envelope"></i>
                            <p style="flex: 8; font-size: 20px;">aduong88999@gmail.com</p>
                        </div>
                    </div>

                    <div>
                        <p style="font-size: 40px; font-weight: bold;">Stay Connected</p>
                        <div class="d-flex justify-content-around" style="width: 50%;">
                            <i style="font-size: 20px; color: red;" class="fa-brands fa-twitter"></i>
                            <i style="font-size: 20px; color: red;" class="fa-brands fa-facebook"></i>
                            <i style="font-size: 20px; color: red;" class="fa-brands fa-instagram"></i>
                            <i style="font-size: 20px; color: red;" class="fa-brands fa-youtube"></i>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column" style="flex: 6; background-color: white; border-radius: 20px; padding: 40px 40px 0">
                    <div class="title">
                        <p style="font-size: 40px; font-weight: bold;">We love to hear from you</p>
                        <p style="font-size: 20px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit
                            tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                    </div>
                    <div class="form-contact mt-2">
                        <form action="../controller_old/sendcontact.php" method="POST">
                            <div class="d-flex">
                                <div class="input-group d-flex flex-column pe-5">
                                    <label for="f-name" class="">First</label>
                                    <input style="width: 100%; height: 55px; background-color: #fafafa;" type="text" name="f-name" class="form-control">
                                </div>

                                <div class="input-group d-flex flex-column">
                                    <label for="l-name" class="">Last</label>
                                    <input style="width: 100%;background-color: #fafafa" type="text" name="l-name" class="form-control">
                                </div>
                            </div>
                            <div class="input-group d-flex flex-column">
                                <label for="email" class="">Email</label>
                                <input style="width: 100%;height: 55px;background-color: #fafafa" type="email" name="email" class="form-control">
                            </div>

                            <div class="input-group d-flex flex-column">
                                <label for="phone" class="">Phone number</label>
                                <input style="width: 100%;height: 55px;background-color: #fafafa" type="text" name="phone" class="form-control">
                            </div>

                            <div class="input-group d-flex flex-column">
                                <label for="subject" class="">Subject</label>
                                <input style="width: 100%;height: 55px;background-color: #fafafa" type="text" name="subject" class="form-control">
                            </div>

                            <div class="input-group d-flex flex-column">
                                <label for="location" class="">Select location</label>
                                <select class="form-select" style="background-color: #fafafa; width: 100%; height: 55px;" name="location" id="">
                                    <option style="background-color: #fafafa" value="Select Restaurant">Select Restaurant</option>
                                    <option style="background-color: #fafafa" value="The pizzeria Rome">The pizzeria Rome</option>
                                    <option style="background-color: #fafafa" value="The pizzeria Madris">The pizzeria Madris</option>
                                    <option style="background-color: #fafafa" value="The pizzeria Paris">The pizzeria Paris</option>
                                    <option style="background-color: #fafafa" value="The pizzeria Miami">The pizzeria Miami</option>
                                </select>
                            </div>
                            <div class="input-group d-flex flex-column">
                                <label for="comment" class="">Comment or Message</label>
                                <textarea style="width: 100%; height: 200px; background-color: #fafafa;" class="form-control" name="comment" id=""></textarea>
                            </div>

                            <button class="btn-submit">Submit</button>
                        </form>


                    </div>
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
    </script>
    <script src="../js/all.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>