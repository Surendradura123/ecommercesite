<?php

session_start();
include("includes/db.php");


    if(isset($_GET['order_id'])){
        
        $order_id = $_GET['order_id'];
        
    }
    
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Page</title>
</head>
<body>

<form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post">
    
    <table width="500" align=center border="2" bgcolor="green">
        
        <tr align="center">
            <td colspan="5"><h2>Please Confirm your Payment</h2></td>
        </tr>
        
        <tr>
            <td align="left">Invoice No:</td>
            <td><input type="text" name="invoice_no" /></td>
        </tr>
        
         <tr>
            <td align="left">Amount Sent:</td>
            <td><input type="text" name="amount" /></td>
        </tr>
        
         <tr>
            <td align="left">Select Payment Mode:</td>
            <td>
                <select name="payment_method">
                    <option> Select Payment </option>
                    <option> Bank Transfer </option>
                    <option> Paypal </option>
                    <option> Debit Card </option>
                    <option> Credit Card </option> 
                    <option> Master Card </option>
                </select>
            </td>
        </tr>
        
         <tr>
            <td align="left">Transaction/Reference ID:</td>
            <td><input type="text" name="tr" /></td>
        </tr>
        
         <tr>
            <td align="left">Easypaisa/UBLOMNI code:</td>
            <td><input type="text" name="code" /></td>
        </tr>
        
         <tr>
            <td align="left">Payment Date:</td>
            <td><input type="text" name="date" /></td>
        </tr>
        
         <tr align="center">
            <td colspan="5"><input type="submit" name="confirm" value="Confirm Payment" /></td>
        </tr>
    </table>
    
</form>


</body>
</html>

<?php
 if(isset($_POST['confirm'])){
     
     $update_id = $_GET['update_id'];
     
     
     $invoice_no = $_POST['invoice_no'];
     $amount = $_POST['amount'];
     $payment_method = $_POST['payment_method'];
     $ref_no = $_POST['tr'];
     $code = $_POST['code'];
     $date = $_POST['date'];
     
     
     $complete = 'Complete';
     
     
     $insert_payment = "insert into payments (invoice_no,amount,payment_mode,ref_no,code,payment_date) 
     values('$invoice_no','$amount','$payment_method','$ref_no','$code','$date')";
     
     $run_payment = mysqli_query($con, $insert_payment);
     
    
     
     
     if($run_payment){
         
         echo "<h2 style='text-align:center; color:'white;'>Payment received, your order will be competed within 24hrs!</h2>";
     }
     
     
      $update_order = "UPDATE customer_orders SET order_status='$complete' WHERE order_id='$update_id'";
     
     $run_order = mysqli_query($con, $update_order);
 }

?>
