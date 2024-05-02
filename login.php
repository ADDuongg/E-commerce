<?php
session_start(); // Bắt đầu phiên làm việc

include("database.php");

if (isset($_POST["Login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $cmd = "SELECT * FROM account WHERE email = ?";
    $stmt = $conn->prepare($cmd);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $id = uniqid();
        $user = $result->fetch_assoc();
        $storedPasswordHash = $user['password'];

        // Sử dụng hàm password_verify() để kiểm tra mật khẩu
        if (password_verify($password, $storedPasswordHash) && ($user['role'] === "Khach hang" || $user['role'] === "admin")) {
            // Đăng nhập thành công
            $_SESSION['authenticated'] = true;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_role'] = $user['role'];
            $session_id = $_SESSION['user_id'];
            $sql = "insert into sessions(id, session) values ('$id', '$session_id')";
            $conn->query($sql);

            if ($user['role'] === "admin") {
                echo '<script>alert("Đăng nhập thành công")</script>';
                header('Location: ./component_old/admin.php');
                exit();
            } else {

                echo '<script>alert("Đăng nhập thành công")</script>';
                header('Location: page.php');
                exit();
            }
        } else {
            // Đăng nhập không thành công
            echo  '<script>alert("Mật khẩu không khớp") </script>';
        }
    } else {
        // Đăng nhập không thành công (tài khoản không tồn tại)
        echo  '<script>alert("Tài khoản không tồn tại") </script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
    <style>
        .divform {
            width: 100%;
            height: 700px;
            display: flex;
            justify-content: center;
            align-content: center;
            margin-top: 30px;
            /* border: solid 1px black; */
            flex-wrap: wrap;

        }
    </style>
</head>

<body>
    <div class='divform'>
        <form class="mt-5" method="POST" action="login.php">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control password" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <label class="form-check-label" for="exampleCheck1">Show password</label>
                <input type="checkbox" class="form-check-input check" id="exampleCheck1">
            </div>
            <p>Forgot Password? <a href="./forgotpass.php" style="text-decoration: none;">Click here</a></p>
            <input type="submit" class="btn btnLogin btn-primary" value="Login" name="Login"></input>
            <button type="button" onclick="window.location.href='register.php'" class="btn btnLogin btn-primary">Register</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>