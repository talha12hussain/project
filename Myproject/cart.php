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
<?php

cart();

?>

<div style="color:#fff; background:#000; width:780px; height:35px; float:right; padding:10px;">
<div id="guest">
    <b>welcome guesrt</b>
    <b style="color:yellow;">shoping cart</b>
    <span>- Items: <?php items(); ?> - Total Price:  <?php total_price();  ?> - <a href="cart.php" style="color:white;">Go To Cart</a></span>
</div>
</div>

<div id="product_box"><br>
<form action="cart.php" method="post"  enctype="multipart/form-data">
<table width="740" align="center" bgcolor="#0099CC">
<tr align="center" >
    <td><b>Remove</b></td>
    <td><b>Product </b></td>
    <td><b>Quantity</b></td>
    <td><b>Total Price</b></td>
</tr>
<?php

$ip_addres=get_client_ip(); 
$total=0;
    
$sel_price="select * from cart where ip_addres-'$ip_addres'";
$run_price=mysqli_query($db,$sel_price);
while($record= mysqli_fetch_array($run_price))
{
$pro_id= $record['p_id'];
$pro_price="select * from products where product_id='$pro_id'";
$run_pro_price=mysqli_query($con,$pro_price);
while($p_price=mysqli_fetch_array($run_pro_price))
{
    $product_price = array($p_price['product_price']);
    $product_titel=$p_price['product_titel'];
    $product_image=$p_price['product_image1'];
    $only_price=$p_price['product_price'];
    $values= array_sum($product_price);
    $total +=$values;
?>

<tr>
<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id ;?>"></td>
<td><?php echo $product_titel; ?><br><img src="admin_area/product_images/<?php echo $product_image; ?>" width="80" height="80"></td>
<td><input type="text" name="qty" value=""  size="3"></td>
    
<?php

/*if(isset($_POST['update']))

{
    $qty= $_POST['qty'];
    $insert_qty= "update cart set qty='$qty' where ip_addres='$ip_addres'";
    $run_qty=mysqli_query($con,$insert_qty);
    $total = $total+$qty;
}*/

?>

<td><?php echo "$" . $only_price; ?></td>
</tr>

<?php }} ?>

    

<tr>
<td colspan="3" align="right"><b>Sub Total:</b></td>
<td><?php echo "$" . $total; ?></td>
</tr>
<tr></tr>
<tr>
    <td colspan="2"><input type="submit" name="update" value="Update Cart"></td>
    <td><input type="submit" name="continue" value="Continue Shoping" /></td>
    <td><button><a href="checkout.php" style="text-decoration:none; color:black;">Check Out</a></button></td>

</tr>


</table>
</form>

<?php

function updatecart()
{

global $con;

if(isset($_POST['update']))

{
    foreach($_POST['remove'] as $remove_id)
    {
       $delete_product= "DELETE FROM `cart` WHERE p_id='$remove_id'";
       $run_delete= mysqli_query($con,$delete_product);
       
       if($run_delete)
       {
        echo "<script>window.open('cart.php','_self')</script>";
       }
    }

    
}

if(isset($_POST['continue']))
    {
        echo "<script>window.open('index.php','_self')</script>";
    }

}

echo @$up_cart = updatecart();

?>


</div>
</div>

<div class="footer">
    <h1 style="color:#OOO; padding-top:30px; text-align:center;">$copy;2023 -By www.Myshop.com</h1>
</div>
</div>
</body>
</html>