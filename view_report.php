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
      <th>                    CATEGORY  </th>
      <th>                    ITEM      </th>
      <th class="text-right"> SALE      </th>
      <th class="text-right"> FREE      </th>
      <th class="text-right"> TOTAL     </th>
    </thead>
    <tbody>

  <?php

  if(isset($_POST['cdate'])){

    $cdate = $_POST['cdate'];

    $query = mysqli_query($con,"SELECT  * FROM trxn WHERE create_date = '$cdate' ");
       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {
?>
     
      <tr>
        <td>                    <?php echo $row['category'] ?>  </td>
        <td>                    <?php echo $row['item'] ?>      </td>
        <td class="text-right"> <?php echo $row['sale'] ?>      </td>
        <td class="text-right"> <?php echo $row['free'] ?>      </td>
        <td class="text-right"> <?php echo $row['total'] ?>     </td>
      </tr>
      <div id = "show_view">
        
      </div>

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