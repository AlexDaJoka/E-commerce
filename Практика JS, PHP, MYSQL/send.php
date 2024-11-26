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
    overflow-x:hidden;
}

body{
    background: linear-gradient(to right, #ed213a, #93291e);
    display:flex;
    align-items: center;
    justify-content:center;
    flex-direction:column;
}

#Send{
color:red;
}

h1{
    margin:30px 0px;
    color:white;
    font-size:40px;
}

form{
    width:40vw;
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
    width:25vw;
    height:20px;
    padding:20px;
    border:1px solid black;
    border-radius:10px;
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

form textarea{
    resize: none;
    height:20vw;
    width:30vw;
    font-size:20px;
    border-radius:10px;
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

</style>

<body>
<?php
include("header.php");
?>

<h1>Problem report</h1>
<form action="send.php" method="post">


<input type="text" value="
<?php 
if(isset($_SESSION["username"])){
echo $_SESSION["username"];
}else{
echo'';
}
?>" name="username" placeholder="username">


<input type="email" value="
<?php 
if(isset($_SESSION["email"])){
echo $_SESSION["email"];
}else{
echo'';
}
?>" name="email" placeholder="email">

<textarea name="textarea" placeholder="Enter a message"></textarea>

<button type="Submit" name="Send">Send message</button>

</form>


<?php

if(isset($_POST["Send"])){


    if(!empty($_POST["username"]) && !empty($_POST["textarea"]) && !empty($_POST["email"])){

        if(isset($_SESSION["username"])){
            $usrname = $_POST["username"];
            $message = $_POST["textarea"];
            $email = $_POST["email"];
            $phone = $_SESSION["phone_number"];
            $user_id = $_SESSION["user_id"];

$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$message  = filter_input(INPUT_POST, "textarea", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            $sql = "INSERT INTO messages (user_id, name, email, phone, message)
            VALUES('$user_id', '$usrname', '$email', '$phone', '$message')
            ;";
    
            mysqli_query($conn, $sql);

            echo"<div class='corect'>
            <p>Message sended</p>
            <i class='fa-solid fa-circle-check' style='color: white;'></i>
              </div>";

        }else{
            $usrname = $_POST["username"];
            $message = $_POST["textarea"];
            $email = $_POST["email"];
    
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$message  = filter_input(INPUT_POST, "textarea", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            $sql = "INSERT INTO messages (user_id, name, email, phone, message)
            VALUES('0', '$usrname', '$email', '0', '$message')
            ;";
    
            mysqli_query($conn, $sql);

            echo"<div class='corect'>
            <p>Message sended</p>
            <i class='fa-solid fa-circle-check' style='color: white;'></i>
              </div>";
        }

        
    }elseif(empty($_POST["username"]) && empty($_POST["textarea"]) && empty($_POST["email"])){
        echo"<div class='error'>
        <p>You don't insert anything</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }elseif(empty($_POST["username"])){
        echo"<div class='error'>
        <p>You don't insert username</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }elseif(empty($_POST["email"])){
        echo"<div class='error'>
        <p>You don't insert email</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }elseif(empty($_POST["textarea"])){
        echo"<div class='error'>
        <p>You don't insert message</p>
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