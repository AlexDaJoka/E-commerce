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
    <title>quick view</title>
</head>
<style>
*{
    padding:0;
    margin:0;
    box-sizing:border-box;
}

.quick-view{
display:flex;
align-items:center;
justify-content:center;
padding:50px;
}

.slide{
    border:1px solid black;
}

.main-image{
    display:flex;
    padding:25px;
    justify-content:space-around;
}

.big-image img{
    margin:0px 20px;
width:200px;
height:200px;
}

.small-images img{
margin:0px 20px;
width:100px;
height:100px;
}

.content{
display:flex;
align-items:center;
justify-content:center;
flex-direction:column;
flex-wrap:wrap;
line-height:2em;
}

.name{
    font-size:25px;
}

.flex{
}

.price{
}

.details{
font-size:30px;
    border:1px solid black;
    margin:50px 0px;
    width:300px;
    height:200px;
}

.qty{
    border:1px solid black;
    font-size:20px;
    width:50px;
    height:50px;
}

.btn{
    width:200px;
    height:50px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
}
.btn:hover{
    box-shadow:0 0 10px 0 black;

}

.option-btn{

    width:200px;
    height:50px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
}
.option-btn:hover{
    box-shadow:0 0 10px 0 black;

}
</style>
<body>

<?php
include 'user_header.php';
?>

<section class="quick-view">

<?php
$pid = $_GET['pid'];
$select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
$select_products->execute([$pid]);
if($select_products->rowCount() > 0){
while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

?>
<form action="" method="post" class="slide">

<input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
<input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
<input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
<input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">

<div class="main-image">

<div class="big-image">

<img src="uploaded_img/<?= $fetch_products['image_01']; ?>">

</div>

<div class="small-images">
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>">
<img src="uploaded_img/<?= $fetch_products['image_02']; ?>">
<img src="uploaded_img/<?= $fetch_products['image_03']; ?>">
</div>

</div>

<div class="content">

<div class="name"><?= $fetch_products['name']; ?></div>

<div class="flex">

<div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>

<input type="number" name="qty" class="qty" min="1" max="99" value="1"
onkeypress="if(this.value.length == 2) return false;">
</div>

<div class="details"><?= $fetch_products['details']; ?></div>

<div class="flex-btn">
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
<input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
</div>

</div>

</form>
<?php
}
}else{
echo '<p class="empty">no products found</p>';
}

?>

</section>

<?php include 'footer.php';?>

<script>
subImages = document.querySelectorAll('.quick-view .main-image .small-images img');
mainImage = document.querySelector('.quick-view .main-image .big-image img');

subImages.forEach(images =>{
images.onclick = () =>{
let src = images.getAttribute('src');
mainImage.src = src;
}
});
</script>

</body>
</html>