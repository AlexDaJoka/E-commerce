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

#Orders{
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

main{
    display:flex;
align-items: center;
justify-content: center;
flex-wrap:wrap;
}

.box{
    background:white;
    border:1px solid black;
    width:350px;
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


</style>
<body>



<main>

<?php
include("header.php");
?>

<?php 

if(isset($_SESSION['username'])){


$username = $_SESSION['username'];

$sql = "SELECT * FROM orders
WHERE username = '$username';";


$res  = mysqli_query($conn, $sql);


foreach($res as $value){


?>









<form class="box">


<div class="info">

<h3><?php echo $value['order_product_name'];?></h3>
<h3><?php echo $value['order_time'];?></h3>
<p><?php echo $value['order_price'];?></p>
<p><?php echo $value['order_amount'];?></p>
<p><?php echo $value['order_payment_method'];?></p>
<p><?php echo $value['order_deliver_method'];?></p>
<p><?php echo $value['order_city'];?></p>
<p><?php echo $value['order_adress'];?></p>
<p><?php echo $value['order_complete'];?></p>


<a href="Order_delete.php?delete=<?= $value['order_id']; ?>" onclick="return confirm('delete this order?');" style="color:red;">Cancel order</a>
</div>


</form>









<?php
}}else{
    echo "Login first to see a your orders";
}
?>

</main>  
</body>
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