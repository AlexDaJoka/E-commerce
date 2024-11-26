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
    <title>home</title>
</head>
<style>
*{
    padding:0;
    margin:0;
    box-sizing:border-box;
}

body{
    background:#b02873;
}

.home{
    display:flex;
    align-items:center;
    justify-content:center;
}

.slide{
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
}
.slide a{
text-decoration:none;
color:green;
font-size:30px;
}

.image img{
    width:200px;
    height:200px;
}

.category-slider{
display:flex;
    align-items:center;
    justify-content:center;
flex-wrap:wrap;
 width:100vw;
}

.home-category{

}

.home-category h1{
    display:flex;
    align-items:center;
    justify-content:center;
}

.w{
 display:flex;
 flex-wrap:wrap;
}

.w img{
    width:200px;
    height:200px;
}
.w h3{
    display:flex;
    text-align:center;
    justify-content:center;
}



.home-products{

}

.home-products h1{
    display:flex;
    text-align:center;
    justify-content:center;
}

.products-slider{
    display:flex;
    text-align:center;
    justify-content:center;
}

.w form{
    margin:0px 10px;
    border:2px solid black;
    width:400px;
    height:400px;
    flex-wrap:wrap;
    background:white;
}

.w form img{
    display:flex;
    align-items:center;
    justify-content:center;
    width:200px;
    height:200px;
}

.w form .name{
    display:flex;
    justify-content:center;
    width:400px;
}

.w form button{
    width:30px;
    height:30px;
    display:flex;
    align-items:center;
    justify-content:center;
}
.w form a{
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

<div class="home-bg">

<section class="home">

<div class="w">

<div class="slide">

<div class="image">
<img src="/uploaded_img/filter.png">
</div>
<div class="content">
<span>upto 50% off</span>
<h3>latest shit</h3>
<a href="shop.php" class="btn">shop now</a>
</div>
</div>

<div class="slide">

<div class="image">
<img src="/uploaded_img/asterisk.png">
</div>
<div class="content">
<span>upto 50% off</span>
<h3>latest shit</h3>
<a href="shop.php" class="btn">shop now</a>
</div>
</div>

<div class="slide">

<div class="image">
<img src="/uploaded_img/facebook.png">
</div>
<div class="content">
<span>upto 50% off</span>
<h3>latest shit</h3>
<a href="shop.php" class="btn">shop now</a>
</div>
</div>

</div>

</section>

</div>

<section class="home-category">

<h1>shop by category<h1>

<div class="category-slider">

<div class="w">

<a href="category.php?category=laptop" class="slide">
<img src="/uploaded_img/asterisk.png">
<h3>laptop</h3>
</a>

<a href="category.php?category=tv" class="slide">
<img src="/uploaded_img/asterisk.png">
<h3>tv</h3>
</a>

<a href="category.php?category=camera" class="slide">
<img src="/uploaded_img/asterisk.png">
<h3>camera</h3>
</a>

<a href="category.php?category=mouse" class="slide">
<img src="/uploaded_img/asterisk.png">
<h3>mouse</h3>
</a>

<a href="category.php?category=fridge" class="slide">
<img src="/uploaded_img/asterisk.png">
<h3>fridge</h3>
</a>

<a href="category.php?category=washing" class="slide">
<img src="/uploaded_img/asterisk.png">
<h3>washing</h3>
</a>

<a href="category.php?category=smartphone" class="slide">
<img src="/uploaded_img/asterisk.png">
<h3>smartphone</h3>
</a>

<a href="category.php?category=watch" class="slide">
<img src="/uploaded_img/asterisk.png">
<h3>watch</h3>
</a>

</div>

</div>

</section>



<section class="home-products">

<h1>latest products</h1>

<div class="products-slider">

<div class="w">

<?php

$select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
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

</div>

</section>


<?php include 'footer.php';?>
</body>
</html>