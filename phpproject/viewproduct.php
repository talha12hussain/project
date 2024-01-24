<?php  include('connect.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet"  href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php  include('header.php') ?>
    
<div class="container" enctype="multipart/form-data">
    <section class="display_product" >

  
        <tbody  >
            <?php
            $diplay_product=mysqli_query($con,"select * from products");
            $num=1;
            if(mysqli_num_rows($diplay_product)>0)
            {
                echo "<table>
                <thead>
                    <th>Si No</th>
                    <th>Product Image</th>
                    <th>Product Nmae</th>
                    <th>Product Price</th>
                    <th>Action</th>
                </thead>";

               while( $row=mysqli_fetch_assoc($diplay_product))

            {
               
            ?>
             
             <tr>
            <td><?php echo $num ?></td>
            <td><img src="images/<?php echo  $row['images']; ?>" alt=<?php 
            echo $row['name']?> ></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['price']?></td>
            <td>
                <a href="delete.php?delete=<?php echo $row['id']?>" class="delete_product_btn" onclick="return confirm('Are You sShow You Want Delete The Product');"><i class="fas fa-trash"></i></a>
                <a href="update.php?Edit=<?php echo $row['id']?>"class="update_product_btn"><i class="fas fa-edit"></i></a>
            </td>
        
                </th>
            </tr>
            <?php
            $num++;
            }


            }
            else
            {
                echo "<div class='empty_text'>No Product Avalabel</div>";
            }

            ?>
           
        </tbody>
    </table>

    </section>
</div>
</body>
</html>