<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
}else{
$user_id = '';
header('location:user_login.php');
};

if(isset($_POST['orders'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if($check_cart->rowCount() > 0){

       $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
       $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

       $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
       $delete_cart->execute([$user_id]);

       $message[] = 'order placed successfully!';
    }else{
       $message[] = 'your cart is empty';
    }

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>checkout</title>
</head>
<style>
*{
    padding:0;
    margin:0;
    box-sizing:border-box;
}
.checkout{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    padding:50px;
}

.display-orders{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    border:1px solid black;
    width:400px;
    font-size:25px;
    padding:25px;
}

.display-orders p span{
color:orange;
}

.grand-total span{
    color:orange;
}

.inputBox select{
    border:1px solid black;
    width:300px;
    height:30px;
    font-size:20px;
}

.inputBox input{
    border:1px solid black;
    width:300px;
    height:30px;
    font-size:25px;
}

.btn{
    width:300px;
    height:30px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
}
.btn:hover{
    box-shadow:0 0 10px 0 black;

}

</style>
<body>


<section class="checkout">
<h1>checkout</h1>
<form action="" method="POST">
<div class="display-orders">

<?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?= '$'.$fetch_cart['price'].'/- x '. $fetch_cart['quantity']; ?>)</span> </p>
<?php
}
}else{
echo '<p class="empty">no products added yet</p>';
}
?>

<input type="hidden" name="total_products" value="<?= $total_products;?>">
<input type="hidden" name="total_price" value="<?= $grand_total;?>">
<div class="grand-total">grand total: <span>$<?= $grand_total; ?></span>/-</div>


<div class="flex">

<div class="inputBox">
<span>your name :</span>
<input type="text" maxlength="20" placeholder="enter your name"
required class="box" name="name">
</div>

<div class="inputBox">
<span>your number :</span>
<input type="number" min="0" max="99999999999"
onkeypress="if(this.value.length == 10)return false;" placeholder="enter your number"
required class="box" name="number">
</div>

<div class="inputBox">
<span>your email :</span>
<input type="email" maxlength="20" placeholder="enter your email"
required class="box" name="email">
</div>

<div class="inputBox">
<span>payment method :</span>
<select name="method" class="box">
<option value="cash on delivery">cash on delivery</option>
<option value="credit card">credit card</option>
<option value="paypal">paypal</option>
<option value="mastercard">mastercard</option>
</select>
</div>

<div class="inputBox">
<span>address line 01</span>
<input type="text" maxlength="50" placeholder="e.g. flat no."
required class="box" name="flat">
</div>

<div class="inputBox">
<span>address line 02</span>
<input type="text" maxlength="50" placeholder="e.g. street name."
required class="box" name="street">
</div>

<div class="inputBox">
<span>city</span>
<input type="text" maxlength="50" placeholder="e.g. moscow."
required class="box" name="city">
</div>

<div class="inputBox">
<span>country</span>
<input type="text" maxlength="50" placeholder="e.g. RUSSIA."
required class="box" name="country">
</div>

<div class="inputBox">
<span>pin code</span>
<input type="number" min="0" max="999999" placeholder="123456"
onkeypress="if(this.value.length == 6)return false;" required class="box" name="pin_code">
</div>

</div>

<input type="submit" value="place order" class="btn <?= ($grand_total > 1)?'':'disabled';?>" name="orders">
<a href="shop.php?category">Back</a>
</form>

</div>

</section>


</body>
</html>