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


form{
width:100vw;
background:white;
padding:20px;   
display:flex;
align-items: center;
justify-content: center;
flex-direction: column;
}

.messages-form{
width:80vw;
height:500px;
overflow-y:scroll;
border:1px solid black;
padding:20px;
}

.messages{
    padding:10px;
    font-size:17px;
    display:flex;
    position:relative;
    right:-730px;
    background:green;
    width:250px;
    border:1px solid green;
    border-radius:20px;
    border:1px solid black;
}

.messages .user_name{
padding:0px 20px;
color:white;
font-size: 20px;
text-decoration:underline;
}

.messages .time{
    font-size: 10px;
    margin:20px 50px;
    color:white;
}

.messages-sender{
    padding:10px;
    font-size:17px;
    display:flex;
    align-items: flex-start;
    justify-content: flex-start;
    border:1px solid black;
    border-radius:20px;
    width: 20vw;
    background:#00bbff;
    font-size:17px;
    color:white;
}

.messages-sender .user_name{
padding:0px 20px;
color:white;
font-size: 20px;
text-decoration:underline;
}

.messages-sender .time{
    font-size: 10px;
    margin:20px 50px;
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

<form method="post">



<div class="messages-form">

<?php

$user_id = $_SESSION['user_id'];
$user_taker = $_GET["message_to"];


$sql = "SELECT * FROM privat_messages
WHERE user_taker_id = $user_taker AND user_sender_id = $user_id OR user_taker_id = $user_id AND user_sender_id = $user_taker
ORDER BY message_id
;";



$result = mysqli_query($conn, $sql);



foreach($result as $value){

    $messages = $value['messages'];
    $user_sender = $value['user_sender_id'];
    $user_taker = $value["user_taker_id"];
    $time = $value['message_time'];
    $username = $value['username'];
    $message_id = $value['message_id'];
    
    if($_SESSION['username'] == $username){
        echo "<p class='messages'><span class='user_name'>$username</span> $messages <span class='time'>$time[11] $time[12] $time[13] $time[14] $time[15]</span></p>";
    }else{
        echo "<p class='messages-sender'><span class='user_name'>$username</span> $messages <span class='time'>$time[11] $time[12] $time[13] $time[14] $time[15]</span></p>";
    }
    

} 


 ?>

</div>



<textarea name="textarea"></textarea>

<button name="send">Send</button>

</form>

</main>


<?php

if(isset($_POST['send'])){

    if(!empty($_POST['textarea'])){

        $message = $_POST['textarea'];
        $user_taker_id = $_GET['message_to'];
        $user_id = $_SESSION["user_id"];
        $username = $_SESSION["username"];

        $sql3 = "INSERT INTO privat_messages (user_sender_id, user_taker_id, messages, username)
        VALUES('$user_id', '$user_taker_id', '$message', '$username');";
        
        mysqli_query($conn, $sql3);

    }

}


mysqli_close($conn);
?>


<?php

}else{
    echo"Enter your account to message";
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