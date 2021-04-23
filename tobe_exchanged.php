<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
<table class="table" id="get_data1">
  <thead class="text-primary">
    <th>                    VALID DATE  </th>
    <th>                    CHEQUE NO   </th>
    <th class="text-right"> AMOUNT      </th>
  </thead>
  <tbody>

<?php

  // $query = mysqli_query($con,"SELECT B_id,cheque, cheque_no, cheque_date FROM bill WHERE cheque_status=1");
  $query = mysqli_query($con,"SELECT id,bill_no,amount,cheque_no,valid_date FROM cheques WHERE cheque_status=1");
     
  $numRows = mysqli_num_rows($query);

    if($numRows > 0) {
      while($row = mysqli_fetch_assoc($query)) {
?>
    <tr>
      <td>                    <?php echo $row['valid_date'] ?> </td>
      <td>                    <?php echo $row['cheque_no'] ?>   </td>
      <td class="text-right"> <?php echo $row['amount'] ?>      </td>
      <td class="text-center">  
      <a href="#" onclick="doneFUN(<?php echo $row['id']; ?>)" name="done">
      <button class="btn btn-success btn-round">Done</button></a>
      </td>
    </tr>

  </tbody>
<?php
      }
    }
?> 
</table>
<?php

if(isset($_POST['id'])){

  $id=$_POST['id']; 

  $get_billNo = mysqli_query($con,"SELECT bill_no,amount FROM cheques WHERE id='$id' "); // to get bill no using cheques id
  $detail = mysqli_fetch_array($get_billNo); // fetch data
    $no  = $detail['bill_no'];
    $amt = $detail['amount'];

  $qry = mysqli_query($con,"SELECT shop FROM bill WHERE bill_no='$no' "); // select query
    $data = mysqli_fetch_array($qry); // fetch data
    $shop = $data['shop'];
    // $ddate= date("Y-m-d");
    
    $today    = new DateTime(null, new DateTimeZone('Asia/Colombo'));
    $ddate = $today->format('Y-m-d');

    $date = explode('-', $ddate);

    $year  = $date[0];
    $month = $date[1];

    $add = mysqli_query($con,"INSERT INTO debt(shop,ddate,month,year,amt)VALUES('$shop','$ddate',$month,$year,$amt)");
    $state = mysqli_query($con,"UPDATE cheques SET cheque_status=0 WHERE id ='$id'");


  ////////// update cash summary //////////////

  $queryCashSummary = "SELECT cash_id,debt FROM cash_summary WHERE year='$year' AND month='$month' ";
  $resultCashSummary = mysqli_query($con ,$queryCashSummary);

  $countCashSummary =mysqli_num_rows($resultCashSummary);

  if($countCashSummary>0){

      while($rowCashSummary = mysqli_fetch_array($resultCashSummary)){

          $oldDebt = $rowCashSummary['debt'];
          $cash_id = $rowCashSummary['cash_id'];
      }

      $newDebt = ($oldDebt+$amt);

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
          mysqli_stmt_bind_param($stmt,"sss",$year,$month,$amt);
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

      $newreceived = ($oldreceived+$amt);

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
          mysqli_stmt_bind_param($stmt,"ss",$shop,$amt);
          $result =  mysqli_stmt_execute($stmt);
      }
  }
  ///////////////////////////////////////////////////////////
}

?>


<?php
  mysqli_close($con);
 ?>

<script>

function doneFUN(id){

  // alert(id)
  $.ajax({
    url:"tobe_exchanged.php",
    method:"POST",
    data:{"id":id},
    success:function(data){
      swal({
        title: "Good job !",
        text: "Successfully Updated the Status",
        icon: "success",
        button: "Ok !",
        });
        setTimeout(function(){ location.reload(); }, 2500);
    }
  });
}
////////////////////  
</script>