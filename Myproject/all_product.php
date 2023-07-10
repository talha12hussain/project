<?php

include("includes/db.php");
include("functions/function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Project</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css"  media="all">
</head>
<body>
    <div class="main_wrapper">
        <div class="header_wapper">
      <a href="index.php">  <img src="images/log.jpg" style="float:left;"></a>
        <img src="images/banner.jpg" style="float:right;">
           
</div>
<div id="navbar">
    <ul id="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="all_product.php">All Product</a></li>
        <li><a href="my_account.php">My Account</a></li>
        <li><a href="user_rejester.php">Sing up</a></li>
        <li><a href="cart.php">Shopping Cart</a></li>
        <li><a href="contact.php">Contact</a></li>


</ul>
<div id="form">
    <form  method="get" action="results.php" enctype="multipart/form-data">
        <input type="text" name="user_qurey" placeholder="search for product"/>
        <input type="submit" name="search" value="search"/>
</form>

</div>

 </div>

            <div class="content_wrapper">
                <div id="left_slidebar">

<div id="slidebar_titel">Categories</div>
<ul id="cata">
    <?php getcata(); ?>
</ul>
<div id="slidebar_titel">Brands</div>
<ul id="cata">
<?php
getbrand();
?>
        
</ul>
</div>

<div id="right_content">

<div style="color:#fff; background:#000; width:780px; height:35px; float:right; padding:10px;">
<div id="guest">
    <b>welcome guesrt</b>
    <b style="color:yellow;">shoping cart</b>
    <span>- Items - Price</span>
</div>
</div>
<div id="product_box">
<?php 
$get_product="select * from products ";
$run_product=mysqli_query($con,$get_product);
while($row_product=mysqli_fetch_array($run_product))
{
    $pro_id=$row_product['product_id'];
    $pro_titel=$row_product['product_titel'];
    $pro_cat=$row_product['cat_id'];
    $pro_brand=$row_product['brand_id'];
    $pro_desc=$row_product['product_des'];
    $pro_price=$row_product['product_price'];
    $pro_image=$row_product['product_image1'];

    echo "
    <div id='singel_product'>
    <h3>$pro_titel</h3>
    <img src='admin_area/product_images/$pro_image' width='180' height='180'><br>
    <p><b>Price: $pro_price PKR</b></p>
    <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
    <a href='index.php?add_cart=$pro_id'><button style='float:right';>Add To Cart</button></a>
    </div>";
}

?>
</div>


</div>
<div class="footer">
    <h1 style="color:#OOO; padding-top:30px; text-align:center;">$copy;2023 -By www.Myshop.com</h1>
</div>
</div>


</body>
</html>