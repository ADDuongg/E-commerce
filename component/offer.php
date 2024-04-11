<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_new/offer.css">
    <link rel="stylesheet" href="../css_new/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <title>Document</title>
</head>

<body>
    <div class="page" style="height: 100%; width: 100%;">
        <!-- Header -->
        <?php
        session_start();
        include('../database.php');
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }
        include('../layout/setHeader.php');
        $page = 'offer';
        $pageInfo = setPageInfo($page);
        include('../layout/header.php')
        ?>


        <div class="sale" style="background-color: #f7f6f2;height: 2000px; width: 100%;">
            <p style="width: 80%; margin: auto; font-weight: bold; font-size: 75px; padding-top: 100px; ">Best Deals!
            </p>
            <div class="" style="width: 80%; margin: 0 auto; display: flex; flex-direction: column;">
                <div class="d-flex" style="height: 400px; width: 100%; position: relative;">
                    <img style="position: absolute; left: 0; height: 100%; width: 50%; border-radius: 20px;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-1.jpg" alt="">
                    <div class="text-end " style="border-radius: 20px;position: absolute; right: 0;  height: 100%; width: 59%; background-image: url('https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-shape-bg-1.svg'); background-repeat: no-repeat;">
                        <p style=" width: 100%; text-align: start; padding-left: 150px; padding-top: 40px; color: white; font-size: 20px;">
                            Daily Deal!!</p>
                        <p style=" width: 100%; text-align: start; padding-left: 150px; color: white; font-size: 65px;">
                            Big Meat Monsta</p>
                        <p style=" width: 100%; text-align: start; padding-left: 150px; color: white; font-size: 20px;">
                            Nunc tellus pellentesque ut est fames vitae dui posuere.</p>
                        <p style=" width: 100%; text-align: start; padding-left: 150px; color: white; font-size: 80px;">
                            $18</p>
                    </div>
                    <div class="circle text-center d-flex flex-column justify-content-around" style="position: absolute; top: 10%; left: 17%; border-radius: 50%; height: 130px; width: 130px; color: white; z-index: 1; background-color: #e4032f;">
                        <p class="" style="font-size: 30px; margin: 0; padding-top: 15px;">SAVE</p>
                        <p style="font-size: 30px; height: 53px;">50%</p>
                    </div>

                </div>

                <div class="d-flex " style="width: 100%; height:400px; margin-top: 40px;">
                    <div style="height: 100%; flex: 5; position: relative; margin-right: 40px;">
                        <img style="position: absolute; left: 0; height: 400px; width: 100%; border-radius: 20px;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-2.jpg" alt="">
                        <img style="border-radius: 20px;position: absolute; right: 0;  height: 400px; width: 59%;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-shape-bg-2.svg" alt="">
                        <div style="border-radius: 20px; position: absolute; right: -61px; top: 0; height: 100%; width: 65%;">
                            <div class="" style="position: absolute; right: 17%; width: 80%; top: 10%; height: 70%; padding-right: 20px;">
                                <p style="color: white; font-size: 40px; width: 100%;text-align: end; padding-right: 10px; margin: 0;">
                                    Combo Double</p>
                                <p style="color: white; font-size: 40px; width: 100%; text-align: end;padding-right: 10px; padding-bottom: 10px;">
                                    Box</p>
                                <p style="font-size: 90px; color: white; width: 100%; text-align: end;padding-right: 10px;">
                                    $24</p>
                            </div>
                        </div>
                    </div>
                    <div style="height: 100%; flex: 5; position: relative;">
                        <img style="position: absolute; left: 0; height: 400px; width: 100%; border-radius: 20px;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-3.jpg" alt="">
                        <img style="position: relative; border-radius: 20px;position: absolute; right: 0;  height: 400px; width: 59%;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-shape-bg-3.svg" alt="">
                        <div style="border-radius: 20px; position: absolute; right: -61px; top: 0; height: 100%; width: 60%;">
                            <div class="" style="position: absolute; right: 17%; width: 80%; top: 10%; height: 70%; padding-right: 25px;">
                                <p style="color: white; font-size: 40px; width: 100%;text-align: end; padding-right: 10px; margin: 0;">
                                    Italian Stallion</p>
                                <p style="color: white; font-size: 25px; width: 100%; text-align: end;padding-right: 10px; padding-bottom: 10px;">
                                    Starting at</p>
                                <p style="font-size: 90px; color: white; width: 100%; text-align: end;padding-right: 10px;">
                                    $16</p>
                            </div>
                        </div>
                        <div class="circle text-center d-flex flex-column justify-content-around" style="position: absolute; top: 10%; left: 40%; border-radius: 50%; height: 130px; width: 130px; color: white; z-index: 1; background-color: yellow;">
                            <p class="" style="font-size: 30px; margin: 0; padding-top: 15px; color: black;">SAVE</p>
                            <p style="font-size: 30px; height: 53px; color: black;">35%</p>
                        </div>
                        <div>
                            <p></p>
                        </div>
                    </div>
                </div>


                <div class="d-flex " style="width: 100%; height:400px; margin-top: 40px;">
                    <div style="height: 100%; flex: 5; position: relative; margin-right: 40px;">
                        <img style="position: absolute; left: 0; height: 400px; width: 100%; border-radius: 20px;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-5.jpg" alt="">
                        <img style="border-radius: 20px;position: absolute; right: 0;  height: 400px; width: 59%;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-shape-bg-4.svg" alt="">
                        <div style="border-radius: 20px; position: absolute; right: -61px; top: 0; height: 100%; width: 65%;">
                            <div class="" style="position: absolute; right: 17%; width: 80%; top: 10%; height: 70%; padding-right: 20px;">
                                <p style="color: white; font-size: 40px; width: 100%;text-align: end; padding-right: 10px; margin: 0;">
                                    2-in-1</p>
                                <p style="color: white; font-size: 40px; width: 100%; text-align: end;padding-right: 10px; padding-bottom: 10px;">
                                    Combo Deal</p>
                                <p style="font-size: 90px; color: white; width: 100%; text-align: end;padding-right: 10px;">
                                    $24</p>
                            </div>
                        </div>
                    </div>
                    <div style="height: 100%; flex: 5; position: relative;">
                        <img style="position: absolute; left: 0; height: 400px; width: 100%; border-radius: 20px;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-deals-img-6.jpg" alt="">
                        <div style="background-color: #e4032f; clip-path: polygon(50% 0%, 100% 0, 100% 35%, 100% 70%, 100% 100%, 50% 100%, 20% 90%, 0 39%, 0 0, 23% 0);  border-radius: 20px;position: absolute; right: 0;  height: 400px; width: 59%;">
                        </div>
                        <div style="border-radius: 20px; position: absolute; right: -61px; top: 0; height: 100%; width: 65%;">
                            <div class="" style="position: absolute; right: 17%; width: 80%; top: 10%; height: 70%; padding-right: 20px;">
                                <p style="color: white; font-size: 40px; width: 100%;text-align: end; padding-right: 10px; margin: 0;">
                                    Veggie Delight</p>
                                <p style="color: white; font-size: 40px; width: 100%; text-align: end;padding-right: 10px; padding-bottom: 10px;">
                                    Starting at</p>
                                <p style="font-size: 90px; color: white; width: 100%; text-align: end;padding-right: 10px;">
                                    $14</p>
                            </div>
                        </div>
                        <div class="circle text-center d-flex flex-column justify-content-around" style="position: absolute; top: 10%; left: 17%; border-radius: 50%; height: 130px; width: 130px; color: white; z-index: 1; background-color: #e4032f;">
                            <p class="" style="font-size: 30px; margin: 0; padding-top: 15px;">SAVE</p>
                            <p style="font-size: 30px; height: 53px;">20%</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex" style="height: 400px; width: 100%; position: relative; margin-top: 40px;">
                    <img style="position: absolute; left: 0; height: 100%; width: 100%; border-radius: 20px;" src="../public/discount.png" alt="">
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