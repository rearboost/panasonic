<?php
	
	// error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$item = $_POST['item'];

	$get_size = mysqli_query($con,"SELECT size FROM item WHERE item_name = '$item'");
	$data = mysqli_fetch_array($get_size); 
		$size 	= $data['size'];

	$myObj->size  = $size;

	$myJSON = json_encode($myObj);

	echo $myJSON;

?>