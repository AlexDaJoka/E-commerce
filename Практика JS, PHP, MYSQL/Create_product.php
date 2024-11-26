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


form{
    background:white; 
  width:40vw;
  padding:20px;
  display:flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    border-radius: 20px;
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
    flex-direction: column;
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


.files input{
    display: flex;
flex-direction: column;
}

.Right-i{
    display: flex;
    align-items: center;
    justify-content:center;
flex-direction: column;

}


.Right-i h1{
    color:black;
}

.Right-i h3 input{
    margin:0px 30px;
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
<h2>User panel</h2>

<p><i class="fa-solid fa-user" style="color: #ffa200";></i><?php echo $_SESSION["username"]; ?></p><br>
<p><i class="fa-solid fa-envelope" style="color: #ffa200;"></i><?php echo $_SESSION["email"]; ?></p><br>
<p><i class="fa-solid fa-phone" style="color: #ffa200;"></i><?php echo $_SESSION["phone_number"]; ?></p><br>

</div>
<h2>Your products</h2>

<a href="Create_product.php">Create product</a>
<a href="View_products.php">Your products</a>
<a href="All_messages.php">Messages</a>
<a href="View_orders.php">Orders</a>

</div>

<main>

<h1>Create product</h1>

<form action="" method="post" enctype="multipart/form-data">



<div class="Right-i">
<h1>Product name:</h1>
<input type="text" placeholder="Product name" name="product_name">

<h3>Price:<input type="number" placeholder="Price" name="price"></h3>

<h3>Amount:<input type="number" name="amount"></h3>


<h1>Description</h1><textarea placeholder="Description" name="description"></textarea>



<h3>Category:<select name="categories">
<option value="" disabled selected></option>
<option value="nature">nature</option>
<option value="music">music</option>
<option value="news">news</option>
<option value="travel">travel</option>
<option value="food">food</option>
<option value="comedy">comedy</option>
<option value="animals">animals</option>
<option value="animation">animation</option>
<option value="cars">cars</option>
<option value="sport">sport</option>
</select></h>

<div class="files">
<input type="file" name="img1" accept="image/jpg, image/jpeg, image/png, image/webp">
<input type="file" name="img2" accept="image/jpg, image/jpeg, image/png, image/webp">
<input type="file" name="img3" accept="image/jpg, image/jpeg, image/png, image/webp">
</div>

</div>

<button type="submit" name="create">Create product</button>

</form>


</main>




<?php


}else{
    echo"login first to see your account";
}

?>



<?php

if(isset($_POST["create"])){

    if(
        !empty($_POST['product_name'])
        && !empty($_POST['price'])
        && !empty($_FILES['img1']['name'])
        && !empty($_POST['description'])
        && !empty($_POST['categories'])
        && !empty($_POST['amount'])
        ){


   $product_name = $_POST["product_name"];
   $price = $_POST["price"];
   $description = $_POST["description"];
   $categories = $_POST["categories"];
   $amount = $_POST["amount"];
   $product_user_id = $_SESSION["user_id"];



   $img1 = $_FILES['img1']['name'];
   $img1 = filter_var($img1, FILTER_SANITIZE_STRING);
   $img1_size = $_FILES['img1']['size'];
   $img1_tmp_name = $_FILES['img1']['tmp_name'];
   $img1_folder = 'product_img/'.$img1;

   $img2 = $_FILES['img2']['name'];
   $img2 = filter_var($img2, FILTER_SANITIZE_STRING);
   $img2_size = $_FILES['img2']['size'];
   $img2_tmp_name = $_FILES['img2']['tmp_name'];
   $img2_folder = 'product_img/'.$img2;  

   $img3 = $_FILES['img3']['name'];
   $img3 = filter_var($img3, FILTER_SANITIZE_STRING);
   $img3_size = $_FILES['img3']['size'];
   $img3_tmp_name = $_FILES['img3']['tmp_name'];
   $img3_folder = 'product_img/'.$img3;  

   $sql = "INSERT INTO products (product_name, price, description, product_img1, product_img2, product_img3, categories, amount, product_user_id)
   VALUES('$product_name', '$price', '$description', '$img1', '$img2', '$img3', '$categories', '$amount', '$product_user_id')
   ;";

   if($sql){
    move_uploaded_file($img1_tmp_name, $img1_folder);
    move_uploaded_file($img2_tmp_name, $img2_folder);
    move_uploaded_file($img3_tmp_name, $img3_folder);
   }

$_SESSION["product_name"] = $_POST["product_name"];
$_SESSION["price"] = $_POST["price"];
$_SESSION["description"] = $_POST["description"];
$_SESSION["img1"] = $img1;
$_SESSION["img2"] = $img2;
$_SESSION["img3"] = $img3;
$_SESSION["categories"] = $_POST["categories"];
$_SESSION["amount"] = $_POST["amount"];
$_SESSION["product_user_id"] = $product_user_id;


mysqli_query($conn, $sql);

echo"<div class='corect'>
<p>Product created</p>
<i class='fa-solid fa-circle-check' style='color: white;'></i>
  </div>";
}elseif(
    empty($_POST['product_name'])
    && empty($_POST['price'])
    && empty($_FILES['img1']['name'])
    && empty($_POST['description'])
    && empty($_POST['categories'])
    && empty($_POST['amount'])
){
    echo"<div class='error'>
    <p>You don't insert anything</p>
     <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
      </div>";
}elseif(
    empty($_POST['product_name'])
){
    echo"<div class='error'>
    <p>You don't insert product name</p>
     <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
      </div>";
}elseif(
    empty($_POST['price'])
){
    echo"<div class='error'>
    <p>You don't insert price</p>
     <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
      </div>";
}elseif(
    empty($_FILES['img1']['name'])
){
    echo"<div class='error'>
    <p>You don't insert product image</p>
     <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
      </div>";
}elseif(
    empty($_POST['description'])
){
    echo"<div class='error'>
    <p>You don't insert description</p>
     <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
      </div>";
}elseif(
    empty($_POST['categories'])
){
    echo"<div class='error'>
    <p>You don't insert categories</p>
     <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
      </div>";
}elseif(
    empty($_POST['amount'])
){
    echo"<div class='error'>
    <p>You don't insert amount of products</p>
     <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
      </div>";
}

}

mysqli_close($conn);
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