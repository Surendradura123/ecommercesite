<?php

@session_start();

include("includes/db.php");

?>


<div>
    <form action="checkout.php" method="post">
        
        <table width="900" bgcolor="#66CCCC" align="center">
            
            <tr align="center">
                <td colspan="4"><h1>Login OR Register</h1> </td>
            </tr>
            <tr></tr>
            <tr>
                <td align="right"> <b>Your Email:</b> </td>
                <td>
                     <input type="text" name="c_email" />
                </td>
            </tr>
            </br>
            </br>
            <tr></tr>
            <tr>
                <td align="right"><b>Your Password:</b></td>
                <td>   
                    <input type="password" name="c_pass"  />  
                </td>
            </tr>
            <tr></tr>
            <tr align="center">
                <td colspan="4"><a href="forget_pass.php">Forgot Password</a></td>
            </tr>
            <tr align="center">
                <td colspan="4"> <input type="submit" name="c_login" value="Login" /> </td>
            </tr>
            
        </table>
        
    </form>
        <h1 style="float:right; padding:10px;"><a href="customer_register.php">New? Register Here</a></h1> 
</div>

<?php

if(isset($_POST['c_login'])){
    
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];
    
    $sel_customer ="select * from customers where customer_email='$customer_email' AND customer_password='$customer_pass'";
    
    $run_customer = mysqli_query($con, $sel_customer);
    
    $check_customer = mysqli_num_rows($run_customer);
    
    $get_ip = getRealIpAddr();
    
    $sel_cart = "select * from cart where ip_add='$get_ip'";
    
    $run_cart = mysqli_query($con, $sel_cart);
    
    $check_cart = mysqli_num_rows($run_cart);
    
    if($check_customer==0){
        
        echo "<script>alert('Password or Email address isnot correct,try again!')</script>";
        exit();
    }
    
    if($check_customer==1 AND $check_cart==0){
        
        $_SESSION['customer_email']=$customer_email;
        
        echo "<script>window.open('customer/my_account.php','_self')</script>";
    }
   else{
       
        $_SESSION['customer_email']=$customer_email;
        
         echo "<script>alert('You successfully logged in, order now!')</script>";
        
          include("payment_options.php");
   }


}

?>
