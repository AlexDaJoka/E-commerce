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
right:25px;
top:70px;
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

</style>
<body>

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

<main>



</main>





<?php

}else{
    echo"login first to see your account";
}

?>




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