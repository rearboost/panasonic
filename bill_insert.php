<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['submit'])){

  $shop     = $_POST['shop'];
  $bill_no  = $_POST['bill_no'];
  $b_date   = $_POST['b_date'];
  $cash     = $_POST['cash'];
  $credit   = $_POST['credit'];
  $cheque   = $_POST['cheque'];

  $insert_bill = mysqli_query($con,"INSERT INTO bill (bill_no,shop,b_date,cash,credit,cheque) VALUES ('$bill_no','$shop','$b_date',$cash,$credit, $cheque)");

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

      $insert_item = mysqli_query($con,"INSERT INTO sale_items (bill_no,item,total,sale,free,af_bal) VALUES ('$bill_no','$item',$total,$sale,$free,$af_bal)");

      $update_lorrystock = mysqli_query($con,"UPDATE item SET lorry_stock = '$af_bal' WHERE item_name='$item'");
  }
} 

mysqli_close($con);

?> 