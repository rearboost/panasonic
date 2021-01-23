<?php
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$item_id = $_POST['id'];

	$get_stock = mysqli_query($con,"SELECT free_stock FROM item WHERE item_id = $item_id");

	$data = mysqli_fetch_array($get_stock); 

	$free_stock 		= $data['free_stock'];

	//$myObj->free_stock  	 = $free_stock;

	//$myJSON = json_encode($myObj);

	echo $free_stock ;
	//echo $myJSON;

?>