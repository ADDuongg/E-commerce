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
            <div class="detailadmin" style="padding: 0; position: relative;">
                <?php include('../layout/headerAdmin.php') ?>

                <div style="height: auto; width: 100%; overflow-y: scroll;">
                    <div class="detailtable d-flex " style=" height: 100%; width: 100%; flex-wrap: wrap;">
                        <div class="d-flex justify-content-between py-4" style="width: 100%;">
                            <div class="text-center">Thống kê chi tiết thông tin món ăn</div>
                            <?php
                            

                            $type = isset($_GET['type']) ? $_GET['type'] : 'all';

                            if ($type === 'all' || $type === 'top5') {
                            ?>
                                <div class="d-flex " style=" height: 30px;">
                                    <div style="cursor: pointer;" class="d-flex png"><a class="dowloadpng" href="#" download="canvas.png" style="color: black; text-decoration: none;">Save as PNG</a><i style="margin-top: 5px;" class="ms-2 fa-regular fa-file-image"></i></div>
                                    <p style="cursor: pointer; width: 140px;" class="d-flex pdf">Save as PDF <i style="margin-top: 5px;" class="ms-2 fa-solid fa-file-pdf"></i></p>
                                </div>
                            <?php
                            } else {

                                echo '';
                            }

                            ?>

                            <div class="action d-flex ">
                                <button style="height: 37.6px;" class="btn btn-primary mb-2 btn-all me-2">Tổng quát</button>
                                <button style="height: 37.6px;" class="btn btn-primary mb-2 btn-detail me-2">Top 5 món ăn</button>
                                <button style="height: 37.6px;" class="btn btn-primary mb-2 btn-detailsale ">Thông tin bán hàng</button>
                            </div>
                        </div>
                        <div class="saleall d-flex justify-content-center " style=" width: 100%; ">
                            <?php if (isset($_GET['type']) && ($_GET['type'] === 'all' || $_GET['type'] === 'top5')) { ?>
                                <div style="width: 41%">
                                    <div class="div-canvas">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            <?php } elseif (isset($_GET['type']) && $_GET['type'] === "salesfigure") { ?>

                                <?php
                                $page;
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                } else {
                                    $page = 1;
                                }
                                $item_per_page = 5;
                                $start_from = ($page - 1) * $item_per_page;
                                $cmd_selectall = "select * from salefigure";
                                $result_cmd = $conn->query($cmd_selectall);
                                $numrow = $result_cmd->num_rows;
                                $totalPage = ceil($numrow / $item_per_page);

                                $sortOrder = "ASC";
                                if (isset($_GET['sort']) && $_GET['sort'] === 'DESC') {
                                    $sortOrder = "DESC";
                                }

                                $sql_select = "SELECT nameFood, type, totalPrice, foodid, numberSold 
                                               FROM salefigure";

                                if (isset($_GET['sort'])) {
                                    $sql_select .= " ORDER BY totalPrice $sortOrder";
                                }

                                $sql_select .= " LIMIT $start_from, $item_per_page";

                                $result_sql = $conn->query($sql_select);
                                $prev_page = ($page == 1) ? $totalPage : $page - 1;
                                $next_page = ($page == $totalPage) ? 1 : $page + 1;

                                ?>
                                <div id="div-table__food" style="width: 100%;">
                                    <table class="table table-striped" style="width: 100%; height: 400px;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên món ăn</th>
                                                <th scope="col">Loại món ăn</th>
                                                <th scope="col">Số lượng bán được <a href="datafood.php?type=salesfigure&page=<?php echo $page; ?>&sort=<?php echo $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">
                                                        <i style="cursor: pointer;" class="fa-solid fa-sort-<?php echo $sortOrder === 'ASC' ? 'up' : 'down'; ?>"></i>
                                                    </a>

                                                </th>
                                                <th scope="col">Tổng tiền thu được <a href="datafood.php?type=salesfigure&page=<?php echo $page; ?>&sort=<?php echo $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">
                                                        <i style="cursor: pointer;" class="fa-solid fa-sort-<?php echo $sortOrder === 'ASC' ? 'up' : 'down'; ?>"></i>
                                                    </a>

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            if ($result_sql->num_rows > 0) {
                                                while ($row = $result_sql->fetch_assoc()) {
                                            ?>
                                                    <tr scope="row">
                                                        <td><?php echo $row['foodid'] ?></td>
                                                        <td><?php echo $row['nameFood'] ?></td>
                                                        <td><?php echo $row['type'] ?></td>
                                                        <td><?php echo $row['numberSold'] ?></td>
                                                        <td><?php echo $row['totalPrice'] ?> $</td>
                                                    </tr>
                                            <?php
                                                }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between">
                                        <span>Show <?php echo $page ?> of <?php echo $totalPage ?> pages</span>
                                        <nav aria-label="Page navigation example ">
                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="datafood.php?type=salesfigure&page=<?php echo $prev_page; ?>&sort=<?php echo $sortOrder ?>">Previous</a></li>
                                                <?php
                                                for ($i = 1; $i <= $totalPage; $i++) {
                                                    echo '<li class="page-item"><a class="page-link" href="datafood.php?type=salesfigure&page=' . $i . '&sort=' . ($sortOrder) . '">' . $i . '</a></li>';
                                                }
                                                ?>
                                                <li class="page-item"><a class="page-link" href="datafood.php?type=salesfigure&page=<?php echo $next_page; ?>&sort=<?php echo $sortOrder ?>">Next</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            <?php } else {
                            ?>
                                <div style="width: 41%">
                                    <div class="div-canvas">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
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

    <script src="../js/chartFood.js">
    </script>
    <script>
        const {
            jsPDF
        } = jspdf;
        const doc = new jsPDF();
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
    </script>
    <script type="module" src="../js/admin.js">

    </script>




</body>

</html>