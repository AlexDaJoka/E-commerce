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
margin: 0;
padding:0;
box-sizing:border-box;
}

body{
    background: linear-gradient(to right, #ed213a, #93291e);
}

#Products{
color:red;
}

body h1{
    display:flex;
align-items: center;
justify-content: center;
color:white;  
margin:30px 0px;
}


.menu{
width:250px;
position:absolute;
right:25px;
top:60px;
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


.error{
background: linear-gradient(to right, #f12711, #f5af19);
color:white;
position:absolute;
width:25vw;
padding:20px;
border-radius: 20px;
display:flex;
align-items: center;
justify-content: center;
top:0;
left:-400px;
transition:1s;
box-shadow:0 5px 10px 0 orange;
text-transform: uppercase;
}

.error i{
    font-size:30px;
    margin:0px 10px;
}

.error.show{
left:0px;
}


.corect{
    background: linear-gradient(to bottom, #ffe000, #799f0c);
color:white;
position:absolute;
width:25vw;
padding:20px;
border-radius: 20px;
display:flex;
align-items: center;
justify-content: center;
top:0;
left:-400px;
transition:1s;
box-shadow:0 5px 10px 0 lime;
text-transform: uppercase;
}

.corect i{
    font-size:30px;
    margin:0px 10px;
}

.corect.show{
left:0px;
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

.info h2{
    padding:30px;
    
}


.info a{
height:50px;
}

.box img{
    display:flex;
    width:300px;
    height:230px;
    word-break: break-all;
    border:1px solid black;
    border-radius:10px;
}

.box img:hover{
}


</style>

<body>

<?php

include('header.php');

?>


<h1>All products</h1>

<main>


<?php


$sql = "SELECT * FROM products;";

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
    
<a href="view.php?product=<?= $value['product_id']; ?>"><img src="product_img/<?php echo $value['product_img1'] ?>"></a>

<div class="info">

<h2><?php echo $value["product_name"]; ?></h2>

<a>Price:<?php echo $value["price"]; ?>P</a>

<p>Category:<?php echo $value["categories"]; ?> </p>


</div>


</form>

<?php
}
?>

</main>











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
   const error = document.querySelector(".error")
   
if(!error){

error.classList.remove('show');

}else{  
error.classList.add('show');
    
if(error.classList.add('show')){

error.classList.add('show'); 

}else{

setTimeout(function(){
error.classList.remove('show'); 
}, 3000)

}

}

</script>



<script>
   const corect = document.querySelector(".corect")
   
if(!corect){

    corect.classList.remove('show');

}else{  
    corect.classList.add('show');
    
if(corect.classList.add('show')){

    corect.classList.add('show'); 

}else{

setTimeout(function(){
    corect.classList.remove('show'); 
}, 3000)

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