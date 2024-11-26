<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
}else{
$user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>about</title>
</head>
<style>

</style>
<body>

<?php
include 'user_header.php';
?>

<section class="about">

<div class="row">

<a>Здесь должна быть информация о наших продуктах и о нас</a>

</div>

</section>

<?php include 'footer.php';?>

</body>
</html>