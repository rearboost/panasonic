<?php	
	
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$cdate = $_POST['cdate'];

	$get_sales = mysqli_query($con,"SELECT SUM(I.sales_cost * T.sale) as tot_sales FROM Item I INNER JOIN trxn T ON I.item_name = T.item WHERE T.create_date = '2020-12-18' GROUP BY T.create_date");

	//SELECT SUM(I.sales_cost * T.sale) as tot_sales FROM Item I INNER JOIN trxn T ON I.item_name = T.item WHERE T.create_date = '2020-12-18' GROUP BY T.create_date

	$data = mysqli_fetch_array($get_sales); 

	$sales 	= $data['tot_sales'];


	// if(empty($cdate))
	// {	
	// 	$sales = 0.00;	
	// }
	// else
	// {
	// 	$sales = $sales;
	// }

	$myObj->$sale_amt  = $sales;

	$myJSON = json_encode($myObj);

	echo $myJSON;

?>