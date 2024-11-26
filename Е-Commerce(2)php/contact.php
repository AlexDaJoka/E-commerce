<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
}else{
$user_id = '';
};

if(isset($_POST['send'])){

$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$number = $_POST['number'];
$number = filter_var($number, FILTER_SANITIZE_STRING);
$msg = $_POST['msg'];
$msg = filter_var($msg, FILTER_SANITIZE_STRING);

$select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");

$select_message->execute([$name, $email, $number, $msg]);

if($select_message->rowCount() > 0){
$message[] = 'message sent already';
}else{
    $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
    $insert_message->execute([$user_id, $name, $email, $number, $msg]);

    $message[] = 'sent message successfully!';
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
    <title>contact</title>
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

.lightMode .empty{
color:black;
}


.form-container{
padding:50px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
}

.form-container h1{
color:white;
font-size:30px;

}

.form-container form{
background:white;
    width:40vw;
    border:1px solid #0062e3;
    box-shadow:0px 10px 0px 5px #0062e3;
    border-radius:20px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    transition:0.5s;
}

.form-container form:hover{
    box-shadow:0px 5px 0px 2px #0062e3;
}

.form-container form input{
    font-size:20px;
    width:400px;
    margin:10px 0px;
    height:50px;
}

textarea{
    resize:none;
    min-width:400px;
    font-size:20px;
}

.btn{
    width:200px;
    height:50px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
    background:#0062e3;
    border-radius:10px;
    color:white;
}
.btn:hover{
    box-shadow:0 0 10px 0 black;

}

.empty{
color:white;
}
</style>
<body>
<h1 class="logo">Обратная связь</h1>

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
    <a href="home.php">Главная</a>
    <a href="shop.php?category">Товары</a>
    <a href="about.php">О нас</a>
    <a href="orders.php">Заказы</a>
</div>
</header>
<main>
<section class="form-container">

<?php
      if($user_id == ''){
         echo '<p class="empty">please login first</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `messages` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
   ?>

<h1>contact us</h1>
<form method="post" action="" class="box">


<input type="text" name="name" required placeholder="enter your name" maxlength="20" class="box" >

<input type="number" name="number" required placeholder="enter your number"
maxlength="99999999999" min="0" class="box" onkeypress="if(this.value.length == 10) return false;">

<input type="email" name="email" required placeholder="enter your email" maxlength="50" class="box" >
<textarea name="msg" cols="30" rows="10" required class="box" placeholder="enter your massage"></textarea>

<input type="submit" value="send message" class="btn" name="send">

</form>

<?php

}
?>

</section>
</main>
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