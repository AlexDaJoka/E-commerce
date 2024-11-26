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
    <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
    <title>shop</title>
</head>
<style>

*{
margin:0;
padding:0;
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

.search{
position:absolute;
right:10vw;
color:white;
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
top:25px;
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

.lightMode .icons i{
color:black;
}

.lightMode .search i{
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

.lightMode #categoryMenuOpen{
color:black;
}

.fa-shopping-cart{
text-decoration:none;
position:absolute;
top:20px;
right:180px;
font-size:35px;
color:white;
}
.fa-shopping-cart span{
text-decoration:none;
font-size:20px;
}


.icons .fa-heart{
text-decoration:none;
position:absolute;
top:20px;
right:250px;
font-size:35px;
color:white;
}


.icons .fa-heart span{
text-decoration:none;
font-size:20px;
}

.products{
    display:flex;
    align-items:center;
    justify-content:center;
 flex-wrap:wrap;
 padding:35px;
}

.products h1{
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    padding:100px 0px;
    font-size:40px;
}

.box-container{
    display:flex;
flex-wrap:wrap;
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

.btn{
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
.btn:hover{
 font-size:22px;
}

#categoryMenuOpen{
position:absolute;
left:0px;
margin:-50px 0px;
font-size:40px;
border:none;
background:none;
color:white;
}


.categoryMenu{
position:absolute;
left:-150px;
flex-direction:column;
width:120px;
background:grey;
height:100%;
transition:1s;
}


.categoryMenu a{
text-decoration:none;
line-height:1.5em;
color:white;
font-size:24px;
justify-content:center;
position:relative;
top:0px;
transition:0.4s;
border-bottom:0px solid;
}

.categoryMenu a:hover{
position:relative;
top:-5px;
border-bottom:1px solid;
}

</style>
<body>
<h1 class="logo">Shop</h1>

<div class="icons">
<?php

$count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
$count_wishlist_items->execute([$user_id]);
$total_wishlist_items = $count_wishlist_items->rowCount();

$count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$count_cart_items->execute([$user_id]);
$total_cart_items = $count_cart_items->rowCount();

?>

<a href="wishlist.php"><i class="fas fa-heart"><span>(<?= $total_wishlist_items;?>)</span></i></a>
<a href="cart.php"><i class="fas fa-shopping-cart"><span>(<?= $total_cart_items;?>)</span></i></a>
</div>

<div class="search"><i class="fa-solid fa-magnifying-glass" style="font-size:35px;"></i></div>

<div class="user" id="user-btn"><i class="fa-solid fa-user" style="font-size:35px;"></i></div>
<div class="lightup" id="lightMode"><i class="fa-regular fa-lightbulb" style="font-size:35px;"></i></div>



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
    <a href="home.php">Главная</a>
    <a href="contact.php">Обратная связь</a>
    <a href="about.php">О нас</a>
    <a href="orders.php">Заказы</a>
</div>
</header>
<main>


<section class="products">


<h1>Latest products</h1>


<div class="box-container">

<button id='categoryMenuOpen'><i class="fa-solid fa-bars"></i></button>
<div id='categoryMenu' class="categoryMenu">
<a id="All" href="?category">Все</a>
<a href="?category=Зимняя лопата">hbuobukbj</a>
<a href="?category=Совковая лопата">hbuobukbj</a>
</div>

<?php
$category = $_GET['category'];
$select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$category}%'");
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
<a href="quick_view.php?pid=<?= $fetch_products['id']; ?>">
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>" class="image">
</a>
<div class="name"><?= $fetch_products['name']; ?></div>
<div class="flex">
<div class="price"><span><?= $fetch_products['price']; ?></span>Р</div>
<input type="number" name="qty" class="qty" min="1" max="99" value="1"
onkeypress="if(this.value.length == 2) return false;">
</div>
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
</form>
<?php
}
}else{
echo '<p class="empty">no products found</p>';
}

?>
</div>

</section>
</main>
<script>

</script>

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


<script>
const menuBtn = document.getElementById('categoryMenuOpen');
const menu = document.getElementById('categoryMenu');
menuBtn.addEventListener('click', function() {
  if (menu.style.left === '0px') {
    menu.style.left = '-150px';
  }else{
    menu.style.left = '0px';
  }
});
</script>

</body>
</html>