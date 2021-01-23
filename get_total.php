<?php
	error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$item = $_POST['item'];

	$get_tot = mysqli_query($con,"SELECT purchase_cost,sales_cost,lorry_stock,lorry_free_stock FROM item WHERE item_name='$item'");

	$data    = mysqli_fetch_array($get_tot);

	$lorry_stock	 = $data['lorry_stock'];
	$lorry_free_stock= $data['lorry_free_stock'];
	$sales_cost 	 = $data['sales_cost'];
	$purchase_cost = $data['purchase_cost'];

	$myObj->sale_items  = $lorry_stock;
	$myObj->free_items  = $lorry_free_stock;
	$myObj->sale_price  = $sales_cost;
	$myObj->purch_price = $purchase_cost;
	
	$myJSON = json_encode($myObj);

	echo $myJSON;

?>