<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);


if(isset($_POST['submit'])){
  $date    = $_POST['cdate'];
  $sales   = $_POST['sales'];
  $expense = $_POST['expense'];
  $profit  = $_POST['profit'];

$insert1 = "INSERT INTO profit (cdate,sales,expenses,daily_profit) VALUES ('$date',$sales,$expense,$profit)";
mysqli_query($con,$insert1);
}

mysqli_close($con);

?> 