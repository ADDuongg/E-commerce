<?php
session_start();
include('../database.php');
$id = $_SESSION['user_id'];

$select = "select password from account where user_id = '$id'";
$result = $conn->query($select);
$row = $result->fetch_assoc();
if($_SERVER['REQUEST_METHOD'] === "POST"){
$password = $_POST['password'];
$password_new = $_POST['password_new'];
$password_confirm = $_POST['password_confirm'];

if(password_verify($password, $row['password']) && ($password_confirm === $password_new)){
    $hash_password = password_hash($password_new, PASSWORD_DEFAULT);
    $update = "update account set password = '$hash_password'";
    $result_update = $conn->query($update);
    echo '<script>history.back()</script>';
}

}
else{
    echo 'ERROR';
}
