<?php
include('connect.php');

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
</head>
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background: linear-gradient(to right, #ed213a, #93291e);
}

#Home{
color:red;
}

.menu{
width:250px;
position:absolute;
top:100px;
right:25px;
background:white;
transition:2s;
display:none;
border:2px solid black;
}


.menu a{
  display:flex;
  align-items:center;
  justify-content: center;  
  text-decoration: none;
  color:black;
  font-size:20px;
  transition:0.5s;
}


.user_info{
    padding:20px;
    font-size:17px;
}

.Account_menu{
    position:absolute;
    left:-250px;
    top: 70px;
    background:white;
    color:black;
    height:100%;
    width:200px;
    transition:0.6s;
    border:1px solid black;
}

.Account_menu.open{
    left:0px;
}

.Account_menu h2{
    display:flex;
  align-items:center;
  justify-content: center;  
  flex-direction: column;
  padding:20px;
}


.Account_menu a{
    display:flex;
  align-items:center;
  justify-content: center;  
  flex-direction: column;
  line-height:2em;
  font-size:17px;
  text-decoration: none;
  color:black;
  transition:0.6s;
  background:none;
  border-radius:none;
  width:200px;
  position:relative;
  left:0px;
}


.Account_menu a:hover{
    background: linear-gradient(to right, #fc4a1a, #f7b733);
font-size:20px;
position:relative;
  left:20px;
border-radius:20px;
width:300px;
}

#menu_open{
    width:150px;
    height:50px;
    font-size:17px;
    display:flex;
    align-items: center;
    justify-content: center;
    background:#ff5757;
    color:white;
    border-radius: 20px;
    border:1px solid #b30000;
    margin:0px 0px;
    transition:0.5s;
    box-shadow: 0 5px 0px 0px #b30000;
}

#menu_open:hover{
    box-shadow: 0 0px 0px 0px #b30000;
}




main{
display:flex;
align-items:center;
justify-content: center;
flex-wrap:wrap;
width:100vw;
}


body h1{
display:flex;
align-items:center;
justify-content: center;  
color:white;
}

.box{
    background: white;
    border:1px solid black;
    width:300px;
    height:400px;
    border-radius: 20px;
    overflow:hidden;
    display:flex;
align-items: center;
justify-content: center;
flex-direction: column;
margin:20px;
padding:20px;
box-shadow: 0 5px 10px 0px red;
}

.info{
    display:flex;
align-items: center;
justify-content: center;
flex-direction: column;
font-size:20px;

}

.info h2{
    padding:20px;
}


.info a{
height:30px;

}
.info a span{
font-size: 25px;
color:green;
}

.box img{
    display:flex;
    width:300px;
    height:230px;
    border:1px solid black;
}

.edit{
    position:relative;
    top:-10px;
    right:-115px;
font-size:20px;
cursor:pointer;
}

</style>
<body>

<div class="menu">

<?php
if(isset($_SESSION['username'])){
echo $_SESSION['username'];
}

?>

<a href="login.php">login</a>
<a href="register.php">register</a>

<?php
if(isset($_SESSION['username'])){
echo"<a href='user-change.php'>update user</a>";

echo"<a href='logout.php'>logout</a>";
}

?>

</div>

<?php
include("header.php");
?>


<?php

if(isset($_SESSION["username"])){

?>

<button id="menu_open">Menu</button>

<div class="Account_menu">

<div class="user_info">
<h2>User info</h2>

<p><i class="fa-solid fa-user" style="color: #ffa200";></i><?php echo $_SESSION["username"]; ?></p><br>
<p><i class="fa-solid fa-envelope" style="color: #ffa200;"></i><?php echo $_SESSION["email"]; ?></p><br>
<p><i class="fa-solid fa-phone" style="color: #ffa200;"></i><?php echo $_SESSION["phone_number"]; ?></p><br>

</div>
<h2>User panel</h2>

<a href="Create_product.php">Create product</a>
<a href="View_products.php">Your products</a>
<a href="All_messages.php">Messages</a>
<a href="View_orders.php">Orders</a>

</div>


<h1>Your products</h1>
<main>
<?php

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM products
WHERE product_user_id = '$user_id'
;";

$result = mysqli_query($conn, $sql);

$product_row = mysqli_fetch_assoc($result);

foreach($result as $value){

    
    $_SESSION['product_user_id'] = $value['product_user_id'];
    $_SESSION['product_id'] = $value['product_id'];
    $_SESSION['product_name'] = $value['product_name'];
    $_SESSION['price'] = $value['price'];
    $_SESSION['description'] = $value['description'];
    $_SESSION['product_img1'] = $value['product_img1'];
    $_SESSION['product_img2'] = $value['product_img2'];
    $_SESSION['product_img3'] = $value['product_img3'];
    $_SESSION['categories'] = $value['categories'];
    $_SESSION['amount'] = $value['amount'];

?>




<form action="" method="post" class="box">

<div class="edit">
<a href="Product_edit.php?update=<?= $_SESSION['product_id']; ?>"><i class="fa-regular fa-pen-to-square"></i></a>


<a href="Product_delete.php?delete=<?= $_SESSION['product_id']; ?>" onclick="return confirm('delete this product');"><i class="fa-solid fa-trash" style="color:red;"></i></a>
</div>

<a href="view.php?product=<?= $value['product_id']; ?>">
<img src="product_img/<?php echo $_SESSION['product_img1'] ?>">
</a>

<div class="info">

<h2><?php echo $_SESSION['product_name']; ?></h2>

<a>Price:<span><?php echo $_SESSION['price']; ?></span>P</a>

<p>Category:<?php echo $_SESSION['categories']; ?> </p>

<p>Amount:<?php echo $_SESSION["amount"]; ?> </p>

</div>


</form>

<?php
}
}else{
    echo"login first to see your account";
}

?>

</main>


    
</body>

<script>

const menu = document.querySelector(".Account_menu");

const menu_open = document.getElementById("menu_open");

let isOpen = false;

menu_open.onclick = function(){

if(!isOpen){
    menu.classList.add('open');
    isOpen = true;
    menu_open.style.margin = "0px 200px";
}else{
    menu.classList.remove('open')
    isOpen = false;
    menu_open.style.margin = "0px 0px";
}

}






</script>


<script>

const user_menu = document.querySelector(".menu");


function user(){

if(user_menu.style.display === "block"){
    user_menu.style.display = "none";
}else{
    user_menu.style.display = "block";
}

};


</script>

</html>