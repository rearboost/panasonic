<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['create_date'])){

  // need to insert this date into trxn table [column - create_date]
  $create_date      = $_POST['create_date'];
  
  $sqli = mysqli_query($con,"SELECT create_date FROM trxn WHERE create_date = '$create_date'");

  $numCheck = mysqli_num_rows($sqli); 

  if($numCheck==0){

    $q = mysqli_query($con,"SELECT * FROM item");

    while($row = mysqli_fetch_assoc($q)) {

      $category = $row['category'];
      $item_name = $row['item_name'];
      $size = $row['size'];
      $lorry_stock = $row['lorry_stock'];
      $insert = mysqli_query($con,"INSERT INTO trxn (category,item,size,bf_bal,create_date) VALUES ('$category','$item_name','$size','$lorry_stock','$create_date')");

    }

  }else{
    $del = mysqli_query($con,"DELETE FROM trxn WHERE create_date='$create_date'");

    $q = mysqli_query($con,"SELECT * FROM item");

    while($row = mysqli_fetch_assoc($q)) {

      $category = $row['category'];
      $item_name = $row['item_name'];
      $size = $row['size'];
      $lorry_stock = $row['lorry_stock'];
      $insert = mysqli_query($con,"INSERT INTO trxn (category,item,size,bf_bal,create_date) VALUES ('$category','$item_name','$size','$lorry_stock','$create_date')");

    }
    //$insert = mysqli_query($con,"INSERT INTO trxn (category,item,size,bf_bal) SELECT category,item_name,size,lorry_stock FROM item");
  }
} 

mysqli_close($con);

?> 