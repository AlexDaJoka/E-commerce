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
    <title>orders</title>
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

.show-orders{
padding:50px 0px;
display:flex;
align-items:center;
justify-content:center;
}

.box-orders{
   display:flex;
align-items:center;
justify-content:center;
flex-wrap:wrap;
}

.box-orders .box{
border:1px solid black;
width:420px;
line-height:2em;
font-size:25px;
padding:0px 20px;
margin:0px 25px;

}

.box-orders .box p span{
   color:#00aaff;
}

.box p{
   border-bottom:1px solid black;
}
</style>
<body>

<?php
include 'user_header.php';
?>

<section class="show-orders">

<div class="box-orders">
<?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
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
<p>payment method:<span><?= $fetch_orders['method']; ?></span></p>
<p>payment status:<span style="color:<?php if($fetch_orders['payment_status'] == 'pending' ){echo 'red';}else{echo 'green';}?>"><?= $fetch_orders['payment_status']; ?></span></p>
</div>

<?php

}
}else{
echo '<p class="empty">no orders placed found</p>';
}
}
?>
</div>

</section>

<?php include 'footer.php';?>

</body>
</html>