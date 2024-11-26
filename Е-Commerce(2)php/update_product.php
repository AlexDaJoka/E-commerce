<?php

include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, details = ? WHERE id = ?");
   $update_product->execute([$name, $price, $details, $pid]);

   $message[] = 'product updated successfully!';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>update product</title>
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

body h3{
    position:absolute;
    top:0;
    left:50vw;
    font-size:40px;
}

.update-product{
    display:flex;
    justify-content:center;
    align-items:center;
    position:absolute;
    top:60px;
left:35vw;
border:2px solid black;
padding:35px;
}

.update-product .image-container{
   
}

.update-product .image-container .main-image img{
    display:flex;
    justify-content:center;
    align-items:center;
    margin:0px 100px;
width:250px;
height:250px;
}

.update-product .image-container .sub-images img{
    display:inline-block;
    justify-content:center;
    align-items:center;
    border:1px solid black;
width:150px;
height:150px;
}

.update-product input{
    display:flex;
    justify-content:center;
    align-items:center; 
    width:200px;
    height:30px;
    font-size:15px;
    position:relative;
    left:125px;
}

.update-product textarea{
    display:flex;
    justify-content:center;
    align-items:center; 
    resize: none;
    font-size:15px;
    width:400px;
    position:relative;
    left:25px;
}

.update-product span{
    display:flex;
    justify-content:center;
    align-items:center; 
    font-size:25px;
}

.flex-btn input{
    width:200px;
    height:30px;
    border:1px solid black;
    box-shadow:0 6px 0px 0 grey;
    transition:0.5s;
}
.flex-btn input:hover{
    box-shadow:0 0px 0px 0 grey;  
}

.flex-btn a{
    color:black;
    display:flex;
    justify-content:center;
    align-items:center; 
    text-decoration:none;
    position:relative;
    top:10px;
}

</style>
<body>

<?php include 'admin_header.php' ?>
<h3>update product</h3>
<section class="update-product">

<?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>

<form action="" method="post" enctype="multipart/form-data">

<input type="hidden" name="pid" value="<?= $fetch_products['id'];?>" >
<input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
<input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
<input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">

<div class="image-container">
<div class="main-image">
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>">
</div>
<div class="sub-images">
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>">
<img src="uploaded_img/<?= $fetch_products['image_02']; ?>">
<img src="uploaded_img/<?= $fetch_products['image_03']; ?>">
</div>
</div>

<span>update name</span>

<input type="text"  placeholder="enter product name"
name="name" maxlength="100" required class="box" value="<?= $fetch_products['name'];?>">

<span>update price</span>

<input type="number" name="price" required class="box" min="0"
 max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) 
return false;" value="<?= $fetch_products['price']; ?>">

<span>update details</span>

<textarea name="details" class="box" placeholder="enter product details"
 maxlength="400" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>

<span>update images</span>

<input type="file" name="image_01" class="box"
accept="image/jpg, image/jpeg, image/png, image/webp" >

<input type="file" name="image_02" class="box"
accept="image/jpg, image/jpeg, image/png, image/webp" >

<input type="file" name="image_03" class="box"
accept="image/jpg, image/jpeg, image/png, image/webp">

<div class="flex-btn">
<input type="submit" value="update" class="btn" name="update">
<a href="products.php" class="option-btn">Back</a>
</div>

</form>
<?php
}
}else{
echo '<p class="empty">no products added yet</p>';
}
?>
</section>
<script>
subImages = document.querySelectorAll('.update-product .image-container .sub-images img');
mainImage = document.querySelector('.update-product .image-container .main-image img');

subImages.forEach(images =>{
images.onclick = () =>{
let src = images.getAttribute('src');
mainImage.src = src;
}
});
</script>
</body>
</html>