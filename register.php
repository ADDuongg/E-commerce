<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registration Form</title>
    <style>
        .divform {
            width: 100%;
            height: 700px;
            display: flex;
            justify-content: center;
            align-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>
    <div class="divform">
        <form class="mt-5" method="POST" action="./controller_old/register.php" style="width: 300px;">
            <div class="mb-3">
                <label for="name" class="form-label">Your name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date of birth</label>
                <input name="date" type="date" class="form-control" id="date" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Your age</label>
                <input name="age" type="number" class="form-control" id="age" min="0" max="100" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm password</label>
                <input name="confirmpassword" type="password" class="form-control" id="confirmpassword" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="showPassword">
                <label class="form-check-label" for="showPassword">Show password</label>
            </div>
            <button onclick="window.location.href = 'login.php'" type="button" class="btn btnLogin btn-primary">Back</button>
            <button type="submit" class="btn btnLogin btn-primary">Register</button>
        </form>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.