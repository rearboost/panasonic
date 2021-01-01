<?php
include("db_config.php");
$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
mysqli_select_db($con, DB_NAME);

	$shop = $_POST['shop'];


	$getno = mysqli_query($con,"SELECT bill.bill_no  FROM bill ORDER BY bill.bill_no DESC LIMIT 1");		
	$bill_no = "0000";
	while ($row = mysqli_fetch_assoc($getno)) {
		
		$bill_no = substr($row['bill_no'], 1); 
	}
	
	echo $bill_no;

?>
