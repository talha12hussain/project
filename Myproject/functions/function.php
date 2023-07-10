<?php
$db=mysqli_connect("localhost","root","","myshop");

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
//create the script cart


function cart()
{
    global $db;

    if(isset($_GET['add_cart']))
{
    $ip_addres=get_client_ip();
    $p_id=$_GET['add_cart'];
    $check_pro="select * from cart where ip_addres='$ip_addres' AND p_id='$p_id'";
    $run_check=mysqli_query($db,$check_pro);
if(mysqli_num_rows($run_check)>0)
{
    echo "";
}
else
{
    $q="INSERT INTO `cart`(`p_id`, `ip_addres` ) VALUES ('$p_id','1')";
    $run_q=mysqli_query($db,$q);
    echo "<script>window.open('index.php','_self')</script>";
}

}
}
//getting the num of item from the cart

function items()
{
   
    

    if(isset($_GET['add_cart']))
    {
        global $db;

        $ip_addres=get_client_ip();

        $get_items= "select * from cart where ip_addres='1'";
        $run_items=mysqli_query($db,$get_items);
        $count_item=mysqli_num_rows($run_items);
    }
    else
{

    $ip_addres=get_client_ip();

    global $db;

    $get_items= "select * from cart where ip_addres='1'";
        $run_items=mysqli_query($db,$get_items);
        $count_item=mysqli_num_rows($run_items);
}
echo $count_item;
}


//geting the totel price of the items from the cart


function total_price()
{
    $ip_addres=get_client_ip(); 

    global $db;
    $total=0;
    
    $sel_price="select * from cart where ip_addres-'$ip_addres'";
    $run_price=mysqli_query($db,$sel_price);
while($record= mysqli_fetch_array($run_price))
{
$pro_id= $record['p_id'];
$pro_price="select * from products where product_id='$pro_id'";
$run_pro_price=mysqli_query($db,$pro_price);
while($p_price=mysqli_fetch_array($run_pro_price))
{
    $product_price = array($p_price['product_price']);
    $values= array_sum($product_price);
    $total +=$values;
}
    }
    
    echo "$" .$total;
}






function getpro()
{
    global $db;

    if(!isset($_GET['cat']))
{
if(!isset($_GET['brand'])){

    
$get_product="select * from products order by rand() LIMIT 0,6";
$run_product=mysqli_query($db,$get_product);
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

}

}
}
function getcata()
{
    global $db;
    
$get_cata="SELECT * FROM `categories`";
$run_cata=mysqli_query($db,$get_cata);
while($row_cata=mysqli_fetch_array($run_cata)){

    $cat_id=$row_cata['cat_id'];
    $cata_titel=$row_cata['cat_titel'];
     echo"<li><a href='index.php?cat=$cat_id'>$cata_titel</a></li>";
}
    
}






function getcatpro()
{
    global $db;

    if(isset($_GET['cat']))
{
    $cat_id=$_GET['cat'];
 
    $get_cat_pro="select * from products where cat_id='$cat_id'";
    $run_get_pro=mysqli_query($db,$get_cat_pro);
    while($row_get_pro=mysqli_fetch_array($run_get_pro))
    {
        $pro_id=$row_get_pro['product_id'];
        $pro_titel=$row_get_pro['product_titel'];
        $pro_cat=$row_get_pro['cat_id'];
        $pro_brand=$row_get_pro['brand_id'];
        $pro_desc=$row_get_pro['product_des'];
        $pro_price=$row_get_pro['product_price'];
        $pro_image=$row_get_pro['product_image1'];
    
        echo "
        <div id='singel_product'>
        <h3>$pro_titel</h3>
        <img src='admin_area/product_images/$pro_image' width='180' height='180'><br>
        <p><b>Price: $pro_price PKR</b></p>
        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
        <a href='index.php?add_cart=$pro_id'><button style='float:right';>Add To Cart</button></a>
        </div>";
    }
    
    }
    
    }




    function getbrandpro()
{
    global $db;

    if(isset($_GET['brand']))
{
    $brand_id=$_GET['brand'];
 
    $get_brand_pro="select * from products where brand_id='$brand_id'";
    $run_brand_pro=mysqli_query($db,$get_brand_pro);
    while($row_brand_pro=mysqli_fetch_array($run_brand_pro))
    {
        $pro_id=$row_brand_pro['product_id'];
        $pro_titel=$row_brand_pro['product_titel'];
        $pro_cat=$row_brand_pro['cat_id'];
        $pro_brand=$row_brand_pro['brand_id'];
        $pro_desc=$row_brand_pro['product_des'];
        $pro_price=$row_brand_pro['product_price'];
        $pro_image=$row_brand_pro['product_image1'];
    
        echo "
        <div id='singel_product'>
        <h3>$pro_titel</h3>
        <img src='admin_area/product_images/$pro_image' width='180' height='180'><br>
        <p><b>Price: $pro_price PKR</b></p>
        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
        <a href='index.php?add_cart=$pro_id'><button style='float:right';>Add To Cart</button></a>
        </div>";
    }
    
    }
    
    }
    







function getbrand()
{
    global $db;
    $get_brand="SELECT * FROM `brands`";
$run_brand=mysqli_query($db,$get_brand);
while($row_brand=mysqli_fetch_array($run_brand)){
$brand_id=$row_brand['brand_id'];
    $brand_titel=$row_brand['brand_titel'];
     echo "<li><a href='index.php?brand=$brand_id'>$brand_titel</a></li>";
}
}

?>