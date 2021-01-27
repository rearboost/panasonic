<?php
include("db_config.php");
	$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
  	if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
	}

	$id=$_POST['id']; 

	$qry = mysqli_query($con,"SELECT cheque FROM bill WHERE B_id='$id' "); // select query

    $data = mysqli_fetch_array($qry); // fetch data
    	$amt = $data['cheque'];
    	$ddate= cur_date('Y-m-d');

	if(isset($_POST['done'])){

		$add = mysqli_query($con,"INSERT INTO debt (ddate,amt)VALUES('$ddate',$amt)");
		$state = mysqli_query($con,"UPDATE bill SET cheque_status=0 WHERE B_id =  '$id'");

		if ($add){
			mysqli_close($con);
            header("location:tobe_exchanged.php"); // redirects to all records page
		}
		else
		{
			echo mysqli_error();		
		}

	}
?>

