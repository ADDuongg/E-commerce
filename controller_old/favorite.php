<?php
session_start();
include('../database.php');
$user_id = $_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD'] === "GET"){
    $idfood = $_GET['idfood'];
    $isfavor = $_GET['isfavor'];
    echo $idfood, $isfavor;
    $id = uniqid();
    if($isfavor == "true"){
        $cmd = "insert into favor(id, user_id, food_id, isfavorite) values ('$id', '$user_id', '$idfood', '$isfavor')";
        $conn->query($cmd);
    }
    else{
        $cmd = "DELETE from favor where food_id = '$idfood' and user_id = '$user_id'";
        $conn->query($cmd);
    }
    
}


?>