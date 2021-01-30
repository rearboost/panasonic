<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="get_data1">
    <thead class="text-primary">
      <th>                    SHOP       </th>
      <th class="text-right"> CREDIT     </th>
      <th class="text-right"> RECEIVED   </th>
      <th class="text-right"> AMOUNT     </th>
    </thead>
    <tbody>

  <?php

  // need to get to be received (total credits+total cheques) from bill table - total received (total amount) from debt table according to each shop

  // $sql1= "SELECT shop, SUM(credit+cheque) AS tot_credit FROM bill GROUP BY shop HAVING tot_credit>0";
  // $sql2= "SELECT bill.shop,SUM(bill.credit+bill.cheque-debt.amt) AS total_credit FROM bill LEFT JOIN debt ON bill.shop = debt.shop GROUP BY bill.shop HAVING total_credit>0";
  
    $query = mysqli_query($con,"SELECT bill.shop, SUM(bill.credit+bill.cheque)AS total_credit, SUM(debt.amt) AS total_amt FROM bill LEFT JOIN debt ON bill.shop = debt.shop GROUP BY bill.shop HAVING total_credit>0");


       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {

          $credit = $row['total_credit'];
          $paid   = $row['total_amt'];
          $due    = $credit - $paid;
?>
     
      <tr>
        <td>                     <?php echo $row['shop'] ?>    </td>
        <td class="text-right">  <?php echo $row['total_credit'] ?>    </td>
        <td class="text-right">  <?php echo $row['total_amt'] ?>    </td>
        <td class="text-right">  <?php echo number_format($due,2); ?> </td> 
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