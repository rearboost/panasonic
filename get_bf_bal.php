<?php

	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$item_name = $_POST['item'];

	$get_size = mysqli_query($con,"SELECT size FROM item WHERE item_name = '$item'");

	$data = mysqli_fetch_array($get_size); 

		$size	= $data['size'];

	$get_bal = mysqli_query($con,"SELECT af_bal FROM trxn WHERE item = '$item_name' ORDER BY trxn_id DESC LIMIT 1");

    $data1 = mysqli_fetch_array($get_bal); 

		$af_bal   = $data1['af_bal'];

	if(empty($af_bal))
	{
		$af_bal = 0;
	}
	else
	{
	   $af_bal = $af_bal;
	}

	$myObj->size  	= $size;
	$myObj->bf_bal  = $af_bal;

	$myJSON = json_encode($myObj);

	echo $myJSON;

?>