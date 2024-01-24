
<?php  include('connect.php');

if(isset($_POST['add_product']))
{
    $product_name=$_POST["product_name"];
    $product_price=$_POST["product_price"];
    $product_image=$_FILES["product_image"]["name"];
    $product_image_temp_name=$_FILES["product_image"]["tmp_name"];
    $product_image_folder='images/'.$product_image;

    $insert_query=mysqli_query($con,"INSERT INTO `products`( `name`, `price`, `images`) VALUES ('$product_name','$product_price','$product_image')") or  die ("connectin failed");

    if($insert_query)
    {
        move_uploaded_file($product_image_temp_name,  $product_image_folder);
        $display_message= "Product Insert Sucessfully";
    }
    else
    {
        $display_message= "There Is Some Error Insert Product";
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopin cart</title>
    <link rel="stylesheet"  href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php  include('header.php') ?>

<div class="container">

<?php

if(isset($display_message))
{
    echo "<div class='display_message'>
    <span>$display_message</span>

    <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
</div>";
}

?>

    <section>
        <h3 class="heading">Add product</h3>
        <form action="" class="add_product" method="post" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Enter Product Nmae" class="input_fields" required>
            <input type="number" name= "product_price" min="0" placeholder="Enter Product price" class="input_fields" required>
            <input type="file" name="product_image" class="input_fields" required accept="image/png,image/jpg,image/jpeg">
            <input type="submit" name="add_product" class="submit_btn" value="Add Product" >
        </form>

    </section>
</div>






<script src="js/script.js"></script>
</body>
</html>