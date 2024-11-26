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
    overflow-x: hidden;
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
    width:100vw;
    background:white;
    display:flex;
    align-items:flex-start;
    justify-content: center;
    flex-direction: column;
    padding:30px;
    line-height: 2em;
}

form h3{

}

form .price{

}

.Slider{
position: absolute;
right:30px;
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



.errows{
    display:flex;
    font-size:20px;
    padding:20px;
}

.errows i{
    cursor:pointer;
}



.error{
background: linear-gradient(to right, #f12711, #f5af19);
color:white;
position:absolute;
width:27vw;
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
    margin:0px 8px;
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

</style>
<body>

<?php
include("header.php");
?>


<input type="hidden" id="price" value="<?php echo $_SESSION['price']; ?>">


<form method="post">

<div class="price">
    <h3>Price</h3>
<p name="order_price" id="c"><?php echo $_SESSION['price']; ?>P</p>
</div>

<div class="Slider">
<img src="product_img/<?php echo $_SESSION['product_img1']; ?>">
<img src="product_img/<?php echo $_SESSION['product_img2']; ?>">
<img src="product_img/<?php echo $_SESSION['product_img3']; ?>">
</div>

<div class="errows">
<i id="left" class="fa-solid fa-arrow-left-long"></i>
<i id="right" class="fa-solid fa-arrow-right-long"></i>
</div>

<h3><?php echo $_SESSION["product_name"]; ?></h3>
<input id="amount" max="<?php echo $_SESSION["amount"]; ?>" min="1" value="1" name="amount" type="number">
<p>Payment method</p>
<select name="Payment">
    <option value="Master card">Master card</option>
    <option value="Cash">Cash</option>
</select>

<p>Deliver method</p>
<select name="Deliver">
    <option value="Post office">Post office</option>
    <option value="home">To your home adress</option>
    <option value="adress">To another adress</option>
</select>

<input type="text" name="city" placeholder="City">
<input type="text" name="adress" placeholder="Adress">


<button name="Create" type="submit">Create order</button>
</form>





<?php
if(isset($_POST['Create'])){


    if(!empty($_POST['amount'])
    &&!empty($_POST['Payment'])
    &&!empty($_POST['Deliver'])
    &&!empty($_POST['city'])
    &&!empty($_POST['adress'])
    ){

        $order_id = $_GET['order_id'];
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $phone = $_SESSION["phone_number"];
        $order_product_name = $_SESSION["product_name"];
        $order_amount = $_POST['amount'];
        $order_price = $_SESSION['price'] * $order_amount;
        $order_payment_method = $_POST['Payment'];
        $order_deliver_method = $_POST['Deliver'];
        $order_city = $_POST['city'];
        $order_adress = $_POST['adress'];

        $sql = "INSERT INTO orders (product_order_id, order_product_name, order_price, order_amount, order_payment_method, order_deliver_method, order_city, order_adress, username, email, phone, order_complete)
        VALUES('$order_id', '$order_product_name', '$order_price', '$order_amount', '$order_payment_method', '$order_deliver_method', '$order_city', '$order_adress', '$username', '$email', '$phone', 'Preparing')
        ;";
        header("location: products.php"); 
        mysqli_query($conn, $sql);
    }elseif(
        empty($_POST['amount'])
    &&empty($_POST['Payment'])
    &&empty($_POST['Deliver'])
    &&empty($_POST['city'])
    &&empty($_POST['adress']) 
    ){
        echo "<div class='error'>
        <p>You don't insert anything</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }elseif(empty($_POST['adress'])){
        echo "<div class='error'>
        <p>You don't insert adress</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }elseif(empty($_POST['city'])){
        echo "<div class='error'>
        <p>You don't insert city</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }elseif(empty($_POST['Deliver'])){
        echo "<div class='error'>
    <p>You don't insert deliver method</p>
     <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
      </div>";
    }elseif(empty($_POST['Payment'])){
            echo "<div class='error'>
        <p>You don't insert payment method</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
        }elseif(
            empty($_POST['amount'])){
                echo "<div class='error'>
            <p>You don't insert amount</p>
             <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
              </div>";
            }


}

mysqli_close($conn);
?>



<script>
// Price * amount    

let p = document.getElementById('price');
let a = document.getElementById('amount');
let c = document.getElementById('c');

a.addEventListener('input', function(){

c.textContent = a.value * p.value + "P";
})


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

const user_menu = document.querySelector(".menu");


function user(){

if(user_menu.style.display === "block"){
    user_menu.style.display = "none";
}else{
    user_menu.style.display = "block";
}

};


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

</html>