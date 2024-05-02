<!DOCTYPE html>
<html lang="en">
<?php
include('../database.php');
$day = date('d');
$active_user = "SELECT COUNT(DISTINCT session) AS unique_sessions FROM sessions;";
$result = $conn->query($active_user);
while ($row = $result->fetch_assoc()) {
    $number_active = $row['unique_sessions'];
}

$sales = "select SUM(totalPrice) as totalprice1 from salefigure where DAY(date) = $day";
$result1 = $conn->query($sales);
while ($row = $result1->fetch_assoc()) {
    $salesfigure = $row['totalprice1'];
    $salesfigure_formatted = number_format($salesfigure, 1);
}
$number = "select SUM(numberSold) as number from salefigure where DAY(date) = $day";
$result2 = $conn->query($number);
while ($row = $result2->fetch_assoc()) {
    $number_sold = $row['number'];
}


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div style="height: 100vh">
        <div class="d-flex" style="height: 100%;">
            <?php include('../layout/sidebar.php') ?>
            <div class=" detailadmin">
                <?php include('../layout/headerAdmin.php') ?>

                <div style="height: auto; width: 100%">
                    <div class="detailtable d-flex p-4" style=" height:100%; width: 100%; flex-wrap: wrap;">
                        <div class="d-flex justify-content-between" style="width: 100%; height: auto; position: relative;">
                            <div class="container">
                                <div class="row g-4">
                                    <div class=" col-lg-6 col-12 text-start">DOANH THU CỬA HÀNG</div>
                                    <div class="d-flex col-lg-6 col-12 justify-content-end">
                                        <div class="d-flex flex-column justify-content-end me-5">
                                            <div class="d-flex my-5" style="position: relative;">
                                                <i class="fa-solid fa-floppy-disk me-3 option" style="cursor: pointer"></i>
                                                <div class="div-option " >
                                                    <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                                                        <div style=" cursor: pointer; " class="d-flex png"><a class="dowloadpng" href="#" download="canvas.png" style="color: black; text-decoration: none;">Save as PNG</a><i style="margin-top: 5px;" class="ms-2 fa-regular fa-file-image"></i></div>
                                                        <p style=" cursor: pointer;" class="d-flex pdf">Save as PDF <i style="margin-top: 5px;" class="ms-2 fa-solid fa-file-pdf"></i></p>
                                                    </div>
                                                </div>
                                                <i class="fa-solid fa-magnifying-glass-plus me-3" onclick="zoomIn()" style="cursor: pointer"></i>
                                                <i class="fa-solid fa-magnifying-glass-minus" onclick="zoomOut()" style="cursor: pointer"></i>
                                            </div>
                                        </div>
                                        <div class="action d-flex justify-content-evenly">
                                            <button class="btn btn-primary mb-2 btn-day me-2" style="height: 40px; width: 80px;">Days</button>
                                            <button class="btn btn-primary mb-2 btn-month me-2" style="height: 40px; width: 80px;">Months</button>
                                            <button class="btn btn-primary mb-2 btn-year" style="height: 40px; width: 80px;">Years</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="saleall d-flex justify-content-center" style=" width: 100%">
                            <div style=" width: 65%; position: relative;">
                                <canvas id="myChart">
                                </canvas>
                                <button class="btn btn-secondary d-flex justify-content-center flex-wrap align-content-center btnResetChart" id="resetButton">Reset</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/2.0.1/chartjs-plugin-zoom.min.js" integrity="sha512-wUYbRPLV5zs6IqvWd88HIqZU/b8TBx+I8LEioQ/UC0t5EMCLApqhIAnUg7EsAzdbhhdgW07TqYDdH3QEXRcPOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module" src="../js/chartRevenue.js"></script>
    <script>
        const {
            jsPDF
        } = jspdf;
        const doc = new jsPDF();

        var option = document.querySelector('.option');
        var btnshow = document.querySelector('.div-option');
        var savepng = document.querySelector('.png');
        var savepdf = document.querySelector('.pdf');
        var dowloadpng = document.querySelector('.dowloadpng');

        savepng.addEventListener('click', function() {
            const canvas = document.getElementById("myChart");
            const imagePNG = canvas.toDataURL("image/png");
            dowloadpng.href = imagePNG;
        });

        savepdf.addEventListener('click', function() {
            const canvas = document.getElementById("myChart");
            const imagePNG = canvas.toDataURL("image/png");
            // Kích thước của trang PDF
            const pdfWidth = 200; // Độ rộng (mm)
            const pdfHeight = 297; // Độ cao (mm)

            // Kích thước của ảnh trên trang PDF
            const imageWidth = pdfWidth;
            const imageHeight = (canvas.height / canvas.width) * imageWidth;
            doc.addImage(imagePNG, "PNG", 0, 0, imageWidth, imageHeight);
            doc.save("image.pdf");
        });

        option.addEventListener('click', function() {
            console.log(123);
            btnshow.classList.toggle('active');
        });
        var logoutadmin = document.querySelector('.logout');
        console.log(logoutadmin);
        logoutadmin.addEventListener('click', function() {
            window.location.href = "../login.php"
        })
    </script>



    <script type="module" src="../js/admin.js"></script>

</body>

</html>