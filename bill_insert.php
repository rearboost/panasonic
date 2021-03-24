<?php
include("db_config.php");

  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);

if(isset($_POST['submit'])){

  $bill_no  = $_POST['bill_no'];
  $shop     = $_POST['shop'];
  $b_date   = $_POST['b_date'];
  $bill_amt = $_POST['bill_amt'];
  $discount = $_POST['discount'];
  $dis_amt  = $_POST['dis_amt'];
  $pur_cost = $_POST['pur_cost'];
  $cash     = $_POST['cash'];
  $credit   = $_POST['credit'];
  $tot_cheques = $_POST['tot_cheques'];

  ////////////insert and update cash summary //////////////
  $date = explode('-', $b_date);

  $debt_year  = $date[0];
  $debt_month = $date[1];
  // $debt_year =  date("Y");
  // $debt_month = date("m"); 

  $queryDebtSummary = "SELECT cash_id,cash FROM cash_summary WHERE year='$debt_year' AND month='$debt_month' ";
  $resultDebtSummary = mysqli_query($con ,$queryDebtSummary);

  $countDebtSummary =mysqli_num_rows($resultDebtSummary);

  if($countDebtSummary>0){

      while($rowDebtSummary = mysqli_fetch_array($resultDebtSummary))
      {
          $oldCash = $rowDebtSummary['cash'];
          $cash_id = $rowDebtSummary['cash_id'];
      }

      $newCash = ($oldCash+$cash);

      $queryDebtRow =mysqli_query($con,"UPDATE cash_summary SET cash='$newCash' WHERE cash_id='$cash_id' ");

  }else{

      $queryDebtRow ="INSERT INTO cash_summary (year,month,cash) VALUES (?,?,?)";

      $stmt =mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt,$queryDebtRow))
      {
          echo "SQL Error";
      }
      else
      {
          mysqli_stmt_bind_param($stmt,"sss",$debt_year,$debt_month,$cash);
          $result =  mysqli_stmt_execute($stmt);
      }

      for ($x = 1; $x < 13; $x++) {
    
          if($debt_month !=str_pad($x, 2, "0", STR_PAD_LEFT)){

            $queryDefault ="INSERT INTO cash_summary (year,month)  VALUES (?,?)";

            $stmt =mysqli_stmt_init($con);
            if(!mysqli_stmt_prepare($stmt,$queryDefault))
            {
                echo "SQL Error";
            }
            else
            {
                mysqli_stmt_bind_param($stmt,"ss",$debt_year,str_pad($x, 2, "0", STR_PAD_LEFT));
                $result =  mysqli_stmt_execute($stmt);
            }

          }
      }
  }

  /////////// insert and update debt summary //////////////

  $querySummary = "SELECT debt_id,debt FROM debt_summary WHERE shop='$shop'";

  $resultSummary = mysqli_query($con ,$querySummary);

  $countSummary =mysqli_num_rows($resultSummary);

  if($countSummary>0){

      while($rowSummary = mysqli_fetch_array($resultSummary)){

          $oldDebt = $rowSummary['debt'];
          $debt_id = $rowSummary['debt_id'];
      }

      $newDebt = ($oldDebt+$credit+$tot_cheques);

      $queryRow ="UPDATE debt_summary SET debt='$newDebt' WHERE debt_id='$debt_id' ";
      $rowRow =mysqli_query($con,$queryRow);

  }else{

      $totDebt = ($credit+$tot_cheques);

      $query ="INSERT INTO debt_summary (shop,debt) VALUES (?,?)";

      $stmt =mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt,$query))
      {
          echo "SQL Error";
      }
      else
      {
          mysqli_stmt_bind_param($stmt,"ss",$shop,$totDebt);
          $result =  mysqli_stmt_execute($stmt);
      }
  }


  /////////// normal insert //////////////////////////

  $date = explode('-', $b_date);

  $month = $date[1];
  $year  = $date[0];

  $insert_bill = mysqli_query($con,"INSERT INTO bill (bill_no,shop,b_date,month,year,bill_amount,discount,discounted_amt,cost,cash,credit) VALUES ('$bill_no','$shop','$b_date',$month,$year,$bill_amt,$discount,$dis_amt,$pur_cost,$cash,$credit)");

  ////////////// sales item values /////////////////
  $myitemjson =$_POST['myitemjson'];
  $x = json_decode($myitemjson, true);

  for($i=0;$i<sizeof($x);$i++)
  {
      $item=$x[$i]['item'];
      $tot_sale=$x[$i]['tot_sale'];
      $sale=$x[$i]['sale'];
      $af_sale=$x[$i]['af_sale'];
      $total_free=$x[$i]['tot_free'];
      $free=$x[$i]['free'];
      $af_free=$x[$i]['af_free'];

      $insert_item = mysqli_query($con,"INSERT INTO sale_items (bill_no,item,total,sale,free,af_bal,total_free,af_free) VALUES ('$bill_no','$item',$tot_sale,$sale,$free,$af_sale,$total_free,$af_free)");

      $update_lorrystock = mysqli_query($con,"UPDATE item SET lorry_stock = '$af_sale', lorry_free_stock='$af_free' WHERE item_name='$item'");
  }

  ////////// cheque values //////////
  $myitemjson1 =$_POST['myitemjson1'];
  $y = json_decode($myitemjson1, true);

  for($i=0;$i<sizeof($y);$i++)
  {
    $cheque=$y[$i]['cheque'];
    $cheque_no=$y[$i]['cheque_no'];
    $cheque_date=$y[$i]['cheque_date'];

    if($cheque>0 && $cheque_no!='' && $cheque_date!=''){
        $status = 1;
    }else{
        $status = 0;
    }

    $insert_cheques = mysqli_query($con,"INSERT INTO cheques (bill_no,amount,cheque_no,  valid_date,cheque_status) VALUES ('$bill_no',$cheque,'$cheque_no','$cheque_date',$status)");
  }
  ////////////////////////////////////////////////
} 

mysqli_close($con);

?> 