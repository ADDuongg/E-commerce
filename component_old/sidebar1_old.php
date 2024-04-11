<!DOCTYPE html>
<html lang="en">
<?php
include('../database.php');
$iduser = $_SESSION['user_id'];
$cmd1 = "SELECT favor.food_id, foods.* FROM favor INNER JOIN foods ON favor.food_id = foods.id;";
$result1 = $conn->query($cmd1);
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/sidebar1.css">
</head>


<body>
    <div class="col-2 sidebar1 info d-flex flex-column justify-content-between p-0">
        <div class="userinfor  d-flex flex-column justify-content-between align-items-center">
            <div class="userimg rounded-circle border border-3" style=" width: 100px; height: 100px; overflow: hidden;">
                <img class="imageuser" style="width: 100%; height: 100%; object-fit: cover;" src="" alt="...">
            </div>
            <div class="userdetail border border-3 ">
                <div class="detailUser ms-3">
                    <div class="nameuser d-flex">
                    </div>
                    <div class="date">
                    </div>
                    <div class="age">
                    </div>
                    <div class="email">
                    </div>
                    <div class="role">
                    </div>
                </div>
                <div class="action text-end " style="cursor: pointer;">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
            </div>
        </div>
        <div class="recentorder border border-3" style="overflow-y: scroll; flex: 6;">
            <div class="d-flex flex-column justify-content-center align-content-center" style="flex-wrap: wrap;">
                <span class="ms-3">Các món bạn yêu thích</span>
                <?php
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                ?>
                        <div class="foodsame ms-3 d-flex flex-column align-items-center border border-2 shadow mt-3" style="height: auto;">
                            <div class=" border-bottom border-2">
                                <img src="../foodimage/<?php echo $row1['image'] ?>" alt="" style="height: 120px; width: 120px">
                            </div>
                            <div class="text-start d-flex flex-column ps-2" style="width: 100%; height: 100%">
                                <span><?php echo $row1['name'] ?></span>
                                <span><?php echo $row1['price'] ?> $</span>
                            </div>
                        </div>

                <?php
                    }
                } else {
                    echo "<span>Bạn chưa thích món ăn nào</span>";
                }
                ?>
            </div>

        </div>
    </div>
    <script>
        fetch('../controller/userdetail.php')
            .then(res => res.json()) // Chuyển dữ liệu thành đối tượng JSON
            .then(data => {
                // Sử dụng dữ liệu ở đây để cập nhật giao diện người dùng
                console.log(data);
                // Ví dụ:
                document.querySelector('.nameuser').textContent = 'Name: ' + data.username;
                document.querySelector('.date').textContent = 'Ngày sinh: ' + data.dateOfBirth;
                document.querySelector('.age').textContent = 'Tuổi: ' + data.age; // Sửa lỗi ở đây
                document.querySelector('.email').textContent = 'Email: ' + data.email; // Sửa lỗi ở đây
                document.querySelector('.role').textContent = 'Vai trò: ' + data.role; // Sửa lỗi ở đây
                document.querySelector('.imageuser').src = `../avatar/${data.avatar}`; // Sửa lỗi ở đây
                // Cập nhật các thông tin khác tương tự
            })
            .catch(err => console.log(err));

        var edit = document.querySelector('.action');
        edit.addEventListener('click', function() {
            window.location.href = "./edit.php"
        });
    </script>

</body>

</html>