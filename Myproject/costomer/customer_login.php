<?php
@session_start();

include("includes/db.php");

?>


<div>

<form action="checkout.php" method="post">
<table width="800" bgcolor="#66ccc" align="center">

<tr align="center">
    <td colspan="4"><h2 style="font-size:20px; color:black;"><b>Login Or Regester</b></h2></td>
</tr>

<tr>
<td align="right"><b>Your Email:</b></td>
<td><input type="text" name="c_email"></td>
</tr>

<tr>

<td align="right"><b style="color:black; ">Your Password</b></td>
<td><input type="password" name="c_password" ></td>
</tr>
<tr align="center">
    <td colspan="4"><a href="fro_pass.php">forget password</a></td>
</tr>

<tr align="center">
<td colspan="4"><input type="submit" name="c_login"  value="login"></td>
</tr>



</table>
</form>

<h2 style="float:right; padding:10px;"><a href="customer_regiester.php">New Rejester Here</a></h2>

</div>

<?php

if(isset($_POST['c_login']))
{
    $customer_emai=$_POST['c_email'];
    $customer_pass=$_POST['c_password'];
    $sel_customer="SELECT * FROM customer WHERE  customer_email='$customer_emai' AND customer_password='$customer_pass'";

    $run_customer=mysqli_query($con,$sel_customer);

    if(mysqli_num_rows($run_customer)>0)
{
    $_SESSION['customer_email']=$customer_emai;
    echo "<script>window.open('index.php','_self')</script>";
}
else
{
    echo "<script>alert('email or passwor worng','try agin')</script>";

}
    
}



?>