<?php
include("db_config.php");
	$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
  	if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
	}
	  
	if(isset($_POST['id'])){

		$id=$_POST['id'];

		$del = mysqli_query($con,"DELETE bill, sale_items FROM bill INNER JOIN sale_items ON bill.bill_no = sale_items.bill_no WHERE bill.bill_no = '$id' ") ;

		if ($del){
			
			mysqli_close($con);
            echo "Successfully Deleted";
		}
		else
		{
			echo "Not deleted.". mysqli_error($con);		
		}

	}
?>

