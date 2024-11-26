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
        <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
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
background-size:200% 200%;
width:100vw;
animation: gradient 25s ease infinite;
}


.logo{
color:white;
display:flex;
justify-content:center;
align-items:center;
font-size:5vw;
padding:15px;
}

header{
display:flex;
justify-content:center;
align-items:center;
background:black;
width:50vw;
height:10vh;
border:1px solid white;
border-radius:20px;
box-shadow:0 2px 5px 0 white;
transition:0.8s;
}

header:hover{
box-shadow:0 5px 10px 0 white;
}


header .menu a:hover{
color:white;
}

.menu a{
color:white;
text-decoration:none;
font-size:25px;
padding:0px 2vw;
transition:0.2s;
position:relative;
top:0px;
}

.menu a:hover{
position:relative;
top:-5px;

}

.user{
position:absolute;
right:5vw;
color:white;
}

.user_name{
position:absolute;
right:3vw;
top:50px;
color:white;
font-size:25px;
}

.u_menu{
position:absolute;
top:50px;
right:25px;
display:none;
background:white;
border:1px solid black;
border-radius:20px;
width:200px;
height:100px;
}

.u_menu p{
width:200px;
font-size:25px;
color:black;
}

.u_menu a{
font-size:25px;
  text-decoration:none;
  display:flex;
  justify-content:center;
  align-items:center;
  color:black;
  transition:0.5s;
}

.u_menu a:hover{
box-shadow:0 0px 10px 0px black;
}



.profile{
position:absolute;
top:75px;
right:75px;
display:none;
background:white;
border:1px solid black;
border-radius:20px;
width:200px;
height:150px;
}


.profile a{
font-size:25px;
  text-decoration:none;
  display:flex;
  justify-content:center;
  align-items:center;
  color:black;
  transition:0.5s;
}

.profile a:hover{
box-shadow:0 0px 10px 0px black;
}

.lightup{
position:absolute;
left:5vw;
color:white;
}

.lightMode{
background:linear-gradient(-150deg, #ffffff,#c2c2c2,#999999,#757575);
background-repeat:no-repeat;
background-size:200% 200%;
width:100vw;
animation: gradient 25s ease infinite;
}

.lightMode .user_name{
color:black;
}

.lightMode .user i{
color:black;
}

.lightMode .lightup i{
color:black;
}

.lightMode h1{
color:black;
}

.lightMode main a{
color:black;
}

.lightMode main h1{
color:black;
}

.lightMode .empty{
color:black;
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
background:white;
border-radius:20px;
}

.box-orders .box p span{
   color:#00aaff;
}

.box p{
   border-bottom:1px solid black;
}

.empty{
color:white;
}
</style>
<body>

<h1 class="logo">Orders</h1>

<div class="user" id="user-btn"><i class="fa-solid fa-user" style="font-size:35px;"></i></div>
<div class="lightup" id="lightMode"><i class="fa-regular fa-lightbulb" style="font-size:35px;"></i></div>

<?php

$count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
$count_wishlist_items->execute([$user_id]);
$total_wishlist_items = $count_wishlist_items->rowCount();

$count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$count_cart_items->execute([$user_id]);
$total_cart_items = $count_cart_items->rowCount();

?>
<div class="user_name">
          <?php
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
if($select_profile->rowCount() > 0){
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

?>
<p><?= $fetch_profile['name']; ?></p>
      </div>

<div class="profile" id="user_menu">
<a href="update_user.php" class="update-btn">update profile</a>
<div class="flex-btn">
<a href="user_login.php" class="option-btn">login</a>
<a href="user_register.php" class="option-btn">register</a>
</div>
<a href="user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
<?php

}else{

?>
<div class="u_menu"  id="menu">
<p>please login first</p>
<a href="user_login.php" class="option-btn">login</a>
<a href="user_register.php" class="option-btn">register</a>
</div>
<?php
}
?>
</div>
<header>
<div class="menu">
    <a href="shop.php?category">Товары</a>
    <a href="contact.php">Обратная связь</a>
    <a href="about.php">О нас</a>
    <a href="orders.php">Заказы</a>
</div>
</header>

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


<script>
  document.getElementById('user-btn').addEventListener('click', function() {
  var menu = document.getElementById('menu');
  if (menu.style.display === 'block') {
    menu.style.display = 'none';
  } else {
    menu.style.display = 'block';
  }
  });
</script>
<script>
  document.getElementById('user-btn').addEventListener('click', function() {
  var menu = document.getElementById('user_menu');
  if (menu.style.display === 'block') {
    menu.style.display = 'none';
  } else {
    menu.style.display = 'block';
  }
  });
</script>

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