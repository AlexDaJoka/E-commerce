<style>
*{
padding:0;
margin:0;
box-sizing:border-box;
}

footer{
    background:black;
    width:100vw;
}

.box-container{
    display:flex;
    align-items:center;
    justify-content:space-around;
    flex-wrap:wrap;
}

.box{
width:200px;
display:flex;
flex-direction:column;
}

.box h3{
color:white;
font-size:24px;
line-height:1.3em;
}

.box a{
line-height:1.3em;
color:white;
text-decoration:none;
font-size:20px;
transition:0.5s;
box-shadow:0 0 0 0 white;
}

.box a:hover{
box-shadow:0 0 10px 0 white;
}

.credit{
    border-top:1px solid white;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    height:50px;
}

</style>
<footer>

<section class="box-container">

<div class="box">
<h3>quick links</h3>
<a href="home.php"><i class="fas fa-angle-right"></i>home</a>
<a href="about.php"><i class="fas fa-angle-right"></i>about</a>
<a href="shop.php"><i class="fas fa-angle-right"></i>shop</a>
<a href="contact.php"><i class="fas fa-angle-right"></i>contact</a>
</div>

<div class="box">
<h3>extra links</h3>
<a href="orders.php"><i class="fas fa-angle-right"></i>orders</a>
<a href="cart.php"><i class="fas fa-angle-right"></i>cart</a>
<a href="wishlist.php"><i class="fas fa-angle-right"></i>wishlist</a>
<a href="login.php"><i class="fas fa-angle-right"></i>login</a>
</div>

<div class="box">
<h3>contact info</h3>
<a href="tel:1234567890"><i class="fas fa-phone"></i>+1234567890</a>
<a href="mailto:alex@mail.ru"><i class="fas fa-envelope"></i>alex@mail.ru</a>
<a href=""><i class="fas fa-map-marker-alt"></i>Жопа мира ул 1 дом 1</a>
</div>

<div class="box">

<h3>follow us</h3>
<a href="#"><i class="fab fa-facebook-f"></i>facebook</a>
<a href="#"><i class="fab fa-twitter"></i>twitter</a>
<a href="#"><i class="fab fa-telegram"></i>telegram</a>
<a href="#"><i class="fab fa-youtube"></i>youtube</a>
</div>

</section>

<div class="credit">
 &copy; copyright @ <?= date('Y'); ?> by
 <span>mr. ALEKSEI web progromist autist</span> | all right reserved</div>

</footer>