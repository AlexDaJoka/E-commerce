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
    <title>Home page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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
background-size:200% 200%;
width:100vw;
animation: gradient 25s ease infinite;
}


@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
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

.lightMode .description h1{
border-bottom:1px solid black;
}

.lightMode .reviews h1{
border-bottom:1px solid black;
}




main{
width:100vw;
}

.Welcome{
display:flex;
justify-content:center;
align-items:center;
font-size:37px;
color:white;
padding:50px;
}


    .swiper {
    border:1px solid white;
    border-radius:20px;
    width:65vw;
    height:55vh;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img{
    display:flex;
    width:100%;
    height:100%;
    object-fit: cover;
    }

.description{
position:relative;
top:100px;
height:500px;
}

.description h1{
color:white;
position:absolute;
border-bottom:1px solid white;
left:15vw;
}

.description a{
position:relative;
left:12vw;
top:40px;
color:white;
display:flex;
width:35vw;
}

.description img{
position:absolute;
right:12vw;
top:40px;
width:40vw;
height:40vh;
border-radius:30px;
transition:1s;
}

.description img:hover{
width:42vw;
height:42vh;
}

.reviews{
position:relative;
top:300px;
height:400px;
}

.reviews h1{
color:white;
position:absolute;
border-bottom:1px solid white;
right:30vw;
}

.reviews .reviewImg1{
position:absolute;
left:5vw;
top:40px;
width:30vw;
height:30vh;
border-radius:30px;
transition:1s;
}

.reviews .reviewImg2{
position:absolute;
left:12vw;
top:125px;
width:30vw;
height:30vh;
border-radius:30px;
transition:1s;
}

.reviews .reviewImg1:hover{
top:-50px;
}

.reviews .reviewImg2:hover{
top:-50px;
}

.reviews a{
position:relative;
right:-50vw;
top:40px;
color:white;
display:flex;
width:30vw;
}


.orders{
padding:0px 20px;
position:relative;
height:500px;
top:400px;
}

.orders h1{
color:white;
display:flex;
alight-items:center;
justify-content:center;
padding:20px;
}

.orders .orderIMG{
display:flex;
alight-items:center;
justify-content:center;
}

.orders .orderIMG img{
top:125px;
width:20vw;
height:30vh;
margin:0px 10px;
flex-wrap:wrap;
border-radius:10px;
}

.newGoods{
height:500px;
position:relative;
top:400px;
}

.newGoods h1{
color:white;
display:flex;
alight-items:center;
justify-content:center;
padding:20px;
}

.slide{
width:25vw;
display:flex;
justify-content:center;
alight-items:center;
flex-wrap:wrap;
}

.newGoods h1{
    display:flex;
    align-items:center;
    justify-content:center;
}

.newGoods{
    display:flex;
    text-align:center;
    justify-content:center;
    flex-wrap:wrap;
    width:100vw;
}

.newGoods form{
    display:flex;
    text-align:center;
    justify-content:center;
    margin:15px 10px;
    border:2px solid black;
    width:25vw;
    height:50vh;
    flex-wrap:wrap;
    background:white;
    border-radius:20px;
}

.newGoods form img{
    display:flex;
    align-items:center;
    justify-content:center;
    width:24vw;
    height:35vh;
}

.newGoods form .name{
    display:flex;
    justify-content:center;
    width:400px;
    font-size:30px;
    border-top:1px solid black;
}

.newGoods form button{
    width:30px;
    height:30px;
    position:relative;
    right:-10vw;
    border-radius:20px;
    border:none;
    font-size:20px;
    background:white;
    color:red;
}
.newGoods form a{
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


</style>
<body>
<h1 class="logo">E-Commerce</h1>

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
<main>
    <h1 class="Welcome">Welcome to E-Commerce</h1>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="https://swiperjs.com/demos/images/nature-4.jpg"></div>
      <div class="swiper-slide"><img src="https://swiperjs.com/demos/images/nature-3.jpg"></div>
      <div class="swiper-slide">Slide 3</div>
      <div class="swiper-slide">Slide 4</div>
      <div class="swiper-slide">Slide 5</div>
      <div class="swiper-slide">Slide 6</div>
      <div class="swiper-slide">Slide 7</div>
      <div class="swiper-slide">Slide 8</div>
      <div class="swiper-slide">Slide 9</div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
    <section class="description">
        <h1>We always have something!</h1>
        <a>Ту́рция (тур. Türkiye [ˈtyr̝cije]), официально — Туре́цкая Респу́блика (тур. Türkiye Cumhuriyeti [ˈtyr̝cije d͡ʒumhuːɾije'ti]) — государство в Западной Азии (97 %) и в Южной Европе (3 %). Население — 85,2 млн чел. (2023), площадь территории — 783 562 км² (занимает 19-е место в мире по численности населения и 36-е по территории). Унитарное государство. Государственный язык — турецкий.

Турция граничит с 14 государствамиПерейти к разделу «#Границы».

Современная Турция образовалась в 1923 году в результате распада Османской империи после её поражения в Первой мировой войне и последовавшей национально-освободительной войны турецкого народа, упразднения монархии и создания на территории восточной Фракии, Малой Азии и Армянского нагорья турецкого национального государства. Прежде чем стать центром Османской империи, этот регион на протяжении истории составлял значительную часть древних государств: Хеттского царства, Ассирии, Урарту, Византии, Грузии (Колхиды и Иберии), Персии, Рима и так далее.

Индустриальная страна с динамично развивающейся экономикой. Объём ВВП по паритету покупательной способности (ППС) на душу населения — 41 887 доллара в год (2023). В 2023 году ВВП Турции по номиналу составил 1,154 трлн долл.; ВВП по ППС — 3,613 трлн долл.; объём ВВП по номиналу на душу населения — 13 383 доллара в год.</a>
        <img src="https://swiperjs.com/demos/images/nature-3.jpg">
    </section>
    <section class="reviews">
        <h1>Good reviews</h1>
        <a>
О́тзыв — чужое мнение о товаре или услуге, искреннее или купленное. В наше время используется как инструмент маркетинга.
О́тзыв — условный секретный ответ на пароль (пропуск) в войсках[1].
О́тзыв на исковое заявление (в юриспруденции) — документ в письменной форме, направляемый или представляемый ответчиком в арбитражный суд и лицам, участвующим в деле, с указанием возражений относительно предъявленных к нему требований истца по каждому доводу, содержащемуся в исковом заявлении, со ссылкой на законы и иные нормативные правовые акты, а также на доказательства, обосновывающие возражения.</a>
        <img class="reviewImg1" src="https://swiperjs.com/demos/images/nature-6.jpg">
        <img class="reviewImg2" src="https://swiperjs.com/demos/images/nature-5.jpg">
    </section>

    <section class="orders">
        <h1>Over 10000+ orders</h1>
        <div class="orderIMG">
            <img class="orderIMG1" src="https://swiperjs.com/demos/images/nature-1.jpg">
            <img class="orderIMG2" src="https://swiperjs.com/demos/images/nature-1.jpg">
            <img class="orderIMG3" src="https://swiperjs.com/demos/images/nature-1.jpg">
        </div>
    </section>
        <section class="newGoods">
<?php

$select_products = $conn->prepare("SELECT * FROM `products` LIMIT 3");
$select_products->execute();
if($select_products->rowCount() > 0){
while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

?>
<form action="" method="post" class="slide">

<input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
<input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
<input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
<input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">

<a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="">
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>" class="image">
</a>
<div class="name"><?= $fetch_products['name']; ?></div>
<div class="flex">
<div class="price"><span><?= $fetch_products['price']; ?></span>P</div>
</div>
</form>

<?php
}
}else{
echo '<p class="empty">no products added yet</p>';
}

?>
    </section>
</main>

<footer>

</footer>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

<script>
    $("body").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");
  $("html, body").animate({ scrollTop: $(href).offset().top }, 500);
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



<script>
Splitting();
ScrollOut({
   targets: '[data-splitting]'
});
</script>

</body>
</html>