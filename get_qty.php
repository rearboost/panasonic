<?php
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$item_id = $_POST['id'];

	$get_stock = mysqli_query($con,"SELECT warehouse_stock FROM item WHERE item_id = $item_id");

	$data = mysqli_fetch_array($get_stock); 

	$warehouse_stock 	= $data['warehouse_stock'];

	$myObj->warehouse_stock  = $warehouse_stock;

	$myJSON = json_encode($myObj);

	echo $myJSON;

?>