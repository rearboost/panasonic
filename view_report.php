<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="edit_trxnTB">
    <thead class="text-primary">
      <th>                    ITEM          </th>
      <th class="text-right"> SALE QUANTITY </th>
      <th class="text-right"> FREE QUANTITY </th>
    </thead>
    <tbody>

  <?php

  if(isset($_POST['from_date']) || isset($_POST['to_date'])){

    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $query = mysqli_query($con,"SELECT sale_items.item AS item, SUM(sale)AS tot_sale, SUM(free)AS tot_free FROM bill INNER JOIN sale_items ON bill.bill_no = sale_items.bill_no WHERE bill.b_date BETWEEN '$from_date' AND '$to_date' GROUP BY sale_items.item ");
       
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {
?>
     
      <tr>
        <td>                    <?php echo $row['item'] ?>    </td>
        <td class="text-right"> <?php echo $row['tot_sale'] ?>      </td>
        <td class="text-right"> <?php echo $row['tot_free'] ?>       </td>
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

  ////////////////// DataTable ////////////////////////////
  $(document).ready( function () {
    $('#edit_trxnTB').DataTable();
  });
 
</script>