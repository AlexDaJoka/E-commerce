<?php
include('connect.php');


$delete = $_GET['delete'];

$sql = "DELETE FROM products
WHERE product_id = $delete
;";

mysqli_query($conn, $sql);

mysqli_close($conn);

header("location: View_products.php");
?>