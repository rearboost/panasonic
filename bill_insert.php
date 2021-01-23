<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['submit'])){

  $bill_no  = $_POST['bill_no'];
  $shop     = $_POST['shop'];
  $b_date   = $_POST['b_date'];
  $bill_amt = $_POST['bill_amt'];
  $discount = $_POST['discount'];
  $dis_amt  = $_POST['dis_amt'];
  $pur_cost = $_POST['pur_cost'];
  $cash     = $_POST['cash'];
  $credit   = $_POST['credit'];
  $cheque   = $_POST['cheque'];
  $cheque_no   = $_POST['cheque_no'];
  $cheque_date   = $_POST['cheque_date'];

  $insert_bill = mysqli_query($con,"INSERT INTO bill (bill_no,shop,b_date,bill_amount,discount,discounted_amt,cost,cash,credit,cheque,cheque_no,cheque_date) VALUES ('$bill_no','$shop','$b_date',$bill_amt,$discount,$dis_amt,$pur_cost,$cash,$credit, $cheque,'$cheque_no','$cheque_date')");

  // $item     = $_POST['item'];
  // $total    = $_POST['total'];
  // $sale     = $_POST['sale'];
  // $free     = $_POST['free'];
  // $af_bal   = $_POST['af_bal'];
  $myitemjson =$_POST['myitemjson'];
  $x = json_decode($myitemjson, true);

  for($i=0;$i<sizeof($x);$i++)
  {
      $item=$x[$i]['item'];
      $total=$x[$i]['total'];
      $sale=$x[$i]['sale'];
      $free=$x[$i]['free'];
      $af_bal=$x[$i]['af_bal'];
      $total_free=$x[$i][''];
      $af_free=$x[$i][''];

      $insert_item = mysqli_query($con,"INSERT INTO sale_items (bill_no,item,total,sale,free,af_bal,total_free,af_free) VALUES ('$bill_no','$item',$total,$sale,$free,$af_bal,$total_free,$af_free)");

      $update_lorrystock = mysqli_query($con,"UPDATE item SET lorry_stock = '$af_bal', lorry_free_stock='$af_free' WHERE item_name='$item'");
  }
} 

mysqli_close($con);

?> 