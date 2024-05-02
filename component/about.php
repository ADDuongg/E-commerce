<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_new/about.css">
    <link rel="stylesheet" href="../css_new/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div style="height: 100%; width: 100%; ">
        <?php
        session_start();
        include('../database.php');
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }
        include('../layout/setHeader.php');
        $page = 'about';
        $pageInfo = setPageInfo($page);
        include('../layout/header.php')
        ?>

        <div class="about" style="z-index: 2; width: 100%; height: auto; background-color: #f7f6f2; margin-top: 15px; padding-top: 20px;">

            <div class="container">
                <div class="row g-3">
                    <div class="col-lg-8 col-12">
                        <div class="container">
                            <div class="row" style=" color: red; font-weight: bold; font-size: 25px;">
                                <div>Our Story</div>
                            </div>
                            <div class="row">
                                <div style="font-weight: bold; font-size: 60px">Authentic
                                    Italian Pizzeria
                                    <br>
                                    <p style="font-size: 20px;">Varius eu mauris est vitae ultrices et, justo, at in ut faucibus libero
                                        pellentesque facilisis
                                        molestie suspendisse lacinia gravida sed habitasse diam nec nulla.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <img src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-founder-img.jpg" alt="">
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-5">
                                        <p style="font-size: 30px; font-weight: bold;">It's All About The Family</p>
                                        Imperdiet orci, volutpat consequat fermentum, proin tempus et tellus, vulputate adipiscing
                                        auctor
                                        nulla in malesuada et amet, aliquam laoreet mauris gravida consectetur malesuada est ultricies
                                        diam
                                        vestibulum velit sit aliquet pellentesque vitae.
                                    </div>
                                    <div>
                                        <p style="font-size: 30px; font-weight: bold;">Generations in The Making</p>
                                        Cursus ultricies in maecenas pulvinar ultrices integer quam amet, semper dictumst sit interdum
                                        venenatis pellentesque nunc libero vestibulum velit sit aliquet pellentesque vitae mauris
                                        gravida
                                        consectetur malesuada.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div>
                                    <p style="font-weight: bold;">Antonio Baggio</p>
                                    Founder of The Pizzeria
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <img style="height: 100%; width: 100%;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-vintage-building-img.jpg" alt="">
                    </div>
                </div>
            </div>

            <!-- <div style="width: 80%; margin: auto; color: red; font-weight: bold; font-size: 25px;">Our Story</div>

            <div style="column-gap: 20px; width: 80%; height: 800px; margin: auto; display: grid; grid-template-columns: 33% 33% 33%; grid-template-rows: 25% 75%;">
                <div style="font-weight: bold; font-size: 60px; grid-row: 1/ span 1; grid-column: 1/ span 2;">Authentic
                    Italian Pizzeria
                    <br>
                    <p style="font-size: 20px;">Varius eu mauris est vitae ultrices et, justo, at in ut faucibus libero
                        pellentesque facilisis
                        molestie suspendisse lacinia gravida sed habitasse diam nec nulla.</p>
                </div>
                <div style="grid-column: 3/ span 1; grid-row: 1/ span 2; ">
                    <img style="height: 100%; width: 100%;" src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-vintage-building-img.jpg" alt="">
                </div>

                <div style="grid-column: 1/ span 1; grid-row: 2/ span 1">
                    <img src="https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-founder-img.jpg" alt="">
                    <div>
                        <p style="font-weight: bold;">Antonio Baggio</p>
                        Founder of The Pizzeria
                    </div>
                </div>

                <div style="grid-column: 2/ span 1; grid-row: 2/ span 1; display: flex; flex-direction: column;">
                    <div class="mb-5">
                        <p style="font-size: 30px; font-weight: bold;">It's All About The Family</p>
                        Imperdiet orci, volutpat consequat fermentum, proin tempus et tellus, vulputate adipiscing
                        auctor
                        nulla in malesuada et amet, aliquam laoreet mauris gravida consectetur malesuada est ultricies
                        diam
                        vestibulum velit sit aliquet pellentesque vitae.
                    </div>
                    <div>
                        <p style="font-size: 30px; font-weight: bold;">Generations in The Making</p>
                        Cursus ultricies in maecenas pulvinar ultrices integer quam amet, semper dictumst sit interdum
                        venenatis pellentesque nunc libero vestibulum velit sit aliquet pellentesque vitae mauris
                        gravida
                        consectetur malesuada.
                    </div>
                </div>
            </div> -->
        </div>

        <div class="mt-4 p-5 divFirst" >
            <div  style="height: auto; width: 600px; background-color: white; padding: 40px 35px 0;" >
                <p style="color: red;font-size: 15px; font-weight: bold;">The Pizzeria</p>
                <p style="font-size: 40px; font-weight: bold;">Incredible Dishes Start Here</p>
                <p>Semper dictumst sit interdum venenatis pellentesque nunc libero vestibulum velit sit aliquet
                    pellentesque vitae.</p>
                <div class="d-flex justify-content-between flex-wrap align-content-center mt-4" style="width: 100%;">
                    <i style="flex: 1; color: red;font-size: 30px; padding-top: 9px;" class="fa-solid fa-store"></i>
                    <div style="flex: 9;">
                        <p style="font-weight: bold; font-size: 20px;">4,200 square feet of space</p>
                        <p>Bibendum rhoncus amet tellus ornare lobortis sit aliquet elit, hac nisi, mauris ac tellus
                            velit sollicitudin.</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between flex-wrap align-content-center mt-4" style="width: 100%;">
                    <i style="flex: 1; color: red;font-size: 30px; padding-top: 9px;" class="fa-solid fa-pizza-slice"></i>
                    <div style="flex: 9;">
                        <p style="font-weight: bold; font-size: 20px;">Heritage You Can Taste</p>
                        <p>Pretium, condimentum magna amet egestas ligula pretium magna rutrum a in arcu, mauris
                            porttitor fermentum.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-5 d-flex justify-content-end" style=" background-color: transparent; background-size: cover; background-position: center; width: 100%; height: 600px; background-image: url('https://websitedemos.net/pizzeria-04/wp-content/uploads/sites/791/2021/03/pizzeria-template-fresh-ingredients-img-1.jpg');">
            <div style="height: 500px; width: 600px; background-color: white;  padding: 40px 35px 0;">
                <p style="color: red;font-size: 15px; font-weight: bold;">Authentic</p>
                <p style="font-size: 40px; font-weight: bold;">Recipe With Roots</p>
                <p>Semper dictumst sit interdum venenatis pellentesque nunc libero vestibulum velit sit aliquet
                    pellentesque vitae.</p>
                <div class="d-flex justify-content-between flex-wrap align-content-center mt-4" style="width: 100%;">
                    <i style="flex: 1; color: red;font-size: 30px; padding-top: 9px;" class="fa-solid fa-burger"></i>
                    <div style="flex: 9;">
                        <p style="font-weight: bold; font-size: 20px;">Authentic Italian Flavors</p>
                        <p>Bibendum rhoncus amet tellus ornare lobortis sit aliquet elit, hac nisi, mauris ac tellus
                            velit sollicitudin.</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between flex-wrap align-content-center mt-4" style="width: 100%;">
                    <i style="flex: 1; color: red;font-size: 30px; padding-top: 9px;" class="fa-solid fa-hand-point-right"></i>
                    <div style="flex: 9;">
                        <p style="font-weight: bold; font-size: 20px;">Handmade "Secret" Ingredients</p>
                        <p>Pretium, condimentum magna amet egestas ligula pretium magna rutrum a in arcu, mauris
                            porttitor fermentum.</p>
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