<?php
    session_start();
    include('../database.php');
    $user_id = $_SESSION['user_id'];
    $cmd = "select * from account where user_id = '$user_id'";
    $result = $conn->query($cmd);
    $row = $result->fetch_assoc();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .formedit {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 5%;
            height: 400px;
            width: 500px;
        }
    </style>
</head>

<body>
    
    <div class="formedit shadow-lg border border-1 ">
        <form class="ms-3 me-3 mt-3" action="../controller_old/edituser.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name" class="form-label">Name</label>
                <input value="<?php echo $row['username'] ?>" type="text" class="form-control " name="name" id="name" aria-describedby="emailHelp">
            </div>
            <div>
                <label for="email" class="form-label">Email</label>
                <input value="<?php echo $row['email'] ?>" type="email" class="form-control " name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div>
                <label for="date" class="form-label">Date of birth</label>
                <input value="<?php echo $row['dateOfBirth'] ?>" type="date" class="form-control " name="date" id="date" aria-describedby="emailHelp">
            </div>
            <div>
                <label for="age" class="form-label">age</label>
                <input value="<?php echo $row['age'] ?>" type="text" class="form-control " name="age" id="age" aria-describedby="emailHelp">
            </div>
            <div>
                <label for="img" class="form-label">Avatar</label>
                <input type="file" class="form-control " name="img" id="img" aria-describedby="emailHelp">
            </div>
            <div class="action mt-4 text-end">
                <button name="edit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <?php
    ?>

</body>

</html>