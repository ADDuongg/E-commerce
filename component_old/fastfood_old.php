<?php
include '../database.php';
$cmd = "select * from foods where type = 'Fastfood'";
$result = $conn->query(($cmd));

?>
<?php
while ($row = $result->fetch_assoc()) :
    $idfood = uniqid();
?>
    <div class="cards">
        <div class="card">
            <div class="card__image">
                <img src="../foodimage/<?php echo $row['image'] ?>" alt="...">
            </div>
            <div class="card__content">
                <p class="card__title "><?php echo $row['name'] ?></p>
                <div class="card__description">
                    <p class="detail-food "><?php echo $row['detail'] ?></p>
                    <div class="add d-flex justify-content-between " style="height: 40px;">
                        <p class="text-primary price-food"><?php echo $row['price'] ?>$</p>
                        <button data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $idfood; ?>" class="btn btn-success btndetail" style="height: 100%; width: 80px;" data-food-id-fake="<?php echo $idfood; ?>" data-food-id-real="<?php echo $row['id']; ?>"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop<?php echo $idfood; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thông tin sản phẩm</h5>
                    <button type="button" class="btn-close btnclose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="div-image-food">
                        <img class="img-food" style="height: 100%; width: 100%" src="../foodimage/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>">
                    </div>
                    <div class="div-detail-food ms-2 border border-1 rounded">
                        <div class="food-name-price ms-3">
                            <h3><?php echo $row['name']; ?></h3><br>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <h4 class="ps-2"><?php echo $row['price']; ?></h4>
                                    <p>$</p>
                                </div>
                                <div class="me-3">
                                    <button style="height: 30px; width: 30px" id="btn-minus" class="btn-minus rounded-circle bg-danger"><i class="fa-solid fa-minus text-white"></i></button>
                                    <!-- <input value="1" style="height: 30px; width: 30px" class="ms-2 me-2 numberfood" type="text"> -->
                                    <span class="numberfood">1</span>
                                    <button style="height: 30px; width: 30px" id="btn-plus" class="btn-plus rounded-circle bg-success  border-none"><i class="fa-solid fa-plus text-white"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnclose" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btnadd"><i class="fa-solid fa-cart-shopping"></i> Add to cart</button>
                </div>
            </div>
        </div>
    </div>
<?php
endwhile;
?>