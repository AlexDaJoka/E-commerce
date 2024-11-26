<?php
include('connect.php');


$delete = $_GET['delete'];

$sql = "DELETE FROM orders
WHERE order_id = $delete
;";

mysqli_query($conn, $sql);

mysqli_close($conn);

header("location: orders.php");
?>