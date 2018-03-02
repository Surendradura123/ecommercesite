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
    <link rel="stylesheet" href="styles/style2.css" media="all" />
</head>
<body>
    <!--Main Container Starts-->
<div class="main_wrapper">
    
    <!--Header Starts-->
    <div class="header_wrapper">
        <a href="index.php"><img src="../images/logo.jpg" style="float:left;height:100px;width:30%;"></a>
        <img src="../images/banner.jpg" style="float:right;height:100px;width:70%;">
    </div>
      <!--Header End-->
      
      
    <!--Navigation Bar Starts-->
    <div id="navbar">
        <ul id="menu">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../all_products.php">All Products</a></li>
            <li><a href="customer/my_account.php">My Account</a></li>
            
            
            <?php
            if(isset($_SESSION['customer_email'])){
                
                 echo "<span style='display:none;'>  <li><a href='../user_register.php'>Sign Up</a></li> </span>";
                
                 }
                 
            else{
                 echo " <li><a href='../user_register.php'>Sign Up</a></li>";
            }
                 ?>
            
           
            
            <li><a href="../cart.php">Shopping Cart</a></li>
            <li><a href="../contact.php">Contact Us</a></li>
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
            
            <div id="sidebar_title">Manage Account:</div>
            <ul id="cats">
                <?php
                
                    $customer_session = $_SESSION['customer_email'];
                    
                    $get_customer_pic = "select * from customers where customer_email='$customer_session'";
                    
                    $run_customer = mysqli_query($con, $get_customer_pic);
                    
                    $row_customer = mysqli_fetch_array($run_customer);
                    
                    $customer_pic = $row_customer['customer_image'];
                    
                    echo "<img src='customer_photos/$customer_pic' width='220' height='220'/>";
                
                ?>
                  <li><a href="my_account.php?my_orders">My Orders</a></li>
                  <li><a href="my_account.php?edit_account">Edit Account</a></li>
                  <li><a href="my_account.php?change_pass">Change Password</a></li>
                  <li><a href="my_account.php?delete_account">Delete Account</a></li>
                  <li><a href="logout.php">Logout</a></li>
            </ul>
            
        </div>
         <!--Left-SideBar End-->
         <!--Right-Content Starts-->
        <div id="right_content">
            <?php cart();?>
                  
            <div id="headline">
                <div id="headline_content">
                     <?php
                    
                        if(isset($_SESSION['customer_email'])){
                            
                            echo "<b>Welcome:" . "<span style='color:blue'>" . $_SESSION['customer_email'] ."</span>" . "</b>";
                        }
                    
                    ?>
                    
                     <span>
                        
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
                <h1 style="background-color:white; color:brown; padding 20px; text-align:center;">Manage Your Account Here</h1>
                  
               
               <?php  
               getDefault(); 
               ?>
               
              <?php
               
                 if(isset($_GET['my_orders'])){
                   
                     include("my_orders.php");
                 }
               
               ?>
               
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


