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
      <th>                    BILL #       </th>
      <th>                    ITEM         </th>
      <th class="text-right"> TOTAL [SALE] </th>
      <th class="text-right"> SALE QTY     </th>
      <th class="text-right"> AF BAL [SALE]</th>
      <th class="text-right"> TOTAL [FREE] </th>
      <th class="text-right"> FREE QTY     </th>
      <th class="text-right"> AF BAL[FREE] </th>
    </thead>
    <tbody>

  <?php

  if(isset($_POST['cdate'])){

    $cdate = $_POST['cdate'];

    $query = mysqli_query($con,"SELECT  * FROM bill INNER JOIN sale_items ON bill.bill_no = sale_items.bill_no WHERE bill.b_date = '$cdate'");
       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {
?>
     
      <tr>
        <td>                    <?php echo $row['bill_no'] ?>    </td>
        <td>                    <?php echo $row['item'] ?>       </td>
        <td class="text-right"> <?php echo $row['total'] ?>      </td>
        <td class="text-right"> <?php echo $row['sale'] ?>       </td>
        <td class="text-right"> <?php echo $row['af_bal'] ?>     </td>
        <td class="text-right"> <?php echo $row['total_free'] ?> </td>
        <td class="text-right"> <?php echo $row['free'] ?>       </td>
        <td class="text-right"> <?php echo $row['af_free'] ?>    </td>
      </tr>

    </tbody>

<?php
        }
      }
?> 
  
  </table>
  <?php
  mysqli_close($con);

  }

 ?>
<script>
 
</script>