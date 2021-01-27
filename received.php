<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="get_data1">
    <thead class="text-primary">
      <th>                    MONTH,YEAR    </th>
      <th class="text-right"> AMOUNT        </th>
    </thead>
    <tbody>

  <?php

  //if(isset($_POST['btn1'])){

    $year =  date("Y");
    $month = date("m");

    $query = mysqli_query($con,"SELECT SUM(bill.cash) AS tot_cash, SUM(debt.amt) AS tot_collect FROM bill LEFT JOIN debt ON bill.shop = debt.shop WHERE bill.b_date = '$cdate' AND debt.ddate=''");
       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {
          $total1 = $_POST['tot_cash'];
          $total2 = $_POST['tot_collect'];
          $sum = $total1 + $total2;
?>
     
      <tr>
        <td>                    <?php echo $row[''] ?>    </td>
        <td class="text-right"> <?php number_format($sum,2); ?>      </td>
      </tr>

    </tbody>

<?php
        }
      }
?> 
  
  </table>
  <?php
  mysqli_close($con);

  //}

 ?>
<script>
 
</script>