<?php
    include("../database.php");
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $confirm = $_POST["confirmpassword"];
        $age = $_POST['age'];
        $date = $_POST['date'];

        // Kiểm tra mật khẩu và mật khẩu xác nhận
        if ($password !== $confirm) {
            echo "Mật khẩu không khớp. Vui lòng thử lại.";
        } else {
            // Bảo mật mật khẩu trước khi lưu trữ vào cơ sở dữ liệu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
            $checkCmd = "SELECT * FROM account WHERE email = ?";
            $checkStmt = $conn->prepare($checkCmd);
            $checkStmt->bind_param('s', $email);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            if ($checkResult->num_rows > 0) {
                echo "Email đã được đăng ký.";
            }
            else {
                // Nếu email chưa được đăng ký, thực hiện truy vấn INSERT
                $id = uniqid();
                $insertCmd = "INSERT INTO account(user_id, username, email, password, role, dateOfBirth, age) VALUES (?, ?, ?, ?, 'admin',?,?)";
                $insertStmt = $conn->prepare($insertCmd);
                $insertStmt->bind_param('sssssi', $id, $name, $email, $hashedPassword, $date, $age);

                if ($insertStmt->execute()) {
                    echo "Đăng ký thành công!";
                    echo "<script>window.location.href = '../login.php'</script>";

                } else {
                    echo "Đăng ký thất bại.";
                }
            }
        }
    }
    ?>