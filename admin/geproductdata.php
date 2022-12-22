<?php 	

include('includes/dbconnection.php');

$productId = $_POST['productId'];


$sql = "SELECT ProductName,ID,Price FROM tblproducts WHERE ID = $productId";
$result = $con->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$con->close();

echo json_encode($row);