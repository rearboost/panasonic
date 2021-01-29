<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['submit'])){

  $type   		= $_POST['type'];
  $ino  		= $_POST['ino'];
  $idate    	= $_POST['idate'];
  $iamt    		= $_POST['iamt'];
  $pdate    	= $_POST['pdate'];
  $pamt    		= $_POST['pamt'];
  $new_remain   = $_POST['new_remain'];

  if($type=="invoice"){
	$insert = mysqli_query($con,"INSERT INTO credit (invoice_no,cdate,amount,type,remain) VALUES ('$ino','$idate','$iamt','$type','$new_remain')");
  }else{
  	$insert = mysqli_query($con,"INSERT INTO credit (cdate,amount,type,remain) VALUES ('$pdate','$pamt','$type','$new_remain')");
  }

  

}

mysqli_close($con);

?> 