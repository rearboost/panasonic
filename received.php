<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="get_data1">
    <thead class="text-primary">
      <th> MONTH,YEAR    </th><!-- 
      <th class="text-right"> CASH        </th>
      <th class="text-right"> DEBT       </th> -->
      <th class="text-right"> AMOUNT        </th>
    </thead>
    <tbody>

  <?php

    // need to get received (total cash) from bill table + total debt received (total amount) from debt table according to each month,year

    $query = mysqli_query($con,"SELECT bill.month AS month, bill.year AS year, SUM(bill.cash+debt.amt) AS tot_collect FROM bill LEFT JOIN debt ON bill.shop = debt.shop GROUP BY bill.month,bill.year");
    // $query = mysqli_query($con,"SELECT bill.month AS month, bill.year AS year, SUM(bill.cash) AS tot_cash FROM bill GROUP BY month");
       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {
          // $total1 = $row['tot_cash'];
          // $total2 = $row['tot_collect'];
          // $sum = $total1 + $total2;
?>
     
      <tr>
        <td>                    <?php echo $row['month'] . ',' . $row['year'] ?>    </td>
        <!-- <td class="text-right"> <?php //  echo $row['tot_cash'] ?>    </td>  --> 
        <td class="text-right"> <?php  echo $row['tot_collect'] ?>    </td> 
       <!--  <td class="text-right"> <?php //echo number_format($sum,2); ?>      </td>   -->
      </tr>

    </tbody>

<?php
        }
      }
?> 
  
  </table>
  <?php
  mysqli_close($con);

 ?>
<script>
 
</script>