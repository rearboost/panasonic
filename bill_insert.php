<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['submit'])){

  $shop     = $row['shop'];
  $bill_no  = $row['bill_no'];
  $b_date   = $row['b_date'];
  $cash     = $row['cash'];
  $credit   = $row['credit'];
  $cheque   = $row['cheque'];

  $insert_bill = mysqli_query($con,"INSERT INTO bill (bill_no,shop,b_date,cash,credit,cheque) VALUES ('$bill_no','$shop','$b_date',$cash,$credit, $cheque)");


  $item     = $row['item'];
  $total    = $row['total'];
  $sale     = $row['sale'];
  $free     = $row['free'];
  $af_bal   = $row['af_bal'];
  
  $insert_item = mysqli_query($con,"INSERT INTO sale_items (bill_no,item,total,sale,free,af_bal) VALUES ('$bill_no','$item',$total,$sale,$free,$af_bal)");
} 

mysqli_close($con);

?> 