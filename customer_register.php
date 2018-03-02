<?php

session_start();

include("includes/db.php");
include("functions/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>My Shop</title>
    <link rel="stylesheet" href="styles/style.css" media="all" />
</head>
<body>
    <!--Main Container Starts-->
<div class="main_wrapper">
    
    <!--Header Starts-->
    <div class="header_wrapper">
        <a href="index.php"><img src="images/logo.jpg" style="float:left;height:100px;width:30%;"></a>
        <img src="images/banner.jpg" style="float:right;height:100px;width:70%;">
    </div>
      <!--Header End-->
      
      
    <!--Navigation Bar Starts-->
    <div id="navbar">
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="all_products.php">All Products</a></li>
            <li><a href="customer/my_account.php">My Account</a></li>
            <li><a href="user_register.php">Sign Up</a></li>
            <li><a href="cart.php">Shopping Cart</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
        
        <div id="form">
            <form method="get" action="results.php" enctype="multipart/form-data">
                <input type="text" name="user_query" placeholder="Search a Product" />
                <input type="submit" name="search" value="Search" />
            </form>
        </div>
    </div>
    
    <!--Navigation Bar End-->
    <!--Content Area Starts-->
    
    <div class="content_wrapper">
        <!--Left-SideBar Starts-->
        <div id="left_sidebar">
            
            <div id="sidebar_title">Categories</div>
            <ul id="cats">
                
                 <?php getCats(); ?>
            </ul>
           
            
             <div id="sidebar_title">Brands</div>
             
                <ul id="cats">
                      <?php getBrand(); ?>
                    
                </ul>

            
        </div>
         <!--Left-SideBar End-->
         <!--Right-Content Starts-->
        <div id="right_content">
            <?php cart();?>
                  
            <div id="headline">
                <div id="headline_content">
                    <b>Welcome Guest!</b>
                     <b style='color:yellow'>Shopping Cart - </b>
                     <span>
                         Total Items: <?php  items(); ?> 
                        -Total Price: <?php  total_price(); ?>  -   
                        <a href="cart.php" style="color:yellow;">Go to Cart</a>&nbsp;
                        
                        <?php
                        if(!isset($_SESSION['customer_email'])){
                           echo "<a href='checkout.php' style='color:black;'>Login</a> " ;
                        
                        }
                        else{
                            echo "<a href='logout.php' style='color:black;'>Logout</a> " ;
                        }
                        ?>
                        
                     </span>
                        
                    
                  
                   
                </div>
            </div>
            
            <div>
                 
                     <form action="customer_register.php" method="post" enctype="multipart/form-data" />
                        
                        <table width="750" align="center">
                            <tr align="center">
                                <td colspan="5"><h1>Create an Account</h1></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Customer Name:</b></td>
                                <td><input type="text" name="c_name" required /></td>
                            </tr>
                            
                            <tr>
                                <td align="right"><b>Customer Email:</b></td>
                                <td><input type="text" name="c_email" required /></td>
                            </tr>
                            
                            <tr>
                                <td align="right"><b>Customer Password:</b></td>
                                <td><input type="password" name="c_pass" required /></td>
                            </tr>
                            
                            <tr>
                                <td align="right"><b>Customer Country:</b></td>
                                 <td>
                                    <select name="c_country">
                                        <option>Select a Country</option>
                                        <option>Ireland</option>
                                        <option>England</option>
                                        <option>Germany</option>
                                        <option>Spain</option>
                                        <option>USA</option>
                                        <option>Netherland</option>
                                        <option>Poland</option>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td align="right"><b>Customer City:</b></td>
                                <td><input type="text" name="c_city" required /></td>
                               
                            </tr>
                            
                            <tr>
                                <td align="right"><b>Customer Mobile no:</b></td>
                                <td><input type="text" name="c_contact" required /></td>
                            </tr>
                            
                            <tr>
                                <td align="right"><b>Customer Address:</b></td>
                                <td><input type="text" name="c_address" required /></td>
                            </tr>
                            
                            <tr>
                                <td align="right"><b>Customer Image:</b></td>
                                <td><input type="file" name="c_image" required /></td>
                            </tr>
                            
                           
                            <tr align="center">
                                <td colspan="5"><input type="submit" name="register" value="Submit" /></td>
                                
                            </tr>
                            
                        </table>
                
                </form>
               
            </div> 
            
            
            
            
        </div>
               <!--Right-Content End-->
    </div>
    
    <!--Content Area End-->
    <!--Footer Section Starts-->
    <div class="footer">
        <h1 style="color:#000; padding-top:30px; text-align:center;">&copy;2018 - By www.onlineuser.com</h1>
    </div>
    <!--Footer section End-->
</div>
 <!--Main Container end-->
</body>
</html>


<?php
    
    if(isset($_POST['register'])){
        
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];
        $c_image = $_FILES['c_image']['name'];               
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        
         $c_ip = getRealIpAddr();
         
       $insert_customer = "insert into customers (customer_name,customer_email,customer_password ,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) 
        values ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";
                        
         $run_customer = mysqli_query($con, $insert_customer);  
         
         move_uploaded_file($c_image_tmp,"customer/customer_photos/$c_image");
         
         $sel_cart = "select * from cart where ip_add='$c_ip'";
    
         $run_cart = mysqli_query($con, $sel_cart);
    
         $check_cart = mysqli_num_rows($run_cart);
        
         if($check_cart>0){
            
            $_SESSION['customer_email']=$c_email;
            
            echo "<script>alert('Account Created Successfully, Thank you!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
        else{
            
             $_SESSION['customer_email']=$c_email;
            echo "<script>alert('Account Created Successfully, Thank you!')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }

?>