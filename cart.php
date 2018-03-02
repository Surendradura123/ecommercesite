<?php

@session_start();
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
                        <a href="index.php" style="color:yellow;">Back to Shopping</a>
                        &nbsp;
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
                   
                   
             <form action="cart.php" method="post" enctype="multipart/form-data">
               
                   <table width="80%" align="center" bgcolor="sky-blue">
                   
                      <tr>
                          <td><b>Remove</b></td>
                          <td><b>Product(s)</b></td>
                          <td><b>Quantity</b></td>
                          <td><b>Total Price</b></td>
                  </tr>  
                        <br><br>
                     <?php
                       $ip_add = getRealIpAddr();
           
                        $total=0;
             
                        $sel_price = "select * from cart where ip_add='$ip_add'";
         
                        $run_price = mysqli_query($db, $sel_price);
         
                        while ($rec=mysqli_fetch_array($run_price)){
             
                        $pro_id = $rec['p_id'];
             
                         $pro_price = "select * from products where product_id='$pro_id'";
             
                        $run_pro_price = mysqli_query($con, $pro_price);
             
                         while($p_price=mysqli_fetch_array($run_pro_price)){
                 
                        $product_price = array($p_price['product_price']) ;
                        $product_title = $p_price['product_title'];
                        $product_image = $p_price['product_img1'];
                        $only_price = $p_price['product_price'];
                        
                        
                         $values= array_sum($product_price);
                 
                     $total +=$values;
         
                     ?>
                     
                   <tr>
                      <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"/></td>
                      
                      <td><?php echo $product_title; ?><br><img src="admin_area/product_images/<?php echo $product_image; ?>" height="100" width="100"></td>
                      
                      <td><input type="text" name="qty" size="3"/></td>
                       <?php
                      
                      if(isset($_POST['update'])){
                          
                          $qty = $_POST['qty'];
                          
                          $insert_qty = "update cart set qty='$qty' where ip_add='$ip_add'";
                          
                          $run_qty = mysqli_query($con, $insert_qty);
                          
                          $total = $total*$qty;
                      }
                      
                      
                      ?>
                      
                     
                      <td><?php echo "€" . $only_price; ?></td>
                       
                   </tr>
                 
                 <?php }} ?>
                 
                 <tr>
                     <td colspan="3" align="right"><b>Sub Total:</b></td>
                     <td><b><?php echo "€" . $total; ?> </b></td>
                     
                 </tr>
                 <tr></tr>
                 
                 <tr>
                     <td colspan="2"><input type="submit" name="update" value="Update Cart"/></td>
                     
                     
                      <td><button><a href="index.php" style="text-decoration:none; color:black;">Continue Shopping</a></button></td>
                      
                      
                     <td><button><a href="checkout.php" style="text-decoration:none; color:red;">CheckOut</a></button></td>
                 </tr>
               </table>
               
           </form>
                
               <?php
               
              function updatecart(){
               
               global $db;
               
                   if(isset($_POST['update']))
                   {
                       foreach ($_POST['remove'] as $remove_id) 
                       {
                           $delete_products = "delete from cart where p_id='$remove_id'";
                           
                           $run_delete = mysqli_query($db, $delete_products);
                           
                           if($run_delete){
                               echo "<script>window.open('cart.php','_self'</script>";
                           }
                       }
                   }
                   
                  
               
               }
               
              echo @$up_cart = updatecart();
              
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


