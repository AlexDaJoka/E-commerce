<?php

include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
 };
 
if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = 'uploaded_img/'.$image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_size_02 = $_FILES['image_02']['size'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = 'uploaded_img/'.$image_02;

    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_size_03 = $_FILES['image_03']['size'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = 'uploaded_img/'.$image_03;

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if($select_products->rowCount() > 0){
       $message[] = 'product name already exist!';
    }else{

       $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
       $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

       if($insert_products){
          if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
             $message[] = 'image size is too large!';
          }else{
             move_uploaded_file($image_tmp_name_01, $image_folder_01);
             move_uploaded_file($image_tmp_name_02, $image_folder_02);
             move_uploaded_file($image_tmp_name_03, $image_folder_03);
             $message[] = 'new product added!';
          }

       }

    }

 };

 if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('/uploaded_img/'.$fetch_delete_image['image_01']);
    unlink('/uploaded_img/'.$fetch_delete_image['image_02']);
    unlink('/uploaded_img/'.$fetch_delete_image['image_03']);
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    header('location:products.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>products</title>
    <script src="https://kit.fontawesome.com/edc2caccf4.js" crossorigin="anonymous" defer></script>
    <script src="/js/app.js"></script>
</head>
<style>
*{
padding:0;
margin:0;
box-sizing:border-box;
}

html{
overflow-x:hidden;
}

.add-products h3{
    display:flex;
    align-items:center;
    justify-content:center;
    position:absolute;
    top:30px;
    left:35vw;
    font-size:50px;
}

.add-products form{
background:white;
position:absolute;
left:35vw;
top:90px;
line-height:2em;
font-size:20px;
border:2px solid black;
border-radius:30px;
box-shadow:0 0px 0px 10px black;
}

.add-products span{

}

.inputBox input{
    height:25px;

}

.inputBox .details{
    display:flex;
    align-items:center;
    justify-content:center;
}
.inputBox textarea{
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    resize: none;
}

.btn{
position:relative;
top:20px;
left:100px;
cursor:pointer;
height:50px;
width:200px;
border-radius:20px;
border:1px solid black;
transition:0.6s;
box-shadow:0 0 10px 0 black;
}

.btn:hover{
background:green;
box-shadow:0 0 0 0 black;
}

.show-products{
position:relative;
padding:50px;

}

.box-container .box{
display:inline-block;
flex-wrap:wrap;
border:1px solid black;
}

.box img{
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
    left:50px;
    top:25px;
    width:200px;
    height:200px;
}
.box .details{
text-align:center;
justify-content:center;
width:300px;
height:150px;
position:relative;
top:10px;
word-wrap:break-word;
}

.box .name{
display:flex;
align-items:center;
justify-content:center;
position:relative;
top:20px;
left:0;

}

.box .price{
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    color:#0080ff;
    position:relative;
    top:20px;
}

.box .option-btn{
text-decoration:none;
color:black;
display:flex;
align-items:center;
justify-content:center;
border:1px solid black;
height:20px;
width:300px;
border-radius:20px;
box-shadow:0 0 3px 3px black;
transition:0.6s;
}

.box .option-btn:hover{
    box-shadow:0 0 0 0 black;
}

.box .delete-btn{
text-decoration:none;
color:black;
display:flex;
align-items:center;
justify-content:center;
border:1px solid black;
border-radius:20px;
height:20px;
width:300px;
box-shadow:0 0 3px 3px black;
transition:0.6s;
}

.box .delete-btn:hover{
    box-shadow:0 0 0 0 black;
}

</style>
<body>

<?php include 'admin_header.php' ?>

<section class="add-products">
<h3>ADD PRODUCT</h3>
<form action="" method="POST" enctype="multipart/form-data">
<div class="flex">
<div class="inputBox">
<span>product name (required)</span>
<input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box">
</div>
<div class="inputBox">
<span>product price (required)</span>
<input type="number" min="0" max="999999999" required placeholder="enter product price"
name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
</div>

<div class="inputBox">
<span> image 01 (required)</span>
<input type="file" name="image_01" class="box"
accept="image/jpg, image/jpeg, image/png, image/webp" required>
</div>

<div class="inputBox">
<span> image 02 (required)</span>
<input type="file" name="image_02" class="box"
accept="image/jpg, image/jpeg, image/png, image/webp" required>
</div>

<div class="inputBox">
<span> image 03 (required)</span>
<input type="file" name="image_03" class="box"
accept="image/jpg, image/jpeg, image/png, image/webp" required>
</div>
<div class="inputBox">
<span>product details</span>
<textarea name="details" class="box" placeholder="enter product details"
required maxlength="400" cols="30" rows="10"></textarea>
</div>
<input type="submit" value="add product" name="add_product" class="btn">
</div>
</form>

</section>

<section class="show-products">

<div class="box-container">
    
<?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>

<div class="box">
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>">
<div class="name"><?= $fetch_products['name']; ?></div>
<div class="price"><?= $fetch_products['price']; ?>$</div>
<div class="details"><?= $fetch_products['details']; ?></div>
<div class="flex-btn">
<a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
<a href="products.php?delete=<?=$fetch_products['id']; ?>" onclick="return confirm('delete this products');" class="delete-btn">delete</a>
</div>
</div>
<?php
}
}else{
echo '<p class="empty">no products added yet</p>';
}
?>

</div>

</section>


</body>
</html>