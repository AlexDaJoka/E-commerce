<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
}else{
$user_id = '';
header('location:home.php');
};

if(isset($_POST['delete'])){
$cart_id = $_POST['cart_id'];
$delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
$delete_cart->execute([$cart_id]);
$message[] = 'cart item deleted';
}

if(isset($_GET['delete_all'])){
$delete_all = $_GET['delete_all'];
$delete_all_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
$delete_all_cart->execute([$user_id]);
header('location:cart.php');
}

if(isset($_POST['update_qty'])){
$cart_id = $_POST['cart_id'];
$qty = $_POST['qty'];
$update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
$update_qty->execute([$qty, $cart_id]);
$message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>cart</title>
</head>
<style>
*{
    padding:0;
    margin:0;
    box-sizing:border-box;
}


.wishlist{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    padding:50px;
}

.wishlist h1{
    position:absolute;
    top:120px;
}

.box-container form{
border:1px solid black;
display:flex;
align-items:center;
justify-content:center;
margin:100px 50px;
padding:50px;
width:300px;
line-height:2em;
}

.box-container form img{
width:200px;
height:200px;
}

.box-container form a{
position:relative;
top:-50px;
right:-100px;
color:black;
width:20px;
height:20px;
}

.qty{
    border:1px solid black;
    font-size:20px;
    width:50px;
    height:25px;
}

.btn{
    display:flex;
    align-items:center;
    justify-content:center;
    width:200px;
    height:25px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
}
.btn:hover{
    box-shadow:0 0 10px 0 black;

}

.delete-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    width:200px;
    height:25px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
}
.delete-btn:hover{
    box-shadow:0 0 10px 0 black;

}

.wishlist-total{
    position:absolute;
    top:110px;
    left:20px;
border:1px solid black;
}

.wishlist-total a{
    display:flex;
    align-items:center;
    justify-content:center;
text-decoration:none;
color:black;
}

</style>
<body>

<?php
include 'user_header.php';
?>

<section class="wishlist">

<h1>Your cart</h1>

<div class="box-container">

<?php
$grand_total = 0;
$select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$select_cart->execute([$user_id]);
if($select_cart->rowCount() > 0){
while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){

?>
<form action="" method="post" class="box">
<input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
    <a href="quick_view.php?pid=<?= $fetch_cart['pid'];?>" class="fas fa-eye"></a>
<img src="uploaded_img/<?= $fetch_cart['image'];?> class="image">
<div class="name"><?= $fetch_cart['name'];?></div>
<div class="flex">
<div class="price">$<span><?= $fetch_cart['name'];?></span>/-</div>
<input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity'];?>"
onkeypress="if(this.value.length == 2) return false;">

<button type="submit" class="fas fa-edit" name="update_qty"></button>
</div>

<div class="sub-total">sub total :
<span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);?>/-</span>
</div>

<input type="submit" value="delete item" onclick="return confirm('delete this from cart ');" name="delete" class="delete-btn"
>
</form>
<?php
$grand_total += $sub_total;
}
}else{
echo '<p class="empty">no products added yet</p>';
}
?>
</div>

<div class="wishlist-total">

<div class="grand-total">grand total: <span>$<?= $grand_total; ?></span>/-</div>
<a href="shop.php" class="btn">continue shopping</a>
<a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled';?>" onclick="return confirm('delete all from cart ');">delete all</a>
<a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled';?>">proceed to checkout</a>
</div>

</section>

<?php include 'footer.php';?>

</body>
</html>