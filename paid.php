<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="get_data1">
    <thead class="text-primary">
      <th>                    MONTH / YEAR    </th>
      <th class="text-right"> AMOUNT        </th>
    </thead>
    <tbody>

  <?php

  //if(isset($_POST['btn1'])){

    $year =  date("Y");
    $month = date("m");

    $query = mysqli_query($con,"SELECT cdate, SUM(amount) AS tot_amt FROM credit WHERE type='payment' GROUP BY cdate");
       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {


?>
     
      <tr>
        <td>                    <?php echo $month . ',' . $year ?>    </td>
        <td class="text-right"> <?php $row['tot_amt'] ?>      </td>
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