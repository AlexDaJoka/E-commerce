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

#Products{
color:red;
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


.user_info{
    padding:20px;
    font-size:17px;
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


form{
    background:white; 
  width:100vw;
  padding:20px;
}

form input{
    height:25px;
    width:250px;
    border-radius: 20px;
    padding:20px;
    line-height: 2em;
}

form textarea{
    width:500px;
    height:300px;
    resize: none;

}

form button{
    width:250px;
    height:50px;
    font-size:17px;
    display:flex;
    align-items: center;
    justify-content: center;
    background:#ff5757;
    color:white;
    border-radius: 20px;
    border:1px solid #b30000;
    margin:50px 0px;
    transition:0.5s;
    box-shadow: 0 5px 0px 0px #b30000;
}

form button:hover{
    box-shadow: 0 0px 0px 0px #b30000;  
}



main{

display:flex;
align-items:center;
justify-content: center;  
flex-direction: column;

}

main h1{
color:white;
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

.Slider{
overflow: hidden;
height:300px;
width:450px;
border:1px solid black;
}

.Slider img{
width:450px;
height:300px;
transition:1s;
}

.right{

    display:none;

}

.files input{
    display: flex;
flex-direction: column;
}

.Right-i{
    display: flex;
    align-items: flex-start;
    justify-content:center;
flex-direction: column;
position:absolute;
width:500px;
top:170px;
right:180px;
}


.Right-i h1{
    color:black;
}

.Right-i h3 input{
    margin:0px 30px;
}

.errows{
    display:flex;
    font-size:20px;
    padding:20px;
}

</style>
<body>

<?php
include("header.php");
?>



<?php

error_reporting(0);

$product_id = $_GET['product'];

$sql = "SELECT * FROM products
WHERE product_id = $product_id
;";

$result = mysqli_query($conn, $sql);

$product_row = mysqli_fetch_assoc($result);

$_SESSION['product_user_id'] = $product_row['product_user_id'];
$_SESSION['product_id'] = $product_row['product_id'];
$_SESSION['product_name'] = $product_row['product_name'];
$_SESSION['price'] = $product_row['price'];
$_SESSION['description'] = $product_row['description'];
$_SESSION['product_img1'] = $product_row['product_img1'];
$_SESSION['product_img2'] = $product_row['product_img2'];
$_SESSION['product_img3'] = $product_row['product_img3'];
$_SESSION['categories'] = $product_row['categories'];
$_SESSION['amount'] = $product_row['amount'];

?>


<form action="">

<div class="Slider">
<img src="product_img/<?php echo $_SESSION['product_img1']; ?>">
<img src="product_img/<?php echo $_SESSION['product_img2']; ?>">
<img src="product_img/<?php echo $_SESSION['product_img3']; ?>">
</div>

<div class="errows">
<i id="left" class="fa-solid fa-arrow-left-long"></i>
<i id="right" class="fa-solid fa-arrow-right-long"></i>
</div>


<div class="Right-i">
<h1>Product name: <?php echo $_SESSION['product_name']; ?></h1>

<h1>Description: <?php echo $_SESSION['description']; ?></h1>



<h3>Category:<?php echo $_SESSION['categories']; ?></h3>

<h3>Amount: <?php echo $_SESSION['amount'];?></h3>

<h3>Price: <?php echo $_SESSION['price']; ?></h3>
</div>

<?php  
if($_SESSION['product_user_id'] == $_SESSION['user_id']){
echo "You can't create order to your own product";
}elseif(!isset($_SESSION['user_id'])){
    echo "You can't create order or send message while you are not registered";
}else{
?>

<a href="Create_order.php?order_id=<?php echo $_SESSION["product_id"]; ?>">Create order</a>
<a href="Messages.php?message_to=<?php echo $_SESSION["product_user_id"] ?>">Send message</a>

<?php
}
?>

</form>


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
    //Slider

const img =document.querySelectorAll('img');
const left = document.getElementById('left');
const right = document.getElementById('right');

i = 0;

right.addEventListener("click", function(){

    if(i < 2){

        while(i < 2){
    img[i].classList.add('right');
    i++
    break;
    }

    }else{
    while(i > 0){
    i--;
    img[i].classList.remove('right');
    }

    }

})


left.addEventListener("click", function(){

    if(i > 0){

        while(i > 0){
        i--;
        img[i].classList.remove('right');
        break;
        }
    }else{
        for(i = 0; i != 2; i++){
            img[i].classList.add('right');  
        }
    }

})


</script>











<script>
//Account_menu
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
    //error message
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
    //corect message
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
//menu
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