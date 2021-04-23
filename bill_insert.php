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

    $sql_temp=mysqli_query($con,"SELECT * FROM temp");

    $numRows = mysqli_num_rows($sql_temp); 

    if($numRows > 0) {

        while($row = mysqli_fetch_assoc($sql_temp)) {

            $item= $row['item'];
            $tot_sale=$row['tot_sale'];
            $sale=$row['sale'];
            $af_sale=$row['af_sale'];
            $total_free=$row['tot_free'];
            $free=$row['free'];
            $af_free=$row['af_free'];

            $insert_item = mysqli_query($con,"INSERT INTO sale_items (bill_no,item,total,sale,free,af_bal,total_free,af_free) VALUES ('$bill_no','$item',$tot_sale,$sale,$free,$af_sale,$total_free,$af_free)");

            $update_lorrystock = mysqli_query($con,"UPDATE item SET lorry_stock = '$af_sale', lorry_free_stock='$af_free' WHERE item_name='$item'");

        }
        $insert_temp = "TRUNCATE TABLE temp;";
        mysqli_query($con,$insert_temp);

    }

        ////////// cheque values //////////

        $sql_temp_cheque=mysqli_query($con,"SELECT * FROM temp_cheque");

        $numRows = mysqli_num_rows($sql_temp_cheque); 

        if($numRows > 0) {

            while($row = mysqli_fetch_assoc($sql_temp_cheque)) {

                $cheque=$row['cheque'];
                $cheque_no=$row['cheque_no'];
                $cheque_date=$row['cheque_date'];

                if($cheque>0 && $cheque_no!='' && $cheque_date!=''){
                        $status = 1;
                }else{
                        $status = 0;
                }

                $insert_cheques = mysqli_query($con,"INSERT INTO cheques (bill_no,amount,cheque_no,  valid_date,cheque_status) VALUES ('$bill_no',$cheque,'$cheque_no','$cheque_date',$status)");

            }
            $insert_temp = "TRUNCATE TABLE temp_cheque;";
            mysqli_query($con,$insert_temp);

        }
    ////////////////////////////////////////////////
    } 

  // Row Add Function 
if(isset($_POST['addrow'])){

    $item = $_POST['item'];
    $tot_sale = $_POST['tot_sale'];
    $sale = $_POST['sale'];
    $af_sale = $_POST['af_sale'];
    $tot_free = $_POST['tot_free'];
    $free = $_POST['free'];
    $af_free = $_POST['af_free'];
    $tot_pur = $_POST['tot_pur'];
    $tot_sales = $_POST['tot_sales'];

    $insert_temp = "INSERT INTO  temp (item,tot_sale,sale,af_sale,tot_free,free,af_free,tot_pur,tot_sales) VALUES ('$item','$tot_sale','$sale','$af_sale','$tot_free','$free','$af_free','$tot_pur','$tot_sales')";
    $result_temp = mysqli_query($con,$insert_temp);
    
    if($result_temp){
        echo  1;
    }else{
        echo  mysqli_error($con);		
    }
 }

 // Remove  Function 
 if(isset($_POST['removeRow'])){
    
    $id = $_POST['id'];
    $insert_temp = "DELETE FROM temp WHERE id='$id'";
    mysqli_query($con,$insert_temp);
    
 }

// Table Empty Function 
if(isset($_POST['tmpEmpty'])){
    
    $insert_temp = "TRUNCATE TABLE temp;";
    mysqli_query($con,$insert_temp);
    
}

// cheque  Add Function 
if(isset($_POST['addcheque'])){

    $cheque = $_POST['cheque'];
    $cheque_no = $_POST['cheque_no'];
    $cheque_date = $_POST['cheque_date'];

    $insert_temp = "INSERT INTO temp_cheque (cheque,cheque_no,cheque_date) VALUES ('$cheque','$cheque_no','$cheque_date')";
    $result_temp = mysqli_query($con,$insert_temp);
    
    if($result_temp){
        echo  1;
    }else{
        echo  mysqli_error($con);		
    }
 }

    // Remove  Function 
    if(isset($_POST['removeRowCheque'])){
        
        $id = $_POST['id'];
        $insert_temp = "DELETE FROM temp_cheque WHERE id='$id'";
        mysqli_query($con,$insert_temp);
        
    }

    // Table Empty Function 
    if(isset($_POST['tmpEmptyCheque'])){
        
        $insert_temp = "TRUNCATE temp_cheque;";
        mysqli_query($con,$insert_temp);
        
    }
        

mysqli_close($con);

?> 