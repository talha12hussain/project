
<?php  include('connect.php');

if(isset($_POST['update_cart_quantity']))
{
    $update_value=$_POST['update_quantity'];
    $update_id=$_POST['update_quantity_id'];
    $update_quantity_query=mysqli_query($con,"update cart set qty=$update_value where id=$update_id");
    if($update_quantity_query)
    {
        header('location:cart.php');
    }
}

if(isset($_GET['remove']))
{
    $remove_id=$_GET['remove'];
    mysqli_query($con,"delete from cart where id=$remove_id");
    header('location:cart.php');

}
if(isset($_GET['delete_all']))
{
    
    mysqli_query($con,"delete from cart ");
    header('location:cart.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart page-Project</title>
    <link rel="stylesheet"  href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
    include 'header.php';
    ?>

    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">My Cart</h1>
            <table>
                <?php
                $select_cart_product=mysqli_query($con,"select * from cart");
                $num=1;
                $grand_total=0;
                if(mysqli_num_rows($select_cart_product)>0)
                {
                    echo " <thead>
                    <th>Si No</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>
                <tbody>";
                while($fethch_cart_product=mysqli_fetch_assoc($select_cart_product))
                {
                    ?>
                       <tr>
                    
                    <td><?php echo $num?></td>
                    <td><?php echo $fethch_cart_product['name']?></td>
                    <td><img src="images/<?php echo $fethch_cart_product['image']?>" alt="Cemra"></td>
                    <td>$<?php echo $fethch_cart_product['price']?>/-</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fethch_cart_product['id']?>"
                            name="update_quantity_id">
                        <div class="quantity_box">
                            <input type="number" min="1" value="<?php echo $fethch_cart_product['qty']?>" name="update_quantity">
                            <input type="submit" class="update_quantity" value="Update" name="update_cart_quantity">
                        </div>
                        </form>

                    </td>
                    <td>$<?php echo $subtotal=number_format($fethch_cart_product['price']* $fethch_cart_product['qty'])?>/-</td>
                    <td><a href="cart.php?remove=<?php echo $fethch_cart_product['id']?>": onclick="return confirm('Are You Show DO You Want Delete This Item')">
                        <i class="fas fa-trash"></i>Remove
                    </a></td>
</tr>
                    <?php

                    $grand_total=$grand_total+($fethch_cart_product['price']* $fethch_cart_product['qty']);

                    $num++;
                }

                }else
                {
                    echo "<div class='empty_text'>Cart Is Empty</div>";
                }
                ?>
               
                 
                </tbody>
            </table>

            <?php
            if($grand_total>0)
            {

                echo " <div class='table_bottom'>
                <a href='shop_product.php' class='bottom_btn'>Continue shopping</a>
                <h3 class='bottom_btn'>Grand Total: $<span>$grand_total</span></h3>
                <a href='checkout.php' class='bottom_btn'>
                    Procced To CheckOut
                </a>
            </div>";
            

            ?>
           
            <a href="cart.php?delete_all" class="delete_all_btn">
                <i class="fas fa-trash"></i>Delet All
            </a>
            <?php
           
            }
            {
                echo "";
            }
            ?>
        </section>
</div>
</body>
</html>