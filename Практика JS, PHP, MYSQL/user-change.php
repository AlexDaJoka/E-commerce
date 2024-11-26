<?php
include("connect.php");


session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
</head>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    overflow-x:hidden;
}

body{
    display:flex;
    align-items: center;
    justify-content: center;
    flex-direction:column;
    padding:50px;
    background: linear-gradient(to right, #333333, #dd1818);
}

h1{
    color:white;
    font-size:40px;
}

form{
    width:50vw;
    height:500px;
    border:1px solid black;
    border-radius:20px;
    box-shadow: 0 5px 10px 0px red;
    display:flex;
    align-items: center;
    justify-content: center;
    flex-direction:column;
    background:white;
}

form input{
    width:30vw;
    height:20px;
    padding:20px;
    border:1px solid black;
    border-radius:20px;
    font-size:17px;
    margin:20px 0px;
    transition:0.5s;
    box-shadow: 0 2px 0px 0px #b30000;
}

form input:hover{
    box-shadow: 0 5px 0px 0px #b30000;
}

form button{
    width:300px;
    height:40px;
    font-size:17px;
    display:flex;
    align-items: center;
    justify-content: center;
    background:#ff5757;
    color:white;
    border-radius: 20px;
    border:1px solid #b30000;
    margin:20px 0px;
    transition:0.5s;
    box-shadow: 0 5px 0px 0px #b30000;
}

form button:hover{
    box-shadow: 0 0px 0px 0px #b30000;
}

form i{
    position:relative;
    top:-50px;
    right:-165px;
    cursor: pointer;
}

form p a{
    text-decoration: none;
color:red;
}

form a{
    text-decoration:none;
    color:red;
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
<h1>UPDATE USER</h1>
<form action="user-change.php" method="post">

<input type="text" name="username" value="<?php 
if(isset($_SESSION["username"])){
echo $_SESSION["username"];
}else{
echo'';
}
?>" placeholder="username">

<input type="email" name="email" value="<?php 
if(isset($_SESSION["email"])){
echo $_SESSION["email"];
}else{
echo'';
}
?>" placeholder="email">
<input type="text" name="phone" value="<?php 
if(isset($_SESSION["phone_number"])){
echo $_SESSION["phone_number"];
}else{
echo'';
}
?>" placeholder="phone" maxlength="11">
<input type="password" name="password" value="<?php 
if(isset($_SESSION["password"])){
echo $_SESSION["password"];
}else{
echo'';
}
?>" placeholder="password" id="password" ><i class="fa-regular fa-eye" style="color: #000000;" onclick="eye()"></i>

<button type="submit" name="update">update</button>

<a href="home.php">Go back</a>
</form>

</body>

<?php

if(isset($_POST["update"])){

    if(!empty($_POST["username"])
     && !empty($_POST["email"])
     && !empty($_POST["phone"])
      && !empty($_POST["password"])){

$username = $_POST["username"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$password = $_POST["password"];

$user_id = $_SESSION["user_id"];


//$hash = password_hash($password, PASSWORD_DEFAULT);

$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$sql = "UPDATE users 
SET username = '$username', password = '$password', email = '$email', phone_number = '$phone'
WHERE user_id = $user_id
;";

mysqli_query($conn, $sql);

echo"<div class='corect'>
<p>User updated</p>
<i class='fa-solid fa-circle-check' style='color: white;'></i>
  </div>";

session_reset();
$_SESSION["username"] = $_POST["username"];
$_SESSION["password"] =  $_POST["password"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["phone_number"] = $_POST["phone"];

}elseif(empty($_POST["username"])
    && empty($_POST["email"])
    && empty($_POST["phone"])
     && empty($_POST["password"])){
        echo "<div class='error'>
         <p>You don't insert anything</p>
          <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
           </div>";
        }elseif(empty($_POST["username"])){
            echo "<div class='error'>
            <p>You don't insert username</p>
             <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
              </div>";
        }elseif(empty($_POST["email"])){
            echo "<div class='error'>
            <p>You don't insert email</p>
             <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
              </div>";
        }elseif(empty($_POST["phone"])){
            echo "<div class='error'>
            <p>You don't insert phone number</p>
             <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
              </div>";
        }elseif(empty($_POST["password"])){
            echo "<div class='error'>
            <p>You don't insert password</p>
             <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
              </div>";
        }


}

mysqli_close($conn);
?>

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

const password =document.getElementById("password");

function eye(){

    if(password.type === 'password'){
        password.setAttribute('type', 'text');
    }else{
        password.setAttribute('type', 'password');
    }

}

</script>

</html>