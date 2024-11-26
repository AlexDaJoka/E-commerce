<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
}else{
$user_id = '';
header('location:home.php');
}

include 'wishlist_cart.php';

if(isset($_POST['delete'])){
$wishlist_id = $_POST['wishlist_id'];
$delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
$delete_wishlist->execute([$wishlist_id]);
$message[] = 'wishlist item deleted';
}

if(isset($_GET['delete_all'])){
$delete_all = $_GET['delete_all'];
$delete_all_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
$delete_all_wishlist->execute([$user_id]);
header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>wishlist</title>
</head>
<style>
*{
    padding:0;
    margin:0;
    box-sizing:border-box;
}


.wishlist{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    padding:50px;
}

.wishlist h1{
    position:absolute;
    top:120px;
}

.box-container form{
border:1px solid black;
display:flex;
align-items:center;
justify-content:center;
margin:100px 50px;
padding:50px;
width:300px;
line-height:2em;
}

.box-container form img{
width:200px;
height:200px;
}

.box-container form a{
position:relative;
top:-50px;
right:-100px;
color:black;
width:20px;
height:20px;
}

.qty{
    border:1px solid black;
    font-size:20px;
    width:50px;
    height:25px;
}

.btn{
    display:flex;
    align-items:center;
    justify-content:center;
    width:200px;
    height:25px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
}
.btn:hover{
    box-shadow:0 0 10px 0 black;

}

.delete-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    width:200px;
    height:25px;
    border:1px solid black;
    box-shadow:0 0 0 0 black;
    transition:0.5s;
}
.delete-btn:hover{
    box-shadow:0 0 10px 0 black;

}

.wishlist-total{
    position:absolute;
    top:110px;
    left:20px;
border:1px solid black;
}

.wishlist-total a{
    display:flex;
    align-items:center;
    justify-content:center;
text-decoration:none;
color:black;
}

</style>
<body>

<?php
include 'user_header.php';
?>

<section class="wishlist">

<h1>Your wishlist</h1>

<div class="box-container">

<?php
$grand_total = 0;
$select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
$select_wishlist->execute([$user_id]);
if($select_wishlist->rowCount() > 0){
while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
$grand_total += $fetch_wishlist['price'];

?>
<form action="" method="post" class="box">

    <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid'];?>">
    <input type="hidden" name="name" value="<?= $fetch_wishlist['name'];?>">
    <input type="hidden" name="price" value="<?= $fetch_wishlist['price'];?>">
    <input type="hidden" name="image" value="<?= $fetch_wishlist['image'];?>">
    <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id'];?>">

    <a href="quick_view.php?pid=<?= $fetch_wishlist['pid'];?>" class="fas fa-eye"></a>
<img src="uploaded_img/<?= $fetch_wishlist['image'];?> class="image">
<div class="name"><?= $fetch_wishlist['name'];?></div>
<div class="flex">
<div class="price">$<span><?= $fetch_wishlist['name'];?></span>/-</div>
<input type="number" name="qty" class="qty" min="1" max="99" value="1"
onkeypress="if(this.value.length == 2) return false;">
</div>
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
<input type="submit" value="delete item" onclick="return confirm('delete this from wishlist ');" name="delete" class="delete-btn"
>
</form>
<?php
}
}else{
echo '<p class="empty">no products added yet</p>';
}
?>
</div>

<div class="wishlist-total">

<div class="grand-total">grand total: <span>$<?= $grand_total; ?></span>/-</div>
<a href="shop.php" class="btn">continue shopping</a>
<a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled';?>" onclick="return confirm('delete all from wishlist ');">delete all</a>
</div>

</section>

<?php include 'footer.php';?>

</body>
</html>