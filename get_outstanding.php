<?php	
	error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$shop = $_POST['shop'];

	//$get_credit = mysqli_query($con,"SELECT SUM(credit+cheque) as tot_credit FROM bill WHERE shop = '$shop' GROUP BY shop");
	// $get_credit = mysqli_query($con,"SELECT SUM(B.credit+C.amount) as tot_credit FROM bill B,cheques C WHERE B.bill_no=C.bill_no AND B.shop = '$shop' GROUP BY B.shop");
	
	// $data = mysqli_fetch_array($get_credit); 

	// $tot_credit 	= $data['tot_credit'];

	// $get_amt = mysqli_query($con,"SELECT SUM(amt) as tot_amt FROM debt WHERE shop = '$shop' GROUP BY shop");
	$get_amt = mysqli_query($con,"SELECT debt,received FROM debt_summary WHERE shop='$shop' GROUP BY shop");

	$data1 = mysqli_fetch_array($get_amt); 
	$debt 	= $data1['debt'];
	$received 	= $data1['received'];

	$myObj->outstand = $debt;
	$myObj->tot_amt  = $received;
	$myJSON = json_encode($myObj);
	echo $myJSON;
?>