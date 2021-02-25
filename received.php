<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="get_data1">
    <thead class="text-primary">
      <th> MONTH,YEAR    </th> 
      <th class="text-right"> CASH            </th>
      <th class="text-right"> DEBT COLLECTION </th> 
      <th class="text-right"> TOTAL RECEIVED          </th>
    </thead>
    <tbody>

  <?php

    // need to get received (total cash) from bill table + total debt received (total amount) from debt table according to each month,year
  
    $query = mysqli_query($con,"SELECT bill.month AS month, bill.year AS year, SUM(bill.cash) AS tot_collect, T.tot_debt FROM bill LEFT JOIN (SELECT SUM(debt.amt)AS tot_debt, month, year,shop  FROM debt GROUP BY debt.month, debt.year) T ON bill.shop=T.shop GROUP BY bill.month,bill.year");
       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {
           $total1 = $row['tot_debt'];
           $total2 = $row['tot_collect'];
           $sum = $total1 + $total2;
?>
     
      <tr>
        <td>                    <?php echo $row['month'] . ',' . $row['year'] ?> </td>
         <td class="text-right"> <?php  echo $row['tot_collect'] ?>    </td>  
         <td class="text-right"> <?php   echo $row['tot_debt'] ?>    </td>   
        <td class="text-right">  <?php echo number_format($sum,2); ?>      </td>  
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