<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['submit'])){

  $type   		= $_POST['type'];
  $ino  		  = $_POST['ino'];
  $idate    	= $_POST['idate'];
  $iamt    		= $_POST['iamt'];

  $inum    	  = $_POST['inum'];
  $pdate      = $_POST['pdate'];
  $pamt    		= $_POST['pamt'];
  $new_remain = $_POST['new_remain'];

  $date1 = explode('-', $idate);

  $month1 = $date1[1];
  $year1  = $date1[0];

  $date2 = explode('-', $pdate);

  $month2 = $date2[1];
  $year2  = $date2[0];

  if($type=="invoice"){
	$insert = mysqli_query($con,"INSERT INTO credit (invoice_no,cdate,month,year,amount,type,remain,credit_status) VALUES ('$ino','$idate',$month1,$year1,'$iamt','$type','$iamt',1)");
  }else{
    if($new_remain<=0){
      $update = mysqli_query($con,"UPDATE credit
                                    SET credit_status=0
                                    WHERE invoice_no='$inum' AND type='invoice'");
    }
  $insert = mysqli_query($con,"INSERT INTO credit (invoice_no,cdate,month,year,amount,type,remain) VALUES ('$inum','$pdate',$month2,$year2,'$pamt','$type','$new_remain')");
    
  
  }

  

}

mysqli_close($con);

?> 