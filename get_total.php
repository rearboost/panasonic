<?php
	error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$item = $_POST['item'];

	$get_tot = mysqli_query($con,"SELECT lorry_stock FROM item WHERE item_name='$item'");
	$data    = mysqli_fetch_array($get_tot);
	$lorry 	 = $data['lorry_stock'];

	$myObj->total_items  = $lorry;
	
	$myJSON = json_encode($myObj);

	echo $myJSON;

?>