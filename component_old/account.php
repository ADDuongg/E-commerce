<?php
include('../database.php');
$cmd = "SELECT * FROM account";
$result1 = $conn->query($cmd);
$totalRow = $result1->num_rows;

$itemPerPage = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$start_from = ($page - 1) * 5;
/* $select = "SELECT *
FROM account
LIMIT $start_from, $itemPerPage
";
$result_account = $conn->query($select); */
$total_page = ceil($totalRow / $itemPerPage);
$prev_page = ($page == 1) ? $total_page : $page - 1;
$next_page = ($page == $total_page) ? 1 : $page + 1;

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

$sortOrder = "ASC";
if (isset($_GET['sort']) && $_GET['sort'] === 'DESC') {
    $sortOrder = "DESC";
}

$sql_select = "SELECT * FROM account";

if (isset($_GET['sort']) && $_GET['fieldsort'] === "username") {
    $sql_select .= " ORDER BY username $sortOrder";
    echo '<script>console.log(' . $_GET['sort'] . ')</script>';
}
if (isset($_GET['sort']) && $_GET['fieldsort'] === "age") {
    $sql_select .= " ORDER BY age $sortOrder";
    echo '<script>console.log(' . $_GET['sort'] . ')</script>';
}

$sql_select .= " LIMIT $start_from, $itemPerPage";
$result_account = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>
    <div style="height: 100vh;">
        <div class="d-flex" style="height: 100%;">
            <?php include('../layout/sidebar.php') ?>
            <div class=" detailadmin">
                <?php include('../layout/headerAdmin.php') ?>
                <div class="mt-1" style="overflow-y: scroll; ">
                    <div class="detailtable" style=" height:100%; width: 100%;">
                        <div class="table-responsive border border-1 table-food" style="width: 100%">
                            <div class="d-flex justify-content-evenly mt-2" style="width: 100%;">
                                <div class="d-flex">
                                    <label style="height: 100%;" for="search">Search: </label>
                                    <input name="search" type="search" class="form-control ms-2">
                                </div>
                                <div class="text-end"><button class="btn btn-success btnAddAccount">Add Account</button></div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Name<a href="account.php?page=<?php echo isset($page) ? $page : ''; ?>&sort=<?php echo $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>&fieldsort=username">
                                                <i style="cursor: pointer;" class="fa-solid fa-sort-<?php echo $sortOrder === 'ASC' ? 'up' : 'down'; ?>"></i>
                                            </a>
                                        </th>

                                        <th scope="col">Email</th>
                                        </th>
                                        <th scope="col">role</th>
                                        <th scope="col">DateOfBirth</th>
                                        <th scope="col">Age<a href="account.php?page=<?php echo isset($page) ? $page : ''; ?>&&sort=<?php echo $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>&&fieldsort=age">
                                                <i style="cursor: pointer;" class="fa-solid fa-sort-<?php echo $sortOrder === 'ASC' ? 'up' : 'down'; ?>"></i>
                                            </a>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="t-body">
                                    <?php while ($row = $result_account->fetch_assoc()) :
                                    ?>
                                        <tr class="tr-data">
                                            <td><?php echo $row['user_id']; ?></td>
                                            <td><img style="height: 50px; width: 50px;" src="../avatar/<?php echo $row['avatar'] ? $row['avatar'] : 'default.png' ?>" alt=""></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['role']; ?></td>
                                            <td><?php echo $row['dateOfBirth']; ?></td>
                                            <td><?php echo $row['age']; ?></td>
                                            <td>
                                                <div class="d-flex " style="height: 100%; width: 100%; flex-wrap: wrap;">
                                                    <form method="GET" action="updateAccountForm.php">
                                                        <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
                                                        <input type="hidden" name="action" value="update">
                                                        <button type="submit" class="btn  btnUpdate" style="height: auto; width: auto;">
                                                            <i class="fa-solid fa-pen-to-square text-primary" style="height: 100%; width: 100%;"></i>
                                                        </button>
                                                    </form>

                                                    <form method="GET" action="deleteAccount.php?action=delete">
                                                        <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
                                                        <input type="hidden" name="image" value="<?php echo $row['avatar']; ?>">
                                                        <input type="hidden" name="action" value="delete">
                                                        <button type="submit" class="btn  btnDelete" style="height: auto; width: auto;">
                                                            <i class="fa-solid fa-trash text-danger" style="height: 100%; width: 100%;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between">
                                <span>Show <?php echo $page ?> of <?php echo $total_page ?> pages</span>
                                <nav aria-label="Page navigation example ">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="foodadmin.php?page=<?php echo $prev_page; ?>">Previous</a></li>
                                        <?php
                                        for ($i = 1; $i <= $total_page; $i++) {
                                            echo '
                  <li class="page-item"><a class="page-link" href="foodadmin.php?page=' . $i . '">' . $i . '</a></li>
                  ';
                                        }
                                        ?>
                                        <li class="page-item"><a class="page-link" href="foodadmin.php?page=<?php echo $next_page; ?>">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const inputSearch = document.querySelector('input[name="search"]');
        const table = document.getElementById('account-table');
        var tr_Data = document.querySelector('.tr-data')
        var tbody = document.querySelector('.t-body')
        // Hàm cập nhật bảng dữ liệu
        function updateTable(data) {
            // Tạo một biến để chứa nội dung cần cập nhật
            let tableContent = '';

            data.forEach(function(account) {
                tableContent += `
       <tr>
            <td>${account.user_id}</td>
            <td><img style="height: 50px; width: 50px;" src="../avatar/${account.avatar || 'default.png'}" alt=""></td>
            <td>${account.username}</td>
            <td>${account.email}</td>
            <td>${account.role}</td>
            <td>${account.dateOfBirth}</td>
            <td>${account.age}</td>
            <td>
                <div class="d-flex" style="height: 100%; width: 100%; flex-wrap: wrap;">
                    <form method="GET" action="updateAccountForm.php">
                        <input type="hidden" name="id" value="${account.user_id}">
                        <input type="hidden" name="action" value="update">
                        <button type="submit" class="btn btnUpdate" style="height: auto; width: auto;">
                            <i class="fa-solid fa-pen-to-square text-primary" style="height: 100%; width: 100%;"></i>
                        </button>
                    </form>
                    <form method="GET" action="deleteAccount.php?action=delete">
                        <input type="hidden" name="id" value="${account.user_id}">
                        <input type="hidden" name="image" value="${account.avatar}">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btnDelete" style="height: auto; width: auto;">
                            <i class="fa-solid fa-trash text-danger" style="height: 100%; width: 100%;"></i>
                        </button>
                    </form>
                </div>
            </td>
            </tr>
        `;
            });

            // Gán nội dung mới vào bảng
            tbody.innerHTML = tableContent;
        }


        inputSearch.addEventListener('input', function() {
            const value_tmp = inputSearch.value;
            fetch(`../controller_old/search.php?search=${value_tmp}`, {})
                .then((res) => res.json())
                .then((data) => {
                    /* console.log(data.username); */
                    console.log(data);
                    updateTable(data); // Cập nhật bảng dữ liệu khi có dữ liệu mới
                })
                .catch((err) => {
                    console.log(err);
                });
        });





        var btnAdd_account = document.querySelector('.btnAddAccount')
        btnAdd_account.addEventListener('click', function() {
            console.log(123);
            window.location.href = "./addAccountForm.php"
        })

        var logoutadmin = document.querySelector('.logout');
        console.log(logoutadmin);
        logoutadmin.addEventListener('click', function() {
            window.location.href = "../login.php"
        })
    </script>
    <script type="module" src="../js/admin.js">
    </script>
</body>

</html>