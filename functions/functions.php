<?php
//establishing the connection
$db = mysqli_connect("localhost","surendradura123","","c9");

//function for getting the IP address
function getRealIpAddr() {
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
 
    return $ip;
}

//Creating the script for cart

function cart(){
    
    if(isset($_GET['add_cart'])){
        
         global $db;
         
        $ip_add = getRealIpAddr();
        
        $p_id =$_GET['add_cart'];
        
        $check_pro = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        
        $run_check = mysqli_query($db, $check_pro);
        
        if(mysqli_num_rows($run_check)>0){
            echo "";
        }
        else{
            $q="insert into cart (p_id,ip_add) values ('$p_id','$ip_add')";
            
            $run_q = mysqli_query($db,$q);
            
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
        
 }

//getting the number of items from the cart
function items(){
    
    if(isset($_GET['add_cart'])){
        
        global $db;
        
         $ip_add = getRealIpAddr();
        
        $get_items = "select * from cart where ip_add='$ip_add'";
        
        $run_items = mysqli_query($db, $get_items);
        
        $count_items = mysqli_num_rows($run_items);
    }
    else{
         global $db;
        
         $ip_add = getRealIpAddr();
        
        $get_items = "select * from cart where ip_add='$ip_add'";
        
        $run_items = mysqli_query($db, $get_items);
        
        $count_items = mysqli_num_rows($run_items);
    }
    
    echo $count_items;
}

//getting the total price of the item from the cart
function total_price(){
       
         $ip_add = getRealIpAddr();
         
           global $db;
           
         $total=0;
         
         $sel_price = "select * from cart where ip_add='$ip_add'";
         
         $run_price = mysqli_query($db, $sel_price);
         
         while ($record=mysqli_fetch_array($run_price)){
             
             $pro_id = $record['p_id'];
             
             
             $pro_price = "select * from products where product_id='$pro_id'";
             
             $run_pro_price = mysqli_query($db, $pro_price);
             
             while($p_price=mysqli_fetch_array($run_pro_price)){
                 
                 $product_price = array($p_price['product_price']) ;
                 
                 $values= array_sum($product_price);
                 
                 $total +=$values;
             }
         }
         
         echo "€" . $total;
}
 

 //getting the product display
function getPro(){
    
                 global $db;
                
                if(!isset($_GET['cat'])){
                    
                        if(!isset($_GET['brand'])){
                            
                $get_products = "select * from products order by rand() LIMIT 0,6";
                
                $run_products = mysqli_query($db, $get_products);
                
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
                     
                     <p><b> Price:€ $pro_price </b></p>
                     
                     <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                     
                     <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
                     
                     </div>
                     
                     ";
    
                }
                        }
                }
                
}

//getting category products
function getCatPro(){
    
                 global $db;
                
                if(isset($_GET['cat'])){
                    
                $cat_id= $_GET['cat'];
                            
                $get_cat_pro = "select * from products where cat_id='$cat_id'";
                
                $run_cat_pro = mysqli_query($db, $get_cat_pro);
                
                $count = mysqli_num_rows($run_cat_pro);
                if($count==0){
                    echo "<h2>No Products found in this category!</h2>";
                }
                
                while($row__cat_pro = mysqli_fetch_array($run_cat_pro)){
                    
                     $pro_id = $row__cat_pro['product_id'];
                     $pro_title = $row__cat_pro['product_title'];
                     $pro_desc = $row__cat_pro['product_desc'];
                     $pro_price = $row__cat_pro['product_price'];
                     $pro_image = $row__cat_pro['product_img1'];
                     
                     
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
                        
                }
                
}

//getting the brand products
function getBrandPro(){
    
                 global $db;
                
                if(isset($_GET['brand'])){
                    
                $brand_id= $_GET['brand'];
                            
                $get_products = "select * from products where brand_id='$brand_id'";
                
                $run_products = mysqli_query($db, $get_products);
                
                $count = mysqli_num_rows($run_products);
                if($count==0){
                    echo "<h2>No Products found in this brand!</h2>";
                }
                
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
                        
                }
                
}


//getting the brand display


function getBrand(){
    global $db;
     $get_brands = "select * from brands";
                
                     $run_brands = mysqli_query($db, $get_brands);
                
                     while ($row_brands=mysqli_fetch_array($run_brands)){
                    
                            $brand_id = $row_brands['brand_id'];
                            $brand_title = $row_brands['brand_title'];
                    
                            echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
                     }
}

//getting the category display
function getCats(){
    global $db;
    
     $get_cats = "select * from categories";
                
                     $run_cats = mysqli_query($db, $get_cats);
                
                     while ($row_cats=mysqli_fetch_array($run_cats)){
                    
                            $cat_id = $row_cats['cat_id'];
                            $cat_title = $row_cats['cat_title'];
                    
                            echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
                
                }
}


?>