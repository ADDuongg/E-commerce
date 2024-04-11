<?php
include('../database.php');
$id = $_GET['id'];
$cmd = "select * from foods where id = '$id'";
$result = $conn->query($cmd);

if ($result->num_rows === 1) {
    $food = $result->fetch_assoc();
} else {
    echo 'Lỗi';
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>
    <form action="updateFood.php?id=<?php echo $food['id'] ?>" class="forminput" method="POST" enctype="multipart/form-data">
        <div class="mb-3 divinput">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required value="<?php echo $food['name']; ?>">
        </div>
        <div class="mb-3 divinput">
            <label for="type">Choose a type</label>
            <select name="type">
                <option value="Fastfood" <?php if ($food['type'] == 'Fastfood') echo 'selected'; ?>>Fast food</option>
                <option value="Snacks" <?php if ($food['type'] == 'Snacks') echo 'selected'; ?>>Snacks</option>
                <option value="Drink" <?php if ($food['type'] == 'Drink') echo 'selected'; ?>>Drink</option>
            </select>
        </div>
        <div class="mb-3 divinput">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" class="form-control" required value="<?php echo $food['price']; ?>">
        </div>
        <div class="mb-3 divinput">
            <label for="price_medium" class="form-label">Price Medium</label>
            <input type="text" name="price_medium" class="form-control" required value="<?php echo $food['price_medium']; ?>">
        </div>
        <div class="mb-3 divinput">
            <label for="price_large" class="form-label">Price Large</label>
            <input type="text" name="price_large" class="form-control" required value="<?php echo $food['price_large']; ?>">
        </div>
        <div class="mb-3 divinput">
            <label for="detail" class="form-label">Detail</label>
            <input type="text" name="detail" class="form-control" required value="<?php echo $food['detail']; ?>">
        </div>
        <div class="mb-3 divinput">
            <label for="state">Chọn trạng thái</label>
            <select name="state">
                <option value="0" >Còn hàng</option>
                <option value="1">Hết hàng</option>
            </select>
        </div>
        <div class="mb-3 divinput">
            <label for="img" class="form-label">Image</label>
            <input type="file" name="img" class="form-control">
        </div>
        <div class="mb-3 divinput d-flex">
            <label for="flavor" class="form-label ">Flavorite</label>
            <select name="flavor" id="flavorSelect">
                <option value="">Select favorite</option>
            </select>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary back">Back</button>
            <input type="submit" name="submit" value="Save" class="d-flex justify-content-end btn btn-primary">
        </div>
    </form>
    <script>
        var selectElement = document.getElementById("flavorSelect");

        for (var i = 1; i <= 5; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.text = "★".repeat(i);
            selectElement.appendChild(option);
        }
        let back = document.querySelector('.back');
        back.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = "./foodadmin.php";
        })
    </script>

</body>

</html>