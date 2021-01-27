<?php
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	//$item_id = $_POST['id'];

	$get_remain = mysqli_query($con,"SELECT remain FROM credit ORDER BY c_id DESC LIMIT 1");

	$data = mysqli_fetch_array($get_remain); 

	$remain 	= $data['remain'];
	if(empty($remain)){
		$remain = 0.00;
	}else{
		$remain = $remain;
	}
	echo $remain ;

?>

