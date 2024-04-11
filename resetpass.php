<!DOCTYPE html>
<html>
<head>
    <title>Đặt lại mật khẩu</title>
    <!-- Thêm các tệp CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Tùy chỉnh CSS nếu cần thiết */
        body {
            padding: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Đặt lại mật khẩu</h2>
            <form action="./controller_old/resetpass.php" method="post">
                <div class="form-group">
                    <label for="password_new">Mật khẩu mới:</label>
                    <input type="password" class="form-control" id="password_new" name="password_new" required>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Xác nhận mật khẩu:</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                </div>
                <input type="hidden" value="<?php echo $_GET['email'] ?>" name = "email_reset">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Thêm các tệp JavaScript Bootstrap (nếu cần) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
