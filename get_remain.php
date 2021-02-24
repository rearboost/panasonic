<?php
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$invoice = $_POST['invoice'];

	$get_remain = mysqli_query($con,"SELECT remain FROM credit WHERE type='payment' AND invoice_no='$invoice'");

	$data = mysqli_fetch_array($get_remain); 

	$remain 	= $data['remain'];

	if(empty($remain)){
		$remain_val = mysqli_query($con,"SELECT remain FROM credit WHERE type='invoice' AND invoice_no='$invoice'");
	}else{
		$remain_val = mysqli_query($con,"SELECT remain FROM credit WHERE type='payment' AND invoice_no='$invoice' ORDER BY c_id DESC limit 1");
	}
	$data1 = mysqli_fetch_array($remain_val); 
	$remain_value = $data1['remain'];
	echo $remain_value ;

?>

