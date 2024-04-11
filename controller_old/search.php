<?php
include('../database.php');

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    /* $search = $_GET['search'] || ''; */
    /* echo $_GET['search']; */
    $query = "SELECT * FROM account WHERE username LIKE '%" .$_GET['search']. "%'";

    
    $result = $conn->query($query);
    $arr = array();
    while($results = $result->fetch_assoc()){
        $arr[] = $results;
  
    } 
    header('Content-Type: application/json');
    print_r (json_encode($arr)) ;
    
}
?>
