<?php

include("includes/db.php");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body bgcolor="#999999">
    <form method="post" action="insert_product.php" enctype="multipart/form-data">
        <table width="700" align="center" border="1" bgcolor="#3399CC">
            <tr align="center">
                <td colspan="2"><h1>Insert New Product</h1></td>
</tr>
            <tr>
            <td align="center"><b>product Titel<b></td>
                <td><input type="text" name="product_titel" size="50"></td>
</tr>
<tr>
<td align="center"><b>product category<b></td>
                <td>
                    <select name="product_cat">
                        
                        <option>select category</option>
                        <?php
$get_cata="SELECT * FROM `categories`";
$run_cata=mysqli_query($con,$get_cata);
while($row_cata=mysqli_fetch_array($run_cata)){

    $cat_id=$row_cata['cat_id'];
    $cat_titel=$row_cata['cat_titel'];
     echo"<option value='$cat_id'>$cat_titel</option>";
}
    ?>
</select>
                </td>
</tr>
<tr>
<td align="center"><b>product Brand<b></td>
                <td> <select name="product_brand">
                    <option>Select Brand </option>
                    <?php
$get_brand="SELECT * FROM `brands`";
$run_brand=mysqli_query($con,$get_brand);
while($row_brand=mysqli_fetch_array($run_brand)){

    $brand_id=$row_brand['brand_id'];
    $brand_titel=$row_brand['brand_titel'];
     echo"<option value='$brand_id'>$brand_titel</option>";
}
    ?>
</select>
                </td>
</tr>
<tr>
<td align="center"><b>product img 1<b></td>
                <td><input type="file" name="product_img1"></td>
</tr>
<tr>
<td align="center"><b>product img 2<b></td>
                <td><input type="file" name="product_img2"></td>
</tr>
<tr>
<td align="center"><b>product img 3<b></td>
                <td><input type="file" name="product_img3"></td>
</tr>
<tr>
<td align="center"><b>product Price<b></td>
                <td><input type="text" name="product_price"></td>
</tr>
<tr>
<td align="center"><b>product Descripation<b></td>
                <td><textarea type="text" name="product_desc" cols="35" rows="10'" ></textarea></td>
</tr>
<tr>
<td align="center"><b> product_keyword<b></td>
                <td><input type="text" name="product_keyword"></td>
</tr>
<tr align="center">
                <td colspan="2" ><input type="submit" name="insert_product" value="insert product"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
if(isset($_POST["insert_product"]))
{
    $product_titel=$_POST['product_titel'];
    $product_cat=$_POST['product_cat'];
    $product_brand=$_POST['product_brand'];
    $product_price=$_POST['product_price'];
    $product_desc=$_POST['product_desc'];
    $status='on';
   
    $product_keyword=$_POST['product_keyword'];
    $product_img1=$_FILES['product_img1'] ['name'];
    $product_img2=$_FILES['product_img2'] ['name'];
    $product_img3=$_FILES['product_img3'] ['name'];

    $temp_img1=$_FILES['product_img1'] ['tmp_name'];
    $temp_img2=$_FILES['product_img2'] ['tmp_name'];
    $temp_img3=$_FILES['product_img3'] ['tmp_name'];

    if($product_titel=='' OR $product_cat=='' OR $product_brand=='' OR $product_price=='' OR $product_desc=='' OR $product_keyword=='' OR $product_img1=='')
{
    echo "<script>alert('please fill all the filed')</script>";
    exit();
    
}
else
{
    move_uploaded_file($temp_img1,"product_images/$product_img1");
    move_uploaded_file($temp_img2,"product_images/$product_img2");
    move_uploaded_file($temp_img3,"product_images/$product_img3");

    $insert_product="INSERT INTO products(cat_id, brand_id, date, product_titel, product_image1, product_image2, product_image3, product_price, product_des, status) VALUES ('$product_cat','$product_brand',NOW(),'$product_titel','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$status')";
    $run_product=mysqli_query($con,$insert_product);
    if($run_product)
    {
        echo"<script>alert('product insert sucessfully')</script>";
    }
}



}

?>
