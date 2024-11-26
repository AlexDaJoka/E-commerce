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

.Back{
text-decoration:none;
font-size:30px;
color:white;
position:absolute;
left:100px;
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
z-index:1;
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
background-size:500% 500%;
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

.lightMode .Back{
color:black;
}

.lightMode .quick-view{
color:black;
}




.quick-view{
color:white;
display:flex;
align-items:center;
justify-content:center;
padding:50px;
}

.slide{

}

.main-image{
    display:flex;
    align-items:center;
    justify-content:space-around;
    position:absolute;
    left:30px;

}

.big-image img{
margin:0px 20px;
width:40vw;
height:80vh;
}


.small-images img{
display:flex;
flex-direction:column;
margin:20px 0px;
width:100px;
border:1px solid black;
height:100px;
}

.content{
display:flex;
flex-direction:column;
position:absolute;
right:20px;
top:140px;
line-height:2em;
}

.name{
display:flex;
align-items:center;
justify-content:center;
 font-size:35px;
 border-bottom:1px solid black;
}

.flex{
display:flex;
justify-content:space-around;
}

.price{
font-size:25px;
}

.details{
font-size:30px;
    margin:20px 0px;
    width:40vw;
    border:1px solid black;
    height:40vh;
overflow-wrap: break-word;
overflow-y:scroll;
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
</style>
<body>
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


    <a class="Back" href="shop.php?category">Назад</a>
<main>
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

<div class="details"><?= $fetch_products['details']; ?></div>


<div class="flex">
<div class="price"><span><?= $fetch_products['price']; ?></span>P</div>
<input type="number" name="qty" class="qty" min="1" max="99" value="1"
onkeypress="if(this.value.length == 2) return false;">

<div class="flex-btn">
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
<input type="submit" value="add to wishlist" name="add_to_wishlist" class="btn">
</div>
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

</main>
</body>

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

</html>