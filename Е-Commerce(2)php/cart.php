<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
}else{
$user_id = '';
header('location:user_login.php');
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
        <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
</head>
<style>
*{
    padding:0;
    margin:0;
    box-sizing:border-box;
}

body{
display:flex;
justify-content:top;
align-items:center;
flex-direction:column;
padding:20px;
background:linear-gradient(-150deg, #000000,#242424,#303030,#454545);
background-repeat:no-repeat;
background-size:500% 500%;
width:100vw;
animation: gradient 25s ease infinite;
}


.lightMode{
background:linear-gradient(-150deg, #ffffff,#c2c2c2,#999999,#757575);
background-repeat:no-repeat;
background-size:500% 500%;
width:100vw;
animation: gradient 25s ease infinite;
}

.lightMode .empty{
color:black;
}

.lightMode .wishlist h1{
color:black;
}



.empty{
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
    right:100px;
    color:white;
}


.wishlist{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    padding:50px;
}

.wishlist h1{
    color:white;
}

.box-container{
    display:flex;
    flex-wrap:wrap;
    position:relative;
    right:-100px;
}

.box-container form{
    display:flex;
    text-align:center;
    justify-content:center;
    margin:15px 10px;
    border:2px solid black;
    width:21vw;
    height:60vh;
    flex-wrap:wrap;
    background:white;
    border-radius:20px;
}

.box-container form img{
    display:flex;
    align-items:center;
    justify-content:center;
    width:20vw;
    height:30vh;
    border-radius:20px;
}

.box-container form .name{
    display:flex;
    justify-content:center;
    width:400px;
    font-size:30px;
    border-top:1px solid black;
}

.box-container form button{
    width:30px;
    height:30px;
    position:relative;
    right:-9vw;
    border-radius:20px;
    border:none;
    font-size:20px;
    background:white;
    color:red;
    position:relative;
    left:0px;
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
    font-size:25px;
}

.qty{
    border:1px solid black;
    font-size:17px;
    width:35px;
    height:35px;

}

.delete-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    width:100vw;
    height:50px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.2s;
    font-size:20px;
    border-radius:10px;
    background:red;
    color:white;
}
.delete-btn:hover{
 font-size:22px;
}


.wishlist-total{
    position:absolute;
    top:110px;
    left:20px;
    height:100px;
    width:200px;
    z-index:1;
border:1px solid black;

background:white;
}

.wishlist-total a{
    display:flex;
    align-items:center;
    justify-content:center;
text-decoration:none;
color:black;
font-size:20px;
}


</style>
<body>

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
<a href="quick_view.php?pid=<?= $fetch_cart['pid'];?>">
<img src="uploaded_img/<?= $fetch_cart['image'];?>" class="image">
</a>
<div class="name"><?= $fetch_cart['name'];?></div>
<div class="flex">
<div class="price"><span><?= $fetch_cart['price'];?></span>P</div>
<input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity'];?>"
onkeypress="if(this.value.length == 2) return false;">

<button type="submit" class="fas fa-edit" name="update_qty"></button>
</div>

<div class="sub-total">sub total :
<span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);?>P</span>
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
<a href="shop.php?category" class="btn-continue">continue shopping</a>
<a href="cart.php?delete_all" class="delete-btn-all <?= ($grand_total > 1)?'':'disabled';?>" onclick="return confirm('delete all from cart ');">delete all</a>
<a href="checkout.php" class="btn-checkout <?= ($grand_total > 1)?'':'disabled';?>">proceed to checkout</a>
</div>

</section>

<script>
// Получаем кнопку переключения темы и текущую тему из localStorage
const themeToggle = document.getElementById('lightMode');
const currentTheme = localStorage.getItem('theme');
// Если текущая тема существует в localStorage, применяем её на страницу
if (currentTheme) {
    document.body.classList.add(currentTheme);
}
// Обработчик события клика на кнопку переключения темы
themeToggle.addEventListener('click', () => {
    // Проверяем, есть ли у body класс dark-theme
    const isDarkTheme = document.body.classList.contains('lightMode');

    // Если текущая тема - светлая, переключаем на тёмную и сохраняем в localStorage
    if (!isDarkTheme) {
        document.body.classList.add('lightMode');
        localStorage.setItem('theme', 'lightMode');
    }
    // Если текущая тема - тёмная, переключаем на светлую и сохраняем в localStorage
    else{
        document.body.classList.remove('lightMode');
        localStorage.setItem('theme', '');
    }
});
</script>
</body>
</html>