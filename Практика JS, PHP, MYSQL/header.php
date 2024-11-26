<script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>


<style>

header{
    width:100vw;
    height:70px;
    border:1px solid black;
    display:flex;
align-items:center;
justify-content: space-around;
background: orange;
}

header a{
color:black;
text-decoration: none;
font-size:20px;
}

header i{
font-size:25px;
cursor:pointer;
}


</style>

<header>

<a href="home.php" id="Home">User account</a>
<a href="products.php" id="Products">Products</a>
<a href="about.php" id="About">About us</a>
<a href="send.php" id="Send">Send problem report</a>
<a href="orders.php" id="Orders">Orders</a>

<i class="fa-solid fa-heart" style="color:red;"></i>

<i class="fa-regular fa-cart-shopping"></i>

<i class="fa-solid fa-magnifying-glass"></i>

<i class="fa-solid fa-user" onclick="user()"></i>

</header>