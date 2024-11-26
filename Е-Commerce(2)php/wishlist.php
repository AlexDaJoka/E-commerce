<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
}else{
$user_id = '';
header('location:user_login.php');
}

include 'wishlist_cart.php';

if(isset($_POST['delete'])){
$wishlist_id = $_POST['wishlist_id'];
$delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
$delete_wishlist->execute([$wishlist_id]);
$message[] = 'wishlist item deleted';
}

if(isset($_GET['delete_all'])){
$delete_all = $_GET['delete_all'];
$delete_all_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
$delete_all_wishlist->execute([$user_id]);
header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>wishlist</title>
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
    right:200px;
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
    right:-200px;
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

<h1>Your wishlist</h1>

<div class="box-container">

<?php
$grand_total = 0;
$select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
$select_wishlist->execute([$user_id]);
if($select_wishlist->rowCount() > 0){
while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
$grand_total += $fetch_wishlist['price'];

?>
<form action="" method="post" class="box">

    <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid'];?>">
    <input type="hidden" name="name" value="<?= $fetch_wishlist['name'];?>">
    <input type="hidden" name="price" value="<?= $fetch_wishlist['price'];?>">
    <input type="hidden" name="image" value="<?= $fetch_wishlist['image'];?>">
    <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id'];?>">

    <a href="quick_view.php?pid=<?= $fetch_wishlist['pid'];?>">
<img src="uploaded_img/<?= $fetch_wishlist['image'];?>" class="image">
</a>
<div class="name"><?= $fetch_wishlist['name'];?></div>
<div class="flex">
<div class="price"><span><?= $fetch_wishlist['price'];?></span>P</div>
<input type="number" name="qty" class="qty" min="1" max="99" value="1"
onkeypress="if(this.value.length == 2) return false;">
</div>
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
<input type="submit" value="delete item" onclick="return confirm('delete this from wishlist ');" name="delete" class="delete-btn"
>
</form>
<?php
}
}else{
echo '<p class="empty">no products added yet</p>';
}
?>
</div>

<div class="wishlist-total">

<div class="grand-total">grand total: <span><?= $grand_total; ?></span>P</div>
<a href="shop.php?category" class="btn">continue shopping</a>
<a href="wishlist.php?delete_all" class="delete-btn-all <?= ($grand_total > 1)?'':'disabled';?>" onclick="return confirm('delete all from wishlist ');">delete all</a>
</div>

</section>


</body>

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