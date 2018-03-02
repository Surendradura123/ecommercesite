<!DOCTYPE html>
<html>
    <head>
        <title>Payment Options</title>
    </head>
    
    <body>
        <?php
        
        include("includes/db.php");
        
        ?>
        
         <div align="center" style="padding:20px;">
            
            <h1>Payment Options for you</h1>
            
            <?php
            $ip =  getRealIpAddr();
            
            $get_customer = "select * from customers where customer_ip='$ip'";
            
            $run_customer = mysqli_query($con, $get_customer);
            
            $customer = mysqli_fetch_array($run_customer);
            
            $customer_id = $customer['customer_id'];
            
            
            ?>
            
            <b>Pay with</b>&nbsp;
            <a href="https://www.paypal.com/ie/home"> <img src="images/paypal.jpg" > </a>
             <b>Or <a href="order.php?c_id=<?php echo $customer_id; ?>">Pay Offline</a></b>
            </br>
            </br>
            </br>
            
            <b>If you selected "Pay Offline" option then please check your email or account to find the invoice number for your Order!</b>
    
    
    
    
        </div>
        
    </body>
</html>
       