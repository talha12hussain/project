<header class="header">
<div class="header_body">

<a href="index.php" class="logo">Technobling</a>
<nav class="navbar">
    <a href="index.php">All product </a>
    <a href="viewproduct.php">View product</a>
    <a href="shop_product.php">shoping</a>
</nav>
<?php
$select_product=mysqli_query($con,"select * from cart") or die('connection failed');
$row_count=mysqli_num_rows($select_product);

?>

<a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sub><?php echo $row_count ?></sub></span></a>

<!--<div id="menu-btn" class="fas fa-bars"></div> -->
</div>
</header>
