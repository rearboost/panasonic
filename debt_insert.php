<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['submit'])){

  $shop         = $_POST['shop'];
  $rdate        = $_POST['rdate'];
  $pay          = $_POST['pay'];

  $date = explode('-', $rdate);

  $month = $date[1];
  $year  = $date[0];

  $insert = mysqli_query($con,"INSERT INTO debt (shop,ddate,month,year,amt) VALUES ('$shop','$rdate',$month,$year,'$pay')");

  ////////// update cash summary //////////////

  $queryCashSummary = "SELECT cash_id,debt FROM cash_summary WHERE year='$year' AND month='$month' ";
  $resultCashSummary = mysqli_query($con ,$queryCashSummary);

  $countCashSummary =mysqli_num_rows($resultCashSummary);

  if($countCashSummary>0){

      while($rowCashSummary = mysqli_fetch_array($resultCashSummary)){

          $oldDebt = $rowCashSummary['debt'];
          $cash_id = $rowCashSummary['cash_id'];
      }

      $newDebt = ($oldDebt+$pay);

      $queryCashRow ="UPDATE cash_summary SET debt='$newDebt' WHERE cash_id='$cash_id' ";
      $rowRow =mysqli_query($con,$queryCashRow);

  }else{

      $Cashquery ="INSERT INTO  cash_summary (year,month,debt)  VALUES (?,?,?)";

      $stmt =mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt,$Cashquery))
      {
          echo "SQL Error";
      }
      else
      {
          mysqli_stmt_bind_param($stmt,"sss",$year,$month,$pay);
          $result =  mysqli_stmt_execute($stmt);
      }

      for ($x = 1; $x < 13; $x++) {
    
          if($month !=str_pad($x, 2, "0", STR_PAD_LEFT)){

            $queryCashDefult ="INSERT INTO cash_summary (year,month)  VALUES (?,?)";

            $stmt =mysqli_stmt_init($con);
            if(!mysqli_stmt_prepare($stmt,$queryCashDefult))
            {
                echo "SQL Error";
            }
            else
            {
                mysqli_stmt_bind_param($stmt,"ss",$year,str_pad($x, 2, "0", STR_PAD_LEFT));
                $result =  mysqli_stmt_execute($stmt);
            }

          }
      }
  }

  ////////// update debt summary //////////////
  $querySummary = "SELECT debt_id,received FROM debt_summary WHERE shop='$shop' ";
  $resultSummary = mysqli_query($con ,$querySummary);

  $countSummary =mysqli_num_rows($resultSummary);

  if($countSummary>0){

      while($rowSummary = mysqli_fetch_array($resultSummary)){

          $oldreceived = $rowSummary['received'];
          $debt_id = $rowSummary['debt_id'];
      }

      $newreceived = ($oldreceived+$pay);

      $queryRow ="UPDATE debt_summary SET received='$newreceived' WHERE debt_id='$debt_id' ";
      $rowRow =mysqli_query($con,$queryRow);

  }else{

      $query ="INSERT INTO debt_summary (shop,received) VALUES (?,?)";

      $stmt =mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt,$query))
      {
          echo "SQL Error";
      }
      else
      {
          mysqli_stmt_bind_param($stmt,"ss",$shop,$pay);
          $result =  mysqli_stmt_execute($stmt);
      }
  }

  /////////////////////////////////////////////

}

mysqli_close($con);

?> 