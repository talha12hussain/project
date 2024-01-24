<?php

include ('connect.php');

if(isset($_POST['add_to_cart']))
{

    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_POST['product_image'];
    $product_qty=1;

    $select_cart=mysqli_query($con,"select * from cart where name='$product_name'");
    if(mysqli_num_rows($select_cart)>0)
    {
        $display_message[]= "product allready added to cart";
        
    }
    else
    {
        $insert_product=mysqli_query($con, " INSERT INTO `cart`(name, price, image, qty) value ('$product_name','$product_price','$product_image','$product_qty')");
        $display_message[]= "product  added to cart";
    }

 
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Product-project</title>
    <link rel="stylesheet"  href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php  include('header.php') ?>


<div class="container">
<?php
if(isset($display_message)){
  
    foreach($display_message as $display_message){
 echo "<div class='display_message'>
    <span>$display_message</span>
    <i class='fas fa-times' onClick='this.parentElement.style.display=`none`';></i>
</div>";
    }
    
}
?>
<section class="products" action="">
        <h1 class="heading">Lets Shop</h1>
        <div class="product_container">
           
       
    <?php
    $select_product=mysqli_query($con,"select * from products");
    if(mysqli_num_rows($select_product)>0)
    {
      while( $fetch_product=mysqli_fetch_assoc($select_product))
      {
        ?>
         <form method="post" >
            <div class="edit_form">
                <img src="images/<?php echo $fetch_product['images']?>" alt="">
                <h3><?php echo $fetch_product['name']?></h3>
                <div class="price"><?php echo $fetch_product['price']?>/-</div>
                <input type="hidden" name="product_name" value=" <?php echo $fetch_product['name']?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['images']?>">
                <input type="submit" class="submit_btn cart_btn" value="Add_To_Cart " name="add_to_cart">
            </div>
</form>
            <?php
      }
        
    }
    else
    {
        echo "<div class='empty_text'>No Product Avalabel</div>";
    }
    
    ?>
    </div>
    </section>
</div>
    
</body>
</html>