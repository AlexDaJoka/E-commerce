<?php
include("connect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
</head>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
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
    height:400px;
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

form p a{
    text-decoration: none;
color:red;
}

form i{
    position:relative;
    top:-50px;
    right:-165px;
    cursor: pointer;
}

form a{
    text-decoration:none;
    color:red;
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

</style>
<body>
<h1>LOGIN</h1>
<form action="login.php" method="post">

<input type="text" name="username" placeholder="username">
<input type="password" name="password" placeholder="password" id="password"><i class="fa-regular fa-eye" style="color: #000000;" onclick="eye()"></i>
<button type="submit" name="login">login</button>

<p>Don't have a account <a href="register.php">register</a></p>
<a href="home.php">Go back</a>
</form>

</body>

<?php
error_reporting(0);

    if(isset($_POST["login"])){
        session_start();
    
    if(!empty($_POST["username"]) && !empty($_POST["password"])){
    
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    
        $sql = "SELECT * from users 
        where username = '$username' AND password = '$password'
        ;";
    
       $result =  mysqli_query($conn, $sql);
    
       $row = mysqli_fetch_assoc($result);
       
   
            if($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]){

                $_SESSION["username"] = $row["username"];
                $_SESSION["password"] =  $row["password"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["phone_number"] = $row["phone_number"];
                $_SESSION["register_time"] = $row["register_time"];
                $_SESSION["user_id"] = $row["user_id"];
                header("location: home.php"); 
            }else{
echo"<div class='error'>
<p>Incorect username or password</p>
<i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
</div>";
        }

    

    
    }elseif(empty($_POST["username"]) && empty($_POST["password"])){
        echo"<div class='error'>
        <p>You don't insert anything</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }elseif(empty($_POST["password"])){
        echo"<div class='error'>
        <p>You don't insert password</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }elseif(empty($_POST["username"])){
        echo"<div class='error'>
        <p>You don't insert username</p>
         <i class='fa-solid fa-circle-exclamation' style='color: white;'></i>
          </div>";
    }
    
    }
    
    mysqli_close($conn);

?>


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