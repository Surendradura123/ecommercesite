<?php
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
                    <b>Welcome Guest!</b>
                    <b style="color:yellow;">Shopping Cart</b>
                    <span>-Items: - Price:</span>
                </div>
            </div>
            
            <div id="products_box">
               
    <?php 
    
                if(isset($_GET['pro_id'])){
                    
                $product_id = $_GET['pro_id'];
                            
                $get_products = "select * from products where product_id=$product_id";
                
                $run_products = mysqli_query($con, $get_products);
                
                while($row_products = mysqli_fetch_array($run_products)){
                    
                     $pro_id = $row_products['product_id'];
                     $pro_title = $row_products['product_title'];
                     $pro_desc = $row_products['product_desc'];
                     $pro_price = $row_products['product_price'];
                     $pro_image1 = $row_products['product_img1'];
                     $pro_image2 = $row_products['product_img2'];
                     $pro_image3 = $row_products['product_img3'];
                     
                     echo "
                     <div id='single_product'>
                     
                     <h3>$pro_title</h3>
                     
                     <img src='admin_area/product_images/$pro_image1' width='200' height='200' />
                     <img src='admin_area/product_images/$pro_image2' width='200' height='200' />
                     <img src='admin_area/product_images/$pro_image3' width='200' height='200' /><br>
                     
                     <p><b> Price:€$pro_price</b></p>
                     
                     <p>$pro_desc</p>
                     <a href='index.php' style='float:left;'>Go Back</a>
                     
                     <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
                     
                     </div>
                     
                     ";
    
                }
                        
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