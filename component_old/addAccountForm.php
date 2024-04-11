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
    <form action="addAccount.php" class="forminput_account" method="POST" enctype="multipart/form-data">
        <div class="mb-3 divinput">
            <label for="name" class="form-label ">Name</label>
            <input type="text" name="name" class="form-control " required>
        </div>
        <div class="mb-3 divinput">
            <label for="price" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required value="">
        </div>
        <div class="mb-3 divinput">
            <label for="role">Choose a role</label>
            <select name="role">
                <option value="Khach hang">Khach hang</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="mb-3 divinput">
            <label for="price" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="">
        </div>
        <div class="mb-3 divinput">
            <label for="detail" class="form-label">Date of Birth</label>
            <input type="date" name="dateofbirth" class="form-control" required value="">
        </div>
        <div class="mb-3 divinput">
            <label for="detail" class="form-label">Age</label>
            <input type="text" name="age" class="form-control" required value="">
        </div>
        <div class="mb-3 divinput">
            <label for="img" class="form-label">Avatar</label>
            <input type="file" name="img"  class="form-control">
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary back">Back</button>
            <input type="submit" name="submit" value="Save" class="d-flex justify-content-end btn btn-primary"></input>
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
        const back = document.querySelector('.back');
        back.addEventListener('click', function() {
            window.location.href = "./foodadmin.php"
        })
    </script>
</body>

</html>