<?php	
	error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$cdate = $_POST['cdate'];

	$get_sales = mysqli_query($con,"SELECT SUM(discounted_amt) as tot_sales, SUM(cost) as tot_cost FROM bill WHERE b_date = '$cdate' GROUP BY b_date");
	//$get_sales = mysqli_query($con,"SELECT SUM(cash+credit+cheque) as tot_sales FROM bill WHERE b_date = '$cdate' GROUP BY b_date");

	$data = mysqli_fetch_array($get_sales); 

	$sales 	= $data['tot_sales'];
	$purchase 	= $data['tot_cost'];


	if(empty($cdate))
	{	
		$sales = 0.00;	
		$purchase = 0.00;	
	}
	else
	{
		$sales = $sales;
		$purchase = $purchase;
	}

	$myObj->sale_amt  = $sales;
	$myObj->purch_amt  = $purchase;
	$myJSON = json_encode($myObj);
	echo $myJSON;
?>