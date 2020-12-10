<?php
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$item = $_POST['item_name'];

	$get = mysqli_query($con,"SELECT * FROM item WHERE item_name = '$item'");

	$data = mysqli_fetch_array($get); 

	$size 	= $data['size'];

	$myObj->size  = $size;

	$myJSON = json_encode($myObj);

	echo $myJSON;

?>