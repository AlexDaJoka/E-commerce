<?php

include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

$order_id = $_POST['order_id'];
$payment_status = $_POST['payment_status'];
$update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
$update_status->execute([$payment_status, $order_id]);
$message[] = 'payment status updated';

}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_order->execute([$delete_id]);
    header('location:placed_orders.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>placed orders</title>
    <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
    <script src="/js/app.js"></script>
</head>
<style>
*{
padding:0;
margin:0;
box-sizing:border-box;
}

html{
overflow-x:hidden;
}

.placed-orders{
 display:flex;
    align-items:center;
    justify-content:center;
    position:absolute;
    top:70px;
    left:30vw;
}

body h1{
    display:flex;
    align-items:center;
    justify-content:center;
position:absolute;
top:0;
left:50%;
}

.box-container{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-wrap:wrap;
}

.box{
    height:500px;
    width:350px;
    padding:10px;
    border:1px solid black;
line-height:2em;

}

.box p{
border-bottom:1px solid black;
font-size:26px;
}
.box span{
text-align:center;
justify-content:space-between;
flex-wrap:wrap;
font-size:20px;
color:#00aaff;
}

select{

}


.flex-btn input{
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    color:black;
    border:1px solid black;
    width:200px;
    height:20px;
    transition:0.5s;
box-shadow:0 0px 10px 0 black;
}

.flex-btn input:hover{
    box-shadow:0 0px 5px 0 black;
}

.delete{
    position:relative;
    top:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    color:black;
    border:1px solid black;
    width:200px;
    height:20px;
    transition:0.5s;
box-shadow:0 0px 10px 0 black;
}
.delete:hover{
    box-shadow:0 0px 5px 0 black;

}

</style>
<body>
<?php
include 'admin_header.php'
?>

<h1 class="heading">placed orders</h1>
<section class="placed-orders">



<div class="box-container">

<?php
$select_orders = $conn->prepare("SELECT * FROM `orders` ");
$select_orders->execute();
if($select_orders->rowCount() > 0){
while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){

?>
<div class="box">

<p>user id:<span>  <?= $fetch_orders['user_id']; ?></span></p>
<p>name:<span>  <?= $fetch_orders['name']; ?></span></p>
<p>email:<span>  <?= $fetch_orders['email']; ?></span></p>
<p>number:<span>  <?= $fetch_orders['number']; ?></span></p>
<p>address:<span>  <?= $fetch_orders['address']; ?></span></p>
<p>total_products:<span>  <?= $fetch_orders['total_products']; ?></span></p>
<p>total_price:<span>  $<?= $fetch_orders['total_price']; ?>/-</span></p>
<p>method:<span><?= $fetch_orders['method']; ?></span></p>

<form action="" method="POST">

<input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">

<select name="payment_status" class="drop-down">
<option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>

<option value="pending">pending</option>
<option value="completed">completed</option>

</select>

<div class="flex-btn">
<input type="submit" valur="update" class="btn" name="update_payment">
<a href="placed_orders.php?delete=<?=$fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete">delete</a>
</div>

</form>

</div>
<?php
}
}else{
echo '<p class="empty">no orders placed</p>';
}
?>
</div>

</section>

</body>
</html>