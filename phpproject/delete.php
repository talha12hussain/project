<?php

include 'connect.php';

if(isset($_GET['delete']))
{
    $delete_id=$_GET['delete'];
    $delete_query=mysqli_query($con,"delete from products where id=$delete_id") or die("query failed");
    if($delete_query)
    {
       
    header('location:viewproduct.php');
    }
    else
    {
        echo "product not delete";
       
    }
}

?>