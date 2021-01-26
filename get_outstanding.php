<?php	
	error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$shop = $_POST['shop'];

	$get_credit = mysqli_query($con,"SELECT SUM(credit) as tot_credit FROM bill WHERE shop = '$shop' GROUP BY shop");

	$data = mysqli_fetch_array($get_credit); 

	$tot_credit 	= $data['tot_credit'];

	if(empty($shop))
	{	
		$tot_credit = 0.00;	
	}
	else
	{
		$tot_credit = $tot_credit;
	}

	$myObj->outstand  = $tot_credit;
	$myJSON = json_encode($myObj);
	echo $myJSON;
?>