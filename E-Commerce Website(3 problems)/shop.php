<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
}else{
$user_id = '';
}

include 'wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>shop</title>
</head>
<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

.products{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
}

.products h1{
    display:flex;
    align-items:center;
    justify-content:center;
}

.box-container{
    display:flex;
    text-align:center;
    justify-content:center;
    flex-wrap:wrap;
    padding:50px 0px;
}

.box-container form{
    display:flex;
    text-align:center;
    justify-content:center;
    margin:15px 0px;
    border:2px solid black;
    width:400px;
    height:400px;
    flex-wrap:wrap;
    background:white;
}

.box-container form img{
    display:flex;
    align-items:center;
    justify-content:center;
    width:200px;
    height:200px;
}

.box-container form .name{
    display:flex;
    justify-content:center;
    width:400px;
}

.box-container form button{
    width:30px;
    height:30px;
    display:flex;
    align-items:center;
    justify-content:center;
}
.box-container form a{
    display:flex;
    align-items:center;
    justify-content:center;

}


.flex .price{
    display:flex;
    align-items:center;
    justify-content:center;
    width:400px;
}

.qty{
    border:1px solid black;
    font-size:20px;
    width:50px;
    height:50px;
}

.btn{
    display:flex;
    align-items:center;
    justify-content:center;
    width:200px;
    height:50px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
}
.btn:hover{
    box-shadow:0 0 10px 0 black;

}
</style>
<body>

<?php
include 'user_header.php';
?>

<section class="products">
<h1>Latest products</h1>
<div class="box-container">

<?php
$select_products = $conn->prepare("SELECT * FROM `products` ");
$select_products->execute();
if($select_products->rowCount() > 0){
while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

?>
<form action="" method="post" class="slide">

<input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
<input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
<input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
<input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">

<button type="submit" name="add_to_wishlist" class="fas fa-heart"></button>
<a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>" class="image">
<div class="name"><?= $fetch_products['name']; ?></div>
<div class="flex">
<div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
<input type="number" name="qty" class="qty" min="1" max="99" value="1"
onkeypress="if(this.value.length == 2) return false;">
</div>
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
</form>
<?php
}
}else{
echo '<p class="empty">no products added yet</p>';
}

?>

</div>

</section>

<?php include 'footer.php';?>

</body>
</html>