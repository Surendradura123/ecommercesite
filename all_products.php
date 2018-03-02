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
<link rel="stylesheet" href="styles/style.css" media="all" type="text/css" />
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
                <?php
                getBrand();
                
               ?>
            </ul>
            
        </div>
         <!--Left-SideBar End-->
         <!--Right-Content Starts-->
        <div id="right_content">
            
            
            <div id="headline">
                <div id="headline_content">
                     
                    <?php
                    
                        if(!isset($_SESSION['customer_email'])){
                            
                            echo "<b>Welcome Guest!</b> <b style='color:yellow'>Shopping Cart - </b>";
                        }
                        else{
                            echo "<b>Welcome:" . "<span style='color:blue'>" . $_SESSION['customer_email'] ."</span>" . "</b>" ."<b style='color:yellow'> Your Shopping Cart - </b>";
                        }
                    
                    ?>
                    
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
            
            <div id="products_box">
               
    <?php 
                            
                $get_products = "select * from products";
                
                $run_products = mysqli_query($con, $get_products);
                
                while($row_products = mysqli_fetch_array($run_products)){
                    
                     $pro_id = $row_products['product_id'];
                     $pro_title = $row_products['product_title'];
                     $pro_desc = $row_products['product_desc'];
                     $pro_price = $row_products['product_price'];
                     $pro_image = $row_products['product_img1'];
                     
                     
                     echo "
                     <div id='single_product'>
                     
                     <h3>$pro_title</h3>
                     
                     <img src='admin_area/product_images/$pro_image' width='180' height='180' /><br>
                     
                     <p><b> Price:€$pro_price</b></p>
                     <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                     
                     <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
                     
                     </div>
                     
                     ";
    
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