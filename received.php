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

    // need to get received (total cash + total debt collection) according to each each month and year

    $query = mysqli_query($con,"SELECT year,month,cash,debt FROM cash_summary GROUP BY month,year HAVING cash>0 OR debt>0 ORDER BY year DESC");

       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {
           $total1 = $row['cash'];
           $total2 = $row['debt'];
           $sum = $total1 + $total2;
?>
     
      <tr>
        <td>                     <?php echo $row['month'].','.$row['year'] ?> </td>
         <td class="text-right"> <?php echo $row['cash'] ?>                   </td>  
         <td class="text-right"> <?php echo $row['debt'] ?>                   </td>   
         <td class="text-right"> <?php echo number_format($sum,2); ?>         </td>  
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