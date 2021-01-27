<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['submit'])){

  $shop         = $_POST['shop'];
  $rdate        = $_POST['rdate'];
  $pay          = $_POST['pay'];

  $insert = mysqli_query($con,"INSERT INTO debt (shop,ddate,amt) VALUES ('$shop','$rdate','$pay')");

}

mysqli_close($con);

?> 